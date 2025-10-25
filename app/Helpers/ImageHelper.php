<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Generate optimized image attributes
     */
    public static function getOptimizedImageAttributes($src, $alt = '', $loading = 'lazy', $preload = false)
    {
        $attributes = [
            'src' => $src,
            'alt' => $alt,
            'loading' => $loading,
            'class' => 'max-w-full h-auto object-cover'
        ];
        
        if ($preload) {
            $attributes['data-preload'] = 'true';
        }
        
        if ($loading === 'lazy') {
            $attributes['data-src'] = $src;
            $attributes['src'] = 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMSIgaGVpZ2h0PSIxIiB2aWV3Qm94PSIwIDAgMSAxIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IHdpZHRoPSIxIiBoZWlnaHQ9IjEiIGZpbGw9IiNmM2Y0ZjYiLz48L3N2Zz4=';
        }
        
        return $attributes;
    }
    
    /**
     * Generate responsive image sizes
     */
    public static function getResponsiveSizes()
    {
        return [
            'mobile' => '100vw',
            'tablet' => '50vw',
            'desktop' => '33vw'
        ];
    }
    
    /**
     * Generate WebP image path if available
     */
    public static function getWebPImage($originalPath)
    {
        $webpPath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $originalPath);
        
        if (file_exists(public_path($webpPath))) {
            return $webpPath;
        }
        
        return $originalPath;
    }
    
    /**
     * Generate image with fallback
     */
    public static function getImageWithFallback($src, $fallback = null)
    {
        if (empty($src) && $fallback) {
            return $fallback;
        }
        
        return $src;
    }
}
