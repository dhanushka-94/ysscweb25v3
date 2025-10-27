<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title>Chunked Upload Images - Admin - YSSC Football Club</title>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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
        .upload-progress {
            width: 100%;
            height: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
            overflow: hidden;
            margin: 10px 0;
        }
        .upload-progress-bar {
            height: 100%;
            background-color: #4CAF50;
            width: 0%;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php echo $__env->make('admin.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="<?php echo e(route('admin.gallery.index')); ?>" class="text-yellow-600 hover:text-yellow-700">
                    ← Back to Gallery
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Chunked Upload Images</h1>
                <p class="text-gray-600 mb-6">Upload images in smaller chunks to avoid server limits</p>

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
                                <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 5MB each (Max 50 files, 250MB total)</p>
                            </label>
                        </div>
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
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none">
                        </div>

                        <div class="mt-4">
                            <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category (Optional)</label>
                            <input type="text" id="category" name="category" placeholder="e.g. Matches, Training, Events"
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none">
                        </div>

                        <div class="mt-4">
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description (Optional)</label>
                            <textarea id="description" name="description" rows="3" placeholder="Add a description that will apply to all images..."
                                class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none"></textarea>
                        </div>

                        <div class="mt-4 flex items-center">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_featured" value="1"
                                    class="w-4 h-4 text-yellow-600 border-gray-300 rounded focus:ring-yellow-500">
                                <span class="ml-2 text-sm font-semibold text-gray-700">Mark all as Featured</span>
                            </label>
                        </div>
                    </div>

                    <!-- Upload Progress -->
                    <div id="uploadProgress" class="hidden">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Upload Progress</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Overall Progress</span>
                                    <span id="overallProgress">0%</span>
                                </div>
                                <div class="upload-progress">
                                    <div id="overallProgressBar" class="upload-progress-bar"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm text-gray-600 mb-1">
                                    <span>Current File</span>
                                    <span id="currentFileProgress">0%</span>
                                </div>
                                <div class="upload-progress">
                                    <div id="currentFileProgressBar" class="upload-progress-bar"></div>
                                </div>
                            </div>
                            <div id="currentFileName" class="text-sm text-gray-600"></div>
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <button type="button" id="uploadButton" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 disabled:opacity-50 disabled:cursor-not-allowed">
                            Start Chunked Upload
                        </button>
                        <a href="<?php echo e(route('admin.gallery.index')); ?>" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedFiles = [];
        let currentUploadIndex = 0;
        let totalFiles = 0;
        let uploadedFiles = 0;

        function previewImages(event) {
            const files = Array.from(event.target.files);
            selectedFiles = files;
            
            const previewContainer = document.getElementById('imagePreviews');
            const countElement = document.getElementById('imageCount');
            const countNumber = document.getElementById('countNumber');
            const uploadButton = document.getElementById('uploadButton');
            
            previewContainer.innerHTML = '';
            
            if (files.length > 0) {
                previewContainer.classList.remove('hidden');
                countElement.classList.remove('hidden');
                countNumber.textContent = files.length;
                uploadButton.disabled = false;
                
                files.forEach((file, index) => {
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
            
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            
            const input = document.getElementById('images');
            input.files = dt.files;
            
            previewImages({ target: input });
        }

        async function startChunkedUpload() {
            if (selectedFiles.length === 0) {
                alert('Please select files to upload');
                return;
            }

            const uploadButton = document.getElementById('uploadButton');
            const uploadProgress = document.getElementById('uploadProgress');
            
            uploadButton.disabled = true;
            uploadProgress.classList.remove('hidden');
            
            totalFiles = selectedFiles.length;
            uploadedFiles = 0;
            currentUploadIndex = 0;

            // Get form data
            const titlePrefix = document.getElementById('title_prefix').value;
            const category = document.getElementById('category').value;
            const description = document.getElementById('description').value;
            const isFeatured = document.querySelector('input[name="is_featured"]').checked;

            // Upload files one by one
            for (let i = 0; i < selectedFiles.length; i++) {
                currentUploadIndex = i;
                const file = selectedFiles[i];
                
                document.getElementById('currentFileName').textContent = `Uploading: ${file.name}`;
                
                try {
                    await uploadSingleFile(file, titlePrefix, category, description, isFeatured);
                    uploadedFiles++;
                    
                    // Update overall progress
                    const overallProgress = (uploadedFiles / totalFiles) * 100;
                    document.getElementById('overallProgress').textContent = Math.round(overallProgress) + '%';
                    document.getElementById('overallProgressBar').style.width = overallProgress + '%';
                    
                } catch (error) {
                    console.error('Upload failed for file:', file.name, error);
                    alert(`Upload failed for ${file.name}. Please try again.`);
                    break;
                }
            }

            if (uploadedFiles === totalFiles) {
                alert('All files uploaded successfully!');
                window.location.href = '<?php echo e(route("admin.gallery.index")); ?>';
            } else {
                uploadButton.disabled = false;
            }
        }

        async function uploadSingleFile(file, titlePrefix, category, description, isFeatured) {
            const formData = new FormData();
            formData.append('image', file);
            formData.append('title_prefix', titlePrefix);
            formData.append('category', category);
            formData.append('description', description);
            formData.append('is_featured', isFeatured ? '1' : '0');
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            return new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = (e.loaded / e.total) * 100;
                        document.getElementById('currentFileProgress').textContent = Math.round(percentComplete) + '%';
                        document.getElementById('currentFileProgressBar').style.width = percentComplete + '%';
                    }
                });

                xhr.addEventListener('load', function() {
                    if (xhr.status === 200) {
                        resolve();
                    } else {
                        reject(new Error('Upload failed'));
                    }
                });

                xhr.addEventListener('error', function() {
                    reject(new Error('Upload failed'));
                });

                xhr.open('POST', '<?php echo e(route("admin.gallery.chunked-store")); ?>');
                xhr.send(formData);
            });
        }

        // Event listeners
        document.getElementById('uploadButton').addEventListener('click', startChunkedUpload);

        // Disable upload button initially
        document.getElementById('uploadButton').disabled = true;
    </script>
</body>
</html>
<?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/admin/gallery/chunked-upload.blade.php ENDPATH**/ ?>