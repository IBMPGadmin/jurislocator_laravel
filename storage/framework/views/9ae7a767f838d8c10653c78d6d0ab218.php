

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
    
    /* Clickable card styling */
    .clickable-card {
        transition: all 0.3s ease !important;
        border: 1px solid transparent !important;
    }
    
    .clickable-card:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        border-color: #d68c2c !important;
        background-color: #f8f9fa !important;
    }
    
    .clickable-card:active {
        transform: translateY(0) !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1) !important;
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
    
    /* Clickable card styling */
    .clickable-card {
        transition: all 0.3s ease !important;
        border: 1px solid transparent !important;
    }
    
    .clickable-card:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        border-color: #d68c2c !important;
        background-color: #f8f9fa !important;
    }
    
    .clickable-card:active {
        transform: translateY(0) !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1) !important;
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
                                <div class="toggle-tile-content shadow-sm sp-top clickable-card" 
                                     data-table-name="<?php echo e($row->table_name ?? 'unknown'); ?>"
                                     data-act-id="<?php echo e($row->act_id ?? '1'); ?>"
                                     data-client-id="<?php echo e(isset($client) && $client ? $client->id : ''); ?>"
                                     data-language-id="<?php echo e($row->language_id ?? '1'); ?>"
                                     onclick="redirectToDocument('<?php echo e($row->table_name); ?>', '<?php echo e($row->act_id); ?>', '<?php echo e(isset($client) && $client ? $client->id : ""); ?>', '<?php echo e($row->language_id); ?>')"
                                     style="cursor: pointer;">
                                    <!-- Single header with book icon for all card views -->
                                    <h4><i class="fas fa-book act-icon"></i> <?php echo e($row->act_name ?? 'Unknown Act'); ?></h4>
                                    
                                    <ul class="act-data">
                                        <li class="act-category"><strong>Category: </strong><span><?php echo e($acts[$row->act_id ?? 1] ?? 'Acts'); ?></span></li>
                                        <li class="act-law"><strong>Law Subject: </strong><span><?php echo e($lawSubjects[$row->law_id ?? 1] ?? 'N/A'); ?></span></li>
                                        <li class="act-jurisdiction"><strong>Jurisdiction: </strong><span><?php echo e($jurisdictions[$row->jurisdiction_id ?? 1] ?? 'Federal'); ?></span></li>
                                        <li class="act-language"><strong>Language: </strong><span><?php echo e($languages[$row->language_id ?? 1] ?? 'English'); ?></span></li>
                                        <li class="act-description"><strong>Current to: </strong><span><?php echo e($row->created_at ? date('Y-m-d', strtotime($row->created_at)) : date('Y-m-d')); ?></span></li>
                                        <li class="view-button"><a href="javascript:void(0)" onclick="event.stopPropagation(); redirectToDocument('<?php echo e($row->table_name); ?>', '<?php echo e($row->act_id); ?>', '<?php echo e(isset($client) && $client ? $client->id : ""); ?>', '<?php echo e($row->language_id); ?>')"><strong>View Document</strong> <i class="fas fa-arrow-right"></i></a></li>
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
                    <h5 data-en="Notes and Content" data-fr="Notes et contenu">Notes and Content</h5>
                    
                    <!-- Context selector for saving -->
                    <div class="save-context-selector">
                        <label data-en="Save under:" data-fr="Enregistrer sous:">Save under:</label>
                        <select id="saveContext" class="form-select form-select-sm">
                            <option value="user" <?php echo e(!isset($client) || !$client ? 'selected' : ''); ?> data-en="User Only" data-fr="Utilisateur seulement">User Only</option>
                            <?php if(isset($client) && $client): ?>
                            <option value="client" selected data-en="Client Specific" data-fr="Spécifique au client">Client Specific</option>
                            <?php else: ?>
                            <option value="client" disabled data-en="Client Specific (Select a client first)" data-fr="Spécifique au client (Sélectionnez d'abord un client)">Client Specific (Select a client first)</option>
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
                                <p data-en="Drop content here" data-fr="Déposer le contenu ici">Drop content here</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Save Popups button -->
                    <div class="text-end mb-3">
                        <button id="savePopups" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-save me-1"></i>
                            <span data-en="Save Popups" data-fr="Enregistrer les popups">Save Popups</span>
                        </button>
                    </div>
                    
                    <!-- Text editor -->
                    <div id="textEditorContainer">
                        <textarea id="contentEditor" class="form-control" placeholder="Enter your notes and content here..." data-placeholder-en="Enter your notes and content here..." data-placeholder-fr="Entrez vos notes et contenu ici..."><?php echo e(isset($savedContent) && $savedContent ? $savedContent->editor_content : ''); ?></textarea>
                    </div>
                    
                    <!-- Save button -->
                    <div class="text-end mt-3">
                        <button id="saveContent" class="btn btn-action">
                            <span data-en="Save Content" data-fr="Enregistrer le contenu">Save Content</span>
                        </button>
                    </div>
                    
                    <!-- Context information -->
                    <?php if(isset($client) && $client): ?>
                        <div class="text-muted small mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            <span data-en="Content can be saved for your personal use or specifically for this client." 
                                  data-fr="Le contenu peut être enregistré pour votre usage personnel ou spécifiquement pour ce client.">
                                Content can be saved for your personal use or specifically for this client.
                            </span>
                        </div>
                    <?php else: ?>
                        <div class="text-muted small mt-2">
                            <i class="fas fa-info-circle me-1"></i>
                            <span data-en="Content will be saved for your personal use. Select a client above to enable client-specific saving." 
                                  data-fr="Le contenu sera enregistré pour votre usage personnel. Sélectionnez un client ci-dessus pour activer l'enregistrement spécifique au client.">
                                Content will be saved for your personal use. Select a client above to enable client-specific saving.
                            </span>
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
                    
                    // Track drag state to prevent click during drag
                    let isDragging = false;
                    
                    tile.addEventListener('dragstart', function(e) {
                        isDragging = true;
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
                    
                    tile.addEventListener('dragend', function(e) {
                        // Reset drag state after a short delay
                        setTimeout(() => {
                            isDragging = false;
                        }, 100);
                    });
                    
                    // Prevent click during drag operations
                    tile.addEventListener('click', function(e) {
                        if (isDragging) {
                            e.preventDefault();
                            e.stopPropagation();
                        }
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
    
    // --- FILTER LOGIC FOR AVAILABLE LEGISLATIONS ---
    document.addEventListener('DOMContentLoaded', function() {
        // Language filter (client-side)
        let selectedLang = '';
        document.querySelectorAll('input[name="toggle"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                selectedLang = this.value;
                applyFilters();
            });
        });

        // A-Z filter (client-side)
        const tileContainer = document.getElementById('toggleTileContainer');
        const azToggle = document.getElementById('act-pagination-toggle');
        const azContent = document.getElementById('act-pagination-content');
        let selectedLetter = null;

        if (azToggle && azContent) {
            azToggle.addEventListener('click', function() {
                azContent.classList.toggle('active');
                azToggle.classList.toggle('active');
                if (!azContent.classList.contains('active')) {
                    // Reset letter filter
                    selectedLetter = null;
                    azToggle.textContent = ' A to Z';
                    azContent.querySelectorAll('a').forEach(a => a.classList.remove('active'));
                    applyFilters();
                }
            });
            azContent.querySelectorAll('a').forEach(function(a) {
                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (a.classList.contains('disabled')) return;
                    selectedLetter = a.textContent.trim();
                    azContent.querySelectorAll('a').forEach(x => x.classList.remove('active'));
                    a.classList.add('active');
                    azToggle.textContent = ' ' + selectedLetter;
                    applyFilters();
                });
            });
        }

        function applyFilters() {
            if (!tileContainer) return;
            const cards = tileContainer.querySelectorAll('.toggle-tile-body');
            cards.forEach(card => {
                const langSpan = card.querySelector('.act-language span');
                const title = card.querySelector('h4');
                if (!title) return;
                let text = title.textContent.replace(/^[^A-Za-z0-9]+/, '').trim();
                let first = text.charAt(0).toUpperCase();
                let lang = langSpan ? langSpan.textContent.trim().toLowerCase() : '';
                let show = true;
                // Language filter
                if (selectedLang === '1' && lang !== 'english' && lang !== 'bilingual') show = false;
                if (selectedLang === '2' && lang !== 'french' && lang !== 'bilingual') show = false;
                // Letter filter
                if (selectedLetter && first !== selectedLetter) show = false;
                card.style.display = show ? '' : 'none';
            });
        }
    });
    
    // Function to redirect to appropriate document view based on language
    function redirectToDocument(tableName, categoryId, clientId, language) {
        // Check if it's a French document
        const isFrench = (language === '2' || language === 'fr' || language === 'French');
        
        // Build the URL with proper client handling
        let url;
        if (isFrench) {
            // Redirect to French view
            url = `/view-legal-table-french/${tableName}?category_id=${categoryId}`;
        } else {
            // Redirect to normal view
            url = `/view-legal-table/${tableName}?category_id=${categoryId}`;
        }
        
        // Add client_id if available
        if (clientId && clientId !== 'null' && clientId !== '') {
            url += `&client_id=${clientId}`;
        }
        
        window.location = url;
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\12\jurislocator_laravel\resources\views/user-legal-tables.blade.php ENDPATH**/ ?>