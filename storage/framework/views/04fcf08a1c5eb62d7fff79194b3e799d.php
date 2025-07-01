<?php $__env->startSection('meta'); ?>
    <!-- Current document context meta tags -->
    <meta name="current-document-table" content="<?php echo e($tableName); ?>">
    <meta name="current-document-category-id" content="<?php echo e($categoryId); ?>">
    <meta name="current-client-id" content="<?php echo e($client->id); ?>">
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
        border-radius: 5px;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
        margin-bottom: 1rem;
    }
    .pinned-popup .modal-header {
        background: #f8f9fa;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #dee2e6;
    }
    .pinned-popup .modal-body {
        padding: 1rem;
    }
    .pinned-popup .modal-footer {
        padding: 0.5rem;
        border-top: 1px solid #dee2e6;
        background: #f8f9fa;
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
    
    /* Floating popup styles */
    .floating-popup {
        position: absolute;
        z-index: 1050;
        background: #fff;
        border-radius: 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        width: 450px;
        max-width: 90vw;
        border: 1px solid rgba(0,0,0,0.2);
    }
    
    .popup-header {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #dee2e6;
        background-color: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .popup-content {
        padding: 1rem;
        max-height: 60vh;
        overflow-y: auto;
    }
    
    /* Mobile adjustments */
    @media (max-width: 768px) {
        .floating-popup {
            width: 90vw;
            max-height: 80vh;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main-content'); ?>
            <!-- <h2>Table: <?php echo e($legalTable->table_name); ?></h2>
            <h4>(<?php echo e($legalTable->act_name ?? ''); ?>)</h4> -->
            <?php if(isset($client) && $client): ?>
                <div class="gap_top alert alert-info mb-3">
                    <strong data-en="Client:" data-fr="Client :">Client:</strong> <?php echo e($client->client_name ?? 'N/A'); ?><br>
                    <strong data-en="Email:" data-fr="Courriel :">Email:</strong> <?php echo e($client->client_email ?? 'N/A'); ?><br>
                    <strong data-en="Status:" data-fr="Statut :">Status:</strong> <?php echo e($client->client_status ?? 'N/A'); ?>

                </div>
            <?php endif; ?>
            <?php if(empty($columns)): ?>
                <div class="alert alert-warning mt-4" data-en="No data found in this table." data-fr="Aucune donnée trouvée dans cette table.">No data found in this table.</div>
            <?php else: ?>
            <!-- Keyword Search Section -->
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0" data-en="Keyword Search" data-fr="Recherche par mots-clés">Keyword Search</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('client.legalTables.view', $legalTable->id)); ?>" method="GET" class="mb-3">
                        <?php if(isset($client) && $client): ?>
                            <input type="hidden" name="client_id" value="<?php echo e($client->id); ?>">
                        <?php endif; ?>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search..." 
                                   data-placeholder-en="Search..." 
                                   data-placeholder-fr="Rechercher..." 
                                   value="<?php echo e(request('search')); ?>">
                            <button class="btn btn-primary" type="submit" data-en="Search" data-fr="Rechercher">Search</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Content Display Area -->
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0" data-en="Legal Content" data-fr="Contenu juridique">Legal Content</h5>
                </div>
                <div class="card-body" id="legal-content-area">

                    <?php
                        // Build hierarchical structure similar to PHP version
                        $data = [];
                        $standaloneData = [];
                        
                        foreach ($tableData as $row) {
                            // Handle standalone sections (sections without parts)
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
                                        $standaloneData[$title]['sections'][$sectionNum] = [
                                            'title' => $row->title,
                                            'text_content' => $row->text_content,
                                            'subsections' => [],
                                            'paragraphs' => [],
                                            'footnote' => $row->footnote
                                        ];
                                    }
                                    
                                    // Handle subsections and paragraphs for standalone sections
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
                            
                            // Handle parts structure
                            $partNum = $row->part;
                            if (!isset($data[$partNum])) {
                                $data[$partNum] = [
                                    'title' => $row->title,
                                    'divisions' => [],
                                    'sections' => []
                                ];
                            }
                            
                            // Handle direct sections under part (no division/subdivision)
                            if ($row->section !== null && empty($row->division) && empty($row->sub_division)) {
                                $sectionNum = $row->section;
                                if (!isset($data[$partNum]['sections'][$sectionNum])) {
                                    $data[$partNum]['sections'][$sectionNum] = [
                                        'title' => $row->title,
                                        'text_content' => $row->text_content,
                                        'subsections' => [],
                                        'paragraphs' => [],
                                        'footnote' => $row->footnote
                                    ];
                                }
                                
                                // Handle subsections and paragraphs
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
                            // Handle division structure
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
                                            $data[$partNum]['divisions'][$divisionNum]['sub_divisions'][$subDivisionNum]['sections'][$sectionNum] = [
                                                'title' => $row->title,
                                                'text_content' => $row->text_content,
                                                'subsections' => [],
                                                'paragraphs' => [],
                                                'footnote' => $row->footnote
                                            ];
                                        }
                                        
                                        // Handle subsections and paragraphs within divisions
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
                        
                        // Helper function to make links clickable (simplified version)
                        function makeLinksClickableSimple($text, $categoryId, $currentSection = null) {
                            if (empty($text)) return "";
                            
                            // Basic section references
                            $text = preg_replace(
                                '/\b(section|sections)\s+(\d+(?:\.\d+)?)\b/i',
                                '<span class="ref" data-section-id="$2" data-table-id="' . $categoryId . '">$1 $2</span>',
                                $text
                            );
                            
                            // Basic subsection references
                            $text = preg_replace(
                                '/\b(subsection|subsections)\s+\((\d+(?:\.\d+)?)\)/i',
                                '<span class="ref" data-section-id="' . ($currentSection ?? '') . '($2)" data-table-id="' . $categoryId . '">$1 ($2)</span>',
                                $text
                            );
                            
                            // Basic paragraph references
                            $text = preg_replace(
                                '/\b(paragraph|paragraphs)\s+\(([a-z\d\.]+)\)/i',
                                '<span class="ref" data-section-id="' . ($currentSection ?? '') . '($2)" data-table-id="' . $categoryId . '">$1 ($2)</span>',
                                $text
                            );
                            
                            // Standalone complex references
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
                                <?php $__currentLoopData = $group['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionNumber => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($section['title']) && !isset($section['is_intro'])): ?>
                                        <div style="margin-top: 1em; color: #333; font-weight: bold;"><?php echo e($section['title']); ?></div>
                                    <?php endif; ?>
                                    <?php if(!empty($section['text_content'])): ?>
                                        <div style="margin-left: 0.5em; margin-bottom: 1em;">
                                            <?php if(!isset($section['is_intro'])): ?>
                                                <strong><?php echo e($sectionNumber); ?></strong>
                                            <?php endif; ?>
                                            <?php echo makeLinksClickableSimple($section['text_content'], $legalTable->id, isset($section['is_intro']) ? null : $sectionNumber); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php $__currentLoopData = $section['subsections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsectionNumber => $subsection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div style="margin-left: 2em;">
                                            <?php if(!empty($subsection['text_content'])): ?>
                                                <div style="margin-bottom: 0.5em;">
                                                    <strong>(<?php echo e($subsectionNumber); ?>)</strong> <?php echo makeLinksClickableSimple($subsection['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')'); ?>

                                                </div>
                                            <?php endif; ?>
                                            <?php $__currentLoopData = $subsection['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraphNumber => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="margin-left: 2em;">
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong>(<?php echo e($paragraphNumber); ?>)</strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')'); ?>

                                                    </div>
                                                    <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div style="margin-left: 2em;">
                                                            <div style="margin-bottom: 0.5em;">
                                                                <strong>(<?php echo e($subParagraph['sub_paragraph']); ?>)</strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

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
                                                <strong>(<?php echo e($paragraphNumber); ?>)</strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraphNumber . ')'); ?>

                                            </div>
                                            <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="margin-left: 2em;">
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong>(<?php echo e($subParagraph['sub_paragraph']); ?>)</strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

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
                                        <?php if(!empty($section['title'])): ?>
                                            <div style="margin-top: 1em; color: #333; font-weight: bold;"><?php echo e($section['title']); ?></div>
                                        <?php endif; ?>
                                        <?php if(!empty($section['text_content'])): ?>
                                            <div style="margin-left: 0.5em; margin-bottom: 1em;">
                                                <strong><?php echo e($sectionNumber); ?></strong> <?php echo makeLinksClickableSimple($section['text_content'], $legalTable->id, $sectionNumber); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $section['subsections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsectionNumber => $subsection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div style="margin-left: 2em;">
                                                <?php if(!empty($subsection['title'])): ?>
                                                    <div style="font-style: italic;"><?php echo e($subsection['title']); ?></div>
                                                <?php endif; ?>
                                                <?php if(!empty($subsection['text_content'])): ?>
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong>(<?php echo e($subsectionNumber); ?>)</strong> <?php echo makeLinksClickableSimple($subsection['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')'); ?>

                                                    </div>
                                                <?php endif; ?>
                                                <?php $__currentLoopData = $subsection['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraphNumber => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div style="margin-left: 2em;">
                                                        <div style="margin-bottom: 0.5em;">
                                                            <strong>(<?php echo e($paragraphNumber); ?>)</strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')'); ?>

                                                        </div>
                                                        <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div style="margin-left: 2em;">
                                                                <div style="margin-bottom: 0.5em;">
                                                                    <strong>(<?php echo e($subParagraph['sub_paragraph']); ?>)</strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

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
                                                    <strong>(<?php echo e($paragraph['paragraph']); ?>)</strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')'); ?>

                                                </div>
                                                <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div style="margin-left: 2em;">
                                                        <div style="margin-bottom: 0.5em;">
                                                            <strong>(<?php echo e($subParagraph['sub_paragraph']); ?>)</strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

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
                                                                    <strong><?php echo e($sectionNumber); ?></strong> <?php echo makeLinksClickableSimple($section['text_content'], $legalTable->id, $sectionNumber); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                            <?php $__currentLoopData = $section['subsections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsectionNumber => $subsection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div style="margin-left: 2em;">
                                                                    <?php if(!empty($subsection['title'])): ?>
                                                                        <div style="font-style: italic;"><?php echo e($subsection['title']); ?></div>
                                                                    <?php endif; ?>
                                                                    <?php if(!empty($subsection['text_content'])): ?>
                                                                        <div style="margin-bottom: 0.5em;">
                                                                            <strong><?php echo e($subsectionNumber); ?></strong> <?php echo makeLinksClickableSimple($subsection['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')'); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <?php $__currentLoopData = $subsection['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div style="margin-left: 2em;">
                                                                            <div style="margin-bottom: 0.5em;">
                                                                                <strong><?php echo e($paragraph['paragraph']); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraph['paragraph'] . ')'); ?>

                                                                            </div>
                                                                            <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div style="margin-left: 2em;">
                                                                                    <div style="margin-bottom: 0.5em;">
                                                                                        <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

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
                                                                        <strong><?php echo e($paragraph['paragraph']); ?></strong> <?php echo makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')'); ?>

                                                                    </div>
                                                                    <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div style="margin-left: 2em;">
                                                                            <div style="margin-bottom: 0.5em;">
                                                                                <strong><?php echo e($subParagraph['sub_paragraph']); ?></strong> <?php echo makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')'); ?>

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
            
            <!-- Additional pagination controls for page boundaries -->
            <div class="pagination-controls d-flex justify-content-center align-items-center mt-3 gap-3">
                <button id="prev-page-btn" class="btn btn-outline-primary" onclick="changePage(currentPage - 1, currentCategoryId)" <?php echo e(request('page', 1) <= 1 ? 'disabled' : ''); ?>>
                    Previous
                </button>
                
                <select id="page-select" class="form-select" style="width: auto;" onchange="changePage(this.value, currentCategoryId)">
                    <?php for($i = 1; $i <= $tableData->lastPage(); $i++): ?>
                        <option value="<?php echo e($i); ?>" <?php echo e(request('page', 1) == $i ? 'selected' : ''); ?>>
                            Page <?php echo e($i); ?> of <?php echo e($tableData->lastPage()); ?>

                        </option>
                    <?php endfor; ?>
                </select>
                
                <button id="next-page-btn" class="btn btn-outline-primary" onclick="changePage(currentPage + 1, currentCategoryId)" <?php echo e(request('page', 1) >= $tableData->lastPage() ? 'disabled' : ''); ?>>
                    Next
                </button>
            </div>
            <?php endif; ?>
                
<?php $__env->startSection('page-scripts'); ?>
<!-- Content-specific scripts for the page -->
<script>
    // Global variables for pagination and content management
    var fullHierarchicalData = <?php echo json_encode($tableData->items(), 15, 512) ?>;
    var currentPage = <?php echo e(request('page', 1)); ?>;
    var totalPages = <?php echo e($tableData->lastPage()); ?>;
    var currentCategoryId = <?php echo e($legalTable->id); ?>;
    
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
            '<span class="ref" data-section-id="$2" data-table-id="<?php echo e($legalTable->id); ?>">$1 $2</span>'
        );
        // Pattern 2: paragraph references
        processedText = processedText.replace(
            /\b(paragraph|paragraphs)\s+\(([a-z\d\.]+)\)(?:\s+or\s+\(([a-z\d\.]+)\))?/gi,
            function(match, type, firstRef, secondRef) {
                // Try to get context from parent .legal-text div
                const section = $(this).closest('.legal-text').data('section-id') || '';
                let sectionId = section ? section + '(' + firstRef + ')' : '(' + firstRef + ')';
                let result = '<span class="ref" data-section-id="' + sectionId + '" data-table-id="<?php echo e($legalTable->id); ?>">' + type + ' (' + firstRef + ')</span>';
                if (secondRef) {
                    let secondSectionId = section ? section + '(' + secondRef + ')' : '(' + secondRef + ')';
                    result += ' or <span class="ref" data-section-id="' + secondSectionId + '" data-table-id="<?php echo e($legalTable->id); ?>">(' + secondRef + ')</span>';
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
                let result = '<span class="ref" data-section-id="' + sectionId + '" data-table-id="<?php echo e($legalTable->id); ?>">' + type + ' (' + firstRef + ')</span>';
                if (secondRef) {
                    let secondSectionId = section ? section + '(' + secondRef + ')' : '(' + secondRef + ')';
                    result += ' or <span class="ref" data-section-id="' + secondSectionId + '" data-table-id="<?php echo e($legalTable->id); ?>">(' + secondRef + ')</span>';
                }
                return result;
            }
        );
        // Pattern 4: complex section references like 279.1(2)
        processedText = processedText.replace(
            /\b(\d+(?:\.\d+)?(?:\([^)]+\)){1,4})\b(?!\s*\([a-z](?:\.\d+)?\))(?![^<>]*<\/span>)/g,
            '<span class="ref" data-section-id="$1" data-table-id="<?php echo e($legalTable->id); ?>">$1</span>'
        );
        // Pattern 5: explicit section references
        processedText = processedText.replace(
            /\b(section|subsection|paragraph)\s+(\d+(?:\.\d+)?)\((\d+(?:\.\d+)?)\)(?:\(([a-z\d\.]+)\))?/gi,
            function(match, type, section, subsection, paragraph) {
                let sectionId = section + '(' + subsection + ')';
                if (paragraph) sectionId += '(' + paragraph + ')';
                return '<span class="ref" data-section-id="' + sectionId + '" data-table-id="<?php echo e($legalTable->id); ?>">' + match + '</span>';
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
    var currentCategoryId = <?php echo e($legalTable->id); ?>;
    
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
                    // Create popup with loading state
                    const popup = createFloatingPopup(
                        this.textContent.trim(), 
                        '<div class="text-center p-3"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading content...</p></div>', 
                        this
                    );
                    
                    // Fetch content
                    fetch(`/section-content/${tableId}/${encodeURIComponent(sectionId)}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error === false && data.data && Array.isArray(data.data) && data.data.length > 0) {
                                let html = '';
                                data.data.forEach(function(section) {
                                    html += `<div class="section-item mb-3 p-3 border-bottom">`;
                                    if (section.title) {
                                        html += `<h5 class="section-title text-primary mb-2">${section.title}</h5>`;
                                    }
                                    if (section.text_content) {
                                        html += `<div class="section-text mb-2">${section.text_content}</div>`;
                                    } else if (section.section_text) {
                                        html += `<div class="section-text mb-2">${section.section_text}</div>`;
                                    } 
                                    html += `<div class="section-meta small text-muted">`;
                                    if (section.section_id) {
                                        html += `<div>Section: ${section.section_id}</div>`;
                                    }
                                    html += `</div>`;
                                    html += `</div>`;
                                });
                                popup.querySelector('.popup-content').innerHTML = html;
                                setTimeout(attachReferenceHandlers, 100);
                                setTimeout(initializeReferences, 100);
                            } else {
                                popup.querySelector('.popup-content').innerHTML = '<div class="alert alert-info">No content found for this section.</div>';
                            }
                        })
                        .catch(error => {
                            popup.querySelector('.popup-content').innerHTML = `
                                <div class="alert alert-warning">
                                    <p>Error loading content: ${error.message}</p>
                                    <button class="btn btn-sm btn-primary mt-2 retry-btn">Retry</button>
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
                refButton.setAttribute('data-ref-id', '<?php echo e($legalTable->id); ?>:' + rowId);
                refButton.innerHTML = '<i class="fas fa-link"></i>';
                refButton.title = 'Direct reference to this text';
                textElem.appendChild(refButton);
            }
        });
    });

    // Helper function to create floating popups
    function createFloatingPopup(title, content, targetElement) {
        // Create popup container
        const popup = document.createElement('div');
        popup.className = 'floating-popup draggable-popup';
        popup.style.cssText = 'position:absolute; z-index:1050; width:450px; background:#fff; box-shadow:0 0.5rem 1rem rgba(0,0,0,0.15); border-radius:0.375rem; overflow:hidden;';
        
        // Create header
        const header = document.createElement('div');
        header.className = 'popup-header bg-light p-2 d-flex justify-content-between align-items-center';
        header.style.cursor = 'move';
        header.innerHTML = `
            <h6 class="mb-0">${title}</h6>
            <div class="popup-actions">
                <button type="button" class="btn btn-sm btn-success popup-pin-btn me-1">📌 Pin</button>
                <button type="button" class="btn btn-sm btn-secondary popup-close-btn">✕</button>
            </div>
        `;
        
        // Create content area
        const contentDiv = document.createElement('div');
        contentDiv.className = 'popup-content p-3';
        contentDiv.innerHTML = content;
        
        // Append parts to popup
        popup.appendChild(header);
        popup.appendChild(contentDiv);
        
        // Position popup near the element
        const targetRect = targetElement.getBoundingClientRect();
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
        
        popup.style.top = (targetRect.bottom + scrollTop + 10) + 'px';
        popup.style.left = (targetRect.left + scrollLeft) + 'px';
        
        // Add to document
        document.body.appendChild(popup);
        
        // Make popup draggable
        $(popup).draggable({
            handle: '.popup-header',
            containment: 'window'
        });
        
        // Close button functionality
        popup.querySelector('.popup-close-btn').addEventListener('click', () => {
            popup.remove();
        });
        
        // Pin button functionality
        popup.querySelector('.popup-pin-btn').addEventListener('click', () => {
            // Clone for pinning to nested-droppable area
            const clonedContent = popup.cloneNode(true);
            clonedContent.style.position = 'static';
            clonedContent.style.width = '100%';
            clonedContent.style.marginBottom = '1rem';
            
            // Update pin button to remove button
            const pinBtn = clonedContent.querySelector('.popup-pin-btn');
            pinBtn.textContent = '🗑️ Remove';
            pinBtn.classList.remove('btn-success');
            pinBtn.classList.add('btn-danger');
            
            // Update close button functionality
            clonedContent.querySelector('.popup-close-btn').remove();
            
            // Add to droppable area
            document.querySelector('.nested-droppable').appendChild(clonedContent);
            
            // Setup remove functionality
            pinBtn.addEventListener('click', () => {
                clonedContent.remove();
            });
            
            // Remove the original floating popup
            popup.remove();
        });
        
        return popup;
    }

    // Define the attachReferenceHandlers function if it doesn't exist
    if (typeof attachReferenceHandlers !== 'function') {
        function attachReferenceHandlers() {
            $('.ref').off('click').on('click', function(e) {
                e.preventDefault();
                const sectionId = $(this).data('section-id');
                const tableId = $(this).data('table-id');
                
                if (sectionId && tableId) {
                    // Create a floating popup with the reference content
                    createFloatingPopup(
                        $(this).text(), 
                        '<div class="text-center p-3"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading content...</p></div>',
                        this
                    );
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
                    dummyRef.setAttribute('data-table-id', '<?php echo e($legalTable->id); ?>');
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

<?php echo $__env->make('layouts.with-sidebar-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\j.v1-main\resources\views/view-legal-table-data.blade.php ENDPATH**/ ?>