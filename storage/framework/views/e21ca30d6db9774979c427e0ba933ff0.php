

<?php $__env->startSection('admin-content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5>Edit Legal Document</h5>
        <a href="<?php echo e(route('admin.legal-documents.index')); ?>" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to All Documents
        </a>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        
        <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>
          
        <!-- Example Definitions Section -->
        <div class="legal-document-section mb-4">
            <h2 class="section-title mb-3">Interpretation</h2>
            <div class="section-content">
                <div class="legal-section" id="section-definitions">
                    <div class="d-flex align-items-start mb-2">
                        <h4 class="clickable-heading mb-0">Definitions</h4>
                        <a href="#" class="edit-content-btn text-primary ms-2">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="section-body">
                        <div class="legal-text">
                            <span class="section-number">2(1)</span> 
                            <div class="html-rendered-content">The definitions in this subsection apply in this Act.<br><br></div>
                        </div>
                        
                        <div class="definition-list">
                            <div class="definition-item d-flex">
                                <div class="legal-text flex-grow-1">
                                    <div class="html-rendered-content">
                                        <b>Board</b> means the Immigration and Refugee Board, which consists of the Refugee Protection Division, Refugee Appeal Division, Immigration Division and Immigration Appeal Division. (<i>Commission</i>)
                                    </div>
                                </div>
                                <a href="#" class="edit-content-btn text-primary ms-2" data-bs-toggle="modal" data-bs-target="#editContentModal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            
                            <div class="definition-item d-flex">
                                <div class="legal-text flex-grow-1">
                                    <div class="html-rendered-content">
                                        <b>Convention Against Torture</b> means the Convention Against Torture and Other Cruel, Inhuman or Degrading Treatment or Punishment, signed at New York on December 10, 1984. Article 1 of the Convention Against Torture is set out in the schedule. (<i>Convention contre la torture</i>)
                                    </div>
                                </div>
                                <a href="#" class="edit-content-btn text-primary ms-2" data-bs-toggle="modal" data-bs-target="#editContentModal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            
                            <div class="definition-item d-flex">
                                <div class="legal-text flex-grow-1">
                                    <div class="html-rendered-content">
                                        <b>designated foreign national</b> has the meaning assigned by subsection 20.1(2). (<i>étranger désigné</i>)
                                    </div>
                                </div>
                                <a href="#" class="edit-content-btn text-primary ms-2" data-bs-toggle="modal" data-bs-target="#editContentModal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            
                            <div class="definition-item d-flex">
                                <div class="legal-text flex-grow-1">
                                    <div class="html-rendered-content">
                                        <b>foreign national</b> means a person who is not a Canadian citizen or a permanent resident, and includes a stateless person. (<i>étranger</i>)
                                    </div>
                                </div>
                                <a href="#" class="edit-content-btn text-primary ms-2" data-bs-toggle="modal" data-bs-target="#editContentModal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                            
                            <div class="definition-item d-flex">
                                <div class="legal-text flex-grow-1">
                                    <div class="html-rendered-content">
                                        <b>permanent resident</b> means a person who has acquired permanent resident status and has not subsequently lost that status under section 46. (<i>résident permanent</i>)
                                    </div>
                                </div>
                                <a href="#" class="edit-content-btn text-primary ms-2" data-bs-toggle="modal" data-bs-target="#editContentModal">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <form action="<?php echo e(route('admin.legal-documents.update', $document->id)); ?>" method="POST" class="mb-5">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="act_name" class="form-label">Act Name:</label>
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
                        <label for="language" class="form-label">Language:</label>
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
                        <label for="law_id" class="form-label">Law ID:</label>
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
                        <label for="act_id" class="form-label">Act ID:</label>
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
                        <label for="jurisdiction_id" class="form-label">Jurisdiction ID:</label>
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
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <p><strong>Table Name:</strong> <?php echo e($document->table_name); ?></p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <p><strong>Original Filename:</strong> <?php echo e($document->original_filename); ?></p>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <p><strong>Status:</strong> 
                            <span class="badge <?php echo e($document->status == 'active' ? 'bg-success' : 'bg-danger'); ?>">
                                <?php echo e(ucfirst($document->status ?? 'active')); ?>

                            </span>
                        </p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <p><strong>Upload Date:</strong> <?php echo e(\Carbon\Carbon::parse($document->created_at)->format('F d, Y H:i:s')); ?></p>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Document</button>
        </form>
        
        <?php if($documentContent && count($documentContent) > 0): ?>
            <hr class="my-4">
            
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Legal Document Content</h5>
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
            <div class="alert alert-warning mt-4">
                <i class="fas fa-exclamation-triangle"></i> No content found for this document. The document may be empty or the table may no longer exist.
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
                        <label for="content_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="content_title" name="content[title]">
                    </div>
                    
                    <div class="mb-3">
                        <label for="content_text" class="form-label">Content</label>
                        <textarea class="form-control" id="content_text" name="content[text_content]" rows="10"></textarea>
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
    .legal-document-section {
        margin-bottom: 2rem;
    }
    
    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #ddd;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .legal-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
    }
    
    .clickable-heading {
        color: #007bff;
        cursor: pointer;
        font-weight: 600;
    }
    
    .clickable-heading:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    
    .section-number {
        font-weight: bold;
    }
    
    .subsection-number {
        font-weight: 600;
    }
    
    .paragraph-letter {
        font-weight: 600;
    }
    
    .sub-paragraph-numeral {
        font-weight: 600;
    }
    
    .subsection-item {
        padding-left: 1.5rem;
        margin-bottom: 0.75rem;
    }
    
    .paragraph-item {
        padding-left: 1.5rem;
    }
    
    .sub-paragraph-item {
        padding-left: 1.5rem;
    }
    
    .legal-text {
        line-height: 1.7;
        margin-bottom: 0.5rem;
    }
    
    .footnote {
        font-size: 0.8rem;
        color: #6c757d;
        font-style: italic;
        margin-top: 0.5rem;
    }
    
    .edit-content-btn {
        font-size: 0.9rem;
        color: #007bff;
        transition: all 0.2s;
    }
    
    .edit-content-btn:hover {
        transform: scale(1.2);
        color: #0056b3;
    }
    
    .section-body {
        margin-left: 1rem;
    }
    
    /* HTML Rendered Content Display */
    .html-rendered-content {
        margin-top: 5px;
        font-size: 0.95rem;
        line-height: 1.6;
        color: #333;
        padding-left: 2px;
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
    
    /* Definition term styling */
    .definition-item {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .definition-term {
        font-weight: 600;
        color: #007bff;
        margin-right: 0.5rem;
    }
    
    .definition-desc {
        display: inline;
    }
    
    .definition-list {
        padding-left: 2rem;
    }
    
    .definition-item {
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f0f0f0;
        align-items: flex-start;
    }
    
    .definition-item:last-child {
        border-bottom: none;
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
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners for definition terms to improve accessibility
    document.querySelectorAll('.definition-term').forEach(function(element) {
        element.setAttribute('tabindex', '0');
        element.setAttribute('role', 'button');
    });
    
    // Handle edit button clicks
    const editButtons = document.querySelectorAll('.edit-content-btn');
    
    editButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const content = this.getAttribute('data-content');
            
            document.getElementById('content_id').value = id;
            document.getElementById('content_title').value = title || '';
            document.getElementById('content_text').value = content;
        });
    });
    
    // Handle save button click
    document.getElementById('saveContentBtn').addEventListener('click', function() {
        const id = document.getElementById('content_id').value;
        const title = document.getElementById('content_title').value;
        const text = document.getElementById('content_text').value;
        
        const form = document.getElementById('editContentForm');
        
        // Set form field values
        const contentIdInput = document.createElement('input');
        contentIdInput.type = 'hidden';
        contentIdInput.name = `content[${id}][id]`;
        contentIdInput.value = id;
        form.appendChild(contentIdInput);
        
        const titleInput = document.createElement('input');
        titleInput.type = 'hidden';
        titleInput.name = `content[${id}][title]`;
        titleInput.value = title;
        form.appendChild(titleInput);
        
        const textInput = document.createElement('input');
        textInput.type = 'hidden';
        textInput.name = `content[${id}][text_content]`;
        textInput.value = text;
        form.appendChild(textInput);
        
        // Submit the form
        form.submit();
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\New folder (5)\j.v1-main-2\resources\views/admin/legal-documents/edit.blade.php ENDPATH**/ ?>