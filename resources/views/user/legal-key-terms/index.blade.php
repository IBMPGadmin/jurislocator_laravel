@extends('layouts.user-layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 data-en="Legal Key Terms" data-fr="Termes Juridiques Clés">Legal Key Terms</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <div class="mb-4">
                        <form action="{{ route('user.legal-key-terms.index') }}" method="GET" class="row g-3" id="searchForm">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search terms..." name="search" value="{{ request('search') }}" id="searchInput" data-placeholder-en="Search terms..." data-placeholder-fr="Rechercher des termes...">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> <span data-en="Search" data-fr="Rechercher">Search</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="category" class="form-select" id="categoryFilter" onchange="this.form.submit()">
                                    <option value="" data-en="All Categories" data-fr="Toutes les catégories">All Categories</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="language" class="form-select" id="languageFilter" onchange="this.form.submit()">
                                    <option value="" data-en="All Languages" data-fr="Toutes les langues">All Languages</option>
                                    @foreach($languages as $code => $name)
                                        <option value="{{ $code }}" {{ request('language') == $code ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Terms Cards -->
                    <div class="row">
                        @forelse($terms as $term)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card border h-100">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">{{ $term->term }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $term->definition }}</p>
                                        
                                        <div class="mt-3">
                                            @if($term->category)
                                                <div class="mb-2">
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-folder me-1"></i> {{ $term->category }}
                                                    </span>
                                                </div>
                                            @endif
                                            
                                            @if($term->source)
                                                <div class="text-muted">
                                                    <small><i class="fas fa-book me-1"></i> <span data-en="Source:" data-fr="Source :">Source:</span> {{ $term->source }}</small>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <span data-en="No terms found." data-fr="Aucun terme trouvé.">No terms found.</span>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $terms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Translation functionality
    document.addEventListener('DOMContentLoaded', function() {
        function translatePage(language) {
            // Translate all data attributes
            document.querySelectorAll('[data-en], [data-fr]').forEach(function(element) {
                var translation = element.getAttribute('data-' + language);
                if (translation) {
                    element.textContent = translation;
                }
            });

            // Translate placeholder texts
            document.querySelectorAll('[data-placeholder-en], [data-placeholder-fr]').forEach(function(element) {
                var placeholder = element.getAttribute('data-placeholder-' + language);
                if (placeholder) {
                    element.placeholder = placeholder;
                }
            });
        }

        // Listen for language changes
        document.addEventListener('languageChanged', function(e) {
            translatePage(e.detail.language);
        });

        // Apply current language on page load
        var currentLanguage = localStorage.getItem('selectedLanguage') || 'en';
        translatePage(currentLanguage);
    });
</script>
@endpush
