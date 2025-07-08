

<?php $__env->startSection('admin-content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">RCIC Deadline Details</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Title</dt>
                        <dd class="col-sm-8"><?php echo e($deadline->title); ?></dd>
                        <dt class="col-sm-4">Category</dt>
                        <dd class="col-sm-8"><?php echo e($deadline->category); ?></dd>
                        <dt class="col-sm-4">Description</dt>
                        <dd class="col-sm-8"><?php echo e($deadline->description); ?></dd>
                        <dt class="col-sm-4">Deadline Date</dt>
                        <dd class="col-sm-8"><?php echo e($deadline->deadline_date ? $deadline->deadline_date->format('Y-m-d') : ''); ?></dd>
                        <dt class="col-sm-4">Days Before</dt>
                        <dd class="col-sm-8"><?php echo e($deadline->days_before); ?></dd>
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-<?php echo e($deadline->status == 'active' ? 'success' : 'secondary'); ?>">
                                <?php echo e(ucfirst($deadline->status)); ?>

                            </span>
                        </dd>
                    </dl>
                    <a href="<?php echo e(route('admin.rcic-deadlines.edit', $deadline->id)); ?>" class="btn btn-primary">Edit</a>
                    <a href="<?php echo e(route('admin.rcic-deadlines.index')); ?>" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\rcic-deadlines\show.blade.php ENDPATH**/ ?>