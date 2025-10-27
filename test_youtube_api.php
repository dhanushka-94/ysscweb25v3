<?php
// Quick test script for YouTube API integration
require_once 'vendor/autoload.php';

use App\Services\YouTubeService;

echo "=== YouTube API Test ===\n\n";

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Test API configuration
$apiKey = $_ENV['YOUTUBE_API_KEY'] ?? null;
$channelId = $_ENV['YOUTUBE_CHANNEL_ID'] ?? null;

echo "API Key: " . ($apiKey ? "✅ Set" : "❌ Missing") . "\n";
echo "Channel ID: " . ($channelId ? "✅ Set ($channelId)" : "❌ Missing") . "\n\n";

if ($apiKey && $channelId) {
    try {
        $youtubeService = new YouTubeService();
        
        echo "Testing channel info...\n";
        $channelInfo = $youtubeService->getChannelInfo();
        
        if ($channelInfo) {
            echo "✅ Channel Info Retrieved:\n";
            echo "  Name: " . $channelInfo['name'] . "\n";
            echo "  Subscribers: " . $channelInfo['subscriber_count'] . "\n";
            echo "  Videos: " . $channelInfo['video_count'] . "\n";
            echo "  Views: " . $channelInfo['view_count'] . "\n\n";
        } else {
            echo "❌ Failed to retrieve channel info\n\n";
        }
        
        echo "Testing latest videos...\n";
        $videos = $youtubeService->getLatestVideos(3);
        
        if (!empty($videos)) {
            echo "✅ Latest Videos Retrieved (" . count($videos) . " videos):\n";
            foreach ($videos as $i => $video) {
                echo "  " . ($i + 1) . ". " . $video['title'] . " (" . $video['views'] . " views)\n";
            }
        } else {
            echo "❌ Failed to retrieve videos\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "❌ Configuration incomplete. Please check your .env file.\n";
}

echo "\n=== Test Complete ===\n";
