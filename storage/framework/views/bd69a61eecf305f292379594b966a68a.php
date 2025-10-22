<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title>Admin Dashboard - YSSC Football Club</title>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100">
    <?php echo $__env->make('admin.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Page Content -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Sliders</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['sliders']); ?></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">News</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['news']); ?></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Team</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['team']); ?></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Fixtures</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['fixtures']); ?></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Gallery</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['gallery_images']); ?></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Sponsors</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['sponsors']); ?></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Products</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['products']); ?></div>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="text-xs font-semibold text-gray-600 mb-1">Office Bearers</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['office_bearers']); ?></div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <a href="<?php echo e(route('admin.sliders.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Slider
                    </a>
                    <a href="<?php echo e(route('admin.news.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + News
                    </a>
                    <a href="<?php echo e(route('admin.team.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Player
                    </a>
                    <a href="<?php echo e(route('admin.fixtures.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Fixture
                    </a>
                    <a href="<?php echo e(route('admin.gallery.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Image
                    </a>
                    <a href="<?php echo e(route('admin.sponsors.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Sponsor
                    </a>
                    <a href="<?php echo e(route('admin.products.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Product
                    </a>
                    <a href="<?php echo e(route('admin.office-bearers.create')); ?>" class="bg-yellow-400 text-gray-900 px-3 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition text-center text-sm">
                        + Office Bearer
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent News -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Recent News</h2>
                    <?php if($recentNews->count() > 0): ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $recentNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border-b pb-3">
                                    <a href="<?php echo e(route('admin.news.edit', $news)); ?>" class="font-semibold text-gray-900 hover:text-yellow-600">
                                        <?php echo e($news->title); ?>

                                    </a>
                                    <div class="text-sm text-gray-600 mt-1">
                                        <?php echo e($news->created_at->format('M d, Y')); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">No news articles yet.</p>
                    <?php endif; ?>
                </div>

                <!-- Upcoming Fixtures -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Upcoming Fixtures</h2>
                    <?php if($upcomingFixtures->count() > 0): ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $upcomingFixtures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fixture): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="border-b pb-3">
                                    <a href="<?php echo e(route('admin.fixtures.edit', $fixture)); ?>" class="font-semibold text-gray-900 hover:text-yellow-600">
                                        <?php echo e($fixture->home_team); ?> vs <?php echo e($fixture->away_team); ?>

                                    </a>
                                    <div class="text-sm text-gray-600 mt-1">
                                        <?php echo e($fixture->match_date->format('M d, Y h:i A')); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600">No upcoming fixtures scheduled.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>