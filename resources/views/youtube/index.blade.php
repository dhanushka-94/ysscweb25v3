@extends('layouts.frontend')

@section('title', 'Videos - ' . config('app.name'))
@section('description', 'Watch our latest videos, match highlights, training sessions, and club activities on our official YouTube channel.')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Videos</h1>
        <p class="text-lg md:text-xl text-gray-800">Watch our latest content on YouTube</p>
    </div>
</section>

<!-- Breadcrumbs -->
<div class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="flex items-center">
                        @if($breadcrumb['url'])
                            <a href="{{ $breadcrumb['url'] }}" class="text-yellow-600 hover:text-yellow-700 font-medium">
                                {{ $breadcrumb['title'] }}
                            </a>
                        @else
                            <span class="text-gray-500 font-medium">{{ $breadcrumb['title'] }}</span>
                        @endif
                        @if(!$loop->last)
                            <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>

<!-- Channel Info -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-red-600 rounded-full mb-6">
                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ $channelInfo['name'] }}</h2>
            <p class="text-xl text-gray-600 mb-4">{{ $channelInfo['handle'] }}</p>
            <p class="text-gray-700 max-w-3xl mx-auto mb-8">{{ $channelInfo['description'] }}</p>
            <a href="{{ $channelInfo['url'] }}" target="_blank" 
               class="inline-flex items-center bg-red-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                </svg>
                Visit Our Channel
            </a>
        </div>
    </div>
</section>

<!-- Latest Videos -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest Videos</h2>
            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($latestVideos as $video)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        <a href="{{ $video['url'] }}" target="_blank" class="block">
                            <img src="{{ $video['thumbnail'] }}" alt="{{ $video['title'] }}" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-sm px-2 py-1 rounded">
                                {{ $video['duration'] }}
                            </div>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $video['title'] }}</h3>
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $video['description'] }}</p>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $video['views'] }} views</span>
                            <span>{{ $video['published_at'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Playlists -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Playlists</h2>
            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($playlists as $playlist)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="relative">
                        <a href="{{ $playlist['url'] }}" target="_blank" class="block">
                            <img src="{{ $playlist['thumbnail'] }}" alt="{{ $playlist['title'] }}" 
                                 class="w-full h-48 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-75 text-white text-sm px-2 py-1 rounded">
                                {{ $playlist['video_count'] }} videos
                            </div>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $playlist['title'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $playlist['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Don't Miss Our Latest Content!</h2>
        <p class="text-xl text-gray-300 mb-8">Subscribe to our YouTube channel for the latest videos, match highlights, and behind-the-scenes content.</p>
        <a href="{{ $channelInfo['url'] }}" target="_blank" 
           class="inline-flex items-center bg-red-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-red-700 transition-colors">
            <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
            </svg>
            Subscribe Now
        </a>
    </div>
</section>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
