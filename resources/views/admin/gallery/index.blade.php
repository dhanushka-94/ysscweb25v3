<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Manage Gallery - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Manage Gallery</h1>
                <div class="flex space-x-3">
                    <button id="bulk-delete-btn" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 hidden" onclick="bulkDelete()">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Selected
                    </button>
                    <a href="{{ route('admin.gallery.bulk-upload') }}" class="bg-yellow-500 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-600 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Bulk Upload
                    </a>
                    <a href="{{ route('admin.gallery.chunked-upload') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-600 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Chunked Upload
                    </a>
                    <a href="{{ route('admin.gallery.create') }}" class="bg-yellow-400 text-gray-900 px-6 py-2 rounded-lg font-semibold hover:bg-yellow-500">
                        Add Single Image
                    </a>
                </div>
            </div>

            @if($groupedImages->count() > 0)
                @foreach($groupedImages as $galleryTitle => $images)
                    <!-- Gallery Section -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold text-gray-900 border-b-2 border-yellow-400 pb-2">
                                {{ $galleryTitle }} ({{ $images->count() }} images)
                            </h2>
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" id="select-all-{{ $loop->index }}" class="select-all-gallery" data-gallery="{{ $loop->index }}">
                                <label for="select-all-{{ $loop->index }}" class="text-sm text-gray-600">Select All</label>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($images as $image)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                <div class="relative">
                                    <input type="checkbox" class="image-checkbox absolute top-2 left-2 z-10" value="{{ $image->id }}" data-gallery="{{ $loop->parent->index }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->title }}" class="w-full h-48 object-cover">
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $image->title }}</h3>
                                    @if($image->category)
                                        <p class="text-xs text-gray-500 mb-2">{{ $image->category }}</p>
                                    @endif
                                    @if($image->is_featured)
                                        <span class="inline-block px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full mb-2">Featured</span>
                                    @endif
                                    <div class="flex space-x-2 mt-3">
                                        <a href="{{ route('admin.gallery.edit', $image) }}" class="text-sm text-yellow-600 hover:text-yellow-900">Edit</a>
                                        <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500">No images found.</p>
                </div>
            @endif

            <!-- Bulk Delete Form -->
            <form id="bulk-delete-form" action="{{ route('admin.gallery.bulk-delete') }}" method="POST" class="hidden">
                @csrf
                <div id="selected-images-inputs"></div>
            </form>
        </div>
    </div>

    <script>
        // Select all functionality for each gallery
        document.querySelectorAll('.select-all-gallery').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const galleryIndex = this.dataset.gallery;
                const galleryCheckboxes = document.querySelectorAll(`.image-checkbox[data-gallery="${galleryIndex}"]`);
                
                galleryCheckboxes.forEach(cb => {
                    cb.checked = this.checked;
                });
                
                updateBulkDeleteButton();
            });
        });

        // Individual checkbox functionality
        document.querySelectorAll('.image-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const galleryIndex = this.dataset.gallery;
                const galleryCheckboxes = document.querySelectorAll(`.image-checkbox[data-gallery="${galleryIndex}"]`);
                const selectAllCheckbox = document.querySelector(`.select-all-gallery[data-gallery="${galleryIndex}"]`);
                
                const checkedCount = Array.from(galleryCheckboxes).filter(cb => cb.checked).length;
                const totalCount = galleryCheckboxes.length;
                
                if (checkedCount === 0) {
                    selectAllCheckbox.indeterminate = false;
                    selectAllCheckbox.checked = false;
                } else if (checkedCount === totalCount) {
                    selectAllCheckbox.indeterminate = false;
                    selectAllCheckbox.checked = true;
                } else {
                    selectAllCheckbox.indeterminate = true;
                }
                
                updateBulkDeleteButton();
            });
        });

        function updateBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.image-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            
            if (checkedBoxes.length > 0) {
                bulkDeleteBtn.classList.remove('hidden');
                bulkDeleteBtn.textContent = `Delete Selected (${checkedBoxes.length})`;
            } else {
                bulkDeleteBtn.classList.add('hidden');
            }
        }

        function bulkDelete() {
            const checkedBoxes = document.querySelectorAll('.image-checkbox:checked');
            
            if (checkedBoxes.length === 0) {
                alert('Please select images to delete.');
                return;
            }
            
            if (confirm(`Are you sure you want to delete ${checkedBoxes.length} images? This action cannot be undone.`)) {
                const form = document.getElementById('bulk-delete-form');
                const inputsContainer = document.getElementById('selected-images-inputs');
                
                // Clear previous inputs
                inputsContainer.innerHTML = '';
                
                // Add selected image IDs as hidden inputs
                checkedBoxes.forEach(checkbox => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_images[]';
                    input.value = checkbox.value;
                    inputsContainer.appendChild(input);
                });
                
                // Submit the form
                form.submit();
            }
        }
    </script>
</body>
</html>

