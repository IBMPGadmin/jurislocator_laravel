<?php
    use Illuminate\Support\Facades\Storage;
?>

<div class="container-fluid">
    <!-- User Details Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                User Details
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <?php if($user->approval_status == 'pending'): ?>
                                <span class="badge bg-warning text-dark">Pending Approval</span>
                            <?php elseif($user->approval_status == 'approved'): ?>
                                <span class="badge bg-success">Approved</span>
                            <?php elseif($user->approval_status == 'rejected'): ?>
                                <span class="badge bg-danger">Rejected</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Personal Information -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user me-2"></i>Personal Information
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Full Name:</td>
                                <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Email:</td>
                                <td><?php echo e($user->email); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Phone:</td>
                                <td><?php echo e($user->phone_number ?? 'Not provided'); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">User Type:</td>
                                <td>
                                    <?php if($user->user_type == 'individual'): ?>
                                        <span class="badge bg-info">Individual</span>
                                    <?php elseif($user->user_type == 'business'): ?>
                                        <span class="badge bg-warning text-dark">Business</span>
                                    <?php elseif($user->user_type == 'attorney'): ?>
                                        <span class="badge bg-primary">Attorney</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary"><?php echo e(ucfirst($user->user_type)); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Registration Date:</td>
                                <td><?php echo e($user->created_at->format('M d, Y \a\t g:i A')); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cog me-2"></i>Account Status
                    </h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Approval Status:</td>
                                <td>
                                    <?php if($user->approval_status == 'pending'): ?>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    <?php elseif($user->approval_status == 'approved'): ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php elseif($user->approval_status == 'rejected'): ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Email Verified:</td>
                                <td>
                                    <?php if($user->email_verified_at): ?>
                                        <span class="badge bg-success">Verified</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Not Verified</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Last Login:</td>
                                <td><?php echo e($user->last_login_at ? $user->last_login_at->format('M d, Y \a\t g:i A') : 'Never'); ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Account Created:</td>
                                <td><?php echo e($user->created_at->diffForHumans()); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Information (if applicable) -->
    <?php if($user->user_type == 'business' || $user->user_type == 'attorney'): ?>
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-building me-2"></i><?php echo e($user->user_type == 'attorney' ? 'Law Firm' : 'Business'); ?> Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Company Name:</td>
                                        <td><?php echo e($user->company_name ?? 'Not provided'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Business Address:</td>
                                        <td><?php echo e($user->business_address ?? 'Not provided'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <?php if($user->user_type == 'attorney'): ?>
                                    <tr>
                                        <td class="font-weight-bold">Bar Number:</td>
                                        <td><?php echo e($user->bar_number ?? 'Not provided'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Practice Areas:</td>
                                        <td><?php echo e($user->practice_areas ?? 'Not provided'); ?></td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                        <td class="font-weight-bold">Business Type:</td>
                                        <td><?php echo e($user->business_type ?? 'Not provided'); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Tax ID:</td>
                                        <td><?php echo e($user->tax_id ?? 'Not provided'); ?></td>
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
    <?php endif; ?>

    <!-- Additional Information -->
    <?php if($user->profile_picture || $user->additional_notes): ?>
    <div class="row mb-4">
        <?php if($user->profile_picture): ?>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-image me-2"></i>Profile Picture
                    </h6>
                </div>
                <div class="card-body text-center">
                    <?php if(Storage::disk('public')->exists($user->profile_picture)): ?>
                        <img src="<?php echo e(Storage::url($user->profile_picture)); ?>" 
                             alt="Profile Picture" 
                             class="img-fluid rounded-circle" 
                             style="max-width: 150px; max-height: 150px;">
                    <?php else: ?>
                        <div class="text-muted">
                            <i class="fas fa-user fa-5x text-gray-300"></i>
                            <p class="mt-2">Profile picture not available</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($user->additional_notes): ?>
        <div class="col-md-<?php echo e($user->profile_picture ? '6' : '12'); ?>">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-sticky-note me-2"></i>Additional Notes
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-0"><?php echo e($user->additional_notes); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Action Buttons -->
    <?php if($user->approval_status == 'pending'): ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-tools me-2"></i>Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex gap-2 justify-content-center">
                        <form method="POST" action="<?php echo e(route('admin.user-approvals.approve', $user->id)); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-success" 
                                    onclick="return confirm('Are you sure you want to approve this user?')">
                                <i class="fas fa-check me-2"></i>Approve User
                            </button>
                        </form>
                        
                        <form method="POST" action="<?php echo e(route('admin.user-approvals.reject', $user->id)); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to reject this user?')">
                                <i class="fas fa-times me-2"></i>Reject User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.card {
    border-radius: 0.35rem;
    border: 1px solid #e3e6f0;
}
.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}
.table-borderless td {
    border: none;
    padding: 0.75rem 0.5rem;
    vertical-align: top;
}
.table-borderless .font-weight-bold {
    width: 40%;
    color: #5a5c69;
    font-weight: 600;
}
.table-borderless td:last-child {
    color: #858796;
}
</style>
<?php /**PATH C:\Users\User\Desktop\13\jurislocator_laravel\resources\views/admin/user-approvals/show.blade.php ENDPATH**/ ?>