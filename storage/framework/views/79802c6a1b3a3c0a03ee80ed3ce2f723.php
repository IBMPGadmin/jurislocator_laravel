<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 data-en="Legal Key Terms" data-fr="Termes Juridiques Clés">Legal Key Terms</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <div class="mb-4">
                        <form action="<?php echo e(route('user.legal-key-terms.index')); ?>" method="GET" class="row g-3" id="searchForm">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search terms..." name="search" value="<?php echo e(request('search')); ?>" id="searchInput" data-placeholder-en="Search terms..." data-placeholder-fr="Rechercher des termes...">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i> <span data-en="Search" data-fr="Rechercher">Search</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select name="category" class="form-select" id="categoryFilter" onchange="this.form.submit()">
                                    <option value="" data-en="All Categories" data-fr="Toutes les catégories">All Categories</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category); ?>" <?php echo e(request('category') == $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="language" class="form-select" id="languageFilter" onchange="this.form.submit()">
                                    <option value="" data-en="All Languages" data-fr="Toutes les langues">All Languages</option>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($code); ?>" <?php echo e(request('language') == $code ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </form>
                    </div>

                    <!-- Terms Cards -->
                    <div class="row">
                        <?php $__empty_1 = true; $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card border h-100">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="card-title mb-0"><?php echo e($term->term); ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text"><?php echo e($term->definition); ?></p>
                                        
                                        <div class="mt-3">
                                            <?php if($term->category): ?>
                                                <div class="mb-2">
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-folder me-1"></i> <?php echo e($term->category); ?>

                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if($term->source): ?>
                                                <div class="text-muted">
                                                    <small><i class="fas fa-book me-1"></i> <span data-en="Source:" data-fr="Source :">Source:</span> <?php echo e($term->source); ?></small>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <span data-en="No terms found." data-fr="Aucun terme trouvé.">No terms found.</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($terms->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/immif732/jurislocator/resources/views/user/legal-key-terms/index.blade.php ENDPATH**/ ?>