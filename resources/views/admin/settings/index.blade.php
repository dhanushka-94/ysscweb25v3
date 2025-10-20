<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Website Settings - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Website Settings</h1>
                <p class="text-gray-600 mt-1">Manage your website configuration and branding</p>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- Site Logo -->
                        <div class="border-b pb-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Website Logo</h2>
                            
                            @if($settings['site_logo'])
                                <div class="mb-4 flex items-start space-x-4">
                                    <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="Current Logo" class="h-20 w-auto object-contain border border-gray-200 rounded p-2">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-2">Current logo</p>
                                        <button type="button" onclick="deleteLogo()" class="text-red-600 hover:text-red-700 text-sm font-medium">
                                            Remove Logo
                                        </button>
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500 mb-4 text-sm">No logo uploaded</p>
                            @endif

                            <div>
                                <label for="site_logo" class="block text-sm font-semibold text-gray-700 mb-2">Upload New Logo</label>
                                <input type="file" id="site_logo" name="site_logo" accept="image/*"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('site_logo') border-red-500 @enderror">
                                <p class="text-sm text-gray-500 mt-2">Recommended: PNG with transparent background, max 2MB</p>
                                @error('site_logo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Site Name -->
                        <div>
                            <label for="site_name" class="block text-sm font-semibold text-gray-700 mb-2">Site Name *</label>
                            <input type="text" id="site_name" name="site_name" required
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('site_name') border-red-500 @enderror"
                                value="{{ old('site_name', $settings['site_name']) }}">
                            <p class="text-sm text-gray-500 mt-1">This will appear in the website header and browser title</p>
                            @error('site_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Site Tagline -->
                        <div>
                            <label for="site_tagline" class="block text-sm font-semibold text-gray-700 mb-2">Site Tagline</label>
                            <input type="text" id="site_tagline" name="site_tagline"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('site_tagline') border-red-500 @enderror"
                                value="{{ old('site_tagline', $settings['site_tagline']) }}">
                            <p class="text-sm text-gray-500 mt-1">Optional tagline or motto for your club</p>
                            @error('site_tagline')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg font-semibold hover:bg-yellow-500">
                                Save Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Information Box -->
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Note:</strong> After uploading a logo, it will automatically appear in your website header. Make sure your logo looks good on both light and yellow backgrounds.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for logo deletion -->
    <form id="deleteLogoForm" action="{{ route('admin.settings.delete-logo') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function deleteLogo() {
            if (confirm('Are you sure you want to delete the logo?')) {
                document.getElementById('deleteLogoForm').submit();
            }
        }
    </script>
</body>
</html>

