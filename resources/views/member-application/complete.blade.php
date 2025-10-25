@extends('layouts.frontend')

@section('title', 'Application Submitted - Young Silver Sports Club')
@section('description', 'Your membership application has been successfully submitted to Young Silver Sports Club.')
@section('keywords', 'application submitted, membership application, Young Silver Sports Club')
@section('og_title', 'Application Submitted - Young Silver Sports Club')
@section('og_description', 'Your membership application has been successfully submitted to Young Silver Sports Club.')
@section('og_type', 'website')
@section('twitter_title', 'Application Submitted - Young Silver Sports Club')
@section('twitter_description', 'Your membership application has been successfully submitted to Young Silver Sports Club.')

@section('content')
    <!-- Success Header -->
    <section class="bg-gradient-to-r from-green-400 to-green-500 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Application Submitted Successfully!</h1>
                <p class="text-xl text-green-100">Thank you for your interest in joining Young Silver Sports Club</p>
            </div>
        </div>
    </section>

    <!-- Application Details -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-gray-50 rounded-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Application Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Application Reference</h3>
                            <p class="text-gray-900 font-mono">{{ $memberApplication->reference_number ?: 'YSSC/' . date('Y') . '/0001' }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Submitted On</h3>
                            <p class="text-gray-900">{{ $memberApplication->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Applicant Name</h3>
                            <p class="text-gray-900">{{ $memberApplication->full_name }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Status</h3>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                Under Review
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-blue-50 rounded-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">What Happens Next?</h2>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">1</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Review Process</h3>
                                <p class="text-gray-700">Our team will review your application within 3-5 business days.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">2</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Contact & Verification</h3>
                                <p class="text-gray-700">We may contact you for additional information or verification.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">3</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Decision Notification</h3>
                                <p class="text-gray-700">You will be notified of the decision via phone or email.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Download Options -->
                <div class="bg-yellow-50 rounded-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Download Your Application</h2>
                    <p class="text-gray-700 mb-6">Keep a copy of your application for your records.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('member-application.pdf', $memberApplication->id) }}" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download PDF
                        </a>
                        <a href="{{ route('member-application.index') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Join Us
                        </a>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="bg-gray-100 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Need Help?</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Contact Information</h3>
                            <div class="space-y-2">
                                <p class="text-gray-900">
                                    <span class="font-semibold">Phone:</span> +94 714 813 981
                                </p>
                                <p class="text-gray-900">
                                    <span class="font-semibold">Email:</span> info@youngsilversportsclub.com
                                </p>
                                <p class="text-gray-900">
                                    <span class="font-semibold">Address:</span> 27, Vincent Lane, Wellawatte, Colombo 06
                                </p>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Application Reference</h3>
                            <p class="text-gray-900 font-mono text-lg">{{ $memberApplication->reference_number ?: 'YSSC/' . date('Y') . '/0001' }}</p>
                            <p class="text-sm text-gray-600 mt-2">Please keep this reference number for future correspondence.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
