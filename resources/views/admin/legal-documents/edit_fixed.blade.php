@extends('layouts.admin')

@section('admin-content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-edit me-2"></i>Edit Legal Document
        </h5>
        <a href="{{ route('admin.legal-documents.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to All Documents
        </a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-1"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Document Metadata Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Document Information</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.legal-documents.update', $document->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="act_name" class="form-label">Act Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('act_name') is-invalid @enderror" id="act_name" name="act_name" value="{{ old('act_name', $document->act_name) }}" required>
                                @error('act_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="language" class="form-label">Language <span class="text-danger">*</span></label>
                                <select class="form-select @error('language') is-invalid @enderror" id="language" name="language" required>
                                    <option value="">Select Language</option>
                                    <option value="en" {{ old('language', $document->language) == 'en' ? 'selected' : '' }}>English</option>
                                    <option value="fr" {{ old('language', $document->language) == 'fr' ? 'selected' : '' }}>French</option>
                                    <option value="Both" {{ old('language', $document->language) == 'Both' ? 'selected' : '' }}>Both (English & French)</option>
                                </select>
                                @error('language')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="law_id" class="form-label">Law ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('law_id') is-invalid @enderror" id="law_id" name="law_id" value="{{ old('law_id', $document->law_id) }}" required>
                                @error('law_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="act_id" class="form-label">Act ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('act_id') is-invalid @enderror" id="act_id" name="act_id" value="{{ old('act_id', $document->act_id) }}" required>
                                @error('act_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="jurisdiction_id" class="form-label">Jurisdiction ID <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('jurisdiction_id') is-invalid @enderror" id="jurisdiction_id" name="jurisdiction_id" value="{{ old('jurisdiction_id', $document->jurisdiction_id) }}" required>
                                @error('jurisdiction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Document Properties (Read-only) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Table Name</label>
                                <div class="form-control-plaintext bg-light p-2 rounded">{{ $document->table_name }}</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Original Filename</label>
                                <div class="form-control-plaintext bg-light p-2 rounded">{{ $document->original_filename }}</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-control-plaintext">
                                    <span class="badge {{ $document->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($document->status ?? 'active') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Upload Date</label>
                                <div class="form-control-plaintext bg-light p-2 rounded">{{ \Carbon\Carbon::parse($document->created_at)->format('F d, Y H:i:s') }}</div>
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
        @if($documentContent && count($documentContent) > 0)
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-file-text me-2"></i>Legal Document Content
                        <small class="ms-2 opacity-75">(Click the <i class="fas fa-edit"></i> icon next to any content to edit it)</small>
                    </h6>
                </div>
                <div class="card-body" id="legal-content-area">
                    @php
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
                    @endphp

                    {{-- Render Standalone Structure --}}
                    @foreach($standaloneData as $title => $titleGroup)
                        <div class="legal-document-section mb-4">
                            <h2 class="section-title mb-3">{{ $title }}</h2>
                            <div class="section-content">
                                @foreach($titleGroup['sections'] as $sectionNumber => $section)
                                    <div class="legal-section" id="section-{{ $sectionNumber }}">
                                        <div class="d-flex align-items-start mb-2">
                                            @if(!empty($section['title']) && trim($section['title']) !== '')
                                                <h4 class="clickable-heading mb-0">{{ $section['title'] }}</h4>
                                            @endif
                                            <a href="#" class="edit-content-btn text-primary ms-2" 
                                               data-bs-toggle="modal" 
                                               data-bs-target="#editContentModal" 
                                               data-id="{{ $section['id'] }}" 
                                               data-title="{{ $section['title'] }}" 
                                               data-content="{{ htmlspecialchars($section['text_content']) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                        <div class="section-body">
                                            @if(!empty($section['text_content']))
                                                <div class="legal-text">
                                                    <span class="section-number">{{ $sectionNumber }}</span> 
                                                    <div class="html-rendered-content">{!! $section['text_content'] !!}</div>
                                                </div>
                                            @endif
                                            
                                            @foreach($section['subsections'] as $subsectionNumber => $subsection)
                                                <div class="subsection-item ms-4 mt-3">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div class="legal-text flex-grow-1">
                                                            <span class="subsection-number">({{ $subsectionNumber }})</span> 
                                                            <div class="html-rendered-content">{!! $subsection['text_content'] !!}</div>
                                                        </div>
                                                        <a href="#" class="edit-content-btn text-primary ms-2" 
                                                           data-bs-toggle="modal" 
                                                           data-bs-target="#editContentModal" 
                                                           data-id="{{ $subsection['id'] }}" 
                                                           data-title="" 
                                                           data-content="{{ htmlspecialchars($subsection['text_content']) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    
                                                    @foreach($subsection['paragraphs'] as $paragraphNumber => $paragraph)
                                                        <div class="paragraph-item ms-4 mt-2">
                                                            <div class="d-flex justify-content-between align-items-start">
                                                                <div class="legal-text flex-grow-1">
                                                                    <span class="paragraph-letter">({{ $paragraphNumber }})</span> 
                                                                    <div class="html-rendered-content">{!! $paragraph['text_content'] !!}</div>
                                                                </div>
                                                                <a href="#" class="edit-content-btn text-primary ms-2" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#editContentModal" 
                                                                   data-id="{{ $paragraph['id'] }}" 
                                                                   data-title="" 
                                                                   data-content="{{ htmlspecialchars($paragraph['text_content']) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                            
                                                            @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                                <div class="sub-paragraph-item ms-4 mt-2">
                                                                    <div class="d-flex justify-content-between align-items-start">
                                                                        <div class="legal-text flex-grow-1">
                                                                            <span class="sub-paragraph-numeral">({{ $subParagraph['sub_paragraph'] }})</span> 
                                                                            <div class="html-rendered-content">{!! $subParagraph['text_content'] !!}</div>
                                                                        </div>
                                                                        <a href="#" class="edit-content-btn text-primary ms-2" 
                                                                           data-bs-toggle="modal" 
                                                                           data-bs-target="#editContentModal" 
                                                                           data-id="{{ $subParagraph['id'] }}" 
                                                                           data-title="" 
                                                                           data-content="{{ htmlspecialchars($subParagraph['text_content']) }}">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            
                                            @foreach($section['paragraphs'] as $paragraphNumber => $paragraph)
                                                <div class="paragraph-section mt-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="legal-text">
                                                            <strong>({{ $paragraphNumber }})</strong> {!! nl2br(e($paragraph['text_content'])) !!}
                                                        </div>
                                                        <a href="#" class="edit-content-btn text-primary" 
                                                           data-bs-toggle="modal" 
                                                           data-bs-target="#editContentModal" 
                                                           data-id="{{ $paragraph['id'] }}" 
                                                           data-title="" 
                                                           data-content="{{ htmlspecialchars($paragraph['text_content']) }}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    
                                                    @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                        <div class="sub-paragraph-section mt-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="legal-text">
                                                                    <strong>({{ $subParagraph['sub_paragraph'] }})</strong> {!! nl2br(e($subParagraph['text_content'])) !!}
                                                                </div>
                                                                <a href="#" class="edit-content-btn text-primary" 
                                                                   data-bs-toggle="modal" 
                                                                   data-bs-target="#editContentModal" 
                                                                   data-id="{{ $subParagraph['id'] }}" 
                                                                   data-title="" 
                                                                   data-content="{{ htmlspecialchars($subParagraph['text_content']) }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            
                                            @if(!empty($section['footnote']))
                                                <div class="footnote mt-2">
                                                    <div class="html-rendered-content footnote-content">{!! $section['footnote'] !!}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    {{-- Render Parts Structure --}}
                    @foreach($data as $partNumber => $part)
                        <div class="legal-document-section mb-4">
                            <h2 class="section-title mb-3">Part {{ $partNumber }}: {{ $part['title'] }}</h2>
                            <div class="section-content">
                                @if(!empty($part['sections']))
                                    @foreach($part['sections'] as $sectionNumber => $section)
                                        <div class="legal-section" id="section-{{ $sectionNumber }}">
                                            <div class="d-flex align-items-start mb-2">
                                                @if(!empty($section['title']) && trim($section['title']) !== '' && $section['title'] !== $part['title'])
                                                    <h4 class="clickable-heading mb-0">{{ $section['title'] }}</h4>
                                                @else
                                                    <h4 class="clickable-heading mb-0">Section {{ $sectionNumber }}</h4>
                                                @endif
                                                <a href="#" class="edit-content-btn text-primary ms-2" 
                                                   data-bs-toggle="modal" 
                                                   data-bs-target="#editContentModal" 
                                                   data-id="{{ $section['id'] }}" 
                                                   data-title="{{ $section['title'] }}" 
                                                   data-content="{{ htmlspecialchars($section['text_content']) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="section-body">
                                                @if(!empty($section['text_content']))
                                                    <div class="legal-text">
                                                        <span class="section-number">{{ $sectionNumber }}</span> {!! nl2br(e($section['text_content'])) !!}
                                                    </div>
                                                @endif
                                                
                                                @if(!empty($section['footnote']))
                                                    <div class="footnote mt-2">{!! nl2br(e($section['footnote'])) !!}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-exclamation-triangle text-warning fs-1 mb-3"></i>
                    <h5 class="text-muted">No Content Available</h5>
                    <p class="text-muted mb-0">No content found for this document. The document may be empty or the table may no longer exist.</p>
                </div>
            </div>
        @endif
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
                <form id="editContentForm" action="{{ route('admin.legal-documents.update', $document->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <input type="hidden" id="content_id" name="content_id">
                    
                    <div class="mb-3">
                        <label for="content_text" class="form-label">Edit Selected Content</label>
                        <textarea class="form-control" id="content_text" name="content[text_content]" rows="15" placeholder="Content will be loaded here when TinyMCE initializes..."></textarea>
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

@push('styles')
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
@endpush

@push('scripts')
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
    function initTinyMCEForModal(contentToSet) {
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
                    console.log('Setting initial content...');
                    editor.setContent(contentToSet);
                    updateStatus('success', 'Rich text editor loaded with content.');
                } else {
                    updateStatus('success', 'Rich text editor loaded.');
                }
            },
            
            setup: function (editor) {
                editor.on('init', function () {
                    console.log('TinyMCE editor initialized');
                    
                    // Double-check content setting
                    if (contentToSet && contentToSet.trim()) {
                        setTimeout(() => {
                            const currentContent = editor.getContent();
                            if (!currentContent || currentContent.trim() === '' || currentContent === '<p><br data-mce-bogus="1"></p>') {
                                console.log('Content not set, trying again...');
                                editor.setContent(contentToSet);
                                updateStatus('success', 'Content loaded successfully.');
                            } else {
                                console.log('Content already set correctly');
                                updateStatus('success', 'Content loaded successfully.');
                            }
                        }, 100);
                    }
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
            console.log('Raw content:', content);
            
            // Decode content
            const decodedContent = decodeHtmlEntities(content);
            console.log('Decoded content:', decodedContent);
            
            // Store globally
            currentContentToEdit = decodedContent || '';
            currentEditId = id;
            
            // Set form values immediately (fallback for plain textarea)
            document.getElementById('content_id').value = id;
            document.getElementById('content_text').value = currentContentToEdit;
            
            // Update modal title
            const modalTitle = document.getElementById('editContentModalLabel');
            modalTitle.textContent = `Edit Content${title ? ' - ' + title : ''} (ID: ${id})`;
            
            console.log('Content prepared for modal');
        });
    });

    // Handle modal shown event
    const editContentModal = document.getElementById('editContentModal');
    editContentModal.addEventListener('shown.bs.modal', function() {
        console.log('Modal opened - initializing TinyMCE with content');
        
        // Small delay to ensure modal is fully rendered
        setTimeout(() => {
            initTinyMCEForModal(currentContentToEdit);
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
@endpush
@endsection
