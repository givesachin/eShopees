<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Attachment extends Model
{
    use SoftDeletes;

    protected $table = 'attachments';

    protected $fillable = [
        'filename',
        'size',
        'extension',
        'path'
    ];

    public static function getData($filters)
    {
        $query = Attachment::leftjoin('carousel', 'carousel.attachment_id', '=', 'attachments.id')
            ->leftjoin('banner', 'banner.attachment_id', '=', 'attachments.id')
            ->leftjoin('products', 'products.attachment_id', '=', 'attachments.id')
            ->leftjoin('category', 'category.attachment_id', '=', 'attachments.id')
            ->select(
                'attachments.*',
                DB::raw("CONCAT('" . URL('') . "', attachments.path) as path"),
                DB::raw("IF(carousel.id is not null,
                    'In Carousel',
                    IF(banner.id is not null,
                        'In Banner',
                        IF(products.id is not null,
                            'In Products',
                            IF(category.id is not null,
                                'In Category',
                                'Not In Use'
                            )
                        )
                    )
                ) AS status"),
                )
            ->orderBy('attachments.deleted_at', 'desc')
            ->orderBy('status', 'desc')
            ->orderBy('attachments.created_at', 'desc')
            ->withTrashed();

        if (isset($filters['from_date']))
            $query->whereRaw('attachments.updated_at >= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['from_date'] .' 00:00:00')->format('Y-m-d H:i:s') . '"');

        if (isset($filters['till_date']))
            $query->whereRaw('attachments.updated_at <= "' . Carbon::createFromFormat('d-m-Y H:i:s',  $filters['till_date'] .' 00:00:00')->addDay()->format('Y-m-d H:i:s') . '"');

        return $query->get();
    }

    public static function getStorageUsage()
    {
        $data = Attachment::select(
                DB::raw('SUM(size) as size'),
                DB::raw('COUNT(size) as count')
            )
            ->withTrashed()
            ->first();

        return FileController::format_size($data->size) . ', ' . $data->count . ' Files';
    }

    public static function deleteTrash($id)
    {
        return Attachment::where('id', '=', $id)->forceDelete();
    }
}
