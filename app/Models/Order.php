<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'name',
        'phone',
        'razorpay_order_id',
        'razorpay_payment_id',
        'method',
        'amount',
        'status',
        'refund_status',
        'eshopees_order_id'
    ];

    public static function getData($filters)
    {
        $query = Order::select(
                'payments.*'
            )
            ->orderBy('payments.created_at');

        if (isset($filters['id']))
        {
            $query->where('payments.id', '=', $filters['id']);
            return $query->first();
        }

        if (isset($filters['name']))
            $query->where('payments.name', 'like', '%' . $filters['name'] . '%');

        if (isset($filters['from_date']))
            $query->whereRaw('payments.created_at >= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['from_date'] .' 00:00:00')->format('Y-m-d H:i:s') . '"');

        if (isset($filters['till_date']))
            $query->whereRaw('payments.created_at <= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['till_date'] .' 00:00:00')->addDay()->format('Y-m-d H:i:s') . '"');

        return $query->get();
    }
}
