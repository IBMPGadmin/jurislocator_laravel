@extends('layouts.user-layout')

@section('content')
<div class="client-section">
    <div class="container">
        <!-- Client Selection Section -->
        <div class="gap_top btn-shadow bg_custom p-4 rounded shadow-sm">
            <div class="card-header">
                <div class="clients-header">
                    <h5>Your Clients</h5>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="clientSearch" placeholder="Search clients...">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="client-grid" id="clientGrid">
                    @if(count($clients) == 0)
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <h4>No Clients Found</h4>
                            <p>Add your first client to get started</p>
                        </div>
                    @else
                        @foreach($clients as $client)
                            @php
                                $initial = strtoupper(substr($client->client_name ?? 'U', 0, 1));
                                $status = isset($client->client_status) ? strtolower($client->client_status) : 'unknown';
                                $time_ago = '';
                                
                                if (isset($client->last_accessed) && !empty($client->last_accessed)) {
                                    try {
                                        $time_ago = \Carbon\Carbon::parse($client->last_accessed)->diffForHumans();
                                    } catch (\Exception $e) {
                                        // Handle error
                                    }
                                }
                            @endphp
                            <div class="client-card">
                                <div class="client-avatar">{{ $initial }}</div>
                                <div class="client-info">
                                    <div class="client-name">{{ $client->client_name }}</div>
                                    @if(isset($client->client_email))
                                    <div class="client-email">{{ $client->client_email }}</div>
                                    @endif
                                    <div class="client-status d-flex align-items-center justify-content-center gap-2 mt-2">
                                        @if(isset($client->client_status))
                                        <span class="badge bg-{{ $client->client_status == 'Active' ? 'success' : 'secondary' }}">
                                            {{ $client->client_status }}
                                        </span>
                                        @endif
                                    </div>
                                    @if(!empty($time_ago))
                                        <div class="last-accessed mt-2">
                                            <small>Last accessed: {{ $time_ago }}</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="client-actions">
                                    <a href="{{ route('templates.index', ['client_id' => $client->id]) }}" class="select-client-btn">
                                        Select Client
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                @if(count($clients) == 0)
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-user-slash fa-4x text-muted"></i>
                        </div>
                        <h5>No clients found</h5>
                        <p class="text-muted">Please add a client from your dashboard first</p>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-arrow-left me-2"></i> Go to Dashboard
                        </a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Client Card Styles */
    .client-section {
        padding: 2rem 0;
    }
    
    .btn-shadow {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .bg_custom {
        background-color: var(--color-card-bg);
    }
    
    .clients-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .search-box {
        position: relative;
        width: 300px;
    }
    
    .search-box input {
        width: 100%;
        padding: 0.75rem 1.25rem 0.75rem 3rem;
        border-radius: 50px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    
    .search-box i {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--light-text);
    }
    
    .client-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
        max-height: 600px;
        overflow-y: auto;
        padding-right: 10px;
    }
    
    .client-card {
        background: var(--color-card-bg);
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(30, 28, 28, 0.64);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        border: 1px solid rgba(0,0,0,0.05);
        position: relative;
    }
    
    .client-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }
    
    .client-avatar {
        width: 70px;
        height: 70px;
        background: var(--color-theme-3);
        border-radius: 50%;
        margin: 0 auto 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: #fff;
        font-weight: 600;
    }
    
    .client-info {
        text-align: center;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }
    
    .client-name {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    
    .client-email {
        color: var(--light-text);
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
        word-break: break-all;
    }
    
    .client-actions {
        margin-top: auto;
    }
    
    .select-client-btn {
        width: 100%;
        padding: 0.75rem;
        background-color: var(--color-theme-3);
        color: white;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        cursor: pointer;
        text-align: center;
        display: block;
        text-decoration: none;
    }
    
    .select-client-btn:hover {
        background-color: var(--color-theme-4);
        transform: translateY(-2px);
        text-decoration: none;
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: var(--light-text);
        grid-column: 1 / -1;
    }
    
    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #e0e0e0;
    }
    
    .last-accessed {
        color: var(--light-text);
        font-size: 0.8rem;
    }
    
    @media (max-width: 768px) {
        .client-grid {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }
        
        .clients-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .search-box {
            width: 100%;
            margin-top: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('clientSearch');
    const clientCards = document.querySelectorAll('.client-card');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        clientCards.forEach(card => {
            const clientName = card.querySelector('.client-name').textContent.toLowerCase();
            const clientEmail = card.querySelector('.client-email')?.textContent.toLowerCase() || '';
            
            if (clientName.includes(searchTerm) || clientEmail.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
@endsection
