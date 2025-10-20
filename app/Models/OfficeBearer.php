<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeBearer extends Model
{
    protected $fillable = [
        'name',
        'position',
        'category',
        'photo',
        'email',
        'phone',
        'bio',
        'order',
    ];
}
