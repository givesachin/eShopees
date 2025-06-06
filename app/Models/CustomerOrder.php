<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerOrder extends Model
{
    protected $table = 'customer_orders';

    protected $fillable = [
        'customer_user_id',
        'creator_user_id',
        'shipping_user_address_id',
        'invoice_link',

        'price',
        'discounted_price',
        'delivery_charge',
        'status_id',

        'vendor_id',
        'vendor_references',
        'payment_id'
    ];

    public static function getData($filters, $hide = null)
    {
        $query = CustomerOrder::leftjoin('users', 'users.id', '=', 'customer_orders.customer_user_id')
                    ->leftjoin('user_addresses', 'user_addresses.id', '=', 'customer_orders.shipping_user_address_id')
                    ->leftjoin('address', 'address.id', '=', 'user_addresses.address_id')
                    ->leftjoin('order_status', 'order_status.id', '=', 'customer_orders.status_id')
                    ->leftjoin('customer_orders as co', 'customer_orders.parent_id', '=', 'co.id')
                    ->leftjoin('payments', 'payments.id', '=', 'customer_orders.payment_id')
                    ->select(
                        'customer_orders.*',
                        'users.name as customer_name',
                        'order_status.title as status',
                        DB::raw("IF(user_addresses.mobile is NULL OR user_addresses.mobile = ''
                            , users.mobile , user_addresses.mobile
                            ) as mobile"),
                        'users.email',
                        'users.mobile as user_mobile',
                        'payments.status as payment_status',
                        'co.id as parent_order',
                        'user_addresses.title as address_title',
                        'user_addresses.alt_mobile',
                        'address.address1',
                        'address.address2',
                        'address.city',
                        'address.pincode',
                        'address.state',
                        'address.country'
                    );

        if (isset($filters['order_id']))
        {
            $query->where('customer_orders.id', '=', intval(str_replace('ES','',$filters['order_id'])));
        } else
        {
            if (isset($filters['status_id']))
                $query->where('customer_orders.status_id', '=', $filters['status_id']);

            if (isset($filters['vendor_id']))
            {
                $sub_query = DB::table('customer_order_items')
                                ->leftjoin('products', 'products.id', '=', 'customer_order_items.product_id')
                                ->where('products.vendor_id', '=', $filters['vendor_id'])
                                ->select('customer_order_items.order_id')
                                ->groupBy('customer_order_items.order_id');

                $query->leftJoinSub($sub_query, 'coi', 'coi.order_id','=','customer_orders.id')
                    ->whereNotNull('coi.order_id');
            }

            if (isset($filters['phone']))
                $query->where('users.mobile', 'like', '%' . $filters['phone'] . '%');

            if (isset($filters['name']))
                $query->where('users.name', 'like', '%' . $filters['name'] . '%');

            if (isset($filters['from_date']))
                $query->whereRaw('customer_orders.created_at >= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['from_date'] .' 00:00:00')->format('Y-m-d H:i:s') . '"');

            if (isset($filters['till_date']))
                $query->whereRaw('customer_orders.created_at <= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['till_date'] .' 00:00:00')->addDay()->format('Y-m-d H:i:s') . '"');

            if (isset($filters['all_orders_table']))
                $query->where('payments.status', '=', 'captured');
        }

        $data = $query->orderBy('customer_orders.id')->get();

        foreach($data as $item)
        {
            if ($hide == null)
                $item->items = CustomerOrderItem::getOrderItems($item->id);
            else
                $item->items = CustomerOrderItem::getOrderItems($item->id)->makeHidden('vendor_reference_link');

            $item->statuses = CustomerOrderStatus::getOrderStatus($item->id);
        }

        return $data;
    }

    public static function getCustomerOrders($customer_user_id)
    {
        $query = CustomerOrder::leftjoin('order_status', 'order_status.id', '=', 'customer_orders.status_id')
                    ->leftjoin('user_addresses', 'user_addresses.id', '=', 'customer_orders.shipping_user_address_id')
                    ->leftjoin('users', 'users.id', '=', 'customer_orders.customer_user_id')
                    ->leftjoin('address', 'address.id', '=', 'user_addresses.address_id')
                    ->leftjoin('payments', 'payments.id', '=', 'customer_orders.payment_id')
                    ->whereNotNull('payments.id')
                    ->whereNotIn('payments.status', ['draft'])
                    ->where('customer_orders.customer_user_id', '=', $customer_user_id)
                    ->select(
                        'customer_orders.*',
                        'order_status.title as status',
                        'payments.status as payment_status',
                        DB::raw("IF(user_addresses.mobile is NULL OR user_addresses.mobile = ''
                            , users.mobile , user_addresses.mobile
                            ) as mobile"),
                        'user_addresses.title as address_title',
                        'user_addresses.alt_mobile',
                        'address.address1',
                        'address.address2',
                        'address.city',
                        'address.pincode',
                        'address.state',
                        'address.country'
                    );

        $data = $query->get();

        foreach($data as $item)
        {
            $item->items = CustomerOrderItem::getOrderItems($item->id)->makeHidden('vendor_reference_link');
            $item->statuses = CustomerOrderStatus::getOrderStatus($item->id);
        }

        return $data;
    }

    public static function totalOrdersPayments()
    {
        return CustomerOrder::whereNotIn('customer_orders.status_id', [1,7,8])
            ->leftjoin('payments', 'payments.id', '=', 'customer_orders.payment_id')
            ->orWhere(function ($query) {
                $query->where('customer_orders.status_id', '=', 1)
                      ->where('payments.status', '=', 'captured');
            })
            ->select(DB::raw("SUM(customer_orders.price + customer_orders.delivery_charge) as total_amount, Count(customer_orders.id) as total_count"))
            ->first();
    }

    public static function totalOrdersCount($user_id)
    {
        return CustomerOrder::where('customer_user_id', '=', $user_id)
            ->where('status_id', '<=', 6)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }

    public static function totalOrdersProcessingPaymentDone()
    {
        return CustomerOrder::where('status_id', '=', 1)
            ->leftjoin('payments', 'payments.id', '=', 'customer_orders.payment_id')
            ->where('payments.status', '=', 'captured')
            ->select(DB::raw("Count(customer_orders.id) as total"))
            ->first()->total;
    }

    public static function totalOrdersProcessingNoPaymentAttempt()
    {
        return CustomerOrder::where('status_id', '=', 1)
            ->leftjoin('payments', 'payments.id', '=', 'customer_orders.payment_id')
            ->whereNull('payments.status')
            ->select(DB::raw("Count(customer_orders.id) as total"))
            ->first()->total;
    }

    public static function totalOrdersProcessingPaymentPending()
    {
        return CustomerOrder::where('status_id', '=', 1)
            ->leftjoin('payments', 'payments.id', '=', 'customer_orders.payment_id')
            ->where('payments.status', '=', 'draft')
            ->select(DB::raw("Count(customer_orders.id) as total"))
            ->first()->total;
    }

    public static function totalOrdersProcessingPaymentFailed()
    {
        return CustomerOrder::where('status_id', '=', 1)
            ->leftjoin('payments', 'payments.id', '=', 'customer_orders.payment_id')
            ->where('payments.status', '=', 'failed')
            ->select(DB::raw("Count(customer_orders.id) as total"))
            ->first()->total;
    }

    public static function totalOrdersApproved()
    {
        return CustomerOrder::where('status_id', '=', 2)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }

    public static function totalOrdersDispatched()
    {
        return CustomerOrder::where('status_id', '=', 3)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }

    public static function totalOrdersInTransit()
    {
        return CustomerOrder::where('status_id', '=', 4)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }

    public static function totalOrdersOutForDelivery()
    {
        return CustomerOrder::where('status_id', '=', 5)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }

    public static function totalOrdersDelivered()
    {
        return CustomerOrder::where('status_id', '=', 6)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }

    public static function totalOrdersCancelled()
    {
        return CustomerOrder::where('status_id', '=', 7)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }

    public static function totalOrdersReturned()
    {
        return CustomerOrder::where('status_id', '=', 9)
            ->select(DB::raw("Count(id) as total"))
            ->first()->total;
    }
}
