@extends('layouts.frontend')

@section('title', 'Fixtures - YSSC Football Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Fixtures</h1>
            <p class="text-xl text-gray-800">View all matches and results</p>
        </div>
    </section>

    <!-- Fixtures List -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            @if($fixtures->count() > 0)
                <div class="max-w-4xl mx-auto space-y-6">
                    @foreach($fixtures as $fixture)
                        <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-yellow-400 transition">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="text-sm text-gray-600 mb-2">
                                        {{ $fixture->match_date->format('l, M d, Y \a\t h:i A') }}
                                    </div>
                                    @if($fixture->competition)
                                        <div class="text-xs text-yellow-600 font-semibold mb-2">{{ $fixture->competition }}</div>
                                    @endif
                                </div>

                                <div class="flex items-center justify-center gap-6 flex-1">
                                    <div class="text-center flex-1">
                                        <div class="flex flex-col items-center gap-2">
                                            @if($fixture->home_team_logo)
                                                <img src="{{ asset('storage/' . $fixture->home_team_logo) }}" 
                                                     alt="{{ $fixture->home_team }}" 
                                                     class="w-16 h-16 object-cover rounded-lg border-2 border-gray-300">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs font-bold">{{ substr($fixture->home_team, 0, 2) }}</span>
                                                </div>
                                            @endif
                                            <div class="font-bold text-lg text-gray-900">{{ $fixture->home_team }}</div>
                                        </div>
                                    </div>
                                    
                                    @if($fixture->status === 'finished' && $fixture->home_score !== null)
                                        <div class="text-2xl font-bold text-yellow-500 px-4">
                                            {{ $fixture->home_score }} - {{ $fixture->away_score }}
                                        </div>
                                    @else
                                        <div class="text-2xl font-bold text-yellow-500 px-4">VS</div>
                                    @endif
                                    
                                    <div class="text-center flex-1">
                                        <div class="flex flex-col items-center gap-2">
                                            @if($fixture->away_team_logo)
                                                <img src="{{ asset('storage/' . $fixture->away_team_logo) }}" 
                                                     alt="{{ $fixture->away_team }}" 
                                                     class="w-16 h-16 object-cover rounded-lg border-2 border-gray-300">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center">
                                                    <span class="text-gray-500 text-xs font-bold">{{ substr($fixture->away_team, 0, 2) }}</span>
                                                </div>
                                            @endif
                                            <div class="font-bold text-lg text-gray-900">{{ $fixture->away_team }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center flex-1">
                                    @if($fixture->venue)
                                        <div class="text-sm text-gray-600 mb-1">{{ $fixture->venue }}</div>
                                    @endif
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        @if($fixture->status === 'scheduled') bg-blue-100 text-blue-800
                                        @elseif($fixture->status === 'live') bg-green-100 text-green-800
                                        @elseif($fixture->status === 'finished') bg-gray-100 text-gray-800
                                        @elseif($fixture->status === 'postponed') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($fixture->status) }}
                                    </span>
                                </div>
                            </div>
                            
                            @if($fixture->notes)
                                <div class="mt-4 pt-4 border-t border-gray-200 text-sm text-gray-600">
                                    {{ $fixture->notes }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $fixtures->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600">No fixtures available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

