<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin Dashboard - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Sliders</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['sliders'] }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">News</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['news'] }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Team</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['team'] }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Fixtures</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['fixtures'] }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Gallery</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['gallery_images'] }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Sponsors</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['sponsors'] }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Products</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['products'] }}</div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Office Bearers</div>
                    <div class="text-2xl font-bold text-yellow-600">{{ $stats['office_bearers'] }}</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <a href="{{ route('admin.sliders.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Slider
                    </a>
                    <a href="{{ route('admin.news.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + News
                    </a>
                    <a href="{{ route('admin.team.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Player
                    </a>
                    <a href="{{ route('admin.fixtures.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Fixture
                    </a>
                    <a href="{{ route('admin.gallery.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Image
                    </a>
                    <a href="{{ route('admin.sponsors.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Sponsor
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Product
                    </a>
                    <a href="{{ route('admin.office-bearers.create') }}" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Office Bearer
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent News -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Recent News</h2>
                    @if($recentNews->count() > 0)
                        <div class="space-y-3">
                            @foreach($recentNews as $news)
                                <div class="border-b pb-3">
                                    <a href="{{ route('admin.news.edit', $news) }}" class="font-semibold text-gray-900 hover:text-yellow-600">
                                        {{ $news->title }}
                                    </a>
                                    <div class="text-sm text-gray-600 mt-1">
                                        {{ $news->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No news articles yet.</p>
                    @endif
                </div>

                <!-- Upcoming Fixtures -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Upcoming Fixtures</h2>
                    @if($upcomingFixtures->count() > 0)
                        <div class="space-y-3">
                            @foreach($upcomingFixtures as $fixture)
                                <div class="border-b pb-3">
                                    <a href="{{ route('admin.fixtures.edit', $fixture) }}" class="font-semibold text-gray-900 hover:text-yellow-600">
                                        {{ $fixture->home_team }} vs {{ $fixture->away_team }}
                                    </a>
                                    <div class="text-sm text-gray-600 mt-1">
                                        {{ $fixture->match_date->format('M d, Y h:i A') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No upcoming fixtures scheduled.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>

