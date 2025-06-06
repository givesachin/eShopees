<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    
    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'website',
    ];

    public static function getData()
    {
        return Vendor::get();
    }

}
