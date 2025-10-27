<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> - YSSC Football Club</title>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-100">
    <?php echo $__env->make('admin.partials.nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Page Content -->
    <div class="py-12">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- Admin Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left mb-4 md:mb-0">
                    <p class="text-sm text-gray-300">
                        &copy; <?php echo e(date('Y')); ?> Young Silver Sports Club. All rights reserved.
                    </p>
                </div>
                <div class="text-center md:text-right">
                    <p class="text-xs text-gray-400">
                        Developed by 
                        <a href="https://olexto.com" target="_blank" class="text-yellow-400 hover:text-yellow-300 transition">
                            Olexto Digital Solutions (Pvt) Ltd
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

<?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/layouts/admin.blade.php ENDPATH**/ ?>