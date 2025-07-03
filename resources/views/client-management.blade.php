@extends('layouts.user-layout')

@section('content')
<div class="client-management-container">
    <div class="page-header">
        <h1 class="page-title" data-en="Client Management" data-fr="Gestion des clients">Client Management</h1>
        <p class="page-subtitle" data-en="Manage your clients and access client-specific legal research" data-fr="Gérez vos clients et accédez à la recherche juridique spécifique aux clients">Manage your clients and access client-specific legal research</p>
    </div>

    <!-- Add New Client Section -->
    <div class="add-client-section">
        <div class="section-card">
            <div class="card-header">
                <h2 data-en="Add New Client" data-fr="Ajouter un nouveau client">Add New Client</h2>
            </div>
            <form method="POST" action="{{ route('clients.store') }}" class="client-form">
                @csrf
                <input type="hidden" name="add_client" value="1">
                
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="form-row">
                    <div class="form-group">
                        <label for="client_name" data-en="Client Name" data-fr="Nom du client">Client Name</label>
                        <input type="text" class="form-control" id="client_name" name="client_name" required>
                    </div>
                    <div class="form-group">
                        <label for="client_email" data-en="Email" data-fr="Courriel">Email</label>
                        <input type="email" class="form-control" id="client_email" name="client_email" required>
                    </div>
                    <div class="form-group">
                        <label for="client_status" data-en="Status" data-fr="Statut">Status</label>
                        <select class="form-control" id="client_status" name="client_status" required>
                            <option value="Active" data-en="Active" data-fr="Actif">Active</option>
                            <option value="Inactive" data-en="Inactive" data-fr="Inactif">Inactive</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" data-en="Add Client" data-fr="Ajouter le client">Add Client</button>
            </form>
        </div>
    </div>

    <!-- Existing Clients Section -->
    <div class="clients-list-section">
        <div class="section-card">
            <div class="card-header">
                <h2 data-en="Your Clients" data-fr="Vos clients">Your Clients</h2>
                <p data-en="Select a client to access their legal research workspace" data-fr="Sélectionnez un client pour accéder à son espace de recherche juridique">Select a client to access their legal research workspace</p>
            </div>
            
            <div class="clients-grid">
                @php
                    $clients = \App\Models\Client::where('user_id', Auth::id())
                        ->orderBy('last_accessed', 'desc')
                        ->get();
                @endphp

                @if($clients->count() > 0)
                    @foreach($clients as $client)
                        <div class="client-card" onclick="selectClient({{ $client->id }})">
                            <div class="client-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="client-info">
                                <h3>{{ $client->client_name }}</h3>
                                <p class="client-email">{{ $client->client_email }}</p>
                                <p class="client-status status-{{ strtolower($client->client_status) }}">
                                    {{ $client->client_status }}
                                </p>
                                @if($client->last_accessed)
                                    <p class="last-accessed">
                                        <span data-en="Last accessed:" data-fr="Dernier accès:">Last accessed:</span>
                                        @try
                                            {{ is_string($client->last_accessed) ? \Carbon\Carbon::parse($client->last_accessed)->diffForHumans() : $client->last_accessed->diffForHumans() }}
                                        @catch(\Exception $e)
                                            {{ $client->last_accessed }}
                                        @endtry
                                    </p>
                                @endif
                            </div>
                            <div class="client-actions">
                                <button class="btn btn-primary btn-sm" data-en="Select Client" data-fr="Sélectionner le client">
                                    Select Client
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="no-clients">
                        <div class="no-clients-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 data-en="No Clients Found" data-fr="Aucun client trouvé">No Clients Found</h3>
                        <p data-en="Add your first client to get started with client-specific legal research." data-fr="Ajoutez votre premier client pour commencer la recherche juridique spécifique aux clients.">Add your first client to get started with client-specific legal research.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Hidden form for client selection -->
<form id="selectClientForm" method="POST" action="{{ route('clients.select') }}" style="display: none;">
    @csrf
    <input type="hidden" id="selected_client_id" name="client_id">
</form>

<script>
function selectClient(clientId) {
    document.getElementById('selected_client_id').value = clientId;
    document.getElementById('selectClientForm').submit();
}
</script>

<style>
.client-management-container {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.page-header {
    margin-bottom: 2rem;
}

.page-title {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: #7f8c8d;
    font-size: 1.1rem;
}

.section-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #e9ecef;
}

.card-header {
    margin-bottom: 1.5rem;
}

.card-header h2 {
    font-size: 1.5rem;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.card-header p {
    color: #7f8c8d;
    margin: 0;
}

.client-form {
    max-width: 800px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #2c3e50;
}

.form-control {
    padding: 0.75rem;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

.btn {
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0056b3, #004085);
    transform: translateY(-2px);
}

.clients-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 1.5rem;
}

.client-card {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    padding: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.client-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    border-color: #007bff;
}

.client-avatar {
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

.client-info {
    flex: 1;
}

.client-info h3 {
    margin: 0 0 0.25rem 0;
    color: #2c3e50;
    font-size: 1.2rem;
}

.client-email {
    color: #7f8c8d;
    margin: 0 0 0.25rem 0;
    font-size: 0.9rem;
}

.client-status {
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

.last-accessed {
    color: #7f8c8d;
    font-size: 0.8rem;
    margin: 0.25rem 0 0 0;
}

.client-actions {
    flex-shrink: 0;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

.no-clients {
    text-align: center;
    padding: 3rem;
    color: #7f8c8d;
}

.no-clients-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #dee2e6;
}

.no-clients h3 {
    margin-bottom: 1rem;
    color: #6c757d;
}

.alert {
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .clients-grid {
        grid-template-columns: 1fr;
    }
    
    .client-card {
        flex-direction: column;
        text-align: center;
    }
}
</style>
@endsection
