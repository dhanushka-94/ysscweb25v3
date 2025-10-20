<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Edit Slider - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.sliders.index') }}" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Sliders
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Slider</h1>

                <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                            <input type="text" id="title" name="title" required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('title') border-red-500 @enderror"
                                value="{{ old('title', $slider->title) }}">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea id="description" name="description" rows="3"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('description') border-red-500 @enderror">{{ old('description', $slider->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Image (1920x600 recommended)</label>
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="h-32 w-auto rounded shadow">
                            </div>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('image') border-red-500 @enderror">
                            <p class="text-sm text-gray-500 mt-1">Leave empty to keep current image</p>
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="button_text" class="block text-sm font-semibold text-gray-700 mb-2">Button Text</label>
                                <input type="text" id="button_text" name="button_text"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none"
                                    value="{{ old('button_text', $slider->button_text) }}">
                            </div>

                            <div>
                                <label for="button_link" class="block text-sm font-semibold text-gray-700 mb-2">Button Link</label>
                                <input type="text" id="button_link" name="button_link"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none"
                                    value="{{ old('button_link', $slider->button_link) }}">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Order *</label>
                                <input type="number" id="order" name="order" required min="0"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('order') border-red-500 @enderror"
                                    value="{{ old('order', $slider->order) }}">
                                @error('order')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-end">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }}
                                        class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                    <span class="ml-2 text-sm font-semibold text-gray-700">Active</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500">
                                Update Slider
                            </button>
                            <a href="{{ route('admin.sliders.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
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

