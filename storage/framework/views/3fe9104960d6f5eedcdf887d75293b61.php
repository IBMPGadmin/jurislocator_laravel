

<?php $__env->startSection('meta'); ?>
    <!-- Current document context meta tags for personal research -->
    <meta name="current-document-table" content="<?php echo e($tableName); ?>">
    <meta name="current-document-category-id" content="<?php echo e($categoryId); ?>">
    <meta name="current-user-id" content="<?php echo e($user->id); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .clickable-heading {
        cursor: pointer;
        color: #007bff;
        transition: color 0.2s;
    }
    .clickable-heading:hover {
        color: #0056b3;
        text-decoration: underline;
    }    
    .ref {
        color: #28a745;
        cursor: pointer;
        font-weight: 600;
        text-decoration: underline;
        transition: all 0.2s;
        padding: 0 2px;
        border-radius: 3px;
        position: relative;
    }
    .ref:hover {
        color: #218838;
        background-color: rgba(40, 167, 69, 0.1);
    }
    .ref:after {
        content: " 🔍";
        font-size: 10px;
        vertical-align: super;
    }
    .direct-reference {
        color: #3b82f6;
        cursor: pointer;
        margin-left: 5px;
        font-size: 14px;
        vertical-align: middle;
        transition: transform 0.2s;
    }
    .direct-reference:hover {
        transform: scale(1.2);
    }
    .section-btn {
        font-size: 10px;
        line-height: 1;
        margin-left: 2px;
        vertical-align: middle;
    }
    .legal-content {
        padding-left: 1.5rem;
        border-left: 1px solid #dee2e6;
    }
    .legal-section {
        margin-bottom: 1rem;
    }
    .footnote {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 0.5rem;
    }
    .section-content {
        max-height: 70vh;
        overflow-y: auto;
    }
    .section-item {
        padding: 0.75rem;
        border-radius: 0.25rem;
        background-color: #f8f9fa;
        margin-bottom: 1rem;
    }
    .legal-text-content {
        line-height: 1.6;
    }
    .modal.draggable .modal-dialog {
        cursor: move;
        position: absolute;
        margin: 0;
    }
    .modal-header.draggable {
        cursor: move;
        user-select: none;
    }
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
    .pinned-popup .modal-header {
        background-color: var(--primary-color);
        color: #fff;
        cursor: default;
    }
    /* Visual enhancement for dropable areas */
    .nested-droppable.ui-droppable-hover {
        border: 2px dashed #007bff;
        background-color: rgba(0, 123, 255, 0.1);
    }
    
    /* Additional styles for hierarchical structure */
    .standalone-group {
        border: 1px solid #e9ecef;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
        background-color: #f8f9fa;
    }
    
    .section-container {
        border-left: 3px solid #007bff;
        padding-left: 1rem;
        margin-bottom: 1rem;
        background-color: #ffffff;
        border-radius: 0 0.375rem 0.375rem 0;
    }
    
    .part-section > h2 {
        color: #495057;
        border-bottom: 2px solid #007bff;
        padding-bottom: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .division-section > h3 {
        color: #6c757d;
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 0.25rem;
        margin-bottom: 0.75rem;
    }
    
    .subdivision-section > h4 {
        color: #868e96;
        margin-bottom: 0.5rem;
    }
    
    .section-section > h5, .section-section > h6 {
        color: #007bff;
        margin-bottom: 0.5rem;
    }
    
    .subsection-section {
        border-left: 2px solid #28a745;
        padding-left: 0.75rem;
        margin-left: 0.5rem;
    }
    
    .paragraph-section {
        border-left: 1px solid #ffc107;
        padding-left: 0.5rem;
        margin-left: 0.75rem;
    }
    
    .legal-text {
        line-height: 1.7;
        margin-bottom: 0.5rem;
    }
    
    .legal-text strong {
        color: #495057;
        font-weight: 600;
    }
    
    .pagination-controls {
        background-color: #f8f9fa;
        padding: 1rem;
        border-radius: 0.375rem;
        border: 1px solid #dee2e6;
    }
    
    .pagination-controls .btn {
        margin: 0 0.25rem;
    }
    
    .cross-act-ref {
        background-color: rgba(255, 193, 7, 0.1);
        border: 1px solid #ffc107;
        color: #856404;
        padding: 2px 4px;
        border-radius: 3px;
    }
    
    .cross-act-ref:hover {
        background-color: rgba(255, 193, 7, 0.2);
        color: #533f03;
    }
    
    /* Enhanced Floating popup styles */
    .floating-popup {
        position: absolute;
        z-index: 1050;
        background: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.175);
        width: 500px;
        max-width: 90vw;
        border: 1px solid rgba(0,0,0,0.125);
        backdrop-filter: blur(10px);
        animation: popupFadeIn 0.3s ease-out;
    }
    
    @keyframes popupFadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    .popup-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--color-border, #dee2e6);
        background-color: var(--color-theme-3, #667eea) !important;
        color: var(--color-text-light, white);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 0.5rem 0.5rem 0 0;
        cursor: move;
        user-select: none;
    }
    
    .popup-header h6 {
        margin: 0;
        font-weight: 600;
        font-size: 1rem;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
    
    .popup-header .section-number {
        background: rgba(255,255,255,0.2);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.875rem;
        font-weight: 500;
        margin-right: 0.5rem;
    }
    
    .popup-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    
    .popup-actions .btn {
        border: 1px solid rgba(255,255,255,0.3);
        background: rgba(255,255,255,0.1);
        color: white;
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        transition: all 0.2s ease;
    }
    
    .popup-actions .btn:hover {
        background: rgba(255,255,255,0.2);
        border-color: rgba(255,255,255,0.5);
        transform: translateY(-1px);
    }
    
    .popup-content {
        padding: 1.25rem;
        max-height: 65vh;
        overflow-y: auto;
        background: #fff;
        border-radius: 0 0 0.5rem 0.5rem;
    }
    
    .popup-content::-webkit-scrollbar {
        width: 6px;
    }
    
    .popup-content::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    .popup-content::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    
    .popup-content::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    
    .section-item {
        padding: 1rem;
        border-radius: 0.375rem;
        background: linear-gradient(145deg, #f8f9fa, #e9ecef);
        margin-bottom: 1rem;
        border: 1px solid #e9ecef;
        transition: all 0.2s ease;
    }
    
    .section-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-color: #007bff;
    }
    
    .section-title {
        color: #495057;
        font-weight: 600;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #007bff;
        position: relative;
    }
    
    .section-title::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 30px;
        height: 2px;
        background: #28a745;
    }
    
    .section-text {
        line-height: 1.6;
        color: #333;
        font-size: 0.95rem;
    }
    
    .section-meta {
        background: rgba(0,123,255,0.1);
        padding: 0.5rem;
        border-radius: 0.25rem;
        border-left: 3px solid #007bff;
        margin-top: 0.75rem;
    }
    
    .section-meta div {
        margin-bottom: 0.25rem;
    }
    
    .section-meta div:last-child {
        margin-bottom: 0;
    }
    
    /* Enhanced loading state */
    .popup-loading {
        text-align: center;
        padding: 2rem;
    }
    
    .popup-loading .spinner-border {
        width: 2rem;
        height: 2rem;
        border-width: 0.2em;
    }
    
    .popup-loading p {
        margin-top: 1rem;
        color: #6c757d;
        font-style: italic;
    }
    
    /* Mobile adjustments */
    @media (max-width: 768px) {
        .floating-popup {
            width: 95vw;
            max-height: 85vh;
            margin: 0 auto;
            left: 50% !important;
            transform: translateX(-50%);
        }
        
        .popup-header {
            padding: 0.75rem 1rem;
        }
        
        .popup-content {
            padding: 1rem;
            max-height: 70vh;
        }
        
        .popup-actions .btn {
            font-size: 0.7rem;
            padding: 0.2rem 0.4rem;
        }
    }
    
    /* Pinned popup styles */
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
    
    /* Debugging outlines - remove in production */
    .debug-outline {
        outline: 2px dashed red !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
            <!-- Personal Research Mode - No client details needed -->
            <div class="gap_top col-12 mb-4 p-0">
                <div class="bg_custom p-4 rounded shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="personal-avatar me-4 d-flex justify-content-center align-items-center rounded-circle text-white" style="width: 60px; height: 60px; font-size: 24px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); background-color: var(--color-theme-3);">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="research-info flex-grow-1">
                            <h4 class="mb-2" data-en="Personal Research" data-fr="Recherche personnelle">Personal Research</h4>
                            <div class="d-flex flex-wrap">
                                <div class="me-4 mb-2">
                                    <span class="d-flex align-items-center">
                                        <strong data-en="User:" data-fr="Utilisateur :">User:</strong>&nbsp;<?php echo e($user->name ?? 'Current User'); ?>

                                    </span>
                                </div>
                                <div class="mb-2">
                                    <span class="d-flex align-items-center">
                                        <i class="fas fa-book me-2" style="color: var(--color-theme-3);"></i>
                                        <strong data-en="Research Mode:" data-fr="Mode de recherche :">Research Mode:</strong>&nbsp;<span data-en="Personal" data-fr="Personnel">Personal</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(empty($tableData) || $tableData->isEmpty()): ?>
                <div class="alert alert-warning mt-4" data-en="No data found in this table." data-fr="Aucune donnée trouvée dans cette table.">No data found in this table.</div>
            <?php else: ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0" data-en="Keyword Search" data-fr="Recherche par mots-clés">Keyword Search</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('user.personal.document.view', ['user' => $user->id, 'tableName' => $tableName])); ?>" method="GET" class="mb-3">
                        <input type="hidden" name="category_id" value="<?php echo e($categoryId); ?>">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search..." 
                                   data-placeholder-en="Search..." 
                                   data-placeholder-fr="Rechercher..." 
                                   value="<?php echo e(request('search')); ?>">
                            <button class="btn search-btn" type="submit" data-en="Search" data-fr="Rechercher" style="background-color: var(--color-theme-3); border-color: var(--color-theme-3); color: white;">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="card mb-3 shadow-sm">
                <div class="widget_header card-header text-white">
                    <h5 class="mb-0" data-en="Legal Content" data-fr="Contenu juridique">Legal Content</h5>
                </div>
                <div class="card-body" id="legal-content-area">
                    <?php
                        $data = [];
                        $standaloneData = [];
                        
                        // Get a safe table ID for makeLinksClickableSimple function
                        $safeTableId = $legalTable->id ?? $categoryId ?? 1;
                        
                        foreach ($tableData as $row) {
                            if (empty($row->part)) {
                                $title = $row->title ?? 'General Provisions';
                                if (!isset($standaloneData[$title])) {
                                    $standaloneData[$title] = [
                                        'title' => $title,
                                        'sections' => []
                                    ];
                                }
                                
                                if ($row->section !== null) {
                                    $sectionNum = $row->section;
                                    if (!isset($standaloneData[$title]['sections'][$sectionNum])) {
                                        // Check if title is the same as the parent title, if so don't duplicate it
                                        $sectionTitle = ($row->title === $title) ? '' : $row->title;
                                        $standaloneData[$title]['sections'][$sectionNum] = [
                                            'title' => $sectionTitle,
                                            'text_content' => $row->text_content,
                                            'subsections' => [],
                                            'paragraphs' => [],
                                            'footnote' => $row->footnote
                                        ];
                                    }
                                    
                                    if ($row->sub_section !== null) {
                                        $subSectionNum = $row->sub_section;
                                        if (!isset($standaloneData[$title]['sections'][$sectionNum]['subsections'][$subSectionNum])) {
                                            $standaloneData[$title]['sections'][$sectionNum]['subsections'][$subSectionNum] = [
                                                'text_content' => $row->text_content,
                                                'paragraphs' => [],
                                                'footnote' => $row->footnote
                                            ];
                                        }
                                        
                                        if ($row->paragraph !== null) {
                                            $paraNum = $row->paragraph;
                                            $standaloneData[$title]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum] = [
                                                'text_content' => $row->text_content,
                                                'sub_paragraphs' => [],
                                                'footnote' => $row->footnote
                                            ];
                                            
                                            if ($row->sub_paragraph !== null) {
                                                $standaloneData[$title]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                                    'sub_paragraph' => $row->sub_paragraph,
                                                    'text_content' => $row->text_content,
                                                    'footnote' => $row->footnote
                                                ];
                                            }
                                        }
                                    } elseif ($row->paragraph !== null) {
                                        $paraNum = $row->paragraph;
                                        $standaloneData[$title]['sections'][$sectionNum]['paragraphs'][$paraNum] = [
                                            'text_content' => $row->text_content,
                                            'sub_paragraphs' => [],
                                            'footnote' => $row->footnote
                                        ];
                                        
                                        if ($row->sub_paragraph !== null) {
                                            $standaloneData[$title]['sections'][$sectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                                'sub_paragraph' => $row->sub_paragraph,
                                                'text_content' => $row->text_content,
                                                'footnote' => $row->footnote
                                            ];
                                        }
                                    }
                                }
                                continue;
                            }
                            
                            $partNum = $row->part;
                            if (!isset($data[$partNum])) {
                                $data[$partNum] = [
                                    'title' => $row->title,
                                    'divisions' => [],
                                    'sections' => []
                                ];
                            }
                            
                            if ($row->section !== null && empty($row->division) && empty($row->sub_division)) {
                                $sectionNum = $row->section;                                    if (!isset($data[$partNum]['sections'][$sectionNum])) {
                                    // Check if title is the same as the parent title, if so don't duplicate it
                                    $sectionTitle = ($row->title === $part['title']) ? '' : $row->title;
                                    $data[$partNum]['sections'][$sectionNum] = [
                                        'title' => $sectionTitle,
                                        'text_content' => $row->text_content,
                                        'subsections' => [],
                                        'paragraphs' => [],
                                        'footnote' => $row->footnote
                                    ];
                                }
                                
                                if ($row->sub_section !== null) {
                                    $subSectionNum = $row->sub_section;
                                    if (!isset($data[$partNum]['sections'][$sectionNum]['subsections'][$subSectionNum])) {
                                        $data[$partNum]['sections'][$sectionNum]['subsections'][$subSectionNum] = [
                                            'title' => $row->title,
                                            'text_content' => $row->text_content,
                                            'paragraphs' => [],
                                            'footnote' => $row->footnote
                                        ];
                                    }
                                    
                                    if ($row->paragraph !== null) {
                                        $paraNum = $row->paragraph;
                                        $data[$partNum]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum] = [
                                            'paragraph' => $row->paragraph,
                                            'text_content' => $row->text_content,
                                            'sub_paragraphs' => [],
                                            'footnote' => $row->footnote
                                        ];
                                        
                                        if ($row->sub_paragraph !== null) {
                                            $data[$partNum]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                                'sub_paragraph' => $row->sub_paragraph,
                                                'text_content' => $row->text_content,
                                                'footnote' => $row->footnote
                                            ];
                                        }
                                    }
                                } elseif ($row->paragraph !== null) {
                                    $paraNum = $row->paragraph;
                                    $data[$partNum]['sections'][$sectionNum]['paragraphs'][$paraNum] = [
                                        'paragraph' => $row->paragraph,
                                        'text_content' => $row->text_content,
                                        'sub_paragraphs' => [],
                                        'footnote' => $row->footnote
                                    ];
                                    
                                    if ($row->sub_paragraph !== null) {
                                        $data[$partNum]['sections'][$sectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                            'sub_paragraph' => $row->sub_paragraph,
                                            'text_content' => $row->text_content,
                                            'footnote' => $row->footnote
                                        ];
                                    }
                                }
                            }
                            elseif ($row->division !== null) {
                                $divisionNum = $row->division;
                                if (!isset($data[$partNum]['divisions'][$divisionNum])) {
                                    $data[$partNum]['divisions'][$divisionNum] = [
                                        'title' => $row->title,
                                        'sub_divisions' => []
                                    ];
                                }
                                
                                if ($row->sub_division !== null) {
                                    $subDivisionNum = $row->sub_division;
                                    if (!isset($data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum])) {
                                        $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum] = [
                                            'title' => $row->title,
                                            'sections' => []
                                        ];
                                    }
                                    
                                    if ($row->section !== null) {
                                        $sectionNum = $row->section;
                                        if (!isset($data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum])) {
                                            // Prevent duplicating the parent title
                                            $parentTitle = $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['title'] ?? '';
                                            $sectionTitle = ($row->title === $parentTitle) ? '' : $row->title;
                                            $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum] = [
                                                'title' => $sectionTitle,
                                                'text_content' => $row->text_content,
                                                'subsections' => [],
                                                'paragraphs' => [],
                                                'footnote' => $row->footnote
                                            ];
                                        }
                                        
                                        if ($row->sub_section !== null) {
                                            $subSectionNum = $row->sub_section;
                                            if (!isset($data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum]['subsections'][$subSectionNum])) {
                                                $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum]['subsections'][$subSectionNum] = [
                                                    'title' => $row->title,
                                                    'text_content' => $row->text_content,
                                                    'paragraphs' => [],
                                                    'footnote' => $row->footnote
                                                ];
                                            }
                                            
                                            if ($row->paragraph !== null) {
                                                $paraNum = $row->paragraph;
                                                $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum] = [
                                                    'paragraph' => $row->paragraph,
                                                    'text_content' => $row->text_content,
                                                    'sub_paragraphs' => [],
                                                    'footnote' => $row->footnote
                                                ];
                                                
                                                if ($row->sub_paragraph !== null) {
                                                    $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                                        'sub_paragraph' => $row->sub_paragraph,
                                                        'text_content' => $row->text_content,
                                                        'footnote' => $row->footnote
                                                    ];
                                                }
                                            }
                                        } elseif ($row->paragraph !== null) {
                                            $paraNum = $row->paragraph;
                                            $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum]['paragraphs'][$paraNum] = [
                                                'paragraph' => $row->paragraph,
                                                'text_content' => $row->text_content,
                                                'sub_paragraphs' => [],
                                                'footnote' => $row->footnote
                                            ];
                                            
                                            if ($row->sub_paragraph !== null) {
                                                $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                                    'sub_paragraph' => $row->sub_paragraph,
                                                    'text_content' => $row->text_content,
                                                    'footnote' => $row->footnote
                                                ];
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                        function makeLinksClickableSimple($text, $categoryId, $currentSection = null) {
                            if (empty($text)) return "";
                            
                            $text = preg_replace(
                                '/\b(section|sections)\s+(\d+(?:\.\d+)?)\b/i',
                                '<span class="ref" data-section-id="$2" data-table-id="' . $categoryId . '">$1 $2</span>',
                                $text
                            );
                            
                            $text = preg_replace(
                                '/\b(subsection|subsections)\s+\((\d+(?:\.\d+)?)\)/i',
                                '<span class="ref" data-section-id="' . ($currentSection ?? '') . '($2)" data-table-id="' . $categoryId . '">$1 ($2)</span>',
                                $text
                            );
                            
                            $text = preg_replace(
                                '/\b(paragraph|paragraphs)\s+\(([a-z\d\.]+)\)/i',
                                '<span class="ref" data-section-id="' . ($currentSection ?? '') . '($2)" data-table-id="' . $categoryId . '">$1 ($2)</span>',
                                $text
                            );
                            
                            $text = preg_replace(
                                '/\b(\d+(?:\.\d+)?(?:\([^)]+\)){1,4})\b(?![^<>]*<\/span>)/i',
                                '<span class="ref" data-section-id="$1" data-table-id="' . $categoryId . '">$1</span>',
                                $text
                            );
                            
                            return $text;
                        }
                    ?>

                    <div class="legal-document-content">
                        
                        <?php $__currentLoopData = $standaloneData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titleGroup => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="margin-bottom: 1.5em;">
                                <div style="font-size:1.15em; font-weight:bold; margin-bottom:0.5em;"><?php echo e($titleGroup); ?></div>
                                <?php $__currentLoopData = $group['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionNumber => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                        <?php if(!empty($section['title']) && trim($section['title']) !== '' && !isset($section['is_intro']) && $section['title'] !== $titleGroup): ?>
                                        <div style="margin-top: 1em; color: #333; font-weight: bold;"><?php echo e($section['title']); ?></div>
                                    <?php endif; ?>
                                    <?php if(!empty($section['text_content'])): ?>
                                        <div style="margin-left: 0.5em; margin-bottom: 1em;">
                                            <?php if(!isset($section['is_intro'])): ?>
                                                <strong><?php echo e($sectionNumber); ?></strong>
                                            <?php endif; ?>
                                            <?php echo makeLinksClickableSimple($section['text_content'], $safeTableId, isset($section['is_intro']) ? null : $sectionNumber); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $section['subsections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsectionNumber => $subsection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="margin-left: 2em;">
                                            <?php if(!empty($subsection['text_content'])): ?>
                                                <div style="margin-bottom: 0.5em;">
                                                    <strong><?php echo e($subsectionNumber); ?></strong> <?php echo makeLinksClickableSimple($subsection['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')'); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $subsection['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraphNumber => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="margin-left: 2em;">
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong><?php echo e($paragraphNumber); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')'); ?>

                                                    </div>
                                                    <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div style="margin-left: 2em;">
                                                            <div style="margin-bottom: 0.5em;">
                                                                <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $section['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraphNumber => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="margin-left: 2em;">
                                            <div style="margin-bottom: 0.5em;">
                                                <strong><?php echo e($paragraphNumber); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $safeTableId, $sectionNumber . '(' . $paragraphNumber . ')'); ?>

                                            </div>
                                            <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="margin-left: 2em;">
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $safeTableId, $sectionNumber . '(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($section['footnote'])): ?>
                                        <div class="footnote"><?php echo e($section['footnote']); ?></div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partNumber => $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div style="margin-bottom: 2em;">
                                <div style="font-size:1.15em; font-weight:bold; margin-bottom:0.5em;">Part <?php echo e($partNumber); ?>: <?php echo e($part['title']); ?></div>
                                <?php if(!empty($part['sections'])): ?>
                                    <?php $__currentLoopData = $part['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionNumber => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($section['title']) && trim($section['title']) !== '' && $section['title'] !== $part['title']): ?>
                                            <div style="margin-top: 1em; color: #333; font-weight: bold;"><?php echo e($section['title']); ?></div>
                                        <?php endif; ?>
                                        <?php if(!empty($section['text_content'])): ?>
                                            <div style="margin-left: 0.5em; margin-bottom: 1em;">
                                                <strong><?php echo e($sectionNumber); ?></strong> <?php echo makeLinksClickableSimple($section['text_content'], $safeTableId, $sectionNumber); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $section['subsections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsectionNumber => $subsection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div style="margin-left: 2em;">
                                                <?php if(!empty($subsection['title'])): ?>
                                                    <div style="font-style: italic;"><?php echo e($subsection['title']); ?></div>
                                                <?php endif; ?>
                                                <?php if(!empty($subsection['text_content'])): ?>
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong><?php echo e($subsectionNumber); ?></strong> <?php echo makeLinksClickableSimple($subsection['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')'); ?>

                                                    </div>
                                                <?php endif; ?>
                                                <?php $__currentLoopData = $subsection['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraphNumber => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div style="margin-left: 2em;">
                                                        <div style="margin-bottom: 0.5em;">
                                                            <strong><?php echo e($paragraphNumber); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')'); ?>

                                                        </div>
                                                        <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div style="margin-left: 2em;">
                                                                <div style="margin-bottom: 0.5em;">
                                                                    <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($subsection['footnote'])): ?>
                                                    <div class="footnote"><em><?php echo $subsection['footnote']; ?></em></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $section['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div style="margin-left: 2em;">
                                                <div style="margin-bottom: 0.5em;">
                                                    <strong><?php echo e($paragraph['paragraph']); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $safeTableId, $sectionNumber . '(' . $paragraph['paragraph'] . ')'); ?>

                                                </div>
                                                <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div style="margin-left: 2em;">
                                                        <div style="margin-bottom: 0.5em;">
                                                            <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $safeTableId, $sectionNumber . '(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($section['footnote'])): ?>
                                            <div class="footnote"><?php echo e($section['footnote']); ?></div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                <?php if(!empty($part['divisions'])): ?>
                                    <?php $__currentLoopData = $part['divisions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $divisionNumber => $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="margin-left: 1.5em; margin-top: 1em;">
                                            <div style="font-weight:bold; margin-bottom:0.5em;">Division <?php echo e($divisionNumber); ?>: <?php echo e($division['title']); ?></div>
                                            <?php if(!empty($division['sub_divisions'])): ?>
                                                <?php $__currentLoopData = $division['sub_divisions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subDivisionNumber => $subDivision): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($subDivision['title'] !== $division['title']): ?>
                                                        <div style="font-weight:bold; margin-bottom:0.5em; margin-left:1em;">Subdivision <?php echo e($subDivisionNumber); ?>: <?php echo e($subDivision['title']); ?></div>
                                                    <?php endif; ?>
                                                    <?php if(!empty($subDivision['sections'])): ?>
                                                        <?php $__currentLoopData = $subDivision['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionNumber => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(!empty($section['title'])): ?>
                                                                <div style="margin-top: 1em; font-weight: bold;"><?php echo e($section['title']); ?></div>
                                                            <?php endif; ?>
                                                            <?php if(!empty($section['text_content'])): ?>
                                                                <div style="margin-left: 1em; margin-bottom: 0.5em;">
                                                                    <strong><?php echo e($sectionNumber); ?></strong> <?php echo makeLinksClickableSimple($section['text_content'], $safeTableId, $sectionNumber); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                            <?php $__currentLoopData = $section['subsections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsectionNumber => $subsection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div style="margin-left: 2em;">
                                                                    <?php if(!empty($subsection['title'])): ?>
                                                                        <div style="font-style: italic;"><?php echo e($subsection['title']); ?></div>
                                                                    <?php endif; ?>
                                                                    <?php if(!empty($subsection['text_content'])): ?>
                                                                        <div style="margin-bottom: 0.5em;">
                                                                            <strong><?php echo e($subsectionNumber); ?></strong> <?php echo makeLinksClickableSimple($subsection['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')'); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php $__currentLoopData = $subsection['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div style="margin-left: 2em;">
                                                                            <div style="margin-bottom: 0.5em;">
                                                                                <strong><?php echo e($paragraph['paragraph']); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraph['paragraph'] . ')'); ?>

                                                                            </div>
                                                                            <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div style="margin-left: 2em;">
                                                                                    <div style="margin-bottom: 0.5em;">
                                                                                        <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $safeTableId, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

                                                                                    </div>
                                                                                </div>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(!empty($subsection['footnote'])): ?>
                                                                        <div class="footnote"><em><?php echo $subsection['footnote']; ?></em></div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $section['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div style="margin-left: 2em;">
                                                                    <div style="margin-bottom: 0.5em;">
                                                                        <strong><?php echo e($paragraph['paragraph']); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $safeTableId, $sectionNumber . '(' . $paragraph['paragraph'] . ')'); ?>

                                                                    </div>
                                                                    <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div style="margin-left: 2em;">
                                                                            <div style="margin-bottom: 0.5em;">
                                                                                <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $safeTableId, $sectionNumber . '(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(!empty($section['footnote'])): ?>
                                                                <div class="footnote"><em><?php echo $section['footnote']; ?></em></div>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            
            <div class="pagination-controls d-flex justify-content-center align-items-center mt-3 gap-3">
                <button id="prev-page-btn" class="btn theme-btn" style="color: var(--color-theme-3); border-color: var(--color-theme-3);" onclick="changePage(currentPage - 1, currentCategoryId)" <?php echo e(request('page', 1) <= 1 ? 'disabled' : ''); ?>>
                    Previous
                </button>
                
                <select id="page-select" class="form-select" style="width: auto; border-color: var(--color-theme-3);" onchange="changePage(this.value, currentCategoryId)">
                    <?php for($i = 1; $i <= $tableData->lastPage(); $i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e(request('page', 1) == $i ? 'selected' : ''); ?>>
                            Page <?php echo e($i); ?> of <?php echo e($tableData->lastPage()); ?>

                        </option>
                    <?php endfor; ?>
                </select>
                
                <button id="next-page-btn" class="btn theme-btn" style="color: var(--color-theme-3); border-color: var(--color-theme-3);" onclick="changePage(currentPage + 1, currentCategoryId)" <?php echo e(request('page', 1) >= $tableData->lastPage() ? 'disabled' : ''); ?>>
                    Next
                </button>
            </div>
            <?php endif; ?>
                
<?php $__env->startSection('page-scripts'); ?>
<script>
    var fullHierarchicalData = <?php echo json_encode($tableData->items(), 15, 512) ?>;
    var currentPage = <?php echo e(request('page', 1)); ?>;
    var totalPages = <?php echo e($tableData->lastPage()); ?>;
    var currentCategoryId = <?php echo e($safeTableId); ?>;
    
    // Function to change page with AJAX loading
    function changePage(page, category_id) {
        if (page < 1 || page > totalPages) return;
        
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        url.searchParams.set('category_id', category_id);

        // Show loading state
        const contentArea = document.getElementById('legal-content-area');
        if (contentArea) {
            contentArea.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading content...</p></div>';
        }

        fetch(url.toString(), { 
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            // Handle response
            window.history.pushState({}, '', url.toString());
            currentPage = page;
            location.reload(); // Simple reload approach
        })
        .catch(error => {
            console.error('Error loading page:', error);
            if (contentArea) {
                contentArea.innerHTML = '<div class="alert alert-danger">Error loading content. Please try again.</div>';
            }
        });
    }

    // Initialize reference handlers
    document.addEventListener('DOMContentLoaded', function() {
        // Make all clickable headings act like references
        document.querySelectorAll('.clickable-heading').forEach(function(elem) {
            elem.addEventListener('click', function(e) {
                // Your click handler logic
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<!-- Content Viewer Modal -->
<div class="modal fade" id="contentViewerModal" tabindex="-1" aria-labelledby="contentViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentViewerModalLabel" data-en="Section Content" data-fr="Contenu de la section">Section Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-content-display">
                <p data-en="Modal content will load here" data-fr="Le contenu du modal se chargera ici">Modal content will load here</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Close" data-fr="Fermer">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Debug info and script for testing -->
<div id="debug-output" class="card mt-3 mb-3" style="display: none;">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0" data-en="Debug Information" data-fr="Informations de débogage">Debug Information</h5>
        <button type="button" class="btn-close btn-close-white" aria-label="Close" onclick="document.getElementById('debug-output').style.display='none'"></button>
    </div>
    <div class="card-body">
        <div id="debug-content" class="small font-monospace"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-scripts'); ?>
<!-- Custom scripts specific to this page -->
<script src="<?php echo e(asset('user_assets/js/api-endpoint-tests.js')); ?>"></script>
<script src="<?php echo e(asset('user_assets/js/reference-by-id.js')); ?>"></script>

<!-- Initialize TinyMCE and droppable area -->
<script>
$(document).ready(function() {
    console.log('Document ready');

    // Initialize droppable area first
    $('.nested-droppable').droppable({
        accept: '.draggable-popup',
        drop: function(event, ui) {
            const droppedItem = ui.draggable;
            // Handle drop logic here
        }
    });

    // Debug TinyMCE loading
    if (typeof tinymce === 'undefined') {
        console.error('TinyMCE is not loaded');
        return;
    }
    
    console.log('TinyMCE version:', tinymce.majorVersion);
    
    // Initialize TinyMCE with error handling
    try {
        tinymce.remove('#tiny-editor'); // Clean up any existing instances
        
        tinymce.init({
            selector: '#tiny-editor',
            height: 380,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
            content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px; }",
            branding: false,
            statusbar: false,
            setup: function(editor) {
                editor.on('init', function(e) {
                    console.log('TinyMCE initialized successfully');
                    const savedContent = localStorage.getItem('tinyMCEContent');
                    if (savedContent) {
                        editor.setContent(savedContent);
                    }
                });

                editor.on('change', function(e) {
                    localStorage.setItem('tinyMCEContent', editor.getContent());
                });

                // Add save button handler
                editor.on('SaveContent', function() {
                    const content = editor.getContent();
                    // Save to database using Laravel route
                    fetch('<?php echo e(route('editor.save')); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ content: content })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            editor.notificationManager.open({
                                text: 'Content saved successfully',
                                type: 'success',
                                timeout: 3000
                            });
                        } else {
                            throw new Error(data.message || 'Error saving content');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        editor.notificationManager.open({
                            text: error.message || 'Error saving content',
                            type: 'error',
                            timeout: 3000
                        });
                    });
                });
            }
        }).then(function(editors) {
            console.log('TinyMCE editors loaded:', editors);
        }).catch(function(error) {
            console.error('TinyMCE initialization error:', error);
        });
    } catch (error) {
        console.error('Error during TinyMCE setup:', error);
    }
});
</script>

<!-- Reference pattern processing and popup handling -->
<script>
$(document).ready(function() {
    // Reference pattern processing for all .legal-content-text elements
    $('.legal-content-text').each(function() {
        let processedText = $(this).html();
        // Pattern 1: section X references
        processedText = processedText.replace(
            /\b(section|sections)\s+(\d+(?:\.\d+)?)\b/gi,
            '<span class="ref" data-section-id="$2" data-table-id="<?php echo e($safeTableId); ?>">$1 $2</span>'
        );
        // Pattern 2: paragraph references
        processedText = processedText.replace(
            /\b(paragraph|paragraphs)\s+\(([a-z\d\.]+)\)(?:\s+or\s+\(([a-z\d\.]+)\))?/gi,
            function(match, type, firstRef, secondRef) {
                // Try to get context from parent .legal-text div
                const section = $(this).closest('.legal-text').data('section-id') || '';
                let sectionId = section ? section + '(' + firstRef + ')' : '(' + firstRef + ')';
                let result = '<span class="ref" data-section-id="' + sectionId + '" data-table-id="<?php echo e($safeTableId); ?>">' + type + ' (' + firstRef + ')</span>';
                if (secondRef) {
                    let secondSectionId = section ? section + '(' + secondRef + ')' : '(' + secondRef + ')';
                    result += ' or <span class="ref" data-section-id="' + secondSectionId + '" data-table-id="<?php echo e($safeTableId); ?>">(' + secondRef + ')</span>';
                }
                return result;
            }
        );
        // Pattern 3: subsection references
        processedText = processedText.replace(
            /\b(subsection|subsections)\s+\((\d+(?:\.\d+)?)\)(?:\s+or\s+\((\d+(?:\.\d+)?)\))?/gi,
            function(match, type, firstRef, secondRef) {
                const section = $(this).closest('.legal-text').data('section-id') || '';
                let sectionId = section ? section + '(' + firstRef + ')' : '(' + firstRef + ')';
                let result = '<span class="ref" data-section-id="' + sectionId + '" data-table-id="<?php echo e($safeTableId); ?>">' + type + ' (' + firstRef + ')</span>';
                if (secondRef) {
                    let secondSectionId = section ? section + '(' + secondRef + ')' : '(' + secondRef + ')';
                    result += ' or <span class="ref" data-section-id="' + secondSectionId + '" data-table-id="<?php echo e($safeTableId); ?>">(' + secondRef + ')</span>';
                }
                return result;
            }
        );
        // Pattern 4: complex section references like 279.1(2)
        processedText = processedText.replace(
            /\b(\d+(?:\.\d+)?(?:\([^)]+\)){1,4})\b(?!\s*\([a-z](?:\.\d+)?\))(?![^<>]*<\/span>)/g,
            '<span class="ref" data-section-id="$1" data-table-id="<?php echo e($safeTableId); ?>">$1</span>'
        );
        // Pattern 5: explicit section references
        processedText = processedText.replace(
            /\b(section|subsection|paragraph)\s+(\d+(?:\.\d+)?)\((\d+(?:\.\d+)?)\)(?:\(([a-z\d\.]+)\))?/gi,
            function(match, type, section, subsection, paragraph) {
                let sectionId = section + '(' + subsection + ')';
                if (paragraph) sectionId += '(' + paragraph + ')';
                return '<span class="ref" data-section-id="' + sectionId + '" data-table-id="<?php echo e($safeTableId); ?>">' + match + '</span>';
            }
        );
        $(this).html(processedText);
    });

    // Re-initialize custom popups for .ref elements (from legal-reference-popups.js)
    if (typeof bindReferencePopups === 'function') {
        console.log('Calling bindReferencePopups() for .ref popups');
        bindReferencePopups();
    } else {
        // Try to help the user find the correct function
        const candidates = Object.keys(window).filter(k => typeof window[k] === 'function' && (k.toLowerCase().includes('popup') || k.startsWith('init') || k.startsWith('bind')));
        console.warn('bindReferencePopups() not found. Candidates on window:', candidates);
        if (candidates.length) {
            console.warn('Try calling one of these in place of bindReferencePopups().');
        } else {
            console.warn('No popup-related functions found on window. Check that legal-reference-popups.js is loaded and defines a global function.');
        }
    }
});
</script>

<!-- Test Modal popup functionality -->
<script>
$(function() {
    // Show Test Modal on button click
    $('#test-modal-button').on('click', function(e) {
        $('#testModalPopup').modal('show');
        // Position near the button that was clicked
        setTimeout(function() {
            var $dialog = $('#testModalPopup .modal-dialog');
            var buttonPos = $(e.target).offset();
            $dialog.css({
                position: 'absolute',
                top: buttonPos.top + 30,
                left: buttonPos.left + 20,
                margin: 0
            });
        }, 100);
    });

    // Make the entire modal draggable (not just by header)
    $('#testModalPopup .modal-dialog').draggable({
        containment: 'window',
        cursor: 'move'
    });
    
    // Also handle reference clicks to show modal near the clicked reference
    $(document).on('click', '.ref', function(e) {
        // If we want to show the test modal near references too
        var clickPos = $(this).offset();
        $('#testModalPopup').modal('show');
        setTimeout(function() {
            var $dialog = $('#testModalPopup .modal-dialog');
            $dialog.css({
                position: 'absolute',
                top: clickPos.top + 30,
                left: clickPos.left + 20,
                margin: 0
            });
        }, 100);
        e.stopPropagation(); // Prevent other handlers
    });

    // Pin button logic
    $('#pin-test-modal').on('click', function() {
        // Clone modal content for pinning
        var $modal = $('#testModalPopup');
        var $content = $modal.find('.modal-content').clone();
        // Remove modal classes and add pinned-popup class
        $content.removeClass('modal-content').addClass('pinned-popup card mb-2').css({width:'100%', cursor:'default'});
        // Remove draggable handle and close/pin buttons from header/footer
        $content.find('.modal-header').removeClass('draggable');
        $content.find('.btn-close').remove();
        $content.find('#pin-test-modal').remove();
        // Add a remove button
        $content.find('.modal-footer').append('<button type="button" class="btn btn-danger btn-sm remove-pinned-popup ms-2">Remove</button>');
        // Append to droppable area
        $('.nested-droppable').append($content);
        // Hide modal
        $modal.modal('hide');
    });

    // Remove pinned popup
    $(document).on('click', '.remove-pinned-popup', function() {
        $(this).closest('.pinned-popup').remove();
    });
});
</script>

<!-- New pagination and reference handling scripts -->
<script>
    // Global variables for pagination and content management
    var fullHierarchicalData = <?php echo json_encode($tableData->items(), 15, 512) ?>;
    var currentPage = <?php echo e(request('page', 1)); ?>;
    var totalPages = <?php echo e($tableData->lastPage()); ?>;
    var currentCategoryId = <?php echo e($safeTableId); ?>;
    
    // Function to change page with AJAX loading
    function changePage(page, category_id) {
        if (page < 1 || page > totalPages) return;
        
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        url.searchParams.set('category_id', category_id);

        // Show loading state
        const contentArea = document.getElementById('legal-content-area');
        if (contentArea) {
            contentArea.innerHTML = '<div class="text-center p-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading content...</p></div>';
        }

        fetch(url.toString(), { 
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Replace only the content area
            const newContent = doc.getElementById('legal-content-area');
            if (newContent && contentArea) {
                contentArea.innerHTML = newContent.innerHTML;
            }
            
            // Update pagination controls
            const newPaginationControls = doc.querySelector('.pagination-controls');
            const currentPaginationControls = document.querySelector('.pagination-controls');
            if (newPaginationControls && currentPaginationControls) {
                currentPaginationControls.innerHTML = newPaginationControls.innerHTML;
            }
            
            // Update URL without refresh
            window.history.pushState({}, '', url.toString());
            
            // Update current page variable
            currentPage = page;
            
            // Re-initialize reference handlers
            setTimeout(() => {
                attachReferenceHandlers();
                initializeReferences();
            }, 100);
        })
        .catch(error => {
            console.error('Error loading page:', error);
            if (contentArea) {
                contentArea.innerHTML = '<div class="alert alert-danger">Error loading content. Please try again.</div>';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Make all clickable headings act like references
        document.querySelectorAll('.clickable-heading').forEach(function(elem) {
            elem.addEventListener('click', function(e) {
                e.preventDefault();
                const sectionId = this.getAttribute('data-section-id');
                const tableId = this.getAttribute('data-table-id');
                if (sectionId && tableId) {
                    // Create popup with loading state and section ID
                    const popup = createFloatingPopup(
                        this.textContent.trim(), 
                        '<div class="popup-loading"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading section content...</p></div>', 
                        this,
                        sectionId
                    );
                    
                    // Fetch content
                    fetch(`/section-content/${tableId}/${encodeURIComponent(sectionId)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error === false && data.data && Array.isArray(data.data) && data.data.length > 0) {
                                let html = '';
                                data.data.forEach(function(section, index) {
                                    const sectionId = `section-${Date.now()}-${index}`;
                                    html += `<div class="section-item" id="${sectionId}">`;
                                    
                                    // Enhanced section header with better formatting and action buttons
                                    html += `<div class="section-item-header d-flex justify-content-between align-items-center mb-2">`;
                                    html += `<div class="flex-grow-1">`;
                                    if (section.title || section.section_id) {
                                        html += `<div class="d-flex justify-content-between align-items-start">`;
                                        if (section.title) {
                                            html += `<h5 class="section-title mb-0">${section.title}</h5>`;
                                        }
                                        if (section.section_id) {
                                            html += `<span class="badge bg-primary ms-2">${section.section_id}</span>`;
                                        }
                                        html += `</div>`;
                                    }
                                    html += `</div>`;
                                    
                                    // Add section action buttons
                                    html += `<div class="section-item-actions">
                                        <button type="button" class="btn btn-sm btn-outline-secondary section-copy-btn" title="Copy this section" data-section-id="${sectionId}">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary section-close-btn" title="Close this section" data-section-id="${sectionId}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>`;
                                    
                                    html += `</div>`;
                                    
                                    // Section content with better formatting
                                    const content = section.text_content || section.section_text || '';
                                    if (content) {
                                        html += `<div class="section-text">${content}</div>`;
                                    }
                                    
                                    // Enhanced metadata display
                                    html += `<div class="section-meta">`;
                                    if (section.part) {
                                        html += `<div><i class="fas fa-book"></i> Part: ${section.part}</div>`;
                                    }
                                    if (section.division) {
                                        html += `<div><i class="fas fa-folder"></i> Division: ${section.division}</div>`;
                                    }
                                    if (section.sub_division) {
                                        html += `<div><i class="fas fa-folder-open"></i> Sub-division: ${section.sub_division}</div>`;
                                    }
                                    if (section.section !== null && section.section !== undefined) {
                                        html += `<div><i class="fas fa-file-text"></i> Section: ${section.section}</div>`;
                                    }
                                    if (section.sub_section) {
                                        html += `<div><i class="fas fa-indent"></i> Subsection: ${section.sub_section}</div>`;
                                    }
                                    if (section.paragraph) {
                                        html += `<div><i class="fas fa-paragraph"></i> Paragraph: ${section.paragraph}</div>`;
                                    }
                                    html += `</div>`;
                                    html += `</div>`;
                                });
                                
                                popup.querySelector('.popup-content').innerHTML = html;
                                
                                // Update popup header with better information
                                const headerTitle = popup.querySelector('.popup-header h6');
                                if (data.data.length > 0) {
                                    const firstSection = data.data[0];
                                    let newTitle = firstSection.title || 'Legal Reference';
                                    if (firstSection.section_id) {
                                        newTitle = `Section ${firstSection.section_id}: ${newTitle}`;
                                    }
                                    headerTitle.textContent = newTitle;
                                    
                                    // Update section number in header
                                    const sectionNumber = popup.querySelector('.section-number');
                                    if (sectionNumber && firstSection.section_id) {
                                        sectionNumber.textContent = firstSection.section_id;
                                    }
                                }
                                
                                // Setup section copy and close buttons
                                popup.querySelectorAll('.section-copy-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const sectionId = this.getAttribute('data-section-id');
                                        const sectionElement = document.getElementById(sectionId);
                                        if (sectionElement) {
                                            // Get the text content of the section
                                            const title = sectionElement.querySelector('.section-title')?.textContent || '';
                                            const sectionNumber = sectionElement.querySelector('.badge')?.textContent || '';
                                            const content = sectionElement.querySelector('.section-text')?.textContent || '';
                                            const meta = Array.from(sectionElement.querySelectorAll('.section-meta div'))
                                                .map(div => div.textContent.trim())
                                                .join('\n');
                                            
                                            const textToCopy = `${title} ${sectionNumber}\n\n${content}\n\n${meta}`;
                                            
                                            // Copy to clipboard
                                            const textarea = document.createElement('textarea');
                                            textarea.value = textToCopy;
                                            textarea.style.position = 'absolute';
                                            textarea.style.left = '-9999px';
                                            document.body.appendChild(textarea);
                                            textarea.select();
                                            document.execCommand('copy');
                                            document.body.removeChild(textarea);
                                            
                                            // Show feedback
                                            const originalIcon = this.innerHTML;
                                            this.innerHTML = '<i class="fas fa-check"></i>';
                                            setTimeout(() => {
                                                this.innerHTML = originalIcon;
                                            }, 1500);
                                        }
                                    });
                                });
                                
                                popup.querySelectorAll('.section-close-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const sectionId = this.getAttribute('data-section-id');
                                        const sectionElement = document.getElementById(sectionId);
                                        if (sectionElement) {
                                            // Add fade out animation before removing
                                            sectionElement.style.animation = 'sectionFadeOut 0.3s ease-in forwards';
                                            setTimeout(() => {
                                                sectionElement.remove();
                                                
                                                // If no sections left, close the popup
                                                if (popup.querySelectorAll('.section-item').length === 0) {
                                                    popup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
                                                    setTimeout(() => popup.remove(), 200);
                                                }
                                            }, 300);
                                        }
                                    });
                                });
                                
                                setTimeout(attachReferenceHandlers, 100);
                                setTimeout(initializeReferences, 100);
                            } else {
                                popup.querySelector('.popup-content').innerHTML = `
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No content found for section: <strong>${sectionId}</strong>
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            popup.querySelector('.popup-content').innerHTML = `
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Error loading content:</strong> ${error.message}
                                    <br><br>
                                    <button class="btn btn-sm btn-primary retry-btn">
                                        <i class="fas fa-redo me-1"></i> Retry
                                    </button>
                                </div>
                            `;
                            popup.querySelector('.retry-btn')?.addEventListener('click', () => {
                                this.click();
                                popup.remove();
                            });
                        });
                }
            });
        });

        // Initialize reference system on page load
        setTimeout(() => {
            if (typeof attachReferenceHandlers === 'function') {
                attachReferenceHandlers();
            }
            if (typeof initializeReferences === 'function') {
                initializeReferences();
            }
        }, 100);

        // Example of adding direct reference IDs to elements
        document.querySelectorAll('.legal-text').forEach(function(textElem) {
            const rowId = textElem.getAttribute('data-row-id');
            if (rowId) {
                // Add a small reference button after each legal text
                const refButton = document.createElement('button');
                refButton.className = 'btn btn-sm btn-outline-primary ms-2';
                refButton.setAttribute('data-ref-id', '<?php echo e($safeTableId); ?>:' + rowId);
                refButton.innerHTML = '<i class="fas fa-link"></i>';
                refButton.title = 'Direct reference to this text';
                textElem.appendChild(refButton);
            }
        });
    });

    // Enhanced helper function to create floating popups with better styling and section header display
    function createFloatingPopup(title, content, targetElement, sectionId = null) {
        // Create popup container
        const popup = document.createElement('div');
        popup.className = 'floating-popup draggable-popup';
        
        // Add a debug log to help troubleshoot
        console.log('Creating popup for:', { title, sectionId });
        
        // Extract section number from title if available
        const sectionMatch = title.match(/(\d+(?:\.\d+)?(?:\([^)]+\))*)/);
        const sectionNumber = sectionMatch ? sectionMatch[1] : sectionId;
        const cleanTitle = title.replace(/^(section|subsection|paragraph)\s*/i, '').trim();
        
        // Get reference parts (Part, Division, Section) from title or context
        let refPath = '';
        // Attempt to extract Part and Division information
        const partMatch = title.match(/Part\s+(\d+)/i);
        const divisionMatch = title.match(/Division\s+(\d+)/i);
        const sectionFullMatch = title.match(/Section\s+(\d+(?:\.\d+)?(?:\([^)]+\))*)/i);
        
        if (partMatch) {
            refPath += `Part ${partMatch[1]} `;
        }
        if (divisionMatch) {
            refPath += `Division ${divisionMatch[1]} `;
        }
        if (sectionFullMatch || sectionNumber) {
            refPath += `Section ${sectionFullMatch ? sectionFullMatch[1] : sectionNumber}`;
        }
        
        // If we couldn't extract a full path but have a section number, just use that
        if (!refPath && sectionNumber) {
            refPath = sectionNumber;
        }
        
        // Create enhanced header with section number, path, and title
        const header = document.createElement('div');
        header.className = 'popup-header';
        // Use theme color for header background
        header.style.backgroundColor = 'var(--primary-color)';
        header.style.color = '#fff';
        
        header.innerHTML = `
            <div class="d-flex align-items-center flex-grow-1">
                ${refPath ? `<span class="section-path me-2">${refPath}</span>` : ''}
                
            </div>
            <div class="popup-actions">
                <button type="button" class="btn btn-sm popup-collapse-btn" title="Collapse/Expand content">
                    <i class="fas fa-chevron-up text-white"></i>
                </button>
                <button type="button" class="btn btn-sm popup-pin-btn" title="Pin this popup">
                    <i class="fas fa-thumbtack text-white"></i>
                </button>
                <button type="button" class="btn btn-sm popup-close-btn" title="Close popup">
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>
        `;
        
        // Create content area
        const contentDiv = document.createElement('div');
        contentDiv.className = 'popup-content';
        contentDiv.innerHTML = content;
        
        // Append parts to popup
        popup.appendChild(header);
        popup.appendChild(contentDiv);
        
        // Smart positioning to avoid going off-screen
        const targetRect = targetElement.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;
        const popupWidth = 500;
        const popupHeight = 400; // Estimated height
        
        let left = targetRect.left + scrollLeft;
        let top = targetRect.bottom + scrollTop + 10;
        
        // Adjust if popup would go off right edge
        if (left + popupWidth > windowWidth + scrollLeft) {
            left = windowWidth + scrollLeft - popupWidth - 20;
        }
        
        // Adjust if popup would go off bottom edge
        if (top + popupHeight > windowHeight + scrollTop) {
            top = targetRect.top + scrollTop - popupHeight - 10;
        }
        
        // Ensure popup doesn't go off left edge
        if
        // Add important display properties to ensure visibility
        popup.style.display = 'block';
        popup.style.visibility = 'visible';
        popup.style.zIndex = '2000'; // High z-index to ensure it's on top
        
        // Add to document
        document.body.appendChild(popup);
        
        // Make popup draggable with enhanced functionality
        $(popup).draggable({
            handle: '.popup-header',
            containment: false, // allow anywhere
            scroll: false,
            // Fix position before dragging starts to ensure visibility during dragging
            create: function(event, ui) {
                // Ensure it's set to fixed position initially
                $(this).css('position', 'fixed');
            },
            start: function(event, ui) {
                // Get current position before dragging starts
                const offset = $(this).offset();
                const scrollTop = $(window).scrollTop();
                const scrollLeft = $(window).scrollLeft();
                
                // Update position to fixed to avoid disappearing
                $(this).css({
                    'position': 'fixed',
                    'top': offset.top - scrollTop,
                    'left': offset.left - scrollLeft,
                    'opacity': '0.7',
                    'z-index': 2000
                });
                $('.nested-droppable').addClass('highlight-droppable');
            },
            drag: function(event, ui) {
                // Correct position helper to account for fixed positioning
                ui.position.top = ui.offset.top - $(window).scrollTop();
                ui.position.left = ui.offset.left - $(window).scrollLeft();
            },
            stop: function(event, ui) {
                $(this).css({
                    'opacity': '1',
                    'z-index': ''
                });
                $('.nested-droppable').removeClass('highlight-droppable');
                // Always update position to where dropped
                $(this).css({
                    position: 'fixed',
                    top: ui.offset.top - $(window).scrollTop(),
                    left: ui.offset.left - $(window).scrollLeft()
                });
            }
        });

        // Make nested-droppable accept floating popups
        $('.nested-droppable').droppable({
            accept: '.floating-popup',
            tolerance: 'pointer',
            classes: {
                "ui-droppable-hover": "droppable-hover"
            },
            drop: function(event, ui) {
                const droppedPopup = ui.draggable[0];
                // Mark as dropped on droppable
                $(ui.helper).data('dropped-on-droppable', true);
                
                // Clone for pinning
                const clonedContent = droppedPopup.cloneNode(true);
                clonedContent.className = 'pinned-popup card mb-2';
                clonedContent.style.cssText = '';
                
                // Keep the header styling consistent
                const pinnedHeader = clonedContent.querySelector('.popup-header');
                if (pinnedHeader) {
                    pinnedHeader.style.backgroundColor = 'var(--primary-color)';
                    pinnedHeader.style.color = '#fff';
                }
                
                // Update pin button to remove button
                const pinBtn = clonedContent.querySelector('.popup-pin-btn');
                if (pinBtn) {
                    pinBtn.innerHTML = '<i class="fas fa-trash text-white"></i>';
                    pinBtn.classList.remove('popup-pin-btn');
                    pinBtn.classList.add('remove-pinned-btn');
                    pinBtn.title = 'Remove';
                    
                    // Setup remove functionality for the cloned popup
                    pinBtn.addEventListener('click', () => {
                        clonedContent.style.animation = 'popupFadeOut 0.3s ease-in forwards';
                        setTimeout(() => clonedContent.remove(), 300);
                    });
                }
                
                // Remove close button
                clonedContent.querySelector('.popup-close-btn')?.remove();
                
                // Maintain collapse functionality
                const collapseBtn = clonedContent.querySelector('.popup-collapse-btn');
                
                if (collapseBtn) {
                    // Re-attach event listener for collapse functionality
                    collapseBtn.addEventListener('click', (e) => {
                        const contentDiv = clonedContent.querySelector('.popup-content');
                        const icon = e.currentTarget.querySelector('i');
                        
                        if (contentDiv.style.display === 'none') {
                            // Expand
                            contentDiv.style.display = 'block';
                            contentDiv.style.animation = 'popupContentExpand 0.2s ease-out forwards';
                            icon.classList.remove('fa-chevron-down');
                            icon.classList.add('fa-chevron-up');
                        } else {
                            // Collapse
                            contentDiv.style.animation = 'popupContentCollapse 0.2s ease-in forwards';
                            setTimeout(() => {
                                contentDiv.style.display = 'none';
                            }, 200);
                            icon.classList.remove('fa-chevron-up');
                            icon.classList.add('fa-chevron-down');
                        }
                    });
                }
                

                
                // Add to droppable area
                this.insertBefore(clonedContent, this.firstChild);
                
                // Remove the original floating popup with animation
                droppedPopup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
                setTimeout(() => droppedPopup.remove(), 200);
            }
        });
        
        // Close button functionality
        popup.querySelector('.popup-close-btn').addEventListener('click', () => {
            popup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
            setTimeout(() => popup.remove(), 200);
        });
        
        // Collapse button functionality
        popup.querySelector('.popup-collapse-btn').addEventListener('click', (e) => {
            const contentDiv = popup.querySelector('.popup-content');
            const icon = e.currentTarget.querySelector('i');
            
            if (contentDiv.style.display === 'none') {
                // Expand
                contentDiv.style.display = 'block';
                contentDiv.style.animation = 'popupContentExpand 0.2s ease-out forwards';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                // Collapse
                contentDiv.style.animation = 'popupContentCollapse 0.2s ease-in forwards';
                setTimeout(() => {
                    contentDiv.style.display = 'none';
                }, 200);
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
        

        
        // Pin button functionality
        popup.querySelector('.popup-pin-btn').addEventListener('click', () => {
            // Clone for pinning to nested-droppable area
            const clonedContent = popup.cloneNode(true);
            clonedContent.className = 'pinned-popup';
            clonedContent.style.cssText = '';
            
            // Keep the header styling consistent
            const pinnedHeader = clonedContent.querySelector('.popup-header');
            if (pinnedHeader) {
                pinnedHeader.style.backgroundColor = 'var(--primary-color)';
                pinnedHeader.style.color = '#fff';
            }
            
            // Update pin button to remove button
            const pinBtn = clonedContent.querySelector('.popup-pin-btn');
            pinBtn.innerHTML = '<i class="fas fa-trash text-white"></i>';
            pinBtn.classList.remove('popup-pin-btn');
            pinBtn.classList.add('remove-pinned-btn');
            pinBtn.title = 'Remove';
            
            // Update close button functionality
            clonedContent.querySelector('.popup-close-btn').remove();
            
            // Maintain collapse functionality
            const collapseBtn = clonedContent.querySelector('.popup-collapse-btn');
            
            if (collapseBtn) {
                // Re-attach event listener for collapse functionality
                collapseBtn.addEventListener('click', (e) => {
                    const contentDiv = clonedContent.querySelector('.popup-content');
                    const icon = e.currentTarget.querySelector('i');
                    
                    if (contentDiv.style.display === 'none') {
                        // Expand
                        contentDiv.style.display = 'block';
                        contentDiv.style.animation = 'popupContentExpand 0.2s ease-out forwards';
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    } else {
                        // Collapse
                        contentDiv.style.animation = 'popupContentCollapse 0.2s ease-in forwards';
                        setTimeout(() => {
                            contentDiv.style.display = 'none';
                        }, 200);
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                });
            }
            

            
            // Add to droppable area
            const droppableArea = document.querySelector('.nested-droppable') || document.querySelector('#legal-content-area');
            if (droppableArea) {
                droppableArea.insertBefore(clonedContent, droppableArea.firstChild);
            }
            
            // Setup remove functionality
            pinBtn.addEventListener('click', () => {
                clonedContent.style.animation = 'popupFadeOut 0.3s ease-in forwards';
                setTimeout(() => clonedContent.remove(), 300);
            });
            
            // Remove the original floating popup
            popup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
            setTimeout(() => popup.remove(), 200);
        });
        
        // Add animations CSS if not exists
        if (!document.querySelector('#popup-animations')) {
            const style = document.createElement('style');
           
            style.id = 'popup-animations';
            style.textContent = `
                @keyframes popupFadeOut {
                    from {
                        opacity:  1;
                        transform: translateY(0) scale(1);
                    }
                    to {
                        opacity: 0;
                        transform: translateY(-10px) scale(0.95);
                    }
                }
                
                @keyframes popupContentCollapse {
                    from {
                        opacity: 1;
                        max-height: 400px;
                    }
                    to {
                        opacity: 0;
                        max-height: 0;
                    }
                }
                
                @keyframes popupContentExpand {
                    from {
                        opacity: 0;
                        max-height: 0;
                    }
                    to {
                        opacity: 1;
                        max-height: 400px;
                    }
                }
                
                @keyframes sectionFadeOut {
                    from {
                        opacity: 1;
                        transform: translateY(0);
                    }
                    to {
                        opacity: 0;
                        transform: translateY(-10px);
                        max-height: 0;
                        padding-top: 0;
                        padding-bottom: 0;
                        margin-top: 0;
                        margin-bottom: 0;
                    }
                }
                
                .floating-popup {
                    position: fixed !important;
                    display: block !important;
                    visibility: visible !important;
                    z-index: 2000 !important;
                    background-color: #fff !important;
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
                .pinned-popup .popup-actions button,
                .section-item-actions button {
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
            `;
            document.head.appendChild(style);
        }
        
        return popup;
    }

    // Define the enhanced attachReferenceHandlers function if it doesn't exist
    if (typeof attachReferenceHandlers !== 'function') {
        function attachReferenceHandlers() {
            $('.ref').off('click').on('click', function(e) {
                e.preventDefault();
                const sectionId = $(this).data('section-id');
                const tableId = $(this).data('table-id');
                
                if (sectionId && tableId) {
                    // Create a floating popup with enhanced styling and section ID
                    const popup = createFloatingPopup(
                        $(this).text().trim(), 
                        '<div class="popup-loading"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading reference content...</p></div>',
                        this,
                        sectionId
                    );
                    
                    // Fetch content for the reference
                    fetch(`/section-content/${tableId}/${encodeURIComponent(sectionId)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error === false && data.data && Array.isArray(data.data) && data.data.length > 0) {
                                let html = '';
                                data.data.forEach(function(section, index) {
                                    const sectionId = `section-${Date.now()}-${index}`;
                                    html += `<div class="section-item" id="${sectionId}">`;
                                    
                                    // Enhanced section header with action buttons
                                    html += `<div class="section-item-header d-flex justify-content-between align-items-center mb-2">`;
                                    html += `<div class="flex-grow-1">`;
                                    if (section.title || section.section_id) {
                                        html += `<div class="d-flex justify-content-between align-items-start">`;
                                        if (section.title) {
                                            html += `<h5 class="section-title mb-0">${section.title}</h5>`;
                                        }
                                        if (section.section_id) {
                                            html += `<span class="badge bg-primary ms-2">${section.section_id}</span>`;
                                        }
                                        html += `</div>`;
                                    }
                                    html += `</div>`;
                                    
                                    // Add section action buttons
                                    html += `<div class="section-item-actions">
                                        <button type="button" class="btn btn-sm btn-outline-secondary section-copy-btn" title="Copy this section" data-section-id="${sectionId}">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary section-close-btn" title="Close this section" data-section-id="${sectionId}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>`;
                                    
                                    html += `</div>`;
                                    
                                    // Section content
                                    const content = section.text_content || section.section_text || '';
                                    if (content) {
                                        html += `<div class="section-text">${content}</div>`;
                                    }
                                    
                                    // Metadata
                                    html += `<div class="section-meta">`;
                                    if (section.part) html += `<div><i class="fas fa-book"></i> Part: ${section.part}</div>`;
                                    if (section.division) html += `<div><i class="fas fa-folder"></i> Division: ${section.division}</div>`;
                                    if (section.sub_division) html += `<div><i class="fas fa-folder-open"></i> Sub-division: ${section.sub_division}</div>`;
                                    if (section.section !== null && section.section !== undefined) html += `<div><i class="fas fa-file-text"></i> Section: ${section.section}</div>`;
                                    if (section.sub_section) html += `<div><i class="fas fa-indent"></i> Subsection: ${section.sub_section}</div>`;
                                    if (section.paragraph) html += `<div><i class="fas fa-paragraph"></i> Paragraph: ${section.paragraph}</div>`;
                                    html += `</div>`;
                                    html += `</div>`;
                                });
                                
                                popup.querySelector('.popup-content').innerHTML = html;
                                
                                // Update header with section information
                                if (data.data.length > 0) {
                                    const firstSection = data.data[0];
                                    const headerTitle = popup.querySelector('.popup-header h6');
                                    if (headerTitle && firstSection.title) {
                                        headerTitle.textContent = firstSection.title;
                                    }
                                }
                                
                                // Setup section copy and close buttons
                                popup.querySelectorAll('.section-copy-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const sectionId = this.getAttribute('data-section-id');
                                        const sectionElement = document.getElementById(sectionId);
                                        if (sectionElement) {
                                            // Get the text content of the section
                                            const title = sectionElement.querySelector('.section-title')?.textContent || '';
                                            const sectionNumber = sectionElement.querySelector('.badge')?.textContent || '';
                                            const content = sectionElement.querySelector('.section-text')?.textContent || '';
                                            const meta = Array.from(sectionElement.querySelectorAll('.section-meta div'))
                                                .map(div => div.textContent.trim())
                                                .join('\n');
                                            
                                            const textToCopy = `${title} ${sectionNumber}\n\n${content}\n\n${meta}`;
                                            
                                            // Copy to clipboard
                                            const textarea = document.createElement('textarea');
                                            textarea.value = textToCopy;
                                            textarea.style.position = 'absolute';
                                            textarea.style.left = '-9999px';
                                            document.body.appendChild(textarea);
                                            textarea.select();
                                            document.execCommand('copy');
                                            document.body.removeChild(textarea);
                                            
                                            // Show feedback
                                            const originalIcon = this.innerHTML;
                                            this.innerHTML = '<i class="fas fa-check"></i>';
                                            setTimeout(() => {
                                                this.innerHTML = originalIcon;
                                            }, 1500);
                                        }
                                    });
                                });
                                
                                popup.querySelectorAll('.section-close-btn').forEach(btn => {
                                    btn.addEventListener('click', function() {
                                        const sectionId = this.getAttribute('data-section-id');
                                        const sectionElement = document.getElementById(sectionId);
                                        if (sectionElement) {
                                            // Add fade out animation before removing
                                            sectionElement.style.animation = 'sectionFadeOut 0.3s ease-in forwards';
                                            setTimeout(() => {
                                                sectionElement.remove();
                                                
                                                // If no sections left, close the popup
                                                if (popup.querySelectorAll('.section-item').length === 0) {
                                                    popup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
                                                    setTimeout(() => popup.remove(), 200);
                                                }
                                            }, 300);
                                        }
                                    });
                                });
                                
                                setTimeout(attachReferenceHandlers, 100);
                                setTimeout(initializeReferences, 100);
                            } else {
                                popup.querySelector('.popup-content').innerHTML = `
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        No content found for reference: <strong>${sectionId}</strong>
                                    </div>
                                `;
                            }
                        })
                        .catch(error => {
                            popup.querySelector('.popup-content').innerHTML = `
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Error loading reference:</strong> ${error.message}
                                    <br><br>
                                    <button class="btn btn-sm btn-primary retry-btn">
                                        <i class="fas fa-redo me-1"></i> Retry
                                    </button>
                                </div>
                            `;
                            popup.querySelector('.retry-btn')?.addEventListener('click', () => {
                                $(this).click();
                                popup.remove();
                            });
                        });
                }
            });
        }
    }
    
    // Define initializeReferences function if it doesn't exist
    if (typeof initializeReferences !== 'function') {
        function initializeReferences() {
            console.log('Initializing references...');
            // Add any additional reference initialization code here
        }
    }

    // Debug function to check references
    function runDebugChecks() {
        const debugOutput = document.getElementById('debug-output');
        const debugContent = document.getElementById('debug-content');
        
        if (!debugOutput || !debugContent) return;
        
        // Show debug panel
        debugOutput.style.display = 'block';
        
        // Clear previous output
        debugContent.innerHTML = '<div class="text-center">Running debug checks...</div>';
        
        setTimeout(() => {
            let output = '<h5>Reference Elements</h5>';
            
            // Count and display reference elements
            const refElements = document.querySelectorAll('.ref');
            output += `<p>Found ${refElements.length} reference elements on the page.</p>`;
            
            // Sample a few references to check their data attributes
            const sampleSize = Math.min(5, refElements.length);
            if (sampleSize > 0) {
                output += '<h6>Sample References:</h6><ul>';
                
                for (let i = 0; i < sampleSize; i++) {
                    const ref = refElements[i];
                    const sectionId = ref.getAttribute('data-section-id');
                    const tableId = ref.getAttribute('data-table-id') || ref.getAttribute('data-category-id');
                    
                    output += `<li>
                        <strong>Text:</strong> ${ref.textContent}<br>
                        <strong>data-section-id:</strong> ${sectionId || 'missing'}<br>
                        <strong>data-table-id/category-id:</strong> ${tableId || 'missing'}<br>
                        <button class="btn btn-sm btn-outline-primary test-ref-btn mt-1" 
                                data-section-id="${sectionId}" 
                                data-table-id="${tableId}">Test This Reference</button>
                    </li>`;
                }
                
                output += '</ul>';
            }
            
            // Direct reference links
            const directRefs = document.querySelectorAll('.direct-reference');
            output += `<p>Found ${directRefs.length} direct reference links on the page.</p>`;
            
            // Sample direct references
            const directSampleSize = Math.min(3, directRefs.length);
            if (directSampleSize > 0) {
                output += '<h6>Sample Direct References:</h6><ul>';
                
                for (let i = 0; i < directSampleSize; i++) {
                    const ref = directRefs[i];
                    const refId = ref.getAttribute('data-ref-id');
                    
                    output += `<li>
                        <strong>Text:</strong> ${ref.textContent}<br>
                        <strong>data-ref-id:</strong> ${refId || 'missing'}<br>
                        <button class="btn btn-sm btn-outline-primary test-direct-ref-btn mt-1" 
                                data-ref-id="${refId}">Test This Direct Reference</button>
                    </li>`;
                }
                
                output += '</ul>';
            }
            
            // Add section on context detection
            output += '<h5>Context Detection Test</h5>';
            output += '<p>Click this button to test the context detection for a simulated paragraph reference:</p>';
            output += '<button id="test-context-detection" class="btn btn-sm btn-primary mb-3">Test Context Detection</button>';
            output += '<div id="context-detection-result"></div>';
            
            // Update debug content
            debugContent.innerHTML = output;
            
            // Attach event handlers for test buttons
            debugContent.querySelectorAll('.test-ref-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const sectionId = this.getAttribute('data-section-id');
                    const tableId = this.getAttribute('data-table-id');
                    
                    // Find closest parent li
                    const li = this.closest('li');
                    li.innerHTML += '<div class="mt-2 p-2 bg-light"><strong>Testing...</strong></div>';
                    
                    // Make the API call to test
                    fetch(`/section-content/${tableId}/${encodeURIComponent(sectionId)}`)
                        .then(response => response.json())
                        .then(data => {
                            const resultDiv = li.querySelector('div');
                            resultDiv.innerHTML = `<strong>Result:</strong><br>
                                Status: ${data.error ? 'Error' : 'Success'}<br>
                                Found rows: ${data.data ? data.data.length : 0}<br>
                                <button class="btn btn-sm btn-outline-secondary mt-1" onclick="console.log('API Response:', ${JSON.stringify(data)})">Log Full Response</button>`;
                        })
                        .catch(error => {
                            const resultDiv = li.querySelector('div');
                            resultDiv.innerHTML = `<strong>Error:</strong> ${error.message}`;
                        });
                });
            });
            
            // Test direct reference links
            debugContent.querySelectorAll('.test-direct-ref-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const refId = this.getAttribute('data-ref-id');
                    
                    // Find closest parent li
                    const li = this.closest('li');
                    li.innerHTML += '<div class="mt-2 p-2 bg-light"><strong>Testing...</strong></div>';
                    
                    // Make the API call to test
                    fetch(`/reference/${encodeURIComponent(refId)}`)
                        .then(response => response.json())
                        .then(data => {
                            const resultDiv = li.querySelector('div');
                            resultDiv.innerHTML = `<strong>Result:</strong><br>
                                Status: ${data.error ? 'Error' : 'Success'}<br>
                                <button class="btn btn-sm btn-outline-secondary mt-1" onclick="console.log('API Response:', ${JSON.stringify(data)})">Log Full Response</button>`;
                        })
                        .catch(error => {
                            const resultDiv = li.querySelector('div');
                            resultDiv.innerHTML = `<strong>Error:</strong> ${error.message}`;
                        });
                });
            });
            
            // Context detection test
            document.getElementById('test-context-detection').addEventListener('click', function() {
                const resultDiv = document.getElementById('context-detection-result');
                resultDiv.innerHTML = '<div class="p-2 bg-light">Detecting context...</div>';
                
                // Find a section element to test with
                const sections = document.querySelectorAll('.section-section');
                if (sections.length > 0) {
                    // Pick a random section
                    const randomIndex = Math.floor(Math.random() * sections.length);
                    const section = sections[randomIndex];
                    
                    // Try to get the section ID
                    const sectionHeading = section.querySelector('.clickable-heading');
                    let sectionId = sectionHeading ? sectionHeading.getAttribute('data-section-id') : 'unknown';
                    
                    // Find a subsection if it exists
                    const subsection = section.querySelector('.subsection-section');
                    let subsectionId = '';
                    if (subsection) {
                        const subsectionHeading = subsection.querySelector('.clickable-heading');
                        subsectionId = subsectionHeading ? subsectionHeading.getAttribute('data-section-id') : '';
                    }
                    
                    // Create a dummy reference element inside this section
                    const dummyRef = document.createElement('span');
                    dummyRef.className = 'ref';
                    dummyRef.setAttribute('data-section-id', '(a)');
                    dummyRef.setAttribute('data-table-id', '<?php echo e($safeTableId); ?>');
                    dummyRef.textContent = 'paragraph (a)';
                    
                    // Temporarily append it to the section
                    section.appendChild(dummyRef);
                    
                    // Now test the context detection
                    let contextSection = '';
                    let contextSubsection = '';
                    
                    // Try to find context
                    const dummySectionContainer = dummyRef.closest('.section-section');
                    if (dummySectionContainer) {
                        const dummySectionHeading = dummySectionContainer.querySelector('.clickable-heading');
                        if (dummySectionHeading) {
                            contextSection = dummySectionHeading.getAttribute('data-section-id');
                        }
                        
                        // Look for subsection
                        const dummySubsectionContainer = dummyRef.closest('.subsection-section');
                        if (dummySubsectionContainer) {
                            const dummySubsectionHeading = dummySubsectionContainer.querySelector('.clickable-heading');
                            if (dummySubsectionHeading) {
                                contextSubsection = dummySubsectionHeading.getAttribute('data-section-id');
                            }
                        }
                    }
                    
                    // Remove the dummy element
                    dummyRef.remove();
                    
                    // Show results
                    resultDiv.innerHTML = `
                        <div class="p-3 bg-light">
                            <h6>Context Detection Results:</h6>
                            <p>
                                <strong>Selected section:</strong> ${sectionId}<br>
                                <strong>Selected subsection:</strong> ${subsectionId || 'none'}<br>
                                <strong>Detected context section:</strong> ${contextSection || 'none'}<br>
                                <strong>Detected context subsection:</strong> ${contextSubsection || 'none'}
                            </p>
                            <div class="alert ${contextSection === sectionId ? 'alert-success' : 'alert-danger'}">
                                Context detection is ${contextSection === sectionId ? 'working correctly' : 'not working correctly'}
                            </div>
                        </div>
                    `;
                } else {
                    resultDiv.innerHTML = '<div class="alert alert-warning">No section elements found to test with.</div>';
                }
            });
        }, 100);
    }
</script>

<!-- Translation functionality for view-legal-table page -->
<script>
    // Translation functionality for view-legal-table page
    function translateViewLegalTablePage(language) {
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

        // Translate buttons and interactive elements
        const buttons = document.querySelectorAll('button[data-en][data-fr]');
        buttons.forEach(button => {
            const translation = button.getAttribute('data-' + language);
            if (translation) {
                button.textContent = translation;
            }
        });
    }

    // Listen for language change events from the main layout
    window.addEventListener('languageChanged', function(event) {
        const selectedLanguage = event.detail.language;
        translateViewLegalTablePage(selectedLanguage);
    });

    // Apply saved language on page load
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
    translateViewLegalTablePage(savedLanguage);
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('head-scripts'); ?>
<!-- Font Awesome Icons for enhanced UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.with-sidebar-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\juris_1.0\resources\views/view-legal-table-data-personal.blade.php ENDPATH**/ ?>