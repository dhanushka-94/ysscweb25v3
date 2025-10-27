<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YouTubeController extends Controller
{
    public function index()
    {
        // YouTube channel information
        $channelInfo = [
            'name' => 'Young Silver Sports Club',
            'handle' => '@YoungSilverSportsClub',
            'url' => 'https://www.youtube.com/@YoungSilverSportsClub',
            'subscriber_count' => 'Subscribers', // This would need YouTube API to get real count
            'description' => 'Official YouTube channel of Young Silver Sports Club. Watch our latest matches, training sessions, and club activities.',
        ];

        // Sample playlists and videos (in a real implementation, you'd fetch this from YouTube API)
        $playlists = [
            [
                'id' => '1',
                'title' => 'Match Highlights',
                'description' => 'Watch highlights from our latest matches and tournaments',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'video_count' => '12',
                'url' => 'https://www.youtube.com/playlist?list=PLrAXtmRdnEQy6nuLMOV8XxDf4HPM4xZIS',
            ],
            [
                'id' => '2',
                'title' => 'Training Sessions',
                'description' => 'Behind-the-scenes training sessions and drills',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'video_count' => '8',
                'url' => 'https://www.youtube.com/playlist?list=PLrAXtmRdnEQy6nuLMOV8XxDf4HPM4xZIS',
            ],
            [
                'id' => '3',
                'title' => 'Club Events',
                'description' => 'Special events, ceremonies, and club activities',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'video_count' => '15',
                'url' => 'https://www.youtube.com/playlist?list=PLrAXtmRdnEQy6nuLMOV8XxDf4HPM4xZIS',
            ],
            [
                'id' => '4',
                'title' => 'Player Interviews',
                'description' => 'Exclusive interviews with our players and staff',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'video_count' => '6',
                'url' => 'https://www.youtube.com/playlist?list=PLrAXtmRdnEQy6nuLMOV8XxDf4HPM4xZIS',
            ],
        ];

        // Latest videos
        $latestVideos = [
            [
                'id' => '1',
                'title' => 'YSSC vs Colombo FC - Match Highlights',
                'description' => 'Watch the highlights from our thrilling match against Colombo FC',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'duration' => '5:32',
                'views' => '1.2K',
                'published_at' => '2 days ago',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'id' => '2',
                'title' => 'Training Session - Passing Drills',
                'description' => 'Our players working on their passing accuracy and technique',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'duration' => '8:15',
                'views' => '856',
                'published_at' => '1 week ago',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'id' => '3',
                'title' => 'Club Annual Awards Ceremony 2024',
                'description' => 'Celebrating our players and achievements from the past year',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'duration' => '12:45',
                'views' => '2.1K',
                'published_at' => '2 weeks ago',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'id' => '4',
                'title' => 'Player Interview - Captain\'s Corner',
                'description' => 'Exclusive interview with our team captain about the season',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/maxresdefault.jpg',
                'duration' => '6:20',
                'views' => '743',
                'published_at' => '3 weeks ago',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
        ];

        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Gallery', 'url' => route('gallery')],
            ['title' => 'Videos', 'url' => null]
        ];

        return view('youtube.index', compact('channelInfo', 'playlists', 'latestVideos', 'breadcrumbs'));
    }
}
