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
        try {
            $sliders = Slider::where('is_active', true)
                ->orderBy('order')
                ->get();
        } catch (\Exception $e) {
            $sliders = collect();
        }
            
        try {
            $latestNews = News::where('is_published', true)
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            $latestNews = collect();
        }
        
        try {
            $upcomingFixtures = Fixture::where('status', 'scheduled')
                ->where('match_date', '>=', now())
                ->orderBy('match_date', 'asc')
                ->take(3)
                ->get();
        } catch (\Exception $e) {
            $upcomingFixtures = collect();
        }
        
        try {
            $sponsors = Sponsor::where('is_active', true)
                ->orderBy('order')
                ->get();
        } catch (\Exception $e) {
            $sponsors = collect();
        }
        
        try {
            $latestImages = GalleryImage::orderBy('created_at', 'desc')
                ->take(8)
                ->get();
        } catch (\Exception $e) {
            $latestImages = collect();
        }

        return view('home', compact('sliders', 'latestNews', 'upcomingFixtures', 'sponsors', 'latestImages'));
    }
}
