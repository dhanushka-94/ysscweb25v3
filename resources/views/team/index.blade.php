@extends('layouts.frontend')

@section('title', 'Our Team - ' . config('app.name'))
@section('description', 'Meet our talented team members from different categories including main team, youth teams, coaching staff, and management.')

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Team</h1>
        <p class="text-lg md:text-xl text-gray-800">Meet the talented individuals who make up our football club family</p>
    </div>
</section>


<!-- Team Categories -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($categories->count() > 0)
            @foreach($categories as $category)
                @if($category->teams->count() > 0)
                    <div class="mb-16">
                        <!-- Category Header -->
                        <div class="text-center mb-12">
                            <div class="inline-flex items-center space-x-3 mb-4">
                                <div class="w-8 h-8 rounded-full border-2 border-gray-300" style="background-color: {{ $category->color }}"></div>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $category->name }}</h2>
                            </div>
                            @if($category->description)
                                <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $category->description }}</p>
                            @endif
                        </div>

                        <!-- Team Members Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 2xl:grid-cols-7 gap-6">
                            @foreach($category->teams as $member)
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <!-- Member Photo -->
                                    <div class="relative">
                                        @if($member->photo)
                                            <img src="{{ asset('storage/' . $member->photo) }}" 
                                                 alt="{{ $member->name }}" 
                                                 class="w-full h-64 object-cover object-top">
                                        @else
                                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <!-- Jersey Number Badge -->
                                        @if($member->jersey_number)
                                            <div class="absolute top-4 right-4 bg-yellow-400 text-gray-900 px-3 py-1 rounded-full font-bold text-lg">
                                                #{{ $member->jersey_number }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Member Details -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $member->name }}</h3>
                                        <p class="text-yellow-600 font-semibold mb-2">{{ $member->position }}</p>
                                        
                                        @if($member->nationality)
                                            <p class="text-gray-600 text-sm mb-3">{{ $member->nationality }}</p>
                                        @endif

                                        @if($member->bio)
                                            <p class="text-gray-700 text-sm leading-relaxed">{{ Str::limit($member->bio, 100) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Team Members Found</h3>
                <p class="text-gray-600 mb-4">Team members will be displayed here once they are added.</p>
                <a href="{{ route('member-application.create') }}" class="text-yellow-600 hover:text-yellow-700 font-medium">
                    Apply to join our team
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Want to Join Our Team?</h2>
        <p class="text-xl text-gray-300 mb-8">Be part of our football family and showcase your talent</p>
        <a href="{{ route('member-application.create') }}" 
           class="inline-flex items-center bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Apply Now
        </a>
    </div>
</div>
@endsection
