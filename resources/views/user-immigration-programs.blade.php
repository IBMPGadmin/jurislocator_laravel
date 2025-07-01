@extends('layouts.user-layout')

@section('content')
<div class="container">
    <!-- Session Info Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="session-avatar me-3 d-flex justify-content-center align-items-center rounded-circle bg-info text-white" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fas fa-passport"></i>
                        </div>
                        <div class="session-info">
                            <h4 class="mb-1" data-en="Immigration Programs" data-fr="Programmes d'immigration">Immigration Programs</h4>
                            <small class="text-muted" data-en="Comprehensive guide to Canadian immigration programs and requirements" data-fr="Guide complet des programmes d'immigration canadiens et des exigences">
                                Comprehensive guide to Canadian immigration programs and requirements
                            </small>
                        </div>
                    </div>
                    <div class="session-actions">
                        <a href="{{ route('user.home') }}" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-home me-1"></i>
                            <span data-en="Home" data-fr="Accueil">Home</span>
                        </a>
                        <button class="btn btn-info btn-sm" onclick="refreshPrograms()">
                            <i class="fas fa-sync me-1"></i>
                            <span data-en="Refresh" data-fr="Actualiser">Refresh</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-users text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ count($programs) }}</h3>
                    <small class="text-muted" data-en="Total Programs" data-fr="Total des programmes">Total Programs</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-briefcase text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ collect($programs)->where('category', 'Economic Immigration')->count() }}</h3>
                    <small class="text-muted" data-en="Economic Programs" data-fr="Programmes économiques">Economic Programs</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-heart text-danger" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ collect($programs)->where('category', 'Family Immigration')->count() }}</h3>
                    <small class="text-muted" data-en="Family Programs" data-fr="Programmes familiaux">Family Programs</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="stat-icon mb-2">
                        <i class="fas fa-map-marker-alt text-warning" style="font-size: 2rem;"></i>
                    </div>
                    <h3 class="mb-1">{{ collect($programs)->where('category', 'Provincial Immigration')->count() }}</h3>
                    <small class="text-muted" data-en="Provincial Programs" data-fr="Programmes provinciaux">Provincial Programs</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label" data-en="Filter by Category" data-fr="Filtrer par catégorie">Filter by Category</label>
                            <select class="form-select" id="categoryFilter">
                                <option value="" data-en="All Categories" data-fr="Toutes les catégories">All Categories</option>
                                <option value="Economic Immigration" data-en="Economic Immigration" data-fr="Immigration économique">Economic Immigration</option>
                                <option value="Family Immigration" data-en="Family Immigration" data-fr="Immigration familiale">Family Immigration</option>
                                <option value="Provincial Immigration" data-en="Provincial Immigration" data-fr="Immigration provinciale">Provincial Immigration</option>
                                <option value="Refugee Immigration" data-en="Refugee Immigration" data-fr="Immigration de réfugiés">Refugee Immigration</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" data-en="Processing Time" data-fr="Temps de traitement">Processing Time</label>
                            <select class="form-select" id="timeFilter">
                                <option value="" data-en="All Processing Times" data-fr="Tous les temps de traitement">All Processing Times</option>
                                <option value="fast" data-en="Fast (1-6 months)" data-fr="Rapide (1-6 mois)">Fast (1-6 months)</option>
                                <option value="medium" data-en="Medium (6-12 months)" data-fr="Moyen (6-12 mois)">Medium (6-12 months)</option>
                                <option value="slow" data-en="Slow (12+ months)" data-fr="Lent (12+ mois)">Slow (12+ months)</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" data-en="Search Programs" data-fr="Rechercher des programmes">Search Programs</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control" id="searchPrograms" placeholder="Search by name or keywords..." data-placeholder-en="Search by name or keywords..." data-placeholder-fr="Rechercher par nom ou mots-clés...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Programs Grid -->
    <div class="row programs-container">
        @foreach($programs as $index => $program)
            <div class="col-lg-6 mb-4 program-item" data-category="{{ $program['category'] }}" data-processing-time="{{ $program['processing_time'] }}">
                <div class="card border-0 shadow-sm h-100 program-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div class="program-icon">
                                @php
                                    $iconClass = 'fas fa-passport';
                                    if (str_contains($program['category'], 'Economic')) {
                                        $iconClass = 'fas fa-briefcase';
                                    } elseif (str_contains($program['category'], 'Family')) {
                                        $iconClass = 'fas fa-heart';
                                    } elseif (str_contains($program['category'], 'Provincial')) {
                                        $iconClass = 'fas fa-map-marker-alt';
                                    }
                                @endphp
                                <i class="{{ $iconClass }} text-primary" style="font-size: 2.5rem;"></i>
                            </div>
                            <span class="badge bg-primary">{{ $program['category'] }}</span>
                        </div>
                        
                        <h4 class="program-title mb-3" data-en="{{ $program['name'] }}" data-fr="{{ $program['name'] }}">{{ $program['name'] }}</h4>
                        
                        <p class="program-description text-muted mb-3" data-en="{{ $program['description'] }}" data-fr="{{ $program['description'] }}">
                            {{ $program['description'] }}
                        </p>
                        
                        <div class="program-details">
                            <div class="detail-item mb-2">
                                <i class="fas fa-clock text-info me-2"></i>
                                <strong data-en="Processing Time:" data-fr="Temps de traitement :">Processing Time:</strong>
                                <span data-en="{{ $program['processing_time'] }}" data-fr="{{ $program['processing_time'] }}">{{ $program['processing_time'] }}</span>
                            </div>
                            
                            <div class="detail-item mb-2">
                                <i class="fas fa-list text-success me-2"></i>
                                <strong data-en="Requirements:" data-fr="Exigences :">Requirements:</strong>
                                <a href="#" class="text-decoration-none" onclick="showRequirements({{ $index }})">
                                    <span data-en="View Details" data-fr="Voir les détails">View Details</span>
                                </a>
                            </div>
                            
                            <div class="detail-item mb-3">
                                <i class="fas fa-info-circle text-warning me-2"></i>
                                <strong data-en="Status:" data-fr="Statut :">Status:</strong>
                                <span class="badge bg-success" data-en="Active" data-fr="Actif">Active</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light border-0">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-primary btn-sm" onclick="learnMore({{ $index }})">
                                <i class="fas fa-book-open me-1"></i>
                                <span data-en="Learn More" data-fr="En savoir plus">Learn More</span>
                            </button>
                            <button class="btn btn-primary btn-sm" onclick="startApplication({{ $index }})">
                                <i class="fas fa-file-alt me-1"></i>
                                <span data-en="Start Application" data-fr="Commencer la demande">Start Application</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Quick Links Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0" data-en="Helpful Resources" data-fr="Ressources utiles">Helpful Resources</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="resource-link" onclick="openResource('eligibility-tool')">
                                <i class="fas fa-calculator text-primary me-2"></i>
                                <span data-en="Eligibility Calculator" data-fr="Calculateur d'admissibilité">Eligibility Calculator</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="resource-link" onclick="openResource('processing-times')">
                                <i class="fas fa-clock text-info me-2"></i>
                                <span data-en="Processing Times" data-fr="Temps de traitement">Processing Times</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="resource-link" onclick="openResource('forms-documents')">
                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                <span data-en="Forms & Documents" data-fr="Formulaires et documents">Forms & Documents</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="resource-link" onclick="openResource('contact-support')">
                                <i class="fas fa-headset text-success me-2"></i>
                                <span data-en="Contact Support" data-fr="Contacter le support">Contact Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Program Details Modal -->
<div class="modal fade" id="programModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="programModalTitle">Program Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="programDetails"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Close" data-fr="Fermer">Close</button>
                <button type="button" class="btn btn-primary" id="modalStartApplication" data-en="Start Application" data-fr="Commencer la demande">Start Application</button>
            </div>
        </div>
    </div>
</div>

<style>
.program-card {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.program-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    border-left-color: var(--bs-primary);
}

.program-title {
    color: #333;
    font-weight: 600;
}

.program-icon {
    opacity: 0.8;
}

.detail-item {
    font-size: 0.9rem;
}

.resource-link {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.resource-link:hover {
    background-color: #f8f9fa;
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.stat-icon {
    opacity: 0.8;
}
</style>

<script>
const programsData = @json($programs);

function showRequirements(programIndex) {
    const program = programsData[programIndex];
    document.getElementById('programModalTitle').textContent = program.name + ' - Requirements';
    
    const requirements = `
        <h6>Basic Requirements:</h6>
        <ul>
            <li>Valid passport</li>
            <li>Language proficiency (English/French)</li>
            <li>Educational credentials assessment</li>
            <li>Medical examination</li>
            <li>Police clearance certificate</li>
            <li>Proof of funds</li>
        </ul>
        <h6>Specific Requirements:</h6>
        <p>Requirements vary based on the specific program. Please consult the official immigration website for detailed information.</p>
    `;
    
    document.getElementById('programDetails').innerHTML = requirements;
    
    const modal = new bootstrap.Modal(document.getElementById('programModal'));
    modal.show();
}

function learnMore(programIndex) {
    const program = programsData[programIndex];
    document.getElementById('programModalTitle').textContent = program.name + ' - Overview';
    
    const details = `
        <h6>Program Overview:</h6>
        <p>${program.description}</p>
        
        <h6>Processing Time:</h6>
        <p>${program.processing_time}</p>
        
        <h6>Category:</h6>
        <p>${program.category}</p>
        
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            For the most up-to-date information and detailed requirements, please visit the official Government of Canada immigration website.
        </div>
    `;
    
    document.getElementById('programDetails').innerHTML = details;
    
    const modal = new bootstrap.Modal(document.getElementById('programModal'));
    modal.show();
}

function startApplication(programIndex) {
    const program = programsData[programIndex];
    
    const confirmMessage = `Are you ready to start the application process for ${program.name}? This will redirect you to the official government website.`;
    
    if (confirm(confirmMessage)) {
        // In a real application, this would redirect to the official application portal
        window.open('https://www.canada.ca/en/immigration-refugees-citizenship.html', '_blank');
    }
}

function refreshPrograms() {
    location.reload();
}

function openResource(resourceType) {
    const resources = {
        'eligibility-tool': 'https://www.canada.ca/en/immigration-refugees-citizenship/services/come-canada-tool.html',
        'processing-times': 'https://www.canada.ca/en/immigration-refugees-citizenship/services/application/check-processing-times.html',
        'forms-documents': 'https://www.canada.ca/en/immigration-refugees-citizenship/services/application/application-forms-guides.html',
        'contact-support': '{{ route("user.support") }}'
    };
    
    if (resources[resourceType]) {
        if (resourceType === 'contact-support') {
            window.location.href = resources[resourceType];
        } else {
            window.open(resources[resourceType], '_blank');
        }
    }
}

// Filter functionality
document.getElementById('categoryFilter').addEventListener('change', function() {
    filterPrograms();
});

document.getElementById('timeFilter').addEventListener('change', function() {
    filterPrograms();
});

document.getElementById('searchPrograms').addEventListener('input', function() {
    filterPrograms();
});

function filterPrograms() {
    const categoryFilter = document.getElementById('categoryFilter').value;
    const timeFilter = document.getElementById('timeFilter').value;
    const searchTerm = document.getElementById('searchPrograms').value.toLowerCase();
    
    const programs = document.querySelectorAll('.program-item');
    
    programs.forEach(program => {
        const category = program.getAttribute('data-category');
        const processingTime = program.getAttribute('data-processing-time');
        const title = program.querySelector('.program-title').textContent.toLowerCase();
        const description = program.querySelector('.program-description').textContent.toLowerCase();
        
        let showProgram = true;
        
        // Category filter
        if (categoryFilter && category !== categoryFilter) {
            showProgram = false;
        }
        
        // Time filter
        if (timeFilter) {
            const isInTimeRange = checkTimeRange(processingTime, timeFilter);
            if (!isInTimeRange) {
                showProgram = false;
            }
        }
        
        // Search filter
        if (searchTerm && !title.includes(searchTerm) && !description.includes(searchTerm)) {
            showProgram = false;
        }
        
        program.style.display = showProgram ? '' : 'none';
    });
}

function checkTimeRange(processingTime, timeFilter) {
    const timeText = processingTime.toLowerCase();
    
    switch (timeFilter) {
        case 'fast':
            return timeText.includes('month') && !timeText.includes('12') && !timeText.includes('18') && !timeText.includes('24');
        case 'medium':
            return timeText.includes('8') || timeText.includes('12') || (timeText.includes('month') && !timeText.includes('24'));
        case 'slow':
            return timeText.includes('12') || timeText.includes('18') || timeText.includes('24') || timeText.includes('year');
        default:
            return true;
    }
}
</script>
@endsection
