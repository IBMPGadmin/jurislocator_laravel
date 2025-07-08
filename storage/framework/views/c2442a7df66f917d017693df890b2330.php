

<?php $__env->startSection('title', 'Pending User Approvals'); ?>

<?php
    use Illuminate\Support\Facades\Storage;
?>

<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-user-clock me-2"></i>
                        Pending User Approvals
                        <?php if($pendingUsers->total() > 0): ?>
                            <span class="badge bg-warning ms-2"><?php echo e($pendingUsers->total()); ?></span>
                        <?php endif; ?>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="refresh">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if($pendingUsers->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>User Info</th>
                                        <th>User Type</th>
                                        <th>Additional Info</th>
                                        <th>Registration Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $pendingUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <div class="user-info">
                                                    <strong><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-envelope me-1"></i>
                                                        <?php echo e($user->email); ?>

                                                    </small>
                                                </div>
                                            </td>
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
                                            <td>
                                                <?php if(in_array($user->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec'])): ?>
                                                    <small class="text-muted">
                                                        <i class="fas fa-certificate me-1"></i>
                                                        License: <?php echo e($user->license_number ?: 'Not provided'); ?>

                                                    </small>
                                                <?php elseif($user->user_type === 'company'): ?>
                                                    <small class="text-muted">
                                                        <i class="fas fa-building me-1"></i>
                                                        Company: <?php echo e($user->company_name ?: 'Not provided'); ?>

                                                    </small>
                                                <?php elseif(in_array($user->user_type, ['student_queens', 'student_montreal'])): ?>
                                                    <small class="text-muted">
                                                        <i class="fas fa-id-badge me-1"></i>
                                                        Student ID: <strong><?php echo e($user->student_id_number ?: 'Not provided'); ?></strong>
                                                        <br>
                                                        <i class="fas fa-university me-1"></i>
                                                        <?php if($user->user_type === 'student_queens'): ?>
                                                            Queens University
                                                        <?php else: ?>
                                                            Université de Montréal
                                                        <?php endif; ?>
                                                        <br>
                                                        <i class="fas fa-id-card me-1"></i>
                                                        <?php if($user->student_id_file): ?>
                                                            <span class="text-success">Student ID Photo: ✓ Uploaded</span>
                                                        <?php else: ?>
                                                            <span class="text-danger">Student ID Photo: ✗ Missing</span>
                                                        <?php endif; ?>
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small>
                                                    <?php echo e($user->created_at->format('M d, Y')); ?>

                                                    <br>
                                                    <span class="text-muted"><?php echo e($user->created_at->diffForHumans()); ?></span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-success" 
                                                            onclick="approveUser(<?php echo e($user->id); ?>, '<?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>')">
                                                        <i class="fas fa-check me-1"></i>
                                                        Approve
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                            onclick="rejectUser(<?php echo e($user->id); ?>, '<?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>')">
                                                        <i class="fas fa-times me-1"></i>
                                                        Reject
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-info" 
                                                            onclick="viewUserDetails(<?php echo e($user->id); ?>)">
                                                        <i class="fas fa-eye me-1"></i>
                                                        View
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            <?php echo e($pendingUsers->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-user-check fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Pending Approvals</h4>
                            <p class="text-muted">All user registrations have been processed.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approval Confirmation Modal -->
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle me-2"></i>
                    Approve User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to approve <strong id="approveUserName"></strong>?</p>
                <p class="text-muted">This will:</p>
                <ul class="text-muted">
                    <li>Activate their account</li>
                    <li>Start their 7-day trial subscription</li>
                    <li>Send them an approval email notification</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="approveForm" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>
                        Approve User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Confirmation Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-times-circle me-2"></i>
                    Reject User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reject <strong id="rejectUserName"></strong>?</p>
                <p class="text-danger">This action cannot be undone and will:</p>
                <ul class="text-danger">
                    <li>Permanently reject their registration</li>
                    <li>Send them a rejection email notification</li>
                    <li>Prevent them from logging in</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="rejectForm" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>
                        Reject User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>
                    User Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="userDetailsContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function approveUser(userId, userName) {
    document.getElementById('approveUserName').textContent = userName;
    document.getElementById('approveForm').action = `/admin/user-approvals/${userId}/approve`;
    new bootstrap.Modal(document.getElementById('approveModal')).show();
}

function rejectUser(userId, userName) {
    document.getElementById('rejectUserName').textContent = userName;
    document.getElementById('rejectForm').action = `/admin/user-approvals/${userId}/reject`;
    new bootstrap.Modal(document.getElementById('rejectModal')).show();
}

function viewUserDetails(userId) {
    // Load user details via AJAX
    fetch(`/admin/user-approvals/${userId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('userDetailsContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('userDetailsModal')).show();
        })
        .catch(error => {
            console.error('Error loading user details:', error);
            alert('Error loading user details');
        });
}

// Auto-refresh every 30 seconds
setInterval(() => {
    location.reload();
}, 30000);
</script>

<style>
.user-info {
    min-width: 200px;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    margin-right: 2px;
}

.badge {
    font-size: 0.75em;
}

.alert {
    border-left: 4px solid;
}

.table-responsive {
    border-radius: 0.375rem;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.modal-header.bg-success {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.modal-header.bg-danger {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\admin\user-approvals\index.blade.php ENDPATH**/ ?>