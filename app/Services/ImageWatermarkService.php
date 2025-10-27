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
            $watermarkWidth = min($width * 0.35, 400); // Increased width for two-column layout
            $watermarkHeight = 80; // Fixed height for consistent layout
            $x = $width - $watermarkWidth - 15;
            $y = $height - $watermarkHeight - 15;

            // Ensure watermark doesn't go outside image bounds
            $x = max(10, $x);
            $y = max(10, $y);

            // Create semi-transparent overlay (lighter shading)
            $overlay = imagecreatetruecolor($watermarkWidth, $watermarkHeight);
            $transparent = imagecolorallocatealpha($overlay, 0, 0, 0, 60); // Lighter semi-transparent
            imagefill($overlay, 0, 0, $transparent);

            // Two-column layout: Logo on left, text on right
            $logoSize = 60; // Fixed logo size
            $logoX = 10;
            $logoY = ($watermarkHeight - $logoSize) / 2; // Center vertically
            $textX = $logoSize + 20; // Start text after logo
            $textY = 15; // Top of text area

            // Add logo if available (left column)
            if ($siteLogo && Storage::disk('public')->exists($siteLogo)) {
                $logoPath = Storage::disk('public')->path($siteLogo);
                $logoInfo = getimagesize($logoPath);
                if ($logoInfo) {
                    // Create logo with transparent background
                    $logo = imagecreatefromstring(file_get_contents($logoPath));
                    if ($logo) {
                        // Create transparent background for logo
                        $logoBg = imagecreatetruecolor($logoSize + 10, $logoSize + 10);
                        $transparentBg = imagecolorallocatealpha($logoBg, 0, 0, 0, 127);
                        imagefill($logoBg, 0, 0, $transparentBg);
                        imagecolortransparent($logoBg, $transparentBg);
                        
                        // Resize logo maintaining aspect ratio
                        $resizedLogo = imagecreatetruecolor($logoSize, $logoSize);
                        imagealphablending($resizedLogo, false);
                        imagesavealpha($resizedLogo, true);
                        $transparentColor = imagecolorallocatealpha($resizedLogo, 0, 0, 0, 127);
                        imagefill($resizedLogo, 0, 0, $transparentColor);
                        imagecolortransparent($resizedLogo, $transparentColor);
                        
                        imagecopyresampled($resizedLogo, $logo, 0, 0, 0, 0, $logoSize, $logoSize, $logoInfo[0], $logoInfo[1]);
                        
                        // Place logo on overlay (left column)
                        imagecopy($overlay, $resizedLogo, $logoX, $logoY, 0, 0, $logoSize, $logoSize);
                        
                        imagedestroy($logo);
                        imagedestroy($resizedLogo);
                        imagedestroy($logoBg);
                    }
                }
            }

            // Add text in right column
            $white = imagecolorallocate($overlay, 255, 255, 255);
            $yellow = imagecolorallocate($overlay, 255, 255, 0);
            $lightGray = imagecolorallocate($overlay, 200, 200, 200);
            
            // Add site name (top right)
            imagestring($overlay, 4, $textX, $textY, $siteName, $white);
            // Add tagline (bottom right)
            imagestring($overlay, 3, $textX, $textY + 25, $siteTagline, $yellow);
            // Add website (bottom right)
            imagestring($overlay, 2, $textX, $textY + 45, $website, $lightGray);

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

            // Load logo
            $logoPath = Storage::disk('public')->path($siteLogo);
            $logoInfo = getimagesize($logoPath);
            if (!$logoInfo) {
                return false;
            }

            $logoSize = min($width * 0.08, $height * 0.08, 60);
            
            // Create logo with transparent background
            $logo = imagecreatefromstring(file_get_contents($logoPath));
            if ($logo) {
                // Create transparent background for logo
                $logoBg = imagecreatetruecolor($logoSize + 10, $logoSize + 10);
                $transparentBg = imagecolorallocatealpha($logoBg, 0, 0, 0, 127);
                imagefill($logoBg, 0, 0, $transparentBg);
                imagecolortransparent($logoBg, $transparentBg);
                
                // Resize logo maintaining aspect ratio
                $resizedLogo = imagecreatetruecolor($logoSize, $logoSize);
                imagealphablending($resizedLogo, false);
                imagesavealpha($resizedLogo, true);
                $transparentColor = imagecolorallocatealpha($resizedLogo, 0, 0, 0, 127);
                imagefill($resizedLogo, 0, 0, $transparentColor);
                imagecolortransparent($resizedLogo, $transparentColor);
                
                imagecopyresampled($resizedLogo, $logo, 0, 0, 0, 0, $logoSize, $logoSize, $logoInfo[0], $logoInfo[1]);
                
                // Place logo on transparent background
                imagecopy($logoBg, $resizedLogo, 5, 5, 0, 0, $logoSize, $logoSize);
                
                // Place in bottom-right corner
                $x = $width - $logoSize - 20;
                $y = $height - $logoSize - 20;
                
                imagecopy($image, $logoBg, $x, $y, 0, 0, $logoSize + 10, $logoSize + 10);
                
                imagedestroy($logo);
                imagedestroy($resizedLogo);
                imagedestroy($logoBg);
            }

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

            imagedestroy($image);
            return true;
        } catch (\Exception $e) {
            \Log::error('Corner watermarking failed: ' . $e->getMessage());
            return false;
        }
    }
}
