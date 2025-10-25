@extends('layouts.frontend')

@section('title', 'Application Submitted - Young Silver Sports Club')
@section('description', 'Your membership application has been submitted successfully.')
@section('keywords', 'application submitted, membership application, Young Silver Sports Club')
@section('og_title', 'Application Submitted - Young Silver Sports Club')
@section('og_description', 'Your membership application has been submitted successfully.')
@section('og_type', 'website')
@section('twitter_title', 'Application Submitted - Young Silver Sports Club')
@section('twitter_description', 'Your membership application has been submitted successfully.')

@section('content')
    <!-- Success Header -->
    <section class="bg-gradient-to-r from-green-400 to-green-500 py-16">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Application Submitted Successfully!</h1>
                <p class="text-xl text-white">Thank you for your interest in joining Young Silver Sports Club</p>
            </div>
        </div>
    </section>

    <!-- Application Details -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Application Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Personal Information -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Personal Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-700">Name:</span>
                                    <span class="text-gray-900">{{ $memberApplication->full_name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Email:</span>
                                    <span class="text-gray-900">{{ $memberApplication->email }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">NIC:</span>
                                    <span class="text-gray-900">{{ $memberApplication->formatted_nic }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Contact:</span>
                                    <span class="text-gray-900">{{ $memberApplication->formatted_contact_number_1 }}</span>
                                </div>
                                @if($memberApplication->contact_number_2)
                                <div>
                                    <span class="font-medium text-gray-700">Contact 2:</span>
                                    <span class="text-gray-900">{{ $memberApplication->contact_number_2 }}</span>
                                </div>
                                @endif
                                <div>
                                    <span class="font-medium text-gray-700">Address:</span>
                                    <span class="text-gray-900">{{ $memberApplication->address }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Information -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Guardian Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium text-gray-700">Name:</span>
                                    <span class="text-gray-900">{{ $memberApplication->guardian_full_name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">NIC:</span>
                                    <span class="text-gray-900">{{ $memberApplication->formatted_guardian_nic }}</span>
                                </div>
                                <div>
                                    <span class="font-medium text-gray-700">Contact:</span>
                                    <span class="text-gray-900">{{ $memberApplication->formatted_guardian_contact_number_1 }}</span>
                                </div>
                                @if($memberApplication->guardian_contact_number_2)
                                <div>
                                    <span class="font-medium text-gray-700">Contact 2:</span>
                                    <span class="text-gray-900">{{ $memberApplication->guardian_contact_number_2 }}</span>
                                </div>
                                @endif
                                <div>
                                    <span class="font-medium text-gray-700">Address:</span>
                                    <span class="text-gray-900">{{ $memberApplication->guardian_address }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Photo -->
                    @if($memberApplication->profile_photo)
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Profile Photo</h3>
                        <img src="{{ asset('storage/' . $memberApplication->profile_photo) }}" alt="Profile Photo" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                    @endif

                    <!-- Application Status -->
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Application Status</h3>
                        <div class="flex items-center space-x-3">
                            @if($memberApplication->status === 'pending')
                                <div class="w-4 h-4 bg-yellow-400 rounded-full"></div>
                                <span class="text-yellow-700 font-medium">Pending Review</span>
                            @elseif($memberApplication->status === 'approved')
                                <div class="w-4 h-4 bg-green-400 rounded-full"></div>
                                <span class="text-green-700 font-medium">Approved</span>
                            @else
                                <div class="w-4 h-4 bg-red-400 rounded-full"></div>
                                <span class="text-red-700 font-medium">Rejected</span>
                            @endif
                        </div>
                        
                        @if($memberApplication->notes)
                        <div class="mt-4">
                            <span class="font-medium text-gray-700">Notes:</span>
                            <p class="text-gray-900 mt-1">{{ $memberApplication->notes }}</p>
                        </div>
                        @endif

                        @if($memberApplication->rejection_reason)
                        <div class="mt-4">
                            <span class="font-medium text-gray-700">Rejection Reason:</span>
                            <p class="text-gray-900 mt-1">{{ $memberApplication->rejection_reason }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Next Steps -->
                    <div class="mt-8 p-6 bg-yellow-50 rounded-lg">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">What's Next?</h3>
                        <div class="space-y-3 text-gray-700">
                            <p>• We will review your application within 3-5 business days</p>
                            <p>• You will receive an email notification about the status</p>
                            <p>• If approved, you will receive further instructions</p>
                            <p>• For any questions, contact us at info@youngsilversportsclub.com</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('member-application.index') }}" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition text-center">
                            Back to Join Us
                        </a>
                        <a href="{{ route('home') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition text-center">
                            Go to Homepage
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
