<?php $__env->startSection('admin-content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">RCIC Deadlines</h5>
                    <div>
                        <a href="<?php echo e(route('admin.rcic-deadlines.index')); ?>?export=csv" class="btn btn-secondary me-2">Export to CSV</a>
                        <a href="<?php echo e(route('admin.rcic-deadlines.create')); ?>" class="btn btn-custom">Add New Deadline</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <!-- Search Form -->
                    <div class="mb-4">
                        <form action="<?php echo e(route('admin.rcic-deadlines.index')); ?>" method="GET" class="row g-3" id="searchForm">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by title or category" name="search" value="<?php echo e(request('search')); ?>" id="searchInput">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-search"></i> Search
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="category" class="form-select" id="categoryFilter">
                                    <option value="">All Categories</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category); ?>" <?php echo e(request('category') == $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-select" id="statusFilter">
                                    <option value="">All Status</option>
                                    <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                                    <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ti ti-filter"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Days Before</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $deadlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deadline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($deadline->title); ?></td>
                                        <td><?php echo e($deadline->category); ?></td>
                                        <td><?php echo e($deadline->type); ?></td>
                                        <td><?php echo e($deadline->description); ?></td>
                                        <td><?php echo e($deadline->days_before); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($deadline->status == 'active' ? 'success' : 'secondary'); ?>">
                                                <?php echo e(ucfirst($deadline->status)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.rcic-deadlines.edit', $deadline->id)); ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="<?php echo e(route('admin.rcic-deadlines.destroy', $deadline->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger btn-delete" onclick="return confirm('Are you sure you want to delete this deadline?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No deadlines found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <?php echo e($deadlines->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/immif732/jurislocator/resources/views/rcic-deadlines/index.blade.php ENDPATH**/ ?>