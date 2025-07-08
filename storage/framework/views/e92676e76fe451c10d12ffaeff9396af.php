

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Session Info Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="session-avatar me-3 d-flex justify-content-center align-items-center rounded-circle bg-primary text-white" style="width: 50px; height: 50px; font-size: 20px;">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="session-info">
                            <h4 class="mb-1" data-en="Personal Session" data-fr="Session personnelle">Personal Session</h4>
                            <small class="text-muted" data-en="All notes and annotations are saved to your personal account" data-fr="Toutes les notes et annotations sont sauvegardées dans votre compte personnel">
                                All notes and annotations are saved to your personal account
                            </small>
                        </div>
                    </div>
                    <div class="session-actions">
                        <a href="<?php echo e(route('user.home')); ?>" class="btn btn-outline-primary btn-sm me-2">
                            <i class="fas fa-home me-1"></i>
                            <span data-en="Home" data-fr="Accueil">Home</span>
                        </a>
                        <a href="<?php echo e(route('session.mode.selection')); ?>" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-exchange-alt me-1"></i>
                            <span data-en="Switch Mode" data-fr="Changer de mode">Switch Mode</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search/Filter Form -->
    <div class="row">
        <form method="GET" action="<?php echo e(route('user.legal-tables')); ?>" id="filterForm" class="gap_top btn-shadow bg_custom p-4 rounded shadow-sm">
            <div class="row g-3 align-items-center">
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Search by Legal Act, Regulation, or Keyword.." 
                               data-placeholder-en="Search by Legal Act, Regulation, or Keyword.."
                               data-placeholder-fr="Rechercher par Loi juridique, Règlement ou Mot-clé.."
                               value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <select name="law_id" class="form-select">
                        <option value="" data-en="Select Law Subject" data-fr="Sélectionner le sujet de droit">Select Law Subject</option>
                        <option value="1" <?php echo e(request('law_id') == '1' ? 'selected' : ''); ?> data-en="Immigration" data-fr="Immigration">Immigration</option>
                        <option value="2" <?php echo e(request('law_id') == '2' ? 'selected' : ''); ?> data-en="Citizenship" data-fr="Citoyenneté">Citizenship</option>
                        <option value="3" <?php echo e(request('law_id') == '3' ? 'selected' : ''); ?> data-en="Criminal" data-fr="Criminel">Criminal</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="jurisdiction_id" class="form-select">
                        <option value="" data-en="Select Jurisdiction" data-fr="Sélectionner la juridiction">Select Jurisdiction</option>
                        <option value="1" <?php echo e(request('jurisdiction_id') == '1' ? 'selected' : ''); ?> data-en="Federal" data-fr="Fédéral">Federal</option>
                        <optgroup label="Provincial" data-label-en="Provincial" data-label-fr="Provincial">
                            <option value="2" <?php echo e(request('jurisdiction_id') == '2' ? 'selected' : ''); ?>>Alberta</option>
                            <option value="3" <?php echo e(request('jurisdiction_id') == '3' ? 'selected' : ''); ?> data-en="British Columbia" data-fr="Colombie-Britannique">British Columbia</option>
                            <option value="4" <?php echo e(request('jurisdiction_id') == '4' ? 'selected' : ''); ?>>Manitoba</option>
                            <option value="5" <?php echo e(request('jurisdiction_id') == '5' ? 'selected' : ''); ?> data-en="New Brunswick" data-fr="Nouveau-Brunswick">New Brunswick</option>
                            <option value="6" <?php echo e(request('jurisdiction_id') == '6' ? 'selected' : ''); ?> data-en="Newfoundland & Labarador" data-fr="Terre-Neuve-et-Labrador">Newfoundland & Labarador</option>
                            <option value="7" <?php echo e(request('jurisdiction_id') == '7' ? 'selected' : ''); ?> data-en="Nova Scotia" data-fr="Nouvelle-Écosse">Nova Scotia</option>
                            <option value="8" <?php echo e(request('jurisdiction_id') == '8' ? 'selected' : ''); ?>>Ontario</option>
                            <option value="9" <?php echo e(request('jurisdiction_id') == '9' ? 'selected' : ''); ?> data-en="Price Edward Island" data-fr="Île-du-Prince-Édouard">Price Edward Island</option>
                            <option value="10" <?php echo e(request('jurisdiction_id') == '10' ? 'selected' : ''); ?> data-en="Quebec" data-fr="Québec">Quebec</option>
                            <option value="11" <?php echo e(request('jurisdiction_id') == '11' ? 'selected' : ''); ?>>Saskatchewan</option>
                        </optgroup>
                        <optgroup label="Territorial" data-label-en="Territorial" data-label-fr="Territorial">
                            <option value="12" <?php echo e(request('jurisdiction_id') == '12' ? 'selected' : ''); ?> data-en="Nortwest Territories" data-fr="Territoires du Nord-Ouest">Nortwest Territories</option>
                            <option value="13" <?php echo e(request('jurisdiction_id') == '13' ? 'selected' : ''); ?>>Nunavut</option>
                            <option value="14" <?php echo e(request('jurisdiction_id') == '14' ? 'selected' : ''); ?>>Yukon</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="act_id" class="form-select">
                        <option value="" data-en="Select Docs Category" data-fr="Sélectionner la catégorie de documents">Select Docs Category</option>
                        <option value="1" <?php echo e(request('act_id') == '1' ? 'selected' : ''); ?> data-en="Acts" data-fr="Lois">Acts</option>
                        <option value="2" <?php echo e(request('act_id') == '2' ? 'selected' : ''); ?> data-en="Appeal & Review Processes" data-fr="Processus d'appel et de révision">Appeal & Review Processes</option>
                        <option value="3" <?php echo e(request('act_id') == '3' ? 'selected' : ''); ?> data-en="CaseLaw" data-fr="Jurisprudence">CaseLaw</option>
                        <option value="4" <?php echo e(request('act_id') == '4' ? 'selected' : ''); ?> data-en="Codes" data-fr="Codes">Codes</option>
                        <option value="5" <?php echo e(request('act_id') == '5' ? 'selected' : ''); ?> data-en="Enforcement" data-fr="Application">Enforcement</option>
                        <option value="6" <?php echo e(request('act_id') == '6' ? 'selected' : ''); ?> data-en="Forms" data-fr="Formulaires">Forms</option>
                        <option value="7" <?php echo e(request('act_id') == '7' ? 'selected' : ''); ?> data-en="Guidelines" data-fr="Directives">Guidelines</option>
                        <option value="8" <?php echo e(request('act_id') == '8' ? 'selected' : ''); ?> data-en="Agreements" data-fr="Accords">Agreements</option>
                        <option value="9" <?php echo e(request('act_id') == '9' ? 'selected' : ''); ?> data-en="Ministerial Instructions" data-fr="Instructions ministérielles">Ministerial Instructions</option>
                        <option value="10" <?php echo e(request('act_id') == '10' ? 'selected' : ''); ?> data-en="Operational Bulletins" data-fr="Bulletins opérationnels">Operational Bulletins</option>
                        <option value="11" <?php echo e(request('act_id') == '11' ? 'selected' : ''); ?> data-en="Policies" data-fr="Politiques">Policies</option>
                        <option value="12" <?php echo e(request('act_id') == '12' ? 'selected' : ''); ?> data-en="Procedures" data-fr="Procédures">Procedures</option>
                        <option value="13" <?php echo e(request('act_id') == '13' ? 'selected' : ''); ?> data-en="Regulations" data-fr="Règlements">Regulations</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="language_id" class="form-select">
                        <option value="" data-en="Select Language" data-fr="Sélectionner la langue">Select Language</option>
                        <option value="1" <?php echo e(request('language_id') == '1' ? 'selected' : ''); ?> data-en="English" data-fr="Anglais">English</option>
                        <option value="2" <?php echo e(request('language_id') == '2' ? 'selected' : ''); ?> data-en="French" data-fr="Français">French</option>
                        <option value="3" <?php echo e(request('language_id') == '3' ? 'selected' : ''); ?> data-en="Bilingual" data-fr="Bilingue">Bilingual</option>
                    </select>
                </div>
                <div class="col-lg-12 d-flex submit_reset_format justify-content-end">
                    <div class="button-group">
                        <button type="submit" class="btn btn-custom me-2">
                            <i class="fas fa-search"></i> <span data-en="Search" data-fr="Rechercher">Search</span>
                        </button>
                        <a href="<?php echo e(route('user.legal-tables')); ?>" class="btn btn-reset">
                            <i class="fas fa-undo"></i> <span data-en="Reset" data-fr="Réinitialiser">Reset</span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- View Mode Selector and Results -->
    <div class="row">
        <div class="main-content col-lg-8 col-md-7">
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
                    <?php if($results->count()): ?>
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-4 col-md-6 act-card btn-shadow" onclick="redirectToUserDocument('<?php echo e($row->table_name); ?>', '<?php echo e($row->id); ?>', '<?php echo e($row->language_id ?? $row->language ?? null); ?>')">
                                <div class="act-card-inner">
                                    <i class="fas fa-book act-icon"></i>
                                    <div class="act-home-title"><?php echo e($row->act_name); ?></div>
                                    <div class="act-category"><span data-en="Category:" data-fr="Catégorie :">Category:</span> <?php echo e($acts[$row->act_id] ?? $row->act_id); ?></div>
                                    <div class="act-law"><span data-en="Law Subject:" data-fr="Sujet de droit :">Law Subject:</span> <?php echo e($lawSubjects[$row->law_id] ?? $row->law_id); ?></div>
                                    <div class="act-jurisdiction"><span data-en="Jurisdiction:" data-fr="Juridiction :">Jurisdiction:</span> <?php echo e($jurisdictions[$row->jurisdiction_id] ?? $row->jurisdiction_id); ?></div>
                                    <div class="act-language" style="color: red;"><span data-en="Language:" data-fr="Langue :">Language:</span> 
                                        <?php
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
                                        ?>
                                        <?php echo e($languageDisplay); ?>

                                    </div>
                                    <div class="act-description"><span data-en="Created:" data-fr="Créé :">Created:</span> <?php echo e($row->created_at); ?></div>
                                    <div class="view-button"><span data-en="View Document" data-fr="Voir le document">View Document</span> <i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="col-12 no-results">
                            <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                            <p data-en="No legal acts found matching your search criteria." data-fr="Aucune loi juridique trouvée correspondant à vos critères de recherche.">No legal acts found matching your search criteria.</p>
                            <a href="<?php echo e(route('user.legal-tables')); ?>" class="btn btn-primary mt-2">
                                <i class="fas fa-refresh me-2"></i>
                                <span data-en="Show All Documents" data-fr="Afficher tous les documents">Show All Documents</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="act-content list-view" style="display: none;">
                    <?php if($results->count()): ?>
                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-12 act-card btn-shadow" onclick="redirectToUserDocument('<?php echo e($row->table_name); ?>', '<?php echo e($row->id); ?>', '<?php echo e($row->language_id ?? $row->language ?? null); ?>')">
                                <div class="act-card-inner">
                                    <div class="act-home-title"><?php echo e($row->act_name); ?></div>
                                    <div class="act-language" style="color: red;"><span data-en="Language:" data-fr="Langue :">Language:</span> 
                                        <?php
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
                                        ?>
                                        <?php echo e($languageDisplay); ?>

                                    </div>
                                    <div class="act-description"><span data-en="Created:" data-fr="Créé :">Created:</span> <?php echo e($row->created_at); ?></div>
                                    <div class="view-button"><span data-en="View Document" data-fr="Voir le document">View Document</span> <i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="col-12 no-results">
                            <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                            <p data-en="No legal acts found matching your search criteria." data-fr="Aucune loi juridique trouvée correspondant à vos critères de recherche.">No legal acts found matching your search criteria.</p>
                            <a href="<?php echo e(route('user.legal-tables')); ?>" class="btn btn-primary mt-2">
                                <i class="fas fa-refresh me-2"></i>
                                <span data-en="Show All Documents" data-fr="Afficher tous les documents">Show All Documents</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="col-lg-4 col-md-5 fixed-sidebar-container">
            <div class="sidebar-card card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0" data-en="Pinned Popups" data-fr="Popups épinglés">Pinned Popups</h5>
                </div>
                <div class="card-body">
                    <div class="nested-droppable" style="min-height: 200px;">
                        <!-- Pinned popups will appear here -->
                    </div>
                    <div class="sidebar-actions mt-3">
                        <button id="test-popup" class="btn btn-warning btn-sm mb-2">
                            <i class="fas fa-plus"></i> <span data-en="Test Popup" data-fr="Test Popup">Test Popup</span>
                        </button>
                        <br>
                        <button id="save-pinned-popups" class="btn btn-success btn-sm">
                            <i class="fas fa-save"></i> <span data-en="Save Popups" data-fr="Sauvegarder">Save Popups</span>
                        </button>
                        <button id="fetch-pinned-popups" class="btn btn-primary btn-sm">
                            <i class="fas fa-sync"></i> <span data-en="Load Popups" data-fr="Charger">Load Popups</span>
                        </button>
                        <button id="clear-pinned-popups" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> <span data-en="Clear All" data-fr="Effacer tout">Clear All</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.fixed-sidebar-container {
    position: sticky;
    top: 20px;
    height: fit-content;
}

.nested-droppable {
    border: 2px dashed #ccc;
    padding: 10px;
    border-radius: 5px;
    background-color: #f8f9fa;
}

.nested-droppable.ui-droppable-hover,
.nested-droppable.highlight-droppable {
    border-color: #28a745;
    background-color: rgba(40, 167, 69, 0.1);
}

/* Floating popup styles - exact match to client-centric */
.floating-popup {
    position: fixed;
    z-index: 2000;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.2);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    border-radius: 6px;
    min-width: 300px;
    max-width: 500px;
    min-height: 100px;
}

.floating-popup .popup-header, .pinned-popup .popup-header {
    padding: 8px 12px;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    cursor: move;
    background-color: var(--primary-color);
    color: #fff;
}

.floating-popup .popup-content, .pinned-popup .popup-content {
    padding: 15px;
    max-height: 400px;
    overflow-y: auto;
    background-color: #fff;
}

.floating-popup .section-path, .pinned-popup .section-path {
    font-weight: 500;
    font-size: 0.9rem;
}

.floating-popup .popup-actions button,
.pinned-popup .popup-actions button {
    background: transparent;
    border: none;
    padding: 0.25rem 0.5rem;
    margin-left: 4px;
}

.floating-popup .popup-actions button:hover,
.pinned-popup .popup-actions button:hover {
    background: rgba(255,255,255,0.2);
    border-radius: 3px;
}

/* Pinned popup specific styles */
.pinned-popup {
    background: #fff;
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,0.1);
    margin-bottom: 1.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.pinned-popup:hover {
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

.pinned-popup .popup-header {
    background-color: var(--primary-color);
    color: #fff;
    cursor: default;
}

/* Remove old styles that conflict with new structure */
.pinned-popup .modal-header,
.pinned-popup .modal-body,
.pinned-popup .modal-footer,
.pinned-popup .card-header,
.pinned-popup .card-body {
    padding: 0;
    margin: 0;
    border: none;
}

.pinned-popup .card-header,
.pinned-popup .modal-header {
    display: none;
}

/* Animations */
@keyframes popupFadeOut {
    from { opacity: 1; transform: scale(1); }
    to { opacity: 0; transform: scale(0.9); }
}

@keyframes popupContentExpand {
    from { opacity: 0; max-height: 0; }
    to { opacity: 1; max-height: 400px; }
}

@keyframes popupContentCollapse {
    from { opacity: 1; max-height: 400px; }
    to { opacity: 0; max-height: 0; }
}

/* Sortable placeholder */
.ui-state-highlight {
    height: 100px;
    background-color: #f8f9fa;
    border: 2px dashed #007bff;
    margin-bottom: 1rem;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- jQuery and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="<?php echo e(asset('user_assets/js/sidebar-persistence.js')); ?>"></script>
<script src="<?php echo e(asset('user_assets/js/user-centric-popups.js')); ?>"></script>
<script>
    // Function to redirect to appropriate document view for user-centric session
    function redirectToUserDocument(tableName, categoryId, language) {
        // Check if it's a French document
        const isFrench = (language === '2' || language === 'fr' || language === 'French');
        
        if (isFrench) {
            // Redirect to French view for user session (no client_id)
            window.location = `/view-user-legal-table-french/${tableName}?category_id=${categoryId}`;
        } else {
            // Redirect to normal view for user session (no client_id)
            window.location = `/view-user-legal-table/${tableName}?category_id=${categoryId}`;
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
        
        // Add test popup button handler
        document.getElementById('test-popup')?.addEventListener('click', function() {
            const testTitle = "Test Legal Reference";
            const testContent = `
                <div class="section-content">
                    <h6>Immigration and Refugee Protection Act</h6>
                    <p><strong>Section 25.1:</strong> The Minister may, on request or on the Minister's own initiative, examine the circumstances concerning a foreign national who is inadmissible or who does not meet the requirements of this Act and may grant the foreign national permanent resident status or an exemption from any applicable criteria or obligations of this Act if the Minister is of the opinion that it is justified by humanitarian and compassionate considerations relating to the foreign national.</p>
                    <p>This section provides discretionary relief for individuals who may not meet standard immigration requirements but face compelling humanitarian circumstances.</p>
                </div>
            `;
            createFloatingPopup(testTitle, testContent);
        });
        
        // Add save pinned popups button handler
        document.getElementById('save-pinned-popups')?.addEventListener('click', function() {
            savePopupDataToDatabase(true); // Show notifications for manual saves
        });
        
        // Add fetch pinned popups button handler  
        document.getElementById('fetch-pinned-popups')?.addEventListener('click', function() {
            loadSavedPopups();
        });
        
        // Add clear pinned popups button handler
        document.getElementById('clear-pinned-popups')?.addEventListener('click', function() {
            if (confirm('Are you sure you want to clear all saved popups for this page?')) {
                // Clear from UI
                const droppableArea = document.querySelector('.nested-droppable');
                if (droppableArea) {
                    const existingPopups = droppableArea.querySelectorAll('.pinned-popup');
                    existingPopups.forEach(popup => {
                        popup.style.animation = 'popupFadeOut 0.3s ease-in forwards';
                        setTimeout(() => popup.remove(), 300);
                    });
                }
                
                // Clear from database
                clearSavedPopups();
            }
        });
        
        // Set document context for the legal tables browsing page (optional now)
        if (typeof setDocumentContext === 'function') {
            // Set a general context for the legal tables page (no longer needed for popups)
            setDocumentContext('legal_tables_browse', 'all');
            console.log('Document context set for legal tables browsing page');
        } else {
            // Directly load popups if context function not available
            setTimeout(() => {
                loadSavedPopups(false); // Silent load
            }, 500);
        }
        
        // Set up auto-save functionality
        if (typeof setupAutoSave === 'function') {
            setupAutoSave();
        }
        
        // Auto-load saved popups on page load (silent)
        setTimeout(() => {
            loadSavedPopups(false); // Silent load
        }, 1000);
        
        // Add form submit handler for debugging
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            // Log form values for debugging
            console.log('User-centric form values being submitted:');
            const formData = new FormData(this);
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\user-centric-legal-tables.blade.php ENDPATH**/ ?>