

<?php $__env->startSection('content'); ?>
<div class="main-content container-fluid">
    <div class="row sec-title title-default px-4">
        <div class="col-12">
            <h2>Legislations</h2>
        </div>
    </div>
    
    <div class="row gap_top">
        <div class="gap_top col-12 mb-4 p-0">
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="client-avatar me-4 d-flex justify-content-center align-items-center rounded-circle bg-light text-primary" style="width: 60px; height: 60px; font-size: 24px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="client-info flex-grow-1">
                        <h4 class="mb-2" data-en="Client Details" data-fr="Détails du client">Client Details</h4>
                        <div class="d-flex flex-wrap">
                            <div class="me-4 mb-2">
                                <span class="d-flex align-items-center">
                                    <strong data-en="Name:" data-fr="Nom :">Name:</strong>&nbsp;<?php echo e($client->client_name ?? '-'); ?>

                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-envelope me-2 text-secondary"></i>
                                    <strong data-en="Email:" data-fr="Courriel :">Email:</strong>&nbsp;<?php echo e($client->client_email ?? '-'); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row p-4 rounded shadow-sm">
        <div class="col-12">
            <div class="widget sp-top widget-blank widget-form widget-vertical shadow-sm">
                <div class="widget-title">
                    <h5 data-en="Search Legislations" data-fr="Rechercher des législations">Search Legislations</h5>
                </div>
                <div class="widget-body sp-top-dbl">
                    <form method="GET" action="<?php echo e(route('user.client.legal-tables', $client->id)); ?>" id="filterForm" class="row form vertical-form">
                        <div class="row m-0">
                            <!-- Always visible (Simple Search) -->
                            <div class="col-lg-4 form-group mb-3">
                                <label for="keyword" class="form-label" data-en="Search by Keyword" data-fr="Rechercher par mot-clé">Search by Keyword</label>
                                <div class="input-group">
                                    <input type="text" name="search" id="keyword" class="form-control" 
                                           placeholder="Legal Act, Regulation.." 
                                           data-placeholder-en="Legal Act, Regulation.."
                                           data-placeholder-fr="Loi juridique, Règlement.."
                                           value="<?php echo e(request('search')); ?>">
                                    <button class="btn btn-neutral" type="button" id="quickSearchBtn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label for="language_id" class="form-label" data-en="Select Language" data-fr="Sélectionner la langue">Select Language</label>
                                <select name="language_id" id="language_id" class="form-control form-select">
                                    <option value="" data-en="Language" data-fr="Langue">Language</option>
                                    <option value="1" <?php echo e(request('language_id') == '1' ? 'selected' : ''); ?> data-en="English" data-fr="Anglais">English</option>
                                    <option value="2" <?php echo e(request('language_id') == '2' ? 'selected' : ''); ?> data-en="French" data-fr="Français">French</option>
                                    <option value="3" <?php echo e(request('language_id') == '3' ? 'selected' : ''); ?> data-en="Bilingual" data-fr="Bilingue">Bilingual</option>
                                </select>
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <div class="form-group">
                                    <label for="jurisdiction_id" class="form-label" data-en="Select Jurisdiction" data-fr="Sélectionner la juridiction">Select Jurisdiction</label>
                                    <select name="jurisdiction_id" id="jurisdiction_id" class="form-control form-select">
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
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label for="law_id" class="form-label" data-en="Select Law Subject" data-fr="Sélectionner le sujet de droit">Select Law Subject</label>
                                <select name="law_id" id="law_id" class="form-control form-select">
                                    <option value="" data-en="Subject" data-fr="Sujet">Subject</option>
                                    <option value="1" <?php echo e(request('law_id') == '1' ? 'selected' : ''); ?> data-en="Immigration" data-fr="Immigration">Immigration</option>
                                    <option value="2" <?php echo e(request('law_id') == '2' ? 'selected' : ''); ?> data-en="Citizenship" data-fr="Citoyenneté">Citizenship</option>
                                    <option value="3" <?php echo e(request('law_id') == '3' ? 'selected' : ''); ?> data-en="Criminal" data-fr="Criminel">Criminal</option>
                                </select>
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label for="act_id" class="form-label" data-en="Select Docs Category" data-fr="Sélectionner la catégorie de documents">Select Docs Category</label>
                                <select name="act_id" id="act_id" class="form-control form-select">
                                    <option value="" data-en="Category" data-fr="Catégorie">Category</option>
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
                            <div class="col-lg-4 form-group mb-3 d-flex justify-content-start align-items-start flex-column text-end">
                                <div class="mt-auto">
                                    <button type="button" class="btn btn-neutral me-2" id="reset" onclick="resetForm()">
                                        <span data-en="Reset" data-fr="Réinitialiser">Reset</span>
                                    </button>
                                    <button type="submit" class="btn btn-action" id="search">
                                        <span data-en="Search" data-fr="Rechercher">Search</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="widget sp-top widget-blank widget-form widget-vertical shadow-sm">
                <div class="widget-title with-filters">
                    <h5 data-en="Available Legislations" data-fr="Législations disponibles">Available Legislations</h5>
                    <div class="widget-filters">
                        <div class="single-filter">
                            <span class="toggle-label" data-en="Select from " data-fr="Sélectionner de ">Select from </span>
                            <span id="act-pagination-toggle" class="letter-toggle"> A to Z</span>
                        </div>
                        <div class="single-filter">
                            <span class="toggle-label" data-en="Language " data-fr="Langue ">Language </span>
                            <div class="ln-toggle">
                                <input type="radio" id="lang-en" name="toggle" value="1">
                                <label for="lang-en" class="toggle">EN</label>
                                <input type="radio" id="lang-fr" name="toggle" value="2">
                                <label for="lang-fr" class="toggle">FR</label>
                                <input type="radio" id="lang-all" name="toggle" value="" checked>
                                <label for="lang-all" class="toggle">ALL</label>
                                <span></span>
                            </div>
                        </div>
                        <div class="single-filter">
                            <span class="toggle-label" data-en="View " data-fr="Vue ">View </span>
                            <div class="view-toggle">
                                <input type="radio" id="view-grid" name="view-toggle" value="grid" checked>
                                <label for="view-grid" class="toggle">Grid</label>
                                <input type="radio" id="view-list" name="view-toggle" value="list">
                                <label for="view-list" class="toggle">List</label>
                                <span></span>
                            </div>
                        </div>
                        <div id="act-pagination-content" class="widget-filters-extended letter-filter">
                            <ul class="act-pagination">
                                <li><a href="#A">A</a></li>
                                <li><a href="#B">B</a></li>
                                <li><a href="#C">C</a></li>
                                <li><a href="#D">D</a></li>
                                <li><a href="#E">E</a></li>
                                <li><a href="#F">F</a></li>
                                <li><a href="#G">G</a></li>
                                <li><a href="#H">H</a></li>
                                <li><a href="#I">I</a></li>
                                <li><a class="disabled" href="#J">J</a></li>
                                <li><a class="disabled" href="#K">K</a></li>
                                <li><a href="#L">L</a></li>
                                <li><a href="#M">M</a></li>
                                <li><a href="#N">N</a></li>
                                <li><a href="#O">O</a></li>
                                <li><a href="#P">P</a></li>
                                <li><a href="#Q">Q</a></li>
                                <li><a href="#R">R</a></li>
                                <li><a href="#S">S</a></li>
                                <li><a href="#T">T</a></li>
                                <li><a href="#U">U</a></li>
                                <li><a href="#V">V</a></li>
                                <li><a href="#W">W</a></li>
                                <li><a class="disabled" href="#X">X</a></li>
                                <li><a href="#Y">Y</a></li>
                                <li><a class="disabled" href="#Z">Z</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="widget-body sp-top-dbl">
                    <!-- Legal Documents Grid -->
                    <div id="toggleTileContainer" class="row toggle-tile-warpper sp-top">
                        <?php if($results->count()): ?>
                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="toggle-tile-body col-12 col-md-4 col-lg-3 grid">
                                <div class="toggle-tile-content shadow-sm sp-top" data-en="<?php echo e($row->act_name); ?>" data-fr="<?php echo e($row->act_name); ?>" onclick="redirectToDocument('<?php echo e($row->table_name); ?>', '<?php echo e($row->id); ?>', '<?php echo e($client->id); ?>', '<?php echo e($row->language_id ?? $row->language ?? ''); ?>')">
                                    <h4><i class="fas fa-book act-icon"></i> <?php echo e($row->act_name); ?></h4>
                                    <ul class="act-data">
                                        <li class="act-category"><strong data-en="Category: " data-fr="Catégorie: ">Category: </strong><span><?php echo e($acts[$row->act_id] ?? $row->act_id); ?></span></li>
                                        <li class="act-law"><strong data-en="Law Subject: " data-fr="Sujet de droit: ">Law Subject: </strong><span><?php echo e($lawSubjects[$row->law_id] ?? $row->law_id); ?></span></li>
                                        <li class="act-jurisdiction"><strong data-en="Jurisdiction: " data-fr="Juridiction: ">Jurisdiction: </strong><span><?php echo e($jurisdictions[$row->jurisdiction_id] ?? $row->jurisdiction_id); ?></span></li>
                                        <li class="act-language"><strong data-en="Language: " data-fr="Langue: ">Language: </strong><span>
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

                                        </span></li>
                                        <li class="act-description"><strong data-en="Created: " data-fr="Créé: ">Created: </strong> <?php echo e($row->created_at); ?></li>
                                        <li class="view-button"><a href="javascript:void(0)"><strong data-en="View Document" data-fr="Voir le document">View Document</strong> <i class="fas fa-arrow-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="col-12 no-results">
                                <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                                <p data-en="No legal acts found matching your search criteria." data-fr="Aucune loi juridique trouvée correspondant à vos critères de recherche.">No legal acts found matching your search criteria.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="container-fluid footer">
    <div class="container">
        <div class="row p-4">
            <div class="col-lg-6 text-center">
                <!--Error reporting-->
                <div class="errorWrapper">
                    <a href="#0" id="info" class="error-toggle shadow-sm" data-en="Report a problem or mistake on this page" data-fr="Signaler un problème ou une erreur sur cette page">Report a problem or mistake on this page<i class="fas fa-arrow-right"></i></a>
                    <div class="popup2" role="alert" id="errorPopup">
                        <div class="popup-container shadow-sm">
                            <a href="#0" class="popup-close" id="popupCloseBtn" title="Close popup">&times;</a>
                            <h4 class="popup-title m-0" data-en="Report a Problem or Mistake" data-fr="Signaler un problème ou une erreur">Report a Problem or Mistake</h4>
                            <form class="errorForm" id="errorReportForm">
                                <div class="form-group mb-3 text-start">
                                    <label for="errorPage" class="form-label" data-en="Page/Section" data-fr="Page/Section">Page/Section</label>
                                    <input type="text" class="form-control" id="errorPage" name="errorPage" placeholder="E.g., Dashboard > Client List">
                                </div>
                                <div class="form-group mb-3 text-start">
                                    <label for="errorMessage" class="form-label" data-en="Describe the Issue" data-fr="Décrire le problème">Describe the Issue</label>
                                    <textarea class="form-control" id="errorMessage" name="errorMessage" rows="4" placeholder="Please describe what went wrong..."></textarea>
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-neutral" id="popupCancelBtn" data-en="Cancel" data-fr="Annuler">Cancel</button>
                                    <button type="submit" class="btn btn-action" data-en="Submit" data-fr="Soumettre">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <p class="last-updated">Last modified on 03:42 AM (EST) 24/06/2025</p>
            </div>
        </div>
        <div class="row container">
            <div class="col-12 copyright text-center">
                <p>&copy;<a target="_blank" href="https://app.jurislocator.ca/">Jurislocator</a> 2025 - All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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

    // Reset form function
    function resetForm() {
        document.getElementById('filterForm').reset();
        // Optionally redirect to clear URL parameters
        window.location.href = window.location.pathname;
    }

    $(document).ready(function () {
        // Toggle A-Z filter section
        $('#act-pagination-toggle').on('click', function () {
            $('#act-pagination-content').toggleClass('active');
            $(this).toggleClass('active');
        });

        const $container = $('#toggleTileContainer');

        // View toggle functionality
        $('input[name="view-toggle"]').on('change', function () {
            const view = $(this).val();

            $container.find('.toggle-tile-body').each(function () {
                $(this).removeClass('col-12 col-md-4 col-lg-3 grid list');
                if (view === 'list') {
                    $(this).addClass('col-12 list');
                } else {
                    $(this).addClass('col-12 col-md-4 col-lg-3 grid');
                }
            });
        });

        // Language filter functionality
        $('input[name="toggle"]').on('change', function () {
            const langValue = $(this).val();
            
            // Apply language filter to visible items
            $container.find('.toggle-tile-body').each(function () {
                const $item = $(this);
                const itemLanguage = $item.find('.act-language span').text().trim();
                
                if (langValue === '') {
                    // Show all
                    $item.show();
                } else if (langValue === '1' && (itemLanguage === 'English' || itemLanguage === 'Bilingual')) {
                    // Show English
                    $item.show();
                } else if (langValue === '2' && (itemLanguage === 'French' || itemLanguage === 'Bilingual')) {
                    // Show French
                    $item.show();
                } else {
                    $item.hide();
                }
            });
        });

        // Quick search functionality
        $('#quickSearchBtn').on('click', function() {
            $('#filterForm').submit();
        });
        
        // Submit form on Enter key in search input
        $('#keyword').on('keypress', function(e) {
            if (e.which === 13) {
                $('#filterForm').submit();
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
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\user-legal-tables-new.blade.php ENDPATH**/ ?>