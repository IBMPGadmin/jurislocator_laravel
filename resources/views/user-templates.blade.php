@extends('layouts.user-layout')

@section('content')
<div class="container">
    <!-- Session Info Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="session-avatar me-3 d-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="session-info">
                            <h4 class="mb-1" data-en="My Personal Templates" data-fr="Mes modèles personnels">My Personal Templates</h4>
                            <small class="text-muted" data-en="Manage your personal document templates and forms" data-fr="Gérez vos modèles de documents personnels et formulaires">
                                Manage your personal document templates and forms
                            </small>
                        </div>
                    </div>
                    <div class="session-actions">
                        <a href="{{ route('user.home') }}" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-home me-1"></i>
                            <span data-en="Home" data-fr="Accueil">Home</span>
                        </a>
                        <button class="btn btn-primary btn-sm" onclick="createNewTemplate()">
                            <i class="fas fa-plus me-1"></i>
                            <span data-en="New Template" data-fr="Nouveau modèle">New Template</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-file-alt text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $templates->total() }}</h3>
                    <small class="text-muted" data-en="Total Templates" data-fr="Total des modèles">Total Templates</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-folder text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $templates->groupBy('category')->count() }}</h3>
                    <small class="text-muted" data-en="Categories" data-fr="Catégories">Categories</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-calendar text-info" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $templates->where('updated_at', '>=', now()->subDays(7))->count() }}</h3>
                    <small class="text-muted" data-en="This Week" data-fr="Cette semaine">This Week</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="searchTemplates" placeholder="Search templates..." data-placeholder-en="Search templates..." data-placeholder-fr="Rechercher des modèles...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterCategory">
                                <option value="" data-en="All Categories" data-fr="Toutes les catégories">All Categories</option>
                                @foreach($templates->unique('category') as $template)
                                    <option value="{{ $template->category }}">{{ $template->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sortBy">
                                <option value="updated_at" data-en="Sort by Date" data-fr="Trier par date">Sort by Date</option>
                                <option value="title" data-en="Sort by Title" data-fr="Trier par titre">Sort by Title</option>
                                <option value="category" data-en="Sort by Category" data-fr="Trier par catégorie">Sort by Category</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Templates Grid -->
    <div class="row">
        <div class="col-12">
            @if($templates->count() > 0)
                <div class="row templates-container">
                    @foreach($templates as $template)
                        <div class="col-lg-4 col-md-6 mb-4 template-item" data-template-id="{{ $template->id }}" data-category="{{ $template->category }}">
                            <div class="card border-0 shadow-sm h-100 template-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="template-icon">
                                            <i class="fas fa-file-alt text-primary" style="font-size: 2rem;"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="editTemplate({{ $template->id }})">
                                                    <i class="fas fa-edit me-2"></i><span data-en="Edit" data-fr="Modifier">Edit</span>
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="duplicateTemplate({{ $template->id }})">
                                                    <i class="fas fa-copy me-2"></i><span data-en="Duplicate" data-fr="Dupliquer">Duplicate</span>
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="exportTemplate({{ $template->id }})">
                                                    <i class="fas fa-download me-2"></i><span data-en="Export" data-fr="Exporter">Export</span>
                                                </a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteTemplate({{ $template->id }})">
                                                    <i class="fas fa-trash me-2"></i><span data-en="Delete" data-fr="Supprimer">Delete</span>
                                                </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <h5 class="template-title mb-2">{{ $template->title }}</h5>
                                    <span class="badge bg-primary mb-3">{{ $template->category }}</span>
                                    
                                    <div class="template-preview mb-3">
                                        <p class="text-muted small">
                                            {!! Str::limit(strip_tags($template->content), 120) !!}
                                        </p>
                                    </div>
                                    
                                    <div class="template-meta">
                                        <small class="text-muted d-block mb-2">
                                            <i class="fas fa-clock me-1"></i>
                                            <span data-en="Updated:" data-fr="Mis à jour :">Updated:</span> {{ $template->updated_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                                <div class="card-footer bg-light border-0">
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-primary btn-sm" onclick="previewTemplate({{ $template->id }})">
                                            <i class="fas fa-eye me-1"></i>
                                            <span data-en="Preview" data-fr="Aperçu">Preview</span>
                                        </button>
                                        <button class="btn btn-primary btn-sm" onclick="useTemplate({{ $template->id }})">
                                            <i class="fas fa-external-link-alt me-1"></i>
                                            <span data-en="Use Template" data-fr="Utiliser le modèle">Use Template</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $templates->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-file-alt" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <h4 data-en="No Templates Yet" data-fr="Aucun modèle pour le moment">No Templates Yet</h4>
                        <p class="text-muted" data-en="Create your first personal template to get started." data-fr="Créez votre premier modèle personnel pour commencer.">
                            Create your first personal template to get started.
                        </p>
                        <button class="btn btn-primary" onclick="createNewTemplate()">
                            <i class="fas fa-plus me-2"></i>
                            <span data-en="Create Template" data-fr="Créer un modèle">Create Template</span>
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Template Modal -->
<div class="modal fade" id="templateModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="templateModalTitle" data-en="Create Template" data-fr="Créer un modèle">Create Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="templateForm">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="templateTitle" class="form-label" data-en="Title" data-fr="Titre">Title</label>
                                <input type="text" class="form-control" id="templateTitle" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="templateCategory" class="form-label" data-en="Category" data-fr="Catégorie">Category</label>
                                <input type="text" class="form-control" id="templateCategory" list="categories" required>
                                <datalist id="categories">
                                    <option value="Legal Letters">
                                    <option value="Client Communications">
                                    <option value="Case Documents">
                                    <option value="Forms">
                                    <option value="Reports">
                                    <option value="General">
                                </datalist>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="templateContent" class="form-label" data-en="Content" data-fr="Contenu">Content</label>
                        <textarea class="form-control" id="templateContent" rows="15" required></textarea>
                    </div>
                    <input type="hidden" id="templateId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Cancel" data-fr="Annuler">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveTemplate()" data-en="Save Template" data-fr="Sauvegarder le modèle">Save Template</button>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" data-en="Template Preview" data-fr="Aperçu du modèle">Template Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="previewContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Close" data-fr="Fermer">Close</button>
            </div>
        </div>
    </div>
</div>

<style>
.template-card {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
    cursor: pointer;
}

.template-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    border-left-color: var(--bs-primary);
}

.template-title {
    color: #333;
    font-weight: 600;
}

.template-preview {
    min-height: 60px;
}

.template-icon {
    opacity: 0.8;
}

.empty-state {
    padding: 3rem 1rem;
}

.stat-icon {
    opacity: 0.8;
}
</style>

<script>
let currentTemplateId = null;

function createNewTemplate() {
    currentTemplateId = null;
    document.getElementById('templateModalTitle').textContent = 'Create Template';
    document.getElementById('templateTitle').value = '';
    document.getElementById('templateCategory').value = '';
    document.getElementById('templateContent').value = '';
    document.getElementById('templateId').value = '';
    
    const modal = new bootstrap.Modal(document.getElementById('templateModal'));
    modal.show();
}

function editTemplate(templateId) {
    currentTemplateId = templateId;
    // You would fetch the template data here and populate the form
    document.getElementById('templateModalTitle').textContent = 'Edit Template';
    document.getElementById('templateId').value = templateId;
    
    const modal = new bootstrap.Modal(document.getElementById('templateModal'));
    modal.show();
}

function previewTemplate(templateId) {
    // Fetch and display template content in preview modal
    const modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
}

function useTemplate(templateId) {
    // Redirect to template editor or usage page
    console.log('Use template:', templateId);
}

function duplicateTemplate(templateId) {
    if (confirm('Are you sure you want to duplicate this template?')) {
        // Implement duplication logic
        console.log('Duplicate template:', templateId);
    }
}

function exportTemplate(templateId) {
    // Implement export functionality
    console.log('Export template:', templateId);
}

function deleteTemplate(templateId) {
    if (confirm('Are you sure you want to delete this template?')) {
        fetch(`/user-templates/${templateId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting template');
            }
        });
    }
}

function saveTemplate() {
    const title = document.getElementById('templateTitle').value;
    const category = document.getElementById('templateCategory').value;
    const content = document.getElementById('templateContent').value;
    const templateId = document.getElementById('templateId').value;
    
    if (!title || !category || !content) {
        alert('Please fill in all fields');
        return;
    }
    
    const url = templateId ? `/user-templates/${templateId}` : '/user-templates';
    const method = templateId ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: title,
            category: category,
            content: content
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error saving template');
        }
    });
}

// Search and filter functionality
document.getElementById('searchTemplates').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const templates = document.querySelectorAll('.template-item');
    
    templates.forEach(template => {
        const title = template.querySelector('.template-title').textContent.toLowerCase();
        const content = template.querySelector('.template-preview').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || content.includes(searchTerm)) {
            template.style.display = '';
        } else {
            template.style.display = 'none';
        }
    });
});

document.getElementById('filterCategory').addEventListener('change', function() {
    const selectedCategory = this.value;
    const templates = document.querySelectorAll('.template-item');
    
    templates.forEach(template => {
        const category = template.getAttribute('data-category');
        
        if (!selectedCategory || category === selectedCategory) {
            template.style.display = '';
        } else {
            template.style.display = 'none';
        }
    });
});
</script>
@endsection
