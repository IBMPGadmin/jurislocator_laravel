<!-- Right Side Container Template -->
<div class="sticky-container" style="top: 80px; position: fixed; right: 15px; width: calc(33.33% - 30px); max-height: calc(100vh - 100px); overflow-y: auto;">
    <!-- Unified Content Management Controls -->
    <div class="unified-controls-container widget_custom bg_custom card mb-2">
        <div class="card-header bg-warning text-white">
            <h6 class="mb-0"><i class="fas fa-cogs me-2"></i> Content Management</h6>
        </div>
        <div class="card-body">
            <p class="text-white-50 small mb-2 text-center" data-en="Quick actions: Save and fetch both popups and notes from here" data-fr="Actions rapides : Sauvegarder et récupérer les popups et notes depuis ici">
                Quick actions: Save and fetch both popups and notes from here
            </p>
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <button id="save-all-content" class="btn btn-save btn-success" data-bs-toggle="modal" data-bs-target="#unifiedSaveModal" title="Save All Content (Popups & Notes)">
                    <i class="fas fa-save me-1"></i> 
                    <span data-en="Save All" data-fr="Sauvegarder tout">Save All</span>
                </button>
                <button id="fetch-all-content" class="btn btn-fetch btn-info" data-bs-toggle="modal" data-bs-target="#unifiedFetchModal" title="Fetch All Content (Popups & Notes)">
                    <i class="fas fa-download me-1"></i> 
                    <span data-en="Fetch All" data-fr="Récupérer tout">Fetch All</span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Droppable Area for Popups -->
    <div id="drag-area-right" class="widget_custom bg_custom droppable-area card mb-2">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center py-2">
            <h6 class="mb-0"><i class="fas fa-bookmark me-2"></i> Reference Container</h6>
            <div class="header-controls">
                <button id="save-popups-sidebar" class="btn btn-sm btn-outline-light me-1" data-bs-toggle="modal" data-bs-target="#popupSaveModal" title="Save Popups">
                    <i class="fas fa-save"></i>
                </button>
                <button id="fetch-pinned-popups" class="btn btn-sm btn-outline-light me-1" 
                    data-client-id="{{ $client->id ?? 0 }}" title="Fetch Popups">
                    <i class="fas fa-download"></i>
                </button>
                <button id="clear-pinned-popups" class="btn btn-sm btn-outline-light" title="Clear Popups">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="card-body py-2">
            <div class="nested-droppable ui-droppable">
                <h6 class="card-title text-muted text-center mb-0" data-en="Drag and drop your references here" data-fr="Glissez et déposez vos références ici">Drag and drop your references here</h6>
            </div>
        </div>
    </div>
    
    <!-- Rich Text Editor Container - Client Notes -->
    <div class="editor-container widget_custom bg_custom card">
        <div class="widget_header card-header bg-warning text-white d-flex justify-content-between align-items-center py-2">
            <h6 class="mb-0"><i class="fas fa-sticky-note me-2"></i> Custom Notes</h6>
            <div class="header-controls">
                <button id="save-notes-sidebar" class="btn btn-sm btn-outline-light me-1" data-bs-toggle="modal" data-bs-target="#notesSaveModal" title="Save Notes">
                    <i class="fas fa-save"></i>
                </button>
                <button id="fetch-notes-sidebar" class="btn btn-sm btn-outline-light me-1" data-bs-toggle="modal" data-bs-target="#notesFetchModal" title="Fetch Notes">
                    <i class="fas fa-download"></i>
                </button>
                <button id="clear-notes-sidebar" class="btn btn-sm btn-outline-light" title="Clear Editor">
                    <i class="fas fa-eraser"></i>
                </button>
            </div>
        </div>
        <div class="card-body py-2">
            <textarea id="tiny-editor">
            @if(isset($client))
            # Notes for {{ $client->client_name }}
            
            - Client ID: {{ $client->id }}
            - Status: {{ $client->client_status ?? 'Unknown' }}
            - Last Contact: {{ now()->format('F d, Y') }}
            
            ## Action Items:
            - Follow up on application status
            - Request missing documents
            - Schedule next consultation
            @else
            # Client Notes
            
            Please select a client to view notes.
            @endif
            </textarea>
        </div>
    </div>
    
    <!-- TinyMCE container -->
</div>
