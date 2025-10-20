

<?php $__env->startSection('title', 'Sponsors - YSSC Football Club'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Our Sponsors</h1>
            <p class="text-xl text-gray-800">Thank you to our amazing partners</p>
        </div>
    </section>

    <!-- Sponsors -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <?php if($sponsors->count() > 0): ?>
                <div class="max-w-6xl mx-auto space-y-16">
                    <?php $__currentLoopData = ['platinum', 'gold', 'silver', 'bronze']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($sponsors->has($tier)): ?>
                            <div>
                                <h2 class="text-3xl font-bold text-center mb-8
                                    <?php if($tier === 'platinum'): ?> text-gray-800
                                    <?php elseif($tier === 'gold'): ?> text-yellow-600
                                    <?php elseif($tier === 'silver'): ?> text-gray-500
                                    <?php else: ?> text-yellow-700
                                    <?php endif; ?>">
                                    <?php echo e(ucfirst($tier)); ?> Sponsors
                                </h2>
                                <div class="grid gap-8
                                    <?php if($tier === 'platinum'): ?> grid-cols-1 md:grid-cols-2
                                    <?php elseif($tier === 'gold'): ?> grid-cols-2 md:grid-cols-3
                                    <?php else: ?> grid-cols-2 md:grid-cols-4
                                    <?php endif; ?>">
                                    <?php $__currentLoopData = $sponsors[$tier]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sponsor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="bg-white border-2 border-gray-200 rounded-lg p-8 hover:border-yellow-400 transition flex flex-col items-center justify-center text-center">
                                            <?php if($sponsor->logo): ?>
                                                <img src="<?php echo e(asset('storage/' . $sponsor->logo)); ?>" alt="<?php echo e($sponsor->name); ?>" class="max-h-24 w-auto mb-4">
                                            <?php endif; ?>
                                            <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($sponsor->name); ?></h3>
                                            <?php if($sponsor->description): ?>
                                                <p class="text-sm text-gray-600 mb-4"><?php echo e($sponsor->description); ?></p>
                                            <?php endif; ?>
                                            <?php if($sponsor->website): ?>
                                                <a href="<?php echo e($sponsor->website); ?>" target="_blank" rel="noopener noreferrer" class="text-yellow-600 hover:text-yellow-700 font-semibold text-sm">
                                                    Visit Website →
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-600">Sponsor information will be updated soon.</p>
                </div>
            <?php endif; ?>

            <!-- Become a Sponsor CTA -->
            <div class="mt-20 max-w-4xl mx-auto text-center bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-lg p-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Become a Sponsor</h2>
                <p class="text-xl text-gray-800 mb-8">
                    Join our family of supporters and help us achieve greatness. Partner with YSSC FC today!
                </p>
                <a href="<?php echo e(route('contact')); ?>" class="inline-block bg-gray-900 text-white px-8 py-4 rounded-lg font-semibold hover:bg-gray-800 transition">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/sponsors/index.blade.php ENDPATH**/ ?>