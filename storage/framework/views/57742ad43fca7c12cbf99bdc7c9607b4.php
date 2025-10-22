

<?php $__env->startSection('title', 'News - YSSC Football Club'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Latest News</h1>
            <p class="text-xl text-gray-800">Stay updated with YSSC FC</p>
        </div>
    </section>

    <!-- News Grid -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <?php if($news->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                    <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition">
                            <?php if($article->featured_image): ?>
                                <img src="<?php echo e(asset('storage/' . $article->featured_image)); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-56 object-cover">
                            <?php else: ?>
                                <div class="w-full h-56 bg-gradient-to-br from-yellow-400 to-yellow-500"></div>
                            <?php endif; ?>
                            <div class="p-6">
                                <div class="text-sm text-gray-600 mb-2"><?php echo e($article->published_at->format('F d, Y')); ?></div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3"><?php echo e($article->title); ?></h3>
                                <?php if($article->excerpt): ?>
                                    <p class="text-gray-600 mb-4"><?php echo e(Str::limit($article->excerpt, 120)); ?></p>
                                <?php endif; ?>
                                <a href="<?php echo e(route('news.show', $article->slug)); ?>" class="inline-block text-yellow-600 font-semibold hover:text-yellow-700 transition">
                                    Read More →
                                </a>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-12">
                    <?php echo e($news->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <p class="text-gray-600">No news articles available yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/news/index.blade.php ENDPATH**/ ?>