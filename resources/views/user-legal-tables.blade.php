@extends('layouts.user-layout')

@php
// Helper mappings for converting IDs to names
$jurisdictions = [
    1 => 'Federal',
    2 => 'Alberta',
    3 => 'British Columbia',
    4 => 'Manitoba',
    5 => 'New Brunswick',
    6 => 'Newfoundland & Labrador',
    7 => 'Nova Scotia',
    8 => 'Ontario',
    9 => 'Prince Edward Island',
    10 => 'Quebec',
    11 => 'Saskatchewan',
    12 => 'Northwest Territories',
    13 => 'Nunavut',
    14 => 'Yukon'
];

$lawSubjects = [
    1 => 'Immigration',
    2 => 'Citizenship',
    3 => 'Criminal'
];

$acts = [
    1 => 'Acts',
    2 => 'Appeal & Review Processes',
    3 => 'CaseLaw',
    4 => 'Codes',
    5 => 'Enforcement',
    6 => 'Forms',
    7 => 'Guidelines',
    8 => 'Agreements',
    9 => 'Ministerial Instructions',
    10 => 'Operational Bulletins',
    11 => 'Policies',
    12 => 'Procedures',
    13 => 'Regulations'
];

$languages = [
    1 => 'English',
    2 => 'French',
    3 => 'Bilingual'
];
@endphp

@section('content')
<div class="container">
    <div class="row gap_top">
        <div class="gap_top col-12 mb-4 p-0">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center mb-3">
                    <div class="user-avatar me-4 d-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width: 60px; height: 60px; font-size: 24px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info flex-grow-1">
                        <h4 class="mb-2" data-en="Personal Legal Documents" data-fr="Documents juridiques personnels">Personal Legal Documents</h4>
                        <p class="mb-0 text-muted" data-en="Select a legal document to view and annotate for your personal use." data-fr="Sélectionnez un document juridique à consulter et annoter pour votre usage personnel.">Select a legal document to view and annotate for your personal use.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="col-12 mb-4">
            <div class="bg_custom p-4 rounded shadow-sm">
                <h5 class="mb-3" data-en="Search & Filter Documents" data-fr="Rechercher et filtrer les documents">Search & Filter Documents</h5>
                
                <!-- Search Bar -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" id="documentSearch" placeholder="Search documents..." data-en-placeholder="Search documents..." data-fr-placeholder="Rechercher des documents...">
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <select class="form-select" id="jurisdictionFilter">
                            <option value="" data-en="All Jurisdictions" data-fr="Toutes les juridictions">All Jurisdictions</option>
                            @foreach($jurisdictions as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <select class="form-select" id="lawSubjectFilter">
                            <option value="" data-en="All Law Subjects" data-fr="Tous les sujets de droit">All Law Subjects</option>
                            @foreach($lawSubjects as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <select class="form-select" id="actFilter">
                            <option value="" data-en="All Document Types" data-fr="Tous les types de documents">All Document Types</option>
                            @foreach($acts as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Documents Grid -->
        <div class="col-12">
            <div class="row" id="documentsContainer">
                @if(isset($legalTables) && $legalTables->count() > 0)
                    @foreach($legalTables as $table)
                        <div class="col-md-6 col-lg-4 mb-4 document-card" 
                             data-jurisdiction="{{ $table->jurisdiction_id }}" 
                             data-law-subject="{{ $table->law_subject_id }}" 
                             data-act="{{ $table->act_id }}"
                             data-title="{{ strtolower($table->title) }}">
                            <div class="card h-100 shadow-sm border-0 document-item">
                                <div class="card-body d-flex flex-column">
                                    <!-- Document Type Badge -->
                                    <div class="mb-2">
                                        <span class="badge bg-primary">{{ $acts[$table->act_id] ?? 'Unknown' }}</span>
                                        @if($table->language_id)
                                            <span class="badge bg-secondary">{{ $languages[$table->language_id] ?? 'Unknown' }}</span>
                                        @endif
                                    </div>
                                    
                                    <!-- Document Title -->
                                    <h6 class="card-title">{{ $table->title }}</h6>
                                    
                                    <!-- Document Details -->
                                    <div class="text-muted small mb-3 flex-grow-1">
                                        <div><strong>Jurisdiction:</strong> {{ $jurisdictions[$table->jurisdiction_id] ?? 'Unknown' }}</div>
                                        <div><strong>Subject:</strong> {{ $lawSubjects[$table->law_subject_id] ?? 'Unknown' }}</div>
                                        @if($table->description)
                                            <div class="mt-2">{{ Str::limit($table->description, 100) }}</div>
                                        @endif
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="mt-auto">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <a href="{{ route('user.legal-table.show', ['table_name' => $table->table_name]) }}?category_id={{ $table->id }}" 
                                                   class="btn btn-primary btn-sm w-100">
                                                    <i class="fas fa-eye me-1"></i>
                                                    <span data-en="View" data-fr="Voir">View</span>
                                                </a>
                                            </div>
                                            @if($table->language_id == 2 || $table->language_id == 3)
                                            <div class="col-6">
                                                <a href="{{ route('user.legal-table.show.french', ['table_name' => $table->table_name]) }}?category_id={{ $table->id }}" 
                                                   class="btn btn-outline-secondary btn-sm w-100">
                                                    <i class="fas fa-language me-1"></i>
                                                    <span data-en="French" data-fr="Français">French</span>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i>
                            <span data-en="No legal documents found." data-fr="Aucun document juridique trouvé.">No legal documents found.</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
    3 => 'CaseLaw',
    4 => 'Codes',
    5 => 'Enforcement',
    6 => 'Forms',
    7 => 'Guidelines',
    8 => 'Agreements',
    9 => 'Ministerial Instructions',
    10 => 'Operational Bulletins',
    11 => 'Policies',
    12 => 'Procedures',
    13 => 'Regulations'
];

$languages = [
    1 => 'English',
    2 => 'French',
    3 => 'Bilingual'
];
@endphp

@section('content')
<div class="container">
    <!-- Session Info Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="session-avatar me-3 d-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="session-info">
                            <h4 class="mb-1" data-en="Legal Document Browser" data-fr="Navigateur de documents juridiques">Legal Document Browser</h4>
                            <small class="text-muted" data-en="Search and browse legal documents in your personal research session" data-fr="Recherchez et parcourez les documents juridiques dans votre session de recherche personnelle">
                                Search and browse legal documents in your personal research session
                            </small>
                        </div>
                    </div>
                    <div class="session-actions">
                        <a href="{{ route('user.home') }}" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-home me-1"></i>
                            <span data-en="Home" data-fr="Accueil">Home</span>
                        </a>
                        <a href="{{ route('user.notes') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-sticky-note me-1"></i>
                            <span data-en="My Notes" data-fr="Mes notes">My Notes</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Form -->
    <div class="row mb-4">
        <div class="col-12">
            <form method="GET" action="{{ route('user.legal-tables') }}" id="filterForm" class="bg_custom p-4 rounded shadow-sm">
                <div class="row g-3 align-items-center">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search by Legal Act, Regulation, or Keyword.." 
                                   data-placeholder-en="Search by Legal Act, Regulation, or Keyword.."
                                   data-placeholder-fr="Rechercher par acte juridique, réglementation ou mot-clé.."
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <select name="law_id" class="form-select">
                            <option value="" data-en="Select Law Subject" data-fr="Sélectionner le sujet de droit">Select Law Subject</option>
                            <option value="1" {{ request('law_id') == '1' ? 'selected' : '' }} data-en="Immigration" data-fr="Immigration">Immigration</option>
                            <option value="2" {{ request('law_id') == '2' ? 'selected' : '' }} data-en="Citizenship" data-fr="Citoyenneté">Citizenship</option>
                            <option value="3" {{ request('law_id') == '3' ? 'selected' : '' }} data-en="Criminal" data-fr="Criminel">Criminal</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select name="jurisdiction_id" class="form-select">
                            <option value="" data-en="Select Jurisdiction" data-fr="Sélectionner la juridiction">Select Jurisdiction</option>
                            <option value="1" {{ request('jurisdiction_id') == '1' ? 'selected' : '' }} data-en="Federal" data-fr="Fédéral">Federal</option>
                            <optgroup label="Provincial" data-label-en="Provincial" data-label-fr="Provincial">
                                <option value="2" {{ request('jurisdiction_id') == '2' ? 'selected' : '' }}>Alberta</option>
                                <option value="3" {{ request('jurisdiction_id') == '3' ? 'selected' : '' }}>British Columbia</option>
                                <option value="4" {{ request('jurisdiction_id') == '4' ? 'selected' : '' }}>Manitoba</option>
                                <option value="5" {{ request('jurisdiction_id') == '5' ? 'selected' : '' }}>New Brunswick</option>
                                <option value="6" {{ request('jurisdiction_id') == '6' ? 'selected' : '' }}>Newfoundland & Labrador</option>
                                <option value="7" {{ request('jurisdiction_id') == '7' ? 'selected' : '' }}>Nova Scotia</option>
                                <option value="8" {{ request('jurisdiction_id') == '8' ? 'selected' : '' }}>Ontario</option>
                                <option value="9" {{ request('jurisdiction_id') == '9' ? 'selected' : '' }}>Prince Edward Island</option>
                                <option value="10" {{ request('jurisdiction_id') == '10' ? 'selected' : '' }}>Quebec</option>
                                <option value="11" {{ request('jurisdiction_id') == '11' ? 'selected' : '' }}>Saskatchewan</option>
                            </optgroup>
                            <optgroup label="Territorial" data-label-en="Territorial" data-label-fr="Territorial">
                                <option value="12" {{ request('jurisdiction_id') == '12' ? 'selected' : '' }}>Northwest Territories</option>
                                <option value="13" {{ request('jurisdiction_id') == '13' ? 'selected' : '' }}>Nunavut</option>
                                <option value="14" {{ request('jurisdiction_id') == '14' ? 'selected' : '' }}>Yukon</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <select name="act_id" class="form-select">
                            <option value="" data-en="Select Docs Category" data-fr="Sélectionner la catégorie">Select Docs Category</option>
                            <option value="1" {{ request('act_id') == '1' ? 'selected' : '' }} data-en="Acts" data-fr="Actes">Acts</option>
                            <option value="2" {{ request('act_id') == '2' ? 'selected' : '' }} data-en="Appeal & Review Processes" data-fr="Processus d'appel et de révision">Appeal & Review Processes</option>
                            <option value="3" {{ request('act_id') == '3' ? 'selected' : '' }} data-en="CaseLaw" data-fr="Jurisprudence">CaseLaw</option>
                            <option value="4" {{ request('act_id') == '4' ? 'selected' : '' }} data-en="Codes" data-fr="Codes">Codes</option>
                            <option value="5" {{ request('act_id') == '5' ? 'selected' : '' }} data-en="Enforcement" data-fr="Application">Enforcement</option>
                            <option value="6" {{ request('act_id') == '6' ? 'selected' : '' }} data-en="Forms" data-fr="Formulaires">Forms</option>
                            <option value="7" {{ request('act_id') == '7' ? 'selected' : '' }} data-en="Guidelines" data-fr="Directives">Guidelines</option>
                            <option value="8" {{ request('act_id') == '8' ? 'selected' : '' }} data-en="Agreements" data-fr="Accords">Agreements</option>
                            <option value="9" {{ request('act_id') == '9' ? 'selected' : '' }} data-en="Ministerial Instructions" data-fr="Instructions ministérielles">Ministerial Instructions</option>
                            <option value="10" {{ request('act_id') == '10' ? 'selected' : '' }} data-en="Operational Bulletins" data-fr="Bulletins opérationnels">Operational Bulletins</option>
                            <option value="11" {{ request('act_id') == '11' ? 'selected' : '' }} data-en="Policies" data-fr="Politiques">Policies</option>
                            <option value="12" {{ request('act_id') == '12' ? 'selected' : '' }} data-en="Procedures" data-fr="Procédures">Procedures</option>
                            <option value="13" {{ request('act_id') == '13' ? 'selected' : '' }} data-en="Regulations" data-fr="Règlements">Regulations</option>
                        </select>
                    </div>
                    <div class="col-lg-12 d-flex submit_reset_format justify-content-end">
                        <div class="button-group">
                            <button type="submit" class="btn btn-custom me-2">
                                <i class="fas fa-search"></i> <span data-en="Search" data-fr="Rechercher">Search</span>
                            </button>
                            <button type="button" class="btn btn-reset" onclick="window.location.href='{{ route('user.legal-tables') }}'">
                                <i class="fas fa-undo"></i> <span data-en="Reset" data-fr="Réinitialiser">Reset</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Header -->
    <div class="row mb-3">
        <div class="col-12">
            <h3 data-en="Legal Documents" data-fr="Documents juridiques">Legal Documents</h3>
            @if(request()->hasAny(['search', 'law_id', 'jurisdiction_id', 'act_id', 'language_id']))
                <p class="text-muted">
                    <span data-en="Search Results" data-fr="Résultats de recherche">Search Results</span>
                    @if($legalTables->isNotEmpty())
                        - {{ $legalTables->count() }} 
                        <span data-en="document(s) found" data-fr="document(s) trouvé(s)">document(s) found</span>
                    @endif
                </p>
            @else
                <p class="text-muted" data-en="Use the search filters above to find legal documents" data-fr="Utilisez les filtres de recherche ci-dessus pour trouver des documents juridiques">
                    Use the search filters above to find legal documents
                </p>
            @endif
        </div>
    </div>

    <!-- Document Cards -->
    <div class="row">
        @if($legalTables->isEmpty())
            @if(request()->hasAny(['search', 'law_id', 'jurisdiction_id', 'act_id', 'language_id']))
                <div class="col-12">
                    <div class="alert alert-warning text-center mt-4">
                        <i class="fas fa-search mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                        <h5 data-en="No Documents Found" data-fr="Aucun document trouvé">No Documents Found</h5>
                        <p data-en="Try adjusting your search criteria or removing some filters." data-fr="Essayez d'ajuster vos critères de recherche ou de supprimer certains filtres.">
                            Try adjusting your search criteria or removing some filters.
                        </p>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-book" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                            <h4 data-en="Ready to Browse Legal Documents" data-fr="Prêt à parcourir les documents juridiques">Ready to Browse Legal Documents</h4>
                            <p class="text-muted" data-en="Use the search form above to find specific legal documents, acts, regulations, and more." data-fr="Utilisez le formulaire de recherche ci-dessus pour trouver des documents juridiques, des lois, des règlements et plus encore.">
                                Use the search form above to find specific legal documents, acts, regulations, and more.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @else
            @foreach($legalTables as $table)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="act-card btn-shadow h-100" onclick="redirectToUserDocument('{{ $table->table_name }}', '{{ $table->id }}', '{{ $table->language_id ?? $table->language ?? '' }}')">
                        <div class="act-card-inner">
                            <i class="fas fa-book act-icon"></i>
                            <div class="act-home-title">{{ $table->act_name }}</div>
                            <div class="act-category">
                                <span data-en="Category:" data-fr="Catégorie :">Category:</span> {{ $acts[$table->act_id] ?? $table->act_id }}
                            </div>
                            <div class="act-law">
                                <span data-en="Law Subject:" data-fr="Sujet de droit :">Law Subject:</span> {{ $lawSubjects[$table->law_id] ?? $table->law_id }}
                            </div>
                            <div class="act-jurisdiction">
                                <span data-en="Jurisdiction:" data-fr="Juridiction :">Jurisdiction:</span> {{ $jurisdictions[$table->jurisdiction_id] ?? $table->jurisdiction_id }}
                            </div>
                            @if(isset($table->language_id) || isset($table->language))
                            <div class="act-language" style="color: #007bff;">
                                <span data-en="Language:" data-fr="Langue :">Language:</span>
                                @php
                                    $languageDisplay = '';
                                    $languageId = $table->language_id ?? null;
                                    $language = $table->language ?? null;
                                    
                                    if ($languageId) {
                                        $languageDisplay = $languages[$languageId] ?? $languageId;
                                    } elseif ($language == 'en') {
                                        $languageDisplay = 'English';
                                    } elseif ($language == 'fr') {
                                        $languageDisplay = 'French';
                                    } elseif ($language == 'Both') {
                                        $languageDisplay = 'Bilingual';
                                    } else {
                                        $languageDisplay = $language ?? 'N/A';
                                    }
                                @endphp
                                {{ $languageDisplay }}
                            </div>
                            @endif
                            <div class="act-description">
                                <span data-en="Created:" data-fr="Créé :">Created:</span> {{ $table->created_at }}
                            </div>
                            <div class="view-button">
                                <span data-en="View Document" data-fr="Voir le document">View Document</span> <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<style>
.act-card {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #e3e6f0;
    cursor: pointer;
    transition: all 0.3s ease;
    overflow: hidden;
}

.act-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    border-color: var(--bs-primary);
}

.act-card-inner {
    padding: 1.5rem;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.act-icon {
    font-size: 3rem;
    color: var(--bs-primary);
    margin-bottom: 1rem;
    opacity: 0.8;
}

.act-home-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 1rem;
    line-height: 1.3;
    flex-grow: 1;
}

.act-category, .act-law, .act-jurisdiction, .act-language, .act-description {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
    text-align: left;
}

.view-button {
    margin-top: auto;
    padding-top: 1rem;
    color: var(--bs-primary);
    font-weight: 600;
    font-size: 0.9rem;
    border-top: 1px solid #f0f0f0;
}

.empty-state {
    padding: 3rem 1rem;
}
</style>
@endsection

@push('scripts')
<script>
    // Function to redirect to appropriate user document view based on language
    function redirectToUserDocument(tableName, categoryId, language) {
        // Check if it's a French document
        const isFrench = (language === '2' || language === 'fr' || language === 'French');
        
        if (isFrench) {
            // Redirect to French user view
            window.location = `/view-user-legal-table-french/${tableName}?category_id=${categoryId}`;
        } else {
            // Redirect to normal user view
            window.location = `/view-user-legal-table/${tableName}?category_id=${categoryId}`;
        }
    }
</script>
@endsection
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form method="GET" action="{{ route('user.client.legal-tables', $client->id) }}" id="filterForm" class="gap_top btn-shadow bg_custom p-4 rounded shadow-sm">
            <div class="row g-3 align-items-center">
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search by Legal Act, Regulation, or Keyword.." 
                               data-placeholder-en="Search by Legal Act, Regulation, or Keyword.."
                               data-placeholder-fr="Rechercher par Loi juridique, Règlement ou Mot-clé.."
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <select name="law_id" class="form-select">
                        <option value="" data-en="Select Law Subject" data-fr="Sélectionner le sujet de droit">Select Law Subject</option>
                        <option value="1" {{ request('law_id') == '1' ? 'selected' : '' }} data-en="Immigration" data-fr="Immigration">Immigration</option>
                        <option value="2" {{ request('law_id') == '2' ? 'selected' : '' }} data-en="Citizenship" data-fr="Citoyenneté">Citizenship</option>
                        <option value="3" {{ request('law_id') == '3' ? 'selected' : '' }} data-en="Criminal" data-fr="Criminel">Criminal</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="jurisdiction_id" class="form-select">
                        <option value="" data-en="Select Jurisdiction" data-fr="Sélectionner la juridiction">Select Jurisdiction</option>
                        <option value="1" {{ request('jurisdiction_id') == '1' ? 'selected' : '' }} data-en="Federal" data-fr="Fédéral">Federal</option>
                        <optgroup label="Provincial" data-label-en="Provincial" data-label-fr="Provincial">
                            <option value="2" {{ request('jurisdiction_id') == '2' ? 'selected' : '' }}>Alberta</option>
                            <option value="3" {{ request('jurisdiction_id') == '3' ? 'selected' : '' }} data-en="British Columbia" data-fr="Colombie-Britannique">British Columbia</option>
                            <option value="4" {{ request('jurisdiction_id') == '4' ? 'selected' : '' }}>Manitoba</option>
                            <option value="5" {{ request('jurisdiction_id') == '5' ? 'selected' : '' }} data-en="New Brunswick" data-fr="Nouveau-Brunswick">New Brunswick</option>
                            <option value="6" {{ request('jurisdiction_id') == '6' ? 'selected' : '' }} data-en="Newfoundland & Labarador" data-fr="Terre-Neuve-et-Labrador">Newfoundland & Labarador</option>
                            <option value="7" {{ request('jurisdiction_id') == '7' ? 'selected' : '' }} data-en="Nova Scotia" data-fr="Nouvelle-Écosse">Nova Scotia</option>
                            <option value="8" {{ request('jurisdiction_id') == '8' ? 'selected' : '' }}>Ontario</option>
                            <option value="9" {{ request('jurisdiction_id') == '9' ? 'selected' : '' }} data-en="Price Edward Island" data-fr="Île-du-Prince-Édouard">Price Edward Island</option>
                            <option value="10" {{ request('jurisdiction_id') == '10' ? 'selected' : '' }} data-en="Quebec" data-fr="Québec">Quebec</option>
                            <option value="11" {{ request('jurisdiction_id') == '11' ? 'selected' : '' }}>Saskatchewan</option>
                        </optgroup>
                        <optgroup label="Territorial" data-label-en="Territorial" data-label-fr="Territorial">
                            <option value="12" {{ request('jurisdiction_id') == '12' ? 'selected' : '' }} data-en="Nortwest Territories" data-fr="Territoires du Nord-Ouest">Nortwest Territories</option>
                            <option value="13" {{ request('jurisdiction_id') == '13' ? 'selected' : '' }}>Nunavut</option>
                            <option value="14" {{ request('jurisdiction_id') == '14' ? 'selected' : '' }}>Yukon</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="act_id" class="form-select">
                        <option value="" data-en="Select Docs Category" data-fr="Sélectionner la catégorie de documents">Select Docs Category</option>
                        <option value="1" {{ request('act_id') == '1' ? 'selected' : '' }} data-en="Acts" data-fr="Lois">Acts</option>
                        <option value="2" {{ request('act_id') == '2' ? 'selected' : '' }} data-en="Appeal & Review Processes" data-fr="Processus d'appel et de révision">Appeal & Review Processes</option>
                        <option value="3" {{ request('act_id') == '3' ? 'selected' : '' }} data-en="CaseLaw" data-fr="Jurisprudence">CaseLaw</option>
                        <option value="4" {{ request('act_id') == '4' ? 'selected' : '' }} data-en="Codes" data-fr="Codes">Codes</option>
                        <option value="5" {{ request('act_id') == '5' ? 'selected' : '' }} data-en="Enforcement" data-fr="Application">Enforcement</option>
                        <option value="6" {{ request('act_id') == '6' ? 'selected' : '' }} data-en="Forms" data-fr="Formulaires">Forms</option>
                        <option value="7" {{ request('act_id') == '7' ? 'selected' : '' }} data-en="Guidelines" data-fr="Directives">Guidelines</option>
                        <option value="8" {{ request('act_id') == '8' ? 'selected' : '' }} data-en="Agreements" data-fr="Accords">Agreements</option>
                        <option value="9" {{ request('act_id') == '9' ? 'selected' : '' }} data-en="Ministerial Instructions" data-fr="Instructions ministérielles">Ministerial Instructions</option>
                        <option value="10" {{ request('act_id') == '10' ? 'selected' : '' }} data-en="Operational Bulletins" data-fr="Bulletins opérationnels">Operational Bulletins</option>
                        <option value="11" {{ request('act_id') == '11' ? 'selected' : '' }} data-en="Policies" data-fr="Politiques">Policies</option>
                        <option value="12" {{ request('act_id') == '12' ? 'selected' : '' }} data-en="Procedures" data-fr="Procédures">Procedures</option>
                        <option value="13" {{ request('act_id') == '13' ? 'selected' : '' }} data-en="Regulations" data-fr="Règlements">Regulations</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="language_id" class="form-select">
                        <option value="" data-en="Select Language" data-fr="Sélectionner la langue">Select Language</option>
                        <option value="1" {{ request('language_id') == '1' ? 'selected' : '' }} data-en="English" data-fr="Anglais">English</option>
                        <option value="2" {{ request('language_id') == '2' ? 'selected' : '' }} data-en="French" data-fr="Français">French</option>
                        <option value="3" {{ request('language_id') == '3' ? 'selected' : '' }} data-en="Bilingual" data-fr="Bilingue">Bilingual</option>
                    </select>
                </div>
                <div class="col-lg-12 d-flex submit_reset_format justify-content-end">
                    <div class="button-group">
                        <button type="submit" class="btn btn-custom me-2">
                            <i class="fas fa-search"></i> <span data-en="Search" data-fr="Rechercher">Search</span>
                        </button>
                        <a href="{{ route('user.client.legal-tables', $client->id) }}" class="btn btn-reset">
                            <i class="fas fa-undo"></i> <span data-en="Reset" data-fr="Réinitialiser">Reset</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>    <div class="row">
        <div class="gap_top view-mode-selector col-lg-12 d-flex justify-content-end">
            <button class="btn btn-shadow btn-custom2 btn-outline-primary view-mode-btn me-2 active-view" data-view-mode="grid">
                <i class="fas fa-th-large"></i> <span data-en="Grid View" data-fr="Vue en grille">Grid View</span>
            </button>
            <button class="btn btn-custom2 btn-outline-primary view-mode-btn" data-view-mode="list">
                <i class="fas fa-list"></i> <span data-en="List View" data-fr="Vue en liste">List View</span>
            </button>
        </div>
        <div class="row gap_top custom-container act-content">
            <div class="act-content grid-view">
                @if($results->count())
                    @foreach($results as $row)                        <div class="col-lg-4 col-md-6 act-card btn-shadow" onclick="redirectToDocument('{{ $row->table_name }}', '{{ $row->id }}', '{{ $client->id }}', '{{ $row->language_id ?? $row->language ?? '' }}')">
                            <div class="act-card-inner">
                                <i class="fas fa-book act-icon"></i>                                <div class="act-home-title">{{ $row->act_name }}</div>
                                <div class="act-category"><span data-en="Category:" data-fr="Catégorie :">Category:</span> {{ $acts[$row->act_id] ?? $row->act_id }}</div>
                                <div class="act-law"><span data-en="Law Subject:" data-fr="Sujet de droit :">Law Subject:</span> {{ $lawSubjects[$row->law_id] ?? $row->law_id }}</div>
                                <div class="act-jurisdiction"><span data-en="Jurisdiction:" data-fr="Juridiction :">Jurisdiction:</span> {{ $jurisdictions[$row->jurisdiction_id] ?? $row->jurisdiction_id }}</div>
                                <div class="act-language" style="color: red;"><span data-en="Language:" data-fr="Langue :">Language:</span> 
                                    @php
                                        $languageDisplay = '';
                                        $languageId = $row->language_id ?? null;
                                        $language = $row->language ?? null;
                                        
                                        if ($languageId) {
                                            $languageDisplay = $languages[$languageId] ?? $languageId;
                                        } elseif ($language == 'en') {
                                            $languageDisplay = 'English';
                                        } elseif ($language == 'fr') {
                                            $languageDisplay = 'French';
                                        } elseif ($language == 'Both') {
                                            $languageDisplay = 'Bilingual';
                                        } else {
                                            $languageDisplay = $language ?? 'N/A';
                                        }
                                    @endphp
                                    {{ $languageDisplay }}
                                </div>
                                <div class="act-description"><span data-en="Created:" data-fr="Créé :">Created:</span> {{ $row->created_at }}</div>
                                <div class="view-button"><span data-en="View Document" data-fr="Voir le document">View Document</span> <i class="fas fa-arrow-right"></i></div>
                                
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 no-results">
                        <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                        <p data-en="No legal acts found matching your search criteria." data-fr="Aucune loi juridique trouvée correspondant à vos critères de recherche.">No legal acts found matching your search criteria.</p>
                    </div>
                @endif
            </div>
            <div class="act-content list-view" style="display: none;">
                @if($results->count())
                    @foreach($results as $row)                        <div class="col-lg-12 act-card btn-shadow" onclick="redirectToDocument('{{ $row->table_name }}', '{{ $row->id }}', '{{ $client->id }}', '{{ $row->language_id ?? $row->language ?? '' }}')">
                            <div class="act-card-inner">
                                <div class="act-home-title">{{ $row->act_name }}</div>
                                <div class="act-language" style="color: red;"><span data-en="Language:" data-fr="Langue :">Language:</span> 
                                    @php
                                        $languageDisplay = '';
                                        $languageId = $row->language_id ?? null;
                                        $language = $row->language ?? null;
                                        
                                        if ($languageId) {
                                            $languageDisplay = $languages[$languageId] ?? $languageId;
                                        } elseif ($language == 'en') {
                                            $languageDisplay = 'English';
                                        } elseif ($language == 'fr') {
                                            $languageDisplay = 'French';
                                        } elseif ($language == 'Both') {
                                            $languageDisplay = 'Bilingual';
                                        } else {
                                            $languageDisplay = $language ?? 'N/A';
                                        }
                                    @endphp
                                    {{ $languageDisplay }}
                                </div>
                                <div class="act-description"><span data-en="Created:" data-fr="Créé :">Created:</span> {{ $row->created_at }}</div>
                                <div class="view-button"><span data-en="View Document" data-fr="Voir le document">View Document</span> <i class="fas fa-arrow-right"></i></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12 no-results">
                        <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                        <p data-en="No legal acts found matching your search criteria." data-fr="Aucune loi juridique trouvée correspondant à vos critères de recherche.">No legal acts found matching your search criteria.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Function to redirect to appropriate document view based on language
    function redirectToDocument(tableName, categoryId, clientId, language) {
        // Check if it's a French document
        const isFrench = (language === '2' || language === 'fr' || language === 'French');
        
        if (isFrench) {
            // Redirect to French view
            window.location = `/view-legal-table-french/${tableName}?category_id=${categoryId}&client_id=${clientId}`;
        } else {
            // Redirect to normal view
            window.location = `/view-legal-table/${tableName}?category_id=${categoryId}&client_id=${clientId}`;
        }
    }

    // Toggle between grid and list view
    document.querySelectorAll('.view-mode-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-mode-btn').forEach(b => b.classList.remove('active-view'));
            btn.classList.add('active-view');
            if (btn.dataset.viewMode === 'grid') {
                document.querySelector('.grid-view').style.display = '';
                document.querySelector('.list-view').style.display = 'none';
            } else {
                document.querySelector('.grid-view').style.display = 'none';
                document.querySelector('.list-view').style.display = '';
            }
        });
    });

    // Translation functionality for legal tables page
    function translateLegalTablesPage(language) {
        // Translate all elements with data attributes
        const elements = document.querySelectorAll('[data-en][data-fr]');
        elements.forEach(element => {
            const translation = element.getAttribute('data-' + language);
            if (translation) {
                element.textContent = translation;
            }
        });

        // Translate placeholder texts
        const placeholderElements = document.querySelectorAll('[data-placeholder-en][data-placeholder-fr]');
        placeholderElements.forEach(element => {
            const placeholder = element.getAttribute('data-placeholder-' + language);
            if (placeholder) {
                element.placeholder = placeholder;
            }
        });

        // Translate select options
        const options = document.querySelectorAll('option[data-en][data-fr]');
        options.forEach(option => {
            const translation = option.getAttribute('data-' + language);
            if (translation) {
                option.textContent = translation;
            }
        });

        // Translate optgroup labels
        const optgroups = document.querySelectorAll('optgroup[data-label-en][data-label-fr]');
        optgroups.forEach(optgroup => {
            const label = optgroup.getAttribute('data-label-' + language);
            if (label) {
                optgroup.label = label;
            }
        });
    }

    // Listen for language change events from the main layout
    window.addEventListener('languageChanged', function(event) {
        const selectedLanguage = event.detail.language;
        translateLegalTablesPage(selectedLanguage);
    });

    // Apply saved language on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
        translateLegalTablesPage(savedLanguage);
        
        // Add form submit handler for debugging
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            // Log form values for debugging
            console.log('Form values being submitted:');
            const formData = new FormData(this);
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
        });
    });
</script>
@endpush
