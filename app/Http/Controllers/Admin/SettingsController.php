<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\TeamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'YSSC Football Club'),
            'site_tagline' => Setting::get('site_tagline', 'Victory Through Unity'),
            'site_logo' => Setting::get('site_logo'),
        ];

        $categories = TeamCategory::withCount('teams')->orderBy('order')->take(6)->get();

        return view('admin.settings.index', compact('settings', 'categories'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'nullable|string|max:255',
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // Update site name
        Setting::set('site_name', $request->input('site_name'));

        // Update site tagline
        Setting::set('site_tagline', $request->input('site_tagline'));

        // Handle logo upload
        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }

            // Upload new logo
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            Setting::set('site_logo', $logoPath);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    public function deleteLogo()
    {
        $logo = Setting::get('site_logo');
        
        if ($logo && Storage::disk('public')->exists($logo)) {
            Storage::disk('public')->delete($logo);
        }

        Setting::set('site_logo', null);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Logo deleted successfully.');
    }
}

