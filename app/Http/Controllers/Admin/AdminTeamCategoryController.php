<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTeamCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TeamCategory::withCount('teams')->orderBy('order')->paginate(20);
        return view('admin.team-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.team-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        TeamCategory::create($validated);

        return redirect()->route('admin.team-categories.index')->with('success', 'Team category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamCategory $teamCategory)
    {
        $teams = $teamCategory->teams()->orderBy('order')->paginate(20);
        return view('admin.team-categories.show', compact('teamCategory', 'teams'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamCategory $teamCategory)
    {
        return view('admin.team-categories.edit', compact('teamCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeamCategory $teamCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'required|string|max:7',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');

        $teamCategory->update($validated);

        return redirect()->route('admin.team-categories.index')->with('success', 'Team category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamCategory $teamCategory)
    {
        // Check if category has teams
        if ($teamCategory->teams()->count() > 0) {
            return redirect()->route('admin.team-categories.index')
                ->with('error', 'Cannot delete category that has team members. Please move or delete team members first.');
        }

        $teamCategory->delete();

        return redirect()->route('admin.team-categories.index')->with('success', 'Team category deleted successfully.');
    }
}
