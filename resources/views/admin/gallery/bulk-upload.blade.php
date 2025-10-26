<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Bulk Upload Images - Admin - YSSC Football Club</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .image-preview {
            position: relative;
            display: inline-block;
        }
        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(239, 68, 68, 0.9);
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .remove-image:hover {
            background: rgba(220, 38, 38, 1);
        }
    </style>
</head>
<body class="bg-gray-100">
    @include('admin.partials.nav')

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('admin.gallery.index') }}" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Gallery
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Bulk Upload Images</h1>
                <p class="text-gray-600 mb-6">Upload multiple images to the gallery at once</p>

                <form action="{{ route('admin.gallery.bulk-store') }}" method="POST" enctype="multipart/form-data" id="bulkUploadForm">
                    @csrf
                    
                    <div class="space-y-6">
                        <!-- File Upload Area -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Select Images *</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-yellow-400 transition-colors">
                                <input type="file" id="images" name="images[]" accept="image/*" multiple required
                                    class="hidden"
                                    onchange="previewImages(event)">
                                <label for="images" class="cursor-pointer">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">
                                        <span class="font-semibold text-yellow-600 hover:text-yellow-500">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 5MB each (Max 20 files, 50MB total)</p>
                                </label>
                            </div>
                            @error('images')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image Previews -->
                        <div id="imagePreviews" class="grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
                            <!-- Previews will be inserted here by JavaScript -->
                        </div>

                        <div id="imageCount" class="text-sm text-gray-600 hidden">
                            <span class="font-semibold" id="countNumber">0</span> image(s) selected
                        </div>

                        <!-- Common Settings -->
                        <div class="border-t pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Apply to All Images</h3>
                            
                            <div>
                                <label for="title_prefix" class="block text-sm font-semibold text-gray-700 mb-2">Category (Optional)</label>
                                <input type="text" id="title_prefix" name="title_prefix" placeholder="e.g. Championship 2024, Training Session"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('title_prefix') border-red-500 @enderror"
                                    value="{{ old('title_prefix') }}">
                                <p class="text-sm text-gray-500 mt-1">This will be used as the category for all images. Each image will have its own gallery based on filename.</p>
                                @error('title_prefix')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category (Optional)</label>
                                <input type="text" id="category" name="category" placeholder="e.g. Matches, Training, Events"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('category') border-red-500 @enderror"
                                    value="{{ old('category') }}">
                                <p class="text-sm text-gray-500 mt-1">This category will be applied to all uploaded images</p>
                                @error('category')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description (Optional)</label>
                                <textarea id="description" name="description" rows="3" placeholder="Add a description that will apply to all images..."
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">This description will be applied to all uploaded images</p>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4 flex items-center">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_featured" value="1"
                                        class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                    <span class="ml-2 text-sm font-semibold text-gray-700">Mark all as Featured</span>
                                </label>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Note:</strong> Each image will create its own separate gallery based on the filename. The category field will be applied to all images. You can edit individual images after upload to customize further.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div id="progressContainer" class="hidden">
                            <div class="bg-gray-200 rounded-full h-2.5">
                                <div id="progressBar" class="bg-yellow-400 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <p id="progressText" class="text-sm text-gray-600 mt-2">Uploading...</p>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" id="uploadButton" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                <span id="uploadText">Upload Images</span>
                                <span id="uploadSpinner" class="hidden">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-900 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Uploading...
                                </span>
                            </button>
                            <a href="{{ route('admin.gallery.index') }}" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let selectedFiles = [];

        function previewImages(event) {
            const files = Array.from(event.target.files);
            selectedFiles = files;
            
            const previewContainer = document.getElementById('imagePreviews');
            const countElement = document.getElementById('imageCount');
            const countNumber = document.getElementById('countNumber');
            const uploadButton = document.getElementById('uploadButton');
            
            previewContainer.innerHTML = '';
            
            // Validate files
            let validFiles = [];
            let totalSize = 0;
            let errors = [];
            
            files.forEach((file, index) => {
                // Check file type
                if (!file.type.startsWith('image/')) {
                    errors.push(`${file.name}: Not an image file`);
                    return;
                }
                
                // Check file size (5MB limit per file)
                if (file.size > 5 * 1024 * 1024) {
                    errors.push(`${file.name}: File too large (max 5MB)`);
                    return;
                }
                
                // Check total size (50MB limit)
                totalSize += file.size;
                if (totalSize > 50 * 1024 * 1024) {
                    errors.push(`Total size exceeds 50MB limit`);
                    return;
                }
                
                // Check file count (20 files limit)
                if (validFiles.length >= 20) {
                    errors.push(`Maximum 20 files allowed`);
                    return;
                }
                
                validFiles.push(file);
            });
            
            // Show errors if any
            if (errors.length > 0) {
                alert('Upload errors:\n' + errors.join('\n'));
                // Reset input
                event.target.value = '';
                selectedFiles = [];
                previewContainer.classList.add('hidden');
                countElement.classList.add('hidden');
                uploadButton.disabled = true;
                return;
            }
            
            selectedFiles = validFiles;
            
            if (validFiles.length > 0) {
                previewContainer.classList.remove('hidden');
                countElement.classList.remove('hidden');
                countNumber.textContent = validFiles.length;
                uploadButton.disabled = false;
                
                // Show total size
                const sizeText = document.createElement('div');
                sizeText.className = 'text-xs text-gray-500 mt-1';
                sizeText.textContent = `Total size: ${(totalSize / 1024 / 1024).toFixed(2)} MB`;
                countElement.appendChild(sizeText);
                
                validFiles.forEach((file, index) => {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'image-preview relative';
                        preview.innerHTML = `
                            <img src="${e.target.result}" alt="Preview" class="w-full h-32 object-cover rounded-lg">
                            <div class="remove-image" onclick="removeImage(${index})" title="Remove image">×</div>
                            <p class="text-xs text-gray-600 mt-1 truncate">${file.name}</p>
                            <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                        `;
                        previewContainer.appendChild(preview);
                    };
                    
                    reader.readAsDataURL(file);
                });
            } else {
                previewContainer.classList.add('hidden');
                countElement.classList.add('hidden');
                uploadButton.disabled = true;
            }
        }

        function removeImage(index) {
            selectedFiles.splice(index, 1);
            
            // Create a new FileList from remaining files
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            
            // Update the input
            const input = document.getElementById('images');
            input.files = dt.files;
            
            // Trigger preview update
            previewImages({ target: input });
        }

        // Drag and drop functionality
        const dropZone = document.querySelector('.border-dashed');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            dropZone.classList.add('border-yellow-400', 'bg-yellow-50');
        }

        function unhighlight(e) {
            dropZone.classList.remove('border-yellow-400', 'bg-yellow-50');
        }

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            document.getElementById('images').files = files;
            previewImages({ target: document.getElementById('images') });
        }

        // Disable upload button initially
        document.getElementById('uploadButton').disabled = true;

        // Form submission with progress
        document.getElementById('bulkUploadForm').addEventListener('submit', function(e) {
            const uploadButton = document.getElementById('uploadButton');
            const uploadText = document.getElementById('uploadText');
            const uploadSpinner = document.getElementById('uploadSpinner');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            
            // Show progress
            uploadText.classList.add('hidden');
            uploadSpinner.classList.remove('hidden');
            progressContainer.classList.remove('hidden');
            uploadButton.disabled = true;
            
            // Simulate progress (since we can't get real progress from form submission)
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress > 90) progress = 90;
                progressBar.style.width = progress + '%';
                progressText.textContent = `Uploading... ${Math.round(progress)}%`;
            }, 500);
            
            // Clear interval after form submission
            setTimeout(() => {
                clearInterval(progressInterval);
                progressBar.style.width = '100%';
                progressText.textContent = 'Processing images...';
            }, 3000);
        });
    </script>
</body>
</html>

