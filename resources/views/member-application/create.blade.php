@extends('layouts.frontend')

@section('title', 'Membership Application - Young Silver Sports Club')
@section('description', 'Apply for membership at Young Silver Sports Club. Join our football community and be part of our team.')
@section('keywords', 'membership application, join YSSC, football club application, Young Silver Sports Club')
@section('og_title', 'Membership Application - Young Silver Sports Club')
@section('og_description', 'Apply for membership at Young Silver Sports Club. Join our football community and be part of our team.')
@section('og_type', 'website')
@section('twitter_title', 'Membership Application - Young Silver Sports Club')
@section('twitter_description', 'Apply for membership at Young Silver Sports Club. Join our football community and be part of our team.')

@section('content')
    <!-- Application Form Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-6">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 md:space-x-6">
                    @php
                        $siteLogo = \App\Models\Setting::get('site_logo');
                        $siteName = \App\Models\Setting::get('site_name', 'Young Silver Sports Club');
                        $siteTagline = \App\Models\Setting::get('site_tagline', 'Victory Through Unity');
                    @endphp
                    
                    <!-- Logo and Club Info -->
                    <div class="flex items-center space-x-4">
                        @if($siteLogo)
                            <img src="{{ asset('storage/' . $siteLogo) }}" alt="{{ $siteName }}" class="h-12 w-auto object-contain">
                        @else
                            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-900">Y</span>
                            </div>
                        @endif
                        
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $siteName }}</h1>
                            @if($siteTagline)
                                <p class="text-sm text-gray-800">{{ $siteTagline }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    <div class="text-center md:text-right text-gray-800">
                        <p class="text-sm font-semibold">27, Vincent Lane, Wellawatte, Colombo 06</p>
                        <p class="text-xs">+94 714 813 981 | info@youngsilversportsclub.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Application Form -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Membership Application Form</h2>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('member-application.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        
                        <!-- Personal Details Section -->
                        <div class="border-b border-gray-200 pb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Personal Details</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Profile Photo -->
                                <div class="md:col-span-2">
                                    <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Profile Photo (Passport Size)
                                    </label>
                                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-yellow-400 file:text-gray-900 hover:file:bg-yellow-500" required>
                                    <p class="text-xs text-gray-500 mt-1">Upload a passport size photo (3.5cm x 4.5cm, JPEG, PNG, max 2MB)</p>
                                    @error('profile_photo')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Full Name -->
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    @error('full_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    <p class="text-xs text-gray-500 mt-1">Optional</p>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NIC -->
                                <div>
                                    <label for="nic" class="block text-sm font-medium text-gray-700 mb-2">NIC Number *</label>
                                    <input type="text" id="nic" name="nic" value="{{ old('nic') }}" required maxlength="12" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="123456789V or 123456789012">
                                    <div id="nic-validation" class="mt-1 text-sm hidden">
                                        <span id="nic-status-icon" class="inline-block w-4 h-4 mr-1"></span>
                                        <span id="nic-status-text"></span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">9 digits + V/X or 12 digits only</p>
                                    @error('nic')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                                    <textarea id="address" name="address" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Contact Numbers -->
                                <div>
                                    <label for="contact_number_1" class="block text-sm font-medium text-gray-700 mb-2">Contact Number 1 *</label>
                                    <input type="tel" id="contact_number_1" name="contact_number_1" value="{{ old('contact_number_1') }}" required pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="0714813981">
                                    <p class="text-xs text-gray-500 mt-1">Format: 0XXXXXXXXX</p>
                                    @error('contact_number_1')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="contact_number_2" class="block text-sm font-medium text-gray-700 mb-2">Contact Number 2</label>
                                    <input type="tel" id="contact_number_2" name="contact_number_2" value="{{ old('contact_number_2') }}" pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="0714813981">
                                    <p class="text-xs text-gray-500 mt-1">Format: 0XXXXXXXXX (Optional)</p>
                                    @error('contact_number_2')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Guardian/Parent Details Section -->
                        <div class="border-b border-gray-200 pb-8">
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">Guardian/Parent Details (Optional)</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Guardian Full Name -->
                                <div>
                                    <label for="guardian_full_name" class="block text-sm font-medium text-gray-700 mb-2">Guardian/Parent Full Name</label>
                                    <input type="text" id="guardian_full_name" name="guardian_full_name" value="{{ old('guardian_full_name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                    <p class="text-xs text-gray-500 mt-1">Optional</p>
                                    @error('guardian_full_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Guardian NIC -->
                                <div>
                                    <label for="guardian_nic" class="block text-sm font-medium text-gray-700 mb-2">Guardian/Parent NIC Number</label>
                                    <input type="text" id="guardian_nic" name="guardian_nic" value="{{ old('guardian_nic') }}" maxlength="12" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="123456789V or 123456789012">
                                    <div id="guardian-nic-validation" class="mt-1 text-sm hidden">
                                        <span id="guardian-nic-status-icon" class="inline-block w-4 h-4 mr-1"></span>
                                        <span id="guardian-nic-status-text"></span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">9 digits + V/X or 12 digits only (Optional)</p>
                                    @error('guardian_nic')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Guardian Address -->
                                <div class="md:col-span-2">
                                    <label for="guardian_address" class="block text-sm font-medium text-gray-700 mb-2">Guardian/Parent Address</label>
                                    <textarea id="guardian_address" name="guardian_address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">{{ old('guardian_address') }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1">Optional</p>
                                    @error('guardian_address')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Guardian Contact Numbers -->
                                <div>
                                    <label for="guardian_contact_number_1" class="block text-sm font-medium text-gray-700 mb-2">Guardian Contact Number 1</label>
                                    <input type="tel" id="guardian_contact_number_1" name="guardian_contact_number_1" value="{{ old('guardian_contact_number_1') }}" pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="0714813981">
                                    <p class="text-xs text-gray-500 mt-1">Format: 0XXXXXXXXX (Optional)</p>
                                    @error('guardian_contact_number_1')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="guardian_contact_number_2" class="block text-sm font-medium text-gray-700 mb-2">Guardian Contact Number 2</label>
                                    <input type="tel" id="guardian_contact_number_2" name="guardian_contact_number_2" value="{{ old('guardian_contact_number_2') }}" pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="0714813981">
                                    <p class="text-xs text-gray-500 mt-1">Format: 0XXXXXXXXX (Optional)</p>
                                    @error('guardian_contact_number_2')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-bold text-lg hover:bg-yellow-500 transition">
                                Submit Application
                            </button>
                            <p class="text-sm text-gray-500 mt-4">
                                By submitting this form, you agree to our terms and conditions.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Format phone numbers as user types
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInputs = document.querySelectorAll('input[type="tel"]');
        
        phoneInputs.forEach(input => {
            input.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0 && !value.startsWith('0')) {
                    value = '0' + value;
                }
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }
                e.target.value = value;
            });
        });

        // Format NIC numbers (9 digits + V/X or 12 digits) with live validation
        const nicInputs = document.querySelectorAll('input[name="nic"], input[name="guardian_nic"]');
        
        nicInputs.forEach(input => {
            // Handle input event
            input.addEventListener('input', function(e) {
                let value = e.target.value.toUpperCase();
                
                // Allow only digits and V/X at the end
                value = value.replace(/[^0-9VX]/g, '');
                
                // If it contains V or X, ensure it's at the end and only one letter
                if (value.includes('V') || value.includes('X')) {
                    const letterMatch = value.match(/[VX]/g);
                    if (letterMatch && letterMatch.length > 1) {
                        // Keep only the last letter
                        const lastLetterIndex = Math.max(value.lastIndexOf('V'), value.lastIndexOf('X'));
                        value = value.substring(0, lastLetterIndex) + value.charAt(lastLetterIndex);
                    }
                    
                    // Ensure letter is at the end
                    const letterIndex = Math.max(value.indexOf('V'), value.indexOf('X'));
                    if (letterIndex !== -1 && letterIndex !== value.length - 1) {
                        const letter = value.charAt(letterIndex);
                        value = value.replace(/[VX]/g, '') + letter;
                    }
                    
                    // Strict limit: 9 digits + 1 letter = 10 characters max
                    if (value.length > 10) {
                        value = value.substring(0, 10);
                    }
                } else {
                    // Only digits, strict limit to 12
                    if (value.length > 12) {
                        value = value.substring(0, 12);
                    }
                }
                
                e.target.value = value;
                
                // Live validation
                validateNIC(e.target);
            });
            
            // Handle paste event to ensure uppercase
            input.addEventListener('paste', function(e) {
                setTimeout(() => {
                    let value = e.target.value.toUpperCase();
                    e.target.value = value;
                    validateNIC(e.target);
                }, 0);
            });
            
            // Handle keyup event for additional uppercase conversion
            input.addEventListener('keyup', function(e) {
                let value = e.target.value.toUpperCase();
                if (value !== e.target.value) {
                    e.target.value = value;
                    validateNIC(e.target);
                }
            });
        });
        
        // NIC validation function
        function validateNIC(input) {
            const value = input.value.trim();
            const isGuardian = input.name === 'guardian_nic';
            const validationDiv = document.getElementById(isGuardian ? 'guardian-nic-validation' : 'nic-validation');
            const statusIcon = document.getElementById(isGuardian ? 'guardian-nic-status-icon' : 'nic-status-icon');
            const statusText = document.getElementById(isGuardian ? 'guardian-nic-status-text' : 'nic-status-text');
            
            if (value === '') {
                validationDiv.classList.add('hidden');
                // Reset input styling
                input.classList.remove('border-green-500', 'border-red-500', 'bg-green-50', 'bg-red-50');
                input.classList.add('border-gray-300');
                input.style.borderWidth = '1px';
                input.style.boxShadow = 'none';
                return;
            }
            
            // Validation patterns
            const oldFormatPattern = /^[0-9]{9}[VX]$/; // 9 digits + V/X
            const newFormatPattern = /^[0-9]{12}$/; // 12 digits
            
            const isValidOld = oldFormatPattern.test(value);
            const isValidNew = newFormatPattern.test(value);
            const isValid = isValidOld || isValidNew;
            
            if (isValid) {
                // Valid NIC - Green styling
                validationDiv.classList.remove('hidden');
                statusIcon.innerHTML = '✓';
                statusIcon.className = 'inline-block w-5 h-5 mr-2 text-green-500 font-bold';
                statusText.textContent = 'Valid NIC format';
                statusText.className = 'text-green-600 font-medium';
                
                // Enhanced green styling for input
                input.classList.remove('border-red-500', 'border-gray-300', 'bg-red-50');
                input.classList.add('border-green-500', 'bg-green-50');
                input.style.borderWidth = '2px';
                input.style.boxShadow = '0 0 0 3px rgba(34, 197, 94, 0.1)';
            } else {
                // Invalid NIC - Red styling
                validationDiv.classList.remove('hidden');
                statusIcon.innerHTML = '✗';
                statusIcon.className = 'inline-block w-5 h-5 mr-2 text-red-500 font-bold';
                
                if (value.length < 9) {
                    statusText.textContent = 'Too short - need 9 digits + V/X or 12 digits';
                } else if (value.length === 9 && !/[VX]$/.test(value)) {
                    statusText.textContent = 'Add V or X at the end for old format';
                } else if (value.length === 10 && !/^[0-9]{9}[VX]$/.test(value)) {
                    statusText.textContent = 'Invalid format - should be 9 digits + V/X';
                } else if (value.length === 11) {
                    statusText.textContent = 'Add 1 more digit for new format (12 digits)';
                } else if (value.length === 12 && !/^[0-9]{12}$/.test(value)) {
                    statusText.textContent = 'Invalid format - should be 12 digits only';
                } else {
                    statusText.textContent = 'Invalid NIC format';
                }
                
                statusText.className = 'text-red-600 font-medium';
                
                // Enhanced red styling for input
                input.classList.remove('border-green-500', 'border-gray-300', 'bg-green-50');
                input.classList.add('border-red-500', 'bg-red-50');
                input.style.borderWidth = '2px';
                input.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';
            }
        }
    });
</script>
@endpush
