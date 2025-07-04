

<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0">User Management</h5>
                </div>
                
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                    <?php endif; ?>
                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
                    <?php endif; ?>
                    
                    <!-- Search and Filters -->
                    <div class="mb-4">
                        <form action="<?php echo e(route('admin.users.index')); ?>" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search by name or email" name="search" value="<?php echo e(request('search')); ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <select class="form-select" name="role">
                                    <option value="">All Roles</option>
                                    <option value="user" <?php echo e(request('role') == 'user' ? 'selected' : ''); ?>>User</option>
                                    <option value="admin" <?php echo e(request('role') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <select class="form-select" name="status">
                                    <option value="">All Status</option>
                                    <option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>Inactive</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="<?php echo e(request('start_date')); ?>">
                            </div>
                            
                            <div class="col-md-2">
                                <input type="date" class="form-control" placeholder="End Date" name="end_date" value="<?php echo e(request('end_date')); ?>">
                            </div>
                            
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th width="200">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e(($users->currentPage() - 1) * $users->perPage() + $loop->iteration); ?></td>
                                        <td><?php echo e($user->name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
                                        <td><?php echo e(ucfirst($user->role)); ?></td>
                                        <td>
                                            <?php if($user->status ?? 1): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->created_at->format('Y-m-d')); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="btn btn-sm btn-info">
                                                <i class="ti ti-eye"></i> View
                                            </a>
                                            
                                            <form method="POST" action="<?php echo e(route('admin.users.toggle', $user->id)); ?>" style="display:inline-block;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <button type="submit" class="btn btn-sm <?php echo e(($user->status ?? 1) ? 'btn-warning' : 'btn-success'); ?>">
                                                    <?php echo e(($user->status ?? 1) ? 'Deactivate' : 'Activate'); ?>

                                                </button>
                                            </form>
                                            
                                            <form method="POST" action="<?php echo e(route('admin.users.delete', $user->id)); ?>" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="7" class="text-center">No users found.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($users->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\14\jurislocator_laravel\resources\views/admin/users/index.blade.php ENDPATH**/ ?>