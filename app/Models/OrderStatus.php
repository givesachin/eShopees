<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';

    protected $fillable = [
        'title',
        'status_description'
    ];

    public static function getData()
    {
        return OrderStatus::get();
    }
    
    public static function getStatusOptions()
    {
        return DB::table('order_status_options')
                ->leftjoin('order_status', 'order_status_options.child_order_status_id', 'order_status.id')
                ->select('order_status_options.*', 'order_status.title')
                ->get();
    }

}
