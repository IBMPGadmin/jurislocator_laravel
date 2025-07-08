

<?php $__env->startPush('styles'); ?>
<style>
    /* Client selection dropdown styling */
    .client-selector {
        background-color: #fff;
        border-radius: 6px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .client-selector label {
        font-weight: 500;
        margin-bottom: 10px;
        display: block;
    }
    
    .client-selector select {
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background-color: #f9f9f9;
    }

    /* Save context selector styling */
    .save-context-selector {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: auto;
    }
    
    .save-context-selector label {
        font-size: 14px;
        font-weight: 500;
        margin: 0;
    }
    
    .save-context-selector select {
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        font-size: 14px;
    }

    /* Droppable area styling */
    .droppable-container {
        min-height: 150px;
        border: 2px dashed #ddd !important;
        transition: all 0.3s ease;
        background-color: #fafafa;
    }
    
    .droppable-container.drag-over {
        border-color: #007bff !important;
        background-color: #f0f8ff;
        transform: scale(1.02);
    }
    
    .drop-placeholder {
        color: #999;
        font-style: italic;
    }
    
    .dropped-item {
        cursor: move;
        transition: all 0.2s ease;
    }
    
    .dropped-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    
    /* Make legal table tiles appear draggable */
    .toggle-tile-content[draggable="true"] {
        cursor: grab;
        transition: all 0.2s ease;
    }
    
    .toggle-tile-content[draggable="true"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .toggle-tile-content[draggable="true"]:active {
        cursor: grabbing;
        transform: scale(0.98);
    }
        background-color: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .droppable-container:hover {
        border-color: #d68c2c;
        background-color: #fff8f0;
    }
    
    .drop-placeholder {
        color: #6c757d;
        text-align: center;
    }
    
    .drop-placeholder i {
        font-size: 2rem;
        color: #d68c2c;
    }

    /* Text editor styling */
    #contentEditor {
        min-height: 200px;
        border-radius: 6px;
        border: 1px solid #ddd;
        padding: 15px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        resize: vertical;
    }

    /* Button styling */
    .btn-action {
        background-color: #d68c2c;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }
    
    .btn-action:hover {
        background-color: #c07a26;
        color: white;
    }

    /* Override any existing styles from style.css and ensure consistent layout */
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
    }
    
    /* New List View Styles - Card Layout */
    .act-content.list-view {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Overall container style to match the design */
    .act-content.list-view {
        background-color: white !important;
        border-radius: 4px !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        overflow: hidden !important;
    }
    
    .toggle-tile-body.list {
        margin-bottom: 10px !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        overflow: hidden !important;
        background-color: #f8f9fa !important; /* Light gray background */
        padding: 15px !important;
    }
    
    /* Add alternating row backgrounds */
    .toggle-tile-body.list:nth-child(even) {
        background-color: #f8f9fa !important;
    }
    
    .toggle-tile-body.list:nth-child(odd) {
        background-color: white !important;
    }
    
    /* Main card content styles */
    .toggle-tile-body.list .toggle-tile-content {
        padding: 0 !important;
        min-height: auto !important;
        display: flex !important;
        flex-direction: column !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        border: none !important;
        background-color: transparent !important;
    }
    
    /* Document title styles - Aligned left */
    .toggle-tile-body.list .toggle-tile-content h4 {
        display: flex !important;
        align-items: center !important;
        margin: 0 0 5px 0 !important;
        padding: 0 !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        color: #333 !important;
        border: none !important;
        background-color: transparent !important;
        text-align: left !important;
        justify-content: flex-start !important; /* Force left alignment */
        width: 100% !important;
        min-height: 24px !important; /* Ensure consistent height */
    }
    
    /* Consistent header styles in grid view too - Left aligned with book icon */
    .toggle-tile-body.grid .toggle-tile-content h4 {
        display: flex !important;
        align-items: center !important;
        margin: 0 0 10px 0 !important;
        padding: 0 !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        color: #333 !important;
        border: none !important;
        background-color: transparent !important;
        text-align: left !important;
        justify-content: flex-start !important; /* Force left alignment */
        width: 100% !important;
        min-height: 24px !important;
    }
    
    /* Ensure icons always display correctly */
    .toggle-tile-body.list .toggle-tile-content h4 i,
    .toggle-tile-body.list .toggle-tile-content h4 i.fa-book,
    .toggle-tile-body.list .toggle-tile-content h4 i.act-icon,
    .toggle-tile-body.grid .toggle-tile-content h4 i,
    .toggle-tile-body.grid .toggle-tile-content h4 i.fa-book,
    .toggle-tile-body.grid .toggle-tile-content h4 i.act-icon {
        color: #d68c2c !important;
        margin-right: 10px !important;
        font-size: 14px !important;
        flex-shrink: 0 !important;
        width: 25px !important;
        text-align: center !important;
        display: inline-block !important;
        vertical-align: middle !important;
    }
    
    /* Ensure title text aligns properly */
    .toggle-tile-body.list .toggle-tile-content h4 span,
    .toggle-tile-body.list .toggle-tile-content h4 strong,
    .toggle-tile-body.list .toggle-tile-content h4 a {
        display: inline-block !important;
        vertical-align: middle !important;
    }
    
    /* Act data container in list view - Single row layout */
    .toggle-tile-body.list .toggle-tile-content .act-data {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important; /* Prevent wrapping to keep all in one line */
        align-items: center !important;
        justify-content: flex-start !important;
        gap: 25px !important; /* Consistent horizontal spacing */
        padding: 0 0 0 25px !important; /* Left padding to align with document title icon */
        width: 100% !important;
        background-color: transparent !important;
        overflow-x: auto !important; /* Allow horizontal scrolling if needed */
        scrollbar-width: thin !important; /* For Firefox */
        -ms-overflow-style: none !important; /* For IE and Edge */
    }
    
    /* Hide scrollbar for Chrome, Safari and Opera */
    .toggle-tile-body.list .toggle-tile-content .act-data::-webkit-scrollbar {
        height: 3px !important;
    }
    
    /* Each metadata item in the list */
    .toggle-tile-body.list .toggle-tile-content .act-data li {
        display: flex !important;
        align-items: center !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        width: auto !important;
        flex: 0 0 auto !important;
        white-space: nowrap !important;
        font-size: 13px !important;
        color: #666 !important;
    }
    
    /* Styling for metadata items */
    .toggle-tile-body.list .toggle-tile-content .act-data li span {
        margin-left: 0 !important;
        color: #666 !important;
        font-weight: normal !important;
    }
    
    /* View document button */
    .toggle-tile-body.list .toggle-tile-content .act-data li.view-button {
        margin-left: auto !important;
        border: none !important; /* Prevent any border from appearing */
        background: none !important; /* Ensure no background */
    }
    
    .toggle-tile-body.list .toggle-tile-content .act-data li.view-button a {
        color: #d68c2c !important; /* Match the document icon color */
        font-weight: 500 !important;
        display: flex !important;
        align-items: center !important;
        text-decoration: none !important;
        border: none !important; /* Prevent any border from appearing */
        background: none !important; /* Ensure no background */
    }
    
    .toggle-tile-body.list .toggle-tile-content .act-data li.view-button a i {
        color: #d68c2c !important; /* Match the document icon color */
        margin-left: 6px !important;
        margin-right: 0 !important;
        font-size: 14px !important;
        transition: transform 0.2s !important;
    }
    
    .toggle-tile-body.list .toggle-tile-content .act-data li.view-button a:hover {
        color: #e67e22 !important;
        text-decoration: none !important; /* Prevent any underline */
        border: none !important; /* Prevent any border from appearing */
        background: none !important; /* Ensure no background */
    }
    
    .toggle-tile-body.list .toggle-tile-content .act-data li.view-button a:hover i {
        transform: translateX(3px) !important;
    }
    
    /* Additional rule to prevent any underline or border on the strong element */
    .toggle-tile-body.list .toggle-tile-content .act-data li.view-button a strong {
        border: none !important;
        text-decoration: none !important;
    }
    
    /* Strong tags in list items */
    .toggle-tile-body.list .toggle-tile-content .act-data li strong {
        font-weight: 500 !important;
        color: #333 !important;
        margin-right: 0 !important;
    }
    
    /* Reset any hidden styles for the act-data list items */
    .toggle-tile-body .toggle-tile-content .act-data li,
    .toggle-tile-body.grid .toggle-tile-content .act-data li,
    .toggle-tile-body.list .toggle-tile-content .act-data li,
    .toggle-tile-content ul.act-data li,
    ul.act-data li,
    .act-data li {
        visibility: visible !important;
        opacity: 1 !important;
        height: auto !important;
        overflow: visible !important;
    }
    
    /* No duplicate styles needed here - removed redundant definitions */
    
    /* Clean view of category label and value */
    .toggle-tile-body.list .toggle-tile-content .act-data li.act-category strong,
    .toggle-tile-body.list .toggle-tile-content .act-data li.act-law strong,
    .toggle-tile-body.list .toggle-tile-content .act-data li.act-jurisdiction strong,
    .toggle-tile-body.list .toggle-tile-content .act-data li.act-language strong,
    .toggle-tile-body.list .toggle-tile-content .act-data li.act-description strong {
        color: #555 !important;
        font-weight: 500 !important;
    }
    
    /* Widget title style */
    .widget-title h5 {
        font-size: 20px !important;
        font-weight: 500 !important;
        color: #333 !important;
    }
    
    /* Ensure consistent header styles in all views */
    .toggle-tile-body.list .toggle-tile-content h4 {
        display: flex !important;
        align-items: center !important;
        justify-content: flex-start !important;
        text-align: left !important;
        width: 100% !important;
        margin-bottom: 10px !important;
    }
    
    /* Push View Document button to right side */
    .toggle-tile-body.list .toggle-tile-content .act-data li.view-button {
        margin-left: auto !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content container-fluid">
    <div class="row sec-title title-default px-4">
        <div class="col-12">
            <h2>Legal Documents Browser</h2>
        </div>
    </div>
    
    <!-- Client Selection Area - Shows only if no client is selected -->
    <?php if(!isset($client) || !$client): ?>
    <div class="row gap_top">
        <div class="col-12 mb-4">
            <div class="client-selector">
                <form method="GET" id="clientSelectForm">
                    <label for="client_selector">Select Client</label>
                    <select name="client_id" id="client_selector" class="form-control form-select">
                        <option value="">-- Select a client --</option>
                        <?php $__currentLoopData = $allClients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($clientOption->id); ?>"><?php echo e($clientOption->client_name); ?> (<?php echo e($clientOption->client_email); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Client Details Area - Shows only if client is selected -->
    <?php if(isset($client) && $client): ?>
            <div class="bg_custom p-4 rounded shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="client-avatar me-4 d-flex justify-content-center align-items-center rounded-circle bg-light text-primary" style="width: 60px; height: 60px; font-size: 24px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="client-info flex-grow-1">
                        <h4 class="mb-2">Client Details</h4>
                        <div class="d-flex flex-wrap">
                            <div class="me-4 mb-2">
                                <span class="d-flex align-items-center">
                                    <strong>Name:</strong>&nbsp;<?php echo e($client->client_name ?? '-'); ?>

                                </span>
                            </div>
                            <div class="mb-2">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-envelope me-2 text-secondary"></i>
                                    <strong>Email:</strong>&nbsp;<?php echo e($client->client_email ?? '-'); ?>

                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="row p-4 rounded shadow-sm">
        <div class="col-12">
            <div class="widget sp-top widget-blank widget-form widget-vertical shadow-sm">
                <div class="widget-title">
                    <h5>Search Legislations</h5>
                </div>
                <div class="widget-body sp-top-dbl">
                    <form method="GET" action="<?php echo e(isset($client) && $client ? route('user.client.legal-tables', $client->id) : route('client.management')); ?>" id="filterForm" class="row form vertical-form">
                        <?php if(isset($client) && $client): ?>
                            <input type="hidden" name="client_id" value="<?php echo e($client->id); ?>">
                        <?php endif; ?>
                        <div class="row m-0">
                            <!-- Always visible (Simple Search) -->
                            <div class="col-lg-4 form-group mb-3">
                                <label for="keyword" class="form-label">Search by Keyword</label>
                                <div class="input-group">
                                    <input type="text" name="search" id="keyword" class="form-control" 
                                           placeholder="Legal Act, Regulation.." 
                                           value="<?php echo e(request('search')); ?>">
                                    <button class="btn btn-neutral" type="button" id="quickSearchBtn">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label for="law_id" class="form-label">Select Law Subject</label>
                                <select name="law_id" id="law_id" class="form-control form-select">
                                    <option value="">Subject</option>
                                    <option value="1" <?php echo e(request('law_id') == '1' ? 'selected' : ''); ?>>Immigration</option>
                                    <option value="2" <?php echo e(request('law_id') == '2' ? 'selected' : ''); ?>>Citizenship</option>
                                    <option value="3" <?php echo e(request('law_id') == '3' ? 'selected' : ''); ?>>Criminal</option>
                                </select>
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <div class="form-group">
                                    <label for="jurisdiction_id" class="form-label">Select Jurisdiction</label>
                                    <select name="jurisdiction_id" id="jurisdiction_id" class="form-control form-select">
                                        <option value="">Select Jurisdiction</option>
                                        <option value="1" <?php echo e(request('jurisdiction_id') == '1' ? 'selected' : ''); ?>>Federal</option>
                                        <optgroup label="Provincial">
                                            <option value="2" <?php echo e(request('jurisdiction_id') == '2' ? 'selected' : ''); ?>>Alberta</option>
                                            <option value="3" <?php echo e(request('jurisdiction_id') == '3' ? 'selected' : ''); ?>>British Columbia</option>
                                            <option value="4" <?php echo e(request('jurisdiction_id') == '4' ? 'selected' : ''); ?>>Manitoba</option>
                                            <option value="5" <?php echo e(request('jurisdiction_id') == '5' ? 'selected' : ''); ?>>New Brunswick</option>
                                            <option value="6" <?php echo e(request('jurisdiction_id') == '6' ? 'selected' : ''); ?>>Newfoundland & Labarador</option>
                                            <option value="7" <?php echo e(request('jurisdiction_id') == '7' ? 'selected' : ''); ?>>Nova Scotia</option>
                                            <option value="8" <?php echo e(request('jurisdiction_id') == '8' ? 'selected' : ''); ?>>Ontario</option>
                                            <option value="9" <?php echo e(request('jurisdiction_id') == '9' ? 'selected' : ''); ?>>Price Edward Island</option>
                                            <option value="10" <?php echo e(request('jurisdiction_id') == '10' ? 'selected' : ''); ?>>Quebec</option>
                                            <option value="11" <?php echo e(request('jurisdiction_id') == '11' ? 'selected' : ''); ?>>Saskatchewan</option>
                                        </optgroup>
                                        <optgroup label="Territorial">
                                            <option value="12" <?php echo e(request('jurisdiction_id') == '12' ? 'selected' : ''); ?>>Nortwest Territories</option>
                                            <option value="13" <?php echo e(request('jurisdiction_id') == '13' ? 'selected' : ''); ?>>Nunavut</option>
                                            <option value="14" <?php echo e(request('jurisdiction_id') == '14' ? 'selected' : ''); ?>>Yukon</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label for="act_id" class="form-label">Select Docs Category</label>
                                <select name="act_id" id="act_id" class="form-control form-select">
                                    <option value="">Category</option>
                                    <option value="1" <?php echo e(request('act_id') == '1' ? 'selected' : ''); ?>>Acts</option>
                                    <option value="2" <?php echo e(request('act_id') == '2' ? 'selected' : ''); ?>>Appeal & Review Processes</option>
                                    <option value="3" <?php echo e(request('act_id') == '3' ? 'selected' : ''); ?>>CaseLaw</option>
                                    <option value="4" <?php echo e(request('act_id') == '4' ? 'selected' : ''); ?>>Codes</option>
                                    <option value="5" <?php echo e(request('act_id') == '5' ? 'selected' : ''); ?>>Enforcement</option>
                                    <option value="6" <?php echo e(request('act_id') == '6' ? 'selected' : ''); ?>>Forms</option>
                                    <option value="7" <?php echo e(request('act_id') == '7' ? 'selected' : ''); ?>>Guidelines</option>
                                    <option value="8" <?php echo e(request('act_id') == '8' ? 'selected' : ''); ?>>Agreements</option>
                                    <option value="9" <?php echo e(request('act_id') == '9' ? 'selected' : ''); ?>>Ministerial Instructions</option>
                                    <option value="10" <?php echo e(request('act_id') == '10' ? 'selected' : ''); ?>>Operational Bulletins</option>
                                    <option value="11" <?php echo e(request('act_id') == '11' ? 'selected' : ''); ?>>Policies</option>
                                    <option value="12" <?php echo e(request('act_id') == '12' ? 'selected' : ''); ?>>Procedures</option>
                                    <option value="13" <?php echo e(request('act_id') == '13' ? 'selected' : ''); ?>>Regulations</option>
                                </select>
                            </div>
                            <div class="col-lg-4 form-group mb-3">
                                <label for="language_id" class="form-label">Select Language</label>
                                <select name="language_id" id="language_id" class="form-control form-select">
                                    <option value="">Language</option>
                                    <option value="1" <?php echo e(request('language_id') == '1' ? 'selected' : ''); ?>>English</option>
                                    <option value="2" <?php echo e(request('language_id') == '2' ? 'selected' : ''); ?>>French</option>
                                    <option value="3" <?php echo e(request('language_id') == '3' ? 'selected' : ''); ?>>Bilingual</option>
                                </select>
                            </div>
                            <div class="col-lg-4 form-group mb-3 d-flex justify-content-start align-items-start flex-column text-end">
                                <div class="mt-auto">
                                    <button type="button" class="btn btn-neutral me-2" id="reset" onclick="resetForm()">
                                        <span>Reset</span>
                                    </button>
                                    <button type="submit" class="btn btn-action" id="search">
                                        <span>Search</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="widget sp-top widget-blank widget-form widget-vertical shadow-sm">
                <div class="widget-title with-filters">
                    <h5>Available Legislations</h5>
                    <div class="widget-filters">
                        <div class="single-filter">
                            <span class="toggle-label">Select from </span>
                            <span id="act-pagination-toggle" class="letter-toggle"> A to Z</span>
                        </div>
                        <div class="single-filter">
                            <span class="toggle-label">Language </span>
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
                            <span class="toggle-label">View </span>
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
                                     data-table-name="<?php echo e($row->table_name ?? 'unknown'); ?>"
                                     data-act-id="<?php echo e($row->act_id ?? '1'); ?>"
                                     data-client-id="<?php echo e(isset($client) && $client ? $client->id : ''); ?>"
                                     data-language-id="<?php echo e($row->language_id ?? '1'); ?>">
                                    <!-- Single header with book icon for all card views -->
                                    <h4><i class="fas fa-book act-icon"></i> <?php echo e($row->act_name ?? 'Unknown Act'); ?></h4>
                                    
                                    <ul class="act-data">
                                        <li class="act-category"><strong>Category: </strong><span><?php echo e($acts[$row->act_id ?? 1] ?? 'Acts'); ?></span></li>
                                        <li class="act-law"><strong>Law Subject: </strong><span><?php echo e($lawSubjects[$row->law_id ?? 1] ?? 'N/A'); ?></span></li>
                                        <li class="act-jurisdiction"><strong>Jurisdiction: </strong><span><?php echo e($jurisdictions[$row->jurisdiction_id ?? 1] ?? 'Federal'); ?></span></li>
                                        <li class="act-language"><strong>Language: </strong><span><?php echo e($languages[$row->language_id ?? 1] ?? 'English'); ?></span></li>
                                        <li class="act-description"><strong>Created: </strong><span><?php echo e($row->created_at ? date('Y-m-d', strtotime($row->created_at)) : date('Y-m-d')); ?></span></li>
                                        <?php if(isset($client) && $client): ?>
                                            <li class="view-button"><a href="javascript:void(0)" onclick="redirectToDocument('<?php echo e($row->table_name); ?>', '<?php echo e($row->act_id); ?>', '<?php echo e(isset($client) && $client ? $client->id : "null"); ?>', '<?php echo e($row->language_id); ?>')"><strong>View Document</strong> <i class="fas fa-arrow-right"></i></a></li>
                                        <?php else: ?>
                                            <li class="view-button"><a href="javascript:void(0)" onclick="alert('Please select a client first to view documents.')" style="color: #999;"><strong>Select Client First</strong> <i class="fas fa-lock"></i></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="col-12 no-results">
                                <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                                <p>No legal acts found matching your search criteria.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Content Editor and Droppable Area - Always available -->
            <div class="widget sp-top widget-blank widget-vertical shadow-sm">
                <div class="widget-title d-flex align-items-center">
                    <h5>Notes and Content</h5>
                    
                    <!-- Context selector for saving -->
                    <div class="save-context-selector">
                        <label>Save under:</label>
                        <select id="saveContext" class="form-select form-select-sm">
                            <option value="user" <?php echo e(!isset($client) || !$client ? 'selected' : ''); ?>>User Only</option>
                            <?php if(isset($client) && $client): ?>
                            <option value="client" selected>Client Specific</option>
                            <?php else: ?>
                            <option value="client" disabled>Client Specific (Select a client first)</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="widget-body">
                    <!-- Droppable area -->
                    <div id="droppableArea" class="droppable-container p-3 border rounded mb-4">
                        <?php if(isset($savedContent) && $savedContent && $savedContent->droppable_content): ?>
                            <?php echo $savedContent->droppable_content; ?>

                        <?php else: ?>
                            <div class="text-center p-5 drop-placeholder">
                                <i class="fas fa-arrow-down mb-2"></i>
                                <p>Drop content here</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Save Popups button -->
                    <div class="text-end mb-3">
                        <button id="savePopups" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-save me-1"></i>
                            <span>Save Popups</span>
                        </button>
                    </div>
                    
                    <!-- Text editor -->
                    <div id="textEditorContainer">
                        <textarea id="contentEditor" class="form-control" placeholder="Enter your notes and content here..."><?php echo e(isset($savedContent) && $savedContent ? $savedContent->editor_content : ''); ?></textarea>
                    </div>
                    
                    <!-- Save button -->
                    <div class="text-end mt-3">
                        <button id="saveContent" class="btn btn-action">
                            <span>Save Content</span>
                        </button>
                    </div>
                    
                    <!-- Context information -->
                    <?php if(isset($client) && $client): ?>
                        <div class="text-muted small mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            <span>Content can be saved for your personal use or specifically for this client.</span>
                        </div>
                    <?php else: ?>
                        <div class="text-muted small mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            <span>Content will be saved for your personal use. Select a client above to enable client-specific saving.</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popup Save Choice Modal -->
<div class="modal fade" id="popupSaveModal" tabindex="-1" aria-labelledby="popupSaveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupSaveModalLabel">
                    <i class="fas fa-save me-2"></i>
                    <span>Save Popups</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Where would you like to save these popups?</p>
                <div class="d-grid gap-3">
                    <button type="button" class="btn btn-outline-primary btn-lg" id="saveToUserRecords">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user me-3" style="font-size: 1.5rem;"></i>
                            <div class="text-start">
                                <div class="fw-bold">Save to Your Records</div>
                                <small class="text-muted">Personal use only - accessible across all clients</small>
                            </div>
                        </div>
                    </button>
                    
                    <?php if(isset($client) && $client): ?>
                    <button type="button" class="btn btn-outline-success btn-lg" id="saveToClientRecords">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-tie me-3" style="font-size: 1.5rem;"></i>
                            <div class="text-start">
                                <div class="fw-bold">Save to Client Records</div>
                                <small class="text-muted">Specific to <?php echo e($client->client_name); ?> - only visible when this client is selected</small>
                            </div>
                        </div>
                    </button>
                    <?php else: ?>
                    <button type="button" class="btn btn-outline-secondary btn-lg" disabled>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-tie me-3" style="font-size: 1.5rem;"></i>
                            <div class="text-start">
                                <div class="fw-bold">Save to Client Records</div>
                                <small class="text-muted">Select a client first to enable this option</small>
                            </div>
                        </div>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <span>Cancel</span>
                </button>
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
                    <a href="#0" id="info" class="error-toggle shadow-sm">Report a problem or mistake on this page<i class="fas fa-arrow-right"></i></a>
                    <div class="popup2" role="alert" id="errorPopup">
                        <div class="popup-container shadow-sm">
                            <a href="#0" class="popup-close" id="popupCloseBtn" title="Close popup">&times;</a>
                            <h4 class="popup-title m-0">Report a Problem or Mistake</h4>
                            <form class="errorForm" id="errorReportForm">
                                <div class="form-group mb-3 text-start">
                                    <label for="errorPage" class="form-label">Page/Section</label>
                                    <input type="text" class="form-control" id="errorPage" name="errorPage" placeholder="E.g., Dashboard > Client List">
                                </div>
                                <div class="form-group mb-3 text-start">
                                    <label for="errorMessage" class="form-label">Describe the Issue</label>
                                    <textarea class="form-control" id="errorMessage" name="errorMessage" rows="4" placeholder="Please describe what went wrong..."></textarea>
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-neutral" id="popupCancelBtn">Cancel</button>
                                    <button type="submit" class="btn btn-action">Submit</button>
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
        // Client selection handler
        const clientSelector = document.getElementById('client_selector');
        if (clientSelector) {
            clientSelector.addEventListener('change', function() {
                const clientId = this.value;
                if (clientId) {
                    // Redirect to client management with client parameter
                    window.location.href = '/client-management?client_id=' + clientId;
                } else {
                    // Redirect to user-centric mode
                    window.location.href = '/client-management';
                }
            });
        }
        
        // Save content handler
        const saveContentBtn = document.getElementById('saveContent');
        if (saveContentBtn) {
            saveContentBtn.addEventListener('click', function() {
                const saveContext = document.getElementById('saveContext').value;
                const editorContent = document.getElementById('contentEditor').value;
                const droppableContent = document.getElementById('droppableArea').innerHTML;
                const clientId = <?php echo e(isset($client) && $client ? $client->id : 'null'); ?>;
                
                // Validate save context
                if (saveContext === 'client' && !clientId) {
                    alert('Please select a client first to save content under client context.');
                    return;
                }
                
                // Show loading state
                this.disabled = true;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
                
                fetch('/save-content', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        context: saveContext,
                        editor_content: editorContent,
                        droppable_content: droppableContent,
                        client_id: clientId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Content saved successfully!');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error saving content. Please try again.');
                })
                .finally(() => {
                    // Reset button state
                    this.disabled = false;
                    this.innerHTML = '<span data-en="Save Content" data-fr="Enregistrer le contenu">Save Content</span>';
                });
            });
        }
        
        // Save popups handler
        const savePopupsBtn = document.getElementById('savePopups');
        if (savePopupsBtn) {
            savePopupsBtn.addEventListener('click', function() {
                // Extract popups from droppable area
                const droppableArea = document.getElementById('droppableArea');
                const droppedItems = droppableArea.querySelectorAll('.dropped-item');
                
                if (droppedItems.length === 0) {
                    alert('No popups to save. Please drag some legal document tiles to the droppable area first.');
                    return;
                }
                
                // Show the choice modal
                const modal = new bootstrap.Modal(document.getElementById('popupSaveModal'));
                modal.show();
            });
        }
        
        // Handle save to user records
        const saveToUserBtn = document.getElementById('saveToUserRecords');
        if (saveToUserBtn) {
            saveToUserBtn.addEventListener('click', function() {
                savePopupsData('user');
            });
        }
        
        // Handle save to client records
        const saveToClientBtn = document.getElementById('saveToClientRecords');
        if (saveToClientBtn) {
            saveToClientBtn.addEventListener('click', function() {
                const clientId = <?php echo e(isset($client) && $client ? $client->id : 'null'); ?>;
                if (!clientId) {
                    alert('Please select a client first.');
                    return;
                }
                savePopupsData('client', clientId);
            });
        }
        
        // Function to save popups data
        function savePopupsData(saveType, clientId = null) {
            const droppableArea = document.getElementById('droppableArea');
            const droppedItems = droppableArea.querySelectorAll('.dropped-item');
            
            // Extract popup data from dropped items
            const popups = [];
            droppedItems.forEach(item => {
                // Try to extract data from the dropped content
                const actData = item.querySelector('.act-data');
                if (actData) {
                    const listItems = actData.querySelectorAll('li');
                    const popupData = {
                        section_id: item.dataset.sectionId || 'unknown',
                        category_id: parseInt(item.dataset.categoryId) || 1,
                        part: item.dataset.part || null,
                        division: item.dataset.division || null,
                        popup_title: item.querySelector('h4') ? item.querySelector('h4').textContent.trim() : 'Legal Document',
                        popup_content: item.innerHTML,
                        section_title: item.querySelector('h4') ? item.querySelector('h4').textContent.trim() : null,
                        table_name: item.dataset.tableName || null
                    };
                    popups.push(popupData);
                }
            });
            
            if (popups.length === 0) {
                alert('No valid popup data found.');
                return;
            }
            
            // Show loading state
            const modal = document.getElementById('popupSaveModal');
            const buttons = modal.querySelectorAll('button');
            buttons.forEach(btn => btn.disabled = true);
            
            // Save the popups
            fetch('/save-popups', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                },
                body: JSON.stringify({
                    save_type: saveType,
                    client_id: clientId,
                    popups: popups
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Close modal
                    bootstrap.Modal.getInstance(modal).hide();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving popups. Please try again.');
            })
            .finally(() => {
                // Reset button states
                buttons.forEach(btn => btn.disabled = false);
            });
        }
        
        // Set up drag and drop functionality for legal tables
        const droppableArea = document.getElementById('droppableArea');
        if (droppableArea) {
            // Make legal table tiles draggable
            const setupDragAndDrop = () => {
                const tableTiles = document.querySelectorAll('.toggle-tile-content');
                tableTiles.forEach(tile => {
                    tile.draggable = true;
                    tile.addEventListener('dragstart', function(e) {
                        const tileContent = this.cloneNode(true);
                        
                        // Store additional data for popup saving
                        const tileData = {
                            html: tileContent.outerHTML,
                            sectionId: this.dataset.sectionId || 'unknown',
                            categoryId: this.dataset.categoryId || this.dataset.actId || '1',
                            tableName: this.dataset.tableName || 'unknown',
                            part: this.dataset.part || null,
                            division: this.dataset.division || null
                        };
                        
                        e.dataTransfer.setData('text/html', tileContent.outerHTML);
                        e.dataTransfer.setData('application/json', JSON.stringify(tileData));
                        e.dataTransfer.effectAllowed = 'copy';
                    });
                });
            };
            
            // Set up droppable area event handlers
            droppableArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'copy';
                this.classList.add('drag-over');
            });
            
            droppableArea.addEventListener('dragleave', function(e) {
                this.classList.remove('drag-over');
            });
            
            droppableArea.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                
                const htmlContent = e.dataTransfer.getData('text/html');
                const tileDataJson = e.dataTransfer.getData('application/json');
                
                if (htmlContent) {
                    // Remove the placeholder if it exists
                    const placeholder = this.querySelector('.drop-placeholder');
                    if (placeholder) {
                        placeholder.remove();
                    }
                    
                    // Parse tile data if available
                    let tileData = {};
                    try {
                        tileData = JSON.parse(tileDataJson) || {};
                    } catch (e) {
                        console.warn('Could not parse tile data:', e);
                    }
                    
                    // Create a wrapper for the dropped content
                    const droppedItem = document.createElement('div');
                    droppedItem.className = 'dropped-item mb-3 p-3 border rounded bg-light position-relative';
                    
                    // Store data attributes for popup saving
                    droppedItem.dataset.sectionId = tileData.sectionId || 'unknown';
                    droppedItem.dataset.categoryId = tileData.categoryId || '1';
                    droppedItem.dataset.tableName = tileData.tableName || 'unknown';
                    if (tileData.part) droppedItem.dataset.part = tileData.part;
                    if (tileData.division) droppedItem.dataset.division = tileData.division;
                    
                    droppedItem.innerHTML = htmlContent + '<button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.parentElement.remove()"></button>';
                    
                    this.appendChild(droppedItem);
                }
            });
            
            // Initialize drag and drop on page load
            setupDragAndDrop();
            
            // Re-initialize drag and drop when content changes (for dynamically loaded content)
            const observer = new MutationObserver(() => {
                setupDragAndDrop();
            });
            
            observer.observe(document.querySelector('.act-content'), {
                childList: true,
                subtree: true
            });
        }
        
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
                    
                    // Check if we need to add the header with book icon
                    const existingHeader = card.querySelector('h4');
                    if (!existingHeader) {
                        // Get the title from data attributes or use a default
                        const title = card.getAttribute('data-en') || card.getAttribute('data-fr') || 'Legal Document';
                        
                        // Create the header with book icon
                        const header = document.createElement('h4');
                        header.innerHTML = `<i class="fas fa-book act-icon"></i> ${title}`;
                        header.style.display = 'flex';
                        header.style.alignItems = 'center';
                        header.style.justifyContent = 'flex-start';
                        header.style.textAlign = 'left';
                        header.style.width = '100%';
                        
                        // Add the header to the card before the data
                        card.appendChild(header);
                    }
                    
                    // Create the missing act-data element
                    const newActData = document.createElement('ul');
                    newActData.className = 'act-data';
                    
                    // Add some basic content with appropriate classes
                    newActData.innerHTML = `
                        <li class="act-category"><strong>Category: </strong><span>Acts</span></li>
                        <li class="act-law"><strong>Law Subject: </strong><span>General</span></li>
                        <li class="act-jurisdiction"><strong>Jurisdiction: </strong><span>Federal</span></li>
                        <li class="act-language"><strong>Language: </strong><span>English</span></li>
                        <li class="act-description"><strong>Created: </strong><span>${new Date().toISOString().split('T')[0]}</span></li>
                        <li class="view-button"><a href="javascript:void(0)"><strong>View Document</strong> <i class="fas fa-arrow-right"></i></a></li>
                    `;
                    
                    // Remove any text nodes between header and new act-data element
                    const header = card.querySelector('h4');
                    if (header) {
                        let currentNode = header.nextSibling;
                        while (currentNode) {
                            const nextNode = currentNode.nextSibling;
                            // If it's a text node with content, remove it to prevent duplicate titles
                            if (currentNode.nodeType === 3 && currentNode.textContent.trim()) {
                                console.log(`Removing duplicate title text during emergency card creation: "${currentNode.textContent.trim()}"`);
                                currentNode.remove();
                            }
                            currentNode = nextNode;
                        }
                    }
                    
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
                const card = cardData.card;
                
                // First, check for duplicate headers and remove them
                const headers = card.querySelectorAll('h4');
                if (headers.length > 1) {
                    console.log(`🔧 Found ${headers.length} headers in card ${index}, removing duplicates`);
                    // Keep only the first header
                    for (let i = 1; i < headers.length; i++) {
                        headers[i].remove();
                    }
                }
                
                // Then ensure the header exists and is properly formatted
                const header = card.querySelector('h4');
                if (!header) {
                    // Get the title from data attributes or use a default
                    const title = card.getAttribute('data-en') || card.getAttribute('data-fr') || 'Legal Document';
                    
                    // Create the header with book icon
                    const newHeader = document.createElement('h4');
                    newHeader.innerHTML = `<i class="fas fa-book act-icon"></i> ${title}`;
                    newHeader.style.display = 'flex';
                    newHeader.style.alignItems = 'center';
                    newHeader.style.justifyContent = 'flex-start';
                    newHeader.style.textAlign = 'left';
                    newHeader.style.width = '100%';
                    
                    // Add the header to the beginning of the card
                    card.prepend(newHeader);
                    console.log(`🔧 Added missing header for card ${index}`);
                }
                
                // Clean up any text nodes between header and act-data
                // This fixes the duplicate title issue (e.g. "French IRPA" appearing twice)
                const currentHeader = card.querySelector('h4');
                const actData = card.querySelector('.act-data');
                if (currentHeader && actData) {
                    let currentNode = currentHeader.nextSibling;
                    let removedNodes = 0;
                    while (currentNode && currentNode !== actData) {
                        const nextNode = currentNode.nextSibling;
                        // If it's a text node with non-whitespace content, remove it
                        if (currentNode.nodeType === 3 && currentNode.textContent.trim()) {
                            console.log(`🔧 Removing duplicate title text: "${currentNode.textContent.trim()}" in card ${index}`);
                            currentNode.remove();
                            removedNodes++;
                        }
                        currentNode = nextNode;
                    }
                    if (removedNodes > 0) {
                        console.log(`🔧 Removed ${removedNodes} duplicate text nodes between header and act-data in card ${index}`);
                    }
                }
                
                // Then check if act-data exists
                const currentActData = card.querySelector('.act-data');
                if (!currentActData) {
                    console.log(`🔧 Restoring missing act-data for card ${index}`);
                    card.insertAdjacentHTML('beforeend', cardData.html);
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
        // Check if the language indicates French (2, fr, or French)
        const isFrench = (language === '2' || language === 2 || language === 'fr' || language === 'French');
        
        console.log('Redirecting to document:', {
            tableName,
            categoryId,
            clientId,
            language,
            isFrench
        });
        
        // Build URL with or without client_id
        let url;
        if (isFrench) {
            url = `/view-legal-table-french/${tableName}?category_id=${categoryId}`;
        } else {
            url = `/view-legal-table/${tableName}?category_id=${categoryId}`;
        }
        
        // Add client_id parameter only if client is selected
        if (clientId && clientId !== 'null' && clientId !== '') {
            url += `&client_id=${clientId}`;
        }
        
        window.location = url;
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
        
        // Check for list view and apply appropriate styling
        const container = document.getElementById('toggleTileContainer');
        const isListView = container && container.classList.contains('list-view');
        
        console.log('Cards found:', cards.length);
        console.log('Act data elements found:', actData.length);
        console.log('List items found:', listItems.length);
        console.log('Error messages found:', errorMessages.length);
        console.log('Is list view:', isListView);
        
        // Check and fix headers for all cards
        cards.forEach((card, index) => {
            const content = card.querySelector('.toggle-tile-content');
            if (content) {
                // First, look for all h4 headers and remove any duplicates
                const headers = content.querySelectorAll('h4');
                
                // If more than one header, keep only the first one and remove the rest
                if (headers.length > 1) {
                    console.log(`Found ${headers.length} headers in card ${index}, removing duplicates`);
                    for (let i = 1; i < headers.length; i++) {
                        headers[i].remove();
                    }
                }
                
                // Check if we still have a header after removing duplicates
                const header = content.querySelector('h4');
                if (!header) {
                    // Missing header, create one
                    console.log(`Missing header in card ${index}, adding it`);
                    const title = content.getAttribute('data-en') || content.getAttribute('data-fr') || 'Legal Document';
                    const newHeader = document.createElement('h4');
                    newHeader.innerHTML = `<i class="fas fa-book act-icon"></i> ${title}`;
                    content.prepend(newHeader);
                }
                
                // Check for and remove any text nodes between h4 and ul.act-data
                // This fixes the duplicate title issue (e.g., "French IRPA" text appearing twice)
                const actData = content.querySelector('.act-data');
                if (header && actData) {
                    // Get all nodes between header and act-data
                    let currentNode = header.nextSibling;
                    while (currentNode && currentNode !== actData) {
                        const nextNode = currentNode.nextSibling;
                        // If it's a text node with non-whitespace content, remove it
                        if (currentNode.nodeType === 3 && currentNode.textContent.trim()) {
                            console.log(`Removing duplicate text node: "${currentNode.textContent.trim()}" in card ${index}`);
                            currentNode.remove();
                        }
                        currentNode = nextNode;
                    }
                }

                // Ensure header is correctly styled
                const currentHeader = content.querySelector('h4');
                if (currentHeader) {
                    if (isListView) {
                        currentHeader.style.display = 'flex';
                        currentHeader.style.alignItems = 'center';
                        currentHeader.style.justifyContent = 'flex-start';
                        currentHeader.style.textAlign = 'left';
                        currentHeader.style.width = '100%';
                        
                        // Ensure header has book icon
                        if (!currentHeader.querySelector('.fa-book')) {
                            const title = currentHeader.textContent.trim();
                            currentHeader.innerHTML = `<i class="fas fa-book act-icon"></i> ${title}`;
                        }
                    } else {
                        // Grid view - use left aligned header with book icon for consistency
                        currentHeader.style.display = 'flex';
                        currentHeader.style.alignItems = 'center';
                        currentHeader.style.justifyContent = 'flex-start';
                        currentHeader.style.textAlign = 'left';
                        currentHeader.style.width = '100%';
                        
                        // Ensure header has book icon in grid view too
                        if (!currentHeader.querySelector('.fa-book')) {
                            const title = currentHeader.textContent.trim();
                            currentHeader.innerHTML = `<i class="fas fa-book act-icon"></i> ${title}`;
                        }
                    }
                }
            }
        });
        
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
            data.style.visibility = 'visible';
            data.style.opacity = '1';
            
            // Check if we're in list view
            if (isListView) {
                data.style.display = 'flex';
                data.style.flexDirection = 'row'; // Use row layout for horizontal display
                data.style.flexWrap = 'nowrap'; // Keep items in a single row
                data.style.alignItems = 'center';
                data.style.justifyContent = 'flex-start';
                data.style.gap = '25px'; // Consistent horizontal spacing
                data.style.padding = '0 0 0 25px'; // Left padding to align with document title icon
                data.style.backgroundColor = 'transparent';
                data.style.overflowX = 'auto'; // Allow horizontal scrolling if needed
                
                // Force all child li elements to display horizontally
                const listItems = data.querySelectorAll('li');
                listItems.forEach(item => {
                    item.style.display = 'flex';
                    item.style.width = 'auto';
                    item.style.whiteSpace = 'nowrap';
                    item.style.fontSize = '13px';
                    item.style.flexShrink = '0'; // Prevent items from shrinking
                    
                    // Remove any leftover icons from existing items
                    const icons = item.querySelectorAll('i:not(.fa-arrow-right)');
                    icons.forEach(icon => {
                        icon.remove();
                    });
                    
                    // Style the strong elements
                    const strong = item.querySelector('strong');
                    if (strong) {
                        strong.style.fontWeight = '500';
                        strong.style.color = '#555';
                    }
                    
                    if (item.classList.contains('view-button')) {
                        item.style.marginLeft = 'auto';
                    }
                });
            } else {
                data.style.display = 'block';
                data.style.padding = '10px';
            }
            
            // Try setProperty with error handling
            try {
                data.style.setProperty('visibility', 'visible', 'important');
                data.style.setProperty('opacity', '1', 'important');
                
                if (isListView) {
                    data.style.setProperty('display', 'flex', 'important');
                    data.style.setProperty('flex-direction', 'row', 'important'); // Force horizontal layout
                    data.style.setProperty('flex-wrap', 'nowrap', 'important'); // Keep items in a single row
                    data.style.setProperty('align-items', 'center', 'important');
                    data.style.setProperty('justify-content', 'flex-start', 'important');
                    data.style.setProperty('gap', '25px', 'important'); // Consistent horizontal spacing
                    data.style.setProperty('padding', '0 0 0 25px', 'important'); // Left padding
                    data.style.setProperty('background-color', 'transparent', 'important');
                    data.style.setProperty('overflow-x', 'auto', 'important'); // Allow horizontal scrolling if needed
                    
                    // Force all li elements inside to be horizontal
                    const listItems = data.querySelectorAll('li');
                    listItems.forEach(item => {
                        item.style.setProperty('display', 'flex', 'important');
                        item.style.setProperty('width', 'auto', 'important');
                        item.style.setProperty('white-space', 'nowrap', 'important');
                        item.style.setProperty('flex-shrink', '0', 'important'); // Prevent items from shrinking
                        
                        // Remove any leftover icons from existing items
                        const icons = item.querySelectorAll('i:not(.fa-arrow-right)');
                        icons.forEach(icon => {
                            icon.remove();
                        });
                        
                        if (item.classList.contains('view-button')) {
                            item.style.setProperty('margin-left', 'auto', 'important');
                        }
                    });
                } else {
                    data.style.setProperty('display', 'block', 'important');
                    data.style.setProperty('padding', '10px', 'important');
                }
            } catch (e) {
                console.log('⚠️ setProperty failed, using direct assignment');
            }
            
            console.log(`Act data ${index} forced visible with protection`);
        });
        
        listItems.forEach((item, index) => {
            // Use direct style setting
            item.style.visibility = 'visible';
            item.style.opacity = '1';
            
            if (isListView) {
                item.style.display = 'flex';
                item.style.alignItems = 'center';
                item.style.border = 'none';
                item.style.width = 'auto';
                item.style.margin = '0';
                item.style.whiteSpace = 'nowrap';
                
                // Push View Document button to the right
                if (item.classList.contains('view-button')) {
                    item.style.marginLeft = 'auto';
                }
            } else {
                item.style.display = 'block';
                item.style.width = '100%';
            }
            
            try {
                item.style.setProperty('visibility', 'visible', 'important');
                item.style.setProperty('opacity', '1', 'important');
                
                if (isListView) {
                    item.style.setProperty('display', 'flex', 'important');
                    item.style.setProperty('align-items', 'center', 'important');
                    item.style.setProperty('border', 'none', 'important');
                    item.style.setProperty('width', 'auto', 'important');
                    item.style.setProperty('margin', '0', 'important');
                    item.style.setProperty('white-space', 'nowrap', 'important');
                    
                    // Push View Document button to the right
                    if (item.classList.contains('view-button')) {
                        item.style.setProperty('margin-left', 'auto', 'important');
                    }
                } else {
                    item.style.setProperty('display', 'block', 'important');
                    item.style.setProperty('width', '100%', 'important');
                }
            } catch (e) {
                // Ignore setProperty errors
            }
        });
        
        console.log('=== DIAGNOSTICS COMPLETE ===');
    }

    // Function to load saved popups into the droppable area
    function loadSavedPopups() {
        const clientId = <?php echo e(isset($client) && $client ? $client->id : 'null'); ?>;
        
        // Determine context: if we have a client, load client-specific popups, otherwise load user personal popups
        const context = clientId ? 'client' : 'user';
        
        // Build the URL with appropriate parameters
        let url = '/get-saved-popups?context=' + context;
        if (clientId) {
            url += '&client_id=' + clientId;
        }
        
        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.popups && data.popups.length > 0) {
                console.log(`Loading ${data.popups.length} saved popups for ${context} context`);
                loadPopupsIntoDroppableArea(data.popups);
            } else {
                console.log(`No saved popups found for ${context} context`);
            }
        })
        .catch(error => {
            console.error('Error loading saved popups:', error);
        });
    }

    // Function to load popups into the droppable area
    function loadPopupsIntoDroppableArea(popups) {
        const droppableArea = document.getElementById('droppableArea');
        if (!droppableArea) {
            console.error('Droppable area not found');
            return;
        }

        // Remove the placeholder if it exists
        const placeholder = droppableArea.querySelector('.drop-placeholder');
        if (placeholder) {
            placeholder.remove();
        }

        // Add each popup to the droppable area
        popups.forEach(popup => {
            const droppedItem = document.createElement('div');
            droppedItem.className = 'dropped-item mb-3 p-3 border rounded bg-light position-relative';
            
            // Store data attributes for popup saving
            droppedItem.dataset.sectionId = popup.section_id || 'unknown';
            droppedItem.dataset.categoryId = popup.category_id || '1';
            droppedItem.dataset.tableName = popup.table_name || 'unknown';
            if (popup.part) droppedItem.dataset.part = popup.part;
            if (popup.division) droppedItem.dataset.division = popup.division;
            
            // Set the popup content with a close button
            droppedItem.innerHTML = popup.popup_content + '<button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="this.parentElement.remove()"></button>';
            
            droppableArea.appendChild(droppedItem);
        });

        console.log(`Loaded ${popups.length} popups into droppable area`);
    }

    // DOM ready handler
    document.addEventListener('DOMContentLoaded', function() {
        console.log('=== DOM CONTENT LOADED ===');
        
        // Initialize container with list view class
        const container = document.getElementById('toggleTileContainer');
        if (container) {
            container.classList.add('act-content', 'list-view');
            
            // Make sure headings are visible in list view
            const headings = container.querySelectorAll('.toggle-tile-content h4');
            headings.forEach(function(heading) {
                heading.style.display = 'flex';
                heading.style.alignItems = 'center';
                heading.style.justifyContent = 'flex-start';
                heading.style.textAlign = 'left';
                heading.style.width = '100%';
                
                // Remove any text nodes between this header and the ul.act-data
                // This removes duplicate title text like "French IRPA" appearing twice
                const content = heading.parentNode;
                if (content) {
                    const actData = content.querySelector('.act-data');
                    if (actData) {
                        let currentNode = heading.nextSibling;
                        while (currentNode && currentNode !== actData) {
                            const nextNode = currentNode.nextSibling;
                            // If it's a text node with non-whitespace content, remove it
                            if (currentNode.nodeType === 3 && currentNode.textContent.trim()) {
                                console.log(`Removing duplicate text node: "${currentNode.textContent.trim()}"`);
                                currentNode.remove();
                            }
                            currentNode = nextNode;
                        }
                    }
                }
            });
        }
        
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
        
        // Load saved popups on page load
        loadSavedPopups();
        
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
            
            // Client selection handler
            $('#client_selector').on('change', function() {
                const clientId = $(this).val();
                if (clientId) {
                    // Redirect to client management with client parameter
                    window.location.href = '/client-management?client_id=' + clientId;
                } else {
                    // Redirect to user-centric mode
                    window.location.href = '/client-management';
                }
            });
            
            // Save content with context awareness
            $('#saveContent').on('click', function() {
                const saveContext = $('#saveContext').val();
                const editorContent = $('#contentEditor').val();
                const droppableContent = $('#droppableArea').html();
                const clientId = <?php echo e(isset($client) && $client ? $client->id : 'null'); ?>;
                
                // Show loading state
                const $this = $(this);
                $this.prop('disabled', true);
                $this.html('<i class="fas fa-spinner fa-spin"></i> Saving...');
                
                $.ajax({
                    url: '/save-content',
                    method: 'POST',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        context: saveContext,
                        editor_content: editorContent,
                        droppable_content: droppableContent,
                        client_id: clientId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Content saved successfully!');
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Error saving content. Please try again.');
                    },
                    complete: function() {
                        // Reset button state
                        $this.prop('disabled', false);
                        $this.html('<span data-en="Save Content" data-fr="Enregistrer le contenu">Save Content</span>');
                    }
                });
            });
            
            // Immediately show all cards and details
            showAllCardDetails();
            
            const $container = $('#toggleTileContainer');

            // View toggle functionality
            $('input[name="view-toggle"]').on('change', function () {
                const view = $(this).val();
                
                // First update container class for proper styling context
                if (view === 'list') {
                    $container.addClass('act-content list-view').removeClass('grid-view');
                    
                    // Check for and remove duplicate headers
                    $container.find('.toggle-tile-body .toggle-tile-content').each(function() {
                        const $content = $(this);
                        const $headers = $content.find('h4');
                        
                        // If more than one header, keep only the first and remove others
                        if ($headers.length > 1) {
                            console.log(`Found ${$headers.length} headers, removing duplicates`);
                            $headers.slice(1).remove();
                        }
                        
                        // Make sure headings are visible and left-aligned in list view
                        const $header = $content.find('h4').first();
                        
                        if ($header.length) {
                            // Ensure header styling
                            $header.css({
                                'display': 'flex',
                                'align-items': 'center',
                                'justify-content': 'flex-start',
                                'text-align': 'left',
                                'width': '100%'
                            });
                            
                            // Ensure book icon exists
                            if (!$header.find('.fa-book').length && !$header.find('.act-icon').length) {
                                const title = $header.text().trim();
                                $header.html(`<i class="fas fa-book act-icon"></i> ${title}`);
                            }
                            
                            // Remove any text nodes between the header and the ul.act-data
                            // This removes the duplicate title text
                            const $actData = $content.find('.act-data');
                            if ($actData.length) {
                                $header.nextUntil('.act-data').each(function() {
                                    const $node = $(this);
                                    if (this.nodeType === 3 || !$node.hasClass('act-data')) {
                                        // If it's a text node or not the act-data element, remove it
                                        console.log('Removing node between header and act-data:', $node.text());
                                        $node.remove();
                                    }
                                });
                            }
                        } else {
                            // Create header if missing
                            const title = $content.attr('data-en') || $content.attr('data-fr') || 'Legal Document';
                            const $newHeader = $(`<h4><i class="fas fa-book act-icon"></i> ${title}</h4>`).css({
                                'display': 'flex',
                                'align-items': 'center',
                                'justify-content': 'flex-start',
                                'text-align': 'left',
                                'width': '100%'
                            });
                            $content.prepend($newHeader);
                        }
                    });
                    
                    // Apply alternating row backgrounds
                    $container.find('.toggle-tile-body:nth-child(even)').css('background-color', '#f8f9fa');
                    $container.find('.toggle-tile-body:nth-child(odd)').css('background-color', 'white');
                } else {
                    $container.addClass('grid-view').removeClass('act-content list-view');
                    
                    // Check for duplicate headers in grid view
                    $container.find('.toggle-tile-body .toggle-tile-content').each(function() {
                        const $content = $(this);
                        const $headers = $content.find('h4');
                        
                        // If more than one header, keep only the first and remove others
                        if ($headers.length > 1) {
                            console.log(`Found ${$headers.length} headers in grid view, removing duplicates`);
                            $headers.slice(1).remove();
                        }
                        
                        // Show headings in grid view with appropriate styling
                        const $header = $content.find('h4').first();
                        
                        if ($header.length) {
                            // Ensure header styling for grid view - make left aligned like list view
                            $header.css({
                                'display': 'flex',
                                'align-items': 'center',
                                'justify-content': 'flex-start',
                                'text-align': 'left',
                                'width': '100%'
                            });
                            
                            // Ensure book icon exists
                            if (!$header.find('.fa-book').length && !$header.find('.act-icon').length) {
                                const title = $header.text().trim();
                                $header.html(`<i class="fas fa-book act-icon"></i> ${title}`);
                            }
                            
                            // Remove any text nodes between the header and the ul.act-data in grid view too
                            const $actData = $content.find('.act-data');
                            if ($actData.length) {
                                $header.nextUntil('.act-data').each(function() {
                                    const $node = $(this);
                                    if (this.nodeType === 3 || !$node.hasClass('act-data')) {
                                        console.log('Removing node between header and act-data in grid view:', $node.text());
                                        $node.remove();
                                    }
                                });
                            }
                        } else {
                            // Create header if missing
                            const title = $content.attr('data-en') || $content.attr('data-fr') || 'Legal Document';
                            const $newHeader = $(`<h4><i class="fas fa-book act-icon"></i> ${title}</h4>`).css({
                                'display': 'flex',
                                'align-items': 'center',
                                'justify-content': 'flex-start',
                                'text-align': 'left',
                                'width': '100%'
                            });
                            $content.prepend($newHeader);
                        }
                    });
                    
                    // Reset backgrounds for grid view
                    $container.find('.toggle-tile-body').css('background-color', '');
                }
                
                // Then update individual tiles
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
                // Don't trigger card click if clicking on the view button
                if ($(e.target).closest('.view-button').length > 0) {
                    return;
                }
                
                const tableName = $(this).data('table-name');
                const actId = $(this).data('act-id');
                const clientId = $(this).data('client-id');
                const languageId = $(this).data('language-id');
                
                if (tableName && actId) {
                    // Use the same language ID that's on the card for consistency
                    // clientId can be null for user-centric mode
                    redirectToDocument(tableName, actId, clientId || null, languageId);
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

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\13\jurislocator_laravel\resources\views/user-legal-tables.blade.php ENDPATH**/ ?>