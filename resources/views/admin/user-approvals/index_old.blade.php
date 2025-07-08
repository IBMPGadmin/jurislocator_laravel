@extends('layouts.admin')

@section('title', 'Pending User Approvals')

@php
    use Illuminate\Support\Facades\Storage;
@endphp



<style>
    :root {
        --primary-color: #2563eb;
        --primary-dark: #1d4ed8;
        --secondary-color: #64748b;
        --success-color: #059669;
        --danger-color: #dc2626;
        --warning-color: #d97706;
        --info-color: #0891b2;
        --light-bg: #f8fafc;
        --white: #ffffff;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-500: #6b7280;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --border-radius: 8px;
        --border-radius-lg: 12px;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }

    * {
        box-sizing: border-box;
    }

    body {
        background: var(--light-bg);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        color: var(--gray-800);
        line-height: 1.6;
    }

    .professional-container {
        padding: 2rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    .admin-header-section {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius-lg);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-sm);
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .header-content-left {
        flex: 1;
        min-width: 300px;
    }

    .header-content-right {
        flex-shrink: 0;
        display: flex;
        justify-content: flex-end;
    }

    .admin-page-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .admin-page-subtitle {
        color: var(--gray-500);
        font-size: 1rem;
        margin: 0;
        font-weight: 400;
    }

    .admin-pending-counter {
        background: var(--primary-color);
        color: var(--white);
        padding: 0.75rem 1.5rem;
        border-radius: var(--border-radius);
        font-size: 1rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-sm);
        white-space: nowrap;
    }

    .professional-alert {
        background: #dcfce7;
        border: 1px solid #bbf7d0;
        border-left: 4px solid var(--success-color);
        border-radius: var(--border-radius);
        padding: 1rem;
        margin-bottom: 2rem;
        color: var(--success-color);
    }

    .data-table-container {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .table-header {
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-200);
    }

    .table-header th {
        padding: 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: var(--gray-700);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
        text-align: left;
    }

    .table-row {
        border-bottom: 1px solid var(--gray-100);
        transition: background-color 0.15s ease-in-out;
    }

    .table-row:hover {
        background: var(--gray-50);
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .table-cell {
        padding: 1.5rem 1rem;
        border: none;
        vertical-align: middle;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        border-radius: var(--border-radius);
        background: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .user-info h6 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--gray-900);
        margin: 0 0 0.25rem 0;
    }

    .user-info small {
        color: var(--gray-500);
        font-size: 0.875rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: var(--border-radius);
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-badge.licensed {
        background: #eff6ff;
        color: var(--primary-color);
        border: 1px solid #dbeafe;
    }

    .status-badge.lawyer {
        background: #f0fdf4;
        color: var(--success-color);
        border: 1px solid #dcfce7;
    }

    .status-badge.student {
        background: #fef3c7;
        color: var(--warning-color);
        border: 1px solid #fde68a;
    }

    .status-badge.standard {
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--gray-200);
    }

    .info-card {
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 0.75rem;
        margin-bottom: 0.5rem;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-500);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--gray-900);
    }

    .verification-status {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.25rem 0.5rem;
        border-radius: var(--border-radius);
        font-size: 0.75rem;
        font-weight: 500;
    }

    .verification-status.verified {
        background: #dcfce7;
        color: var(--success-color);
    }

    .verification-status.missing {
        background: #fee2e2;
        color: var(--danger-color);
    }

    .date-display {
        text-align: center;
        padding: 0.75rem;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
    }

    .date-primary {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }

    .date-secondary {
        font-size: 0.75rem;
        color: var(--gray-500);
    }

    .actions-group {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border: 1px solid;
        border-radius: var(--border-radius);
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.15s ease-in-out;
        text-decoration: none;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
    }

    .action-btn.approve {
        background: var(--white);
        border-color: var(--success-color);
        color: var(--success-color);
    }

    .action-btn.approve:hover {
        background: var(--success-color);
        color: var(--white);
    }

    .action-btn.reject {
        background: var(--white);
        border-color: var(--danger-color);
        color: var(--danger-color);
    }

    .action-btn.reject:hover {
        background: var(--danger-color);
        color: var(--white);
    }

    .action-btn.view {
        background: var(--white);
        border-color: var(--info-color);
        color: var(--info-color);
    }

    .action-btn.view:hover {
        background: var(--info-color);
        color: var(--white);
    }

    .empty-state {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius-lg);
        padding: 4rem 2rem;
        text-align: center;
        box-shadow: var(--shadow-sm);
    }

    .empty-icon {
        font-size: 4rem;
        color: var(--gray-400);
        margin-bottom: 1.5rem;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .empty-text {
        color: var(--gray-500);
        margin-bottom: 2rem;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination-wrapper {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 0.75rem;
        box-shadow: var(--shadow-sm);
    }

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: var(--border-radius-lg);
        box-shadow: var(--shadow-xl);
    }

    .modal-header {
        border-bottom: 1px solid var(--gray-200);
        padding: 1.5rem;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--gray-900);
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-footer {
        border-top: 1px solid var(--gray-200);
        padding: 1.5rem;
    }

    /* Button Styles */
    .btn-primary {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--white);
        font-weight: 500;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
    }

    .btn-success {
        background: var(--success-color);
        border-color: var(--success-color);
        color: var(--white);
        font-weight: 500;
    }

    .btn-danger {
        background: var(--danger-color);
        border-color: var(--danger-color);
        color: var(--white);
        font-weight: 500;
    }

    .btn-secondary {
        background: var(--gray-500);
        border-color: var(--gray-500);
        color: var(--white);
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .professional-container {
            padding: 1rem;
        }
        
        .page-header {
            padding: 1.5rem;
        }
        
        .page-title {
            font-size: 1.5rem;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .user-profile {
            flex-direction: column;
            text-align: center;
            gap: 0.75rem;
        }
        
        .actions-group {
            flex-wrap: wrap;
            gap: 0.375rem;
        }
        
        .table-cell {
            padding: 1rem 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .table-header th,
        .table-cell {
            padding: 0.75rem 0.5rem;
            font-size: 0.875rem;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            font-size: 0.875rem;
        }
        
        .action-btn {
            width: 32px;
            height: 32px;
            font-size: 0.75rem;
        }
    }
</style>



@section('admin-content')
<div class="professional-container">
    <!-- Professional Header -->
    <div class="admin-header-section">
        <div class="header-content-left">
            <h1 class="admin-page-title">
                <i class="ti ti-users-check"></i>
                User Approvals Management
            </h1>
            <p class="admin-page-subtitle">Review and manage pending user registrations</p>
        </div>
        <div class="header-content-right">
            <div class="admin-pending-counter">
                <i class="ti ti-clock"></i>
                {{ $pendingUsers->total() }} Pending Approvals
            </div>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="professional-alert alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="ti ti-check-circle me-3" style="font-size: 1.25rem;"></i>
                <div>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Data Table -->
    @if($pendingUsers->count() > 0)
        <div class="data-table-container">
            <table class="table align-middle mb-0">
                <thead class="table-header">
                    <tr>
                        <th style="width: 30%;">User Information</th>
                        <th style="width: 15%;">User Type</th>
                        <th style="width: 25%;">Additional Details</th>
                        <th style="width: 15%;">Registration Date</th>
                        <th style="width: 15%;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendingUsers as $user)
                        <tr class="table-row">
                            <td class="table-cell">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1)) }}
                                    </div>
                                    <div class="user-info">
                                        <h6>{{ $user->first_name }} {{ $user->last_name }}</h6>
                                        <small>
                                            <i class="ti ti-mail me-1"></i>{{ $user->email }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td class="table-cell">
                                <span class="status-badge 
                                    @if(in_array($user->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec'])) licensed
                                    @elseif(in_array($user->user_type, ['student_queens', 'student_montreal'])) student
                                    @else standard @endif">
                                    @if($user->user_type === 'licensed_practitioner')
                                        <i class="ti ti-certificate"></i>Licensed Practitioner
                                    @elseif($user->user_type === 'immigration_lawyer')
                                        <i class="ti ti-scale"></i>Immigration Lawyer
                                    @elseif($user->user_type === 'notaire_quebec')
                                        <i class="ti ti-stamp"></i>Notaire Quebec
                                    @elseif($user->user_type === 'student_queens')
                                        <i class="ti ti-school"></i>Queens Student
                                    @elseif($user->user_type === 'student_montreal')
                                        <i class="ti ti-school"></i>Montreal Student
                                    @else
                                        <i class="ti ti-user"></i>Standard User
                                    @endif
                                </span>
                            </td>
                            <td class="table-cell">
                                @if(in_array($user->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec']))
                                    <div class="info-card">
                                        <div class="info-label">License Number</div>
                                        <div class="info-value">{{ $user->license_number ?: 'Not provided' }}</div>
                                    </div>
                                @elseif($user->user_type === 'company')
                                    <div class="info-card">
                                        <div class="info-label">Company Name</div>
                                        <div class="info-value">{{ $user->company_name ?: 'Not provided' }}</div>
                                    </div>
                                @elseif(in_array($user->user_type, ['student_queens', 'student_montreal']))
                                    <div class="info-card">
                                        <div class="info-label">Student ID</div>
                                        <div class="info-value">{{ $user->student_id_number ?: 'Not provided' }}</div>
                                    </div>
                                    <div class="mt-2">
                                        @if($user->student_id_file)
                                            <span class="verification-status verified">
                                                <i class="ti ti-check"></i>Photo Uploaded
                                            </span>
                                        @else
                                            <span class="verification-status missing">
                                                <i class="ti ti-x"></i>Photo Missing
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="info-card">
                                        <div class="info-label">Account Type</div>
                                        <div class="info-value">Standard User</div>
                                    </div>
                                @endif
                            </td>
                            <td class="table-cell">
                                <div class="date-display">
                                    <div class="date-primary">{{ $user->created_at->format('M d, Y') }}</div>
                                    <div class="date-secondary">{{ $user->created_at->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="table-cell">
                                <div class="actions-group">
                                    <button type="button" class="action-btn approve" 
                                            onclick="approveUser({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Approve User">
                                        <i class="ti ti-check"></i>
                                    </button>
                                    <button type="button" class="action-btn reject" 
                                            onclick="rejectUser({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Reject User">
                                        <i class="ti ti-x"></i>
                                    </button>
                                    <button type="button" class="action-btn view" 
                                            onclick="viewUserDetails({{ $user->id }})"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <div class="pagination-wrapper">
                {{ $pendingUsers->links() }}
            </div>
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <i class="ti ti-user-check"></i>
            </div>
            <h4 class="empty-title">No Pending Approvals</h4>
            <p class="empty-text">All user registrations have been processed successfully.</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                <i class="ti ti-users me-2"></i>View All Users
            </a>
        </div>
    @endif
</div>

<!-- Approval Confirmation Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="ti ti-check-circle me-2"></i>
                    Approve User Registration
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="ti ti-user-check" style="font-size: 3rem; color: #28a745;"></i>
                </div>
                <p class="text-center">Are you sure you want to approve <strong id="approveUserName"></strong>?</p>
                <div class="alert alert-info">
                    <h6 class="alert-heading"><i class="ti ti-info-circle me-2"></i>This will:</h6>
                    <ul class="mb-0">
                        <li>Activate their account immediately</li>
                        <li>Start their 7-day trial subscription</li>
                        <li>Send them an approval email notification</li>
                        <li>Grant access to all platform features</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancel
                </button>
                <form id="approveForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-check me-1"></i>
                        Approve User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rejection Confirmation Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="ti ti-x-circle me-2"></i>
                    Reject User Registration
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="ti ti-user-x" style="font-size: 3rem; color: #dc3545;"></i>
                </div>
                <p class="text-center">Are you sure you want to reject <strong id="rejectUserName"></strong>?</p>
                <div class="alert alert-warning">
                    <h6 class="alert-heading"><i class="ti ti-alert-triangle me-2"></i>Warning: This action cannot be undone and will:</h6>
                    <ul class="mb-0 text-danger">
                        <li>Permanently reject their registration</li>
                        <li>Send them a rejection email notification</li>
                        <li>Prevent them from logging in</li>
                        <li>Remove their access to the platform</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancel
                </button>
                <form id="rejectForm" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-x me-1"></i>
                        Reject User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- User Details Modal -->
<div class="modal fade" id="userDetailsModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="ti ti-user me-2"></i>
                    User Details & Information
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="userDetailsContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading user details...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables to store modal instances
let approveModalInstance = null;
let rejectModalInstance = null;
let userDetailsModalInstance = null;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize modal instances
    approveModalInstance = new bootstrap.Modal(document.getElementById('approveModal'));
    rejectModalInstance = new bootstrap.Modal(document.getElementById('rejectModal'));
    userDetailsModalInstance = new bootstrap.Modal(document.getElementById('userDetailsModal'));
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

function approveUser(userId, userName) {
    document.getElementById('approveUserName').textContent = userName;
    document.getElementById('approveForm').action = `/admin/user-approvals/${userId}/approve`;
    approveModalInstance.show();
}

function rejectUser(userId, userName) {
    document.getElementById('rejectUserName').textContent = userName;
    document.getElementById('rejectForm').action = `/admin/user-approvals/${userId}/reject`;
    rejectModalInstance.show();
}

function viewUserDetails(userId) {
    // Show loading state
    document.getElementById('userDetailsContent').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading user details...</p>
        </div>
    `;
    
    // Show modal first
    userDetailsModalInstance.show();
    
    // Load user details via AJAX
    fetch(`/admin/user-approvals/${userId}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'text/html',
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text();
    })
    .then(html => {
        document.getElementById('userDetailsContent').innerHTML = html;
        
        // Fix image loading issues
        const images = document.querySelectorAll('#userDetailsContent img');
        images.forEach(img => {
            img.onerror = function() {
                this.style.display = 'none';
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-warning text-center';
                errorDiv.innerHTML = `
                    <i class="ti ti-photo-off fa-2x mb-2"></i>
                    <p class="mb-0">Image could not be loaded</p>
                    <small class="text-muted">The student ID photo may have been moved or deleted</small>
                `;
                this.parentNode.replaceChild(errorDiv, this);
            };
        });
    })
    .catch(error => {
        console.error('Error loading user details:', error);
        document.getElementById('userDetailsContent').innerHTML = `
            <div class="alert alert-danger text-center">
                <i class="ti ti-alert-circle fa-2x mb-2"></i>
                <h5 class="alert-heading">Error Loading User Details</h5>
                <p class="mb-0">There was an error loading the user information. Please try again.</p>
                <button class="btn btn-danger btn-sm mt-2" onclick="viewUserDetails(${userId})">
                    <i class="ti ti-refresh me-1"></i>Retry
                </button>
            </div>
        `;
    });
}

// Functions to be called from within the modal (for approve/reject buttons in user details)
function approveUserFromModal(userId, userName) {
    // Close user details modal first
    userDetailsModalInstance.hide();
    
    // Wait for modal to close completely before showing approval modal
    setTimeout(() => {
        approveUser(userId, userName);
    }, 300);
}

function rejectUserFromModal(userId, userName) {
    // Close user details modal first
    userDetailsModalInstance.hide();
    
    // Wait for modal to close completely before showing rejection modal
    setTimeout(() => {
        rejectUser(userId, userName);
    }, 300);
}

// Form submission handlers with better error handling
document.addEventListener('DOMContentLoaded', function() {
    const approveForm = document.getElementById('approveForm');
    const rejectForm = document.getElementById('rejectForm');
    
    if (approveForm) {
        approveForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ti ti-loader-2 spinning me-1"></i>Processing...';
        });
    }
    
    if (rejectForm) {
        rejectForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="ti ti-loader-2 spinning me-1"></i>Processing...';
        });
    }
});

// Add CSS for spinning animation
const style = document.createElement('style');
style.textContent = `
    .spinning {
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);
</script>

@endsection
