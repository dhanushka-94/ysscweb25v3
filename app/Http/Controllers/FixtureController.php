<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fixture;

class FixtureController extends Controller
{
    public function index()
    {
        $fixtures = Fixture::orderBy('match_date', 'desc')->paginate(12);
        return view('sportspress.fixtures', compact('fixtures'));
    }

    public function league()
    {
        $fixtures = Fixture::orderBy('match_date', 'desc')->paginate(20);
        return view('sportspress.league', compact('fixtures'));
    }
}
