

<?php $__env->startSection('meta'); ?>
    <!-- Current document and client context meta tags -->
    <meta name="current-client-id" content="<?php echo e($client->id ?? 0); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <!-- Template Editor Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Template: <?php echo e($templateTitle ?? 'Document Template'); ?></h5>
                    <div>
                        <a href="<?php echo e(route('templates.index', ['client_id' => $client->id ?? 1])); ?>" class="btn btn-light btn-sm me-2">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <button id="save-template" class="btn btn-success btn-sm me-2">
                            <i class="fas fa-save me-1"></i> Save
                        </button>
                        <button id="export-pdf" class="btn btn-warning btn-sm">
                            <i class="fas fa-file-pdf me-1"></i> Export as PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Client Info Summary -->
                    <div class="mb-4 p-3 bg-light rounded">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Client:</strong> <?php echo e($client->client_name ?? 'No client selected'); ?></p>
                                <p class="mb-1"><strong>Email:</strong> <?php echo e($client->client_email ?? 'N/A'); ?></p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <p class="mb-1"><strong>Date:</strong> <?php echo e(now()->format('F d, Y')); ?></p>
                                <p class="mb-1"><strong>Reference:</strong> #<?php echo e($client->id ?? '000'); ?>-<?php echo e(now()->format('Ymd')); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Template Editor -->
                    <form id="template-form" action="<?php echo e(route('templates.save', ['client_id' => $client->id ?? 1, 'template_id' => $templateId ?? 1])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Email Subject" 
                                   value="<?php echo e($subject ?? 'Re: Your Immigration Application - ' . ($client->client_name ?? 'Client')); ?>">
                        </div>
                        
                        <textarea id="template-editor" name="content" class="form-control">
                            <?php echo $templateContent ?? getDefaultTemplateContent($templateId ?? 1, $client->client_name ?? 'Client'); ?>

                        </textarea>
                    </form>
                </div>
            </div>
            
            <!-- Template Placeholders Guide -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-tags me-2"></i> Available Placeholders</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <code>{client_name}</code>
                                    <span class="badge bg-primary">Client's full name</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <code>{client_email}</code>
                                    <span class="badge bg-primary">Client's email address</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <code>{date}</code>
                                    <span class="badge bg-primary">Current date</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <code>{reference}</code>
                                    <span class="badge bg-primary">Reference number</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <code>{user_name}</code>
                                    <span class="badge bg-primary">Your name</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <code>{user_email}</code>
                                    <span class="badge bg-primary">Your email</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="col-lg-4">
            <?php echo $__env->make('layouts.right-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    #template-editor {
        min-height: 400px;
    }
    
    .tox-tinymce {
        border-radius: 0.25rem;
        border-color: #ced4da;
    }
    
    /* Sidebar specific styles from user dashboard */
    .sticky-container {
        position: sticky;
        top: 80px;
        z-index: 100;
    }
    
    .widget_custom {
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    }
    
    .bg_custom {
        background-color: #f8f9fa;
    }
    
    .gap_top {
        margin-top: 1rem;
    }
    
    .nested-droppable {
        min-height: 100px;
    }
    
    .droppable-hover {
        background-color: rgba(40, 167, 69, 0.1);
        border: 2px dashed #28a745;
    }
    
    .draggable-popup {
        cursor: move;
    }
    
    /* Preview styles removed */
    
    .popup-card {
        background-color: white;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 10px;
        overflow: hidden;
    }
    
    .popup-header {
        background-color: #f8f9fa;
        padding: 8px 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e9ecef;
    }
    
    .popup-header h6 {
        margin: 0;
        font-weight: 600;
    }
    
    .btn-close-popup {
        background: none;
        border: none;
        color: #6c757d;
        cursor: pointer;
        font-size: 0.8rem;
        padding: 0;
    }
    
    .btn-close-popup:hover {
        color: #dc3545;
    }
    
    .popup-body {
        padding: 12px;
    }
    
    .client-popup p {
        margin-bottom: 6px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="<?php echo e(asset('user_assets/js/sidebar-persistence.js')); ?>"></script>
<script src="<?php echo e(asset('user_assets/js/legal-reference-popups.js')); ?>"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize TinyMCE editor with client-specific content
    tinymce.init({
        selector: '#template-editor',
        plugins: 'advlist autolink lists link image charmap anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | removeformat | help',
        height: 500,
        setup: function(editor) {
            editor.on('init', function() {
                // Replace any client-specific placeholders
                let content = editor.getContent();
                content = content.replace(/{client_name}/g, "<?php echo e($client->client_name ?? 'Client'); ?>");
                content = content.replace(/{client_email}/g, "<?php echo e($client->client_email ?? 'client@example.com'); ?>");
                content = content.replace(/{reference}/g, "#<?php echo e($client->id ?? '000'); ?>-<?php echo e(now()->format('Ymd')); ?>");
                editor.setContent(content);
            });
        }
    });
    
    // Initialize TinyMCE editor for sidebar notes
    // This code now matches the initialization from the user dashboard
    if (typeof window.initSidebarNotes === 'function') {
        // If the function exists in the imported scripts, use it
        window.initSidebarNotes();
    } else {
        // Fallback initialization similar to user dashboard
        tinymce.init({
            selector: '#tiny-editor',
            menubar: false,
            statusbar: false,
            toolbar: 'undo redo | formatselect | bold italic backcolor | bullist numlist | link | removeformat',
            plugins: 'advlist autolink lists link anchor searchreplace visualblocks code fullscreen insertdatetime table code help wordcount',
            skin: 'oxide',
            height: 300,
            setup: function(editor) {
                editor.on('change', function() {
                    // Auto save logic should be handled by sidebar-persistence.js
                    // This is a fallback
                    console.log('Notes editor change detected');
                });
            }
        });
    }
    
    // Handle Export PDF
    document.getElementById('export-pdf').addEventListener('click', function() {
        const content = tinymce.get('template-editor').getContent();
        const clientInfo = document.querySelector('.bg-light.rounded').innerHTML;
        const subject = document.getElementById('subject').value;
        
        // Create a container for the PDF content
        const pdfContent = document.createElement('div');
        pdfContent.innerHTML = `
            <div style="padding: 20px;">
                <h2 style="margin-bottom: 20px;">${subject}</h2>
                <div style="margin-bottom: 20px;">${clientInfo}</div>
                <div>${content}</div>
                <div style="margin-top: 40px;">
                    <p>Sincerely,</p>
                    <p><?php echo e(Auth::user()->name ?? 'User Name'); ?></p>
                </div>
            </div>
        `;
        
        // Generate PDF
        const options = {
            margin: 1,
            filename: 'template-document.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        
        html2pdf().from(pdfContent).set(options).save();
    });
    
    // Handle Save Template
    document.getElementById('save-template').addEventListener('click', function() {
        // Update hidden text area with TinyMCE content
        const content = tinymce.get('template-editor').getContent();
        document.getElementById('template-form').submit();
    });
    
    // Preview update code removed
    
    // Use the sidebar-persistence.js functionality for handling client-specific popups
    // These event handlers will be mostly overridden by sidebar-persistence.js
    // but we keep basic functionality here for fallback

    // Setup will be handed by sidebar-persistence.js
    // Add any template-specific code here
    
    // Make sure droppable area is initialized (if not already by sidebar-persistence.js)
    $('.nested-droppable').droppable({
        accept: '.draggable-popup',
        hoverClass: 'droppable-hover',
        drop: function(event, ui) {
            console.log('Drop event triggered');
            // This is handled by sidebar-persistence.js
        }
    });
    
    // Initialize drag functionality
    $('.popup-card').draggable({
        revert: 'invalid',
        helper: 'clone',
        start: function(event, ui) {
            $(this).addClass('dragging');
        },
        stop: function(event, ui) {
            $(this).removeClass('dragging');
        }
    });

    // Ensure the client ID is set
    $(document).ready(function() {
        const clientId = <?php echo e($client->id ?? 'null'); ?>;
        if (clientId) {
            console.log(`Template editor loaded for client #${clientId}`);
            // Set client ID to the button if not already set
            const fetchBtn = $('#fetch-pinned-popups');
            if (fetchBtn.attr('data-client-id') === '0') {
                fetchBtn.attr('data-client-id', clientId);
            }
            
            // The fetchPinnedPopups will be called automatically by sidebar-persistence.js
        }
    });
});

// Helper function to replace placeholders with actual values
function replacePlaceholders(content, client) {
    return content
        .replace(/{client_name}/g, client.client_name || 'Client')
        .replace(/{client_email}/g, client.client_email || 'client@example.com')
        .replace(/{date}/g, new Date().toLocaleDateString())
        .replace(/{reference}/g, `#${client.id || '000'}-${new Date().toISOString().slice(0, 10).replace(/-/g, '')}`)
        .replace(/{user_name}/g, '<?php echo e(Auth::user()->name ?? "User Name"); ?>')
        .replace(/{user_email}/g, '<?php echo e(Auth::user()->email ?? "user@example.com"); ?>');
}
</script>
<?php $__env->stopPush(); ?>

<?php
function getDefaultTemplateContent($templateId, $clientName) {
    $templates = [
        1 => "<p>Dear {client_name},</p>
            <p>I am pleased to introduce myself as your assigned representative for your immigration matters. I am committed to providing you with the highest level of service and support throughout your immigration journey.</p>
            <p>In the coming days, I will be reviewing your case details and will schedule an initial consultation to discuss your specific needs and objectives. During this meeting, we will outline a strategic plan tailored to your situation.</p>
            <p>Should you have any immediate questions or concerns, please do not hesitate to contact me directly.</p>
            <p>I look forward to working with you.</p>
            <p>Warm regards,</p>",
        
        2 => "<p>Dear {client_name},</p>
            <p>I am writing to provide you with an update on the status of your immigration application (Reference: {reference}).</p>
            <p>Your application is currently being processed, and we have completed the following steps:</p>
            <ul>
                <li>Initial documentation review</li>
                <li>Submission of preliminary forms</li>
                <li>Payment of government filing fees</li>
            </ul>
            <p>The next steps in your application process are:</p>
            <ol>
                <li>Wait for acknowledgment of receipt (estimated: 2-3 weeks)</li>
                <li>Respond to any requests for additional evidence (if applicable)</li>
                <li>Await biometrics appointment scheduling</li>
            </ol>
            <p>I will continue to monitor your application closely and will inform you of any developments.</p>
            <p>Best regards,</p>",
        
        3 => "<p>Dear {client_name},</p>
            <p>I am pleased to inform you that we have successfully submitted your immigration application on {date}. Your reference number is {reference}.</p>
            <p>The immigration authorities typically take approximately 3-6 months to process applications of this nature. During this time, it is important that you:</p>
            <ul>
                <li>Keep me informed of any changes to your personal circumstances</li>
                <li>Do not travel outside the country without consulting me first</li>
                <li>Check your email regularly, including spam folders, for communications</li>
            </ul>
            <p>Should you have any questions regarding the process, please do not hesitate to reach out.</p>
            <p>Sincerely,</p>"
    ];
    
    return $templates[$templateId] ?? $templates[1];
}
?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/immif732/jurislocator/resources/views/edit-template.blade.php ENDPATH**/ ?>