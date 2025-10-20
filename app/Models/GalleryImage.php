<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'category',
        'order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}
