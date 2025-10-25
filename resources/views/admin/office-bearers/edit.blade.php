@extends('layouts.admin')

@section('title', 'Edit Office Bearer')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.office-bearers.index') }}" class="text-yellow-600 hover:text-yellow-700 font-semibold">
                ← Back to Office Bearers
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Office Bearer</h1>

            <form action="{{ route('admin.office-bearers.update', $officeBearer) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            required
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('name') border-red-500 @enderror"
                            value="{{ old('name', $officeBearer->name) }}"
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                        <select 
                            id="category" 
                            name="category" 
                            required
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('category') border-red-500 @enderror"
                            onchange="updatePositions()"
                        >
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category', $officeBearer->category) == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Position/Designation -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Position/Designation *</label>
                        
                        <!-- Predefined Positions -->
                        <div class="mb-3">
                            <label for="position" class="block text-sm text-gray-600 mb-1">Select from predefined positions:</label>
                            <select 
                                id="position" 
                                name="position" 
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('position') border-red-500 @enderror"
                                onchange="clearCustomPosition()"
                            >
                                <option value="">Select Category First</option>
                            </select>
                        </div>
                        
                        <!-- Custom Position -->
                        <div>
                            <label for="custom_position" class="block text-sm text-gray-600 mb-1">Or enter a custom position:</label>
                            <input 
                                type="text" 
                                id="custom_position" 
                                name="custom_position"
                                placeholder="Enter custom position"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('custom_position') border-red-500 @enderror"
                                onchange="clearPredefinedPosition()"
                                value="{{ old('custom_position', $officeBearer->position) }}"
                            >
                        </div>
                        
                        @error('position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('custom_position')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Choose either a predefined position or enter a custom one</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('email') border-red-500 @enderror"
                            value="{{ old('email', $officeBearer->email) }}"
                        >
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                        <input 
                            type="text" 
                            id="phone" 
                            name="phone"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('phone') border-red-500 @enderror"
                            value="{{ old('phone', $officeBearer->phone) }}"
                        >
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
                        <textarea 
                            id="bio" 
                            name="bio" 
                            rows="4"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('bio') border-red-500 @enderror"
                        >{{ old('bio', $officeBearer->bio) }}</textarea>
                        @error('bio')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Photo -->
                    @if($officeBearer->photo)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Photo</label>
                            <img src="{{ asset('storage/' . $officeBearer->photo) }}" alt="{{ $officeBearer->name }}" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif

                    <!-- New Photo -->
                    <div>
                        <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">
                            {{ $officeBearer->photo ? 'Change Photo' : 'Upload Photo' }}
                        </label>
                        <input 
                            type="file" 
                            id="photo" 
                            name="photo" 
                            accept="image/*"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('photo') border-red-500 @enderror"
                            onchange="previewImage(event)"
                        >
                        @error('photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div id="imagePreview" class="mt-4 hidden">
                            <p class="text-sm text-gray-600 mb-2">New Photo Preview:</p>
                            <img src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    </div>

                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Display Order</label>
                        <input 
                            type="number" 
                            id="order" 
                            name="order"
                            class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('order') border-red-500 @enderror"
                            value="{{ old('order', $officeBearer->order) }}"
                        >
                        @error('order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">Lower numbers appear first</p>
                    </div>
                </div>

                <div class="mt-8 flex space-x-4">
                    <button type="submit" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        Update Office Bearer
                    </button>
                    <a href="{{ route('admin.office-bearers.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const designationsByCategory = @json($designationsByCategory);

function updatePositions() {
    const category = document.getElementById('category').value;
    const positionSelect = document.getElementById('position');
    const currentPosition = '{{ old('position', $officeBearer->position) }}';
    
    // Clear existing options
    positionSelect.innerHTML = '<option value="">Select Position</option>';
    
    if (category && designationsByCategory[category]) {
        designationsByCategory[category].forEach(position => {
            const option = document.createElement('option');
            option.value = position;
            option.textContent = position;
            if (position === currentPosition) {
                option.selected = true;
            }
            positionSelect.appendChild(option);
        });
    }
    
    // If current position is not in the list (custom position), add it
    if (currentPosition && !positionSelect.querySelector(`option[value="${currentPosition}"]`)) {
        const option = document.createElement('option');
        option.value = currentPosition;
        option.textContent = currentPosition;
        option.selected = true;
        positionSelect.appendChild(option);
    }
}

function clearCustomPosition() {
    document.getElementById('custom_position').value = '';
}

function clearPredefinedPosition() {
    document.getElementById('position').value = '';
}

function previewImage(event) {
    const preview = document.getElementById('imagePreview');
    const img = preview.querySelector('img');
    
    if (event.target.files && event.target.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        
        reader.readAsDataURL(event.target.files[0]);
    }
}

// Trigger on page load to populate positions based on selected category
document.addEventListener('DOMContentLoaded', function() {
    updatePositions();
});
</script>
@endsection

