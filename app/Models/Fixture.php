<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'home_team',
        'away_team',
        'competition',
        'match_date',
        'venue',
        'home_score',
        'away_score',
        'status',
        'notes',
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];
}
