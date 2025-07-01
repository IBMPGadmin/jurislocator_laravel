<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid">
    <!-- Page header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="page-title">Payment Dashboard</h2>
                <p class="text-muted">View and manage all payment transactions</p>
            </div>
            <div class="col-md-6 text-end">
                <button id="export-pdf" class="btn btn-primary">
                    <i class="ti ti-file-download me-1"></i> Export to PDF
                </button>
            </div>
        </div>
    </div>

    <!-- Statistics cards -->
    <div class="row">
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-primary">
                                <i class="ti ti-currency-dollar f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Total Revenue</h6>
                            <p class="text-primary mb-0">$<?php echo e(number_format($stats['total_revenue'], 2)); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-success">
                                <i class="ti ti-receipt f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Total Payments</h6>
                            <p class="text-success mb-0"><?php echo e($stats['total_payments']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ti ti-users f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Active Subscriptions</h6>
                            <p class="text-warning mb-0"><?php echo e($stats['active_subscriptions']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-danger">
                                <i class="ti ti-calendar f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Payments This Month</h6>
                            <p class="text-danger mb-0"><?php echo e($stats['payments_this_month']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and filters -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="<?php echo e(route('admin.payments.index')); ?>" method="GET" id="search-form">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control" placeholder="Search by user name or email" name="search" value="<?php echo e(request('search')); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-package"></i></span>
                            <select class="form-select" name="package">
                                <option value="">All Packages</option>
                                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($package->id); ?>" <?php echo e(request('package') == $package->id ? 'selected' : ''); ?>>
                                    <?php echo e($package->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-activity"></i></span>
                            <select class="form-select" name="status">
                                <option value="">All Status</option>
                                <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                                <option value="canceled" <?php echo e(request('status') == 'canceled' ? 'selected' : ''); ?>>Canceled</option>
                                <option value="expired" <?php echo e(request('status') == 'expired' ? 'selected' : ''); ?>>Expired</option>
                                <option value="trial" <?php echo e(request('status') == 'trial' ? 'selected' : ''); ?>>Trial</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-calendar-event"></i></span>
                            <input type="date" class="form-control" placeholder="Start Date" name="start_date" value="<?php echo e(request('start_date')); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-calendar-event"></i></span>
                            <input type="date" class="form-control" placeholder="End Date" name="end_date" value="<?php echo e(request('end_date')); ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ti ti-filter me-1"></i> Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Payments table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>                            <th>ID</th>
                            <th>User</th>
                            <th>Package</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($subscription->id); ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <?php if($subscription->user && $subscription->user->profile_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $subscription->user->profile_image)); ?>" alt="Profile" class="rounded-circle me-2" width="35" height="35">
                                    <?php else: ?>
                                    <div class="avtar avtar-xs bg-light-primary rounded-circle me-2">
                                        <i class="ti ti-user f-16"></i>
                                    </div>
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="mb-0"><?php echo e($subscription->user->name ?? 'Unknown'); ?></h6>
                                        <small class="text-muted"><?php echo e($subscription->user->email ?? 'N/A'); ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e($subscription->package->name ?? 'N/A'); ?></td>                            <td><?php echo e($subscription->amount ? '$'.number_format($subscription->amount, 2) : ($subscription->package ? '$'.number_format($subscription->package->price, 2) : 'N/A')); ?></td>
                            <td><?php echo e($subscription->created_at ? $subscription->created_at->format('M d, Y') : 'N/A'); ?></td>
                            <td><?php echo e($subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A'); ?></td>
                            <td>
                                <?php if($subscription->is_trial): ?>
                                <span class="badge bg-light-info">Trial</span>
                                <?php elseif($subscription->isCanceled()): ?>
                                <span class="badge bg-light-danger">Canceled</span>
                                <?php elseif($subscription->isExpired()): ?>
                                <span class="badge bg-light-warning">Expired</span>
                                <?php else: ?>
                                <span class="badge bg-light-success">Active</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($subscription->payment_method ?? 'N/A'); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.payments.view', $subscription->id)); ?>" class="btn btn-sm btn-icon btn-light-primary">
                                    <i class="ti ti-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center">No payment records found</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                <?php echo e($subscriptions->appends(request()->query())->links()); ?>

            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('export-pdf').addEventListener('click', function() {
        // Clone the current search parameters
        const params = new URLSearchParams(window.location.search);
        params.append('export', 'pdf');
        
        // Create the PDF export URL
        const exportUrl = '<?php echo e(route("admin.payments.export")); ?>?' + params.toString();
        
        // Open in a new tab
        window.open(exportUrl, '_blank');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/immif732/jurislocator/resources/views/admin/payments/index.blade.php ENDPATH**/ ?>