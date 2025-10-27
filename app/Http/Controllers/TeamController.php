<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamCategory;

class TeamController extends Controller
{
    public function index()
    {
        // Get all active team categories with their teams
        $categories = TeamCategory::where('is_active', true)
            ->with(['teams' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->orderBy('order')
            ->get();

        // Get all teams for the "All Team" section
        $allTeams = Team::where('is_active', true)
            ->with('category')
            ->orderBy('order')
            ->get();

        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About', 'url' => route('about')],
            ['title' => 'Team', 'url' => null]
        ];

        return view('team.index', compact('categories', 'allTeams', 'breadcrumbs'));
    }
}
