<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Fixture;
use App\Models\Product;
use App\Models\Sponsor;
use App\Models\GalleryImage;
use App\Models\Slider;
use App\Models\Team;
use App\Models\OfficeBearer;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'sliders' => Slider::count(),
            'news' => News::count(),
            'team' => Team::count(),
            'fixtures' => Fixture::count(),
            'products' => Product::count(),
            'sponsors' => Sponsor::count(),
            'gallery_images' => GalleryImage::count(),
            'office_bearers' => OfficeBearer::count(),
        ];

        $recentNews = News::orderBy('created_at', 'desc')->take(5)->get();
        $upcomingFixtures = Fixture::where('status', 'scheduled')
            ->where('match_date', '>=', now())
            ->orderBy('match_date', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentNews', 'upcomingFixtures'));
    }
}
