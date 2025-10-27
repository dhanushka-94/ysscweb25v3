<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTeamController extends Controller
{
    public function index()
    {
        $team = Team::with('category')->orderBy('order')->paginate(20);
        return view('admin.team.index', compact('team'));
    }

    public function create()
    {
        $categories = TeamCategory::where('is_active', true)->orderBy('order')->get();
        return view('admin.team.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'jersey_number' => 'nullable|string|max:10',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string',
            'nationality' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'category_id' => 'nullable|exists:team_categories,id',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Team::create($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member added successfully.');
    }

    public function edit(Team $team)
    {
        $categories = TeamCategory::where('is_active', true)->orderBy('order')->get();
        return view('admin.team.edit', compact('team', 'categories'));
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'jersey_number' => 'nullable|string|max:10',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bio' => 'nullable|string',
            'nationality' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'category_id' => 'nullable|exists:team_categories,id',
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo && Storage::disk('public')->exists($team->photo)) {
                Storage::disk('public')->delete($team->photo);
            }
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $team->update($validated);

        return redirect()->route('admin.team.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(Team $team)
    {
        if ($team->photo && Storage::disk('public')->exists($team->photo)) {
            Storage::disk('public')->delete($team->photo);
        }
        
        $team->delete();
        
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted successfully.');
    }
}
