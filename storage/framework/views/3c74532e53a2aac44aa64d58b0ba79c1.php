<?php
    use Illuminate\Support\Facades\Storage;
?>

<div class="row">
    <div class="col-md-6">
        <h6 class="text-muted mb-3">Personal Information</h6>
        <table class="table table-sm">
            <tr>
                <td><strong>Full Name:</strong></td>
                <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
            </tr>
            <tr>
                <td><strong>Email:</strong></td>
                <td><?php echo e($user->email); ?></td>
            </tr>
            <tr>
                <td><strong>User Type:</strong></td>
                <td>
                    <span class="badge bg-info">
                        <?php if($user->user_type === 'licensed_practitioner'): ?>
                            Licensed Canadian Immigration Practitioner
                        <?php elseif($user->user_type === 'immigration_lawyer'): ?>
                            Canadian Immigration Lawyer
                        <?php elseif($user->user_type === 'notaire_quebec'): ?>
                            Member of Chambre des notaires du Québec
                        <?php elseif($user->user_type === 'student_queens'): ?>
                            Immigration Law student - Queens University
                        <?php elseif($user->user_type === 'student_montreal'): ?>
                            Immigration Law student - Université de Montréal
                        <?php else: ?>
                            <?php echo e(ucfirst(str_replace('_', ' ', $user->user_type))); ?>

                        <?php endif; ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>Registration Date:</strong></td>
                <td><?php echo e($user->created_at->format('F d, Y \a\t g:i A')); ?></td>
            </tr>
            <tr>
                <td><strong>Status:</strong></td>
                <td>
                    <?php if($user->approval_status === 'pending'): ?>
                        <span class="badge bg-warning">Pending Approval</span>
                    <?php elseif($user->approval_status === 'approved'): ?>
                        <span class="badge bg-success">Approved</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Rejected</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="col-md-6">
        <h6 class="text-muted mb-3">Additional Information</h6>
        
        <?php if(in_array($user->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec'])): ?>
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-certificate me-2"></i>
                        Professional License
                    </h6>
                    <p class="card-text">
                        <strong>License Number:</strong><br>
                        <?php echo e($user->license_number ?: 'Not provided'); ?>

                    </p>
                </div>
            </div>
        <?php elseif($user->user_type === 'company'): ?>
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-building me-2"></i>
                        Company Information
                    </h6>
                    <p class="card-text">
                        <strong>Company Name:</strong><br>
                        <?php echo e($user->company_name ?: 'Not provided'); ?>

                    </p>
                </div>
            </div>
        <?php elseif(in_array($user->user_type, ['student_queens', 'student_montreal'])): ?>
            <div class="card bg-light border-primary">
                <div class="card-body">
                    <h6 class="card-title text-primary">
                        <i class="fas fa-graduation-cap me-2"></i>
                        Student Information
                    </h6>
                    <div class="mb-3">
                        <strong>University:</strong><br>
                        <span class="badge bg-info fs-6">
                            <?php if($user->user_type === 'student_queens'): ?>
                                Queens University
                            <?php else: ?>
                                Université de Montréal
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>Student ID Number:</strong><br>
                        <span class="fs-5 text-primary fw-bold"><?php echo e($user->student_id_number ?: 'Not provided'); ?></span>
                    </div>
                    <div class="mb-2">
                        <strong>Student ID Photo:</strong><br>
                        <?php if($user->student_id_file): ?>
                            <?php
                                $fileExtension = strtolower(pathinfo($user->student_id_file, PATHINFO_EXTENSION));
                            ?>
                            
                            <?php if(in_array($fileExtension, ['jpg', 'jpeg', 'png'])): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" 
                                         alt="Student ID" 
                                         class="img-fluid rounded border"
                                         style="max-width: 100%; height: auto; max-height: 200px; cursor: pointer;"
                                         onclick="window.open(this.src, '_blank')">
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            Click image to view full size
                                        </small>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="mt-2">
                                    <div class="text-center p-3 border rounded bg-light">
                                        <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                                        <br>
                                        <a href="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" 
                                           target="_blank" 
                                           class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye me-1"></i>
                                            View PDF Document
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="d-flex align-items-center mt-2">
                                <a href="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" target="_blank" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-external-link-alt me-1"></i>
                                    Open in New Tab
                                </a>
                                <a href="<?php echo e(asset('storage/' . $user->student_id_file)); ?>" download class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-download me-1"></i>
                                    Download
                                </a>
                            </div>
                            <small class="text-muted d-block mt-1">
                                <i class="fas fa-file me-1"></i>
                                Uploaded: <?php echo e(basename($user->student_id_file)); ?>

                            </small>
                        <?php else: ?>
                            <div class="alert alert-warning py-2 px-3 mt-2">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                <small>No photo uploaded</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if($user->approval_status === 'approved' && $user->approver): ?>
            <div class="card bg-success bg-opacity-10 mt-3">
                <div class="card-body">
                    <h6 class="card-title text-success">
                        <i class="fas fa-check-circle me-2"></i>
                        Approval Information
                    </h6>
                    <p class="card-text">
                        <strong>Approved by:</strong> <?php echo e($user->approver->name); ?><br>
                        <strong>Approved on:</strong> <?php echo e($user->approved_at->format('F d, Y \a\t g:i A')); ?>

                    </p>
                </div>
            </div>
        <?php elseif($user->approval_status === 'rejected' && $user->approver): ?>
            <div class="card bg-danger bg-opacity-10 mt-3">
                <div class="card-body">
                    <h6 class="card-title text-danger">
                        <i class="fas fa-times-circle me-2"></i>
                        Rejection Information
                    </h6>
                    <p class="card-text">
                        <strong>Rejected by:</strong> <?php echo e($user->approver->name); ?><br>
                        <strong>Rejected on:</strong> <?php echo e($user->approved_at->format('F d, Y \a\t g:i A')); ?>

                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if($user->approval_status === 'pending'): ?>
    <hr>
    <div class="text-center">
        <h6 class="text-muted mb-3">Quick Actions</h6>
        <button type="button" class="btn btn-success me-2" 
                onclick="parent.approveUser(<?php echo e($user->id); ?>, '<?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>')">
            <i class="fas fa-check me-1"></i>
            Approve User
        </button>
        <button type="button" class="btn btn-danger" 
                onclick="parent.rejectUser(<?php echo e($user->id); ?>, '<?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>')">
            <i class="fas fa-times me-1"></i>
            Reject User
        </button>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\admin\user-approvals\show.blade.php ENDPATH**/ ?>