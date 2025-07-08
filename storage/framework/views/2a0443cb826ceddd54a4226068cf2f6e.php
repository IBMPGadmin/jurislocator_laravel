

<?php $__env->startSection('content'); ?>
<div class="container mt-4 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0" data-en="Government Links" data-fr="Liens Gouvernementaux">Government Links</h2>
            </div>
            
            <div class="alert alert-info">
                <i class="bi bi-info-circle-fill me-2"></i>
                <span data-en="Click on any category below to view the relevant government links." data-fr="Cliquez sur n'importe quelle catégorie ci-dessous pour voir les liens gouvernementaux pertinents.">Click on any category below to view the relevant government links.</span>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <a href="<?php echo e(route('user.government-links.category', $category)); ?>" class="text-decoration-none">
                            <div class="card h-100 category-card">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title"><?php echo e($category); ?></h5>
                                        <p class="card-text text-muted">
                                            <small>
                                                <span class="link-count"><?php echo e($categoryCounts[$category]); ?></span> 
                                                <span class="link-text" data-en="<?php echo e($categoryCounts[$category] == 1 ? 'link' : 'links'); ?>" data-fr="<?php echo e($categoryCounts[$category] == 1 ? 'lien' : 'liens'); ?>"><?php echo e(Str::plural('link', $categoryCounts[$category])); ?></span>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="text-end">
                                        <i class="bi bi-arrow-right-circle fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
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
        
        // Update plural link text based on counts
        document.querySelectorAll('.link-text').forEach(function(element) {
            var count = parseInt(element.parentElement.querySelector('.link-count').textContent);
            var translation;
            if (language === 'en') {
                translation = count === 1 ? 'link' : 'links';
            } else {
                translation = count === 1 ? 'lien' : 'liens';
            }
            element.textContent = translation;
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
    .category-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #e0e0e0;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        border-color: #007bff;
    }
    
    .category-card .card-title {
        color: #333;
        font-weight: 600;
    }
    
    .category-card:hover .card-title {
        color: #007bff;
    }
    
    .category-card:hover .bi-arrow-right-circle {
        color: #007bff;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\user\government-links\index.blade.php ENDPATH**/ ?>