

<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0">User Details</h5>
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-light btn-sm">
                        <i class="ti ti-arrow-left"></i> Back to Users
                    </a>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center mb-4">
                                <?php if($user->profile_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $user->profile_image)); ?>" alt="<?php echo e($user->name); ?>" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto" style="width: 150px; height: 150px; font-size: 48px; color: #6c757d;">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                <?php endif; ?>
                                <h4 class="mt-3"><?php echo e($user->name); ?></h4>
                                <p class="text-muted"><?php echo e(ucfirst($user->role)); ?></p>
                                
                                <div class="mt-3">
                                    <?php if($user->status ?? 1): ?>
                                        <span class="badge bg-success fs-6 px-3 py-2">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger fs-6 px-3 py-2">Inactive</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="border rounded p-3 bg-light">
                                <h5 class="border-bottom pb-2">Contact Information</h5>
                                <div class="mb-2">
                                    <label class="fw-bold">Email:</label>
                                    <div><?php echo e($user->email); ?></div>
                                </div>
                                <div class="mb-2">
                                    <label class="fw-bold">Member Since:</label>
                                    <div><?php echo e($user->created_at->format('F d, Y')); ?></div>
                                </div>
                                <div class="mb-2">
                                    <label class="fw-bold">Last Updated:</label>
                                    <div><?php echo e($user->updated_at->format('F d, Y')); ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <!-- User Profile Information -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="m-0">User Profile Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="fw-bold">First Name:</label>
                                                <div><?php echo e($user->first_name ?? 'N/A'); ?></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="fw-bold">Last Name:</label>
                                                <div><?php echo e($user->last_name ?? 'N/A'); ?></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="fw-bold">User Type:</label>
                                                <div>
                                                    <?php if($user->user_type): ?>
                                                        <?php switch($user->user_type):
                                                            case ('licensed_practitioner'): ?>
                                                                <span class="badge bg-primary">Licensed Practitioner</span>
                                                                <?php break; ?>
                                                            <?php case ('immigration_lawyer'): ?>
                                                                <span class="badge bg-success">Immigration Lawyer</span>
                                                                <?php break; ?>
                                                            <?php case ('notaire_quebec'): ?>
                                                                <span class="badge bg-info">Notaire (Quebec)</span>
                                                                <?php break; ?>
                                                            <?php case ('student_queens'): ?>
                                                                <span class="badge bg-warning">Student (Queen's University)</span>
                                                                <?php break; ?>
                                                            <?php case ('student_montreal'): ?>
                                                                <span class="badge bg-secondary">Student (University of Montreal)</span>
                                                                <?php break; ?>
                                                            <?php default: ?>
                                                                <span class="badge bg-light text-dark"><?php echo e(ucfirst(str_replace('_', ' ', $user->user_type))); ?></span>
                                                        <?php endswitch; ?>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if(in_array($user->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec']) && $user->license_number): ?>
                                                <div class="mb-3">
                                                    <label class="fw-bold">License Number:</label>
                                                    <div><?php echo e($user->license_number); ?></div>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if(in_array($user->user_type, ['student_queens', 'student_montreal'])): ?>
                                                <?php if($user->student_id_number): ?>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Student ID Number:</label>
                                                        <div><?php echo e($user->student_id_number); ?></div>
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if($user->student_id_file): ?>
                                                    <div class="mb-3">
                                                        <label class="fw-bold">Student ID Document:</label>
                                                        <div class="mt-2">
                                                            <?php
                                                                $fileExtension = pathinfo($user->student_id_file, PATHINFO_EXTENSION);
                                                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
                                                            ?>
                                                            
                                                            <?php if($isImage): ?>
                                                                <!-- Display image with modal view -->
                                                                <div class="student-id-preview">
                                                                    <img src="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" 
                                                                         alt="Student ID" 
                                                                         class="img-thumbnail" 
                                                                         style="max-width: 200px; max-height: 150px; cursor: pointer;"
                                                                         data-bs-toggle="modal" 
                                                                         data-bs-target="#studentIdModal">
                                                                    <div class="mt-1">
                                                                        <small class="text-muted">Click to view full size</small>
                                                                    </div>
                                                                </div>
                                                            <?php else: ?>
                                                                <!-- Display download link for PDF files -->
                                                                <div>
                                                                    <a href="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" 
                                                                       target="_blank" 
                                                                       class="btn btn-outline-primary btn-sm">
                                                                        <i class="ti ti-download"></i> View/Download Student ID (<?php echo e(strtoupper($fileExtension)); ?>)
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Subscription Information -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h5 class="m-0">Subscription Status</h5>
                                </div>
                                <div class="card-body">
                                    <?php if($activeSubscription): ?>
                                        <div class="alert <?php echo e($activeSubscription->isExpired() ? 'alert-warning' : 'alert-info'); ?>">
                                            <?php if($activeSubscription->isActiveSubscription()): ?>
                                                <strong>Active Subscription</strong>
                                            <?php elseif($activeSubscription->isTrialSubscription()): ?>
                                                <strong>Trial Subscription</strong>
                                            <?php elseif($activeSubscription->isCanceled()): ?>
                                                <strong>Canceled Subscription</strong>
                                            <?php elseif($activeSubscription->isExpired()): ?>
                                                <strong>Expired Subscription</strong>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Package:</strong> <?php echo e($activeSubscription->package->name ?? 'N/A'); ?></p>
                                                <p><strong>Price:</strong> $<?php echo e(number_format($activeSubscription->package->price ?? 0, 2)); ?></p>
                                                <p><strong>Payment Status:</strong> 
                                                    <span class="badge <?php echo e($activeSubscription->payment_status == 'completed' ? 'bg-success' : 'bg-warning'); ?>">
                                                        <?php echo e(ucfirst($activeSubscription->payment_status)); ?>

                                                    </span>
                                                </p>
                                            </div>
                                            <div class="col-md-6">
                                                <?php if($activeSubscription->trial_starts_at): ?>
                                                    <p><strong>Trial Started:</strong> <?php echo e($activeSubscription->trial_starts_at->format('M d, Y')); ?></p>
                                                    <p><strong>Trial Ends:</strong> <?php echo e($activeSubscription->trial_ends_at->format('M d, Y')); ?></p>
                                                <?php endif; ?>
                                                <?php if($activeSubscription->subscription_starts_at): ?>
                                                    <p><strong>Subscription Started:</strong> <?php echo e($activeSubscription->subscription_starts_at->format('M d, Y')); ?></p>
                                                    <p><strong>Subscription Ends:</strong> <?php echo e($activeSubscription->subscription_ends_at->format('M d, Y')); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-warning">
                                            This user does not have any subscription.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Subscription History -->
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="m-0">Subscription History</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Package</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                    <th>Created</th>
                                                    <th>Expires</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $user->subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($index + 1); ?></td>
                                                        <td><?php echo e($subscription->package->name ?? 'N/A'); ?></td>
                                                        <td>$<?php echo e(number_format($subscription->package->price ?? 0, 2)); ?></td>
                                                        <td>
                                                            <?php if($subscription->isActiveSubscription()): ?>
                                                                <span class="badge bg-success">Active</span>
                                                            <?php elseif($subscription->isTrialSubscription()): ?>
                                                                <span class="badge bg-info">Trial</span>
                                                            <?php elseif($subscription->isCanceled()): ?>
                                                                <span class="badge bg-secondary">Canceled</span>
                                                            <?php elseif($subscription->isExpired()): ?>
                                                                <span class="badge bg-warning">Expired</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><?php echo e($subscription->status); ?></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?php echo e($subscription->created_at->format('M d, Y')); ?></td>
                                                        <td><?php echo e($subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A'); ?></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">No subscription history found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <form method="POST" action="<?php echo e(route('admin.users.toggle', $user->id)); ?>" style="display:inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="btn <?php echo e(($user->status ?? 1) ? 'btn-warning' : 'btn-success'); ?>">
                                    <?php echo e(($user->status ?? 1) ? 'Deactivate User' : 'Activate User'); ?>

                                </button>
                            </form>
                        </div>
                        
                        <div>
                            <form method="POST" action="<?php echo e(route('admin.users.delete', $user->id)); ?>" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger">
                                    <i class="ti ti-trash"></i> Delete User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Student ID Image Modal -->
<?php if($user->student_id_file && in_array(strtolower(pathinfo($user->student_id_file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])): ?>
<div class="modal fade" id="studentIdModal" tabindex="-1" aria-labelledby="studentIdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentIdModalLabel">Student ID Document - <?php echo e($user->name); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" 
                     alt="Student ID" 
                     class="img-fluid" 
                     style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <a href="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" 
                   target="_blank" 
                   class="btn btn-primary">
                    <i class="ti ti-external-link"></i> Open in New Tab
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\15\jurislocator_laravel\resources\views/admin/users/show.blade.php ENDPATH**/ ?>