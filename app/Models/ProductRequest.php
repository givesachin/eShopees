<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductRequest extends Model
{
    protected $table = 'product_requests';

    protected $fillable = [
        'user_id',
        'name',
        'link',
        'status',
        'price',
        'quantity',
        'discounted_price',
        'delivery_charge',
        'attachment_id'
    ];

    public static function getData($filters)
    {
//        $subquery = CustomerOrder::leftJoin('customer_order_items', 'customer_order_items.order_id', 'customer_orders.id')
//            ->select('customer_orders.id',
//                DB::raw("GROUP_CONCAT(customer_order_items.id SEPARATOR ',') as item_ids"),
//                'customer_order_items.request_id'
//            )
//            ->where('customer_orders.')
//            ->groupBy('customer_orders.id', 'customer_order_items.request_id');
//
//        $subquery2 = DB::query()->fromSub($subquery, 'orders')
//            ->select(
//                DB::raw("GROUP_CONCAT(orders.id SEPARATOR ', ') as order_ids"),
//                'orders.request_id'
//            )
//            ->groupBy('orders.request_id');

        $query = ProductRequest::leftjoin('users', 'users.id', '=', 'product_requests.user_id')
//                ->leftJoinSub($subquery2, 'req_orders', function ($join) {
//                    $join->on('req_orders.request_id', '=', 'product_requests.id');
//                })
                ->leftjoin('attachments', 'attachments.id', '=', 'product_requests.attachment_id')
                ->select(
                    'product_requests.*',
                    'users.mobile as user_mobile',
                    'users.name as customer_name',
                    'attachments.path',
//                    'req_orders.order_ids'
                );

        if (isset($filters['id']))
            $query->where('product_requests.id', '=', $filters['id']);

        if (isset($filters['user_id']))
            $query->where('product_requests.user_id', '=', $filters['user_id']);

        return $query->latest()->get();
    }
}
