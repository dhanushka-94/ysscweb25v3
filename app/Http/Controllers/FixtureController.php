<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;

class FixtureController extends Controller
{
    public function index()
    {
        $fixtures = Fixture::orderBy('match_date', 'desc')->paginate(12);
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'SportsPress', 'url' => null],
            ['title' => 'Fixtures', 'url' => null]
        ];
        
        return view('sportspress.fixtures', compact('fixtures', 'breadcrumbs'));
    }

    public function league()
    {
        $fixtures = Fixture::orderBy('match_date', 'desc')->paginate(20);
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'SportsPress', 'url' => null],
            ['title' => 'League', 'url' => null]
        ];
        
        return view('sportspress.league', compact('fixtures', 'breadcrumbs'));
    }
}
