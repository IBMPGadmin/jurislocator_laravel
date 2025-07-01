<!-- Right Side Container Template -->
<div class="sticky-container" style="top: 80px; position: fixed; right: 15px; width: calc(33.33% - 30px);">
    <!-- Droppable Area for Popups -->
    <div id="drag-area-right" class="widget_custom bg_custom droppable-area card mb-3">
        <div class="card-body">
            <div class="droppable-controls d-flex justify-content-between mb-2">
                <div>
                    <button id="save-pinned-popups" class="btn btn-save btn-sm btn-primary">
                        <i class="fas fa-save"></i> <span data-en="Save Popups" data-fr="Sauvegarder les popups">Save Popups</span>
                    </button>
                    <button id="fetch-pinned-popups" class="btn btn-fetch btn-sm btn-secondary ms-2">
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
    <!-- Rich Text Editor Container -->
    <div class="editor-container widget_custom bg_custom gap_top card">
        <div class="card-body">
            <textarea id="tiny-editor"></textarea>
        </div>
    </div>
    
    <!-- TinyMCE container -->
</div>
<?php /**PATH C:\Users\Dileesha\Desktop\j.v1-main\resources\views/layouts/right-sidebar.blade.php ENDPATH**/ ?>