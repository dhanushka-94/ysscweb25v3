<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryImage;

class GalleryImageController extends Controller
{
    public function index()
    {
        // Get all gallery categories with their latest image date for sorting
        $categories = GalleryImage::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');
        
        // Group images by category and sort by latest first
        $groupedImages = GalleryImage::whereNotNull('category')
            ->get()
            ->groupBy('category')
            ->map(function ($images) {
                return $images->sortByDesc('created_at');
            })
            ->sortByDesc(function ($images) {
                return $images->first()->created_at;
            });
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Gallery', 'url' => null]
        ];
        
        return view('gallery.index', compact('groupedImages', 'categories', 'breadcrumbs'));
    }
}
