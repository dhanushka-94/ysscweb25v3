@extends('layouts.frontend')

@section('title', 'Office Bearers - YSSC Football Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Office Bearers</h1>
            <p class="text-xl text-gray-800">Meet our leadership team</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            @if($sortedOfficeBearers->count() > 0)
                <div class="max-w-6xl mx-auto">
                    @foreach($sortedOfficeBearers as $category => $bearers)
                        <!-- Category Section -->
                        <div class="mb-16">
                            <!-- Category Header -->
                            <div class="text-center mb-10">
                                <h2 class="text-3xl font-bold text-gray-900 mb-3">{{ $category }}</h2>
                                <div class="w-24 h-1 bg-yellow-400 mx-auto"></div>
                            </div>
                            
                            <!-- Office Bearers Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($bearers as $bearer)
                                    <div class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden hover:border-yellow-400 hover:shadow-lg transition">
                                        @if($bearer->photo)
                                            <div class="aspect-square w-full">
                                                <img src="{{ asset('storage/' . $bearer->photo) }}" alt="{{ $bearer->name }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="aspect-square w-full bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center">
                                                <div class="text-6xl font-bold text-white">{{ substr($bearer->name, 0, 1) }}</div>
                                            </div>
                                        @endif
                                        <div class="p-6">
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $bearer->name }}</h3>
                                            <p class="text-yellow-600 font-semibold mb-4">{{ $bearer->position }}</p>
                                            @if($bearer->bio)
                                                <p class="text-gray-600 text-sm mb-4">{{ $bearer->bio }}</p>
                                            @endif
                                            @if($bearer->email || $bearer->phone)
                                                <div class="border-t pt-4 mt-4 text-sm text-gray-600 space-y-1">
                                                    @if($bearer->email)
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                                            </svg>
                                                            <a href="mailto:{{ $bearer->email }}" class="hover:text-yellow-600">{{ $bearer->email }}</a>
                                                        </div>
                                                    @endif
                                                    @if($bearer->phone)
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                                            </svg>
                                                            <a href="tel:{{ $bearer->phone }}" class="hover:text-yellow-600">{{ $bearer->phone }}</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <p class="text-gray-600 text-lg">Office bearers information will be updated soon.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

