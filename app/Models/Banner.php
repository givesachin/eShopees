<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    protected $table = 'banner';

    public static function getData($banner_id = null)
    {
        $query = Banner::leftjoin('attachments', 'attachments.id', '=', 'banner.attachment_id')
                ->select(
                    'banner.*',
                    'attachments.path as path',
                    DB::raw("CONCAT('" . URL('') . "', attachments.path) as path")
                );

        if ($banner_id != null)
            return $query->where('banner.id', '=', $banner_id)
                    ->first();

        return $query->orderBy('id')
                ->get();
    }

    public static function getBannersByTier($tier_id, $limit = null)
    {
        $query = Banner::leftjoin('attachments', 'attachments.id', '=', 'banner.attachment_id')
                ->select(
                    'banner.*',
                    'attachments.path as path',
                    DB::raw("CONCAT('" . URL('') . "', attachments.path) as path")
                )
                ->where('banner.tier_id', $tier_id)
                ->orderBy('id');

        if ($limit != null)
            $query->limit($limit);

        return $query->latest()->get();
    }
}
