

<?php $__env->startPush('styles'); ?>
<style>
    /* Override any existing styles that might be hiding elements */
    .toggle-tile-body .toggle-tile-content .act-data,
    .toggle-tile-body.grid .toggle-tile-content .act-data,
    .toggle-tile-body.list .toggle-tile-content .act-data,
    .toggle-tile-content ul.act-data,
    ul.act-data,
    .act-data {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 10px 0 !important;
        flex-grow: 1 !important;
        height: auto !important;
        overflow: visible !important;
        width: 100% !important;
        clear: both !important;
        flex-direction: column !important;
    }
    
    .toggle-tile-body .toggle-tile-content .act-data li,
    .toggle-tile-body.grid .toggle-tile-content .act-data li,
    .toggle-tile-body.list .toggle-tile-content .act-data li,
    .toggle-tile-content ul.act-data li,
    ul.act-data li,
    .act-data li,
    li.act-category,
    li.act-law,
    li.act-jurisdiction,
    li.act-language,
    li.act-description,
    li.view-button {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        margin-bottom: 8px !important;
        font-size: 13px !important;
        color: #666 !important;
        line-height: 1.4 !important;
        height: auto !important;
        overflow: visible !important;
        position: static !important;
        left: auto !important;
        top: auto !important;
        transform: none !important;
        width: 100% !important;
        clear: both !important;
        border: none !important;
        background: transparent !important;
        flex: none !important;
    }
    
    .toggle-tile-content {
        background: white !important;
        border-radius: 8px !important;
        padding: 20px !important;
        height: auto !important;
        min-height: 300px !important;
        display: flex !important;
        flex-direction: column !important;
        cursor: pointer !important;
        transition: transform 0.2s !important;
        border: 1px solid #e0e0e0 !important;
        overflow: visible !important;
        position: relative !important;
    }
    
    .toggle-tile-content:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }
    
    .toggle-tile-content h4 {
        color: #333 !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        margin-bottom: 15px !important;
        line-height: 1.4 !important;
        display: block !important;
        visibility: visible !important;
    }
    
    .act-data li strong {
        color: #333 !important;
        font-weight: 600 !important;
        display: inline !important;
    }
    
    .act-data .view-button {
        margin-top: auto !important;
        text-align: center !important;
        border-top: 1px solid #eee !important;
        padding-top: 15px !important;
        margin-top: 15px !important;
    }
    
    .act-data .view-button a {
        color: #007bff !important;
        text-decoration: none !important;
        font-weight: 600 !important;
        display: inline-block !important;
    }
    
    .act-data .view-button a:hover {
        color: #0056b3 !important;
    }
    
    .act-icon {
        color: #007bff !important;
        margin-right: 8px !important;
    }
    
    .toggle-tile-body {
        margin-bottom: 20px !important;
    }
    
    /* Force all possible hiding methods to be overridden */
    .act-data * {
        display: inherit !important;
        visibility: inherit !important;
        opacity: inherit !important;
    }
    
    /* Clean styling for card details */
    .act-data {
        list-style: none !important;
        padding: 0 !important;
        margin: 10px 0 !important;
        background-color: transparent !important;
    }
    
    .act-data li {
        padding: 8px 0 !important;
        margin: 0 !important;
        border-bottom: 1px solid #eee !important;
        background-color: transparent !important;
    }
    
    .act-data li:last-child {
        border-bottom: none !important;
    }
    
    /* Ensure card details are always visible */
    .act-data,
    .act-data li {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
        height: auto !important;
        overflow: visible !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content container-fluid">
    <div class="row sec-title title-default px-4">
        <div class="col-12">
            <h2 data-en="Legal Documents Browser" data-fr="Navigateur de documents juridiques">Legal Documents Browser</h2>
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
                                <input type="radio" id="view-grid" name="view-toggle" value="grid">
                                <label for="view-grid" class="toggle">Grid</label>
                                <input type="radio" id="view-list" name="view-toggle" value="list" checked>
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
                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="toggle-tile-body col-12 list" data-card-index="<?php echo e($index); ?>">
                                <div class="toggle-tile-content shadow-sm sp-top" 
                                     data-en="<?php echo e($row->act_name ?? 'Unknown'); ?>" 
                                     data-fr="<?php echo e($row->act_name ?? 'Unknown'); ?>"
                                     data-table-name="<?php echo e($row->table_name ?? 'unknown'); ?>"
                                     data-act-id="<?php echo e($row->act_id ?? '1'); ?>"
                                     data-client-id="<?php echo e($client->id ?? '1'); ?>"
                                     data-language-id="<?php echo e($row->language_id ?? '1'); ?>">
                                    <h4><i class="fas fa-book act-icon"></i> <?php echo e($row->act_name ?? 'Unknown Act'); ?></h4>
                                    
                                    <ul>
                                        <li class="act-category">
                                            <i class="fas fa-folder-open act-icon"></i>
                                            <strong>Category:</strong> <?php echo e($acts[$row->act_id ?? 1] ?? 'N/A'); ?>

                                        </li>
                                        <li class="act-law">
                                            <i class="fas fa-gavel act-icon"></i>
                                            <strong>Law Subject:</strong> <?php echo e($lawSubjects[$row->law_id ?? 1] ?? 'N/A'); ?>

                                        </li>
                                        <li class="act-jurisdiction">
                                            <i class="fas fa-map-marker-alt act-icon"></i>
                                            <strong>Jurisdiction:</strong> <?php echo e($jurisdictions[$row->jurisdiction_id ?? 1] ?? 'N/A'); ?>

                                        </li>
                                        <li class="act-language">
                                            <i class="fas fa-language act-icon"></i>
                                            <strong>Language:</strong> <?php echo e($languages[$row->language_id ?? 1] ?? 'N/A'); ?>

                                        </li>
                                        <li class="act-description">
                                            <i class="fas fa-calendar-alt act-icon"></i>
                                            <strong>Created:</strong> <?php echo e($row->created_at ? date('M d, Y', strtotime($row->created_at)) : 'N/A'); ?>

                                        </li>
                                        <li class="view-button">
                                            <a href="javascript:void(0)" onclick="redirectToDocument('<?php echo e($row->table_name); ?>', '<?php echo e($row->act_id); ?>', '<?php echo e($client->id); ?>', '<?php echo e($row->language_id); ?>')">
                                                <i class="fas fa-eye act-icon"></i>View Document
                                            </a>
                                        </li>
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
    console.log('=== SCRIPT STARTED ===');
    
    // EMERGENCY: Save the original HTML structure immediately when DOM loads
    let savedCardHTML = {};
    
    document.addEventListener('DOMContentLoaded', function() {
        // Save the HTML of each card with act-data
        const cards = document.querySelectorAll('.toggle-tile-content');
        console.log(`🔍 Found ${cards.length} total cards on page load`);
        
        cards.forEach((card, index) => {
            console.log(`📋 Card ${index} HTML:`, card.innerHTML.substring(0, 200));
            const actData = card.querySelector('.act-data');
            if (actData) {
                savedCardHTML[index] = {
                    card: card,
                    html: actData.outerHTML
                };
                console.log(`💾 Saved HTML for card ${index}:`, actData.outerHTML.substring(0, 100));
            } else {
                console.log(`❌ Card ${index} has NO act-data element!`);
                
                // Let's see what this card contains
                const cardContent = card.innerHTML;
                console.log(`❌ Card ${index} content:`, cardContent);
                
                // Check if this card has the data attributes we expect
                const tableName = card.getAttribute('data-table-name');
                const actId = card.getAttribute('data-act-id');
                console.log(`❌ Card ${index} attributes - table: ${tableName}, act: ${actId}`);
                
                // If this card has data attributes, it's a dynamic card that lost its act-data
                if (tableName && actId) {
                    console.log(`🔧 EMERGENCY: Creating missing act-data for card ${index}`);
                    
                    // Create the missing act-data element
                    const newActData = document.createElement('ul');
                    newActData.className = 'act-data';
                    
                    // Add some basic content
                    newActData.innerHTML = `
                        <li style="display: block !important; margin: 2px 0 !important; padding: 5px !important;">📋 Category: [Data Missing]</li>
                        <li style="display: block !important;  margin: 2px 0 !important; padding: 5px !important;">⚖️ Law: [Data Missing]</li>
                        <li style="display: block !important;  margin: 2px 0 !important; padding: 5px !important;">🗺️ Jurisdiction: [Data Missing]</li>
                        <li style="display: block !important;  margin: 2px 0 !important; padding: 5px !important;">🌐 Language: [Data Missing]</li>
                        <li style="display: block !important; margin: 2px 0 !important; padding: 5px !important;">📅 Created: Test Date</li>
                        <li style="display: block !important; margin: 2px 0 !important; padding: 5px !important;">🔗 <a href="javascript:void(0)">View Document</a></li>
                    `;
                    
                    card.appendChild(newActData);
                    console.log(`✅ Emergency act-data created for card ${index}`);
                }
            }
        });
        
        // Set up restoration timer
        setInterval(function() {
            let restoredCount = 0;
            Object.keys(savedCardHTML).forEach(index => {
                const cardData = savedCardHTML[index];
                const currentActData = cardData.card.querySelector('.act-data');
                if (!currentActData) {
                    console.log(`🔧 Restoring missing act-data for card ${index}`);
                    cardData.card.insertAdjacentHTML('beforeend', cardData.html);
                    restoredCount++;
                }
            });
            if (restoredCount > 0) {
                console.log(`✅ Restored ${restoredCount} missing act-data elements`);
            }
        }, 50); // Check every 50ms
    });
    
    // EMERGENCY PROTECTION: Prevent any script from hiding our elements
    try {
        if (Element.prototype.style && Element.prototype.style.setProperty) {
            const originalSetStyle = Element.prototype.style.setProperty;
            Element.prototype.style.setProperty = function(property, value, priority) {
                if (this.classList && (this.classList.contains('act-data') || this.closest('.act-data'))) {
                    if (property === 'display' && value === 'none') {
                        console.log('🚫 BLOCKED attempt to hide act-data element:', this);
                        return;
                    }
                    if (property === 'visibility' && value === 'hidden') {
                        console.log('🚫 BLOCKED attempt to hide act-data element:', this);
                        return;
                    }
                }
                return originalSetStyle.call(this, property, value, priority);
            };
        }
    } catch (e) {
        console.log('⚠️ Could not override style.setProperty:', e);
    }
    
    // Override jQuery hide/remove methods
    if (typeof $ !== 'undefined') {
        const originalHide = $.fn.hide;
        const originalRemove = $.fn.remove;
        const originalEmpty = $.fn.empty;
        
        $.fn.hide = function() {
            if (this.hasClass('act-data') || this.find('.act-data').length > 0 || this.closest('.act-data').length > 0) {
                console.log('🚫 BLOCKED jQuery hide on act-data:', this);
                return this;
            }
            return originalHide.apply(this, arguments);
        };
        
        $.fn.remove = function() {
            if (this.hasClass('act-data') || this.find('.act-data').length > 0 || this.closest('.act-data').length > 0) {
                console.log('🚫 BLOCKED jQuery remove on act-data:', this);
                return this;
            }
            return originalRemove.apply(this, arguments);
        };
        
        $.fn.empty = function() {
            if (this.hasClass('act-data') || this.find('.act-data').length > 0 || this.closest('.act-data').length > 0) {
                console.log('🚫 BLOCKED jQuery empty on act-data:', this);
                return this;
            }
            return originalEmpty.apply(this, arguments);
        };
    }
    
    // Watch for DOM mutations that might remove our elements
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                // Check for removed nodes
                mutation.removedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        if (node.classList && node.classList.contains('act-data')) {
                            console.error('🚨🚨🚨 ACT-DATA ELEMENT REMOVED!', node);
                            console.trace('REMOVAL STACK TRACE');
                            // Try to restore it
                            if (mutation.target) {
                                mutation.target.appendChild(node);
                                console.log('✅ Restored removed act-data element');
                            }
                        }
                        if (node.querySelector && node.querySelector('.act-data')) {
                            console.error('�🚨🚨 ELEMENT CONTAINING ACT-DATA REMOVED!', node);
                            console.trace('REMOVAL STACK TRACE');
                        }
                    }
                });
                
                // Log all changes to cards
                if (mutation.target.closest && mutation.target.closest('.toggle-tile-content')) {
                    console.log('🔄 Changes in card:', mutation.target, 'Added:', mutation.addedNodes.length, 'Removed:', mutation.removedNodes.length);
                }
            }
            
            // Monitor attribute changes that might hide elements
            if (mutation.type === 'attributes') {
                const target = mutation.target;
                if (target.classList && (target.classList.contains('act-data') || target.closest('.act-data'))) {
                    console.log('📝 Attribute changed on act-data element:', mutation.attributeName, 'Element:', target);
                    if (mutation.attributeName === 'style') {
                        console.log('Style changed to:', target.style.cssText);
                    }
                }
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeOldValue: true
    });
    
    // EMERGENCY: Override innerHTML/outerHTML setters
    try {
        const originalInnerHTMLDescriptor = Object.getOwnPropertyDescriptor(Element.prototype, 'innerHTML');
        
        if (originalInnerHTMLDescriptor) {
            Object.defineProperty(Element.prototype, 'innerHTML', {
                get: originalInnerHTMLDescriptor.get,
                set: function(value) {
                    const currentHTML = this.innerHTML;
                    const hasActData = currentHTML.includes('act-data');
                    const newHasActData = value.includes('act-data');
                    
                    if (hasActData && !newHasActData && (this.id === 'toggleTileContainer' || this.closest('#toggleTileContainer'))) {
                        console.error('🚨🚨🚨 BLOCKED: innerHTML would remove act-data from card container!');
                        console.log('Current HTML length:', currentHTML.length, 'New HTML length:', value.length);
                        console.trace('innerHTML call stack');
                        return; // Block the dangerous change
                    }
                    
                    if (this.closest && this.closest('.toggle-tile-content') && hasActData && !newHasActData) {
                        console.error('🚨🚨🚨 BLOCKED: innerHTML would remove act-data from card!');
                        console.trace('innerHTML call stack');
                        return; // Block the dangerous change
                    }
                    
                    return originalInnerHTMLDescriptor.set.call(this, value);
                }
            });
        }
    } catch (e) {
        console.log('⚠️ Could not override innerHTML:', e);
    }
    
    // Function to redirect to appropriate document view based on language
    function redirectToDocument(tableName, categoryId, clientId, language) {
        const isFrench = (language === '2' || language === 'fr' || language === 'French');
        
        if (isFrench) {
            window.location = `/view-legal-table-french/${tableName}?category_id=${categoryId}&client_id=${clientId}`;
        } else {
            window.location = `/view-legal-table/${tableName}?category_id=${categoryId}&client_id=${clientId}`;
        }
    }

    // Reset form function
    function resetForm() {
        document.getElementById('filterForm').reset();
        window.location.href = window.location.pathname;
    }

    // Simple function to ensure all card details are visible
    function showAllCardDetails() {
        console.log('=== CARD DIAGNOSTICS START ===');
        
        const cards = document.querySelectorAll('.toggle-tile-body');
        const actData = document.querySelectorAll('.act-data');
        const listItems = document.querySelectorAll('.act-data li');
        const errorMessages = document.querySelectorAll('.alert-warning');
        
        console.log('Cards found:', cards.length);
        console.log('Act data elements found:', actData.length);
        console.log('List items found:', listItems.length);
        console.log('Error messages found:', errorMessages.length);
        
        // Show any error messages
        if (errorMessages.length > 0) {
            errorMessages.forEach((error, index) => {
                console.log(`Error ${index}:`, error.textContent);
            });
        }
        
        // Show details of first few cards
        for (let i = 0; i < Math.min(5, cards.length); i++) {
            const card = cards[i];
            console.log(`=== CARD ${i} DETAILS ===`);
            console.log('Card HTML length:', card.innerHTML.length);
            console.log('Card HTML preview:', card.innerHTML.substring(0, 300) + '...');
            
            const cardActData = card.querySelectorAll('.act-data');
            const cardListItems = card.querySelectorAll('.act-data li');
            console.log(`Card ${i} - act-data elements:`, cardActData.length);
            console.log(`Card ${i} - list items:`, cardListItems.length);
            
            // Check if the card has act-data but it's hidden
            if (cardActData.length > 0) {
                const actDataEl = cardActData[0];
                const computedStyle = window.getComputedStyle(actDataEl);
                console.log(`Card ${i} act-data computed display:`, computedStyle.display);
                console.log(`Card ${i} act-data computed visibility:`, computedStyle.visibility);
                console.log(`Card ${i} act-data computed opacity:`, computedStyle.opacity);
            }
        }
        
        // Force visibility on all elements and make them immutable
        actData.forEach((data, index) => {
            // Use direct style setting instead of setProperty
            data.style.display = 'block';
            data.style.visibility = 'visible';
            data.style.opacity = '1';
            data.style.padding = '10px';
            
            // Try setProperty with error handling
            try {
                data.style.setProperty('display', 'block', 'important');
                data.style.setProperty('visibility', 'visible', 'important');
                data.style.setProperty('opacity', '1', 'important');
                data.style.setProperty('padding', '10px', 'important');
            } catch (e) {
                console.log('⚠️ setProperty failed, using direct assignment');
            }
            
            console.log(`Act data ${index} forced visible with protection`);
        });
        
        listItems.forEach((item, index) => {
            // Use direct style setting
            item.style.display = 'block';
            item.style.visibility = 'visible';
            item.style.opacity = '1';
            
            try {
                item.style.setProperty('display', 'block', 'important');
                item.style.setProperty('visibility', 'visible', 'important');
                item.style.setProperty('opacity', '1', 'important');
            } catch (e) {
                // Ignore setProperty errors
            }
        });
        
        console.log('=== DIAGNOSTICS COMPLETE ===');
    }

    // DOM ready handler
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== DOM CONTENT LOADED ===');
        
        // Immediate and repeated checks
        showAllCardDetails();
        
        setTimeout(function() {
            console.log('=== RUNNING DIAGNOSTICS AFTER 500ms ===');
            showAllCardDetails();
        }, 500);
        
        setTimeout(function() {
            console.log('=== RUNNING DIAGNOSTICS AFTER 2000ms ===');
            showAllCardDetails();
        }, 2000);
        
        // Apply saved language
        const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
        if (typeof translateLegalTablesPage === 'function') {
            translateLegalTablesPage(savedLanguage);
        }
    });

    // jQuery ready handler (if jQuery is available)
    if (typeof $ !== 'undefined') {
        $(document).ready(function () {
            console.log('=== JQUERY READY ===');
            
            // Immediately show all cards and details
            showAllCardDetails();
            
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
                
                // Re-apply protection after layout change
                setTimeout(showAllCardDetails, 100);
            });

            // Language filter
            $('input[name="toggle"]').on('change', function () {
                const langValue = $(this).val();
                console.log('Language filter changed to:', langValue);
                
                if (langValue === '') {
                    $container.find('.toggle-tile-body').show();
                } else {
                    $container.find('.toggle-tile-body').each(function () {
                        const $item = $(this);
                        const itemLanguage = $item.find('.act-language span').text().trim();
                        
                        if (langValue === '1' && (itemLanguage === 'English' || itemLanguage === 'Bilingual')) {
                            $item.show();
                        } else if (langValue === '2' && (itemLanguage === 'French' || itemLanguage === 'Bilingual')) {
                            $item.show();
                        } else if (langValue === '1' || langValue === '2') {
                            $item.hide();
                        } else {
                            $item.show();
                        }
                    });
                }
                
                setTimeout(showAllCardDetails, 100);
            });

            // A-Z toggle
            $('#act-pagination-toggle').on('click', function () {
                $('#act-pagination-content').toggleClass('active');
                $(this).toggleClass('active');
            });

            // Search functionality
            $('#quickSearchBtn').on('click', function() {
                $('#filterForm').submit();
            });
            
            $('#keyword').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#filterForm').submit();
                }
            });
            
            // Card click handlers
            $('.toggle-tile-content').on('click', function(e) {
                if ($(e.target).closest('.view-button').length > 0) {
                    return;
                }
                
                const tableName = $(this).data('table-name');
                const actId = $(this).data('act-id');
                const clientId = $(this).data('client-id');
                const languageId = $(this).data('language-id');
                
                if (tableName && actId && clientId) {
                    redirectToDocument(tableName, actId, clientId, languageId);
                }
            });
        });
    } else {
        console.log('jQuery not available');
    }

    // Translation functionality
    function translateLegalTablesPage(language) {
        const elements = document.querySelectorAll('[data-en][data-fr]');
        elements.forEach(element => {
            const translation = element.getAttribute('data-' + language);
            if (translation) {
                element.textContent = translation;
            }
        });

        const placeholderElements = document.querySelectorAll('[data-placeholder-en][data-placeholder-fr]');
        placeholderElements.forEach(element => {
            const placeholder = element.getAttribute('data-placeholder-' + language);
            if (placeholder) {
                element.placeholder = placeholder;
            }
        });

        const options = document.querySelectorAll('option[data-en][data-fr]');
        options.forEach(option => {
            const translation = option.getAttribute('data-' + language);
            if (translation) {
                option.textContent = translation;
            }
        });

        const optgroups = document.querySelectorAll('optgroup[data-label-en][data-label-fr]');
        optgroups.forEach(optgroup => {
            const label = optgroup.getAttribute('data-label-' + language);
            if (label) {
                optgroup.label = label;
            }
        });
    }

    // Language change listener
    window.addEventListener('languageChanged', function(event) {
        const selectedLanguage = event.detail.language;
        translateLegalTablesPage(selectedLanguage);
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/user-legal-tables.blade.php ENDPATH**/ ?>