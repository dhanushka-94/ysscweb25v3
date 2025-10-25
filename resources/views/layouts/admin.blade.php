<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin') - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <!-- Page Content -->
    <div class="py-12">
        @yield('content')
    </div>

    <!-- Admin Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-sm text-gray-300">
                        &copy; {{ date('Y') }} Young Silver Sports Club. All rights reserved.
                    </p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-xs text-gray-400">
                        Developed by 
                        <a href="https://olexto.com" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition">
                            Olexto Digital Solutions (Pvt) Ltd
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

