<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Manage Fixtures - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Manage Fixtures</h1>
                <a href="{{ route('admin.fixtures.create') }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500">
                    Add Fixture
                </a>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Match</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Venue</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($fixtures as $fixture)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-semibold">{{ $fixture->home_team }} vs {{ $fixture->away_team }}</div>
                                @if($fixture->competition)
                                    <div class="text-sm text-gray-500">{{ $fixture->competition }}</div>
                                @endif
                                @if($fixture->status === 'finished')
                                    <div class="text-sm font-semibold text-gray-700 mt-1">Score: {{ $fixture->home_score }} - {{ $fixture->away_score }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $fixture->match_date->format('M d, Y H:i') }}</td>
                            <td class="px-6 py-4 text-sm">{{ $fixture->venue ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($fixture->status === 'scheduled') bg-blue-100 text-blue-800
                                    @elseif($fixture->status === 'live') bg-green-100 text-green-800
                                    @elseif($fixture->status === 'finished') bg-gray-100 text-gray-800
                                    @elseif($fixture->status === 'postponed') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($fixture->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.fixtures.edit', $fixture) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                                <form action="{{ route('admin.fixtures.destroy', $fixture) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No fixtures found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $fixtures->links() }}
            </div>
        </div>
    </div>
</body>
</html>

