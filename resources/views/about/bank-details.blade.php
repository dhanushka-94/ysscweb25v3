@extends('layouts.frontend')

@section('title', 'Bank Details - Young Silver Sports Club')

@section('content')
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Bank Details</h1>
            <p class="text-lg md:text-xl text-gray-800">Support the Club</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Bank Account Information</h2>
                <p class="text-lg text-gray-600">
                    Support Young Silver Sports Club by making a donation or contribution to our official bank account.
                </p>
            </div>

            <!-- Bank Details Card -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-lg shadow-2xl p-8 md:p-12">
                <div class="mb-8 pb-6 border-b border-yellow-400">
                    <h3 class="text-2xl font-bold text-yellow-400 mb-2">YOUNG SILVER SPORTS CLUB</h3>
                    <p class="text-gray-300">Official Club Account</p>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div class="text-yellow-400 font-semibold text-sm md:text-base">Account Name</div>
                        <div class="md:col-span-2 text-gray-100 font-semibold text-lg">YOUNG SILVER SPORTS CLUB</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center bg-gray-800/50 rounded-lg p-4">
                        <div class="text-yellow-400 font-semibold text-sm md:text-base">Bank</div>
                        <div class="md:col-span-2 text-gray-100 font-semibold text-lg">PEOPLE'S BANK</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div class="text-yellow-400 font-semibold text-sm md:text-base">Account Number</div>
                        <div class="md:col-span-2 text-gray-100 font-mono text-xl font-bold">145-2-001-8-0015611</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center bg-gray-800/50 rounded-lg p-4">
                        <div class="text-yellow-400 font-semibold text-sm md:text-base">Branch Name</div>
                        <div class="md:col-span-2 text-gray-100 font-semibold text-lg">Wellawatte</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div class="text-yellow-400 font-semibold text-sm md:text-base">Country</div>
                        <div class="md:col-span-2 text-gray-100 font-semibold text-lg">SRI LANKA</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center bg-gray-800/50 rounded-lg p-4">
                        <div class="text-yellow-400 font-semibold text-sm md:text-base">Country Code</div>
                        <div class="md:col-span-2 text-gray-100 font-mono text-lg font-bold">LK</div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
                        <div class="text-yellow-400 font-semibold text-sm md:text-base">Swift Code</div>
                        <div class="md:col-span-2 text-gray-100 font-mono text-xl font-bold">PSBKLKLX</div>
                    </div>
                </div>

                <!-- Important Note -->
                <div class="mt-8 bg-yellow-400/10 border border-yellow-400 rounded-lg p-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-yellow-400 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h4 class="text-yellow-400 font-bold mb-2">Important Information</h4>
                            <p class="text-gray-100 text-sm">
                                Please use this official bank account for all donations, sponsorships, and contributions to Young Silver Sports Club. For international transfers, please use the Swift Code provided above. If you need any assistance or have questions, please contact us.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="mt-12 text-center">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Need Help?</h3>
                <p class="text-gray-600 mb-6">
                    If you have any questions about donations or need assistance with bank transfers, please feel free to contact us.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:+94714813981" class="inline-flex items-center justify-center bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Call Us
                    </a>
                    <a href="mailto:info@youngsilversportsclub.com" class="inline-flex items-center justify-center bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
