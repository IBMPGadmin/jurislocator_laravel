@extends('layouts.user-layout')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.government-links') }}" data-en="Government Links" data-fr="Liens Gouvernementaux">Government Links</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category }}</li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">{{ $category }} <span data-en="Links" data-fr="Liens">Links</span></h2>
                <a href="{{ route('user.government-links') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> <span data-en="Back to Categories" data-fr="Retour aux Catégories">Back to Categories</span>
                </a>
            </div>
            
            @if($links->isEmpty())
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <span data-en="No links available for this category at the moment." data-fr="Aucun lien disponible pour cette catégorie pour le moment.">No links available for this category at the moment.</span>
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th data-en="Name" data-fr="Nom">Name</th>
                                        <th data-en="Description" data-fr="Description">Description</th>
                                        <th class="text-center" data-en="Action" data-fr="Action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($links as $link)
                                        <tr>
                                            <td class="fw-semibold">{{ $link->name }}</td>
                                            <td>
                                                @if($link->description)
                                                    {{ $link->description }}
                                                @else
                                                    <span class="text-muted" data-en="No description" data-fr="Aucune description">No description</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ $link->url }}" class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="bi bi-box-arrow-up-right me-1"></i> <span data-en="Visit" data-fr="Visiter">Visit</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to translate the page
    function translatePage(language) {
        // Translate all data attributes
        document.querySelectorAll('[data-en], [data-fr]').forEach(function(element) {
            var translation = element.getAttribute('data-' + language);
            if (translation) {
                element.textContent = translation;
            }
        });
    }

    // Listen for language changes
    document.addEventListener('languageChanged', function(e) {
        translatePage(e.detail.language);
    });

    // Apply current language on page load
    var currentLanguage = localStorage.getItem('language') || 'en';
    translatePage(currentLanguage);
});
</script>
@endpush

@push('styles')
<style>
    .breadcrumb {
        background-color: #f8f9fa;
        padding: 0.75rem 1rem;
        border-radius: 0.25rem;
    }
    
    .table th {
        background-color: #f8f9fa;
    }
    
    .btn-primary {
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
@endpush
