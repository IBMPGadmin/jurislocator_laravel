@extends('layouts.admin')

@section('title', 'Pending User Approvals')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('admin-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-user-clock me-2"></i>
                        Pending User Approvals
                        @if($pendingUsers->total() > 0)
                            <span class="badge bg-warning ms-2">{{ $pendingUsers->total() }}</span>
                        @endif
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="refresh">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($pendingUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>User Info</th>
                                        <th>User Type</th>
                                        <th>Additional Info</th>
                                        <th>Registration Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingUsers as $user)
                                        <tr>
                                            <td>
                                                <div class="user-info">
                                                    <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        <i class="fas fa-envelope me-1"></i>
                                                        {{ $user->email }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">
                                                    @if($user->user_type === 'licensed_practitioner')
                                                        Licensed Canadian Immigration Practitioner
                                                    @elseif($user->user_type === 'immigration_lawyer')
                                                        Canadian Immigration Lawyer
                                                    @elseif($user->user_type === 'notaire_quebec')
                                                        Member of Chambre des notaires du Québec
                                                    @elseif($user->user_type === 'student_queens')
                                                        Immigration Law student - Queens University
                                                    @elseif($user->user_type === 'student_montreal')
                                                        Immigration Law student - Université de Montréal
                                                    @else
                                                        {{ ucfirst(str_replace('_', ' ', $user->user_type)) }}
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                @if(in_array($user->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec']))
                                                    <small class="text-muted">
                                                        <i class="fas fa-certificate me-1"></i>
                                                        License: {{ $user->license_number ?: 'Not provided' }}
                                                    </small>
                                                @elseif($user->user_type === 'company')
                                                    <small class="text-muted">
                                                        <i class="fas fa-building me-1"></i>
                                                        Company: {{ $user->company_name ?: 'Not provided' }}
                                                    </small>
                                                @elseif(in_array($user->user_type, ['student_queens', 'student_montreal']))
                                                    <small class="text-muted">
                                                        <i class="fas fa-id-badge me-1"></i>
                                                        Student ID: <strong>{{ $user->student_id_number ?: 'Not provided' }}</strong>
                                                        <br>
                                                        <i class="fas fa-university me-1"></i>
                                                        @if($user->user_type === 'student_queens')
                                                            Queens University
                                                        @else
                                                            Université de Montréal
                                                        @endif
                                                        <br>
                                                        <i class="fas fa-id-card me-1"></i>
                                                        @if($user->student_id_file)
                                                            <span class="text-success">Student ID Photo: ✓ Uploaded</span>
                                                        @else
                                                            <span class="text-danger">Student ID Photo: ✗ Missing</span>
                                                        @endif
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    {{ $user->created_at->format('M d, Y') }}
                                                    <br>
                                                    <span class="text-muted">{{ $user->created_at->diffForHumans() }}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-success" 
                                                            onclick="approveUser({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')">
                                                        <i class="fas fa-check me-1"></i>
                                                        Approve
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                            onclick="rejectUser({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')">
                                                        <i class="fas fa-times me-1"></i>
                                                        Reject
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-info" 
                                                            onclick="viewUserDetails({{ $user->id }})">
                                                        <i class="fas fa-eye me-1"></i>
                                                        View
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $pendingUsers->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-user-check fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Pending Approvals</h4>
                            <p class="text-muted">All user registrations have been processed.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approval Confirmation Modal -->
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-check-circle me-2"></i>
                    Approve User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to approve <strong id="approveUserName"></strong>?</p>
                <p class="text-muted">This will:</p>
                <ul class="text-muted">
                    <li>Activate their account</li>
                    <li>Start their 7-day trial subscription</li>
                    <li>Send them an approval email notification</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="approveForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>
                        Approve User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Confirmation Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-times-circle me-2"></i>
                    Reject User
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reject <strong id="rejectUserName"></strong>?</p>
                <p class="text-danger">This action cannot be undone and will:</p>
                <ul class="text-danger">
                    <li>Permanently reject their registration</li>
                    <li>Send them a rejection email notification</li>
                    <li>Prevent them from logging in</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="rejectForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i>
                        Reject User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2"></i>
                    User Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="userDetailsContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function approveUser(userId, userName) {
    document.getElementById('approveUserName').textContent = userName;
    document.getElementById('approveForm').action = `/admin/user-approvals/${userId}/approve`;
    new bootstrap.Modal(document.getElementById('approveModal')).show();
}

function rejectUser(userId, userName) {
    document.getElementById('rejectUserName').textContent = userName;
    document.getElementById('rejectForm').action = `/admin/user-approvals/${userId}/reject`;
    new bootstrap.Modal(document.getElementById('rejectModal')).show();
}

function viewUserDetails(userId) {
    // Load user details via AJAX
    fetch(`/admin/user-approvals/${userId}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('userDetailsContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('userDetailsModal')).show();
        })
        .catch(error => {
            console.error('Error loading user details:', error);
            alert('Error loading user details');
        });
}

// Auto-refresh every 30 seconds
setInterval(() => {
    location.reload();
}, 30000);
</script>

<style>
.user-info {
    min-width: 200px;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    margin-right: 2px;
}

.badge {
    font-size: 0.75em;
}

.alert {
    border-left: 4px solid;
}

.table-responsive {
    border-radius: 0.375rem;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: 1px solid rgba(0, 0, 0, 0.125);
}

.modal-header.bg-success {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.modal-header.bg-danger {
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}
</style>
@endsection
