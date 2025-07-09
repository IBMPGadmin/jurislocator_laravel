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
    <?php if($user->profile_image || $user->student_id_file || $user->additional_notes): ?>
    <div class="row mb-4">
        <?php if($user->profile_image): ?>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-image me-2"></i>Profile Picture
                    </h6>
                </div>
                <div class="card-body text-center">
                    <?php
                        $profileImagePath = $user->profile_image;
                        $profileImageUrl = null;
                        
                        // Try different storage methods
                        if ($profileImagePath) {
                            // First, try as stored in public disk
                            if (Storage::disk('public')->exists($profileImagePath)) {
                                $profileImageUrl = Storage::url($profileImagePath);
                            }
                            // Try without 'public/' prefix if it exists
                            elseif (str_starts_with($profileImagePath, 'public/') && Storage::disk('public')->exists(str_replace('public/', '', $profileImagePath))) {
                                $profileImageUrl = Storage::url(str_replace('public/', '', $profileImagePath));
                            }
                            // Try with 'public/' prefix if it doesn't exist
                            elseif (!str_starts_with($profileImagePath, 'public/') && Storage::disk('public')->exists('public/' . $profileImagePath)) {
                                $profileImageUrl = Storage::url('public/' . $profileImagePath);
                            }
                            // Try as direct asset path
                            elseif (file_exists(public_path('storage/' . $profileImagePath))) {
                                $profileImageUrl = asset('storage/' . $profileImagePath);
                            }
                            // Last resort - try direct asset
                            elseif (file_exists(public_path($profileImagePath))) {
                                $profileImageUrl = asset($profileImagePath);
                            }
                        }
                    ?>
                    
                    <?php if($profileImageUrl): ?>
                        <img src="<?php echo e($profileImageUrl); ?>" 
                             alt="Profile Picture" 
                             class="img-fluid rounded-circle" 
                             style="max-width: 150px; max-height: 150px; cursor: pointer;"
                             onclick="openImageModal('<?php echo e($profileImageUrl); ?>', 'Profile Picture')"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="text-muted" style="display: none;">
                            <i class="fas fa-user fa-5x text-gray-300"></i>
                            <p class="mt-2">Profile picture could not be loaded</p>
                            <p class="small text-danger">Path: <?php echo e($user->profile_image); ?></p>
                        </div>
                    <?php else: ?>
                        <div class="text-muted">
                            <i class="fas fa-user fa-5x text-gray-300"></i>
                            <p class="mt-2">Profile picture not available</p>
                            <p class="small text-danger">File path: <?php echo e($user->profile_image ?? 'Not set'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($user->student_id_file): ?>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-id-card me-2"></i>Student ID Card
                    </h6>
                </div>
                <div class="card-body text-center">
                    <?php
                        $studentIdPath = $user->student_id_file;
                        $studentIdUrl = null;
                        
                        if ($studentIdPath) {
                            // If the path already contains 'student_ids/', use as is
                            if (str_contains($studentIdPath, 'student_ids/')) {
                                if (Storage::disk('public')->exists($studentIdPath)) {
                                    $studentIdUrl = Storage::url($studentIdPath);
                                }
                            }
                            // If not, try adding 'student_ids/' prefix
                            elseif (Storage::disk('public')->exists('student_ids/' . $studentIdPath)) {
                                $studentIdUrl = Storage::url('student_ids/' . $studentIdPath);
                            }
                            // Try the original path
                            elseif (Storage::disk('public')->exists($studentIdPath)) {
                                $studentIdUrl = Storage::url($studentIdPath);
                            }
                            // Try as direct asset path
                            elseif (file_exists(public_path('storage/' . $studentIdPath))) {
                                $studentIdUrl = asset('storage/' . $studentIdPath);
                            }
                            // Try with student_ids prefix in asset
                            elseif (file_exists(public_path('storage/student_ids/' . $studentIdPath))) {
                                $studentIdUrl = asset('storage/student_ids/' . $studentIdPath);
                            }
                        }
                    ?>
                    
                    <?php if($studentIdUrl): ?>
                        <img src="<?php echo e($studentIdUrl); ?>" 
                             alt="Student ID Card" 
                             class="img-fluid rounded" 
                             style="max-width: 200px; max-height: 150px; cursor: pointer; border: 2px solid #e3e6f0;"
                             onclick="openImageModal('<?php echo e($studentIdUrl); ?>', 'Student ID Card')"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="text-muted" style="display: none;">
                            <i class="fas fa-id-card fa-5x text-gray-300"></i>
                            <p class="mt-2">Student ID card could not be loaded</p>
                            <p class="small text-danger">Path: <?php echo e($user->student_id_file); ?></p>
                        </div>
                        <p class="mt-2 text-muted small">Click to view full size</p>
                    <?php else: ?>
                        <div class="text-muted">
                            <i class="fas fa-id-card fa-5x text-gray-300"></i>
                            <p class="mt-2">Student ID card not available</p>
                            <p class="small text-info">File path: <?php echo e($user->student_id_file ?? 'Not set'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($user->additional_notes): ?>
        <div class="col-md-<?php echo e(($user->profile_image || $user->student_id_file) ? '12' : '12'); ?> <?php echo e(($user->profile_image && $user->student_id_file) ? 'mt-4' : ''); ?>">
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

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagePreviewModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" alt="Preview" class="img-fluid" style="max-width: 100%; max-height: 70vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a id="downloadImageBtn" href="" download class="btn btn-primary">
                    <i class="fas fa-download me-1"></i>Download
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(imageUrl, imageTitle) {
    document.getElementById('previewImage').src = imageUrl;
    document.getElementById('imagePreviewModalLabel').textContent = imageTitle + ' - Preview';
    document.getElementById('downloadImageBtn').href = imageUrl;
    
    // Create and show the modal using Bootstrap 5
    const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
    modal.show();
}
</script>

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
.img-fluid:hover {
    transform: scale(1.05);
    transition: transform 0.2s ease-in-out;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.card-body .img-fluid {
    transition: all 0.2s ease-in-out;
}
#imagePreviewModal .modal-body {
    background-color: #f8f9fa;
}
#imagePreviewModal .img-fluid {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
</style>
<?php /**PATH C:\Users\User\Desktop\15\jurislocator_laravel\resources\views/admin/user-approvals/show.blade.php ENDPATH**/ ?>