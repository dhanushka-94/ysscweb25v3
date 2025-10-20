<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('gallery', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');

        GalleryImage::create($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully.');
    }

    public function edit(GalleryImage $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryImage $gallery)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image_path')) {
            if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $validated['image_path'] = $request->file('image_path')->store('gallery', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');

        $gallery->update($validated);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(GalleryImage $gallery)
    {
        if ($gallery->image_path && Storage::disk('public')->exists($gallery->image_path)) {
            Storage::disk('public')->delete($gallery->image_path);
        }
        
        $gallery->delete();
        
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image deleted successfully.');
    }

    public function bulkUpload()
    {
        return view('admin.gallery.bulk-upload');
    }

    public function storeBulk(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title_prefix' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
        ]);

        $titlePrefix = $request->input('title_prefix');
        $category = $request->input('category');
        $description = $request->input('description');
        $isFeatured = $request->has('is_featured');
        $uploadedCount = 0;
        $order = GalleryImage::max('order') ?? 0;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $order++;
                $imagePath = $image->store('gallery', 'public');
                
                // Generate title from filename
                $baseTitle = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $baseTitle = str_replace(['-', '_'], ' ', $baseTitle);
                $baseTitle = ucwords($baseTitle);
                
                // Add prefix if provided
                $title = $titlePrefix ? $titlePrefix . ' - ' . $baseTitle : $baseTitle;

                GalleryImage::create([
                    'title' => $title,
                    'description' => $description,
                    'image_path' => $imagePath,
                    'category' => $category,
                    'order' => $order,
                    'is_featured' => $isFeatured,
                ]);

                $uploadedCount++;
            }
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', "Successfully uploaded {$uploadedCount} images to gallery.");
    }
}
