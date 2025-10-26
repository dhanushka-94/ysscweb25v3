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
        // Group images by category and sort by latest first
        $groupedImages = GalleryImage::orderBy('created_at', 'desc')
            ->get()
            ->groupBy('category')
            ->map(function ($images) {
                return $images->sortByDesc('created_at');
            })
            ->sortByDesc(function ($images) {
                return $images->first()->created_at;
            });
        
        return view('admin.gallery.index', compact('groupedImages'));
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
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB limit
            'category' => 'nullable|string|max:255',
            'order' => 'required|integer|min:0',
            'is_featured' => 'boolean',
        ]);

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $title = $validated['title'];
            $slug = \Str::slug($title);
            $extension = $file->getClientOriginalExtension();
            $filename = $slug . '_' . time() . '.' . $extension;
            $validated['image_path'] = $file->storeAs('gallery', $filename, 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');

        // Check if image with same title exists and replace it
        $existingImage = GalleryImage::where('title', $validated['title'])->first();
        if ($existingImage) {
            // Delete old image file
            if ($existingImage->image_path && Storage::disk('public')->exists($existingImage->image_path)) {
                Storage::disk('public')->delete($existingImage->image_path);
            }
            // Update existing record
            $existingImage->update($validated);
        } else {
            // Create new record
            GalleryImage::create($validated);
        }

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
            $file = $request->file('image_path');
            $title = $validated['title'];
            $slug = \Str::slug($title);
            $extension = $file->getClientOriginalExtension();
            $filename = $slug . '_' . time() . '.' . $extension;
            $validated['image_path'] = $file->storeAs('gallery', $filename, 'public');
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
            'images' => 'required|array|min:1|max:20',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB limit
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
                
                // Generate unique title from filename for each image
                $baseTitle = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $baseTitle = str_replace(['-', '_'], ' ', $baseTitle);
                $baseTitle = ucwords($baseTitle);
                
                // Create unique title for each image (no prefix to avoid grouping)
                $title = $baseTitle;
                
                // If title_prefix is provided, use it as category instead
                if ($titlePrefix) {
                    $category = $titlePrefix;
                }
                
                // Create filename with title slug
                $slug = \Str::slug($title);
                $extension = $image->getClientOriginalExtension();
                $filename = $slug . '_' . time() . '_' . $order . '.' . $extension;
                $imagePath = $image->storeAs('gallery', $filename, 'public');

                // Check if image with same title exists and replace it
                $existingImage = GalleryImage::where('title', $title)->first();
                if ($existingImage) {
                    // Delete old image file
                    if ($existingImage->image_path && Storage::disk('public')->exists($existingImage->image_path)) {
                        Storage::disk('public')->delete($existingImage->image_path);
                    }
                    // Update existing record
                    $existingImage->update([
                        'title' => $title,
                        'description' => $description,
                        'image_path' => $imagePath,
                        'category' => $category,
                        'order' => $order,
                        'is_featured' => $isFeatured,
                    ]);
                } else {
                    // Create new record
                    GalleryImage::create([
                        'title' => $title,
                        'description' => $description,
                        'image_path' => $imagePath,
                        'category' => $category,
                        'order' => $order,
                        'is_featured' => $isFeatured,
                    ]);
                }

                $uploadedCount++;
            }
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', "Successfully uploaded {$uploadedCount} images to gallery.");
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'selected_images' => 'required|array|min:1',
            'selected_images.*' => 'exists:gallery_images,id',
        ]);

        $selectedImages = $request->input('selected_images');
        $deletedCount = 0;

        foreach ($selectedImages as $imageId) {
            $image = GalleryImage::find($imageId);
            if ($image) {
                // Delete the file from storage
                if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                    Storage::disk('public')->delete($image->image_path);
                }
                
                // Delete the database record
                $image->delete();
                $deletedCount++;
            }
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', "Successfully deleted {$deletedCount} images from gallery.");
    }
}
