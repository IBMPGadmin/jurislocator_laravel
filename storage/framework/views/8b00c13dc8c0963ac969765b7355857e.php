

<?php $__env->startSection('admin-content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>All Legal Documents</h5>
        <div>
            <a href="<?php echo e(route('admin.legal-documents.standard')); ?>" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add Standard
            </a>
            <a href="<?php echo e(route('admin.legal-documents.alternative')); ?>" class="btn btn-sm btn-secondary">
                <i class="fas fa-plus"></i> Add Alternative
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
        
        <div class="documents-grid">
            <?php if(count($documents) > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 document-card <?php echo e($document->status == 'inactive' ? 'bg-light' : ''); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($document->act_name); ?></h5>
                                    <p class="card-text">
                                        <small>Table: <?php echo e($document->table_name); ?></small>
                                    </p>
                                    <p class="mb-1">
                                        <span class="badge bg-info">Law ID: <?php echo e($document->law_id); ?></span>
                                        <span class="badge bg-primary">Act ID: <?php echo e($document->act_id); ?></span>
                                    </p>
                                    <p class="mb-1">
                                        <span class="badge bg-secondary">Jurisdiction: <?php echo e($document->jurisdiction_id); ?></span>
                                        <span class="badge bg-success">
                                            <?php if($document->language == 'en'): ?>
                                                English
                                            <?php elseif($document->language == 'fr'): ?>
                                                French
                                            <?php elseif($document->language == 'Both'): ?>
                                                English & French
                                            <?php else: ?>
                                                <?php echo e($document->language); ?>

                                            <?php endif; ?>
                                        </span>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Uploaded: <?php echo e(\Carbon\Carbon::parse($document->created_at)->format('M d, Y')); ?>

                                        </small>
                                    </p>
                                    <p>
                                        <span class="badge <?php echo e($document->status == 'active' ? 'bg-success' : 'bg-danger'); ?>">
                                            <?php echo e(ucfirst($document->status ?? 'active')); ?>

                                        </span>
                                    </p>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="btn-group d-flex" role="group">
                                        <a href="<?php echo e(route('admin.legal-documents.edit', $document->id)); ?>" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-<?php echo e($document->status == 'active' ? 'warning' : 'success'); ?> toggle-status-btn"
                                                data-id="<?php echo e($document->id); ?>"
                                                data-status="<?php echo e($document->status ?? 'active'); ?>"
                                                title="<?php echo e($document->status == 'active' ? 'Deactivate' : 'Activate'); ?>">
                                            <i class="fas <?php echo e($document->status == 'active' ? 'fa-toggle-off' : 'fa-toggle-on'); ?>"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger delete-doc-btn"
                                                data-id="<?php echo e($document->id); ?>"
                                                data-name="<?php echo e($document->act_name); ?>"
                                                title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info">No legal documents have been uploaded yet.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteDocumentModal" tabindex="-1" aria-labelledby="deleteDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDocumentModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the document: <strong id="documentNameToDelete"></strong>?
                <p class="text-danger mt-2">
                    This action cannot be undone. All document content will be permanently deleted.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteDocForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .document-card {
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .document-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .document-card .card-body {
        position: relative;
        padding-bottom: 50px;
    }
    
    .document-card .card-footer {
        position: relative;
        bottom: 0;
        left: 0;
        right: 0;
        background: transparent;
    }
    
    .document-card.bg-light {
        opacity: 0.7;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle delete button clicks
    const deleteButtons = document.querySelectorAll('.delete-doc-btn');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const modal = document.getElementById('deleteDocumentModal');
            const modalInstance = new bootstrap.Modal(modal);
            
            document.getElementById('documentNameToDelete').textContent = name;
            document.getElementById('deleteDocForm').action = `/admin/legal-documents/${id}`;
            
            modalInstance.show();
        });
    });
    
    // Handle toggle status buttons
    const toggleButtons = document.querySelectorAll('.toggle-status-btn');
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const currentStatus = this.getAttribute('data-status');
            const button = this;
            
            // Make AJAX request to toggle status
            fetch(`/admin/legal-documents/${id}/toggle`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update button appearance
                    const newStatus = data.newStatus;
                    button.setAttribute('data-status', newStatus);
                    button.setAttribute('title', newStatus === 'active' ? 'Deactivate' : 'Activate');
                    
                    // Update icon
                    const icon = button.querySelector('i');
                    icon.classList.remove('fa-toggle-on', 'fa-toggle-off');
                    icon.classList.add(newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on');
                    
                    // Update button style
                    button.classList.remove('btn-outline-success', 'btn-outline-warning');
                    button.classList.add(newStatus === 'active' ? 'btn-outline-warning' : 'btn-outline-success');
                    
                    // Update card styling
                    const card = button.closest('.document-card');
                    if (newStatus === 'active') {
                        card.classList.remove('bg-light');
                    } else {
                        card.classList.add('bg-light');
                    }
                    
                    // Update status badge
                    const statusBadge = card.querySelector('.badge:last-of-type');
                    statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    statusBadge.classList.remove('bg-success', 'bg-danger');
                    statusBadge.classList.add(newStatus === 'active' ? 'bg-success' : 'bg-danger');
                    
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        Document status updated to ${newStatus}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                    
                    const cardBody = document.querySelector('.card-body');
                    cardBody.insertBefore(alertDiv, cardBody.firstChild);
                    
                    // Auto dismiss after 3 seconds
                    setTimeout(() => {
                        alertDiv.classList.remove('show');
                        setTimeout(() => alertDiv.remove(), 150);
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the status.');
            });
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\j.v1-main\j.v1-main\resources\views/admin/legal-documents/index.blade.php ENDPATH**/ ?>