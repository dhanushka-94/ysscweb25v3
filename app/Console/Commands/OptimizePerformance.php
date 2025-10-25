<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class OptimizePerformance extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'optimize:performance';

    /**
     * The console command description.
     */
    protected $description = 'Optimize application performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting performance optimization...');

        // Clear and cache configurations
        $this->call('config:clear');
        $this->call('config:cache');
        
        // Clear and cache routes
        $this->call('route:clear');
        $this->call('route:cache');
        
        // Clear and cache views
        $this->call('view:clear');
        $this->call('view:cache');
        
        // Optimize autoloader
        $this->call('optimize:clear');
        $this->call('optimize');
        
        // Clear application cache
        $this->call('cache:clear');
        
        // Clear compiled views
        $this->call('view:clear');
        
        // Optimize images (if intervention/image is installed)
        if (class_exists('Intervention\Image\ImageManager')) {
            $this->optimizeImages();
        }
        
        $this->info('Performance optimization completed!');
    }
    
    /**
     * Optimize images in storage
     */
    private function optimizeImages()
    {
        $this->info('Optimizing images...');
        
        $storagePath = storage_path('app/public');
        $this->optimizeDirectory($storagePath);
        
        $this->info('Images optimized successfully!');
    }
    
    /**
     * Recursively optimize images in directory
     */
    private function optimizeDirectory($directory)
    {
        $files = File::allFiles($directory);
        
        foreach ($files as $file) {
            $extension = strtolower($file->getExtension());
            
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $this->optimizeImage($file->getPathname());
            }
        }
    }
    
    /**
     * Optimize individual image
     */
    private function optimizeImage($path)
    {
        try {
            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($path);
            
            // Resize if too large
            if ($image->width() > 1920 || $image->height() > 1080) {
                $image->scaleDown(1920, 1080);
            }
            
            // Save with optimization
            $image->save($path, 85); // 85% quality
            
        } catch (\Exception $e) {
            $this->warn("Could not optimize image: {$path}");
        }
    }
}
