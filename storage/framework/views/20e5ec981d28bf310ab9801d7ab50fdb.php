<?php
    use Illuminate\Support\Facades\Storage;
?>



<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800">User Approvals Management</h1>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if(session('success')): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- User Approvals Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-table me-2"></i>Pending User Approvals
                    </h6>
                    <?php if($users->count() > 0): ?>
                        <span class="badge bg-warning text-dark">
                            <?php echo e($users->count()); ?> Pending
                        </span>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <?php if($users->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Registration Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
                                        <td><?php echo e($user->email); ?></td>
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
                                        <td><?php echo e($user->created_at->format('M d, Y')); ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#userModal" 
                                                    onclick="loadUserDetails(<?php echo e($user->id); ?>)">
                                                <i class="fas fa-eye me-1"></i>View
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-success" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#approveModal" 
                                                    onclick="setApproveUser(<?php echo e($user->id); ?>, '<?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>', '<?php echo e($user->profile_image ? Storage::url($user->profile_image) : ''); ?>', '<?php echo e($user->student_id_file ? Storage::url($user->student_id_file) : ''); ?>')">
                                                <i class="fas fa-check me-1"></i>Approve
                                            </button>
                                            
                                            <?php if($user->student_id_file): ?>
                                            <button type="button" class="btn btn-sm btn-info" 
                                                    onclick="openStudentIdModal('<?php echo e(Storage::url($user->student_id_file)); ?>')"
                                                    title="View Student ID">
                                                <i class="fas fa-id-card me-1"></i>View ID
                                            </button>
                                            <?php endif; ?>
                                            
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rejectModal" 
                                                    onclick="setRejectUser(<?php echo e($user->id); ?>, '<?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>', '<?php echo e($user->profile_image ? Storage::url($user->profile_image) : ''); ?>', '<?php echo e($user->student_id_file ? Storage::url($user->student_id_file) : ''); ?>')">
                                                <i class="fas fa-times me-1"></i>Reject
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <?php if($users instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
                            <div class="d-flex justify-content-center mt-4">
                                <?php echo e($users->appends(request()->query())->links()); ?>

                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-user-clock fa-3x text-gray-300 mb-3"></i>
                            <h5 class="text-gray-600">No Pending Users</h5>
                            <p class="text-gray-500">There are no users waiting for approval at this time.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title font-weight-bold text-white" id="userModalLabel">
                    <i class="fas fa-user-circle me-2"></i>User Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userModalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h6 class="mt-3 text-gray-600">Loading User Details</h6>
                    <p class="text-gray-500">Please wait while we fetch the information...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Close
                </button>
                <a href="<?php echo e(route('admin.user-approvals.index')); ?>" class="btn btn-primary">
                    <i class="fas fa-list me-1"></i>Back to List
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Approve User Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title font-weight-bold text-white" id="approveModalLabel">
                    <i class="fas fa-check-circle me-2"></i>Approve User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center py-3">
                    <div class="row mb-3">
                        <!-- Profile Picture -->
                        <div class="col-6">
                            <h6 class="text-gray-700 mb-2">Profile Picture</h6>
                            <div class="d-flex justify-content-center">
                                <img id="approveUserImage" src="" alt="User Profile" 
                                     class="rounded-circle border" 
                                     style="width: 80px; height: 80px; object-fit: cover; display: none;">
                                <i id="approveUserIcon" class="fas fa-user fa-3x text-gray-300"></i>
                            </div>
                        </div>
                        <!-- Student ID Card -->
                        <div class="col-6">
                            <h6 class="text-gray-700 mb-2">Student ID Card</h6>
                            <div class="d-flex justify-content-center">
                                <img id="approveStudentIdImage" src="" alt="Student ID" 
                                     class="rounded border student-id-clickable" 
                                     style="width: 80px; height: 60px; object-fit: cover; display: none; cursor: pointer;"
                                     onclick="openStudentIdModal(this.src)">
                                <i id="approveStudentIdIcon" class="fas fa-id-card fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                    </div>
                    <h5 class="text-gray-800">Confirm User Approval</h5>
                    <p class="text-gray-600">Are you sure you want to approve <strong id="approveUserName"></strong>?</p>
                    <p class="text-gray-500 small">This action will grant the user access to the platform and send them a confirmation email.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <form id="approveForm" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>Yes, Approve User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Reject User Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title font-weight-bold text-white" id="rejectModalLabel">
                    <i class="fas fa-times-circle me-2"></i>Reject User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center py-3">
                    <div class="row mb-3">
                        <!-- Profile Picture -->
                        <div class="col-6">
                            <h6 class="text-gray-700 mb-2">Profile Picture</h6>
                            <div class="d-flex justify-content-center">
                                <img id="rejectUserImage" src="" alt="User Profile" 
                                     class="rounded-circle border" 
                                     style="width: 80px; height: 80px; object-fit: cover; display: none;">
                                <i id="rejectUserIcon" class="fas fa-user fa-3x text-gray-300"></i>
                            </div>
                        </div>
                        <!-- Student ID Card -->
                        <div class="col-6">
                            <h6 class="text-gray-700 mb-2">Student ID Card</h6>
                            <div class="d-flex justify-content-center">
                                <img id="rejectStudentIdImage" src="" alt="Student ID" 
                                     class="rounded border student-id-clickable" 
                                     style="width: 80px; height: 60px; object-fit: cover; display: none; cursor: pointer;"
                                     onclick="openStudentIdModal(this.src)">
                                <i id="rejectStudentIdIcon" class="fas fa-id-card fa-3x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-user-times fa-2x text-danger mb-2"></i>
                    </div>
                    <h5 class="text-gray-800">Confirm User Rejection</h5>
                    <p class="text-gray-600">Are you sure you want to reject <strong id="rejectUserName"></strong>?</p>
                    <p class="text-gray-500 small">This action will deny the user access to the platform and send them a notification email.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <form id="rejectForm" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>Yes, Reject User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Student ID Card View Modal -->
<div class="modal fade" id="studentIdModal" tabindex="-1" aria-labelledby="studentIdModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title font-weight-bold text-white" id="studentIdModalLabel">
                    <i class="fas fa-id-card me-2"></i>Student ID Card - Full View
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" onclick="closeStudentIdModal()"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div class="mb-3" style="overflow: hidden;">
                    <img id="studentIdFullImage" src="" alt="Student ID Card" 
                         class="img-fluid rounded shadow" 
                         style="max-width: 100%; max-height: 70vh; border: 2px solid #36b9cc; transition: transform 0.3s ease; transform-origin: center;">
                </div>
                <div class="d-flex justify-content-center gap-3 mb-3">
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="zoomStudentId()">
                        <i class="fas fa-search-plus me-1"></i>Zoom In
                    </button>
                    <button type="button" class="btn btn-outline-info btn-sm" onclick="resetZoomStudentId()">
                        <i class="fas fa-search me-1"></i>Reset Zoom
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="openInNewTab()">
                        <i class="fas fa-external-link-alt me-1"></i>New Tab
                    </button>
                </div>
                <div class="text-muted small">
                    <i class="fas fa-info-circle me-1"></i>
                    Click and drag to pan when zoomed. Use buttons below to view or download.
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeStudentIdModal()">
                    <i class="fas fa-times me-1"></i>Close
                </button>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary" onclick="openInNewTab()">
                        <i class="fas fa-external-link-alt me-1"></i>View Image
                    </button>
                    <button type="button" class="btn btn-success" onclick="downloadImage()">
                        <i class="fas fa-download me-1"></i>Download Image
                    </button>
                    <!-- Hidden download link for fallback -->
                    <a id="downloadStudentIdBtn" href="" download style="display: none;"></a>
                </div>
            </div>
        </div>
    </div>
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
.border-left-danger {
    border-left: 0.25rem solid #e74a3b !important;
}
.text-gray-800 {
    color: #5a5c69 !important;
}
.text-gray-300 {
    color: #dddfeb !important;
}
.text-gray-600 {
    color: #6c757d !important;
}
.text-gray-500 {
    color: #858796 !important;
}
.card {
    border-radius: 0.35rem;
    border: 1px solid #e3e6f0;
}
.btn-block {
    width: 100%;
}
.shadow {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}
.table th {
    background-color: #f8f9fc;
    border-color: #e3e6f0;
    font-weight: 600;
    color: #5a5c69;
}
.table td {
    border-color: #e3e6f0;
    color: #5a5c69;
}
.text-gray-700 {
    color: #6c757d !important;
    font-weight: 600;
}
.modal-body .border {
    border: 2px solid #e3e6f0 !important;
}
.modal-body .rounded-circle {
    border: 2px solid #4e73df !important;
}
.modal-body .rounded {
    border: 2px solid #36b9cc !important;
}
.student-id-clickable {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.student-id-clickable:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.modal-footer .d-flex.gap-2 {
    gap: 0.5rem !important;
}
.modal-footer .btn {
    font-weight: 600;
}
#studentIdModal .modal-body {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}
#studentIdModal .img-fluid {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}
.btn:hover {
    transform: translateY(-1px);
    transition: all 0.2s ease;
}
</style>

<script>
function loadUserDetails(userId) {
    fetch(`/admin/user-approvals/${userId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('userModalBody').innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading user details:', error);
            document.getElementById('userModalBody').innerHTML = 
                '<div class="alert alert-danger">Error loading user details. Please try again.</div>';
        });
}

function setApproveUser(userId, userName, userImage, studentIdImage) {
    document.getElementById('approveUserName').textContent = userName;
    document.getElementById('approveForm').action = `/admin/user-approvals/${userId}/approve`;
    
    // Handle user profile image
    const approveImage = document.getElementById('approveUserImage');
    const approveIcon = document.getElementById('approveUserIcon');
    
    if (userImage && userImage.trim() !== '') {
        approveImage.src = userImage;
        approveImage.style.display = 'block';
        approveIcon.style.display = 'none';
    } else {
        approveImage.style.display = 'none';
        approveIcon.style.display = 'block';
    }
    
    // Handle student ID image
    const approveStudentIdImage = document.getElementById('approveStudentIdImage');
    const approveStudentIdIcon = document.getElementById('approveStudentIdIcon');
    
    if (studentIdImage && studentIdImage.trim() !== '') {
        approveStudentIdImage.src = studentIdImage;
        approveStudentIdImage.style.display = 'block';
        approveStudentIdIcon.style.display = 'none';
    } else {
        approveStudentIdImage.style.display = 'none';
        approveStudentIdIcon.style.display = 'block';
    }
}

function setRejectUser(userId, userName, userImage, studentIdImage) {
    document.getElementById('rejectUserName').textContent = userName;
    document.getElementById('rejectForm').action = `/admin/user-approvals/${userId}/reject`;
    
    // Handle user profile image
    const rejectImage = document.getElementById('rejectUserImage');
    const rejectIcon = document.getElementById('rejectUserIcon');
    
    if (userImage && userImage.trim() !== '') {
        rejectImage.src = userImage;
        rejectImage.style.display = 'block';
        rejectIcon.style.display = 'none';
    } else {
        rejectImage.style.display = 'none';
        rejectIcon.style.display = 'block';
    }
    
    // Handle student ID image
    const rejectStudentIdImage = document.getElementById('rejectStudentIdImage');
    const rejectStudentIdIcon = document.getElementById('rejectStudentIdIcon');
    
    if (studentIdImage && studentIdImage.trim() !== '') {
        rejectStudentIdImage.src = studentIdImage;
        rejectStudentIdImage.style.display = 'block';
        rejectStudentIdIcon.style.display = 'none';
    } else {
        rejectStudentIdImage.style.display = 'none';
        rejectStudentIdIcon.style.display = 'block';
    }
}

let currentZoom = 1;

function openStudentIdModal(imageUrl) {
    console.log('Opening student ID modal with URL:', imageUrl); // Debug log
    
    if (imageUrl && imageUrl.trim() !== '') {
        document.getElementById('studentIdFullImage').src = imageUrl;
        document.getElementById('downloadStudentIdBtn').href = imageUrl;
        
        // Reset zoom when opening modal
        currentZoom = 1;
        resetZoomStudentId();
        
        // Try Bootstrap 5 method first
        try {
            const modal = new bootstrap.Modal(document.getElementById('studentIdModal'), {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();
        } catch (e) {
            console.log('Bootstrap 5 failed, trying jQuery method:', e);
            // Fallback to jQuery if Bootstrap 5 is not available
            try {
                $('#studentIdModal').modal('show');
            } catch (e2) {
                console.log('jQuery also failed, trying manual show:', e2);
                // Manual modal show as last resort
                const modalElement = document.getElementById('studentIdModal');
                modalElement.classList.add('show');
                modalElement.style.display = 'block';
                modalElement.setAttribute('aria-hidden', 'false');
                
                // Add backdrop
                const backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                backdrop.id = 'studentIdModalBackdrop';
                document.body.appendChild(backdrop);
            }
        }
    } else {
        console.log('No image URL provided or empty URL'); // Debug log
        alert('No student ID image available to display.');
    }
}

function zoomStudentId() {
    currentZoom += 0.3;
    if (currentZoom > 3) currentZoom = 3; // Max zoom
    document.getElementById('studentIdFullImage').style.transform = `scale(${currentZoom})`;
}

function resetZoomStudentId() {
    currentZoom = 1;
    document.getElementById('studentIdFullImage').style.transform = 'scale(1)';
}

function openInNewTab() {
    const imageUrl = document.getElementById('studentIdFullImage').src;
    console.log('Opening image in new tab:', imageUrl); // Debug log
    
    if (imageUrl && imageUrl.trim() !== '') {
        // Open image in new tab
        const newWindow = window.open(imageUrl, '_blank');
        
        // Check if popup was blocked
        if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {
            // Fallback: show alert with URL
            alert('Popup blocked! Please copy this URL to view the image:\n\n' + imageUrl);
        } else {
            // Focus on the new tab
            newWindow.focus();
        }
    } else {
        alert('No image URL available to open.');
    }
}

function downloadImage() {
    const imageUrl = document.getElementById('studentIdFullImage').src;
    const downloadBtn = document.getElementById('downloadStudentIdBtn');
    
    console.log('Downloading image:', imageUrl); // Debug log
    
    if (imageUrl && imageUrl.trim() !== '') {
        // Set the download link
        downloadBtn.href = imageUrl;
        
        // Extract filename from URL or use default
        const filename = imageUrl.split('/').pop() || 'student_id_card.jpg';
        downloadBtn.download = filename;
        
        // Trigger download
        downloadBtn.click();
    } else {
        alert('No image available to download.');
    }
}

function closeStudentIdModal() {
    try {
        const modal = bootstrap.Modal.getInstance(document.getElementById('studentIdModal'));
        if (modal) {
            modal.hide();
        } else {
            $('#studentIdModal').modal('hide');
        }
    } catch (e) {
        // Manual hide
        const modalElement = document.getElementById('studentIdModal');
        modalElement.classList.remove('show');
        modalElement.style.display = 'none';
        modalElement.setAttribute('aria-hidden', 'true');
        
        // Remove backdrop
        const backdrop = document.getElementById('studentIdModalBackdrop');
        if (backdrop) {
            backdrop.remove();
        }
    }
}

// Remove auto-refresh - commented out to prevent auto-closing popups
// setInterval(function() {
//     location.reload();
// }, 30000);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel_new\resources\views/admin/user-approvals/index.blade.php ENDPATH**/ ?>