<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 data-en="Document Templates" data-fr="Modèles de documents">Document Templates</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTemplateModal">
                        <i class="fas fa-plus me-2"></i> <span data-en="New Template" data-fr="Nouveau modèle">New Template</span>
                    </button>
                </div>
                <div class="card-body">
                    <?php if(!session('selected_client_id')): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <span data-en="Please select a client to view their templates." data-fr="Veuillez sélectionner un client pour voir ses modèles.">Please select a client to view their templates.</span>
                        </div>
                    <?php else: ?>
                        <div class="row" id="templatesContainer">
                            <!-- Templates will be loaded here -->
                            <?php for($i = 1; $i <= 6; $i++): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card template-card h-100 border-0 shadow-sm">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h5 class="card-title">Sample Template <?php echo e($i); ?></h5>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i> <span data-en="Edit" data-fr="Modifier">Edit</span></a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="fas fa-copy me-2"></i> <span data-en="Duplicate" data-fr="Dupliquer">Duplicate</span></a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i> <span data-en="Delete" data-fr="Supprimer">Delete</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="card-text text-muted" data-en="This is a sample template description. It contains various sections that can be customized." data-fr="Ceci est un exemple de description de modèle. Il contient diverses sections qui peuvent être personnalisées.">This is a sample template description. It contains various sections that can be customized.</p>
                                            <div class="d-flex justify-content-between mt-3">
                                                <span class="badge bg-secondary" data-en="Document" data-fr="Document">Document</span>
                                                <small class="text-muted"><span data-en="Updated:" data-fr="Mis à jour :">Updated:</span> <?php echo e(date('M d, Y')); ?></small>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-0">
                                            <button class="btn btn-outline-primary btn-sm w-100">
                                                <i class="fas fa-edit me-2"></i> <span data-en="Use Template" data-fr="Utiliser le modèle">Use Template</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Template Modal -->
<div class="modal fade" id="newTemplateModal" tabindex="-1" aria-labelledby="newTemplateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTemplateModalLabel" data-en="Create New Template" data-fr="Créer un nouveau modèle">Create New Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="newTemplateForm">
                    <div class="mb-3">
                        <label for="templateName" class="form-label" data-en="Template Name" data-fr="Nom du modèle">Template Name</label>
                        <input type="text" class="form-control" id="templateName" required>
                    </div>
                    <div class="mb-3">
                        <label for="templateDescription" class="form-label" data-en="Description" data-fr="Description">Description</label>
                        <textarea class="form-control" id="templateDescription" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="templateType" class="form-label" data-en="Template Type" data-fr="Type de modèle">Template Type</label>
                        <select class="form-control" id="templateType">
                            <option value="document" data-en="Document" data-fr="Document">Document</option>
                            <option value="letter" data-en="Letter" data-fr="Lettre">Letter</option>
                            <option value="form" data-en="Form" data-fr="Formulaire">Form</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Cancel" data-fr="Annuler">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveTemplateBtn" data-en="Create Template" data-fr="Créer le modèle">Create Template</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .template-card {
        transition: transform 0.2s;
    }
    
    .template-card:hover {
        transform: translateY(-5px);
    }
    
    .template-card .card-footer {
        padding-top: 0;
    }
    
    .badge {
        padding: 0.5em 0.8em;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function() {
        // Save template button action
        $('#saveTemplateBtn').click(function() {
            // Validation
            if(!$('#templateName').val()) {
                alert('Please enter a template name');
                return;
            }
            
            // Here you would normally save the template via AJAX
            // For this example, we'll just close the modal
            $('#newTemplateModal').modal('hide');
            
            // Show success message
            Swal.fire({
                title: 'Success!',
                text: 'Template created successfully',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\j.v1-main\resources\views/templates.blade.php ENDPATH**/ ?>