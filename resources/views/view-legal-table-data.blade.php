@extends('layouts.with-sidebar-layout')

@section('meta')
    <!-- Current document context meta tags -->
    <meta name="current-document-table" content="{{ $tableName }}">
    <meta name="current-document-category-id" content="{{ $categoryId }}">
    <meta name="current-client-id" content="{{ $client ? $client->id : '' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@push('styles')
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
    
    /* Full-screen client selection modal styles */
    .modal-fullscreen .modal-content {
        height: 100vh;
        border-radius: 0;
    }
    
    .modal-fullscreen .modal-body {
        overflow-y: auto;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .client-selection-card {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .client-selection-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        border-color: #007bff;
        background: #f8f9fa;
    }
    
    .client-selection-card.selected {
        border-color: #007bff;
        background: #e3f2fd;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
    }
    
    .client-avatar-large {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #007bff, #0056b3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    
    .client-info-large {
        flex: 1;
    }
    
    .client-info-large h5 {
        margin: 0 0 0.25rem 0;
        color: #2c3e50;
        font-size: 1.2rem;
        font-weight: 600;
    }
    
    .client-email-large {
        color: #7f8c8d;
        margin: 0 0 0.25rem 0;
        font-size: 0.95rem;
    }
    
    .client-status-large {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        margin: 0.25rem 0;
    }
    
    .status-active {
        background: #d4edda;
        color: #155724;
    }
    
    .status-inactive {
        background: #f8d7da;
        color: #721c24;
    }
    
    .client-actions-large {
        flex-shrink: 0;
    }
    
    .btn-select-client {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-select-client:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        color: white;
    }
    
    .no-clients-found {
        text-align: center;
        padding: 3rem;
        color: #7f8c8d;
    }
    
    .no-clients-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        color: #dee2e6;
    }
    
    /* Hide modal backdrop completely - we don't need it for centered modals */
    .modal-backdrop {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }
    
    .modal-backdrop.show {
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }
    
    /* Custom centered modal styles like iCloud - Bootstrap compatible */
    .modal.modal-centered {
        align-items: center !important;
        justify-content: center !important;
        min-height: 100vh !important;
        padding: 15px !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important; /* Override any conflicting width */
        height: 100% !important;
        margin: 0 !important;
        /* Add backdrop effect directly to modal */
        background-color: rgba(0, 0, 0, 0.6) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        /* Let Bootstrap handle display property for show/hide */
    }
    
    .modal.modal-centered.show {
        display: flex !important; /* Show when active */
        z-index: 1055 !important; /* Bootstrap modal z-index */
        pointer-events: auto !important; /* Allow interactions when shown */
        width: 100% !important; /* Ensure full width even with conflicting CSS */
    }
    
    /* Force hide when not in use - but don't override Bootstrap's display handling */
    .modal.modal-centered:not(.show) {
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
        width: 100% !important;
        z-index: -1 !important; /* Behind everything when not shown */
    }
    
    .modal.modal-centered .modal-dialog {
        margin: 0 !important;
        max-width: 90vw !important;
        width: auto !important;
        position: relative !important;
        pointer-events: auto !important;
    }
    
    .modal-centered .modal-content {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        min-width: 400px;
    }
    
    /* Popup save modal specific styles */
    #popupSaveModal.modal-centered .modal-dialog {
        max-width: 500px;
        width: 100%;
        transition: max-width 0.3s ease, width 0.3s ease;
    }

    #popupSaveModal.modal-centered.expanded .modal-dialog {
        max-width: 1000px;
        width: 95vw;
    }

    #popupSaveModal .modal-content {
        transition: all 0.3s ease;
    }

    #popupSaveModal.expanded .modal-content {
        max-height: 90vh;
        overflow-y: auto;
    }

    /* Smaller client cards for modal */
    #popupSaveModal .client-selection-card {
        background: white;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 0.75rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    #popupSaveModal .client-selection-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-color: #007bff;
        background: #f8f9fa;
    }
    
    #popupSaveModal .client-avatar-large {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #007bff, #0056b3);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    #popupSaveModal .client-info-large h6 {
        margin: 0 0 0.25rem 0;
        color: #2c3e50;
        font-size: 1rem;
        font-weight: 600;
    }
    
    #popupSaveModal .client-email-large {
        color: #7f8c8d;
        margin: 0 0 0.25rem 0;
        font-size: 0.85rem;
    }
    
    #popupSaveModal .btn-select-client {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        color: white;
        padding: 0.375rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }
    
    #popupSaveModal .modal-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        border-bottom: none;
        padding: 1.5rem 2rem 1rem 2rem;
        border-radius: 20px 20px 0 0;
    }
    
    #popupSaveModal .modal-body {
        padding: 2rem;
        background: rgba(255, 255, 255, 0.9);
    }
    
    #popupSaveModal .modal-footer {
        background: rgba(248, 249, 250, 0.9);
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        padding: 1rem 2rem 1.5rem 2rem;
        border-radius: 0 0 20px 20px;
    }
    
    /* Client selection modal specific styles */
    #clientSelectionModal.modal-centered .modal-dialog {
        max-width: 1200px;
        width: 95vw;
        max-height: 90vh;
    }
    
    #clientSelectionModal .modal-content {
        height: 85vh;
        display: flex;
        flex-direction: column;
    }
    
    #clientSelectionModal .modal-header {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border-bottom: none;
        padding: 1.5rem 2rem 1rem 2rem;
        border-radius: 20px 20px 0 0;
        flex-shrink: 0;
    }
    
    #clientSelectionModal .modal-body {
        flex: 1;
        overflow-y: auto;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 2rem;
    }
    
    #clientSelectionModal .modal-footer {
        background: rgba(248, 249, 250, 0.9);
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        padding: 1rem 2rem 1.5rem 2rem;
        border-radius: 0 0 20px 20px;
        flex-shrink: 0;
    }
    
    /* Enhanced button styles for the modals */
    .modal-centered .btn {
        border-radius: 25px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .modal-centered .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .modal-centered .btn-outline-primary {
        border: 2px solid #007bff;
        background: rgba(255, 255, 255, 0.9);
    }
    
    .modal-centered .btn-outline-success {
        border: 2px solid #28a745;
        background: rgba(255, 255, 255, 0.9);
    }
    
    /* Close button styling */
    .modal-centered .btn-close {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        width: 35px;
        height: 35px;
        opacity: 0.8;
        transition: all 0.3s ease;
    }
    
    .modal-centered .btn-close:hover {
        background: rgba(255, 255, 255, 0.3);
        opacity: 1;
        transform: scale(1.1);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modal-centered .modal-dialog {
            max-width: 95vw;
            margin: 10px;
        }
        
        #clientSelectionModal .modal-content {
            height: 95vh;
        }
        
        .modal-centered .modal-content {
            border-radius: 15px;
        }
        
        #popupSaveModal .modal-header,
        #clientSelectionModal .modal-header {
            padding: 1rem 1.5rem 0.5rem 1.5rem;
            border-radius: 15px 15px 0 0;
        }
        
        #popupSaveModal .modal-body,
        #clientSelectionModal .modal-body {
            padding: 1.5rem;
        }
        
        #popupSaveModal .modal-footer,
        #clientSelectionModal .modal-footer {
            padding: 0.75rem 1.5rem 1rem 1.5rem;
            border-radius: 0 0 15px 15px;
        }
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
    
    .pagination-btn {
        color: var(--color-theme-3) !important;
        border-color: var(--color-theme-3) !important;
        background-color: transparent !important;
        padding: 8px 15px;
        border: 2px solid var(--color-theme-3);
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .pagination-btn:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        background-color: var(--color-theme-3) !important;
        color: white !important;
    }
    
    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
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
@endpush

@section('main-content')
            @if(isset($client) && $client)
                <div class="gap_top col-12 mb-4 p-0">
                    <div class="bg_custom p-4 rounded shadow-sm">
                        <div class="d-flex align-items-center">
                            <div class="client-avatar me-4 d-flex justify-content-center align-items-center rounded-circle text-white" style="width: 60px; height: 60px; font-size: 24px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); background-color: var(--color-theme-3);">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="client-info flex-grow-1">
                                <h4 class="mb-2" data-en="Client Details" data-fr="Détails du client">Client Details</h4>
                                <div class="d-flex flex-wrap">
                                    <div class="me-4 mb-2">
                                        <span class="d-flex align-items-center">
                                            <strong data-en="Name:" data-fr="Nom :">Name:</strong>&nbsp;{{ $client->client_name ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="d-flex align-items-center">
                                            <i class="fas fa-envelope me-2" style="color: var(--color-theme-3);"></i>
                                            <strong data-en="Email:" data-fr="Courriel :">Email:</strong>&nbsp;{{ $client->client_email ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(empty($columns))
                <div class="alert alert-warning mt-4" data-en="No data found in this table." data-fr="Aucune donnée trouvée dans cette table.">No data found in this table.</div>
            @else
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-light">
                    <h5 class="mb-0" data-en="Keyword Search" data-fr="Recherche par mots-clés">Keyword Search</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('client.legalTables.view', $legalTable->id) }}" method="GET" class="mb-3">
                        @if(isset($client) && $client)
                            <input type="hidden" name="client_id" value="{{ $client->id }}">
                        @endif
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search..." 
                                   data-placeholder-en="Search..." 
                                   data-placeholder-fr="Rechercher..." 
                                   value="{{ request('search') }}">
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

                    @php
                        $data = [];
                        $standaloneData = [];
                        
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
                    @endphp

                    <div class="legal-document-content">
                        {{-- Render Standalone Sections First --}}
                        @foreach($standaloneData as $titleGroup => $group)
                            <div style="margin-bottom: 1.5em;">
                                <div style="font-size:1.15em; font-weight:bold; margin-bottom:0.5em;">{{ $titleGroup }}</div>
                                @foreach($group['sections'] as $sectionNumber => $section)                                        @if(!empty($section['title']) && trim($section['title']) !== '' && !isset($section['is_intro']) && $section['title'] !== $titleGroup)
                                        <div style="margin-top: 1em; color: #333; font-weight: bold;">{{ $section['title'] }}</div>
                                    @endif
                                    @if(!empty($section['text_content']))
                                        <div style="margin-left: 0.5em; margin-bottom: 1em;">
                                            @if(!isset($section['is_intro']))
                                                <strong>{{ $sectionNumber }}</strong>
                                            @endif
                                            {!! makeLinksClickableSimple($section['text_content'], $legalTable->id, isset($section['is_intro']) ? null : $sectionNumber) !!}
                                        </div>
                                    @endif
                                    @foreach($section['subsections'] as $subsectionNumber => $subsection)
                                        <div style="margin-left: 2em;">
                                            @if(!empty($subsection['text_content']))
                                                <div style="margin-bottom: 0.5em;">
                                                    <strong>{{ $subsectionNumber }}</strong> {!! makeLinksClickableSimple($subsection['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')') !!}
                                                </div>
                                            @endif
                                            @foreach($subsection['paragraphs'] as $paragraphNumber => $paragraph)
                                                <div style="margin-left: 2em;">
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong>{{ $paragraphNumber }}</strong> {!! makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')') !!}
                                                    </div>
                                                    @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                        <div style="margin-left: 2em;">
                                                            <div style="margin-bottom: 0.5em;">
                                                                <strong>{{ $subParagraph['sub_paragraph'] }}</strong> {!! makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')') !!}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    @foreach($section['paragraphs'] as $paragraphNumber => $paragraph)
                                        <div style="margin-left: 2em;">
                                            <div style="margin-bottom: 0.5em;">
                                                <strong>{{ $paragraphNumber }}</strong> {!! makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraphNumber . ')') !!}
                                            </div>
                                            @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                <div style="margin-left: 2em;">
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong>{{ $subParagraph['sub_paragraph'] }}</strong> {!! makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')') !!}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    @if(!empty($section['footnote']))
                                        <div class="footnote">{{ $section['footnote'] }}</div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach

                        {{-- Render Parts Structure --}}
                        @foreach($data as $partNumber => $part)
                            <div style="margin-bottom: 2em;">
                                <div style="font-size:1.15em; font-weight:bold; margin-bottom:0.5em;">Part {{ $partNumber }}: {{ $part['title'] }}</div>
                                @if(!empty($part['sections']))
                                    @foreach($part['sections'] as $sectionNumber => $section)
                                        @if(!empty($section['title']) && trim($section['title']) !== '' && $section['title'] !== $part['title'])
                                            <div style="margin-top: 1em; color: #333; font-weight: bold;">{{ $section['title'] }}</div>
                                        @endif
                                        @if(!empty($section['text_content']))
                                            <div style="margin-left: 0.5em; margin-bottom: 1em;">
                                                <strong>{{ $sectionNumber }}</strong> {!! makeLinksClickableSimple($section['text_content'], $legalTable->id, $sectionNumber) !!}
                                            </div>
                                        @endif
                                        @foreach($section['subsections'] as $subsectionNumber => $subsection)
                                            <div style="margin-left: 2em;">
                                                @if(!empty($subsection['title']))
                                                    <div style="font-style: italic;">{{ $subsection['title'] }}</div>
                                                @endif
                                                @if(!empty($subsection['text_content']))
                                                    <div style="margin-bottom: 0.5em;">
                                                        <strong>{{ $subsectionNumber }}</strong> {!! makeLinksClickableSimple($subsection['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')') !!}
                                                    </div>
                                                @endif
                                                @foreach($subsection['paragraphs'] as $paragraphNumber => $paragraph)
                                                    <div style="margin-left: 2em;">
                                                        <div style="margin-bottom: 0.5em;">
                                                            <strong>{{ $paragraphNumber }}</strong> {!! makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')') !!}
                                                        </div>
                                                        @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                            <div style="margin-left: 2em;">
                                                                <div style="margin-bottom: 0.5em;">
                                                                    <strong>{{ $subParagraph['sub_paragraph'] }}</strong> {!! makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraphNumber . ')(' . $subParagraph['sub_paragraph'] . ')') !!}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                                @if(!empty($subsection['footnote']))
                                                    <div class="footnote"><em>{!! $subsection['footnote'] !!}</em></div>
                                                @endif
                                            </div>
                                        @endforeach
                                        @foreach($section['paragraphs'] as $paragraph)
                                            <div style="margin-left: 2em;">
                                                <div style="margin-bottom: 0.5em;">
                                                    <strong>{{ $paragraph['paragraph'] }}</strong> {!! makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')') !!}
                                                </div>
                                                @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                    <div style="margin-left: 2em;">
                                                        <div style="margin-bottom: 0.5em;">
                                                            <strong>{{ $subParagraph['sub_paragraph'] }}</strong> {!! makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')') !!}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                        @if(!empty($section['footnote']))
                                            <div class="footnote">{{ $section['footnote'] }}</div>
                                        @endif
                                    @endforeach
                                @endif
                                @if(!empty($part['divisions']))
                                    @foreach($part['divisions'] as $divisionNumber => $division)
                                        <div style="margin-left: 1.5em; margin-top: 1em;">
                                            <div style="font-weight:bold; margin-bottom:0.5em;">Division {{ $divisionNumber }}: {{ $division['title'] }}</div>
                                            @if(!empty($division['sub_divisions']))
                                                @foreach($division['sub_divisions'] as $subDivisionNumber => $subDivision)
                                                    @if($subDivision['title'] !== $division['title'])
                                                        <div style="font-weight:bold; margin-bottom:0.5em; margin-left:1em;">Subdivision {{ $subDivisionNumber }}: {{ $subDivision['title'] }}</div>
                                                    @endif
                                                    @if(!empty($subDivision['sections']))
                                                        @foreach($subDivision['sections'] as $sectionNumber => $section)
                                                            @if(!empty($section['title']))
                                                                <div style="margin-top: 1em; font-weight: bold;">{{ $section['title'] }}</div>
                                                            @endif
                                                            @if(!empty($section['text_content']))
                                                                <div style="margin-left: 1em; margin-bottom: 0.5em;">
                                                                    <strong>{{ $sectionNumber }}</strong> {!! makeLinksClickableSimple($section['text_content'], $legalTable->id, $sectionNumber) !!}
                                                                </div>
                                                            @endif
                                                            @foreach($section['subsections'] as $subsectionNumber => $subsection)
                                                                <div style="margin-left: 2em;">
                                                                    @if(!empty($subsection['title']))
                                                                        <div style="font-style: italic;">{{ $subsection['title'] }}</div>
                                                                    @endif
                                                                    @if(!empty($subsection['text_content']))
                                                                        <div style="margin-bottom: 0.5em;">
                                                                            <strong>{{ $subsectionNumber }}</strong> {!! makeLinksClickableSimple($subsection['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')') !!}
                                                                        </div>
                                                                    @endif
                                                                    @foreach($subsection['paragraphs'] as $paragraph)
                                                                        <div style="margin-left: 2em;">
                                                                            <div style="margin-bottom: 0.5em;">
                                                                                <strong>{{ $paragraph['paragraph'] }}</strong> {!! makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraph['paragraph'] . ')') !!}
                                                                            </div>
                                                                            @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                                                <div style="margin-left: 2em;">
                                                                                    <div style="margin-bottom: 0.5em;">
                                                                                        <strong>{{ $subParagraph['sub_paragraph'] }}</strong> {!! makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $subsectionNumber . ')(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')') !!}
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endforeach
                                                                    @if(!empty($subsection['footnote']))
                                                                        <div class="footnote"><em>{!! $subsection['footnote'] !!}</em></div>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                            @foreach($section['paragraphs'] as $paragraph)
                                                                <div style="margin-left: 2em;">
                                                                    <div style="margin-bottom: 0.5em;">
                                                                        <strong>{{ $paragraph['paragraph'] }}</strong> {!! makeLinksClickableSimple($paragraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')') !!}
                                                                    </div>
                                                                    @foreach($paragraph['sub_paragraphs'] as $subParagraph)
                                                                        <div style="margin-left: 2em;">
                                                                            <div style="margin-bottom: 0.5em;">
                                                                                <strong>{{ $subParagraph['sub_paragraph'] }}</strong> {!! makeLinksClickableSimple($subParagraph['text_content'], $legalTable->id, $sectionNumber . '(' . $paragraph['paragraph'] . ')(' . $subParagraph['sub_paragraph'] . ')') !!}
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            @endforeach
                                                            @if(!empty($section['footnote']))
                                                                <div class="footnote"><em>{!! $section['footnote'] !!}</em></div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="pagination-controls d-flex justify-content-center align-items-center mt-3 gap-3">
                <button id="prev-page-btn" class="btn pagination-btn" style="color: var(--color-theme-3); border-color: var(--color-theme-3); background-color: transparent; padding: 8px 15px; border: 2px solid var(--color-theme-3); border-radius: 4px; cursor: pointer; transition: all 0.3s ease;" onclick="changePage(currentPage - 1, currentCategoryId)" {{ request('page', 1) <= 1 ? 'disabled' : '' }}>
                    Previous
                </button>
                
                <select id="page-select" class="form-select" style="width: auto; border-color: var(--color-theme-3);" onchange="changePage(this.value, currentCategoryId)">
                    @for($i = 1; $i <= $tableData->lastPage(); $i++)
                        <option value="{{ $i }}" {{ request('page', 1) == $i ? 'selected' : '' }}>
                            Page {{ $i }} of {{ $tableData->lastPage() }}
                        </option>
                    @endfor
                </select>
                
                <button id="next-page-btn" class="btn pagination-btn" style="color: var(--color-theme-3); border-color: var(--color-theme-3); background-color: transparent; padding: 8px 15px; border: 2px solid var(--color-theme-3); border-radius: 4px; cursor: pointer; transition: all 0.3s ease;" onclick="changePage(currentPage + 1, currentCategoryId)" {{ request('page', 1) >= $tableData->lastPage() ? 'disabled' : '' }}>
                    Next
                </button>
            </div>
            @endif
                
@section('page-scripts')
<script>
    var fullHierarchicalData = @json($tableData->items());
    var currentPage = {{ request('page', 1) }};
    var totalPages = {{ $tableData->lastPage() }};
    var currentCategoryId = {{ $legalTable->id }};
    
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
@endsection
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

<!-- Popup Save Choice Modal -->
<div class="modal fade modal-centered" id="popupSaveModal" tabindex="-1" aria-labelledby="popupSaveModalLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="popupSaveModalLabel">
                    <i class="fas fa-save me-2"></i>
                    <span data-en="Choose Save Context" data-fr="Choisir le contexte de sauvegarde">Choose Save Context</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center mb-4" data-en="How would you like to save these popups?" data-fr="Comment souhaitez-vous sauvegarder ces popups ?">
                    <strong>How would you like to save these popups?</strong>
                </p>
                <div class="d-grid gap-3" id="saveOptionsSection">
                    <button type="button" class="btn btn-outline-primary btn-lg" id="saveToUserRecords">
                        <i class="fas fa-user me-2"></i>
                        <span data-en="Save to Personal Records" data-fr="Sauvegarder dans les dossiers personnels">Save to Personal Records</span>
                        <br><small class="text-muted" data-en="(Available in all contexts)" data-fr="(Disponible dans tous les contextes)">(Available in all contexts)</small>
                    </button>
                    <button type="button" class="btn btn-outline-success btn-lg" id="saveToClientRecordsExpand">
                        <i class="fas fa-briefcase me-2"></i>
                        <span data-en="Save to Client Records" data-fr="Sauvegarder dans les dossiers clients">Save to Client Records</span>
                        @if(isset($client) && $client)
                        <br><small class="text-muted" data-en="(For client: {{ $client->client_name }})" data-fr="(Pour le client : {{ $client->client_name }})">(For client: {{ $client->client_name }})</small>
                        @else
                        <br><small class="text-muted" data-en="(Select or create a client)" data-fr="(Sélectionner ou créer un client)">(Select or create a client)</small>
                        @endif
                    </button>
                </div>

                <!-- Client Selection Section (Initially Hidden) -->
                <div id="clientSelectionSection" style="display: none;">
                    <hr class="my-4">
                    <h6 class="text-center mb-4" data-en="Client Management" data-fr="Gestion des clients">
                        <i class="fas fa-briefcase me-2"></i>Client Management
                    </h6>
                    
                    <!-- Add New Client Section -->
                    <div class="card border-primary shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0" data-en="Create New Client" data-fr="Créer un nouveau client">
                                <i class="fas fa-plus me-2"></i>Create New Client
                            </h6>
                        </div>
                        <div class="card-body bg-white bg-opacity-90">
                            <form id="newClientFormInModal">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="modal_client_name" class="form-label fw-bold" data-en="Client Name" data-fr="Nom du client">Client Name</label>
                                            <input type="text" class="form-control" id="modal_client_name" name="client_name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="modal_client_email" class="form-label fw-bold" data-en="Email" data-fr="Courriel">Email</label>
                                            <input type="email" class="form-control" id="modal_client_email" name="client_email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="modal_client_status" class="form-label fw-bold" data-en="Status" data-fr="Statut">Status</label>
                                            <select class="form-control" id="modal_client_status" name="client_status" required>
                                                <option value="Active" data-en="Active" data-fr="Actif">Active</option>
                                                <option value="Inactive" data-en="Inactive" data-fr="Inactif">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus me-2"></i>
                                        <span data-en="Create and Select Client" data-fr="Créer et sélectionner le client">Create and Select Client</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Existing Clients Section -->
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-1" data-en="Select Existing Client" data-fr="Sélectionner un client existant">
                                <i class="fas fa-users me-2"></i>Select Existing Client
                            </h6>
                            <p class="mb-0 text-muted small" data-en="Choose a client to save popups to their records" data-fr="Choisissez un client pour enregistrer les popups dans ses dossiers">Choose a client to save popups to their records</p>
                        </div>
                        <div class="card-body bg-white bg-opacity-90" style="max-height: 300px; overflow-y: auto;">
                            <div id="modalClientsList" class="row">
                                <!-- Clients will be loaded here dynamically -->
                                <div class="col-12 text-center py-3">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2 text-muted" data-en="Loading clients..." data-fr="Chargement des clients...">Loading clients...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-outline-secondary" id="backToSaveOptions">
                            <i class="fas fa-arrow-left me-2"></i>
                            <span data-en="Back to Save Options" data-fr="Retour aux options de sauvegarde">Back to Save Options</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Cancel" data-fr="Annuler">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Full-page Client Selection Modal -->
<div class="modal fade modal-centered" id="clientSelectionModal" tabindex="-1" aria-labelledby="clientSelectionModalLabel" aria-hidden="true" data-bs-backdrop="false" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="clientSelectionModalLabel">
                    <i class="fas fa-briefcase me-2"></i>
                    <span data-en="Select or Create Client" data-fr="Sélectionner ou créer un client">Select or Create Client</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Add New Client Section -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card border-primary shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0" data-en="Create New Client" data-fr="Créer un nouveau client">
                                        <i class="fas fa-plus me-2"></i>Create New Client
                                    </h5>
                                </div>
                                <div class="card-body bg-white bg-opacity-90">
                                    <form id="newClientForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="new_client_name" class="form-label fw-bold" data-en="Client Name" data-fr="Nom du client">Client Name</label>
                                                    <input type="text" class="form-control" id="new_client_name" name="client_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="new_client_email" class="form-label fw-bold" data-en="Email" data-fr="Courriel">Email</label>
                                                    <input type="email" class="form-control" id="new_client_email" name="client_email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="new_client_status" class="form-label fw-bold" data-en="Status" data-fr="Statut">Status</label>
                                                    <select class="form-control" id="new_client_status" name="client_status" required>
                                                        <option value="Active" data-en="Active" data-fr="Actif">Active</option>
                                                        <option value="Inactive" data-en="Inactive" data-fr="Inactif">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-lg">
                                                <i class="fas fa-plus me-2"></i>
                                                <span data-en="Create and Select Client" data-fr="Créer et sélectionner le client">Create and Select Client</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Clients Section -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-1" data-en="Select Existing Client" data-fr="Sélectionner un client existant">
                                        <i class="fas fa-users me-2"></i>Select Existing Client
                                    </h5>
                                    <p class="mb-0 text-muted small" data-en="Choose a client to save popups to their records" data-fr="Choisissez un client pour enregistrer les popups dans ses dossiers">Choose a client to save popups to their records</p>
                                </div>
                                <div class="card-body bg-white bg-opacity-90" style="max-height: 400px; overflow-y: auto;">
                                    <div id="clientsList" class="row">
                                        <!-- Clients will be loaded here dynamically -->
                                        <div class="col-12 text-center py-5">
                                            <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-3 text-muted" data-en="Loading clients..." data-fr="Chargement des clients...">Loading clients...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-en="Cancel" data-fr="Annuler">Cancel</button>
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
@endsection

@push('page-scripts')
<!-- Custom scripts specific to this page -->
<script src="{{ asset('user_assets/js/api-endpoint-tests.js') }}"></script>
<script src="{{ asset('user_assets/js/reference-by-id.js') }}"></script>

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
                    fetch('{{ route('editor.save') }}', {
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
            '<span class="ref" data-section-id="$2" data-table-id="{{ $legalTable->id }}">$1 $2</span>'
        );
        // Pattern 2: paragraph references
        processedText = processedText.replace(
            /\b(paragraph|paragraphs)\s+\(([a-z\d\.]+)\)(?:\s+or\s+\(([a-z\d\.]+)\))?/gi,
            function(match, type, firstRef, secondRef) {
                // Try to get context from parent .legal-text div
                const section = $(this).closest('.legal-text').data('section-id') || '';
                let sectionId = section ? section + '(' + firstRef + ')' : '(' + firstRef + ')';
                let result = '<span class="ref" data-section-id="' + sectionId + '" data-table-id="{{ $legalTable->id }}">' + type + ' (' + firstRef + ')</span>';
                if (secondRef) {
                    let secondSectionId = section ? section + '(' + secondRef + ')' : '(' + secondRef + ')';
                    result += ' or <span class="ref" data-section-id="' + secondSectionId + '" data-table-id="{{ $legalTable->id }}">(' + secondRef + ')</span>';
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
                let result = '<span class="ref" data-section-id="' + sectionId + '" data-table-id="{{ $legalTable->id }}">' + type + ' (' + firstRef + ')</span>';
                if (secondRef) {
                    let secondSectionId = section ? section + '(' + secondRef + ')' : '(' + secondRef + ')';
                    result += ' or <span class="ref" data-section-id="' + secondSectionId + '" data-table-id="{{ $legalTable->id }}">(' + secondRef + ')</span>';
                }
                return result;
            }
        );
        // Pattern 4: complex section references like 279.1(2)
        processedText = processedText.replace(
            /\b(\d+(?:\.\d+)?(?:\([^)]+\)){1,4})\b(?!\s*\([a-z](?:\.\d+)?\))(?![^<>]*<\/span>)/g,
            '<span class="ref" data-section-id="$1" data-table-id="{{ $legalTable->id }}">$1</span>'
        );
        // Pattern 5: explicit section references
        processedText = processedText.replace(
            /\b(section|subsection|paragraph)\s+(\d+(?:\.\d+)?)\((\d+(?:\.\d+)?)\)(?:\(([a-z\d\.]+)\))?/gi,
            function(match, type, section, subsection, paragraph) {
                let sectionId = section + '(' + subsection + ')';
                if (paragraph) sectionId += '(' + paragraph + ')';
                return '<span class="ref" data-section-id="' + sectionId + '" data-table-id="{{ $legalTable->id }}">' + match + '</span>';
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
    var fullHierarchicalData = @json($tableData->items());
    var currentPage = {{ request('page', 1) }};
    var totalPages = {{ $tableData->lastPage() }};
    var currentCategoryId = {{ $legalTable->id }};
    
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
                refButton.setAttribute('data-ref-id', '{{ $legalTable->id }}:' + rowId);
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
        if (left < scrollLeft + 10) {
            left = scrollLeft + 10;
        }
        
        // Ensure popup doesn't go off top edge
        if (top < scrollTop + 10) {
            top = scrollTop + 10;
        }
        
        // Position popup elements as fixed to ensure they appear regardless of scroll position
        popup.style.position = 'fixed';
        popup.style.top = (top - scrollTop) + 'px';
        popup.style.left = (left - scrollLeft) + 'px';
        
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
                    dummyRef.setAttribute('data-table-id', '{{ $legalTable->id }}');
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

<!-- Client Dropdown Styles -->
<style>
.client-dropdown-container {
    position: relative;
}

.client-search-input {
    padding-right: 40px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.client-search-input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.client-search-input.dropdown-active {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    border-bottom-color: transparent;
}

.client-dropdown-list {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 2px solid #0d6efd;
    border-top: none;
    border-radius: 0 0 8px 8px;
    max-height: 300px;
    overflow-y: auto;
    z-index: 1050;
    display: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.client-dropdown-item {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    cursor: pointer;
    border-bottom: 1px solid #f8f9fa;
    transition: all 0.2s ease;
}

.client-dropdown-item:hover,
.client-dropdown-item.keyboard-active {
    background-color: #f8f9fa;
    border-left: 3px solid #0d6efd;
}

.client-dropdown-item:last-child {
    border-bottom: none;
}

.client-dropdown-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    flex-shrink: 0;
}

.client-dropdown-avatar i {
    color: white;
    font-size: 16px;
}

.client-dropdown-info {
    flex: 1;
    min-width: 0;
}

.client-dropdown-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 2px;
    font-size: 14px;
}

.client-dropdown-email {
    color: #6c757d;
    font-size: 12px;
    margin-bottom: 4px;
}

.client-dropdown-status {
    display: flex;
    align-items: center;
    gap: 8px;
}

.client-dropdown-status .badge {
    font-size: 10px;
    padding: 2px 6px;
}

.client-dropdown-status .badge.status-active {
    background-color: #198754;
}

.client-dropdown-status .badge.status-inactive {
    background-color: #6c757d;
}

.client-dropdown-last-accessed {
    color: #adb5bd;
    font-size: 10px;
}

.client-dropdown-action {
    margin-left: 12px;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.client-dropdown-item:hover .client-dropdown-action,
.client-dropdown-item.keyboard-active .client-dropdown-action {
    opacity: 1;
}

.client-dropdown-action i {
    font-size: 18px;
}

.client-dropdown-footer {
    padding: 8px 16px;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

.no-search-results {
    padding: 20px;
    background: #f8f9fa;
}

/* Scrollbar styling for dropdown */
.client-dropdown-list::-webkit-scrollbar {
    width: 6px;
}

.client-dropdown-list::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.client-dropdown-list::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.client-dropdown-list::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Loading animation for search */
.client-search-input.loading {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'%3E%3Cpath fill='%23999' d='M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z' opacity='.25'/%3E%3Cpath fill='%23999' d='M12,4a8,8,0,0,1,7.89,6.7A1.53,1.53,0,0,0,21.38,12h0a1.5,1.5,0,0,0,1.48-1.75,11,11,0,0,0-21.72,0A1.5,1.5,0,0,0,2.62,12h0a1.53,1.53,0,0,0,1.49-1.3A8,8,0,0,1,12,4Z'%3E%3CanimateTransform attributeName='transform' dur='0.75s' repeatCount='indefinite' type='rotate' values='0 12 12;360 12 12'/%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
}
</style>

<!-- Popup Saving Functionality for Document View Page -->
<script>
// Define global functions first (before DOMContentLoaded)
window.selectClientFromModal = function(clientId, clientName) {
    // Show confirmation and save
    if (confirm(`Save popups to ${clientName}'s records?`)) {
        window.savePopupsDataFromSidebar('client', clientId);
    } else {
        // Just collapse back to save options if user cancels
        const modal = document.getElementById('popupSaveModal');
        const saveOptionsSection = document.getElementById('saveOptionsSection');
        const clientSelectionSection = document.getElementById('clientSelectionSection');
        
        // Remove expanded class from modal
        modal.classList.remove('expanded');
        
        // Show save options and hide client selection
        saveOptionsSection.style.display = 'block';
        clientSelectionSection.style.display = 'none';
    }
};

window.selectClientFromDropdown = function(clientId, clientName) {
    // Hide the dropdown
    const dropdownList = document.getElementById('clientDropdownList');
    const searchInput = document.getElementById('clientSearchInput');
    
    if (dropdownList) {
        dropdownList.style.display = 'none';
    }
    if (searchInput) {
        searchInput.classList.remove('dropdown-active');
        searchInput.value = clientName; // Show selected client name in input
    }
    
    // Call the main selection function
    window.selectClientFromModal(clientId, clientName);
};

window.selectClientForSaving = function(clientId, clientName) {
    // Close the client selection modal
    const clientModal = bootstrap.Modal.getInstance(document.getElementById('clientSelectionModal'));
    clientModal.hide();
    
    // Show confirmation and save
    if (confirm(`Save popups to ${clientName}'s records?`)) {
        window.savePopupsDataFromSidebar('client', clientId);
    } else {
        // Re-show the popup save modal if user cancels
        setTimeout(() => {
            const popupSaveModal = new bootstrap.Modal(document.getElementById('popupSaveModal'));
            popupSaveModal.show();
        }, 500);
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Define the savePopupsDataFromSidebar function first
    window.savePopupsDataFromSidebar = function(saveType, clientId = null) {
        const droppableArea = document.querySelector('.nested-droppable');
        const pinnedPopups = droppableArea.querySelectorAll('.pinned-popup');
        
        // Extract popup data from pinned popups
        const popups = [];
        pinnedPopups.forEach(popup => {
            // Extract content and metadata from pinned popup
            const titleElement = popup.querySelector('.popup-header h6, .popup-header .modal-title, h5, h6');
            const contentElement = popup.querySelector('.popup-content, .modal-body');
            
            if (titleElement && contentElement) {
                // Try to extract section ID from content or title
                const sectionMatch = titleElement.textContent.match(/(\d+(?:\([^)]+\))*)/);
                const sectionId = sectionMatch ? sectionMatch[1] : 'unknown';
                
                // Try to get category ID from meta tags or use current document
                const categoryId = document.querySelector('meta[name="current-document-category-id"]')?.content || '1';
                
                const popupData = {
                    section_id: sectionId,
                    category_id: parseInt(categoryId) || 1,
                    part: null,
                    division: null,
                    popup_title: titleElement.textContent.trim(),
                    popup_content: popup.outerHTML,
                    section_title: titleElement.textContent.trim(),
                    table_name: document.querySelector('meta[name="current-document-table"]')?.content || 'unknown'
                };
                popups.push(popupData);
            }
        });
        
        if (popups.length === 0) {
            alert('No valid popup data found.');
            return;
        }
        
        console.log('Collected popup data from sidebar:', popups);
        
        // Show loading state
        const modal = document.getElementById('popupSaveModal');
        const buttons = modal.querySelectorAll('button');
        buttons.forEach(btn => btn.disabled = true);
        
        // Save the popups
        fetch('/save-popups', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                // Close modal if still open
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }
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
    };

    // Test API connection on page load
    console.log('Testing API connection...');
    testAPIConnection();
    
    // Handle the new save popups button in sidebar
    const savePopupsSidebarBtn = document.getElementById('save-popups-sidebar');
    if (savePopupsSidebarBtn) {
        savePopupsSidebarBtn.addEventListener('click', function() {
            // Extract popups from nested-droppable area
            const droppableArea = document.querySelector('.nested-droppable');
            const pinnedPopups = droppableArea.querySelectorAll('.pinned-popup');
            
            if (pinnedPopups.length === 0) {
                alert('No popups to save. Please drag some legal sections to the droppable area first.');
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
            window.savePopupsDataFromSidebar('user');
        });
    }
    
    // Handle save to client records (new expand functionality)
    const saveToClientBtn = document.getElementById('saveToClientRecordsExpand');
    if (saveToClientBtn) {
        saveToClientBtn.addEventListener('click', function() {
            const clientId = {{ isset($client) && $client ? $client->id : 'null' }};
            if (!clientId) {
                // No client selected, expand the modal to show client selection
                expandModalForClientSelection();
                return;
            }
            // Client already selected, save directly
            window.savePopupsDataFromSidebar('client', clientId);
        });
    }

    // Handle back to save options button
    const backToSaveOptionsBtn = document.getElementById('backToSaveOptions');
    if (backToSaveOptionsBtn) {
        backToSaveOptionsBtn.addEventListener('click', function() {
            collapseModalToSaveOptions();
        });
    }

    // Function to expand modal for client selection
    function expandModalForClientSelection() {
        const modal = document.getElementById('popupSaveModal');
        const saveOptionsSection = document.getElementById('saveOptionsSection');
        const clientSelectionSection = document.getElementById('clientSelectionSection');
        
        // Add expanded class to modal
        modal.classList.add('expanded');
        
        // Hide save options and show client selection
        saveOptionsSection.style.display = 'none';
        clientSelectionSection.style.display = 'block';
        
        // Load clients for the modal
        loadClientsForModalSelection();
    }

    // Function to collapse modal back to save options
    function collapseModalToSaveOptions() {
        const modal = document.getElementById('popupSaveModal');
        const saveOptionsSection = document.getElementById('saveOptionsSection');
        const clientSelectionSection = document.getElementById('clientSelectionSection');
        
        // Remove expanded class from modal
        modal.classList.remove('expanded');
        
        // Show save options and hide client selection
        saveOptionsSection.style.display = 'block';
        clientSelectionSection.style.display = 'none';
    }

    // Function to load clients for modal selection
    function loadClientsForModalSelection() {
        const clientsList = document.getElementById('modalClientsList');
        
        console.log('Loading clients for modal selection...');
        console.log('API URL: /api/clients');
        console.log('CSRF Token:', '{{ csrf_token() }}');
        
        // Try API route first
        fetch('/api/clients', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            console.log('API Response status:', response.status);
            console.log('API Response headers:', response.headers);
            console.log('API Response URL:', response.url);
            
            // If API route returns 401, try web route instead
            if (response.status === 401) {
                console.log('API route returned 401, trying web route...');
                return fetch('/web-api/clients', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                });
            }
            return response;
        })
        .then(response => {
            console.log('Final Response status:', response.status);
            console.log('Final Response headers:', response.headers);
            console.log('Final Response URL:', response.url);
            
            // Log response text for debugging
            return response.text().then(text => {
                console.log('Raw response text:', text);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                }
                
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Failed to parse JSON:', e);
                    throw new Error('Invalid JSON response: ' + text);
                }
            });
        })
        .then(data => {
            console.log('Clients data received:', data);
            if (data.success && data.clients) {
                console.log('Number of clients:', data.clients.length);
                renderModalClientsList(data.clients);
            } else {
                console.warn('No clients found or API error:', data);
                renderModalNoClients();
            }
        })
        .catch(error => {
            console.error('Error loading clients:', error);
            renderModalNoClients();
        });
    }

    // Function to render clients list in modal
    function renderModalClientsList(clients) {
        const clientsList = document.getElementById('modalClientsList');
        
        if (clients.length === 0) {
            renderModalNoClients();
            return;
        }
        
        // Create a searchable dropdown for clients
        let html = `
            <div class="col-12">
                <div class="client-dropdown-container">
                    <label for="clientSearchInput" class="form-label">
                        <i class="fas fa-search me-2"></i>Search and Select Client
                    </label>
                    <div class="position-relative">
                        <input type="text" 
                               id="clientSearchInput" 
                               class="form-control client-search-input" 
                               placeholder="Type to search clients by name or email..."
                               autocomplete="off">
                        <div id="clientDropdownList" class="client-dropdown-list">
        `;
        
        // Add each client as a dropdown option
        clients.forEach(client => {
            const lastAccessed = client.last_accessed ? new Date(client.last_accessed).toLocaleDateString() : 'Never';
            const escapedClientName = client.client_name.replace(/'/g, "\\'").replace(/"/g, '\\"');
            
            html += `
                <div class="client-dropdown-item" 
                     data-client-id="${client.id}" 
                     data-client-name="${escapedClientName}"
                     data-client-email="${client.client_email}"
                     onclick="selectClientFromDropdown(${client.id}, '${escapedClientName}')">
                    <div class="client-dropdown-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="client-dropdown-info">
                        <div class="client-dropdown-name">${client.client_name}</div>
                        <div class="client-dropdown-email">${client.client_email}</div>
                        <div class="client-dropdown-status">
                            <span class="badge status-${client.client_status.toLowerCase()}">${client.client_status}</span>
                            <span class="client-dropdown-last-accessed">Last accessed: ${lastAccessed}</span>
                        </div>
                    </div>
                    <div class="client-dropdown-action">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                </div>
            `;
        });
        
        html += `
                        </div>
                    </div>
                    <div class="client-dropdown-footer mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            ${clients.length} client${clients.length !== 1 ? 's' : ''} available. Click on a client to select.
                        </small>
                    </div>
                </div>
            </div>
        `;
        
        clientsList.innerHTML = html;
        
        // Initialize search functionality
        initializeClientSearch(clients);
    }

    // Function to initialize client search functionality
    function initializeClientSearch(clients) {
        const searchInput = document.getElementById('clientSearchInput');
        const dropdownList = document.getElementById('clientDropdownList');
        
        if (!searchInput || !dropdownList) return;
        
        // Show dropdown when input is focused
        searchInput.addEventListener('focus', function() {
            dropdownList.style.display = 'block';
            searchInput.classList.add('dropdown-active');
        });
        
        // Hide dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.client-dropdown-container')) {
                dropdownList.style.display = 'none';
                searchInput.classList.remove('dropdown-active');
            }
        });
        
        // Search functionality
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            const dropdownItems = dropdownList.querySelectorAll('.client-dropdown-item');
            
            let visibleCount = 0;
            dropdownItems.forEach(item => {
                const clientName = item.getAttribute('data-client-name').toLowerCase();
                const clientEmail = item.getAttribute('data-client-email').toLowerCase();
                
                if (clientName.includes(searchTerm) || clientEmail.includes(searchTerm)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show "no results" message if no clients match
            let noResultsDiv = dropdownList.querySelector('.no-search-results');
            if (visibleCount === 0 && searchTerm) {
                if (!noResultsDiv) {
                    noResultsDiv = document.createElement('div');
                    noResultsDiv.className = 'no-search-results text-center py-3 text-muted';
                    noResultsDiv.innerHTML = `
                        <i class="fas fa-search me-2"></i>
                        No clients found matching "${searchTerm}"
                    `;
                    dropdownList.appendChild(noResultsDiv);
                }
                noResultsDiv.style.display = 'block';
            } else if (noResultsDiv) {
                noResultsDiv.style.display = 'none';
            }
            
            // Show dropdown if there's input
            if (searchTerm) {
                dropdownList.style.display = 'block';
                searchInput.classList.add('dropdown-active');
            }
        });
        
        // Handle keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            const visibleItems = dropdownList.querySelectorAll('.client-dropdown-item[style*="flex"], .client-dropdown-item:not([style*="none"])');
            const currentActive = dropdownList.querySelector('.client-dropdown-item.keyboard-active');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (currentActive) {
                    currentActive.classList.remove('keyboard-active');
                    const nextItem = Array.from(visibleItems).find(item => 
                        Array.from(visibleItems).indexOf(item) > Array.from(visibleItems).indexOf(currentActive)
                    );
                    if (nextItem) {
                        nextItem.classList.add('keyboard-active');
                        nextItem.scrollIntoView({ block: 'nearest' });
                    }
                } else if (visibleItems.length > 0) {
                    visibleItems[0].classList.add('keyboard-active');
                    visibleItems[0].scrollIntoView({ block: 'nearest' });
                }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (currentActive) {
                    currentActive.classList.remove('keyboard-active');
                    const prevItem = Array.from(visibleItems).reverse().find(item => 
                        Array.from(visibleItems).indexOf(item) < Array.from(visibleItems).indexOf(currentActive)
                    );
                    if (prevItem) {
                        prevItem.classList.add('keyboard-active');
                        prevItem.scrollIntoView({ block: 'nearest' });
                    }
                }
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (currentActive) {
                    currentActive.click();
                }
            } else if (e.key === 'Escape') {
                dropdownList.style.display = 'none';
                searchInput.classList.remove('dropdown-active');
                searchInput.blur();
            }
        });
    }

    // Function to render no clients message in modal
    function renderModalNoClients() {
        const clientsList = document.getElementById('modalClientsList');
        clientsList.innerHTML = `
            <div class="col-12 text-center py-4">
                <div class="no-clients-found">
                    <i class="fas fa-users no-clients-icon"></i>
                    <h6 data-en="No clients found" data-fr="Aucun client trouvé">No clients found</h6>
                    <p class="text-muted" data-en="Create your first client using the form above" data-fr="Créez votre premier client en utilisant le formulaire ci-dessus">
                        Create your first client using the form above
                    </p>
                </div>
            </div>
        `;
    }

    // Handle new client form submission in modal
    const newClientFormInModal = document.getElementById('newClientFormInModal');
    if (newClientFormInModal) {
        newClientFormInModal.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
            submitBtn.disabled = true;
            
            const formData = new FormData(this);
            
            // Debug: Log form data
            console.log('Submitting client form...');
            console.log('Form data entries:');
            for (let [key, value] of formData.entries()) {
                console.log(`${key}: ${value}`);
            }
            
            // Function to try client creation with fallback
            function tryClientCreation(url, isWebRoute = false) {
                console.log(`Trying client creation via: ${url}`);
                
                return fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log(`${isWebRoute ? 'Web' : 'API'} create client response status:`, response.status);
                    console.log('Response headers:', Object.fromEntries(response.headers.entries()));
                    
                    // If API route returns 401 and this is not already the web route, try web route
                    if (response.status === 401 && !isWebRoute) {
                        console.log('API route returned 401, trying web route...');
                        return tryClientCreation('/web-api/clients', true);
                    }
                    
                    // Get response text first to see what we actually received
                    return response.text().then(text => {
                        console.log('Raw response text:', text);
                        
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                        }
                        
                        try {
                            return JSON.parse(text);
                        } catch (e) {
                            console.error('Failed to parse JSON:', e);
                            throw new Error('Invalid JSON response: ' + text);
                        }
                    });
                });
            }
            
            // Start with API route
            tryClientCreation('/api/clients')
            .then(data => {
                console.log('Create client response:', data);
                if (data.success) {
                    alert(`Client "${data.client.client_name}" created successfully!`);
                    
                    // Save popups to the new client
                    setTimeout(() => {
                        if (confirm(`Save popups to ${data.client.client_name}'s records?`)) {
                            window.savePopupsDataFromSidebar('client', data.client.id);
                        } else {
                            // Refresh the clients list
                            loadClientsForModalSelection();
                        }
                    }, 500);
                    
                    // Reset form
                    this.reset();
                } else {
                    console.error('Client creation failed:', data);
                    alert('Error creating client: ' + (data.message || 'Unknown error'));
                    if (data.errors) {
                        console.error('Validation errors:', data.errors);
                    }
                    if (data.debug) {
                        console.error('Debug info:', data.debug);
                    }
                }
            })
            .catch(error => {
                console.error('Error creating client:', error);
                alert('Error creating client. Please check the console for details.');
                alert('Error creating client. Please try again.');
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Test API connection function
    function testAPIConnection() {
        console.log('=== Testing API Connection ===');
        
        // Test API route first
        fetch('/api/clients', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            console.log('API Test - Response status:', response.status);
            
            // If API route fails with 401, try web route
            if (response.status === 401) {
                console.log('API route returned 401, testing web route...');
                return fetch('/web-api/clients', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
            }
            return response;
        })
        .then(response => {
            console.log('Final Test - Response status:', response.status);
            if (response.ok) {
                return response.json();
            } else {
                throw new Error(`API Test failed with status: ${response.status}`);
            }
        })
        .then(data => {
            console.log('API Test - Success! Clients found:', data.clients ? data.clients.length : 0);
            console.log('API Test - Data:', data);
            
            if (data.user_id) {
                console.log('API Test - Authenticated as user ID:', data.user_id);
            }
        })
        .catch(error => {
            console.error('API Test - Error:', error);
        });
    }
    
    // Function to show client selection modal
    function showClientSelectionModal() {
        // Hide the popup save modal first
        const popupSaveModal = bootstrap.Modal.getInstance(document.getElementById('popupSaveModal'));
        if (popupSaveModal) {
            popupSaveModal.hide();
        }
        
        // Show client selection modal
        const clientModal = new bootstrap.Modal(document.getElementById('clientSelectionModal'));
        clientModal.show();
        
        // Load clients when modal is shown
        loadClientsForSelection();
    }
    
    // Function to load clients for selection
    function loadClientsForSelection() {
        const clientsList = document.getElementById('clientsList');
        
        // Try API route first, fall back to web route if 401
        fetch('/api/clients', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            // If API route returns 401, try web route
            if (response.status === 401) {
                console.log('API route returned 401, trying web route...');
                return fetch('/web-api/clients', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
            }
            return response;
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.clients) {
                renderClientsList(data.clients);
            } else {
                renderNoClients();
            }
        })
        .catch(error => {
            console.error('Error loading clients:', error);
            renderNoClients();
        });
    }
    
    // Function to render clients list
    function renderClientsList(clients) {
        const clientsList = document.getElementById('clientsList');
        
        if (clients.length === 0) {
            renderNoClients();
            return;
        }
        
        let html = '';
        clients.forEach(client => {
            const lastAccessed = client.last_accessed ? new Date(client.last_accessed).toLocaleDateString() : 'Never';
            html += `
                <div class="col-md-6 col-lg-4">
                    <div class="client-selection-card" data-client-id="${client.id}" onclick="selectClientForSaving(${client.id}, '${client.client_name}')">
                        <div class="client-avatar-large">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="client-info-large">
                            <h5>${client.client_name}</h5>
                            <p class="client-email-large">${client.client_email}</p>
                            <span class="client-status-large status-${client.client_status.toLowerCase()}">${client.client_status}</span>
                            <p class="small text-muted mb-0">Last accessed: ${lastAccessed}</p>
                        </div>
                        <div class="client-actions-large">
                            <button class="btn btn-select-client" type="button">
                                <i class="fas fa-check me-2"></i>Select
                            </button>
                        </div>
                    </div>
                </div>
            `;
        });
        
        clientsList.innerHTML = html;
    }
    
    // Function to render no clients found message
    function renderNoClients() {
        const clientsList = document.getElementById('clientsList');
        clientsList.innerHTML = `
            <div class="col-12">
                <div class="no-clients-found">
                    <div class="no-clients-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 data-en="No Clients Found" data-fr="Aucun client trouvé">No Clients Found</h4>
                    <p data-en="Create your first client using the form above to save popups to client records." data-fr="Créez votre premier client en utilisant le formulaire ci-dessus pour enregistrer les popups dans les dossiers clients.">Create your first client using the form above to save popups to client records.</p>
                </div>
            </div>
        `;
    }
    
    // Handle new client form submission in modal
    const newClientForm = document.getElementById('newClientForm');
    if (newClientForm) {
        newClientForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('add_client', '1');
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
            submitBtn.disabled = true;
            
            fetch('/api/clients', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Close the client selection modal
                    const clientModal = bootstrap.Modal.getInstance(document.getElementById('clientSelectionModal'));
                    clientModal.hide();
                    
                    // Save popups to the new client
                    setTimeout(() => {
                        if (confirm(`Client "${data.client.client_name}" created successfully! Save popups to this client's records?`)) {
                            window.savePopupsDataFromSidebar('client', data.client.id);
                        } else {
                            // Re-show the popup save modal if user cancels
                            const popupSaveModal = new bootstrap.Modal(document.getElementById('popupSaveModal'));
                            popupSaveModal.show();
                        }
                    }, 500);
                    
                    // Reset form
                    this.reset();
                } else {
                    alert('Error creating client: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error creating client:', error);
                alert('Error creating client. Please try again.');
            })
            .finally(() => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });
    }
    
    // Function to load saved popups into the sidebar
    function loadSavedPopupsIntoSidebar() {
        const clientId = {{ isset($client) && $client ? $client->id : 'null' }};
        
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
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.popups && data.popups.length > 0) {
                console.log(`Loading ${data.popups.length} saved popups for ${context} context into sidebar`);
                loadPopupsIntoSidebarDroppableArea(data.popups);
            } else {
                console.log(`No saved popups found for ${context} context`);
            }
        })
        .catch(error => {
            console.error('Error loading saved popups:', error);
        });
    }

    // Function to load popups into the sidebar droppable area
    function loadPopupsIntoSidebarDroppableArea(popups) {
        const droppableArea = document.querySelector('.nested-droppable');
        if (!droppableArea) {
            console.error('Sidebar droppable area not found');
            return;
        }

        // Clear existing popups except the title
        const existingPopups = droppableArea.querySelectorAll('.pinned-popup');
        existingPopups.forEach(popup => popup.remove());

        // Add each popup to the droppable area
        popups.forEach(popup => {
            // Create a container for the popup content
            const popupContainer = document.createElement('div');
            popupContainer.className = 'pinned-popup card mb-2';
            
            // Set the popup content directly from saved HTML
            popupContainer.innerHTML = popup.popup_content;
            
            // Ensure it has proper styling for the sidebar
            popupContainer.style.cssText = '';
            
            droppableArea.appendChild(popupContainer);
        });

        console.log(`Loaded ${popups.length} popups into sidebar droppable area`);
    }
    
    // Auto-load saved popups on page load
    setTimeout(() => {
        loadSavedPopupsIntoSidebar();
    }, 1000);
});
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
});

// Test function to check API connectivity - can be called from browser console
window.testClientAPI = function() {
    console.log('=== Testing Client API ===');
    console.log('Testing /api/clients endpoint...');
    console.log('Current URL:', window.location.href);
    console.log('CSRF Token:', '{{ csrf_token() }}');
    
    // First test the debug route to see what routes are available
    fetch('/debug-api-routes', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        console.log('=== Route Debug Info ===');
        console.log('Total routes:', data.total_routes);
        console.log('API/Client routes found:', data.api_client_routes.length);
        console.log('Routes:', data.api_client_routes);
        console.log('API routes file exists:', data.api_routes_file_exists);
        
        // Now test the actual API endpoint
        return fetch('/api/clients', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        });
    })
    .then(response => {
        console.log('API Test - Response status:', response.status);
        console.log('API Test - Response headers:', Object.fromEntries(response.headers.entries()));
        
        return response.text().then(text => {
            console.log('API Test - Raw response:', text);
            
            if (!response.ok) {
                console.error('API Test - HTTP error:', response.status, text);
                
                // If API route failed, test the web test route as fallback
                console.log('API route failed, testing web test route...');
                return fetch('/test-client-api', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                })
                .then(webResponse => webResponse.json())
                .then(webData => {
                    console.log('Web test route result:', webData);
                    return { api_failed: true, web_test_result: webData };
                });
            }
            
            try {
                return JSON.parse(text);
            } catch (e) {
                console.error('API Test - JSON parse error:', e);
                return { error: 'Invalid JSON', body: text };
            }
        });
    })
    .then(data => {
        console.log('API Test - Final result:', data);
        
        if (data.api_failed) {
            console.log('API route is not working, but web test shows:', data.web_test_result);
        } else if (data.success && data.clients) {
            console.log(`API Test - Success! Found ${data.clients.length} clients for user ${data.user_id}`);
            data.clients.forEach((client, index) => {
                console.log(`  Client ${index + 1}:`, {
                    id: client.id,
                    name: client.client_name,
                    email: client.client_email,
                    status: client.client_status,
                    user_id: client.user_id
                });
            });
        } else if (data.error) {
            console.error('API Test - Error:', data.error);
            console.error('API Test - Body:', data.body);
        } else {
            console.warn('API Test - Unexpected response:', data);
            if (data.debug) {
                console.log('API Test - Debug info:', data.debug);
            }
        }
    })
    .catch(error => {
        console.error('API Test - Network/fetch error:', error);
    });
    
    console.log('API test initiated. Check console for results.');
};

// Test function to create a test client
window.testCreateClient = function() {
    console.log('=== Testing Client Creation ===');
    
    const testData = {
        client_name: 'Test Client ' + Date.now(),
        client_email: 'test' + Date.now() + '@example.com',
        client_status: 'Active'
    };
    
    console.log('Creating test client with data:', testData);
    
    const formData = new FormData();
    Object.keys(testData).forEach(key => {
        formData.append(key, testData[key]);
    });
    
    fetch('/api/clients', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Create Test - Response status:', response.status);
        return response.text().then(text => {
            console.log('Create Test - Raw response:', text);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
            }
            
            try {
                return JSON.parse(text);
            } catch (e) {
                console.error('Create Test - JSON parse error:', e);
                throw new Error('Invalid JSON response: ' + text);
            }
        });
    })
    .then(data => {
        console.log('Create Test - Result:', data);
        if (data.success) {
            console.log('✅ Client created successfully!', data.client);
        } else {
            console.error('❌ Failed to create client:', data.message);
            if (data.errors) console.error('Validation errors:', data.errors);
            if (data.debug) console.error('Debug info:', data.debug);
        }
    })
    .catch(error => {
        console.error('Create Test - Error:', error);
    });
};

// Auto-run test on page load for debugging
console.log('Client API test functions available:');
console.log('- Run testClientAPI() to test fetching clients');
console.log('- Run testCreateClient() to test creating a client');
console.log('- Both functions provide detailed debugging output');
</script>
@endpush

@push('head-scripts')
<!-- Font Awesome Icons for enhanced UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
