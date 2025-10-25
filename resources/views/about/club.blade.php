@extends('layouts.frontend')

@section('title', 'About Club - Young Silver Sports Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">About Club</h1>
            <p class="text-lg md:text-xl text-gray-800">Building Champions of Tomorrow</p>
        </div>
    </section>

    <!-- Hero Image Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="mb-12">
                <img src="{{ asset('images/about_us.jpeg') }}" alt="Young Silver Sports Club" class="rounded-lg shadow-2xl w-full h-auto object-contain">
            </div>

            <!-- Main Content -->
            <div class="prose prose-lg max-w-none">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">ABOUT CLUB</h2>
                    <p class="text-lg md:text-xl text-gray-700 leading-relaxed max-w-4xl mx-auto">
                        Young Silver Sports Club has a long, rich and colourful history. The people of Young Silver love their soccer and it has always been the sport of choice for young and old in the community. The roots of the club based in Wellawatte founded in Year <strong class="text-yellow-600">1967</strong> and registered at Football Federation of Sri Lanka in Year <strong class="text-yellow-600">1984</strong>.
                    </p>
                    <div class="mt-8">
                        <p class="text-2xl font-bold text-yellow-600 italic">"Building Champions of Tomorrow"</p>
                    </div>
                </div>

                <!-- Vision Section -->
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg p-8 md:p-12 mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">VISION</h3>
                    <div class="space-y-4 text-gray-900 text-base md:text-lg">
                        <p>The Young Silver Sports Club believes that youth is a time of promise. It is our vision to:</p>
                        <ul class="space-y-3 list-none">
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Fulfill that promise by helping youth learn lifelong values through soccer.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>To help build a promising future for the children of Young Silver and leave a legacy with a lasting and meaningful impact on Young Silver youth.</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0 text-gray-900" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>Inspire, encourage, and enable participation in soccer</span>
                            </li>
                        </ul>
                        <p class="mt-6">
                            We are committed to enjoying all aspects of football, unconditional support for each other, a never ending quest to realise our potential, innovative approaches to our vision, effectively identifying our strengths within our people, identifying and improving upon our weaknesses and by being truly accountable to the vision of the club.
                        </p>
                        <p class="font-bold text-xl mt-6">
                            The Young Silver Sports Club will be the best football club we can be.
                        </p>
                    </div>
                </div>

                <!-- Mission Section -->
                <div class="bg-gray-50 rounded-lg p-8 md:p-12">
                    <h3 class="text-3xl font-bold text-gray-900 mb-6">MISSION</h3>
                    <div class="space-y-4 text-gray-700 text-base md:text-lg">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span>Promote the game of soccer and to provide opportunities for all youths</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span>Emphasize the development of self-esteem, good sportsmanship, fitness, achievement, teamwork, and skill as well as encourage courtesy, proper conduct and respect for authority by the players, officials, and spectators through the playing of the game.</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-6 h-6 mr-3 mt-1 flex-shrink-0 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span>Provide educational opportunities to develop all players, coaches, referees, and administrators.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Our Club Section -->
    <section class="py-16 bg-gradient-to-r from-yellow-400 to-yellow-500">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Join Our Club</h2>
                <p class="text-lg md:text-xl text-gray-800 mb-8">
                    Become part of our football family and start your journey with Young Silver Sports Club today. We welcome players of all skill levels and ages who share our passion for football.
                </p>
                
                <!-- Membership Benefits -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-6">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Community</h3>
                        <p class="text-sm text-gray-800">Join a supportive football community that values teamwork and friendship.</p>
                    </div>
                    
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-6">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Training</h3>
                        <p class="text-sm text-gray-800">Professional coaching and regular training sessions to improve your skills.</p>
                    </div>
                    
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-6">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Competitions</h3>
                        <p class="text-sm text-gray-800">Participate in local and national football competitions and tournaments.</p>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('member-application.index') }}" class="bg-white text-gray-900 px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                        Apply for Membership
                    </a>
                    <a href="{{ route('contact') }}" class="bg-gray-900 text-white px-8 py-4 rounded-lg font-bold text-lg hover:bg-gray-800 transition shadow-lg">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
