

<?php $__env->startSection('title', 'Our Team - ' . config('app.name')); ?>
<?php $__env->startSection('description', 'Meet our talented team members from different categories including main team, youth teams, coaching staff, and management.'); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Team</h1>
        <p class="text-lg md:text-xl text-gray-800">Meet the talented individuals who make up our football club family</p>
    </div>
</section>

<!-- Breadcrumbs -->
<div class="bg-gray-50 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="flex items-center">
                        <?php if($breadcrumb['url']): ?>
                            <a href="<?php echo e($breadcrumb['url']); ?>" class="text-yellow-600 hover:text-yellow-700 font-medium">
                                <?php echo e($breadcrumb['title']); ?>

                            </a>
                        <?php else: ?>
                            <span class="text-gray-500 font-medium"><?php echo e($breadcrumb['title']); ?></span>
                        <?php endif; ?>
                        <?php if(!$loop->last): ?>
                            <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </nav>
    </div>
</div>

<!-- Team Categories -->
<div class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php if($categories->count() > 0): ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($category->teams->count() > 0): ?>
                    <div class="mb-16">
                        <!-- Category Header -->
                        <div class="text-center mb-12">
                            <div class="inline-flex items-center space-x-3 mb-4">
                                <div class="w-8 h-8 rounded-full border-2 border-gray-300" style="background-color: <?php echo e($category->color); ?>"></div>
                                <h2 class="text-3xl md:text-4xl font-bold text-gray-900"><?php echo e($category->name); ?></h2>
                            </div>
                            <?php if($category->description): ?>
                                <p class="text-lg text-gray-600 max-w-3xl mx-auto"><?php echo e($category->description); ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Team Members Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                            <?php $__currentLoopData = $category->teams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <!-- Member Photo -->
                                    <div class="relative">
                                        <?php if($member->photo): ?>
                                            <img src="<?php echo e(asset('storage/' . $member->photo)); ?>" 
                                                 alt="<?php echo e($member->name); ?>" 
                                                 class="w-full h-64 object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <!-- Jersey Number Badge -->
                                        <?php if($member->jersey_number): ?>
                                            <div class="absolute top-4 right-4 bg-yellow-400 text-gray-900 px-3 py-1 rounded-full font-bold text-lg">
                                                #<?php echo e($member->jersey_number); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Member Details -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($member->name); ?></h3>
                                        <p class="text-yellow-600 font-semibold mb-2"><?php echo e($member->position); ?></p>
                                        
                                        <?php if($member->nationality): ?>
                                            <p class="text-gray-600 text-sm mb-3"><?php echo e($member->nationality); ?></p>
                                        <?php endif; ?>

                                        <?php if($member->bio): ?>
                                            <p class="text-gray-700 text-sm leading-relaxed"><?php echo e(Str::limit($member->bio, 100)); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Team Members Found</h3>
                <p class="text-gray-600 mb-4">Team members will be displayed here once they are added.</p>
                <a href="<?php echo e(route('member-application.create')); ?>" class="text-yellow-600 hover:text-yellow-700 font-medium">
                    Apply to join our team
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Call to Action -->
<div class="bg-gray-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Want to Join Our Team?</h2>
        <p class="text-xl text-gray-300 mb-8">Be part of our football family and showcase your talent</p>
        <a href="<?php echo e(route('member-application.create')); ?>" 
           class="inline-flex items-center bg-yellow-400 text-gray-900 px-8 py-4 rounded-lg font-semibold hover:bg-yellow-500 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            Apply Now
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/team/index.blade.php ENDPATH**/ ?>