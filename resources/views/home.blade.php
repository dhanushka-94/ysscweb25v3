@extends('layouts.frontend')

@section('title', 'Home - YSSC Football Club')

@section('content')
    <!-- Hero Slider Section -->
    @if($sliders->count() > 0)
    <section class="relative bg-gray-900" id="heroSlider">
        <div class="slider-container relative overflow-hidden" style="height: 500px;">
        <style>
            @media (min-width: 768px) {
                .slider-container { height: 700px !important; }
            }
            @media (min-width: 1024px) {
                .slider-container { height: 800px !important; }
            }
        </style>
            @foreach($sliders as $index => $slider)
            <div class="slider-item absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}" data-slide="{{ $index }}">
                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-4">
                        <div class="max-w-2xl text-white">
                            <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in">{{ $slider->title }}</h1>
                            @if($slider->description)
                                <p class="text-xl md:text-2xl mb-8 animate-fade-in-delay">{{ $slider->description }}</p>
                            @endif
                            @if($slider->button_text && $slider->button_link)
                                <a href="{{ $slider->button_link }}" class="inline-block bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-500 transition animate-fade-in-delay-2">
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
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
            @foreach($sliders as $index => $slider)
            <button class="slider-dot w-3 h-3 rounded-full transition-all {{ $index === 0 ? 'bg-yellow-400 w-8' : 'bg-white/50 hover:bg-white/75' }}" data-slide="{{ $index }}"></button>
            @endforeach
        </div>
        
        <!-- Navigation Arrows -->
        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full z-20 backdrop-blur-sm" id="prevSlide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full z-20 backdrop-blur-sm" id="nextSlide">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        @endif
    </section>
    @else
    <!-- Default Hero Section (if no sliders) -->
    <section class="relative bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 text-gray-900 py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Welcome to YSSC Football Club</h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-800">
                    Where passion meets excellence. Join us on our journey to greatness.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('about.club') }}" class="bg-gray-900 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}" class="bg-white text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Get In Touch
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

        <!-- Upcoming Fixtures & Latest News - Side by Side -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
                    <!-- Upcoming Fixtures -->
                    <div>
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Upcoming Fixtures</h2>
                            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                        </div>

                        @if($upcomingFixtures->count() > 0)
                            <div class="space-y-4">
                                @foreach($upcomingFixtures as $fixture)
                                    <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-yellow-400 transition">
                                        <div class="text-sm text-gray-600 mb-4">{{ $fixture->competition }}</div>
                                        <div class="flex items-center justify-between mb-4">
                                            <div class="text-center flex-1">
                                                <div class="font-bold text-lg">{{ $fixture->home_team }}</div>
                                            </div>
                                            <div class="text-2xl font-bold text-yellow-500 px-4">VS</div>
                                            <div class="text-center flex-1">
                                                <div class="font-bold text-lg">{{ $fixture->away_team }}</div>
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
                                View All Fixtures
                            </a>
                        </div>
                    </div>

                    <!-- Latest News -->
                    <div>
                        <div class="text-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4">Latest News</h2>
                            <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                        </div>

                        @if($latestNews->count() > 0)
                            <div class="space-y-4">
                                @foreach($latestNews as $news)
                                    <article class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden hover:border-yellow-400 transition">
                                        <div class="flex flex-col sm:flex-row">
                                            @if($news->featured_image)
                                                <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full sm:w-32 h-32 object-cover">
                                            @else
                                                <div class="w-full sm:w-32 h-32 bg-gradient-to-br from-yellow-400 to-yellow-500"></div>
                                            @endif
                                            <div class="p-4 flex-1">
                                                <div class="text-xs text-gray-600 mb-1">{{ $news->published_at->format('M d, Y') }}</div>
                                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $news->title }}</h3>
                                                @if($news->excerpt)
                                                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($news->excerpt, 80) }}</p>
                                                @endif
                                                <a href="{{ route('news.show', $news->slug) }}" class="text-yellow-600 font-semibold hover:text-yellow-700 text-sm">
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
                                View All News
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Latest Gallery Images -->
    @if($latestImages->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Latest Gallery</h2>
                    <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-6xl mx-auto">
                    @foreach($latestImages as $image)
                        <div class="group relative aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                                <div class="p-4 text-white w-full">
                                    <h3 class="font-bold text-sm">{{ $image->title }}</h3>
                                </div>
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
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Sponsors</h2>
                    <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                </div>

                <div class="max-w-6xl mx-auto overflow-hidden">
                    <div class="sponsor-slider flex items-center justify-center space-x-8 md:space-x-12">
                        @foreach($sponsors->concat($sponsors) as $sponsor)
                            <div class="sponsor-slide flex-shrink-0 px-4">
                                @if($sponsor->logo)
                                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" class="max-h-24 w-auto hover:scale-110 transition-transform">
                                @else
                                    <div class="text-gray-400 text-sm text-center px-8">{{ $sponsor->name }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('sponsors') }}" class="inline-block bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        View All Sponsors
                    </a>
                </div>
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
