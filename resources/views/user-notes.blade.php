@extends('layouts.user-layout')

@section('content')
<div class="container">
    <!-- Session Info Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="session-avatar me-3 d-flex justify-content-center align-items-center rounded-circle bg-success text-white" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fas fa-sticky-note"></i>
                        </div>
                        <div class="session-info">
                            <h4 class="mb-1" data-en="My Personal Notes & Annotations" data-fr="Mes notes et annotations personnelles">My Personal Notes & Annotations</h4>
                            <small class="text-muted" data-en="All your personal research notes and document annotations" data-fr="Toutes vos notes de recherche personnelles et annotations de documents">
                                All your personal research notes and document annotations
                            </small>
                        </div>
                    </div>
                    <div class="session-actions">
                        <a href="{{ route('user.home') }}" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-home me-1"></i>
                            <span data-en="Home" data-fr="Accueil">Home</span>
                        </a>
                        <button class="btn btn-success btn-sm" onclick="createNewNote()">
                            <i class="fas fa-plus me-1"></i>
                            <span data-en="New Note" data-fr="Nouvelle note">New Note</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-sticky-note text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $notes->total() }}</h3>
                    <small class="text-muted" data-en="Total Notes" data-fr="Total des notes">Total Notes</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-calendar text-info" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $notes->where('updated_at', '>=', now()->subDays(7))->count() }}</h3>
                    <small class="text-muted" data-en="This Week" data-fr="Cette semaine">This Week</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-bookmark text-warning" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $notes->where('type', 'annotation')->count() }}</h3>
                    <small class="text-muted" data-en="Annotations" data-fr="Annotations">Annotations</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-file-alt text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ $notes->where('type', 'personal_note')->count() }}</h3>
                    <small class="text-muted" data-en="Personal Notes" data-fr="Notes personnelles">Personal Notes</small>
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
                                <input type="text" class="form-control" id="searchNotes" placeholder="Search notes..." data-placeholder-en="Search notes..." data-placeholder-fr="Rechercher des notes...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterType">
                                <option value="" data-en="All Types" data-fr="Tous les types">All Types</option>
                                <option value="personal_note" data-en="Personal Notes" data-fr="Notes personnelles">Personal Notes</option>
                                <option value="annotation" data-en="Annotations" data-fr="Annotations">Annotations</option>
                                <option value="user_annotation" data-en="Document Annotations" data-fr="Annotations de documents">Document Annotations</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sortBy">
                                <option value="updated_at" data-en="Sort by Date" data-fr="Trier par date">Sort by Date</option>
                                <option value="title" data-en="Sort by Title" data-fr="Trier par titre">Sort by Title</option>
                                <option value="type" data-en="Sort by Type" data-fr="Trier par type">Sort by Type</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notes List -->
    <div class="row">
        <div class="col-12">
            @if($notes->count() > 0)
                <div class="notes-container">
                    @foreach($notes as $note)
                        <div class="note-card card border-0 shadow-sm mb-3" data-note-id="{{ $note->id }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="note-content flex-grow-1">
                                        <div class="d-flex align-items-center mb-2">
                                            <h5 class="note-title mb-0">{{ $note->title ?: 'Untitled Note' }}</h5>
                                            <span class="badge bg-{{ $note->type === 'personal_note' ? 'primary' : 'success' }} ms-2">
                                                {{ ucfirst(str_replace('_', ' ', $note->type)) }}
                                            </span>
                                        </div>
                                        <div class="note-body">
                                            {!! Str::limit(strip_tags($note->content), 200) !!}
                                        </div>
                                        <div class="note-meta mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>
                                                <span data-en="Updated:" data-fr="Mis à jour :">Updated:</span> {{ $note->updated_at->diffForHumans() }}
                                                @if($note->document_id)
                                                    <i class="fas fa-file-alt ms-3 me-1"></i>
                                                    <span data-en="From document:" data-fr="Du document :">From document:</span> {{ $note->table_name }}
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="note-actions">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="editNote({{ $note->id }})">
                                                    <i class="fas fa-edit me-2"></i><span data-en="Edit" data-fr="Modifier">Edit</span>
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="viewNote({{ $note->id }})">
                                                    <i class="fas fa-eye me-2"></i><span data-en="View Full" data-fr="Voir en entier">View Full</span>
                                                </a></li>
                                                @if($note->document_id)
                                                <li><a class="dropdown-item" href="#" onclick="goToDocument('{{ $note->table_name }}', '{{ $note->document_id }}')">
                                                    <i class="fas fa-external-link-alt me-2"></i><span data-en="Go to Document" data-fr="Aller au document">Go to Document</span>
                                                </a></li>
                                                @endif
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="deleteNote({{ $note->id }})">
                                                    <i class="fas fa-trash me-2"></i><span data-en="Delete" data-fr="Supprimer">Delete</span>
                                                </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $notes->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-sticky-note" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                        <h4 data-en="No Notes Yet" data-fr="Aucune note pour le moment">No Notes Yet</h4>
                        <p class="text-muted" data-en="Start creating personal notes and annotations while browsing legal documents." data-fr="Commencez à créer des notes personnelles et des annotations en parcourant les documents juridiques.">
                            Start creating personal notes and annotations while browsing legal documents.
                        </p>
                        <a href="{{ route('user.legal-tables') }}" class="btn btn-primary">
                            <i class="fas fa-book me-2"></i>
                            <span data-en="Browse Legal Documents" data-fr="Parcourir les documents juridiques">Browse Legal Documents</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Note Modal -->
<div class="modal fade" id="noteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="noteModalTitle" data-en="Create Note" data-fr="Créer une note">Create Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="noteForm">
                    <div class="mb-3">
                        <label for="noteTitle" class="form-label" data-en="Title" data-fr="Titre">Title</label>
                        <input type="text" class="form-control" id="noteTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="noteContent" class="form-label" data-en="Content" data-fr="Contenu">Content</label>
                        <textarea class="form-control" id="noteContent" rows="8" required></textarea>
                    </div>
                    <input type="hidden" id="noteId">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Cancel" data-fr="Annuler">Cancel</button>
                <button type="button" class="btn btn-success" onclick="saveNote()" data-en="Save Note" data-fr="Sauvegarder la note">Save Note</button>
            </div>
        </div>
    </div>
</div>

<style>
.note-card {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.note-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
    border-left-color: var(--bs-primary);
}

.note-title {
    color: #333;
    font-weight: 600;
}

.note-body {
    color: #666;
    line-height: 1.6;
}

.note-meta {
    border-top: 1px solid #f0f0f0;
    padding-top: 0.5rem;
}

.empty-state {
    padding: 3rem 1rem;
}

.stat-icon {
    opacity: 0.8;
}
</style>

<script>
let currentNoteId = null;

function createNewNote() {
    currentNoteId = null;
    document.getElementById('noteModalTitle').textContent = 'Create Note';
    document.getElementById('noteTitle').value = '';
    document.getElementById('noteContent').value = '';
    document.getElementById('noteId').value = '';
    
    const modal = new bootstrap.Modal(document.getElementById('noteModal'));
    modal.show();
}

function editNote(noteId) {
    currentNoteId = noteId;
    // You would fetch the note data here and populate the form
    document.getElementById('noteModalTitle').textContent = 'Edit Note';
    document.getElementById('noteId').value = noteId;
    
    const modal = new bootstrap.Modal(document.getElementById('noteModal'));
    modal.show();
}

function viewNote(noteId) {
    // Implement view note functionality
    console.log('View note:', noteId);
}

function deleteNote(noteId) {
    if (confirm('Are you sure you want to delete this note?')) {
        fetch(`/user-notes/${noteId}`, {
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
                alert('Error deleting note');
            }
        });
    }
}

function saveNote() {
    const title = document.getElementById('noteTitle').value;
    const content = document.getElementById('noteContent').value;
    const noteId = document.getElementById('noteId').value;
    
    if (!title || !content) {
        alert('Please fill in all fields');
        return;
    }
    
    const url = noteId ? `/user-notes/${noteId}` : '/user-notes';
    const method = noteId ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            title: title,
            content: content
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error saving note');
        }
    });
}

function goToDocument(tableName, documentId) {
    window.location.href = `/view-user-legal-table/${tableName}?category_id=${documentId}`;
}

// Search and filter functionality
document.getElementById('searchNotes').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const notes = document.querySelectorAll('.note-card');
    
    notes.forEach(note => {
        const title = note.querySelector('.note-title').textContent.toLowerCase();
        const content = note.querySelector('.note-body').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || content.includes(searchTerm)) {
            note.style.display = '';
        } else {
            note.style.display = 'none';
        }
    });
});
</script>
@endsection
