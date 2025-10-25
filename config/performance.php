<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Performance Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains performance optimization settings for the application.
    |
    */

    'lazy_loading' => [
        'enabled' => true,
        'threshold' => 0.01,
        'root_margin' => '50px 0px',
    ],

    'image_optimization' => [
        'enabled' => true,
        'webp_support' => true,
        'lazy_loading' => true,
        'preload_critical' => true,
    ],

    'caching' => [
        'static_assets' => 31536000, // 1 year
        'html_pages' => 3600, // 1 hour
        'api_responses' => 300, // 5 minutes
    ],

    'compression' => [
        'enabled' => true,
        'level' => 6,
        'types' => [
            'text/plain',
            'text/html',
            'text/css',
            'text/javascript',
            'application/javascript',
            'application/json',
            'image/svg+xml',
        ],
    ],

    'preloading' => [
        'critical_images' => true,
        'critical_css' => true,
        'critical_js' => false,
    ],

    'monitoring' => [
        'enabled' => env('APP_DEBUG', false),
        'log_performance' => env('LOG_PERFORMANCE', false),
    ],
];
