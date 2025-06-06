<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $table = 'tier';

    protected $fillable = [
        'title',
        'sort_order',
        'type_id',
        'link'
    ];

    public static function getProductsTiers()
    {
        return Tier::where('type_id', '=', 1)
            ->get();
    }

    public static function getBannersTiers()
    {
        return Tier::where('type_id', '=', 2)
            ->get();
    }
    
    public static function getCarouselsTiers()
    {
        return Tier::where('type_id', '=', 0)
            ->get();
    }
}
