@extends('layouts.admin')

@section('title', 'Edit Application - Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Application</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.member-applications.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                Back to List
            </a>
            <a href="{{ route('admin.member-applications.show', $memberApplication) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                View Application
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.member-applications.update', $memberApplication) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Personal Information</h2>
                
                <div class="space-y-6">
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $memberApplication->full_name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        @error('full_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $memberApplication->email) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <p class="text-xs text-gray-500 mt-1">Optional</p>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nic" class="block text-sm font-medium text-gray-700 mb-2">NIC Number *</label>
                        <input type="text" id="nic" name="nic" value="{{ old('nic', $memberApplication->nic) }}" required maxlength="12" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="123456789V or 123456789012">
                        <div id="nic-validation" class="mt-1 text-sm hidden">
                            <span id="nic-status-icon" class="inline-block w-4 h-4 mr-1"></span>
                            <span id="nic-status-text"></span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">9 digits + V/X or 12 digits only</p>
                        @error('nic')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_number_1" class="block text-sm font-medium text-gray-700 mb-2">Contact Number 1 *</label>
                        <input type="tel" id="contact_number_1" name="contact_number_1" value="{{ old('contact_number_1', $memberApplication->contact_number_1) }}" required pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        @error('contact_number_1')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_number_2" class="block text-sm font-medium text-gray-700 mb-2">Contact Number 2</label>
                        <input type="tel" id="contact_number_2" name="contact_number_2" value="{{ old('contact_number_2', $memberApplication->contact_number_2) }}" pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        @error('contact_number_2')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                        <textarea id="address" name="address" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">{{ old('address', $memberApplication->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Guardian Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Guardian/Parent Information (Optional)</h2>
                
                <div class="space-y-6">
                    <div>
                        <label for="guardian_full_name" class="block text-sm font-medium text-gray-700 mb-2">Guardian/Parent Full Name</label>
                        <input type="text" id="guardian_full_name" name="guardian_full_name" value="{{ old('guardian_full_name', $memberApplication->guardian_full_name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <p class="text-xs text-gray-500 mt-1">Optional</p>
                        @error('guardian_full_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="guardian_nic" class="block text-sm font-medium text-gray-700 mb-2">Guardian/Parent NIC Number</label>
                        <input type="text" id="guardian_nic" name="guardian_nic" value="{{ old('guardian_nic', $memberApplication->guardian_nic) }}" maxlength="12" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="123456789V or 123456789012">
                        <div id="guardian-nic-validation" class="mt-1 text-sm hidden">
                            <span id="guardian-nic-status-icon" class="inline-block w-4 h-4 mr-1"></span>
                            <span id="guardian-nic-status-text"></span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">9 digits + V/X or 12 digits only (Optional)</p>
                        @error('guardian_nic')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="guardian_contact_number_1" class="block text-sm font-medium text-gray-700 mb-2">Guardian Contact Number 1</label>
                        <input type="tel" id="guardian_contact_number_1" name="guardian_contact_number_1" value="{{ old('guardian_contact_number_1', $memberApplication->guardian_contact_number_1) }}" pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <p class="text-xs text-gray-500 mt-1">Format: 0XXXXXXXXX (Optional)</p>
                        @error('guardian_contact_number_1')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="guardian_contact_number_2" class="block text-sm font-medium text-gray-700 mb-2">Guardian Contact Number 2</label>
                        <input type="tel" id="guardian_contact_number_2" name="guardian_contact_number_2" value="{{ old('guardian_contact_number_2', $memberApplication->guardian_contact_number_2) }}" pattern="0[0-9]{9}" maxlength="10" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <p class="text-xs text-gray-500 mt-1">Format: 0XXXXXXXXX (Optional)</p>
                        @error('guardian_contact_number_2')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="guardian_address" class="block text-sm font-medium text-gray-700 mb-2">Guardian/Parent Address</label>
                        <textarea id="guardian_address" name="guardian_address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">{{ old('guardian_address', $memberApplication->guardian_address) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Optional</p>
                        @error('guardian_address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Application Status & Notes -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Application Status & Notes</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="pending" {{ old('status', $memberApplication->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $memberApplication->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status', $memberApplication->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                    <textarea id="notes" name="notes" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Add any notes about this application...">{{ old('notes', $memberApplication->notes) }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason</label>
                <textarea id="rejection_reason" name="rejection_reason" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Provide reason for rejection (only if status is rejected)...">{{ old('rejection_reason', $memberApplication->rejection_reason) }}</textarea>
                <p class="text-sm text-gray-500 mt-1">Only fill this if the application is being rejected.</p>
                @error('rejection_reason')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.member-applications.show', $memberApplication) }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                Cancel
            </a>
            <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                Update Application
            </button>
        </div>
    </form>
</div>

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
@endsection
