<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Register - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-yellow-400 via-yellow-500 to-yellow-600 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Branding -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex flex-col items-center">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg mb-4">
                    <span class="text-4xl font-bold text-yellow-500">Y</span>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">YSSC Football Club</h1>
                <p class="text-gray-900 font-medium">Create Account</p>
            </a>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 px-8 py-6">
                <h2 class="text-2xl font-bold text-gray-900 text-center">Join Us</h2>
                <p class="text-gray-800 text-center text-sm mt-1">Create your account</p>
            </div>

            <!-- Card Body -->
            <div class="px-8 py-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none transition @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none transition @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none transition @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none transition">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900 py-3 rounded-lg font-bold text-lg hover:from-yellow-500 hover:to-yellow-600 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Register
                    </button>
                </form>

                <!-- Login Link -->
                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">
                            Login here
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Back to Website -->
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center text-white hover:text-gray-900 font-semibold transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Website
            </a>
        </div>
    </div>

    <!-- Floating Football Elements (Decorative) -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-16 h-16 bg-white/10 rounded-full animate-bounce" style="animation-delay: 0s; animation-duration: 3s;"></div>
        <div class="absolute top-40 right-20 w-12 h-12 bg-white/10 rounded-full animate-bounce" style="animation-delay: 1s; animation-duration: 4s;"></div>
        <div class="absolute bottom-20 left-1/4 w-20 h-20 bg-white/10 rounded-full animate-bounce" style="animation-delay: 2s; animation-duration: 5s;"></div>
        <div class="absolute bottom-40 right-1/3 w-14 h-14 bg-white/10 rounded-full animate-bounce" style="animation-delay: 1.5s; animation-duration: 3.5s;"></div>
    </div>
</body>
</html>
