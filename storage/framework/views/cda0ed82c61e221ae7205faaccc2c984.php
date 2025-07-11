

<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid">
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="page-title">Payment Details</h2>
                <p class="text-muted">View details for payment #<?php echo e($subscription->id); ?></p>
            </div>
            <div class="col-md-6 text-end">
                <a href="<?php echo e(route('admin.payments.index')); ?>" class="btn btn-outline-primary">
                    <i class="ti ti-arrow-left me-1"></i> Back to Payments
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Payment Summary Card -->
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Payment Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="mb-1">Subscription ID</h6>
                            <p><?php echo e($subscription->id); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-1">Transaction ID</h6>
                            <p><?php echo e($subscription->transaction_id ?? 'N/A'); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="mb-1">Package</h6>
                            <p><?php echo e($subscription->package->name ?? 'N/A'); ?></p>
                        </div>                        <div class="col-md-6">
                            <h6 class="mb-1">Amount Paid</h6>
                            <p class="text-success"><?php echo e($subscription->package ? '$'.number_format($subscription->package->price, 2) : 'N/A'); ?></p>
                        </div>
                    </div>                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="mb-1">Payment Date</h6>
                            <p><?php echo e($subscription->created_at ? $subscription->created_at->format('F d, Y H:i:s') : 'N/A'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-1">Expiry Date</h6>
                            <p><?php echo e($subscription->expires_at ? $subscription->expires_at->format('F d, Y') : 'N/A'); ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6 class="mb-1">Payment Method</h6>
                            <p><?php echo e($subscription->payment_method ?? 'N/A'); ?></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-1">Status</h6>
                            <p>
                                <?php if($subscription->is_trial): ?>
                                <span class="badge bg-info">Trial</span>
                                <?php elseif($subscription->isCanceled()): ?>
                                <span class="badge bg-danger">Canceled</span>
                                <?php elseif($subscription->isExpired()): ?>
                                <span class="badge bg-warning">Expired</span>
                                <?php else: ?>
                                <span class="badge bg-success">Active</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <?php if($subscription->notes): ?>
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Notes</h6>
                            <p><?php echo e($subscription->notes); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- User Information Card -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">User Information</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <?php if($subscription->user && $subscription->user->profile_image): ?>
                        <img src="<?php echo e(asset('storage/' . $subscription->user->profile_image)); ?>" alt="Profile" class="rounded-circle me-3" width="60" height="60">
                        <?php else: ?>
                        <div class="avtar avtar-m bg-light-primary rounded-circle me-3">
                            <i class="ti ti-user f-20"></i>
                        </div>
                        <?php endif; ?>
                        <div>
                            <h5 class="mb-0"><?php echo e($subscription->user->name ?? 'Unknown User'); ?></h5>
                            <p class="text-muted mb-0"><?php echo e($subscription->user->email ?? 'N/A'); ?></p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">User ID</h6>
                            <p><?php echo e($subscription->user->id ?? 'N/A'); ?></p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Account Created</h6>
                            <p><?php echo e($subscription->user ? $subscription->user->created_at->format('F d, Y') : 'N/A'); ?></p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Role</h6>
                            <p><?php echo e($subscription->user ? ucfirst($subscription->user->role) : 'N/A'); ?></p>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6 class="mb-1">Subscription History</h6>
                            <p><?php echo e($userSubscriptionsCount); ?> payment(s)</p>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <?php if($subscription->user): ?>
                        <a href="mailto:<?php echo e($subscription->user->email); ?>" class="btn btn-sm btn-light-primary w-100 mb-2">
                            <i class="ti ti-mail me-1"></i> Email User
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription History -->
    <?php if(count($userSubscriptions) > 1): ?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Subscription History</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>                            <th>ID</th>
                            <th>Package</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $userSubscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userSub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($userSub->id == $subscription->id ? 'table-primary' : ''); ?>">
                            <td><?php echo e($userSub->id); ?></td>
                            <td><?php echo e($userSub->package->name ?? 'N/A'); ?></td>                            <td><?php echo e($userSub->amount ? '$'.number_format($userSub->amount, 2) : ($userSub->package ? '$'.number_format($userSub->package->price, 2) : 'N/A')); ?></td>
                            <td><?php echo e($userSub->created_at ? $userSub->created_at->format('M d, Y') : 'N/A'); ?></td>
                            <td><?php echo e($userSub->expires_at ? $userSub->expires_at->format('M d, Y') : 'N/A'); ?></td>
                            <td>
                                <?php if($userSub->is_trial): ?>
                                <span class="badge bg-light-info">Trial</span>
                                <?php elseif($userSub->isCanceled()): ?>
                                <span class="badge bg-light-danger">Canceled</span>
                                <?php elseif($userSub->isExpired()): ?>
                                <span class="badge bg-light-warning">Expired</span>
                                <?php else: ?>
                                <span class="badge bg-light-success">Active</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\admin\payments\view.blade.php ENDPATH**/ ?>