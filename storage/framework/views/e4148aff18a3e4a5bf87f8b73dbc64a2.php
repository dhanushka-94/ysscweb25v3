

<?php $__env->startSection('title', 'League - YSSC Football Club'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">League</h1>
            <p class="text-xl text-gray-800">Competition standings and results</p>
        </div>
    </section>

    <!-- League Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Recent Results -->
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Recent Results</h2>
                    <?php if($fixtures->where('status', 'finished')->count() > 0): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $fixtures->where('status', 'finished')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fixture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm text-gray-600"><?php echo e($fixture->match_date->format('M d')); ?></div>
                                        <div class="flex items-center gap-4 flex-1 justify-center">
                                            <div class="text-right flex-1">
                                                <span class="font-semibold"><?php echo e($fixture->home_team); ?></span>
                                            </div>
                                            <div class="text-xl font-bold text-yellow-500">
                                                <?php echo e($fixture->home_score); ?> - <?php echo e($fixture->away_score); ?>

                                            </div>
                                            <div class="text-left flex-1">
                                                <span class="font-semibold"><?php echo e($fixture->away_team); ?></span>
                                            </div>
                                        </div>
                                        <div class="text-sm text-gray-600"><?php echo e($fixture->competition); ?></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">No results available yet.</p>
                    <?php endif; ?>
                </div>

                <!-- All Fixtures -->
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">All Fixtures</h2>
                    <?php if($fixtures->count() > 0): ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $fixtures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fixture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white border-2 border-gray-200 rounded-lg p-4">
                                    <div class="flex flex-col md:flex-row md:items-center gap-4">
                                        <div class="md:w-1/4 text-sm text-gray-600">
                                            <?php echo e($fixture->match_date->format('M d, Y')); ?>

                                        </div>
                                        <div class="md:w-2/4 flex items-center justify-center gap-4">
                                            <div class="text-center flex-1 font-semibold"><?php echo e($fixture->home_team); ?></div>
                                            <?php if($fixture->status === 'finished'): ?>
                                                <div class="text-xl font-bold text-yellow-500">
                                                    <?php echo e($fixture->home_score); ?> - <?php echo e($fixture->away_score); ?>

                                                </div>
                                            <?php else: ?>
                                                <div class="text-xl font-bold text-yellow-500">VS</div>
                                            <?php endif; ?>
                                            <div class="text-center flex-1 font-semibold"><?php echo e($fixture->away_team); ?></div>
                                        </div>
                                        <div class="md:w-1/4 text-right">
                                            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                                <?php if($fixture->status === 'scheduled'): ?> bg-blue-100 text-blue-800
                                                <?php elseif($fixture->status === 'live'): ?> bg-green-100 text-green-800
                                                <?php elseif($fixture->status === 'finished'): ?> bg-gray-100 text-gray-800
                                                <?php else: ?> bg-yellow-100 text-yellow-800
                                                <?php endif; ?>">
                                                <?php echo e(ucfirst($fixture->status)); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="mt-8">
                            <?php echo e($fixtures->links()); ?>

                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">No fixtures available yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/sportspress/league.blade.php ENDPATH**/ ?>