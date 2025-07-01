<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><?php echo e(__('Profile Information')); ?></h3>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
                
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0"><?php echo e(__('Update Password')); ?></h3>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
                
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        <h3 class="mb-0"><?php echo e(__('Delete Account')); ?></h3>
                    </div>
                    <div class="card-body">
                        <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .profile-image-container {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 20px auto;
        border: 3px solid #f8f9fa;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .profile-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef;
        color: #6c757d;
    }
</style>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ardent\Desktop\j.v1-main\j.v1-main\resources\views/profile/edit.blade.php ENDPATH**/ ?>