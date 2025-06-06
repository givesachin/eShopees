<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'title',
        'attachment_id',
        'parent_id',
        'level',
        'parent_ids',
        'level_path',
        'link',
        'show_in_home',
        'show_in_filters'
    ];

    public static function getData($limit = null, $forwhat = null, $id = null)
    {
        $query = Category::leftjoin('attachments', 'attachments.id', '=', 'category.attachment_id')
                ->select(
                    'category.*',
                    'attachments.path as path',
                    DB::raw("CONCAT('" . URL('') . "', attachments.path) as path")
                    );

        if ($id != null)
            $query->where('category.id', '=', $id);

        if ($forwhat == 'home')
            $query->where('category.show_in_home', '=', 1);

        if ($forwhat == 'filters')
            $query->where('category.show_in_filters', '=', 1);

        if ($forwhat == 'home')
            $query->where(function ($query) {
                $query->where('category.show_in_home', '=', 1)
                    ->orWhere('category.show_in_filters', '=', 1);
            });

        if (isset($limit))
            $query->limit($limit);

        return $query->get();
    }
}
