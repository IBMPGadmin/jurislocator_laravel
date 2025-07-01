<?php $__env->startSection('admin-content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Legal Key Terms</h5>
                    <div>
                        <a href="<?php echo e(route('admin.legal-key-terms.index')); ?>?export=csv" class="btn btn-secondary me-2">Export to CSV</a>
                        <a href="<?php echo e(route('admin.legal-key-terms.create')); ?>" class="btn btn-custom">Add New Term</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Search Form -->
                    <div class="mb-4">
                        <form action="<?php echo e(route('admin.legal-key-terms.index')); ?>" method="GET" class="row g-3" id="searchForm">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search terms..." name="search" value="<?php echo e(request('search')); ?>" id="searchInput">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="ti ti-search"></i> Search
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select name="language" class="form-select" id="languageFilter">
                                    <option value="">All Languages</option>
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($code); ?>" <?php echo e(request('language') == $code ? 'selected' : ''); ?>><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="category" class="form-select" id="categoryFilter">
                                    <option value="">All Categories</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category); ?>" <?php echo e(request('category') == $category ? 'selected' : ''); ?>><?php echo e($category); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-select" id="statusFilter">
                                    <option value="">All Status</option>
                                    <option value="active" <?php echo e(request('status') === 'active' ? 'selected' : ''); ?>>Active</option>
                                    <option value="inactive" <?php echo e(request('status') === 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="ti ti-filter"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Terms Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Term</th>
                                    <th>Definition</th>
                                    <th>Language</th>
                                    <th>Category</th>
                                    <th>Source</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($term->term); ?></td>
                                        <td><?php echo e(Str::limit($term->definition, 100)); ?></td>
                                        <td><?php echo e($languages[$term->language] ?? $term->language); ?></td>
                                        <td><?php echo e($term->category); ?></td>
                                        <td><?php echo e($term->source); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo e($term->status == 'active' ? 'success' : 'secondary'); ?>">
                                                <?php echo e(ucfirst($term->status)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?php echo e(route('admin.legal-key-terms.edit', $term->id)); ?>" class="btn btn-sm btn-primary">Edit</a>
                                            <form action="<?php echo e(route('admin.legal-key-terms.destroy', $term->id)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this term?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No terms found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
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

<?php $__env->startPush('scripts'); ?>
<script>
    // Auto-submit form when filters change
    document.querySelectorAll('#languageFilter, #categoryFilter, #statusFilter').forEach(function(element) {
        element.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ardent\Desktop\j.v1-main\j.v1-main\resources\views/legal-key-terms/index.blade.php ENDPATH**/ ?>