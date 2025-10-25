<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Team;
use App\Models\Gallery;
use App\Models\Product;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Static pages
        $staticPages = [
            ['url' => url('/'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => url('/about/history'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/about/club'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/about/arena'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => url('/about/office-bearers'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['url' => url('/about/bank-details'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['url' => url('/news'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['url' => url('/gallery'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/team'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/fixtures'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => url('/shop'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => url('/contact'), 'priority' => '0.7', 'changefreq' => 'monthly'],
        ];
        
        foreach ($staticPages as $page) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . $page['url'] . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $sitemap .= '<priority>' . $page['priority'] . '</priority>';
            $sitemap .= '</url>';
        }
        
        // Dynamic pages - News
        $news = News::where('is_published', true)->get();
        foreach ($news as $article) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('news.show', $article->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $article->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.6</priority>';
            $sitemap .= '</url>';
        }
        
        // Dynamic pages - Team
        $team = Team::all();
        foreach ($team as $player) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('team.show', $player->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $player->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.5</priority>';
            $sitemap .= '</url>';
        }
        
        // Dynamic pages - Products
        $products = Product::where('is_active', true)->get();
        foreach ($products as $product) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('shop.show', $product->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $product->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.5</priority>';
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }
}
