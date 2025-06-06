<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $table = 'integration';

    protected $fillable = [
        'integration_name',
        'code',
        'value',
        'sort_order',
        'test'
    ];

    public static function getCodeValue($integration, $code)
    {
        $row = Integration::where('integration_name', '=', $integration)
            ->where('code', '=', $code)
            ->first();

        if ($row != null)
            return $row->value;
        else
            return $row;
    }

    public static function getData()
    {
        return Integration::orderBy('integration_name', 'ASC')->orderBy('sort_order', 'ASC')->get();
    }

    public static function getTestData()
    {
        return Integration::where('test', '=', 1)->orderBy('integration_name', 'ASC')->orderBy('sort_order', 'ASC')->get();
    }
}
