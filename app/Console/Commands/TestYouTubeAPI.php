<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\YouTubeService;

class TestYouTubeAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'youtube:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test YouTube API integration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== YouTube API Test ===');
        $this->newLine();

        // Test API configuration
        $apiKey = config('services.youtube.api_key');
        $channelId = config('services.youtube.channel_id');

        $this->info('API Key: ' . ($apiKey ? '✅ Set' : '❌ Missing'));
        $this->info('Channel ID: ' . ($channelId ? "✅ Set ($channelId)" : '❌ Missing'));
        $this->newLine();

        if (!$apiKey || !$channelId) {
            $this->error('❌ Configuration incomplete. Please check your .env file.');
            return;
        }

        try {
            $youtubeService = new YouTubeService();
            
            // Debug: Show what channel ID we're using
            $this->info('Using Channel ID: ' . $youtubeService->getChannelId());
            
            $this->info('Testing channel info...');
            $channelInfo = $youtubeService->getChannelInfo();
            
            if ($channelInfo) {
                $this->info('✅ Channel Info Retrieved:');
                $this->line('  Name: ' . $channelInfo['name']);
                $this->line('  Subscribers: ' . $channelInfo['subscriber_count']);
                $this->line('  Videos: ' . $channelInfo['video_count']);
                $this->line('  Views: ' . $channelInfo['view_count']);
                $this->newLine();
            } else {
                $this->error('❌ Failed to retrieve channel info');
                $this->newLine();
            }
            
            $this->info('Testing latest videos...');
            $videos = $youtubeService->getLatestVideos(3);
            
            if (!empty($videos)) {
                $this->info('✅ Latest Videos Retrieved (' . count($videos) . ' videos):');
                foreach ($videos as $i => $video) {
                    $this->line('  ' . ($i + 1) . '. ' . $video['title'] . ' (' . $video['views'] . ' views)');
                }
            } else {
                $this->error('❌ Failed to retrieve videos');
                $this->line('This might be because:');
                $this->line('  - Channel has no videos yet');
                $this->line('  - Videos are private/unlisted');
                $this->line('  - API quota exceeded');
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }

        $this->newLine();
        $this->info('=== Test Complete ===');
    }
}
