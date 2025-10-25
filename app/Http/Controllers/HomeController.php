<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Fixture;
use App\Models\Sponsor;
use App\Models\GalleryImage;
use App\Models\Slider;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();
            
        $latestNews = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        
        $upcomingFixtures = Fixture::where('status', 'scheduled')
            ->where('match_date', '>=', now())
            ->orderBy('match_date', 'asc')
            ->take(3)
            ->get();
        
        $sponsors = Sponsor::where('is_active', true)
            ->orderBy('order')
            ->get();
        
        $latestImages = GalleryImage::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('home', compact('sliders', 'latestNews', 'upcomingFixtures', 'sponsors', 'latestImages'));
    }
}
