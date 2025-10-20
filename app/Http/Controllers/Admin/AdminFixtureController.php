<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use Illuminate\Http\Request;

class AdminFixtureController extends Controller
{
    public function index()
    {
        $fixtures = Fixture::orderBy('match_date', 'desc')->paginate(20);
        return view('admin.fixtures.index', compact('fixtures'));
    }

    public function create()
    {
        return view('admin.fixtures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'competition' => 'nullable|string|max:255',
            'match_date' => 'required|date',
            'venue' => 'nullable|string|max:255',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
            'status' => 'required|in:scheduled,live,finished,postponed,cancelled',
            'notes' => 'nullable|string',
        ]);

        Fixture::create($validated);

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture created successfully.');
    }

    public function edit(Fixture $fixture)
    {
        return view('admin.fixtures.edit', compact('fixture'));
    }

    public function update(Request $request, Fixture $fixture)
    {
        $validated = $request->validate([
            'home_team' => 'required|string|max:255',
            'away_team' => 'required|string|max:255',
            'competition' => 'nullable|string|max:255',
            'match_date' => 'required|date',
            'venue' => 'nullable|string|max:255',
            'home_score' => 'nullable|integer|min:0',
            'away_score' => 'nullable|integer|min:0',
            'status' => 'required|in:scheduled,live,finished,postponed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $fixture->update($validated);

        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture updated successfully.');
    }

    public function destroy(Fixture $fixture)
    {
        $fixture->delete();
        
        return redirect()->route('admin.fixtures.index')->with('success', 'Fixture deleted successfully.');
    }
}

