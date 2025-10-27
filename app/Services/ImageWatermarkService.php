<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;

class ImageWatermarkService
{
    protected $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Add watermark to an image using GD functions
     */
    public function addWatermark($imagePath, $outputPath = null)
    {
        try {
            // Get site settings
            $siteLogo = Setting::get('site_logo');
            $siteName = Setting::get('site_name', 'YSSC Football Club');
            $siteTagline = Setting::get('site_tagline', 'Victory Through Unity');
            $website = 'www.youngsilversportsclub.com';
            $contact = '+94 714 813 981';

            // Get image info
            $imageInfo = getimagesize($imagePath);
            if (!$imageInfo) {
                return false;
            }

            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $type = $imageInfo[2];

            // Create image resource based on type
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $image = imagecreatefromjpeg($imagePath);
                    break;
                case IMAGETYPE_PNG:
                    $image = imagecreatefrompng($imagePath);
                    break;
                case IMAGETYPE_GIF:
                    $image = imagecreatefromgif($imagePath);
                    break;
                default:
                    return false;
            }

            if (!$image) {
                return false;
            }

            // Calculate watermark position (bottom-right corner)
            $watermarkWidth = min($width * 0.25, 300);
            $watermarkHeight = 80;
            $x = $width - $watermarkWidth - 20;
            $y = $height - $watermarkHeight - 20;

            // Ensure watermark doesn't go outside image bounds
            $x = max(10, $x);
            $y = max(10, $y);

            // Create semi-transparent overlay
            $overlay = imagecreatetruecolor($watermarkWidth, $watermarkHeight);
            $black = imagecolorallocate($overlay, 0, 0, 0);
            $transparent = imagecolorallocatealpha($overlay, 0, 0, 0, 100); // Semi-transparent
            imagefill($overlay, 0, 0, $transparent);

            // Add logo if available
            if ($siteLogo && Storage::disk('public')->exists($siteLogo)) {
                $logoPath = Storage::disk('public')->path($siteLogo);
                $logoInfo = getimagesize($logoPath);
                if ($logoInfo) {
                    $logoWidth = min(40, $watermarkWidth * 0.2);
                    $logoHeight = $logoWidth;
                    
                    // Resize and place logo
                    $logo = imagecreatefromstring(file_get_contents($logoPath));
                    if ($logo) {
                        $resizedLogo = imagecreatetruecolor($logoWidth, $logoHeight);
                        imagecopyresampled($resizedLogo, $logo, 0, 0, 0, 0, $logoWidth, $logoHeight, $logoInfo[0], $logoInfo[1]);
                        imagecopy($overlay, $resizedLogo, 10, 10, 0, 0, $logoWidth, $logoHeight);
                        imagedestroy($logo);
                        imagedestroy($resizedLogo);
                    }
                }
            }

            // Add text
            $white = imagecolorallocate($overlay, 255, 255, 255);
            $yellow = imagecolorallocate($overlay, 255, 255, 0);
            
            // Add club name
            imagestring($overlay, 3, 10, 50, $siteName, $white);
            // Add tagline
            imagestring($overlay, 2, 10, 65, $siteTagline, $yellow);

            // Merge overlay with main image
            imagecopy($image, $overlay, $x, $y, 0, 0, $watermarkWidth, $watermarkHeight);

            // Save watermarked image
            $outputPath = $outputPath ?: $imagePath;
            switch ($type) {
                case IMAGETYPE_JPEG:
                    imagejpeg($image, $outputPath, 90);
                    break;
                case IMAGETYPE_PNG:
                    imagepng($image, $outputPath);
                    break;
                case IMAGETYPE_GIF:
                    imagegif($image, $outputPath);
                    break;
            }

            // Clean up
            imagedestroy($image);
            imagedestroy($overlay);

            return true;
        } catch (\Exception $e) {
            \Log::error('Watermarking failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Add simple text overlay to watermark
     */
    private function addSimpleTextOverlay($watermark, $text, $x, $y, $color)
    {
        try {
            // Create a simple text image
            $textImage = $this->manager->create(200, 20);
            $textImage->fill('transparent');
            
            // For now, we'll use a simple approach
            // In a real implementation, you might want to use imagestring or similar
            return true;
        } catch (\Exception $e) {
            \Log::warning('Text overlay failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Create a simple text watermark without font file
     */
    public function addSimpleWatermark($imagePath, $outputPath = null)
    {
        try {
            // Get site settings
            $siteName = Setting::get('site_name', 'YSSC Football Club');
            $siteTagline = Setting::get('site_tagline', 'Victory Through Unity');
            $website = 'www.youngsilversportsclub.com';
            $contact = '+94 714 813 981';

            // Load the image
            $image = $this->manager->read($imagePath);
            $width = $image->width();
            $height = $image->height();

            // Create a simple text overlay
            $text = $siteName . "\n" . $siteTagline . "\n" . $website . "\n" . $contact;
            
            // Add semi-transparent overlay
            $overlay = $this->manager->create($width, 100);
            $overlay->fill('rgba(0, 0, 0, 0.6)');
            
            // Place overlay at bottom
            $image->place($overlay, 'bottom', 0, 0);

            // Save watermarked image
            $outputPath = $outputPath ?: $imagePath;
            $image->save($outputPath);

            return true;
        } catch (\Exception $e) {
            \Log::error('Simple watermarking failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Add corner watermark (small logo in corner)
     */
    public function addCornerWatermark($imagePath, $outputPath = null)
    {
        try {
            $siteLogo = Setting::get('site_logo');
            
            if (!$siteLogo || !Storage::disk('public')->exists($siteLogo)) {
                return false;
            }

            // Load the image
            $image = $this->manager->read($imagePath);
            $width = $image->width();
            $height = $image->height();

            // Load logo
            $logoPath = Storage::disk('public')->path($siteLogo);
            $logo = $this->manager->read($logoPath);
            
            // Resize logo to appropriate size
            $logoSize = min($width * 0.1, $height * 0.1, 80);
            $logo->resize($logoSize, $logoSize);

            // Add semi-transparent background to logo
            $logoBg = $this->manager->create($logoSize + 20, $logoSize + 20);
            $logoBg->fill('rgba(0, 0, 0, 0.5)');
            $logoBg->place($logo, 'center');

            // Place in bottom-right corner
            $x = $width - $logoSize - 30;
            $y = $height - $logoSize - 30;

            $image->place($logoBg, 'top-left', $x, $y);

            // Save watermarked image
            $outputPath = $outputPath ?: $imagePath;
            $image->save($outputPath);

            return true;
        } catch (\Exception $e) {
            \Log::error('Corner watermarking failed: ' . $e->getMessage());
            return false;
        }
    }
}
