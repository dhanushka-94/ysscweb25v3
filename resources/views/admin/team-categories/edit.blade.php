<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Edit Team Category - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.team-categories.index') }}" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Team Categories
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Team Category</h1>

                <form action="{{ route('admin.team-categories.update', $teamCategory) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Category Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $teamCategory->name) }}" required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="color" class="block text-sm font-semibold text-gray-700 mb-2">Color *</label>
                            <div class="flex items-center space-x-2">
                                <input type="color" id="color" name="color" value="{{ old('color', $teamCategory->color) }}" required
                                    class="w-16 h-10 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('color') border-red-500 @enderror">
                                <input type="text" id="color_text" value="{{ old('color', $teamCategory->color) }}" 
                                    class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('color') border-red-500 @enderror"
                                    placeholder="#facc15">
                            </div>
                            @error('color')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order *</label>
                            <input type="number" id="order" name="order" value="{{ old('order', $teamCategory->order) }}" min="0" required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('order') border-red-500 @enderror">
                            @error('order')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $teamCategory->is_active) ? 'checked' : '' }}
                                    class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea id="description" name="description" rows="4" 
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('description') border-red-500 @enderror"
                            placeholder="Enter category description...">{{ old('description', $teamCategory->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-8 flex space-x-4">
                        <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500">
                            Update Category
                        </button>
                        <a href="{{ route('admin.team-categories.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sync color picker with text input
        document.getElementById('color').addEventListener('input', function() {
            document.getElementById('color_text').value = this.value;
        });

        document.getElementById('color_text').addEventListener('input', function() {
            if (this.value.match(/^#[0-9A-Fa-f]{6}$/)) {
                document.getElementById('color').value = this.value;
            }
        });
    </script>
</body>
</html>
