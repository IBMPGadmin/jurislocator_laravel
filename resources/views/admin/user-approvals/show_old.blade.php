@php
    use Illuminate\Support\Facades\Storage;
@endphp

<style>
    /* Professional Modal Styles */
    .modal-content {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        color: #1f2937;
        box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    }

    .modal-header {
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
        border-radius: 12px 12px 0 0;
    }

    .modal-title {
        color: #1f2937;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .section-title {
        color: #374151;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .info-table {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }

    .info-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .info-table td:first-child {
        background: #f9fafb;
        color: #374151;
        font-weight: 600;
        font-size: 0.875rem;
        width: 35%;
    }

    .info-table td:last-child {
        color: #1f2937;
        font-weight: 500;
    }

    .info-table tr:last-child td {
        border-bottom: none;
    }

    .professional-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        background: #dbeafe;
        color: #1d4ed8;
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: 1px solid #bfdbfe;
    }

    .professional-badge.status-pending {
        background: #fef3c7;
        color: #d97706;
        border-color: #fde68a;
    }

    .professional-badge.status-approved {
        background: #dcfce7;
        color: #059669;
        border-color: #bbf7d0;
    }

    .professional-badge.status-rejected {
        background: #fee2e2;
        color: #dc2626;
        border-color: #fecaca;
    }

    .professional-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    }

    .professional-card-header {
        background: #f9fafb;
        color: #374151;
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        border-radius: 8px 8px 0 0;
    }

    .professional-card-title {
        color: #1f2937;
        font-weight: 600;
        margin: 0;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .professional-card-body {
        padding: 1.5rem;
    }

    .text-primary-professional {
        color: #2563eb !important;
        font-weight: 600;
    }

    .text-value-professional {
        color: #1f2937;
        font-weight: 500;
        font-size: 1rem;
    }

    .image-container-professional {
        position: relative;
        display: inline-block;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }

    .image-professional {
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .image-professional:hover {
        transform: scale(1.02);
    }

    .image-overlay-professional {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
    }

    .btn-professional {
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        color: #374151;
        font-weight: 500;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        transition: all 0.15s ease-in-out;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-professional:hover {
        background: #f9fafb;
        border-color: #9ca3af;
        color: #374151;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }

    .btn-professional.btn-primary-professional {
        background: #2563eb;
        border-color: #2563eb;
        color: #ffffff;
    }

    .btn-professional.btn-primary-professional:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
        color: #ffffff;
    }

    .btn-professional.btn-secondary-professional {
        background: #6b7280;
        border-color: #6b7280;
        color: #ffffff;
    }

    .btn-professional.btn-secondary-professional:hover {
        background: #4b5563;
        border-color: #4b5563;
        color: #ffffff;
    }

    .btn-professional.btn-success-professional {
        background: #059669;
        border-color: #059669;
        color: #ffffff;
    }

    .btn-professional.btn-success-professional:hover {
        background: #047857;
        border-color: #047857;
        color: #ffffff;
    }

    .btn-professional.btn-danger-professional {
        background: #dc2626;
        border-color: #dc2626;
        color: #ffffff;
    }

    .btn-professional.btn-danger-professional:hover {
        background: #b91c1c;
        border-color: #b91c1c;
        color: #ffffff;
    }

    .alert-professional {
        background: #fef3c7;
        border: 1px solid #fde68a;
        border-radius: 6px;
        color: #92400e;
        padding: 0.75rem;
    }

    .file-display-professional {
        background: #f9fafb;
        border: 2px dashed #d1d5db;
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        color: #6b7280;
    }

    .actions-section-professional {
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
        padding: 1.5rem;
        text-align: center;
        border-radius: 0 0 12px 12px;
    }

    .actions-title-professional {
        color: #374151;
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .info-text-professional {
        color: #6b7280;
        font-size: 0.875rem;
        margin-top: 0.75rem;
    }

    .btn-lg.btn-professional {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        margin: 0.25rem;
    }

    .btn-close {
        filter: none;
    }

    .file-info-professional {
        color: #6b7280;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .professional-card-body {
            padding: 1rem;
        }
        
        .btn-lg.btn-professional {
            padding: 0.625rem 1.25rem;
            font-size: 0.925rem;
        }
    }
</style>

<div class="row">
    <div class="col-md-6">
        <h6 class="section-title">
            <i class="ti ti-user-circle"></i>Personal Information
        </h6>
        <table class="table info-table">
            <tr>
                <td>Full Name</td>
                <td class="text-value-professional">{{ $user->first_name }} {{ $user->last_name }}</td>
            </tr>
            <tr>
                <td>Email Address</td>
                <td class="text-value-professional">{{ $user->email }}</td>
            </tr>
            <tr>
                <td>User Type</td>
                <td>
                    <span class="professional-badge">
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
                            <i class="ti ti-user"></i>{{ ucfirst(str_replace('_', ' ', $user->user_type)) }}
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>Registration Date</td>
                <td class="text-value-professional">{{ $user->created_at->format('F d, Y \a\t g:i A') }}</td>
            </tr>
            <tr>
                <td>Current Status</td>
                <td>
                    @if($user->approval_status === 'pending')
                        <span class="professional-badge status-pending">
                            <i class="ti ti-clock"></i>Pending Approval
                        </span>
                    @elseif($user->approval_status === 'approved')
                        <span class="professional-badge status-approved">
                            <i class="ti ti-check"></i>Approved
                        </span>
                    @else
                        <span class="professional-badge status-rejected">
                            <i class="ti ti-x"></i>Rejected
                        </span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    
    <div class="col-md-6">
        <h6 class="section-title">
            <i class="ti ti-info-circle"></i>Additional Information
        </h6>
        
        @if(in_array($user->user_type, ['licensed_practitioner', 'immigration_lawyer', 'notaire_quebec']))
            <div class="professional-card">
                <div class="professional-card-header">
                    <h6 class="professional-card-title">
                        <i class="ti ti-certificate"></i>
                        Professional License
                    </h6>
                </div>
                <div class="professional-card-body">
                    <p class="mb-1">
                        <strong>License Number:</strong>
                    </p>
                    <p class="text-value-professional">
                        {{ $user->license_number ?: 'Not provided' }}
                    </p>
                </div>
            </div>
        @elseif($user->user_type === 'company')
            <div class="professional-card">
                <div class="professional-card-header">
                    <h6 class="professional-card-title">
                        <i class="ti ti-building"></i>
                        Company Information
                    </h6>
                </div>
                <div class="professional-card-body">
                    <p class="mb-1">
                        <strong>Company Name:</strong>
                    </p>
                    <p class="text-value-professional">
                        {{ $user->company_name ?: 'Not provided' }}
                    </p>
                </div>
            </div>
        @elseif(in_array($user->user_type, ['student_queens', 'student_montreal']))
            <div class="professional-card">
                <div class="professional-card-header">
                    <h6 class="professional-card-title text-primary-professional">
                        <i class="ti ti-graduation-cap"></i>
                        Student Information
                    </h6>
                </div>
                <div class="professional-card-body">
                    <div class="mb-3">
                        <strong>University:</strong><br>
                        <span class="professional-badge">
                            @if($user->user_type === 'student_queens')
                                <i class="ti ti-school"></i>Queens University
                            @else
                                <i class="ti ti-school"></i>Université de Montréal
                            @endif
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong>Student ID Number:</strong><br>
                        <span class="text-value-professional">{{ $user->student_id_number ?: 'Not provided' }}</span>
                    </div>
                    <div class="mb-2">
                        <strong>Student ID Photo:</strong><br>
                        @if($user->student_id_file)
                            @php
                                $fileExtension = strtolower(pathinfo($user->student_id_file, PATHINFO_EXTENSION));
                                $imagePath = Storage::url($user->student_id_file);
                                $fullPath = asset('storage/' . $user->student_id_file);
                            @endphp
                            
                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <div class="mt-2">
                                    <div class="image-container-professional">
                                        <img src="{{ $fullPath }}" 
                                             alt="Student ID Photo" 
                                             class="img-fluid image-professional"
                                             style="max-width: 100%; height: auto; max-height: 250px;"
                                             onclick="openImageModal(this.src)"
                                             onerror="handleImageError(this)">
                                        <div class="image-overlay-professional">
                                            <button class="btn-professional btn-primary-professional btn-sm" onclick="openImageModal('{{ $fullPath }}')">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="ti ti-info-circle me-1"></i>
                                            Click image to view full size
                                        </small>
                                    </div>
                                </div>
                            @else
                                <div class="mt-2">
                                    <div class="file-display-professional">
                                        <i class="ti ti-file-text fa-2x mb-2"></i>
                                        <br>
                                        <small class="d-block mb-2">{{ strtoupper($fileExtension) }} Document</small>
                                        <a href="{{ $fullPath }}" 
                                           target="_blank" 
                                           class="btn-professional btn-primary-professional">
                                            <i class="ti ti-eye"></i>
                                            View Document
                                        </a>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="d-flex align-items-center mt-2 flex-wrap gap-2">
                                <a href="{{ $fullPath }}" target="_blank" class="btn-professional btn-primary-professional">
                                    <i class="ti ti-external-link"></i>
                                    Open in New Tab
                                </a>
                                <a href="{{ $fullPath }}" download class="btn-professional btn-secondary-professional">
                                    <i class="ti ti-download"></i>
                                    Download
                                </a>
                                <button class="btn-professional" onclick="copyImageUrl('{{ $fullPath }}')">
                                    <i class="ti ti-copy"></i>
                                    Copy URL
                                </button>
                            </div>
                            <small class="file-info-professional d-block mt-1">
                                <i class="ti ti-file me-1"></i>
                                File: {{ basename($user->student_id_file) }}
                            </small>
                        @else
                            <div class="alert-professional mt-2">
                                <i class="ti ti-photo-off me-1"></i>
                                <small>No student ID photo uploaded</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        
        @if($user->approval_status === 'approved' && $user->approver)
            <div class="card bg-success bg-opacity-10 mt-3">
                <div class="card-body">
                    <h6 class="card-title text-success">
                        <i class="fas fa-check-circle me-2"></i>
                        Approval Information
                    </h6>
                    <p class="card-text">
                        <strong>Approved by:</strong> {{ $user->approver->name }}<br>
                        <strong>Approved on:</strong> {{ $user->approved_at->format('F d, Y \a\t g:i A') }}
                    </p>
                </div>
            </div>
        @elseif($user->approval_status === 'rejected' && $user->approver)
            <div class="card bg-danger bg-opacity-10 mt-3">
                <div class="card-body">
                    <h6 class="card-title text-danger">
                        <i class="fas fa-times-circle me-2"></i>
                        Rejection Information
                    </h6>
                    <p class="card-text">
                        <strong>Rejected by:</strong> {{ $user->approver->name }}<br>
                        <strong>Rejected on:</strong> {{ $user->approved_at->format('F d, Y \a\t g:i A') }}
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>

@if($user->approval_status === 'pending')
    <hr>
    <div class="text-center">
        <h6 class="text-muted mb-3">
            <i class="ti ti-bolt me-2"></i>Quick Actions
        </h6>
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <button type="button" class="btn btn-success btn-lg me-md-2" 
                    onclick="parent.approveUserFromModal({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')">
                <i class="ti ti-check me-2"></i>
                Approve User
            </button>
            <button type="button" class="btn btn-danger btn-lg" 
                    onclick="parent.rejectUserFromModal({{ $user->id }}, '{{ $user->first_name }} {{ $user->last_name }}')">
                <i class="ti ti-x me-2"></i>
                Reject User
            </button>
        </div>
        <p class="text-muted mt-2 small">
            <i class="ti ti-info-circle me-1"></i>
            These actions will close this popup and open the confirmation dialog.
        </p>
    </div>
@endif

<!-- Image Modal for Full Size View -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="ti ti-photo me-2"></i>Student ID Photo
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Student ID Photo" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a id="modalDownloadLink" href="" download class="btn btn-primary">
                    <i class="ti ti-download me-1"></i>Download
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalDownloadLink').href = imageSrc;
    modal.show();
}

function handleImageError(img) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'alert alert-warning text-center p-4';
    errorDiv.innerHTML = `
        <i class="ti ti-photo-off fa-2x mb-2 d-block"></i>
        <strong>Image Not Found</strong>
        <p class="mb-2">The student ID photo could not be loaded.</p>
        <small class="text-muted">The file may have been moved, deleted, or there might be a permission issue.</small>
    `;
    img.parentNode.replaceChild(errorDiv, img);
}

function copyImageUrl(url) {
    navigator.clipboard.writeText(url).then(function() {
        // Show success message
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="ti ti-check me-1"></i>Copied!';
        btn.classList.remove('btn-outline-info');
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-info');
        }, 2000);
    }).catch(function() {
        alert('Failed to copy URL to clipboard');
    });
}
</script>
