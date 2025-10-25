<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);
            
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'News', 'url' => null]
        ];
        
        return view('news.index', compact('news', 'breadcrumbs'));
    }

    public function show(News $news)
    {
        if (!$news->is_published) {
            abort(404);
        }
        
        $relatedNews = News::where('is_published', true)
            ->where('id', '!=', $news->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();
        
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'News', 'url' => route('news')],
            ['title' => $news->title, 'url' => null]
        ];
        
        return view('news.show', compact('news', 'relatedNews', 'breadcrumbs'));
    }
}
