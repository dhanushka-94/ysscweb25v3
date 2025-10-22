<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title>Bulk Upload Images - Admin - YSSC Football Club</title>
    
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
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Bulk Upload Images</h1>
                <p class="text-gray-600 mb-6">Upload multiple images to the gallery at once</p>

                <form action="<?php echo e(route('admin.gallery.bulk-store')); ?>" method="POST" enctype="multipart/form-data" id="bulkUploadForm">
                    <?php echo csrf_field(); ?>
                    
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
                                    <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 2MB each</p>
                                </label>
                            </div>
                            <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php $__errorArgs = ['images.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                <label for="title_prefix" class="block text-sm font-semibold text-gray-700 mb-2">Title Prefix (Optional)</label>
                                <input type="text" id="title_prefix" name="title_prefix" placeholder="e.g. Championship 2024, Training Session"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none <?php $__errorArgs = ['title_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('title_prefix')); ?>">
                                <p class="text-sm text-gray-500 mt-1">This will be added before each auto-generated title (e.g., "Championship 2024 - Image Name")</p>
                                <?php $__errorArgs = ['title_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mt-4">
                                <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Category (Optional)</label>
                                <input type="text" id="category" name="category" placeholder="e.g. Matches, Training, Events"
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    value="<?php echo e(old('category')); ?>">
                                <p class="text-sm text-gray-500 mt-1">This category will be applied to all uploaded images</p>
                                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mt-4">
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description (Optional)</label>
                                <textarea id="description" name="description" rows="3" placeholder="Add a description that will apply to all images..."
                                    class="w-full px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-yellow-400 focus:outline-none <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('description')); ?></textarea>
                                <p class="text-sm text-gray-500 mt-1">This description will be applied to all uploaded images</p>
                                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                        <strong>Note:</strong> Image titles will be automatically generated from filenames (with optional prefix). Title prefix, category, and description (if provided) will apply to all images. You can edit individual images after upload to customize further.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" id="uploadButton" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                Upload Images
                            </button>
                            <a href="<?php echo e(route('admin.gallery.index')); ?>" class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-300">
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
    </script>
</body>
</html>

<?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/admin/gallery/bulk-upload.blade.php ENDPATH**/ ?>