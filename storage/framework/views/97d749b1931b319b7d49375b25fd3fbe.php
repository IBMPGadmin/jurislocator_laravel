

<?php $__env->startSection('meta'); ?>
    <!-- Current document context meta tags -->
    <meta name="current-document-table" content="<?php echo e($tableName ?? ''); ?>">
    <meta name="current-document-category-id" content="<?php echo e($categoryId ?? ''); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<style>
    .sticky-container {
        position: sticky;
        top: 80px;
        z-index: 100;
    }
    
    /* Ensure main content area doesn't overlap with fixed sidebar */
    .main-content-with-sidebar {
        padding-right: 15px;
    }
    
    @media (min-width: 992px) {
        .main-content-with-sidebar {
            width: 66.66%;
            float: left;
        }
        
        .fixed-sidebar-container {
            width: 33.33%;
            float: right;
            position: relative;
            z-index: 1;
        }
    }
    
    /* Additional styles carried over from view-legal-table-data.blade.php */
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
        border: 2px dashed #ccc;
        padding: 1rem;
        margin-top: 1rem;
        border-radius: 4px;
    }
    
    /* Visual enhancement for dropable areas */
    .nested-droppable.ui-droppable-hover {
        border: 2px dashed #007bff;
        background-color: rgba(0, 123, 255, 0.1);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8 col-md-7 main-content-with-sidebar">
            <?php echo $__env->yieldContent('main-content'); ?>
        </div>
        
        <!-- Right Side Container -->
        <div class="col-lg-4 col-md-5 fixed-sidebar-container">
            <?php echo $__env->make('layouts.right-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<!-- jQuery and jQuery UI -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<!-- TinyMCE -->
<script src="<?php echo e(asset('user_assets/lib/tinymce/js/tinymce/tinymce.min.js')); ?>" onerror="console.error('Failed to load TinyMCE')"></script>

<!-- Custom scripts -->
<script src="<?php echo e(asset('user_assets/js/legal-reference-popups.js')); ?>"></script>
<script src="<?php echo e(asset('user_assets/js/sidebar-persistence.js')); ?>"></script>

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

    // Initialize TinyMCE
    if (typeof tinymce !== 'undefined') {
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
            }
        });
    } else {
        console.error('TinyMCE is not loaded');
    }
});
</script>

<!-- Any additional scripts for the layout -->
<?php echo $__env->yieldPushContent('page-scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views/layouts/with-sidebar-layout.blade.php ENDPATH**/ ?>