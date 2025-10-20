<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GalleryImage;

class GalleryImageController extends Controller
{
    public function index()
    {
        $categories = GalleryImage::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');
        
        $images = GalleryImage::orderBy('order')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('gallery.index', compact('images', 'categories'));
    }
}
