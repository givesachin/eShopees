<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $table = 'cart';

    protected $fillable = [
        'customer_user_id',
        'product_id',
        'user_id',
        'quantity'
    ];

    public static function getData($customer_user_id)
    {
        if ($customer_user_id && $customer_user_id > 0)
        {
            return Cart::leftjoin('products', 'products.id', '=', 'cart.product_id')
                    ->leftjoin('category', 'category.id', '=', 'products.category_id')
                    ->leftjoin('attachments', 'attachments.id', '=', 'products.attachment_id')
                    ->where('cart.customer_user_id', '=', $customer_user_id)
                    ->select(
                        'products.*',
                        'cart.id as cart_id',
                        'cart.quantity as quantity',
                        'category.title as category',
                        'attachments.path as path',
                        DB::raw("CONCAT('" . URL('') . "', attachments.path) as path")
                    )
                    ->orderBy('id')
                    ->get();
        } else {
            return [];
        }
    }
}
