<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>@yield('title', 'YSSC Football Club')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'Young Silver Sports Club - Premier football club in Wellawatte, Colombo. Building champions of tomorrow since 1967. Join our community for football excellence.')">
    <meta name="keywords" content="@yield('keywords', 'YSSC, Young Silver Sports Club, football club, Colombo, Wellawatte, Sri Lanka football, youth football, sports club, football training, Cooray Park')">
    <meta name="author" content="Young Silver Sports Club">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'YSSC Football Club - Building Champions of Tomorrow')">
    <meta property="og:description" content="@yield('og_description', 'Young Silver Sports Club - Premier football club in Wellawatte, Colombo. Building champions of tomorrow since 1967.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="YSSC Football Club">
    <meta property="og:locale" content="en_US">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'YSSC Football Club - Building Champions of Tomorrow')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Young Silver Sports Club - Premier football club in Wellawatte, Colombo. Building champions of tomorrow since 1967.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-image.jpg'))">
    <meta name="twitter:site" content="@YSSCFootball">
    <meta name="twitter:creator" content="@YSSCFootball">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="theme-color" content="#facc15">
    <meta name="msapplication-TileColor" content="#facc15">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="YSSC Football Club">
    
    <!-- Performance & SEO -->
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="YSSC Football Club">
    <meta name="msapplication-tooltip" content="Young Silver Sports Club - Building Champions of Tomorrow">
    <meta name="msapplication-starturl" content="/">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="{{ asset('storage/' . \App\Models\Setting::get('site_logo', 'images/logo.png')) }}" as="image">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="dns-prefetch" href="//www.google.com">
    <link rel="dns-prefetch" href="//www.facebook.com">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "SportsClub",
        "name": "Young Silver Sports Club",
        "alternateName": "YSSC",
        "description": "Premier football club in Wellawatte, Colombo. Building champions of tomorrow since 1967.",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('storage/' . \App\Models\Setting::get('site_logo', 'images/logo.png')) }}",
        "foundingDate": "1967",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "27, Vincent Lane",
            "addressLocality": "Wellawatte",
            "addressRegion": "Colombo",
            "postalCode": "06",
            "addressCountry": "LK"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+94-714-813-981",
            "contactType": "customer service",
            "email": "info@youngsilversportsclub.com"
        },
        "sameAs": [
            "https://www.facebook.com/YoungSilverSportsClub",
            "https://www.youtube.com/@youngsilversportsclub",
            "https://www.instagram.com/youngsilversportsclub"
        ],
        "sport": "Football",
        "areaServed": {
            "@type": "City",
            "name": "Colombo"
        }
    }
    </script>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Yellow theme colors */
        :root {
            --color-yellow-50: #fefce8;
            --color-yellow-100: #fef9c3;
            --color-yellow-200: #fef08a;
            --color-yellow-300: #fde047;
            --color-yellow-400: #facc15;
            --color-yellow-500: #eab308;
            --color-yellow-600: #ca8a04;
            --color-yellow-700: #a16207;
        }
        
        /* Mobile Responsive Improvements */
        @media (max-width: 640px) {
            h1 { font-size: 1.875rem !important; line-height: 1.2; }
            h2 { font-size: 1.5rem !important; line-height: 1.3; }
            h3 { font-size: 1.25rem !important; }
            .container { padding-left: 1rem; padding-right: 1rem; }
        }
        
        /* Ensure images are responsive */
        img { max-width: 100%; height: auto; }
        
            /* Responsive tables */
            @media (max-width: 768px) {
                table { display: block; overflow-x: auto; white-space: nowrap; }
            }
            
            /* Football Background Animation */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-20px) rotate(10deg); }
            }
            
            .fixed svg {
                animation: float 20s ease-in-out infinite;
            }
            
            .fixed svg:nth-child(2) {
                animation-delay: 2s;
                animation-duration: 25s;
            }
            
            .fixed svg:nth-child(3) {
                animation-delay: 4s;
                animation-duration: 18s;
            }
            
            .fixed svg:nth-child(4) {
                animation-delay: 6s;
                animation-duration: 22s;
            }
            
            .fixed svg:nth-child(5) {
                animation-delay: 8s;
                animation-duration: 30s;
            }
            
            /* Dropdown Menu Smooth Transitions */
            .dropdown-menu {
                transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
                opacity: 0;
                transform: translateY(-10px);
                pointer-events: none;
            }
            
            .dropdown-menu:not(.hidden) {
                opacity: 1;
                transform: translateY(0);
                pointer-events: auto;
            }
            
            /* Content cards should have white background */
            section {
                position: relative;
            }
        </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-yellow-50 text-gray-900 relative">
    <!-- Football-themed Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-5 pointer-events-none">
        <svg class="absolute top-10 left-10 w-32 h-32 text-yellow-400" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M50 5 L55 25 L75 25 L60 37 L65 55 L50 43 L35 55 L40 37 L25 25 L45 25 Z"/>
        </svg>
        <svg class="absolute top-40 right-20 w-24 h-24 text-gray-400" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M50 5 L55 25 L75 25 L60 37 L65 55 L50 43 L35 55 L40 37 L25 25 L45 25 Z"/>
        </svg>
        <svg class="absolute bottom-20 left-1/4 w-28 h-28 text-yellow-300" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M50 5 L55 25 L75 25 L60 37 L65 55 L50 43 L35 55 L40 37 L25 25 L45 25 Z"/>
        </svg>
        <svg class="absolute bottom-40 right-1/3 w-20 h-20 text-gray-300" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M50 5 L55 25 L75 25 L60 37 L65 55 L50 43 L35 55 L40 37 L25 25 L45 25 Z"/>
        </svg>
        <svg class="absolute top-1/2 left-1/2 w-36 h-36 text-yellow-200" viewBox="0 0 100 100" fill="currentColor">
            <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="2"/>
            <path d="M50 5 L55 25 L75 25 L60 37 L65 55 L50 43 L35 55 L40 37 L25 25 L45 25 Z"/>
        </svg>
    </div>
    
    <!-- Main Content Wrapper -->
    <div class="relative z-10">
    <!-- Header & Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-1"></div>
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    @php
                        $siteLogo = \App\Models\Setting::get('site_logo');
                        $siteName = \App\Models\Setting::get('site_name', 'YSSC Football Club');
                        $siteTagline = \App\Models\Setting::get('site_tagline', 'Victory Through Unity');
                    @endphp
                    
                    @if($siteLogo)
                        <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="h-12 w-auto object-contain">
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">{{ $siteName }}</h1>
                            @if($siteTagline)
                                <p class="text-xs text-gray-600">{{ $siteTagline }}</p>
                            @endif
                        </div>
                    @else
                        <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-900">Y</span>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold text-gray-900">{{ $siteName }}</h1>
                            @if($siteTagline)
                                <p class="text-xs text-gray-600">{{ $siteTagline }}</p>
                            @endif
                        </div>
                    @endif
                </a>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:flex items-center space-x-6">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-yellow-500 font-medium transition uppercase">HOME</a>
                        
                        <!-- About Dropdown -->
                        <div class="relative dropdown-container">
                            <button class="text-gray-700 hover:text-yellow-500 font-medium transition flex items-center space-x-1 uppercase">
                                <span>ABOUT</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="dropdown-menu absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 hidden z-50">
                                <a href="{{ route('about.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 uppercase">Our History</a>
                                <a href="{{ route('about.club') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 uppercase">The Club</a>
                                <a href="{{ route('about.arena') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 uppercase">Arena</a>
                                <a href="{{ route('about.office-bearers') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 uppercase">Office Bearers</a>
                                <a href="{{ route('about.bank-details') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 uppercase">Bank Details</a>
                            </div>
                        </div>

                        <!-- SportsPress Dropdown -->
                        <div class="relative dropdown-container">
                            <button class="text-gray-700 hover:text-yellow-500 font-medium transition flex items-center space-x-1 uppercase">
                                <span>SPORTSPRESS</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="dropdown-menu absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 hidden z-50">
                                <a href="{{ route('sportspress.league') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 uppercase">League</a>
                                <a href="{{ route('sportspress.fixtures') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-600 uppercase">Fixtures</a>
                            </div>
                        </div>

                        <a href="{{ route('sponsors') }}" class="text-gray-700 hover:text-yellow-500 font-medium transition uppercase">SPONSORS</a>
                        <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-yellow-500 font-medium transition uppercase">GALLERY</a>
                        <a href="{{ route('shop') }}" class="text-gray-700 hover:text-yellow-500 font-medium transition uppercase">SHOP</a>
                        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-yellow-500 font-medium transition uppercase">CONTACT US</a>
                        <a href="{{ route('news') }}" class="text-gray-700 hover:text-yellow-500 font-medium transition uppercase">NEWS</a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-yellow-600 hover:text-yellow-700 font-medium transition uppercase">ADMIN</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 font-medium transition uppercase">LOGOUT</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-yellow-500 font-medium transition uppercase">LOGIN</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

                <!-- Mobile Navigation -->
                <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4">
                    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-medium uppercase">HOME</a>
                    <div class="py-2">
                        <span class="block text-gray-900 font-semibold mb-1 uppercase">ABOUT</span>
                        <a href="{{ route('about.history') }}" class="block py-1 pl-4 text-gray-700 hover:text-yellow-500 uppercase">Our History</a>
                        <a href="{{ route('about.club') }}" class="block py-1 pl-4 text-gray-700 hover:text-yellow-500 uppercase">The Club</a>
                        <a href="{{ route('about.arena') }}" class="block py-1 pl-4 text-gray-700 hover:text-yellow-500 uppercase">Arena</a>
                        <a href="{{ route('about.office-bearers') }}" class="block py-1 pl-4 text-gray-700 hover:text-yellow-500 uppercase">Office Bearers</a>
                        <a href="{{ route('about.bank-details') }}" class="block py-1 pl-4 text-gray-700 hover:text-yellow-500 uppercase">Bank Details</a>
                    </div>
                    <div class="py-2">
                        <span class="block text-gray-900 font-semibold mb-1 uppercase">SPORTSPRESS</span>
                        <a href="{{ route('sportspress.league') }}" class="block py-1 pl-4 text-gray-700 hover:text-yellow-500 uppercase">League</a>
                        <a href="{{ route('sportspress.fixtures') }}" class="block py-1 pl-4 text-gray-700 hover:text-yellow-500 uppercase">Fixtures</a>
                    </div>
                    <a href="{{ route('sponsors') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-medium uppercase">SPONSORS</a>
                    <a href="{{ route('gallery') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-medium uppercase">GALLERY</a>
                    <a href="{{ route('shop') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-medium uppercase">SHOP</a>
                    <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-medium uppercase">CONTACT US</a>
                    <a href="{{ route('news') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-medium uppercase">NEWS</a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 text-yellow-600 hover:text-yellow-700 font-medium uppercase">ADMIN</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block py-2 text-left w-full text-gray-700 hover:text-red-600 font-medium uppercase">LOGOUT</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-yellow-500 font-medium uppercase">LOGIN</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-1"></div>
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & About -->
                <div>
                    @php
                        $footerLogo = \App\Models\Setting::get('site_logo');
                        $footerSiteName = \App\Models\Setting::get('site_name', 'YSSC Football Club');
                        $footerTagline = \App\Models\Setting::get('site_tagline', 'Victory Through Unity');
                    @endphp
                    
                    <div class="flex items-center space-x-3 mb-4">
                        @if($footerLogo)
                            <img src="{{ asset('storage/' . $footerLogo) }}" alt="{{ $footerSiteName }}" class="h-12 w-auto object-contain">
                        @else
                            <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-gray-900">Y</span>
                            </div>
                        @endif
                        <div>
                            <h3 class="text-lg font-bold text-yellow-400">{{ $footerSiteName }}</h3>
                            @if($footerTagline)
                                <p class="text-xs text-gray-400">{{ $footerTagline }}</p>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm">
                        A passionate football club committed to excellence, teamwork, and community spirit.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-yellow-400">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about.history') }}" class="text-gray-300 hover:text-yellow-400 transition">Our History</a></li>
                        <li><a href="{{ route('about.office-bearers') }}" class="text-gray-300 hover:text-yellow-400 transition">Office Bearers</a></li>
                        <li><a href="{{ route('sportspress.fixtures') }}" class="text-gray-300 hover:text-yellow-400 transition">Fixtures</a></li>
                        <li><a href="{{ route('news') }}" class="text-gray-300 hover:text-yellow-400 transition">Latest News</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-4 text-yellow-400">Contact</h3>
                    <p class="text-sm font-semibold text-yellow-300 mb-2">CLUB HOUSE</p>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>27, Vincent Lane, Wellawatte,<br>Colombo 06, Sri Lanka</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span>+94 714 813 981</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>info@youngsilversportsclub.com</span>
                        </li>
                    </ul>
                </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-yellow-400">Follow Us</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/YoungSilverSportsClub" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center hover:bg-yellow-500 transition" title="Facebook">
                                <svg class="w-5 h-5 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center hover:bg-yellow-500 transition" title="YouTube">
                                <svg class="w-5 h-5 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center hover:bg-yellow-500 transition" title="Instagram">
                                <svg class="w-5 h-5 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8">
                    <div class="text-center text-sm text-gray-400 space-y-2">
                        <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'YSSC Football Club') }}. All rights reserved.</p>
                        <p class="text-gray-500">
                            Developed by <a href="https://olexto.com" target="_blank" rel="noopener noreferrer" class="text-yellow-400 hover:text-yellow-300 font-semibold transition">olexto Digital Solutions (Pvt) Ltd</a>
                        </p>
                    </div>
                </div>
        </div>
    </footer>

    </div>
    <!-- End Main Content Wrapper -->

    <!-- Mobile Menu & Dropdown Script -->
    <script>
        // Mobile Menu Toggle
        const menuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Desktop Dropdown Menu - Fix Quick Disappearing Issue
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownContainers = document.querySelectorAll('.dropdown-container');
            
            dropdownContainers.forEach(container => {
                const menu = container.querySelector('.dropdown-menu');
                let timeout;
                
                // Show dropdown on hover
                container.addEventListener('mouseenter', function() {
                    clearTimeout(timeout);
                    menu.classList.remove('hidden');
                });
                
                // Hide dropdown with delay
                container.addEventListener('mouseleave', function() {
                    timeout = setTimeout(() => {
                        menu.classList.add('hidden');
                    }, 200); // 200ms delay before hiding
                });
                
                // Keep dropdown open when hovering over menu items
                menu.addEventListener('mouseenter', function() {
                    clearTimeout(timeout);
                });
                
                menu.addEventListener('mouseleave', function() {
                    timeout = setTimeout(() => {
                        menu.classList.add('hidden');
                    }, 200);
                });
            });
        });
    </script>
</body>
</html>

