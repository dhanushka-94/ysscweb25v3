<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'section',
        'title',
        'content',
        'additional_data',
    ];

    protected $casts = [
        'additional_data' => 'array',
    ];
}
