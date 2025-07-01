@extends('layouts.user-layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h1 class="display-4 mb-4" data-en="Choose Your Session Mode" data-fr="Choisissez votre mode de session">Choose Your Session Mode</h1>
                <p class="lead text-muted" data-en="Select how you want to work with JurisLocator today" data-fr="Sélectionnez comment vous souhaitez travailler avec JurisLocator aujourd'hui">Select how you want to work with JurisLocator today</p>
            </div>

            <!-- Session Mode Options -->
            <div class="row g-4">
                <!-- User-Centric Session -->
                <div class="col-md-6">
                    <div class="session-mode-card h-100" onclick="selectSessionMode('user')">
                        <div class="card h-100 border-0 shadow-lg session-card" data-mode="user">
                            <div class="card-body text-center p-5">
                                <div class="session-icon mb-4">
                                    <i class="fas fa-user-circle text-primary" style="font-size: 4rem;"></i>
                                </div>
                                <h3 class="card-title mb-3" data-en="Personal Session" data-fr="Session personnelle">Personal Session</h3>
                                <p class="card-text mb-4 text-muted" data-en="Work directly with legal documents, save your own notes and annotations without client association" data-fr="Travaillez directement avec des documents juridiques, sauvegardez vos propres notes et annotations sans association client">
                                    Work directly with legal documents, save your own notes and annotations without client association
                                </p>
                                <div class="features-list text-start">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Personal legal research" data-fr="Recherche juridique personnelle">Personal legal research</span></li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Your own notes & annotations" data-fr="Vos propres notes et annotations">Your own notes & annotations</span></li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Personal templates" data-fr="Modèles personnels">Personal templates</span></li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Quick access to documents" data-fr="Accès rapide aux documents">Quick access to documents</span></li>
                                    </ul>
                                </div>
                                <button class="btn btn-primary btn-lg mt-3" data-en="Start Personal Session" data-fr="Démarrer une session personnelle">
                                    Start Personal Session <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Client-Centric Session -->
                <div class="col-md-6">
                    <div class="session-mode-card h-100" onclick="selectSessionMode('client')">
                        <div class="card h-100 border-0 shadow-lg session-card" data-mode="client">
                            <div class="card-body text-center p-5">
                                <div class="session-icon mb-4">
                                    <i class="fas fa-users text-info" style="font-size: 4rem;"></i>
                                </div>
                                <h3 class="card-title mb-3" data-en="Client-Based Session" data-fr="Session basée sur le client">Client-Based Session</h3>
                                <p class="card-text mb-4 text-muted" data-en="Select a specific client and work on their case with client-specific notes, templates and document management" data-fr="Sélectionnez un client spécifique et travaillez sur son dossier avec des notes, modèles et gestion de documents spécifiques au client">
                                    Select a specific client and work on their case with client-specific notes, templates and document management
                                </p>
                                <div class="features-list text-start">
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Client-specific research" data-fr="Recherche spécifique au client">Client-specific research</span></li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Client case notes" data-fr="Notes de dossier client">Client case notes</span></li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Client templates & documents" data-fr="Modèles et documents client">Client templates & documents</span></li>
                                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i><span data-en="Case management tools" data-fr="Outils de gestion de cas">Case management tools</span></li>
                                    </ul>
                                </div>
                                <button class="btn btn-info btn-lg mt-3" data-en="Select Client & Continue" data-fr="Sélectionner le client et continuer">
                                    Select Client & Continue <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0" data-en="Recent Activity" data-fr="Activité récente">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-muted" data-en="Recent Personal Sessions" data-fr="Sessions personnelles récentes">Recent Personal Sessions</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-clock text-muted me-2"></i>
                                            <span data-en="Last accessed: Immigration Act research" data-fr="Dernier accès : Recherche sur la Loi sur l'immigration">Last accessed: Immigration Act research</span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-sticky-note text-muted me-2"></i>
                                            <span data-en="3 personal notes saved" data-fr="3 notes personnelles sauvegardées">3 personal notes saved</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted" data-en="Recent Client Work" data-fr="Travail client récent">Recent Client Work</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-user text-muted me-2"></i>
                                            <span data-en="Last client session: John Smith case" data-fr="Dernière session client : dossier John Smith">Last client session: John Smith case</span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-file-alt text-muted me-2"></i>
                                            <span data-en="2 client templates updated" data-fr="2 modèles client mis à jour">2 client templates updated</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.session-mode-card {
    cursor: pointer;
    transition: all 0.3s ease;
}

.session-mode-card:hover {
    transform: translateY(-5px);
}

.session-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.session-card:hover {
    border-color: var(--bs-primary);
    box-shadow: 0 0.5rem 2rem rgba(0, 0, 0, 0.15) !important;
}

.session-card[data-mode="client"]:hover {
    border-color: var(--bs-info);
}

.session-icon {
    transition: all 0.3s ease;
}

.session-mode-card:hover .session-icon i {
    transform: scale(1.1);
}

.features-list ul li {
    opacity: 0.8;
    transition: opacity 0.3s ease;
}

.session-mode-card:hover .features-list ul li {
    opacity: 1;
}

@media (max-width: 768px) {
    .session-mode-card {
        margin-bottom: 1rem;
    }
}
</style>

<script>
function selectSessionMode(mode) {
    if (mode === 'user') {
        // Redirect to user-centric home page
        window.location.href = '{{ route("user.home") }}';
    } else if (mode === 'client') {
        // Redirect to client selection (current user dashboard)
        window.location.href = '{{ route("user.dashboard") }}';
    }
}

// Add click effects
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.session-mode-card');
    
    cards.forEach(card => {
        card.addEventListener('click', function() {
            const mode = this.querySelector('.session-card').getAttribute('data-mode');
            
            // Add visual feedback
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
                selectSessionMode(mode);
            }, 150);
        });
    });
});
</script>
@endsection
