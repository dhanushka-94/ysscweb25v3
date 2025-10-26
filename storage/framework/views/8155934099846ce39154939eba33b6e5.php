<?php
    $latestNews = \App\Models\News::where('is_published', true)
        ->whereNotNull('title')
        ->orderBy('published_at', 'desc')
        ->take(10)
        ->get();
?>

<?php if($latestNews->count() > 0): ?>
    <!-- News Ticker Bar -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-2 relative overflow-hidden shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex items-center">
                <!-- Breaking News Label -->
                <div class="flex-shrink-0 bg-white text-red-600 px-3 py-1 rounded-full mr-4 shadow-md">
                    <span class="text-xs font-bold uppercase tracking-wide flex items-center">
                        <svg class="w-3 h-3 mr-1 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        Latest News
                    </span>
                </div>
                
                <!-- Scrolling News -->
                <div class="flex-1 overflow-hidden">
                    <div class="news-ticker-wrapper">
                        <div class="news-ticker-content">
                            <?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="news-item">
                                    <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="hover:text-yellow-300 transition-colors duration-200">
                                        <?php echo e($news->title); ?>

                                    </a>
                                    <?php if($index < $latestNews->count() - 1): ?>
                                        <span class="mx-4 text-yellow-300">•</span>
                                    <?php endif; ?>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            <!-- Duplicate content for seamless loop -->
                            <?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="news-item">
                                    <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="hover:text-yellow-300 transition-colors duration-200">
                                        <?php echo e($news->title); ?>

                                    </a>
                                    <?php if($index < $latestNews->count() - 1): ?>
                                        <span class="mx-4 text-yellow-300">•</span>
                                    <?php endif; ?>
                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                
                <!-- Controls -->
                <div class="flex-shrink-0 ml-4 flex items-center space-x-3">
                    <!-- Pause/Play Button -->
                    <button id="ticker-toggle" class="text-yellow-300 hover:text-white transition-colors duration-200" title="Pause/Play">
                        <svg id="pause-icon" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <svg id="play-icon" class="w-4 h-4 hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    
                    <!-- View All News Link -->
                    <a href="<?php echo e(route('news')); ?>" class="text-yellow-300 hover:text-white text-sm font-medium transition-colors duration-200">
                        View All →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .news-ticker-wrapper {
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        
        .news-ticker-content {
            display: flex;
            animation: scroll-news 60s linear infinite;
            white-space: nowrap;
        }
        
        .news-ticker-content:hover {
            animation-play-state: paused;
        }
        
        .news-item {
            display: inline-block;
            margin-right: 2rem;
            white-space: nowrap;
        }
        
        @keyframes scroll-news {
            0% {
                transform: translateX(100%);
            }
            100% {
                transform: translateX(-100%);
            }
        }
        
        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .news-ticker-content {
                animation-duration: 40s;
            }
            
            .news-item {
                margin-right: 1.5rem;
            }
            
            .news-ticker-wrapper {
                font-size: 0.875rem;
            }
        }
        
        @media (max-width: 640px) {
            .news-ticker-content {
                animation-duration: 30s;
            }
            
            .news-item {
                margin-right: 1rem;
            }
            
            .news-ticker-wrapper {
                font-size: 0.8rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tickerContent = document.querySelector('.news-ticker-content');
            const toggleButton = document.getElementById('ticker-toggle');
            const pauseIcon = document.getElementById('pause-icon');
            const playIcon = document.getElementById('play-icon');
            
            if (tickerContent && toggleButton) {
                let isPaused = false;
                
                // Toggle pause/play functionality
                toggleButton.addEventListener('click', function() {
                    isPaused = !isPaused;
                    
                    if (isPaused) {
                        tickerContent.style.animationPlayState = 'paused';
                        pauseIcon.classList.add('hidden');
                        playIcon.classList.remove('hidden');
                    } else {
                        tickerContent.style.animationPlayState = 'running';
                        pauseIcon.classList.remove('hidden');
                        playIcon.classList.add('hidden');
                    }
                });
                
                // Auto-pause on hover (optional)
                tickerContent.addEventListener('mouseenter', function() {
                    if (!isPaused) {
                        tickerContent.style.animationPlayState = 'paused';
                    }
                });
                
                tickerContent.addEventListener('mouseleave', function() {
                    if (!isPaused) {
                        tickerContent.style.animationPlayState = 'running';
                    }
                });
            }
        });
    </script>
<?php endif; ?>
<?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/components/news-ticker.blade.php ENDPATH**/ ?>