<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class YouTubeService
{
    private $apiKey;
    private $channelId;
    private $baseUrl = 'https://www.googleapis.com/youtube/v3';

    public function __construct()
    {
        $this->apiKey = config('services.youtube.api_key');
        $this->channelId = config('services.youtube.channel_id');
    }

    /**
     * Get channel information
     */
    public function getChannelInfo()
    {
        return Cache::remember('youtube_channel_info', 3600, function () {
            try {
                $response = Http::get($this->baseUrl . '/channels', [
                    'part' => 'snippet,statistics',
                    'id' => $this->channelId,
                    'key' => $this->apiKey
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    if (!empty($data['items'])) {
                        $channel = $data['items'][0];
                        return [
                            'name' => $channel['snippet']['title'],
                            'description' => $channel['snippet']['description'],
                            'subscriber_count' => $this->formatNumber($channel['statistics']['subscriberCount'] ?? 0),
                            'video_count' => $this->formatNumber($channel['statistics']['videoCount'] ?? 0),
                            'view_count' => $this->formatNumber($channel['statistics']['viewCount'] ?? 0),
                            'thumbnail' => $channel['snippet']['thumbnails']['high']['url'] ?? null,
                            'custom_url' => $channel['snippet']['customUrl'] ?? null,
                        ];
                    }
                }
            } catch (\Exception $e) {
                \Log::error('YouTube API Error (Channel Info): ' . $e->getMessage());
            }

            return null;
        });
    }

    /**
     * Get latest videos from channel
     */
    public function getLatestVideos($maxResults = 8)
    {
        return Cache::remember("youtube_latest_videos_{$maxResults}", 1800, function () use ($maxResults) {
            try {
                // First, get the uploads playlist ID
                $channelResponse = Http::get($this->baseUrl . '/channels', [
                    'part' => 'contentDetails',
                    'id' => $this->channelId,
                    'key' => $this->apiKey
                ]);

                if (!$channelResponse->successful()) {
                    return [];
                }

                $channelData = $channelResponse->json();
                if (empty($channelData['items'])) {
                    return [];
                }

                $uploadsPlaylistId = $channelData['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

                // Get videos from uploads playlist
                $response = Http::get($this->baseUrl . '/playlistItems', [
                    'part' => 'snippet,contentDetails',
                    'playlistId' => $uploadsPlaylistId,
                    'maxResults' => $maxResults,
                    'key' => $this->apiKey
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $videos = [];

                    foreach ($data['items'] as $item) {
                        $videoId = $item['contentDetails']['videoId'];
                        $videoDetails = $this->getVideoDetails($videoId);
                        
                        if ($videoDetails) {
                            $videos[] = array_merge($videoDetails, [
                                'id' => $videoId,
                                'url' => "https://www.youtube.com/watch?v={$videoId}",
                                'embed_url' => "https://www.youtube.com/embed/{$videoId}",
                            ]);
                        }
                    }

                    return $videos;
                }
            } catch (\Exception $e) {
                \Log::error('YouTube API Error (Latest Videos): ' . $e->getMessage());
            }

            return [];
        });
    }

    /**
     * Get playlists from channel
     */
    public function getPlaylists($maxResults = 10)
    {
        return Cache::remember("youtube_playlists_{$maxResults}", 3600, function () use ($maxResults) {
            try {
                $response = Http::get($this->baseUrl . '/playlists', [
                    'part' => 'snippet,contentDetails',
                    'channelId' => $this->channelId,
                    'maxResults' => $maxResults,
                    'key' => $this->apiKey
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $playlists = [];

                    foreach ($data['items'] as $item) {
                        $playlists[] = [
                            'id' => $item['id'],
                            'title' => $item['snippet']['title'],
                            'description' => $item['snippet']['description'],
                            'thumbnail' => $item['snippet']['thumbnails']['high']['url'] ?? null,
                            'video_count' => $item['contentDetails']['itemCount'],
                            'url' => "https://www.youtube.com/playlist?list={$item['id']}",
                        ];
                    }

                    return $playlists;
                }
            } catch (\Exception $e) {
                \Log::error('YouTube API Error (Playlists): ' . $e->getMessage());
            }

            return [];
        });
    }

    /**
     * Get video details
     */
    private function getVideoDetails($videoId)
    {
        try {
            $response = Http::get($this->baseUrl . '/videos', [
                'part' => 'snippet,statistics,contentDetails',
                'id' => $videoId,
                'key' => $this->apiKey
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (!empty($data['items'])) {
                    $video = $data['items'][0];
                    return [
                        'title' => $video['snippet']['title'],
                        'description' => $video['snippet']['description'],
                        'thumbnail' => $video['snippet']['thumbnails']['maxres']['url'] ?? 
                                     $video['snippet']['thumbnails']['high']['url'] ?? 
                                     $video['snippet']['thumbnails']['medium']['url'],
                        'duration' => $this->formatDuration($video['contentDetails']['duration']),
                        'views' => $this->formatNumber($video['statistics']['viewCount'] ?? 0),
                        'published_at' => $this->formatDate($video['snippet']['publishedAt']),
                    ];
                }
            }
        } catch (\Exception $e) {
            \Log::error('YouTube API Error (Video Details): ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Format large numbers (1.2K, 1.5M, etc.)
     */
    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }
        return number_format($number);
    }

    /**
     * Format duration (PT4M13S -> 4:13)
     */
    private function formatDuration($duration)
    {
        $interval = new \DateInterval($duration);
        $hours = $interval->h;
        $minutes = $interval->i;
        $seconds = $interval->s;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%d:%02d', $minutes, $seconds);
        }
    }

    /**
     * Format date (2024-01-15T10:30:00Z -> 2 days ago)
     */
    private function formatDate($dateString)
    {
        $date = new \DateTime($dateString);
        $now = new \DateTime();
        $diff = $now->diff($date);

        if ($diff->days > 0) {
            return $diff->days . ' day' . ($diff->days > 1 ? 's' : '') . ' ago';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        } elseif ($diff->i > 0) {
            return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
        } else {
            return 'Just now';
        }
    }

    /**
     * Search videos by query
     */
    public function searchVideos($query, $maxResults = 10)
    {
        return Cache::remember("youtube_search_{$query}_{$maxResults}", 1800, function () use ($query, $maxResults) {
            try {
                $response = Http::get($this->baseUrl . '/search', [
                    'part' => 'snippet',
                    'channelId' => $this->channelId,
                    'q' => $query,
                    'type' => 'video',
                    'maxResults' => $maxResults,
                    'key' => $this->apiKey
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $videos = [];

                    foreach ($data['items'] as $item) {
                        $videoId = $item['id']['videoId'];
                        $videoDetails = $this->getVideoDetails($videoId);
                        
                        if ($videoDetails) {
                            $videos[] = array_merge($videoDetails, [
                                'id' => $videoId,
                                'url' => "https://www.youtube.com/watch?v={$videoId}",
                                'embed_url' => "https://www.youtube.com/embed/{$videoId}",
                            ]);
                        }
                    }

                    return $videos;
                }
            } catch (\Exception $e) {
                \Log::error('YouTube API Error (Search): ' . $e->getMessage());
            }

            return [];
        });
    }
}
