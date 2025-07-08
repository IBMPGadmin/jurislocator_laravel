

<?php $__env->startSection('admin-content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Government Link Details</h5>
                    <a href="<?php echo e(route('admin.government-links.index')); ?>" class="btn btn-custom">Back to List</a>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-muted">Name</h6>
                        <p class="lead"><?php echo e($link->name); ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-muted">URL</h6>
                        <p><a href="<?php echo e($link->url); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($link->url); ?></a></p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-muted">Category</h6>
                        <p><?php echo e($link->category ?: 'Not specified'); ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-muted">Description</h6>
                        <p><?php echo e($link->description ?: 'No description available'); ?></p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-muted">Status</h6>
                        <p>
                            <span class="badge <?php echo e($link->active ? 'bg-success' : 'bg-danger'); ?>">
                                <?php echo e($link->active ? 'Active' : 'Inactive'); ?>

                            </span>
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-muted">Sort Order</h6>
                        <p><?php echo e($link->sort_order); ?></p>
                    </div>
                    
                    <div class="d-flex justify-content-between mt-4">                        <a href="<?php echo e(route('admin.government-links.edit', $link->id)); ?>" class="btn btn-primary">Edit</a>
                        <form action="<?php echo e(route('admin.government-links.destroy', $link->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this link?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\government-links\show.blade.php ENDPATH**/ ?>