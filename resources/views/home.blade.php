@extends('layouts.frontend')

@section('title', 'Home - Young Silver Sports Club')
@section('description', 'Welcome to Young Silver Sports Club - Premier football club in Wellawatte, Colombo. Building champions of tomorrow since 1967. Join our community for football excellence.')
@section('keywords', 'Young Silver Sports Club, YSSC, football club, Colombo, Wellawatte, Sri Lanka football, youth football, sports club, football training, Cooray Park, football academy, Sri Lanka sports, home')
@section('og_title', 'Young Silver Sports Club - Building Champions of Tomorrow')
@section('og_description', 'Welcome to Young Silver Sports Club - Premier football club in Wellawatte, Colombo. Building champions of tomorrow since 1967.')
@section('og_type', 'website')
@section('twitter_title', 'Young Silver Sports Club - Building Champions of Tomorrow')
@section('twitter_description', 'Welcome to Young Silver Sports Club - Premier football club in Wellawatte, Colombo. Building champions of tomorrow since 1967.')

@section('content')
    <!-- Hero Slider Section -->
    @if($sliders->count() > 0)
    <section class="relative bg-gray-900" id="heroSlider">
        <div class="slider-container relative overflow-hidden" style="height: 400px;">
        <style>
            @media (min-width: 640px) {
                .slider-container { height: 500px !important; }
            }
            @media (min-width: 768px) {
                .slider-container { height: 600px !important; }
            }
            @media (min-width: 1024px) {
                .slider-container { height: 700px !important; }
            }
        </style>
        
        <style>
            /* Slider animations */
            .animate-fade-in {
                animation: fadeIn 1s ease-in-out;
            }
            
            .animate-fade-in-delay {
                animation: fadeIn 1s ease-in-out 0.3s both;
            }
            
            .animate-fade-in-delay-2 {
                animation: fadeIn 1s ease-in-out 0.6s both;
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        
            @foreach($sliders as $index => $slider)
            <div class="slider-item absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-slide="{{ $index }}">
                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover" loading="eager" data-preload="true">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
                <div class="absolute inset-0 flex items-end pb-8 sm:pb-12 lg:pb-16">
                    <div class="container mx-auto px-4">
                        <div class="max-w-4xl mx-auto text-center text-white">
                            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4 animate-fade-in">{{ $slider->title }}</h1>
                            @if($slider->description)
                                <p class="text-sm sm:text-base md:text-lg lg:text-xl mb-4 sm:mb-6 animate-fade-in-delay">{{ $slider->description }}</p>
                            @endif
                            @if($slider->button_text && $slider->button_link)
                                <a href="{{ $slider->button_link }}" class="inline-block bg-yellow-400 text-gray-900 px-4 py-2 sm:px-6 sm:py-3 rounded-lg font-bold text-sm sm:text-base hover:bg-yellow-500 transition animate-fade-in-delay-2">
                                    {{ $slider->button_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($sliders->count() > 1)
        <!-- Slider Controls -->
        <div class="absolute bottom-4 sm:bottom-6 lg:bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2 sm:space-x-3 z-20">
            @foreach($sliders as $index => $slider)
            <button class="slider-dot w-2 h-2 sm:w-3 sm:h-3 rounded-full transition-all {{ $index === 0 ? 'bg-yellow-400 w-6 sm:w-8' : 'bg-white/50 hover:bg-white/75' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
        
        <!-- Navigation Arrows -->
        <button class="absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-2 sm:p-3 rounded-full z-20 backdrop-blur-sm" id="prevSlide">
            <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-2 sm:p-3 rounded-full z-20 backdrop-blur-sm" id="nextSlide">
            <svg class="w-4 h-4 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        @endif
    </section>
    @else
    <!-- Default Hero Section (if no sliders) -->
    <section class="relative bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 text-gray-900 py-12 sm:py-16 lg:py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6">Welcome to YSSC Football Club</h1>
                <p class="text-lg sm:text-xl md:text-2xl mb-6 sm:mb-8 text-gray-800">
                    Where passion meets excellence. Join us on our journey to greatness.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="{{ route('about.club') }}" class="bg-gray-900 text-white px-6 py-3 sm:px-8 rounded-lg font-semibold hover:bg-gray-800 transition text-center">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}" class="bg-white text-gray-900 px-6 py-3 sm:px-8 rounded-lg font-semibold hover:bg-gray-100 transition text-center">
                        Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

        <!-- Upcoming Fixtures & Latest News - Side by Side -->
        <section class="py-8 sm:py-12 lg:py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-10 lg:gap-12 max-w-7xl mx-auto">
                    <!-- Upcoming Fixtures -->
                    <div>
                        <div class="text-center mb-6 sm:mb-8">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Upcoming Fixtures</h2>
                            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                        </div>

                        @if($upcomingFixtures->count() > 0)
                            <div class="space-y-4">
                                @foreach($upcomingFixtures as $fixture)
                                    <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-yellow-400 transition">
                                        <div class="text-sm text-gray-600 mb-4">{{ $fixture->competition }}</div>
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="text-center flex-1">
                                                <div class="flex flex-col items-center gap-2">
                                                    @if($fixture->home_team_logo)
                                                        <img src="{{ asset('storage/' . $fixture->home_team_logo) }}" 
                                                             alt="{{ $fixture->home_team }}" 
                                                             class="w-10 h-10 sm:w-12 sm:h-12 object-cover rounded-lg border-2 border-gray-300">
                                                    @else
                                                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center">
                                                            <span class="text-gray-500 text-xs font-bold">{{ substr($fixture->home_team, 0, 2) }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="font-bold text-sm sm:text-lg text-center">{{ $fixture->home_team }}</div>
                                                </div>
                                            </div>
                                            <div class="text-lg sm:text-2xl font-bold text-yellow-500 px-2 sm:px-4">VS</div>
                                            <div class="text-center flex-1">
                                                <div class="flex flex-col items-center gap-2">
                                                    @if($fixture->away_team_logo)
                                                        <img src="{{ asset('storage/' . $fixture->away_team_logo) }}" 
                                                             alt="{{ $fixture->away_team }}" 
                                                             class="w-10 h-10 sm:w-12 sm:h-12 object-cover rounded-lg border-2 border-gray-300">
                                                    @else
                                                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center">
                                                            <span class="text-gray-500 text-xs font-bold">{{ substr($fixture->away_team, 0, 2) }}</span>
                                                        </div>
                                                    @endif
                                                    <div class="font-bold text-sm sm:text-lg text-center">{{ $fixture->away_team }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center text-sm text-gray-600">
                                            <div>{{ $fixture->match_date->format('M d, Y') }}</div>
                                            <div>{{ $fixture->match_date->format('h:i A') }}</div>
                                            @if($fixture->venue)
                                                <div class="mt-2 text-yellow-600">{{ $fixture->venue }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-gray-600">No upcoming fixtures at the moment.</p>
                        @endif

                        <div class="text-center mt-6">
                            <a href="{{ route('sportspress.fixtures') }}" class="inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                                View More Fixtures →
                            </a>
                        </div>
                    </div>

                    <!-- Latest News -->
                    <div>
                        <div class="text-center mb-6 sm:mb-8">
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4">Latest News</h2>
                            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                        </div>

                        @if($latestNews->count() > 0)
                            <div class="space-y-4">
                                @foreach($latestNews as $news)
                                    <article class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden hover:border-yellow-400 transition news-article">
                                        <div class="flex flex-col sm:flex-row">
                                            @if($news->featured_image)
                                                <div class="w-full sm:w-32 h-32 sm:h-32 news-image-container">
                                                    <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-full object-cover" loading="lazy">
                                                </div>
                                            @else
                                                <div class="w-full sm:w-32 h-32 sm:h-32 bg-gradient-to-br from-yellow-400 to-yellow-500"></div>
                                            @endif
                                            <div class="p-3 sm:p-4 flex-1">
                                                <div class="text-xs text-gray-600 mb-1">{{ $news->published_at->format('M d, Y') }}</div>
                                                <h3 class="text-base sm:text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $news->title }}</h3>
                                                @if($news->excerpt)
                                                    <p class="text-gray-600 text-xs sm:text-sm mb-2 line-clamp-2">{{ Str::limit($news->excerpt, 60) }}</p>
                                                @endif
                                                <a href="{{ route('news.show', $news->slug) }}" class="text-yellow-600 font-semibold hover:text-yellow-700 text-xs sm:text-sm">
                                                    Read More →
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-gray-600">No news articles available yet.</p>
                        @endif

                        <div class="text-center mt-6">
                            <a href="{{ route('news') }}" class="inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                                View More News →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Latest Gallery Images -->
    @if($latestImages->count() > 0)
        <section class="py-8 sm:py-12 lg:py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-8 sm:mb-12">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Latest Gallery</h2>
                    <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-4 max-w-6xl mx-auto">
                    @foreach($latestImages as $image)
                        <div class="group relative aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition gallery-image-container">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300" loading="lazy" style="position: relative; z-index: 2;">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end" style="position: relative; z-index: 3;">
                                <div class="p-4 text-white w-full">
                                    <h3 class="font-bold text-sm">{{ $image->category ?: $image->title }}</h3>
                                </div>
                            </div>
                            <!-- Small gallery title overlay -->
                            <div class="gallery-title-overlay">
                                {{ $image->category ?: $image->title }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('gallery') }}" class="inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        View Full Gallery
                    </a>
                </div>
            </div>
        </section>
    @endif

        <!-- Sponsors Slider -->
    @if($sponsors->count() > 0)
        <section class="py-16 bg-gray-50 sponsors-section">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Sponsors</h2>
                    <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                    
                    <!-- Debug info (remove in production) -->
                    @if(config('app.debug'))
                        <div class="text-center mb-4 text-sm text-gray-500">
                            Sponsors count: {{ $sponsors->count() }}
                        </div>
                    @endif
                </div>

                <div class="max-w-6xl mx-auto overflow-hidden">
                    <div class="sponsor-slider-wrapper">
                        <div class="sponsor-slider flex items-center space-x-8 md:space-x-12">
                            @foreach($sponsors->concat($sponsors) as $sponsor)
                                <div class="sponsor-slide flex-shrink-0 px-4">
                                    @if($sponsor->logo)
                                        <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" class="max-h-24 w-auto hover:scale-110 transition-transform" loading="eager">
                                    @else
                                        <div class="text-gray-400 text-sm text-center px-8 py-4 bg-gray-100 rounded-lg min-w-[120px]">{{ $sponsor->name }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('sponsors') }}" class="inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        View All Sponsors
                    </a>
                </div>
            </div>
        </section>
    @else
        <!-- No Sponsors Message -->
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Sponsors</h2>
                <div class="w-24 h-1 bg-yellow-400 mx-auto mb-8"></div>
                <p class="text-gray-600 mb-8">We're proud to partner with amazing sponsors who support our club.</p>
                <a href="{{ route('sponsors') }}" class="inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                    View All Sponsors
                </a>
            </div>
        </section>
    @endif

    <!-- Call to Action -->
    <section class="py-16 bg-gradient-to-r from-yellow-400 to-yellow-500">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Join Our Community</h2>
            <p class="text-xl text-gray-800 mb-8 max-w-2xl mx-auto">
                Be part of something special. Support your local football club.
            </p>
            <a href="{{ route('contact') }}" class="inline-block bg-gray-900 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-800 transition">
                Get Involved
            </a>
        </div>
    </section>

    <style>
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.8s ease-out;
        }
        .animate-fade-in-delay {
            animation: fade-in 0.8s ease-out 0.2s backwards;
        }
        .animate-fade-in-delay-2 {
            animation: fade-in 0.8s ease-out 0.4s backwards;
        }
        
        /* Fix news image overlay issues */
        .news-image-container {
            position: relative;
            z-index: 1;
            overflow: hidden;
            background: #f9fafb;
        }
        
        .news-image-container img {
            position: relative;
            z-index: 2;
            display: block;
            opacity: 1;
            visibility: visible;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Ensure news articles are above any background elements */
        .news-article {
            position: relative;
            z-index: 5;
            background: white;
        }
        
        /* Fix gallery image overlay issues */
        .gallery-image-container {
            position: relative;
            z-index: 1;
            overflow: hidden;
            background: #f9fafb;
        }
        
        .gallery-image-container img {
            position: relative;
            z-index: 2;
            display: block;
            opacity: 1;
            visibility: visible;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .gallery-image-container .absolute {
            position: absolute;
            z-index: 3;
        }
        
        /* Small gallery title overlay */
        .gallery-title-overlay {
            position: absolute;
            top: 8px;
            left: 8px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
            z-index: 4;
            backdrop-filter: blur(4px);
            max-width: calc(100% - 16px);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        /* Mobile responsive improvements */
        @media (max-width: 640px) {
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            .gallery-title-overlay {
                font-size: 0.625rem;
                padding: 2px 6px;
                max-width: calc(100% - 12px);
            }
            
            /* Mobile slider improvements */
            .slider-container {
                min-height: 300px;
            }
            
            .slider-dot {
                min-width: 8px;
                min-height: 8px;
            }
            
            .slider-dot.active {
                min-width: 24px;
            }
        }
        
        /* Sponsor Slider Animation */
        .sponsor-slider {
            animation: scroll-sponsors 30s linear infinite;
        }
        .sponsor-slider:hover {
            animation-play-state: paused;
        }
        @keyframes scroll-sponsors {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>

    <script>
        // Hero Slider Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sliderItems = document.querySelectorAll('.slider-item');
            const sliderDots = document.querySelectorAll('.slider-dot');
            const prevBtn = document.getElementById('prevSlide');
            const nextBtn = document.getElementById('nextSlide');
            let currentSlide = 0;
            let autoplayInterval;

            if (sliderItems.length > 1) {
                function showSlide(index) {
                    sliderItems.forEach((item, i) => {
                        if (i === index) {
                            item.classList.remove('opacity-0', 'z-0');
                            item.classList.add('opacity-100', 'z-10');
                        } else {
                            item.classList.remove('opacity-100', 'z-10');
                            item.classList.add('opacity-0', 'z-0');
                        }
                    });

                    sliderDots.forEach((dot, i) => {
                        if (i === index) {
                            dot.classList.remove('bg-white/50', 'w-3');
                            dot.classList.add('bg-yellow-400', 'w-8');
                        } else {
                            dot.classList.remove('bg-yellow-400', 'w-8');
                            dot.classList.add('bg-white/50', 'w-3');
                        }
                    });
                }

                function nextSlide() {
                    currentSlide = (currentSlide + 1) % sliderItems.length;
                    showSlide(currentSlide);
                }

                function prevSlide() {
                    currentSlide = (currentSlide - 1 + sliderItems.length) % sliderItems.length;
                    showSlide(currentSlide);
                }

                function startAutoplay() {
                    autoplayInterval = setInterval(nextSlide, 5000);
                }

                function stopAutoplay() {
                    clearInterval(autoplayInterval);
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        stopAutoplay();
                        nextSlide();
                        startAutoplay();
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        stopAutoplay();
                        prevSlide();
                        startAutoplay();
                    });
                }

                sliderDots.forEach((dot, index) => {
                    dot.addEventListener('click', function() {
                        stopAutoplay();
                        currentSlide = index;
                        showSlide(currentSlide);
                        startAutoplay();
                    });
                });

                startAutoplay();

                // Pause on hover
                const sliderContainer = document.querySelector('.slider-container');
                if (sliderContainer) {
                    sliderContainer.addEventListener('mouseenter', stopAutoplay);
                    sliderContainer.addEventListener('mouseleave', startAutoplay);
                }
            }
        });
    </script>
@endsection
