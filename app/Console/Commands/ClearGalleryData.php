<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;

class ClearGalleryData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gallery:clear {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all gallery data (images and database records)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('Are you sure you want to delete ALL gallery data? This action cannot be undone.')) {
                $this->info('Operation cancelled.');
                return;
            }
        }

        $this->info('Clearing gallery data...');

        // Get all gallery images
        $galleryImages = GalleryImage::all();
        $deletedCount = 0;
        $fileCount = 0;

        foreach ($galleryImages as $image) {
            // Delete the file from storage
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
                $fileCount++;
            }
            
            // Delete the database record
            $image->delete();
            $deletedCount++;
        }

        $this->info("Deleted {$deletedCount} gallery records from database.");
        $this->info("Deleted {$fileCount} image files from storage.");
        $this->info('Gallery data cleared successfully!');
    }
}
