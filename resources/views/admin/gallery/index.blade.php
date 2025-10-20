<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Manage Gallery - Admin - YSSC Football Club</title>
    
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
                <h1 class="text-3xl font-bold text-gray-900">Manage Gallery</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.gallery.bulk-upload') }}" class="bg-yellow-500 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-600 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Bulk Upload
                    </a>
                    <a href="{{ route('admin.gallery.create') }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500">
                        Add Single Image
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($images as $image)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-1">{{ $image->title }}</h3>
                        @if($image->category)
                            <p class="text-xs text-gray-500 mb-2">{{ $image->category }}</p>
                        @endif
                        @if($image->is_featured)
                            <span class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full mb-2">Featured</span>
                        @endif
                        <div class="flex space-x-2 mt-3">
                            <a href="{{ route('admin.gallery.edit', $image) }}" class="text-sm text-yellow-600 hover:text-yellow-900">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No images found.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $images->links() }}
            </div>
        </div>
    </div>
</body>
</html>

