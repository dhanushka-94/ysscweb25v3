<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Edit Sponsor - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.sponsors.index') }}" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Sponsors
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Sponsor</h1>

                <form action="{{ route('admin.sponsors.update', $sponsor) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Sponsor Name *</label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('name') border-red-500 @enderror"
                                value="{{ old('name', $sponsor->name) }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">Logo</label>
                            @if($sponsor->logo)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" class="h-24 w-auto object-contain">
                                </div>
                            @endif
                            <input type="file" id="logo" name="logo" accept="image/*"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('logo') border-red-500 @enderror">
                            <p class="text-sm text-gray-500 mt-1">Leave empty to keep current logo</p>
                            @error('logo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="website" class="block text-sm font-semibold text-gray-700 mb-2">Website URL</label>
                            <input type="url" id="website" name="website" placeholder="https://example.com"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('website') border-red-500 @enderror"
                                value="{{ old('website', $sponsor->website) }}">
                            @error('website')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea id="description" name="description" rows="3"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('description') border-red-500 @enderror">{{ old('description', $sponsor->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="tier" class="block text-sm font-semibold text-gray-700 mb-2">Sponsor Tier *</label>
                                <select id="tier" name="tier" required
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('tier') border-red-500 @enderror">
                                    <option value="platinum" {{ old('tier', $sponsor->tier) === 'platinum' ? 'selected' : '' }}>Platinum</option>
                                    <option value="gold" {{ old('tier', $sponsor->tier) === 'gold' ? 'selected' : '' }}>Gold</option>
                                    <option value="silver" {{ old('tier', $sponsor->tier) === 'silver' ? 'selected' : '' }}>Silver</option>
                                    <option value="bronze" {{ old('tier', $sponsor->tier) === 'bronze' ? 'selected' : '' }}>Bronze</option>
                                </select>
                                @error('tier')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order *</label>
                                <input type="number" id="order" name="order" required min="0"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('order') border-red-500 @enderror"
                                    value="{{ old('order', $sponsor->order) }}">
                                @error('order')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $sponsor->is_active) ? 'checked' : '' }}
                                    class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Active</span>
                            </label>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500">
                                Update Sponsor
                            </button>
                            <a href="{{ route('admin.sponsors.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
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

