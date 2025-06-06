<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerOrderStatus extends Model
{
    protected $table = 'customer_order_status';

    protected $fillable = [
        'order_id',
        'creator_user_id',
    ];

    public static function getOrderStatus($order_id)
    {
        $order_statuses = CustomerOrderStatus::where('customer_order_status.order_id', '=', $order_id)
            ->select('customer_order_status.*');

        $statuses = OrderStatus::where('order_status.id', '<=', 6);

        return DB::table($statuses, 'statuses')
                ->leftJoinSub($order_statuses, 'cos' , 'statuses.id', '=', 'cos.status_id')
                ->select(
                    'cos.*',
                    'statuses.id as id',
                    'statuses.title as status'
                )
                ->get();
    }
}
