

<?php $__env->startSection('title', 'View Application - Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Application Details</h1>
        <div class="flex space-x-4">
            <a href="<?php echo e(route('admin.member-applications.index')); ?>" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                Back to List
            </a>
            <a href="<?php echo e(route('admin.member-applications.edit', $memberApplication)); ?>" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg hover:bg-yellow-500 transition">
                Edit Application
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Personal Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Personal Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->full_name); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->email); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIC</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->formatted_nic); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number 1</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->formatted_contact_number_1); ?></p>
                    </div>
                    
                    <?php if($memberApplication->contact_number_2): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number 2</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->contact_number_2); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <p class="text-gray-900"><?php echo e($memberApplication->address); ?></p>
                </div>
            </div>

            <!-- Guardian Information -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Guardian/Parent Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->guardian_full_name); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIC</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->formatted_guardian_nic); ?></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number 1</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->formatted_guardian_contact_number_1); ?></p>
                    </div>
                    
                    <?php if($memberApplication->guardian_contact_number_2): ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number 2</label>
                        <p class="text-gray-900"><?php echo e($memberApplication->guardian_contact_number_2); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                    <p class="text-gray-900"><?php echo e($memberApplication->guardian_address); ?></p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Profile Photo -->
            <?php if($memberApplication->profile_photo && file_exists(public_path('storage/' . $memberApplication->profile_photo))): ?>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Photo</h3>
                <img src="<?php echo e(asset('storage/' . $memberApplication->profile_photo)); ?>" alt="Profile Photo" class="w-full h-64 object-cover rounded-lg">
            </div>
            <?php else: ?>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Photo</h3>
                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-gray-300 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-gray-600"><?php echo e(substr($memberApplication->full_name, 0, 1)); ?></span>
                        </div>
                        <p class="text-gray-500">No profile photo available</p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Application Status -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Status</h3>
                
                <div class="mb-4">
                    <?php if($memberApplication->status === 'pending'): ?>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending Review</span>
                    <?php elseif($memberApplication->status === 'approved'): ?>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Approved</span>
                    <?php else: ?>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">Rejected</span>
                    <?php endif; ?>
                </div>

                <div class="text-sm text-gray-600">
                    <p><strong>Applied:</strong> <?php echo e($memberApplication->created_at->format('M d, Y g:i A')); ?></p>
                    <?php if($memberApplication->updated_at != $memberApplication->created_at): ?>
                        <p><strong>Last Updated:</strong> <?php echo e($memberApplication->updated_at->format('M d, Y g:i A')); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    <?php if($memberApplication->status === 'pending'): ?>
                        <form action="<?php echo e(route('admin.member-applications.approve', $memberApplication)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                                Approve Application
                            </button>
                        </form>
                        
                        <button onclick="openRejectModal()" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                            Reject Application
                        </button>
                    <?php endif; ?>
                    
                    <a href="<?php echo e(route('admin.member-applications.edit', $memberApplication)); ?>" class="block w-full bg-yellow-400 text-gray-900 px-4 py-2 rounded-lg hover:bg-yellow-500 transition text-center">
                        Edit Application
                    </a>
                </div>
            </div>

            <!-- Notes -->
            <?php if($memberApplication->notes || $memberApplication->rejection_reason): ?>
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Notes</h3>
                
                <?php if($memberApplication->notes): ?>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded"><?php echo e($memberApplication->notes); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if($memberApplication->rejection_reason): ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Rejection Reason</label>
                    <p class="text-gray-900 bg-red-50 p-3 rounded"><?php echo e($memberApplication->rejection_reason); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <form action="<?php echo e(route('admin.member-applications.reject', $memberApplication)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Reject Application</h3>
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Rejection Reason *</label>
                        <textarea id="rejection_reason" name="rejection_reason" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Please provide a reason for rejection..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        Reject Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openRejectModal() {
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dhanushka\Desktop\YSSC\YSSCWEBv3\resources\views/admin/member-applications/show.blade.php ENDPATH**/ ?>