

<?php $__env->startSection('title', 'Gallery - YSSC Football Club'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Gallery</h1>
            <p class="text-xl text-gray-800">Memories and moments</p>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <?php if($categories->count() > 0): ?>
                <div class="flex flex-wrap gap-2 mb-8 justify-center">
                    <a href="<?php echo e(route('gallery')); ?>" class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        All
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('gallery', ['category' => $category])); ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            <?php echo e($category); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if($images->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group relative aspect-square overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                            <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" alt="<?php echo e($image->title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition duration-300 flex items-end">
                                <div class="p-4 text-white">
                                    <h3 class="font-bold text-lg"><?php echo e($image->title); ?></h3>
                                    <?php if($image->description): ?>
                                        <p class="text-sm text-gray-200"><?php echo e(Str::limit($image->description, 60)); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-12">
                    <?php echo e($images->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-600">No images available yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/gallery/index.blade.php ENDPATH**/ ?>