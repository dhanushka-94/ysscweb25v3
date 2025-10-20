@extends('layouts.frontend')

@section('title', 'League - YSSC Football Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">League</h1>
            <p class="text-xl text-gray-800">Competition standings and results</p>
        </div>
    </section>

    <!-- League Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Recent Results -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Recent Results</h2>
                    @if($fixtures->where('status', 'finished')->count() > 0)
                        <div class="space-y-4">
                            @foreach($fixtures->where('status', 'finished')->take(5) as $fixture)
                                <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-600">{{ $fixture->match_date->format('M d') }}</div>
                                        <div class="flex items-center gap-4 flex-1 justify-center">
                                            <div class="text-right flex-1">
                                                <span class="font-semibold">{{ $fixture->home_team }}</span>
                                            </div>
                                            <div class="text-xl font-bold text-yellow-500">
                                                {{ $fixture->home_score }} - {{ $fixture->away_score }}
                                            </div>
                                            <div class="text-left flex-1">
                                                <span class="font-semibold">{{ $fixture->away_team }}</span>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-600">{{ $fixture->competition }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No results available yet.</p>
                    @endif
                </div>

                <!-- All Fixtures -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">All Fixtures</h2>
                    @if($fixtures->count() > 0)
                        <div class="space-y-4">
                            @foreach($fixtures as $fixture)
                                <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
                                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                                        <div class="md:w-1/4 text-sm text-gray-600">
                                            {{ $fixture->match_date->format('M d, Y') }}
                                        </div>
                                        <div class="md:w-2/4 flex items-center justify-center gap-4">
                                            <div class="text-center flex-1 font-semibold">{{ $fixture->home_team }}</div>
                                            @if($fixture->status === 'finished')
                                                <div class="text-xl font-bold text-yellow-500">
                                                    {{ $fixture->home_score }} - {{ $fixture->away_score }}
                                                </div>
                                            @else
                                                <div class="text-xl font-bold text-yellow-500">VS</div>
                                            @endif
                                            <div class="text-center flex-1 font-semibold">{{ $fixture->away_team }}</div>
                                        </div>
                                        <div class="md:w-1/4 text-right">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                                @if($fixture->status === 'scheduled') bg-blue-100 text-blue-800
                                                @elseif($fixture->status === 'live') bg-green-100 text-green-800
                                                @elseif($fixture->status === 'finished') bg-gray-100 text-gray-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ ucfirst($fixture->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $fixtures->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">No fixtures available yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

