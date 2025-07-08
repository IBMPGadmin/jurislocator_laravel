

<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-light-primary">
                                    <div class="avatar-texts">
                                        <i class="ti ti-users" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e($stats['total_users']); ?></h5>
                                    <p class="text-muted mb-0">Total Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-light-success">
                                    <div class="avatar-texts">
                                        <i class="ti ti-user-check" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e($stats['active_users']); ?></h5>
                                    <p class="text-muted mb-0">Active Users</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-light-warning">
                                    <div class="avatar-texts">
                                        <i class="ti ti-credit-card" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e($stats['users_with_subscriptions']); ?></h5>
                                    <p class="text-muted mb-0">With Subscriptions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-light-info">
                                    <div class="avatar-texts">
                                        <i class="ti ti-user-plus" style="font-size: 24px;"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo e($stats['users_this_month']); ?></h5>
                                    <p class="text-muted mb-0">New This Month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Users Report</h5>
                    <div>
                        <a href="<?php echo e(route('admin.reports.users.export', request()->query())); ?>" class="btn btn-light">
                            <i class="ti ti-file-download me-1"></i> Download PDF
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Search and Filters -->
                    <div class="mb-4">
                        <form action="<?php echo e(route('admin.reports.users')); ?>" method="GET" class="row g-3">
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
                                    <option value="1" <?php echo e(request('status') === '1' ? 'selected' : ''); ?>>Active</option>
                                    <option value="0" <?php echo e(request('status') === '0' ? 'selected' : ''); ?>>Inactive</option>
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
                                    <th>Subscription</th>
                                    <th>Created On</th>
                                    <th>Action</th>
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
                                        <td>
                                            <?php
                                                $activeSubscription = $user->activeSubscription();
                                            ?>
                                            
                                            <?php if($activeSubscription): ?>
                                                <?php if($activeSubscription->isActiveSubscription()): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php elseif($activeSubscription->isTrialSubscription()): ?>
                                                    <span class="badge bg-info">Trial</span>
                                                <?php elseif($activeSubscription->isCanceled()): ?>
                                                    <span class="badge bg-secondary">Canceled</span>
                                                <?php elseif($activeSubscription->isExpired()): ?>
                                                    <span class="badge bg-warning">Expired</span>
                                                <?php endif; ?>
                                                <span class="ms-1 small"><?php echo e($activeSubscription->package->name ?? 'N/A'); ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">None</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e($user->created_at->format('M d, Y')); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.users.show', $user->id)); ?>" class="btn btn-sm btn-info">
                                                <i class="ti ti-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="8" class="text-center">No users found.</td></tr>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\admin\reports\users.blade.php ENDPATH**/ ?>