

<?php $__env->startSection('admin-content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-edit me-2"></i>Edit Legal Document
        </h5>
        <a href="<?php echo e(route('admin.legal-documents.index')); ?>" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to All Documents
        </a>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-1"></i><?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Document Metadata Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Document Information</h6>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.legal-documents.update', $document->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="act_name" class="form-label">Act Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?php $__errorArgs = ['act_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="act_name" name="act_name" value="<?php echo e(old('act_name', $document->act_name)); ?>" required>
                                <?php $__errorArgs = ['act_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="language" class="form-label">Language <span class="text-danger">*</span></label>
                                <select class="form-select <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="language" name="language" required>
                                    <option value="">Select Language</option>
                                    <option value="en" <?php echo e(old('language', $document->language) == 'en' ? 'selected' : ''); ?>>English</option>
                                    <option value="fr" <?php echo e(old('language', $document->language) == 'fr' ? 'selected' : ''); ?>>French</option>
                                    <option value="Both" <?php echo e(old('language', $document->language) == 'Both' ? 'selected' : ''); ?>>Both (English & French)</option>
                                </select>
                                <?php $__errorArgs = ['language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="law_id" class="form-label">Law ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?php $__errorArgs = ['law_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="law_id" name="law_id" value="<?php echo e(old('law_id', $document->law_id)); ?>" required>
                                <?php $__errorArgs = ['law_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="act_id" class="form-label">Act ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?php $__errorArgs = ['act_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="act_id" name="act_id" value="<?php echo e(old('act_id', $document->act_id)); ?>" required>
                                <?php $__errorArgs = ['act_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="jurisdiction_id" class="form-label">Jurisdiction ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?php $__errorArgs = ['jurisdiction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="jurisdiction_id" name="jurisdiction_id" value="<?php echo e(old('jurisdiction_id', $document->jurisdiction_id)); ?>" required>
                                <?php $__errorArgs = ['jurisdiction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Document Properties (Read-only) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Table Name</label>
                                <div class="form-control-plaintext bg-light p-2 rounded"><?php echo e($document->table_name); ?></div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Original Filename</label>
                                <div class="form-control-plaintext bg-light p-2 rounded"><?php echo e($document->original_filename); ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-control-plaintext">
                                    <span class="badge <?php echo e($document->status == 'active' ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo e(ucfirst($document->status ?? 'active')); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload Date</label>
                                <div class="form-control-plaintext bg-light p-2 rounded"><?php echo e(\Carbon\Carbon::parse($document->created_at)->format('F d, Y H:i:s')); ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Document Information
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Document Content Section -->
        <?php if($documentContent && count($documentContent) > 0): ?>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-file-text me-2"></i>Legal Document Content
                        <small class="ms-2 opacity-75">(Click the <i class="fas fa-edit"></i> icon next to any content to edit it)</small>
                    </h6>
                </div>
                <div class="card-body" id="legal-content-area">
                    <?php
                        $data = [];
                        $standaloneData = [];
                        
                        foreach ($documentContent as $row) {
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
                                            'id' => $row->id,
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
                                                'id' => $row->id,
                                                'text_content' => $row->text_content,
                                                'paragraphs' => [],
                                                'footnote' => $row->footnote
                                            ];
                                        }
                                        
                                        if ($row->paragraph !== null) {
                                            $paraNum = $row->paragraph;
                                            $standaloneData[$title]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum] = [
                                                'id' => $row->id,
                                                'text_content' => $row->text_content,
                                                'sub_paragraphs' => [],
                                                'footnote' => $row->footnote
                                            ];
                                            
                                            if ($row->sub_paragraph !== null) {
                                                $standaloneData[$title]['sections'][$sectionNum]['subsections'][$subSectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                                    'id' => $row->id,
                                                    'sub_paragraph' => $row->sub_paragraph,
                                                    'text_content' => $row->text_content,
                                                    'footnote' => $row->footnote
                                                ];
                                            }
                                        }
                                    } elseif ($row->paragraph !== null) {
                                        $paraNum = $row->paragraph;
                                        $standaloneData[$title]['sections'][$sectionNum]['paragraphs'][$paraNum] = [
                                            'id' => $row->id,
                                            'text_content' => $row->text_content,
                                            'sub_paragraphs' => [],
                                            'footnote' => $row->footnote
                                        ];
                                        
                                        if ($row->sub_paragraph !== null) {
                                            $standaloneData[$title]['sections'][$sectionNum]['paragraphs'][$paraNum]['sub_paragraphs'][] = [
                                                'id' => $row->id,
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
                                $sectionNum = $row->section;                                    
                                if (!isset($data[$partNum]['sections'][$sectionNum])) {
                                    // Check if title is the same as the parent title, if so don't duplicate it
                                    $sectionTitle = ($row->title === $data[$partNum]['title']) ? '' : $row->title;
                                    $data[$partNum]['sections'][$sectionNum] = [
                                        'id' => $row->id,
                                        'title' => $sectionTitle,
                                        'text_content' => $row->text_content,
                                        'subsections' => [],
                                        'paragraphs' => [],
                                        'footnote' => $row->footnote
                                    ];
                                }
                            }
                        }
                    ?>

                    
                    <?php $__currentLoopData = $standaloneData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $titleGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="legal-document-section mb-4">
                            <h2 class="section-title mb-3"><?php echo e($title); ?></h2>
                            <div class="section-content">
                                <?php $__currentLoopData = $titleGroup['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionNumber => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="legal-section" id="section-<?php echo e($sectionNumber); ?>">
                                        <div class="d-flex align-items-start mb-2">
                                            <?php if(!empty($section['title']) && trim($section['title']) !== ''): ?>
                                                <h4 class="clickable-heading mb-0"><?php echo e($section['title']); ?></h4>
                                            <?php endif; ?>
                                            <a href="#" class="edit-content-btn text-primary ms-2" 
                                               data-bs-toggle="modal" 
                                               data-bs-target="#editContentModal" 
                                               data-id="<?php echo e($section['id']); ?>" 
                                               data-title="<?php echo e($section['title']); ?>" 
                                               data-content="<?php echo e(htmlspecialchars($section['text_content'])); ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                        <div class="section-body">
                                            <?php if(!empty($section['text_content'])): ?>
                                                <div class="legal-text">
                                                    <span class="section-number"><?php echo e($sectionNumber); ?></span> 
                                                    <div class="html-rendered-content"><?php echo $section['text_content']; ?></div>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php $__currentLoopData = $section['subsections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subsectionNumber => $subsection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="subsection-item ms-4 mt-3">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="legal-text flex-grow-1">
                                                            <span class="subsection-number">(<?php echo e($subsectionNumber); ?>)</span> 
                                                            <div class="html-rendered-content"><?php echo $subsection['text_content']; ?></div>
                                                        </div>
                                                        <a href="#" class="edit-content-btn text-primary ms-2" 
                                                           data-bs-toggle="modal" 
                                                           data-bs-target="#editContentModal" 
                                                           data-id="<?php echo e($subsection['id']); ?>" 
                                                           data-title="" 
                                                           data-content="<?php echo e(htmlspecialchars($subsection['text_content'])); ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    
                                                    <?php $__currentLoopData = $subsection['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraphNumber => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="paragraph-item ms-4 mt-2">
                                                            <div class="d-flex justify-content-between align-items-start">
                                                                <div class="legal-text flex-grow-1">
                                                                    <span class="paragraph-letter">(<?php echo e($paragraphNumber); ?>)</span> 
                                                                    <div class="html-rendered-content"><?php echo $paragraph['text_content']; ?></div>
                                                                </div>
                                                                <a href="#" class="edit-content-btn text-primary ms-2" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#editContentModal" 
                                                                   data-id="<?php echo e($paragraph['id']); ?>" 
                                                                   data-title="" 
                                                                   data-content="<?php echo e(htmlspecialchars($paragraph['text_content'])); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                            
                                                            <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="sub-paragraph-item ms-4 mt-2">
                                                                    <div class="d-flex justify-content-between align-items-start">
                                                                        <div class="legal-text flex-grow-1">
                                                                            <span class="sub-paragraph-numeral">(<?php echo e($subParagraph['sub_paragraph']); ?>)</span> 
                                                                            <div class="html-rendered-content"><?php echo $subParagraph['text_content']; ?></div>
                                                                        </div>
                                                                        <a href="#" class="edit-content-btn text-primary ms-2" 
                                                                           data-bs-toggle="modal" 
                                                                           data-bs-target="#editContentModal" 
                                                                           data-id="<?php echo e($subParagraph['id']); ?>" 
                                                                           data-title="" 
                                                                           data-content="<?php echo e(htmlspecialchars($subParagraph['text_content'])); ?>">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <?php $__currentLoopData = $section['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraphNumber => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="paragraph-section mt-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="legal-text">
                                                            <strong>(<?php echo e($paragraphNumber); ?>)</strong> <?php echo nl2br(e($paragraph['text_content'])); ?>

                                                        </div>
                                                        <a href="#" class="edit-content-btn text-primary" 
                                                           data-bs-toggle="modal" 
                                                           data-bs-target="#editContentModal" 
                                                           data-id="<?php echo e($paragraph['id']); ?>" 
                                                           data-title="" 
                                                           data-content="<?php echo e(htmlspecialchars($paragraph['text_content'])); ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    
                                                    <?php $__currentLoopData = $paragraph['sub_paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subParagraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="sub-paragraph-section mt-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="legal-text">
                                                                    <strong>(<?php echo e($subParagraph['sub_paragraph']); ?>)</strong> <?php echo nl2br(e($subParagraph['text_content'])); ?>

                                                                </div>
                                                                <a href="#" class="edit-content-btn text-primary" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#editContentModal" 
                                                                   data-id="<?php echo e($subParagraph['id']); ?>" 
                                                                   data-title="" 
                                                                   data-content="<?php echo e(htmlspecialchars($subParagraph['text_content'])); ?>">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <?php if(!empty($section['footnote'])): ?>
                                                <div class="footnote mt-2">
                                                    <div class="html-rendered-content footnote-content"><?php echo $section['footnote']; ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partNumber => $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="legal-document-section mb-4">
                            <h2 class="section-title mb-3">Part <?php echo e($partNumber); ?>: <?php echo e($part['title']); ?></h2>
                            <div class="section-content">
                                <?php if(!empty($part['sections'])): ?>
                                    <?php $__currentLoopData = $part['sections']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionNumber => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="legal-section" id="section-<?php echo e($sectionNumber); ?>">
                                            <div class="d-flex align-items-start mb-2">
                                                <?php if(!empty($section['title']) && trim($section['title']) !== '' && $section['title'] !== $part['title']): ?>
                                                    <h4 class="clickable-heading mb-0"><?php echo e($section['title']); ?></h4>
                                                <?php else: ?>
                                                    <h4 class="clickable-heading mb-0">Section <?php echo e($sectionNumber); ?></h4>
                                                <?php endif; ?>
                                                <a href="#" class="edit-content-btn text-primary ms-2" 
                                                   data-bs-toggle="modal" 
                                                   data-bs-target="#editContentModal" 
                                                   data-id="<?php echo e($section['id']); ?>" 
                                                   data-title="<?php echo e($section['title']); ?>" 
                                                   data-content="<?php echo e(htmlspecialchars($section['text_content'])); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="section-body">
                                                <?php if(!empty($section['text_content'])): ?>
                                                    <div class="legal-text">
                                                        <span class="section-number"><?php echo e($sectionNumber); ?></span> <?php echo nl2br(e($section['text_content'])); ?>

                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php if(!empty($section['footnote'])): ?>
                                                    <div class="footnote mt-2"><?php echo nl2br(e($section['footnote'])); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
                    <h5 class="text-muted">No Content Available</h5>
                    <p class="text-muted mb-0">No content found for this document. The document may be empty or the table may no longer exist.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Edit Content Modal -->
<div class="modal fade" id="editContentModal" tabindex="-1" aria-labelledby="editContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContentModalLabel">Edit Content</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editContentForm" action="<?php echo e(route('admin.legal-documents.update', $document->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    
                    <input type="hidden" id="content_id" name="content_id">
                    
                    <div class="mb-3">
                        <label for="content_text" class="form-label">Edit Selected Content</label>
                        <textarea class="form-control" id="content_text" name="content[text_content]" rows="15"></textarea>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            <span id="editor-status">Rich text editor will be loaded when the modal opens. HTML tags and formatting are preserved.</span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="saveContentBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* General Layout Improvements */
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .card-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }
    
    .form-control-plaintext {
        font-weight: 500;
        color: #495057;
    }
    
    /* Legal Document Content Styles */
    .legal-document-section {
        margin-bottom: 2rem;
        border: 1px solid #e9ecef;
        border-radius: 0.375rem;
        overflow: hidden;
    }
    
    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(135deg, #007bff, #0056b3);
        padding: 1rem;
        margin: 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .section-content {
        padding: 1.5rem;
        background: #fff;
    }
    
    .legal-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #f8f9fa;
    }
    
    .legal-section:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .clickable-heading {
        color: #007bff;
        cursor: pointer;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .clickable-heading:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    
    .section-number {
        font-weight: bold;
        color: #495057;
    }
    
    .subsection-number {
        font-weight: 600;
        color: #6c757d;
    }
    
    .paragraph-letter {
        font-weight: 600;
        color: #6c757d;
    }
    
    .sub-paragraph-numeral {
        font-weight: 600;
        color: #6c757d;
    }
    
    .subsection-item {
        padding-left: 1.5rem;
        margin-bottom: 0.75rem;
        border-left: 2px solid #e9ecef;
        padding-left: 1rem;
    }
    
    .paragraph-item {
        padding-left: 1.5rem;
        border-left: 2px solid #f8f9fa;
        margin-top: 0.5rem;
    }
    
    .sub-paragraph-item {
        padding-left: 1.5rem;
        border-left: 2px solid #f8f9fa;
        margin-top: 0.25rem;
    }
    
    .legal-text {
        line-height: 1.7;
        margin-bottom: 0.5rem;
        color: #333;
    }
    
    .footnote {
        font-size: 0.875rem;
        color: #6c757d;
        font-style: italic;
        margin-top: 0.75rem;
        padding-top: 0.5rem;
        border-top: 1px dashed #dee2e6;
    }
    
    .edit-content-btn {
        font-size: 0.875rem;
        color: #007bff;
        transition: all 0.2s ease;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        background: rgba(0, 123, 255, 0.1);
        border: 1px solid transparent;
    }
    
    .edit-content-btn:hover {
        background: rgba(0, 123, 255, 0.2);
        border-color: #007bff;
        transform: translateY(-1px);
        text-decoration: none;
        color: #0056b3;
    }
    
    .section-body {
        margin-left: 0.5rem;
        margin-top: 0.75rem;
    }
    
    /* HTML Rendered Content Display */
    .html-rendered-content {
        margin-top: 0.5rem;
        font-size: 0.95rem;
        line-height: 1.6;
        color: #333;
        margin-bottom: 0.5rem;
    }
    
    .html-rendered-content b {
        font-weight: 600;
        color: #212529;
    }
    
    .html-rendered-content i {
        font-style: italic;
        color: #6c757d;
    }
    
    .html-rendered-content br {
        margin-bottom: 0.5rem;
        display: block;
        content: "";
    }
    
    /* Definition styling */
    .definition-item {
        margin-bottom: 1.5rem;
        position: relative;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 0.375rem;
        border-left: 4px solid #007bff;
    }
    
    .definition-term {
        font-weight: 600;
        color: #007bff;
        margin-right: 0.5rem;
    }
    
    .definition-desc {
        display: inline;
        color: #495057;
    }
    
    .definition-list {
        padding-left: 0;
    }
    
    .definition-item:last-child {
        margin-bottom: 0;
    }
    
    .footnote-content {
        font-size: 0.85rem;
        color: #6c757d;
        font-style: italic;
    }
    
    /* External link styling for subsection references */
    .subsection-ref {
        color: #007bff;
        text-decoration: none;
        border-bottom: 1px dashed #007bff;
    }
    
    .subsection-ref:hover {
        color: #0056b3;
        border-bottom: 1px solid #0056b3;
    }
    
    /* Modal improvements */
    .modal-dialog {
        max-width: 800px;
    }
    
    .modal-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-bottom: none;
    }
    
    .modal-header .btn-close {
        filter: invert(1);
    }
    
    .modal-body {
        padding: 2rem;
    }
    
    .modal-footer {
        border-top: 1px solid #dee2e6;
        padding: 1rem 2rem;
    }
    
    /* Form improvements */
    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .text-danger {
        font-weight: 500;
    }
    
    .alert {
        border: none;
        border-radius: 0.5rem;
    }
    
    .alert-success {
        background-color: #d1edff;
        color: #084298;
        border-left: 4px solid #0d6efd;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded - Setting up TinyMCE system...');
    
    // Global variables
    let tinyMCEInstance = null;
    let currentContentToEdit = '';
    let currentEditId = '';

    // Function to decode HTML entities
    function decodeHtmlEntities(str) {
        if (!str) return '';
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = str;
        return tempDiv.textContent || tempDiv.innerText || '';
    }

    // Function to update status message
    function updateStatus(type, message) {
        const statusElement = document.getElementById('editor-status');
        if (!statusElement) return;

        let icon = '';
        switch (type) {
            case 'loading':
                icon = '<i class="fas fa-spinner fa-spin me-1"></i>';
                break;
            case 'success':
                icon = '<i class="fas fa-check text-success me-1"></i>';
                break;
            case 'error':
                icon = '<i class="fas fa-exclamation-triangle text-warning me-1"></i>';
                break;
        }

        statusElement.innerHTML = icon + message;
    }

    // Initialize TinyMCE when modal opens
    function initTinyMCEForModal() {
        const contentToSet = currentContentToEdit; // Use the global variable
        console.log('Initializing TinyMCE with content:', contentToSet ? contentToSet.substring(0, 100) + '...' : 'No content');
        
        if (typeof tinymce === 'undefined') {
            console.error('TinyMCE is not loaded');
            updateStatus('error', 'Rich text editor not available. Using plain text.');
            return;
        }

        // Remove any existing instance
        if (tinyMCEInstance) {
            tinymce.remove('#content_text');
            tinyMCEInstance = null;
        }

        updateStatus('loading', 'Loading rich text editor...');

        // Initialize TinyMCE with the content
        tinymce.init({
            selector: '#content_text',
            height: 400,
            menubar: false,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic underline strikethrough | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | link | code | fullscreen | help',
            content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; line-height: 1.5; }',
            
            // Set the initial content directly
            init_instance_callback: function (editor) {
                console.log('TinyMCE instance created');
                tinyMCEInstance = editor;
                
                // Set content immediately in the callback
                if (contentToSet && contentToSet.trim()) {
                    console.log('Setting initial content in callback:', contentToSet.substring(0, 50) + '...');
                    editor.setContent(contentToSet);
                    updateStatus('success', 'Rich text editor loaded with content.');
                } else {
                    console.log('No content to set in callback');
                    updateStatus('success', 'Rich text editor loaded.');
                }
            },
            
            setup: function (editor) {
                editor.on('init', function () {
                    console.log('TinyMCE editor initialized - checking content');
                    
                    // Double-check content setting with a more reliable approach
                    setTimeout(() => {
                        const currentContent = editor.getContent();
                        console.log('Current editor content:', currentContent);
                        
                        if (contentToSet && contentToSet.trim()) {
                            if (!currentContent || currentContent.trim() === '' || 
                                currentContent === '<p><br data-mce-bogus="1"></p>' ||
                                currentContent === '<p></p>' || currentContent === '<br>') {
                                console.log('Content not properly set, setting again...');
                                editor.setContent(contentToSet);
                                // Force another check
                                setTimeout(() => {
                                    const finalContent = editor.getContent();
                                    console.log('Final content check:', finalContent);
                                    updateStatus('success', 'Content loaded successfully.');
                                }, 200);
                            } else {
                                console.log('Content already set correctly');
                                updateStatus('success', 'Content loaded successfully.');
                            }
                        } else {
                            console.log('No content to set');
                            updateStatus('success', 'Rich text editor ready.');
                        }
                    }, 250); // Increased timeout for more reliable content setting
                });
            },
            
            branding: false,
            elementpath: false,
            statusbar: true,
            resize: true,
            convert_urls: false,
            relative_urls: false,
            paste_data_images: false,
            valid_elements: '*[*]',
            extended_valid_elements: '*[*]',
            verify_html: false
        }).catch(function(error) {
            console.error('TinyMCE initialization failed:', error);
            updateStatus('error', 'Failed to load rich text editor. Using plain text.');
        });
    }

    // Handle edit button clicks
    const editButtons = document.querySelectorAll('.edit-content-btn');
    console.log('Found', editButtons.length, 'edit buttons');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const content = this.getAttribute('data-content');
            
            console.log('=== Edit Button Clicked ===');
            console.log('ID:', id);
            console.log('Title:', title);
            console.log('Raw content length:', content ? content.length : 0);
            console.log('Raw content preview:', content ? content.substring(0, 100) + '...' : 'No content');
            
            // Decode content
            const decodedContent = decodeHtmlEntities(content);
            console.log('Decoded content length:', decodedContent ? decodedContent.length : 0);
            console.log('Decoded content preview:', decodedContent ? decodedContent.substring(0, 100) + '...' : 'No decoded content');
            
            // Store globally - this is what TinyMCE will use
            currentContentToEdit = decodedContent || '';
            currentEditId = id;
            
            console.log('Stored globally - currentContentToEdit length:', currentContentToEdit.length);
            
            // Set form values immediately (fallback for plain textarea)
            document.getElementById('content_id').value = id;
            document.getElementById('content_text').value = currentContentToEdit;
            
            // Update modal title
            const modalTitle = document.getElementById('editContentModalLabel');
            modalTitle.textContent = `Edit Content${title ? ' - ' + title : ''} (ID: ${id})`;
            
            console.log('Content prepared for modal - ready to initialize TinyMCE');
        });
    });

    // Handle modal shown event
    const editContentModal = document.getElementById('editContentModal');
    editContentModal.addEventListener('shown.bs.modal', function() {
        console.log('Modal opened - initializing TinyMCE with stored content:', currentContentToEdit ? currentContentToEdit.substring(0, 50) + '...' : 'No content');
        
        // Small delay to ensure modal is fully rendered
        setTimeout(() => {
            initTinyMCEForModal(); // No parameter needed, uses global variable
        }, 100);
    });

    // Handle modal hide event
    editContentModal.addEventListener('hidden.bs.modal', function() {
        console.log('Modal closed - cleaning up');
        
        // Remove TinyMCE instance
        if (tinyMCEInstance) {
            tinymce.remove('#content_text');
            tinyMCEInstance = null;
        }
        
        // Clear form
        document.getElementById('content_id').value = '';
        document.getElementById('content_text').value = '';
        document.getElementById('editContentModalLabel').textContent = 'Edit Content';
        
        // Clear globals
        currentContentToEdit = '';
        currentEditId = '';
        
        // Reset status
        updateStatus('info', 'Rich text editor will be loaded when the modal opens.');
    });

    // Handle save button
    document.getElementById('saveContentBtn').addEventListener('click', function() {
        const id = document.getElementById('content_id').value;
        
        if (!id) {
            alert('No content selected for editing.');
            return;
        }
        
        // Get content from TinyMCE or textarea
        let text = '';
        if (tinyMCEInstance) {
            try {
                text = tinyMCEInstance.getContent();
                console.log('Getting content from TinyMCE');
            } catch (error) {
                console.error('Error getting TinyMCE content:', error);
                text = document.getElementById('content_text').value;
                console.log('Fallback to textarea content');
            }
        } else {
            text = document.getElementById('content_text').value;
            console.log('Using textarea content (no TinyMCE)');
        }
        
        if (!text.trim()) {
            if (!confirm('The content is empty. Do you want to save empty content?')) {
                return;
            }
        }
        
        // Prepare form submission
        const form = document.getElementById('editContentForm');
        
        // Clear existing inputs
        const existingInputs = form.querySelectorAll('input[type="hidden"]:not([name="content_id"]):not([name="_token"]):not([name="_method"])');
        existingInputs.forEach(input => input.remove());
        
        // Add content data
        const contentIdInput = document.createElement('input');
        contentIdInput.type = 'hidden';
        contentIdInput.name = `content[${id}][id]`;
        contentIdInput.value = id;
        form.appendChild(contentIdInput);
        
        const textInput = document.createElement('input');
        textInput.type = 'hidden';
        textInput.name = `content[${id}][text_content]`;
        textInput.value = text;
        form.appendChild(textInput);
        
        console.log('Submitting form with content length:', text.length);
        form.submit();
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel_new\resources\views/admin/legal-documents/edit.blade.php ENDPATH**/ ?>