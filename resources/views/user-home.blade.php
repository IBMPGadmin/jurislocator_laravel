@extends('layouts.user-layout')

@section('content')
<div class="container">
    <!-- Welcome Header -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="welcome-header text-center">
                <h1 class="display-4 mb-3" data-en="Welcome to JurisLocator" data-fr="Bienvenue sur JurisLocator">Welcome to JurisLocator</h1>
                <p class="lead text-muted" data-en="Your personal legal research workspace. Access legal documents, create notes, and manage your research efficiently" data-fr="Votre espace de recherche juridique personnel. Accédez aux documents juridiques, créez des notes et gérez efficacement vos recherches">
                    Your personal legal research workspace. Access legal documents, create notes, and manage your research efficiently
                </p>
                <div class="session-info bg-light p-3 rounded d-inline-block">
                    <i class="fas fa-home text-primary me-2"></i>
                    <strong data-en="Personal Workspace" data-fr="Espace de travail personnel">Personal Workspace</strong>
                    <span class="ms-3 text-muted">
                        <small>
                            <span data-en="Need client-specific work?" data-fr="Besoin de travail spécifique au client ?">Need client-specific work?</span>
                            <a href="{{ route('user.dashboard') }}" class="text-decoration-none ms-1" data-en="Switch to Client Mode" data-fr="Passer au mode client">Switch to Client Mode</a>
                        </small>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Tiles -->
    <div class="row g-4 mb-5">
        <!-- Legislation -->
        <div class="col-lg-4 col-md-6">
            <div class="feature-tile h-100" data-tile="legislation">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-balance-scale text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title mb-3" data-en="Legislation" data-fr="Législation">Legislation</h4>
                        <p class="card-text text-muted mb-4" data-en="Access Acts, Regulations, and Legal Statutes" data-fr="Accédez aux Lois, Règlements et Statuts juridiques">
                            Access Acts, Regulations, and Legal Statutes
                        </p>
                        <button class="btn btn-primary btn-lg" onclick="navigateToLegalTables()" data-en="Browse Laws" data-fr="Parcourir les lois">
                            Browse Laws <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CaseLaw -->
        <div class="col-lg-4 col-md-6">
            <div class="feature-tile h-100" data-tile="caselaw">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-gavel text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title mb-3" data-en="CaseLaw" data-fr="Jurisprudence">CaseLaw</h4>
                        <p class="card-text text-muted mb-4" data-en="Search Court Decisions and Legal Precedents" data-fr="Recherchez les décisions de justice et les précédents juridiques">
                            Search Court Decisions and Legal Precedents
                        </p>
                        <button class="btn btn-warning btn-lg" onclick="navigateToCaseLaw()" data-en="View Cases" data-fr="Voir les cas">
                            View Cases <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Notes and Annotations -->
        <div class="col-lg-4 col-md-6">
            <div class="feature-tile h-100" data-tile="notes">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-sticky-note text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title mb-3" data-en="My Notes & Annotations" data-fr="Mes notes et annotations">My Notes & Annotations</h4>
                        <p class="card-text text-muted mb-4" data-en="Manage your personal research notes and document annotations" data-fr="Gérez vos notes de recherche personnelles et annotations de documents">
                            Manage your personal research notes and document annotations
                        </p>
                        <button class="btn btn-success btn-lg" onclick="navigateToNotes()" data-en="View Notes" data-fr="Voir les notes">
                            View Notes <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Immigration Programs -->
        <div class="col-lg-4 col-md-6">
            <div class="feature-tile h-100" data-tile="programs">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-passport text-info" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title mb-3" data-en="Immigration Programs" data-fr="Programmes d'immigration">Immigration Programs</h4>
                        <p class="card-text text-muted mb-4" data-en="Explore Immigration Programs and Requirements" data-fr="Explorez les programmes d'immigration et les exigences">
                            Explore Immigration Programs and Requirements
                        </p>
                        <button class="btn btn-info btn-lg" onclick="navigateToPrograms()" data-en="View Programs" data-fr="Voir les programmes">
                            View Programs <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources -->
        <div class="col-lg-4 col-md-6">
            <div class="feature-tile h-100" data-tile="resources">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-book-open text-purple" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title mb-3" data-en="Resources" data-fr="Ressources">Resources</h4>
                        <p class="card-text text-muted mb-4" data-en="Access Government Links, Templates, and Legal Tools" data-fr="Accédez aux liens gouvernementaux, modèles et outils juridiques">
                            Access Government Links, Templates, and Legal Tools
                        </p>
                        <button class="btn btn-outline-primary btn-lg" onclick="navigateToResources()" data-en="Browse Resources" data-fr="Parcourir les ressources">
                            Browse Resources <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Support -->
        <div class="col-lg-4 col-md-6">
            <div class="feature-tile h-100" data-tile="support">
                <div class="card h-100 border-0 shadow-sm feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon mb-3">
                            <i class="fas fa-headset text-secondary" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="card-title mb-3" data-en="Support" data-fr="Support">Support</h4>
                        <p class="card-text text-muted mb-4" data-en="Get help with using JurisLocator and legal research" data-fr="Obtenez de l'aide pour utiliser JurisLocator et la recherche juridique">
                            Get help with using JurisLocator and legal research
                        </p>
                        <button class="btn btn-secondary btn-lg" onclick="navigateToSupport()" data-en="Get Support" data-fr="Obtenir du support">
                            Get Support <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0" data-en="Quick Actions" data-fr="Actions rapides">Quick Actions</h5>
                        <button class="btn btn-outline-primary btn-sm" onclick="switchToClientMode()" data-en="Switch to Client Mode" data-fr="Passer en mode client">
                            <i class="fas fa-users me-2"></i>Switch to Client Mode
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="quick-action" onclick="navigateToSearch()">
                                <i class="fas fa-search text-primary"></i>
                                <span data-en="Quick Search" data-fr="Recherche rapide">Quick Search</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="quick-action" onclick="navigateToTemplates()">
                                <i class="fas fa-file-alt text-success"></i>
                                <span data-en="My Templates" data-fr="Mes modèles">My Templates</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="quick-action" onclick="navigateToKeyTerms()">
                                <i class="fas fa-bookmark text-warning"></i>
                                <span data-en="Legal Terms" data-fr="Termes juridiques">Legal Terms</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="quick-action" onclick="navigateToDeadlines()">
                                <i class="fas fa-calendar-alt text-danger"></i>
                                <span data-en="Deadlines" data-fr="Échéances">Deadlines</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0" data-en="Recent Activity" data-fr="Activité récente">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="activity-timeline">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-book text-primary"></i>
                            </div>
                            <div class="activity-content">
                                <h6 data-en="Viewed Immigration and Refugee Protection Act" data-fr="Consulté la Loi sur l'immigration et la protection des réfugiés">Viewed Immigration and Refugee Protection Act</h6>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-sticky-note text-success"></i>
                            </div>
                            <div class="activity-content">
                                <h6 data-en="Added personal note on refugee status determination" data-fr="Ajouté une note personnelle sur la détermination du statut de réfugié">Added personal note on refugee status determination</h6>
                                <small class="text-muted">5 hours ago</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-search text-info"></i>
                            </div>
                            <div class="activity-content">
                                <h6 data-en="Searched for family class immigration regulations" data-fr="Recherché les règlements d'immigration de la catégorie familiale">Searched for family class immigration regulations</h6>
                                <small class="text-muted">1 day ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.feature-tile {
    cursor: pointer;
    transition: all 0.3s ease;
}

.feature-tile:hover {
    transform: translateY(-5px);
}

.feature-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.feature-card:hover {
    border-color: var(--bs-primary);
    box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.15) !important;
}

.feature-icon {
    transition: all 0.3s ease;
}

.feature-tile:hover .feature-icon i {
    transform: scale(1.1);
}

.text-purple {
    color: #6f42c1 !important;
}

.quick-action {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.quick-action:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.quick-action i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.activity-timeline {
    position: relative;
}

.activity-item {
    display: flex;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.activity-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.activity-content h6 {
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.session-info {
    border-left: 4px solid var(--bs-primary);
}

@media (max-width: 768px) {
    .feature-tile {
        margin-bottom: 1rem;
    }
    
    .quick-action {
        margin-bottom: 1rem;
    }
}
</style>

<script>
// Navigation functions for user-centric mode (without client selection)
function navigateToLegalTables() {
    window.location.href = '{{ route("user.legal-tables") }}';
}

function navigateToCaseLaw() {
    // This will be filtered to show only CaseLaw category
    window.location.href = '{{ route("user.legal-tables") }}?act_id=3';
}

function navigateToNotes() {
    window.location.href = '{{ route("user.notes") }}';
}

function navigateToPrograms() {
    window.location.href = '{{ route("user.immigration-programs") }}';
}

function navigateToResources() {
    window.location.href = '{{ route("user.government-links") }}';
}

function navigateToSupport() {
    window.location.href = '{{ route("user.support") }}';
}

function navigateToSearch() {
    window.location.href = '{{ route("user.legal-tables") }}';
}

function navigateToTemplates() {
    window.location.href = '{{ route("user.templates") }}';
}

function navigateToKeyTerms() {
    window.location.href = '{{ route("user.legal-key-terms.index") }}';
}

function navigateToDeadlines() {
    window.location.href = '{{ route("user.rcic-deadlines.index") }}';
}

function switchToClientMode() {
    if (confirm('{{ __("Switch to client-based session? This will redirect you to client selection.") }}')) {
        window.location.href = '{{ route("user.dashboard") }}';
    }
}

// Add tile click effects
document.addEventListener('DOMContentLoaded', function() {
    const tiles = document.querySelectorAll('.feature-tile');
    
    tiles.forEach(tile => {
        tile.addEventListener('click', function() {
            const tileType = this.getAttribute('data-tile');
            
            // Add visual feedback
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
});
</script>
@endsection
