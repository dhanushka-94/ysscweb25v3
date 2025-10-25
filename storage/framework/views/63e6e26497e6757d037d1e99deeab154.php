<?php $__env->startSection('title', 'Our History - Young Silver Sports Club'); ?>
<?php $__env->startSection('description', 'Discover the rich history of Young Silver Sports Club since 1967. From humble beginnings to becoming a premier football club in Wellawatte, Colombo.'); ?>
<?php $__env->startSection('keywords', 'Young Silver Sports Club history, YSSC history, football club history, Colombo football, Wellawatte sports, Sri Lanka football history, 1967, football club founded'); ?>
<?php $__env->startSection('og_title', 'Our History - Young Silver Sports Club'); ?>
<?php $__env->startSection('og_description', 'Discover the rich history of Young Silver Sports Club since 1967. From humble beginnings to becoming a premier football club in Wellawatte, Colombo.'); ?>
<?php $__env->startSection('og_type', 'article'); ?>
<?php $__env->startSection('twitter_title', 'Our History - Young Silver Sports Club'); ?>
<?php $__env->startSection('twitter_description', 'Discover the rich history of Young Silver Sports Club since 1967. From humble beginnings to becoming a premier football club in Wellawatte, Colombo.'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Page Header -->
    <section class="bg-gradient-to-r from-yellow-400 to-yellow-500 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our History</h1>
            <p class="text-lg md:text-xl text-gray-800">The story of Young Silver Sports Club</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-12">
                <!-- Image -->
                <div class="order-2 lg:order-1">
                    <img src="<?php echo e(asset('images/out_history.jpg')); ?>" alt="Our History" class="rounded-lg shadow-xl w-full h-auto">
                </div>
                
                <!-- Text Content -->
                <div class="order-1 lg:order-2">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">BRIEF HISTORY OF THE YOUNG SILVER SPORTS CLUB</h2>
                    <div class="space-y-4 text-gray-700 leading-relaxed text-base md:text-lg">
                        <p>
                            The Young Silver Sports Club was formed in the year <strong class="text-yellow-600">1967</strong>. The first president and Secretary of club were Mr. Anton and Mr. Thalib respectively.
                        </p>
                        <p>
                            As most of the youths in the area were from poor families, The burden of purchasing sports equipment for the Club fell on these two gentlemen who hesitantly set about the task by spending out of their own pockets. Owing to the keen interest and devotion shown by the membership and all committees of management during the past years. The Young Silver Sports Club was able to slowly but steadily progress to what it is today.
                        </p>
                        <p>
                            The Club has participated in the past football tournaments organized by the Federation of Sri Lanka. Several of the outstanding players of the club have later joined several A Division Clubs and have participated in major football tournaments.
                        </p>
                        <p>
                            The members of the Club, in addition to sports activities have also organized and practiced in activities connected with the charities and many other activities in the area.
                        </p>
                        <p>
                            Lastly it must also be mentioned with gratitude the support and guidance given to the Club by the elders of the area who have contributed immensely to the progress of the Club.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="mt-16 bg-gray-50 rounded-lg p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Our Journey</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-4xl font-bold text-yellow-500 mb-2">1967</div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Foundation</h4>
                        <p class="text-gray-600">The Young Silver Sports Club was established by Mr. Anton and Mr. Thalib</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <div class="text-4xl font-bold text-yellow-500 mb-2">1984</div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Official Registration</h4>
                        <p class="text-gray-600">Registered at Football Federation of Sri Lanka</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/about/history.blade.php ENDPATH**/ ?>