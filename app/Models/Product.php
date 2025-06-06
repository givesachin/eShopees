<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'attachment_id',
        'attachment1_id',
        'attachment2_id',
        'attachment3_id',
        'attachment4_id',
        'tier_id',

        'name',
        'qty',
        'price',
        'discounted_percentage',
        'short_description',

        'description',
        'highlights',
        'specifications',

        'vendor_id',
        'vendor_references'
    ];

    public static function getData($filters)
    {
        $query = Product::leftjoin('category', 'category.id', '=', 'products.category_id')
                ->leftjoin('attachments', 'attachments.id', '=', 'products.attachment_id')
                ->leftjoin('attachments as attachments1', 'attachments1.id', '=', 'products.attachment1_id')
                ->leftjoin('attachments as attachments2', 'attachments2.id', '=', 'products.attachment2_id')
                ->leftjoin('attachments as attachments3', 'attachments3.id', '=', 'products.attachment3_id')
                ->leftjoin('attachments as attachments4', 'attachments4.id', '=', 'products.attachment4_id')
                ->select(
                    'products.*',
                    'category.title as category',
                    DB::raw("CONCAT('" . URL('') . "', attachments.path) as path"),
                    DB::raw("CONCAT('" . URL('') . "', attachments1.path) as path1"),
                    DB::raw("CONCAT('" . URL('') . "', attachments2.path) as path2"),
                    DB::raw("CONCAT('" . URL('') . "', attachments3.path) as path3"),
                    DB::raw("CONCAT('" . URL('') . "', attachments4.path) as path4")
                );

        if (isset($filters['product_id']))
            $query->where('products.id', '=', $filters['product_id']);

        if (isset($filters['category_id']))
            $query->where('products.category_id', '=', $filters['category_id']);

        if (isset($filters['tier_id']))
            $query->where('products.tier_id', '=', $filters['tier_id']);

        if (isset($filters['vendor_id']))
            $query->where('products.vendor_id', '=', $filters['vendor_id']);

        if (isset($filters['out_of_stock']) && $filters['out_of_stock'] == 1)
            $query->where('products.qty', '>', 0);

        if (isset($filters['term']))
        {
            $terms = explode(' ', urldecode($filters['term']));

            $query->where(function ($query) use ($terms) {
                foreach($terms as $key => $term) {
                    if ($key == 0)
                    {
                        $query->where('products.name', 'LIKE', "%".$term."%")
                            ->orWhere('category.title', 'LIKE', "%".$term."%")
                            ->orWhere('category.level_path', 'LIKE', "%".$term."%");
                    } else
                    {
                        $query->orWhere('products.name', 'LIKE', "%".$term."%")
                            ->orWhere('category.title', 'LIKE', "%".$term."%")
                            ->orWhere('category.level_path', 'LIKE', "%".$term."%");
                    }
                }
            });
        }

        if (isset($filters['categories_str']))
        {
            $terms = explode(',', urldecode($filters['categories_str']));

            $query->where(function ($query) use ($terms) {
                foreach($terms as $key => $term) {
                    if ($term != '')
                    {
                        if ($key == 0)
                        {
                            $query->where('category.parent_ids', 'LIKE', "%".$term.",%")
                                ->orWhere('products.category_id', '=', $term);
                        } else
                        {
                            $query->orWhere('category.parent_ids', 'LIKE', "%".$term.",%")
                                ->orWhere('products.category_id', '=', $term);
                        }
                    }
                }
            });
        }

        if (isset($filters['has_price_range']) && $filters['has_price_range'] == 1 && isset($filters['price_range']))
        {
           $ranges = explode(' - ', str_replace('₹', '', $filters['price_range']));

           $min = intval($ranges[0]);
           $max = intval($ranges[1]);

           if ($max > 0)
                $query->where('products.price', '<=', $max);

           if ($min > 0)
                $query->where('products.price', '>=', $min);
        }

        if (isset($filters['limit']))
            $query->limit($filters['limit']);

        return $query->orderBy('id')
                // ->toSql();
                ->get();
    }

    public static function getProductsByTier($tier_id, $limit = null)
    {
        $query = Product::leftjoin('attachments', 'attachments.id', '=', 'products.attachment_id')
                ->select(
                    'products.*',
                    'attachments.path as path',
                    DB::raw("CONCAT('" . URL('') . "', attachments.path) as path")
                )
                ->where('products.tier_id', $tier_id)
                ->orderBy('id');

        if ($limit != null)
            $query->limit($limit);

        return $query->latest()->get()->makeHidden('vendor_references');
    }

    public static function fastSearch($filters)
    {
        $query = Product::leftjoin('category', 'category.id', '=', 'products.category_id')
                ->select(
                    'products.*',
                    'category.title as category',
                );

        if (isset($filters['term']))
        {
            $terms = explode(' ', urldecode($filters['term']));

            $query->where(function ($query) use ($terms) {
                foreach($terms as $key => $term) {
                    if ($key == 0)
                    {
                        $query->where('products.name', 'LIKE', "%".$term."%")
                            ->orWhere('category.title', 'LIKE', "%".$term."%")
                            ->orWhere('category.level_path', 'LIKE', "%".$term."%");
                    } else
                    {
                        $query->orWhere('products.name', 'LIKE', "%".$term."%")
                            ->orWhere('category.title', 'LIKE', "%".$term."%")
                            ->orWhere('category.level_path', 'LIKE', "%".$term."%");
                    }
                }
            });
        }

        if (isset($filters['categories_str']))
        {
            $terms = explode(',', urldecode($filters['categories_str']));

            $query->where(function ($query) use ($terms) {
                foreach($terms as $key => $term) {
                    if ($key == 0)
                    {
                        $query->where('category.parent_ids', 'LIKE', "%'".$term."',%")
                            ->orWhere('products.category_id', '=', $term);
                    } else
                    {
                        $query->orWhere('category.parent_ids', 'LIKE', "%'".$term.",%")
                            ->orWhere('products.category_id', '=', $term);
                    }
                }
            });
        }

        if (isset($filters['limit']))
            $query->limit($filters['limit']);

        return $query->orderBy('id')
                ->get()->makeHidden('vendor_references');
    }
}
