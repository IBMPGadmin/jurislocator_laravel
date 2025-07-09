<!-- Right Side Container Template -->
<div class="sticky-container" style="top: 80px; position: fixed; right: 15px; width: calc(33.33% - 30px);">
    <!-- Droppable Area for Popups -->
    <div id="drag-area-right" class="widget_custom bg_custom droppable-area card mb-3">
        <div class="card-body">
            <div class="droppable-controls d-flex justify-content-between mb-2">
                <div>
                    <button id="save-popups-sidebar" class="btn btn-save btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#popupSaveModal">
                        <i class="fas fa-save"></i> <span data-en="Save Popups" data-fr="Sauvegarder les popups">Save Popups</span>
                    </button>
                    <button id="fetch-pinned-popups" class="btn btn-fetch btn-sm btn-secondary ms-2" 
                        data-client-id="<?php echo e($client->id ?? 0); ?>">
                        <i class="fas fa-download"></i> <span data-en="Fetch Popups" data-fr="Récupérer les popups">Fetch Popups</span>
                    </button>
                </div>
                <button id="clear-pinned-popups" class="btn btn-clear btn-sm btn-danger">
                    <i class="fas fa-trash"></i> <span data-en="Clear Popups" data-fr="Effacer les popups">Clear Popups</span>
                </button>
            </div>
            <div class="nested-droppable ui-droppable">
                <h5 class="card-title" data-en="Drop here:" data-fr="Déposer ici :">Drop here:</h5>
            </div>
        </div>
    </div>
    <!-- Rich Text Editor Container - Client Notes -->
    <div class="editor-container widget_custom bg_custom gap_top card">
        <!-- <div class="widget_header card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i> Client Notes</h5>
        </div> -->
        <div class="card-body">
            <!-- Notes Controls -->
            <div class="notes-controls d-flex justify-content-between mb-3">
                <div>
                    <button id="save-notes-sidebar" class="btn btn-save btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#notesSaveModal">
                        <i class="fas fa-save"></i> <span data-en="Save Notes" data-fr="Sauvegarder les notes">Save Notes</span>
                    </button>
                    <button id="fetch-notes-sidebar" class="btn btn-fetch btn-sm btn-info ms-2" data-bs-toggle="modal" data-bs-target="#notesFetchModal">
                        <i class="fas fa-download"></i> <span data-en="Fetch Notes" data-fr="Récupérer les notes">Fetch Notes</span>
                    </button>
                </div>
                <button id="clear-notes-sidebar" class="btn btn-clear btn-sm btn-warning">
                    <i class="fas fa-eraser"></i> <span data-en="Clear Editor" data-fr="Effacer l'éditeur">Clear Editor</span>
                </button>
            </div>
            <textarea id="tiny-editor">
            <?php if(isset($client)): ?>
            # Notes for <?php echo e($client->client_name); ?>

            
            - Client ID: <?php echo e($client->id); ?>

            - Status: <?php echo e($client->client_status ?? 'Unknown'); ?>

            - Last Contact: <?php echo e(now()->format('F d, Y')); ?>

            
            ## Action Items:
            - Follow up on application status
            - Request missing documents
            - Schedule next consultation
            <?php else: ?>
            # Client Notes
            
            Use the Save Notes and Fetch Notes buttons above to manage your notes.
            Notes can be saved to your personal records or to specific client records.
            <?php endif; ?>
            </textarea>
        </div>
    </div>
    
    <!-- TinyMCE container -->
</div>
<?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/layouts/right-sidebar.blade.php ENDPATH**/ ?>