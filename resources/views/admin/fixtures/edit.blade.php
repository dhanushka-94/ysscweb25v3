<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Edit Fixture - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.fixtures.index') }}" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Fixtures
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Fixture</h1>

                <form action="{{ route('admin.fixtures.update', $fixture) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="home_team" class="block text-sm font-semibold text-gray-700 mb-2">Home Team *</label>
                                <input type="text" id="home_team" name="home_team" required
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('home_team') border-red-500 @enderror"
                                    value="{{ old('home_team', $fixture->home_team) }}">
                                @error('home_team')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="away_team" class="block text-sm font-semibold text-gray-700 mb-2">Away Team *</label>
                                <input type="text" id="away_team" name="away_team" required
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('away_team') border-red-500 @enderror"
                                    value="{{ old('away_team', $fixture->away_team) }}">
                                @error('away_team')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="competition" class="block text-sm font-semibold text-gray-700 mb-2">Competition</label>
                            <input type="text" id="competition" name="competition"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('competition') border-red-500 @enderror"
                                value="{{ old('competition', $fixture->competition) }}">
                            @error('competition')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="match_date" class="block text-sm font-semibold text-gray-700 mb-2">Match Date & Time *</label>
                                <input type="datetime-local" id="match_date" name="match_date" required
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('match_date') border-red-500 @enderror"
                                    value="{{ old('match_date', $fixture->match_date->format('Y-m-d\TH:i')) }}">
                                @error('match_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="venue" class="block text-sm font-semibold text-gray-700 mb-2">Venue</label>
                                <input type="text" id="venue" name="venue"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('venue') border-red-500 @enderror"
                                    value="{{ old('venue', $fixture->venue) }}">
                                @error('venue')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('status') border-red-500 @enderror">
                                <option value="scheduled" {{ old('status', $fixture->status) === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="live" {{ old('status', $fixture->status) === 'live' ? 'selected' : '' }}>Live</option>
                                <option value="finished" {{ old('status', $fixture->status) === 'finished' ? 'selected' : '' }}>Finished</option>
                                <option value="postponed" {{ old('status', $fixture->status) === 'postponed' ? 'selected' : '' }}>Postponed</option>
                                <option value="cancelled" {{ old('status', $fixture->status) === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="home_score" class="block text-sm font-semibold text-gray-700 mb-2">Home Score</label>
                                <input type="number" id="home_score" name="home_score" min="0"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('home_score') border-red-500 @enderror"
                                    value="{{ old('home_score', $fixture->home_score) }}">
                                @error('home_score')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="away_score" class="block text-sm font-semibold text-gray-700 mb-2">Away Score</label>
                                <input type="number" id="away_score" name="away_score" min="0"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('away_score') border-red-500 @enderror"
                                    value="{{ old('away_score', $fixture->away_score) }}">
                                @error('away_score')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Notes</label>
                            <textarea id="notes" name="notes" rows="3"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('notes') border-red-500 @enderror">{{ old('notes', $fixture->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500">
                                Update Fixture
                            </button>
                            <a href="{{ route('admin.fixtures.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

