<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Carousel extends Model
{
    protected $table = 'carousel';

    public static function getData($carousel_id = null)
    {
        $query = Carousel::leftjoin('attachments', 'attachments.id', '=', 'carousel.attachment_id')
                ->select(
                    'carousel.*',
                    'attachments.path as path',
                    DB::raw("CONCAT('" . URL('') . "', attachments.path) as path")
                );

        if ($carousel_id != null)
            return $query->where('carousel.id', '=', $carousel_id)
                    ->first();

        return $query->orderBy('id')
                ->get();
    }

    public static function getCarouselsByTier($tier_id, $limit = null)
    {
        $query = Carousel::leftjoin('attachments', 'attachments.id', '=', 'carousel.attachment_id')
                ->select(
                    'carousel.*',
                    'attachments.path as path',
                    DB::raw("CONCAT('" . URL('') . "', attachments.path) as path")
                )
                ->where('carousel.tier_id', $tier_id)
                ->orderBy('id');

        if ($limit != null)
            $query->limit($limit);

        return $query->latest()->get();
    }
}
