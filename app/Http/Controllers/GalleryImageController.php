<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryImage;

class GalleryImageController extends Controller
{
    public function index()
    {
        // Get all gallery images and group them by category
        // If no category, group by 'General' or use title as category
        $allImages = GalleryImage::orderBy('created_at', 'desc')->get();
        
        // Group images by category, using 'General' for images without category
        $groupedImages = $allImages->groupBy(function ($image) {
            return $image->category ?: 'General';
        })->map(function ($images) {
            return $images->sortByDesc('created_at');
        })->sortByDesc(function ($images) {
            return $images->first()->created_at;
        });
        
        // Get all categories for reference
        $categories = $allImages->pluck('category')->filter()->unique()->values();
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Gallery', 'url' => null]
        ];
        
        return view('gallery.index', compact('groupedImages', 'categories', 'breadcrumbs'));
    }
}
