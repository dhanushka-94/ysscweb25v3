<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'home_team',
        'home_team_logo',
        'away_team',
        'away_team_logo',
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
