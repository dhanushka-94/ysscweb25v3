@extends('layouts.frontend')

@section('title', 'Sponsors - YSSC Football Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Our Sponsors</h1>
            <p class="text-xl text-gray-800">Thank you to our amazing partners</p>
        </div>
    </section>

    <!-- Sponsors -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            @if($sponsors->count() > 0)
                <div class="max-w-6xl mx-auto space-y-16">
                    @foreach(['platinum', 'gold', 'silver', 'bronze'] as $tier)
                        @if($sponsors->has($tier))
                            <div>
                                <h2 class="text-3xl font-bold text-center mb-8
                                    @if($tier === 'platinum') text-gray-800
                                    @elseif($tier === 'gold') text-yellow-600
                                    @elseif($tier === 'silver') text-gray-500
                                    @else text-yellow-700
                                    @endif">
                                    {{ ucfirst($tier) }} Sponsors
                                </h2>
                                <div class="grid gap-8
                                    @if($tier === 'platinum') grid-cols-1 md:grid-cols-2
                                    @elseif($tier === 'gold') grid-cols-2 md:grid-cols-3
                                    @else grid-cols-2 md:grid-cols-4
                                    @endif">
                                    @foreach($sponsors[$tier] as $sponsor)
                                        <div class="bg-white border-2 border-gray-200 rounded-lg p-8 hover:border-yellow-400 transition flex flex-col items-center justify-center text-center">
                                            @if($sponsor->logo)
                                                <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" class="max-h-24 w-auto mb-4">
                                            @endif
                                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $sponsor->name }}</h3>
                                            @if($sponsor->description)
                                                <p class="text-sm text-gray-600 mb-4">{{ $sponsor->description }}</p>
                                            @endif
                                            @if($sponsor->website)
                                                <a href="{{ $sponsor->website }}" target="_blank" rel="noopener noreferrer" class="text-yellow-600 hover:text-yellow-700 font-semibold text-sm">
                                                    Visit Website →
                                                </a>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">Sponsor information will be updated soon.</p>
                </div>
            @endif

            <!-- Become a Sponsor CTA -->
            <div class="mt-20 max-w-4xl mx-auto text-center bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg p-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Become a Sponsor</h2>
                <p class="text-xl text-gray-800 mb-8">
                    Join our family of supporters and help us achieve greatness. Partner with YSSC FC today!
                </p>
                <a href="{{ route('contact') }}" class="inline-block bg-gray-900 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-800 transition">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>
@endsection

