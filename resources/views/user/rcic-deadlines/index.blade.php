@extends('layouts.user-layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 data-en="RCIC Deadlines" data-fr="Délais RCIC">RCIC Deadlines</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <div class="mb-4">
                        <form action="{{ route('user.rcic-deadlines.index') }}" method="GET" class="row g-3" id="searchForm">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search deadlines..." name="search" value="{{ request('search') }}" id="searchInput" data-placeholder-en="Search deadlines..." data-placeholder-fr="Rechercher des délais...">
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
                        </form>
                    </div>

                    <!-- Deadlines Cards -->
                    <div class="row">
                        @forelse($deadlines as $deadline)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card border h-100">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0">{{ $deadline->title }}</h5>
                                    </div>
                                    <div class="card-body">
                                        @if($deadline->category)
                                            <div class="mb-2">
                                                <span class="badge bg-info">{{ $deadline->category }}</span>
                                            </div>
                                        @endif
                                        @if($deadline->type)
                                            <div class="mb-2">
                                                <span class="badge bg-secondary">{{ $deadline->type }}</span>
                                            </div>
                                        @endif
                                        <p class="card-text">{{ $deadline->description }}</p>
                                        @if($deadline->days_before)
                                            <div class="mt-3">
                                                <i class="fas fa-clock"></i>
                                                <strong data-en="Days Before:" data-fr="Jours avant :">Days Before:</strong> {{ $deadline->days_before }} <span data-en="days" data-fr="jours">days</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <span data-en="No deadlines found." data-fr="Aucun délai trouvé.">No deadlines found.</span>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $deadlines->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-submit form when category changes
    document.getElementById('categoryFilter').addEventListener('change', function() {
        document.getElementById('searchForm').submit();
    });

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
@endsection
