

<?php $__env->startSection('title', 'Fixtures - YSSC Football Club'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Fixtures</h1>
            <p class="text-xl text-gray-800">View all matches and results</p>
        </div>
    </section>

    <!-- Fixtures List -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <?php if($fixtures->count() > 0): ?>
                <div class="max-w-4xl mx-auto space-y-6">
                    <?php $__currentLoopData = $fixtures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fixture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white border-2 border-gray-200 rounded-lg p-6 hover:border-yellow-400 transition">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="text-sm text-gray-600 mb-2">
                                        <?php echo e($fixture->match_date->format('l, M d, Y \a\t h:i A')); ?>

                                    </div>
                                    <?php if($fixture->competition): ?>
                                        <div class="text-xs text-yellow-600 font-semibold mb-2"><?php echo e($fixture->competition); ?></div>
                                    <?php endif; ?>
                                </div>

                                <div class="flex items-center justify-center gap-6 flex-1">
                                    <div class="text-center flex-1">
                                        <div class="font-bold text-lg text-gray-900"><?php echo e($fixture->home_team); ?></div>
                                    </div>
                                    
                                    <?php if($fixture->status === 'finished' && $fixture->home_score !== null): ?>
                                        <div class="text-2xl font-bold text-yellow-500 px-4">
                                            <?php echo e($fixture->home_score); ?> - <?php echo e($fixture->away_score); ?>

                                        </div>
                                    <?php else: ?>
                                        <div class="text-2xl font-bold text-yellow-500 px-4">VS</div>
                                    <?php endif; ?>
                                    
                                    <div class="text-center flex-1">
                                        <div class="font-bold text-lg text-gray-900"><?php echo e($fixture->away_team); ?></div>
                                    </div>
                                </div>

                                <div class="text-center flex-1">
                                    <?php if($fixture->venue): ?>
                                        <div class="text-sm text-gray-600 mb-1"><?php echo e($fixture->venue); ?></div>
                                    <?php endif; ?>
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                        <?php if($fixture->status === 'scheduled'): ?> bg-blue-100 text-blue-800
                                        <?php elseif($fixture->status === 'live'): ?> bg-green-100 text-green-800
                                        <?php elseif($fixture->status === 'finished'): ?> bg-gray-100 text-gray-800
                                        <?php elseif($fixture->status === 'postponed'): ?> bg-yellow-100 text-yellow-800
                                        <?php else: ?> bg-red-100 text-red-800
                                        <?php endif; ?>">
                                        <?php echo e(ucfirst($fixture->status)); ?>

                                    </span>
                                </div>
                            </div>
                            
                            <?php if($fixture->notes): ?>
                                <div class="mt-4 pt-4 border-t border-gray-200 text-sm text-gray-600">
                                    <?php echo e($fixture->notes); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-8">
                    <?php echo e($fixtures->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-600">No fixtures available at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/sportspress/fixtures.blade.php ENDPATH**/ ?>