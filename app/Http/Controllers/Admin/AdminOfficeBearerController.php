<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeBearer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminOfficeBearerController extends Controller
{
    // Predefined designation categories
    private $categories = [
        'Executive Committee',
        'Committee Members',
        'Sports Management',
        'Administration',
        'Advisors',
    ];
    
    private $designationsByCategory = [
        'Executive Committee' => [
            'President',
            'Vice President',
            'Secretary',
            'Assistant Secretary',
            'Treasurer',
            'Assistant Treasurer',
        ],
        'Committee Members' => [
            'Committee Member',
            'Executive Committee Member',
        ],
        'Sports Management' => [
            'Team Manager',
            'Head Coach',
            'Assistant Coach',
            'Technical Director',
        ],
        'Administration' => [
            'Public Relations Officer',
            'Media Coordinator',
            'Event Coordinator',
        ],
        'Advisors' => [
            'Chief Patron',
            'Patron',
            'Advisor',
        ],
    ];

    public function index()
    {
        $officeBearers = OfficeBearer::orderBy('order')->orderBy('name')->get();
        return view('admin.office-bearers.index', compact('officeBearers'));
    }

    public function create()
    {
        $categories = $this->categories;
        $designationsByCategory = $this->designationsByCategory;
        return view('admin.office-bearers.create', compact('categories', 'designationsByCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('office-bearers', 'public');
        }

        OfficeBearer::create($data);

        return redirect()->route('admin.office-bearers.index')
            ->with('success', 'Office Bearer created successfully.');
    }

    public function edit(OfficeBearer $officeBearer)
    {
        $categories = $this->categories;
        $designationsByCategory = $this->designationsByCategory;
        return view('admin.office-bearers.edit', compact('officeBearer', 'categories', 'designationsByCategory'));
    }

    public function update(Request $request, OfficeBearer $officeBearer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except('photo');
        
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($officeBearer->photo && Storage::disk('public')->exists($officeBearer->photo)) {
                Storage::disk('public')->delete($officeBearer->photo);
            }
            
            $data['photo'] = $request->file('photo')->store('office-bearers', 'public');
        }

        $officeBearer->update($data);

        return redirect()->route('admin.office-bearers.index')
            ->with('success', 'Office Bearer updated successfully.');
    }

    public function destroy(OfficeBearer $officeBearer)
    {
        // Delete photo if exists
        if ($officeBearer->photo && Storage::disk('public')->exists($officeBearer->photo)) {
            Storage::disk('public')->delete($officeBearer->photo);
        }

        $officeBearer->delete();

        return redirect()->route('admin.office-bearers.index')
            ->with('success', 'Office Bearer deleted successfully.');
    }
}

