@extends('layouts.frontend')

@section('title', 'Arena - Young Silver Sports Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Arena</h1>
            <p class="text-lg md:text-xl text-gray-800">Home of Champions</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Arena Image -->
            <div class="mb-12">
                <img src="{{ asset('images/arena.png') }}" alt="Cooray Park Arena" class="rounded-lg shadow-2xl w-full h-auto max-h-[500px] object-cover">
            </div>

            <!-- Arena Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Location Card -->
                <div class="bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-lg p-8 shadow-xl">
                    <div class="flex items-start mb-4">
                        <svg class="w-8 h-8 mr-4 flex-shrink-0 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-2">Location</h3>
                            <p class="text-lg text-gray-900 font-semibold">Cooray Park</p>
                            <p class="text-gray-800">Wellawatte North</p>
                            <p class="text-gray-800">Colombo 06, Sri Lanka</p>
                        </div>
                    </div>
                </div>

                <!-- Surface Card -->
                <div class="bg-gray-900 rounded-lg p-8 shadow-xl">
                    <div class="flex items-start mb-4">
                        <svg class="w-8 h-8 mr-4 flex-shrink-0 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                        </svg>
                        <div>
                            <h3 class="text-2xl font-bold text-yellow-400 mb-2">Surface</h3>
                            <p class="text-lg text-white font-semibold">Natural Grass</p>
                            <p class="text-gray-300 mt-2">Professional quality playing surface</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="mt-12 bg-gray-50 rounded-lg p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">About Cooray Park</h2>
                <p class="text-lg text-gray-700 text-center leading-relaxed max-w-3xl mx-auto">
                    Cooray Park is the proud home ground of Young Silver Sports Club. Located in the heart of Wellawatte North, this historic venue has witnessed countless memorable matches and has been the training ground for generations of talented footballers. The natural grass surface provides an authentic football experience and is meticulously maintained to ensure the best playing conditions.
                </p>
            </div>

            <!-- Map Section -->
            <div class="mt-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Find Our Arena</h3>
                <div class="rounded-lg overflow-hidden shadow-xl">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0691234567!2d79.8586900!3d6.8774770!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTInMzkuMSJOIDc5wrA1MSczMS4zIkU!5e0!3m2!1sen!2slk!4v1234567890" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full"
                    ></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
