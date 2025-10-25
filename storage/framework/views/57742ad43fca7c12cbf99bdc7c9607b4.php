<?php $__env->startSection('title', 'News - Young Silver Sports Club'); ?>
<?php $__env->startSection('description', 'Stay updated with the latest news from Young Silver Sports Club. Get the latest updates on matches, events, and club activities.'); ?>
<?php $__env->startSection('keywords', 'Young Silver Sports Club news, YSSC news, football club news, Colombo football news, Wellawatte sports news, Sri Lanka football news, latest news, club updates'); ?>
<?php $__env->startSection('og_title', 'News - Young Silver Sports Club'); ?>
<?php $__env->startSection('og_description', 'Stay updated with the latest news from Young Silver Sports Club. Get the latest updates on matches, events, and club activities.'); ?>
<?php $__env->startSection('og_type', 'website'); ?>
<?php $__env->startSection('twitter_title', 'News - Young Silver Sports Club'); ?>
<?php $__env->startSection('twitter_description', 'Stay updated with the latest news from Young Silver Sports Club. Get the latest updates on matches, events, and club activities.'); ?>

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
                                <div class="flex items-center justify-between">
                                    <a href="<?php echo e(route('news.show', $article->slug)); ?>" class="inline-block text-yellow-600 font-semibold hover:text-yellow-700 transition">
                                        Read More →
                                    </a>
                                    
                                    <!-- Social Share Buttons -->
                                    <div class="flex items-center space-x-2">
                                        <!-- Facebook Share -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(route('news.show', $article->slug))); ?>&quote=<?php echo e(urlencode($article->title)); ?>" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-200"
                                           title="Share on Facebook">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                            </svg>
                                        </a>

                                        <!-- Twitter Share -->
                                        <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(route('news.show', $article->slug))); ?>&text=<?php echo e(urlencode($article->title)); ?>" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center justify-center w-8 h-8 bg-blue-400 text-white rounded-full hover:bg-blue-500 transition duration-200"
                                           title="Share on Twitter">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                            </svg>
                                        </a>

                                        <!-- WhatsApp Share -->
                                        <a href="https://wa.me/?text=<?php echo e(urlencode($article->title . ' - ' . route('news.show', $article->slug))); ?>" 
                                           target="_blank" 
                                           rel="noopener noreferrer"
                                           class="inline-flex items-center justify-center w-8 h-8 bg-green-500 text-white rounded-full hover:bg-green-600 transition duration-200"
                                           title="Share on WhatsApp">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
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