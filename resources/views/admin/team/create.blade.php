<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Add Team Member - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.team.index') }}" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Team
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Add Team Member</h1>

                <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('name') border-red-500 @enderror"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="position" class="block text-sm font-semibold text-gray-700 mb-2">Position *</label>
                                <input type="text" id="position" name="position" required placeholder="e.g. Forward, Midfielder"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('position') border-red-500 @enderror"
                                    value="{{ old('position') }}">
                                @error('position')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Team Category</label>
                                <select id="category_id" name="category_id"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('category_id') border-red-500 @enderror">
                                    <option value="">Select Category (Optional)</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', request('category')) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="jersey_number" class="block text-sm font-semibold text-gray-700 mb-2">Jersey Number</label>
                                <input type="text" id="jersey_number" name="jersey_number" placeholder="e.g. 10"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('jersey_number') border-red-500 @enderror"
                                    value="{{ old('jersey_number') }}">
                                @error('jersey_number')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="nationality" class="block text-sm font-semibold text-gray-700 mb-2">Nationality</label>
                                <input type="text" id="nationality" name="nationality"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('nationality') border-red-500 @enderror"
                                    value="{{ old('nationality') }}">
                                @error('nationality')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-2">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('date_of_birth') border-red-500 @enderror"
                                value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">Photo</label>
                            <input type="file" id="photo" name="photo" accept="image/*"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('photo') border-red-500 @enderror">
                            @error('photo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                            <textarea id="bio" name="bio" rows="4"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                            @error('bio')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order *</label>
                            <input type="number" id="order" name="order" required min="0"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('order') border-red-500 @enderror"
                                value="{{ old('order', 0) }}">
                            @error('order')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Active</span>
                            </label>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500">
                                Add Team Member
                            </button>
                            <a href="{{ route('admin.team.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
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

