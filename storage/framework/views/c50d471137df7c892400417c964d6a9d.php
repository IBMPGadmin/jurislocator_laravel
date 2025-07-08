

<?php $__env->startSection('content'); ?>
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo e(route('user.government-links')); ?>" data-en="Government Links" data-fr="Liens Gouvernementaux">Government Links</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo e($category); ?></li>
                </ol>
            </nav>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><?php echo e($category); ?> <span data-en="Links" data-fr="Liens">Links</span></h2>
                <a href="<?php echo e(route('user.government-links')); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> <span data-en="Back to Categories" data-fr="Retour aux Catégories">Back to Categories</span>
                </a>
            </div>
            
            <?php if($links->isEmpty()): ?>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <span data-en="No links available for this category at the moment." data-fr="Aucun lien disponible pour cette catégorie pour le moment.">No links available for this category at the moment.</span>
                </div>
            <?php else: ?>
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
                                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="fw-semibold"><?php echo e($link->name); ?></td>
                                            <td>
                                                <?php if($link->description): ?>
                                                    <?php echo e($link->description); ?>

                                                <?php else: ?>
                                                    <span class="text-muted" data-en="No description" data-fr="Aucune description">No description</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo e($link->url); ?>" class="btn btn-sm btn-primary" target="_blank">
                                                    <i class="bi bi-box-arrow-up-right me-1"></i> <span data-en="Visit" data-fr="Visiter">Visit</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\user\government-links\category.blade.php ENDPATH**/ ?>