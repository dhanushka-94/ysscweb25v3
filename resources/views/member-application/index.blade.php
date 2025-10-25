@extends('layouts.frontend')

@section('title', 'Join Us - Young Silver Sports Club')
@section('description', 'Join Young Silver Sports Club and become part of our football community. Apply for membership and be part of our team.')
@section('keywords', 'join YSSC, membership application, Young Silver Sports Club membership, football club join, Sri Lanka football')
@section('og_title', 'Join Us - Young Silver Sports Club')
@section('og_description', 'Join Young Silver Sports Club and become part of our football community. Apply for membership and be part of our team.')
@section('og_type', 'website')
@section('twitter_title', 'Join Us - Young Silver Sports Club')
@section('twitter_description', 'Join Young Silver Sports Club and become part of our football community. Apply for membership and be part of our team.')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Join Our Club</h1>
            <p class="text-xl text-gray-800">Become a member of Young Silver Sports Club</p>
        </div>
    </section>

    <!-- Join Us Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Why Join Us -->
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Join Young Silver Sports Club?</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Community Spirit</h3>
                                    <p class="text-gray-600">Join a passionate community of football enthusiasts who share your love for the beautiful game.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Professional Training</h3>
                                    <p class="text-gray-600">Access to professional coaching, training facilities, and development programs.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Competitive Opportunities</h3>
                                    <p class="text-gray-600">Participate in local and national tournaments, leagues, and friendly matches.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-12 h-12 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Lifelong Friendships</h3>
                                    <p class="text-gray-600">Build lasting friendships and connections within our football family.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Application Form -->
                    <div class="bg-gray-50 rounded-lg p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Apply for Membership</h3>
                        <p class="text-gray-600 mb-6">Fill out our membership application form to join our club. We'll review your application and get back to you soon.</p>
                        
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-gray-900">1</span>
                                </div>
                                <span class="text-gray-700">Complete the application form</span>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-gray-900">2</span>
                                </div>
                                <span class="text-gray-700">Submit required documents</span>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-gray-900">3</span>
                                </div>
                                <span class="text-gray-700">Wait for review and approval</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('member-application.create') }}" class="w-full bg-yellow-400 text-gray-900 px-6 py-4 rounded-lg font-bold text-lg hover:bg-yellow-500 transition text-center block">
                                Start Application
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Membership Requirements</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Age Requirements</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>• Youth members: 8-17 years</li>
                            <li>• Adult members: 18+ years</li>
                            <li>• Senior members: 35+ years</li>
                        </ul>
                    </div>
                    
                    <div class="bg-white rounded-lg p-6 shadow-md">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Required Documents</h3>
                        <ul class="space-y-2 text-gray-600">
                            <li>• Valid NIC (12 digits)</li>
                            <li>• Passport size photo</li>
                            <li>• Medical certificate</li>
                            <li>• Guardian details (for minors)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
