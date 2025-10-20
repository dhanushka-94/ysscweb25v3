

<?php $__env->startSection('title', 'Shop - YSSC Football Club'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Club Shop</h1>
            <p class="text-xl text-gray-800">Get your official merchandise</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <?php if($categories->count() > 0): ?>
                <div class="flex flex-wrap gap-2 mb-8 justify-center">
                    <a href="<?php echo e(route('shop')); ?>" class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg font-semibold hover:bg-yellow-500 transition">
                        All Products
                    </a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('shop', ['category' => $category])); ?>" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            <?php echo e($category); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if($products->count() > 0): ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                            <a href="<?php echo e(route('shop.show', $product->slug)); ?>">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-64 object-cover">
                                <?php else: ?>
                                    <div class="w-full h-64 bg-gradient-to-br from-yellow-400 to-yellow-500 flex items-center justify-center">
                                        <span class="text-4xl font-bold text-white"><?php echo e(substr($product->name, 0, 1)); ?></span>
                                    </div>
                                <?php endif; ?>
                            </a>
                            <div class="p-4">
                                <div class="text-xs text-gray-600 mb-1"><?php echo e($product->category); ?></div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo e($product->name); ?></h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-yellow-600">$<?php echo e(number_format($product->price, 2)); ?></span>
                                    <?php if($product->stock > 0): ?>
                                        <span class="text-xs text-green-600 font-semibold">In Stock</span>
                                    <?php else: ?>
                                        <span class="text-xs text-red-600 font-semibold">Out of Stock</span>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo e(route('shop.show', $product->slug)); ?>" class="mt-4 block w-full text-center bg-yellow-400 text-gray-900 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-12">
                    <?php echo e($products->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-600">No products available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/shop/index.blade.php ENDPATH**/ ?>