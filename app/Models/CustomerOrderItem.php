<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerOrderItem extends Model
{
    protected $table = 'customer_order_items';

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'discounted_percentage',
        'quantity'
    ];

    public static function getOrderItems($order_id)
    {
        return CustomerOrderItem::leftjoin('products', 'products.id', '=', 'customer_order_items.product_id')
                ->leftjoin('product_requests', 'product_requests.id', '=', 'customer_order_items.request_id')
                ->leftjoin('category', 'category.id', '=', 'products.category_id')
                ->leftjoin('attachments', 'attachments.id', '=', 'products.attachment_id')
                ->leftjoin('attachments as attachments2', 'attachments2.id', '=', 'product_requests.attachment_id')
                ->leftjoin('vendors', 'vendors.id', '=', 'products.vendor_id')
                ->where('customer_order_items.order_id', '=', $order_id)
                ->select(
                    'customer_order_items.*',
                    'products.id as id',
                    DB::raw('IF(products.name is not null, products.name, product_requests.name) as name'),
                    DB::raw('IF(products.vendor_references is not null, products.vendor_references, product_requests.link) as vendor_reference_link'),
                    'vendors.name as vendor',
                    'vendors.website as vendor_link',
                    'category.title as category',
                    DB::raw("IF(attachments.path is not null, CONCAT('" . URL('') . "', attachments.path), CONCAT('" . URL('') . "', attachments2.path)) as path"),
                )
                ->get();
    }
}
