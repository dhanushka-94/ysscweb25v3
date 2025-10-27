<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\YouTubeService;

class YouTubeController extends Controller
{
    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    public function index()
    {
        // Get real data from YouTube API
        $channelInfo = $this->youtubeService->getChannelInfo();
        $playlists = $this->youtubeService->getPlaylists(8);
        $latestVideos = $this->youtubeService->getLatestVideos(8);

        // Fallback data if API fails
        if (!$channelInfo) {
            $channelInfo = [
                'name' => 'Young Silver Sports Club',
                'description' => 'Official YouTube channel of Young Silver Sports Club. Watch our latest matches, training sessions, and club activities.',
                'subscriber_count' => 'Subscribers',
                'video_count' => 'Videos',
                'view_count' => 'Views',
                'thumbnail' => null,
                'custom_url' => '@YoungSilverSportsClub',
            ];
        }

        // Add channel URL
        $channelInfo['url'] = 'https://www.youtube.com/@YoungSilverSportsClub';

        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Gallery', 'url' => route('gallery')],
            ['title' => 'Videos', 'url' => null]
        ];

        return view('youtube.index', compact('channelInfo', 'playlists', 'latestVideos', 'breadcrumbs'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $videos = [];

        if ($query) {
            $videos = $this->youtubeService->searchVideos($query, 12);
        }

        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Gallery', 'url' => route('gallery')],
            ['title' => 'Videos', 'url' => route('youtube')],
            ['title' => 'Search: ' . $query, 'url' => null]
        ];

        return view('youtube.search', compact('videos', 'query', 'breadcrumbs'));
    }
}
