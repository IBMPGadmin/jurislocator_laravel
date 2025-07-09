

<?php $__env->startSection('admin-content'); ?>
<div class="container-fluid px-4">
    <!-- Modern Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">
                <i class="fas fa-file-alt me-2 text-primary"></i>
                Legal Documents Management
            </h1>
            <p class="text-muted mb-0">Manage and organize your legal document library</p>
        </div>
        <div class="btn-group shadow-sm">
            <a href="<?php echo e(route('admin.legal-documents.standard')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Standard Document
            </a>
            <a href="<?php echo e(route('admin.legal-documents.alternative')); ?>" class="btn btn-outline-primary">
                <i class="fas fa-upload me-2"></i>Alternative Upload
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Documents
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e(count($documents)); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Active Documents
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e($documents->where('status', 'active')->count()); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Inactive Documents
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e($documents->where('status', 'inactive')->count()); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-pause-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Jurisdictions
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo e($documents->pluck('jurisdiction_id')->unique()->count()); ?>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter me-2"></i>Filter Documents
            </h6>
            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse" id="filterCollapse">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Search Documents</label>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search by act name...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jurisdiction</label>
                        <select class="form-select" id="jurisdictionFilter">
                            <option value="">All Jurisdictions</option>
                            <?php $__currentLoopData = $jurisdictions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Language</label>
                        <select class="form-select" id="languageFilter">
                            <option value="">All Languages</option>
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Documents Table -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table me-2"></i>Documents Library
            </h6>
        </div>
        <div class="card-body">
            <?php if(count($documents) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover" id="documentsTable">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Act Name</th>
                                <th>Table Name</th>
                                <th>Law Subject</th>
                                <th>Act Category</th>
                                <th>Jurisdiction</th>
                                <th>Language</th>
                                <th>Uploaded</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="document-row <?php echo e(($document->status ?? 'active') == 'inactive' ? 'table-secondary' : ''); ?>" 
                                    data-status="<?php echo e($document->status ?? 'active'); ?>"
                                    data-jurisdiction="<?php echo e($document->jurisdiction_id); ?>"
                                    data-language="<?php echo e($document->language_id ?? $document->language); ?>"
                                    data-name="<?php echo e(strtolower($document->act_name ?? '')); ?>">
                                    <td class="text-muted"><?php echo e($document->id); ?></td>
                                    <td>
                                        <span class="badge <?php echo e(($document->status ?? 'active') == 'active' ? 'bg-success' : 'bg-secondary'); ?>">
                                            <i class="fas <?php echo e(($document->status ?? 'active') == 'active' ? 'fa-check-circle' : 'fa-pause-circle'); ?> me-1"></i>
                                            <?php echo e(ucfirst($document->status ?? 'active')); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-primary"><?php echo e($document->act_name); ?></div>
                                    </td>
                                    <td>
                                        <span class="text-muted"><?php echo e($document->table_name); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <?php echo e($lawSubjects[$document->law_id] ?? 'Law ID: ' . $document->law_id); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">
                                            <?php echo e($acts[$document->act_id] ?? 'Act ID: ' . $document->act_id); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <?php echo e($jurisdictions[$document->jurisdiction_id] ?? 'Jurisdiction ID: ' . $document->jurisdiction_id); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-info fw-bold">
                                            <?php if($document->language_id): ?>
                                                <?php echo e($languages[$document->language_id] ?? $document->language_id); ?>

                                            <?php elseif($document->language == 'en'): ?>
                                                English
                                            <?php elseif($document->language == 'fr'): ?>
                                                French
                                            <?php elseif($document->language == 'Both'): ?>
                                                Bilingual
                                            <?php else: ?>
                                                <?php echo e($document->language ?? 'N/A'); ?>

                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo e(\Carbon\Carbon::parse($document->created_at)->format('M d, Y')); ?>

                                            <br>
                                            <?php echo e(\Carbon\Carbon::parse($document->created_at)->format('H:i')); ?>

                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.legal-documents.edit', $document->id)); ?>" 
                                               class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-warning toggle-status-btn" 
                                                    data-id="<?php echo e($document->id); ?>"
                                                    data-status="<?php echo e($document->status ?? 'active'); ?>"
                                                    title="<?php echo e(($document->status ?? 'active') == 'active' ? 'Deactivate' : 'Activate'); ?>">
                                                <i class="fas <?php echo e(($document->status ?? 'active') == 'active' ? 'fa-pause' : 'fa-play'); ?>"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger delete-doc-btn"
                                                    data-id="<?php echo e($document->id); ?>"
                                                    data-name="<?php echo e($document->act_name); ?>"
                                                    title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-file-alt fa-5x text-gray-300"></i>
                    </div>
                    <h4 class="text-muted">No Legal Documents Found</h4>
                    <p class="text-muted mb-4">Get started by uploading your first legal document.</p>
                    <a href="<?php echo e(route('admin.legal-documents.standard')); ?>" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Upload First Document
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* Modern card styling */
    .document-card {
        transition: all 0.3s ease;
        border: 1px solid #e3e6f0;
        border-radius: 0.35rem;
        overflow: hidden;
    }
    
    .document-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        border-color: #5a6c7d;
    }
    
    .inactive-document {
        opacity: 0.6;
        background-color: #f8f9fc;
    }
    
    /* Border colors for status cards */
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    
    /* Document details styling */
    .detail-row {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
    }
    
    .detail-row i {
        width: 16px;
        font-size: 0.75rem;
    }
    
    /* Card header styling */
    .document-card .card-header {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
        padding: 0.75rem 1rem;
    }
    
    /* Responsive grid adjustments */
    @media (max-width: 768px) {
        .col-xl-4 {
            margin-bottom: 1rem;
        }
        
        .container-fluid {
            padding: 1rem;
        }
    }
    
    /* Filter section styling */
    #filterCollapse .card-body {
        background-color: #f8f9fc;
    }
    
    /* Search and filter animations */
    .document-item {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    
    .document-item.hidden {
        opacity: 0;
        transform: scale(0.8);
        height: 0;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }
    
    /* Badge styling improvements */
    .badge {
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    /* Empty state styling */
    .text-center.py-5 {
        background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
        border-radius: 0.35rem;
        border: 2px dashed #e3e6f0;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search and filter functionality
    const searchInput = document.getElementById('searchInput');
    const statusFilter = document.getElementById('statusFilter');
    const jurisdictionFilter = document.getElementById('jurisdictionFilter');
    const languageFilter = document.getElementById('languageFilter');
    
    function filterDocuments() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const jurisdictionValue = jurisdictionFilter.value;
        const languageValue = languageFilter.value;
        
        const documentItems = document.querySelectorAll('.document-item');
        let visibleCount = 0;
        
        documentItems.forEach(item => {
            const name = item.dataset.name;
            const status = item.dataset.status;
            const jurisdiction = item.dataset.jurisdiction;
            const language = item.dataset.language;
            
            let shouldShow = true;
            
            // Text search
            if (searchTerm && !name.includes(searchTerm)) {
                shouldShow = false;
            }
            
            // Status filter
            if (statusValue && status !== statusValue) {
                shouldShow = false;
            }
            
            // Jurisdiction filter
            if (jurisdictionValue && jurisdiction !== jurisdictionValue) {
                shouldShow = false;
            }
            
            // Language filter
            if (languageValue && language !== languageValue) {
                shouldShow = false;
            }
            
            if (shouldShow) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });
        
        // Show/hide no results message
        const noResultsMessage = document.getElementById('noResultsMessage');
        if (noResultsMessage) {
            noResultsMessage.remove();
        }
        
        if (visibleCount === 0 && documentItems.length > 0) {
            const grid = document.getElementById('documentsGrid');
            const message = document.createElement('div');
            message.id = 'noResultsMessage';
            message.className = 'col-12 text-center py-5';
            message.innerHTML = `
                <div class="text-muted">
                    <i class="fas fa-search fa-3x mb-3"></i>
                    <h5>No documents match your filters</h5>
                    <p>Try adjusting your search criteria</p>
                </div>
            `;
            grid.appendChild(message);
        }
    }
    
    // Add event listeners
    searchInput.addEventListener('input', filterDocuments);
    statusFilter.addEventListener('change', filterDocuments);
    jurisdictionFilter.addEventListener('change', filterDocuments);
    languageFilter.addEventListener('change', filterDocuments);
    
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
            
            // Show loading state
            const originalHtml = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
            button.disabled = true;
            
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
                    
                    // Update button text and icon
                    button.innerHTML = `<i class="fas ${newStatus === 'active' ? 'fa-pause' : 'fa-play'} me-2"></i>${newStatus === 'active' ? 'Deactivate' : 'Activate'}`;
                    
                    // Update card styling
                    const card = button.closest('.document-card');
                    const documentItem = button.closest('.document-item');
                    
                    if (newStatus === 'active') {
                        card.classList.remove('inactive-document');
                    } else {
                        card.classList.add('inactive-document');
                    }
                    
                    // Update status badge in card header
                    const statusBadge = card.querySelector('.document-status .badge');
                    statusBadge.className = `badge ${newStatus === 'active' ? 'bg-success' : 'bg-secondary'}`;
                    statusBadge.innerHTML = `<i class="fas ${newStatus === 'active' ? 'fa-check-circle' : 'fa-pause-circle'} me-1"></i>${newStatus.charAt(0).toUpperCase() + newStatus.slice(1)}`;
                    
                    // Update dataset for filtering
                    documentItem.setAttribute('data-status', newStatus);
                    
                    // Show success message
                    showNotification(`Document status updated to ${newStatus}`, 'success');
                    
                } else {
                    showNotification('Failed to update document status', 'error');
                    button.innerHTML = originalHtml;
                }
                button.disabled = false;
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('An error occurred while updating the status', 'error');
                button.innerHTML = originalHtml;
                button.disabled = false;
            });
        });
    });
    
    // Notification function
    function showNotification(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
        
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert ${alertClass} alert-dismissible fade show shadow-sm position-fixed`;
        alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 1050; min-width: 300px;';
        alertDiv.innerHTML = `
            <i class="fas ${icon} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Auto dismiss after 4 seconds
        setTimeout(() => {
            alertDiv.classList.remove('show');
            setTimeout(() => alertDiv.remove(), 150);
        }, 4000);
    }
});
</script>
<?php $__env->stopPush(); ?>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteDocumentModal" tabindex="-1" aria-labelledby="deleteDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDocumentModalLabel">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Confirm Delete
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the document: <strong id="documentNameToDelete"></strong>?
                <div class="alert alert-warning mt-3" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. All document content will be permanently deleted.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form id="deleteDocForm" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Document
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\15\jurislocator_laravel\resources\views/admin/legal-documents/index.blade.php ENDPATH**/ ?>