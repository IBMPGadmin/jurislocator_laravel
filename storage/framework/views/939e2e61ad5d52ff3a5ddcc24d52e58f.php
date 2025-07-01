<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row gap_top">
        <div class="col-12 mb-4">            <div class="bg_custom p-4 rounded shadow-sm">
                <h4>Client Details</h4>
                <div><strong>Name:</strong> <?php echo e($client->client_name ?? '-'); ?></div>
                <div><strong>Email:</strong> <?php echo e($client->client_email ?? '-'); ?></div>
                <!-- Add more client details as needed -->
            </div>
        </div>
        <form method="GET" action="" id="filterForm" class="gap_top btn-shadow bg_custom p-4 rounded shadow-sm">
            <div class="row g-3 align-items-center">
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Search by Legal Act, Regulation, or Keyword.." value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-lg-4">
                    <select name="law_id" class="form-select">
                        <option value="">Select Law Subject</option>
                        <option value="1" <?php echo e(request('law_id') == '1' ? 'selected' : ''); ?>>Immigration</option>
                        <option value="2" <?php echo e(request('law_id') == '2' ? 'selected' : ''); ?>>Citizenship</option>
                        <option value="3" <?php echo e(request('law_id') == '3' ? 'selected' : ''); ?>>Criminal</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="jurisdiction_id" class="form-select">
                        <option value="">Select Jurisdiction</option>
                        <option value="1" <?php echo e(request('jurisdiction_id') == '1' ? 'selected' : ''); ?>>Federal</option>
                        <optgroup label="Provincial">
                            <option value="2" <?php echo e(request('jurisdiction_id') == '2' ? 'selected' : ''); ?>>Alberta</option>
                            <option value="3" <?php echo e(request('jurisdiction_id') == '3' ? 'selected' : ''); ?>>British Columbia</option>
                            <option value="4" <?php echo e(request('jurisdiction_id') == '4' ? 'selected' : ''); ?>>Manitoba</option>
                            <option value="5" <?php echo e(request('jurisdiction_id') == '5' ? 'selected' : ''); ?>>New Brunswick</option>
                            <option value="6" <?php echo e(request('jurisdiction_id') == '6' ? 'selected' : ''); ?>>Newfoundland & Labarador</option>
                            <option value="7" <?php echo e(request('jurisdiction_id') == '7' ? 'selected' : ''); ?>>Nova Scotia</option>
                            <option value="8" <?php echo e(request('jurisdiction_id') == '8' ? 'selected' : ''); ?>>Ontario</option>
                            <option value="9" <?php echo e(request('jurisdiction_id') == '9' ? 'selected' : ''); ?>>Price Edward Island</option>
                            <option value="10" <?php echo e(request('jurisdiction_id') == '10' ? 'selected' : ''); ?>>Quebec</option>
                            <option value="11" <?php echo e(request('jurisdiction_id') == '11' ? 'selected' : ''); ?>>Saskatchewan</option>
                        </optgroup>
                        <optgroup label="Territorial">
                            <option value="12" <?php echo e(request('jurisdiction_id') == '12' ? 'selected' : ''); ?>>Nortwest Territories</option>
                            <option value="13" <?php echo e(request('jurisdiction_id') == '13' ? 'selected' : ''); ?>>Nunavut</option>
                            <option value="14" <?php echo e(request('jurisdiction_id') == '14' ? 'selected' : ''); ?>>Yukon</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select name="act_id" class="form-select">
                        <option value="">Select Docs Category</option>
                        <option value="1" <?php echo e(request('act_id') == '1' ? 'selected' : ''); ?>>Acts</option>
                        <option value="2" <?php echo e(request('act_id') == '2' ? 'selected' : ''); ?>>Appeal & Review Processes</option>
                        <option value="3" <?php echo e(request('act_id') == '3' ? 'selected' : ''); ?>>CaseLaw</option>
                        <option value="4" <?php echo e(request('act_id') == '4' ? 'selected' : ''); ?>>Codes</option>
                        <option value="5" <?php echo e(request('act_id') == '5' ? 'selected' : ''); ?>>Enforcement</option>
                        <option value="6" <?php echo e(request('act_id') == '6' ? 'selected' : ''); ?>>Forms</option>
                        <option value="7" <?php echo e(request('act_id') == '7' ? 'selected' : ''); ?>>Guidelines</option>
                        <option value="8" <?php echo e(request('act_id') == '8' ? 'selected' : ''); ?>>Agreements</option>
                        <option value="9" <?php echo e(request('act_id') == '9' ? 'selected' : ''); ?>>Ministerial Instructions</option>
                        <option value="10" <?php echo e(request('act_id') == '10' ? 'selected' : ''); ?>>Operational Bulletins</option>
                        <option value="11" <?php echo e(request('act_id') == '11' ? 'selected' : ''); ?>>Policies</option>
                        <option value="12" <?php echo e(request('act_id') == '12' ? 'selected' : ''); ?>>Procedures</option>
                        <option value="13" <?php echo e(request('act_id') == '13' ? 'selected' : ''); ?>>Regulations</option>
                    </select>
                </div>
                <div class="col-lg-12 d-flex submit_reset_format justify-content-end">
                    <div class="button-group">
                        <button type="submit" class="btn btn-custom me-2">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <a href="<?php echo e(route('user.client.legal-tables', $client->id)); ?>" class="btn btn-reset">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>    <div class="row">
        <?php if(isset($message)): ?>
            <div class="col-12 mt-4">
                <div class="alert alert-info"><?php echo e($message); ?></div>
            </div>
        <?php endif; ?>
        <div class="gap_top view-mode-selector col-lg-12 d-flex justify-content-end">
            <button class="btn btn-shadow btn-custom2 btn-outline-primary view-mode-btn me-2 active-view" data-view-mode="grid">
                <i class="fas fa-th-large"></i> Grid View
            </button>
            <button class="btn btn-custom2 btn-outline-primary view-mode-btn" data-view-mode="list">
                <i class="fas fa-list"></i> List View
            </button>
        </div>
        <div class="row gap_top custom-container act-content">
            <div class="act-content grid-view">
                <?php if($results->count()): ?>
                    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        <div class="col-lg-4 col-md-6 act-card btn-shadow" onclick="window.location='<?php echo e(url('view-legal-table/' . $row->table_name . '?category_id=' . $row->id . '&client_id=' . $client->id)); ?>'">
                            <div class="act-card-inner">
                                <i class="fas fa-book act-icon"></i>                                <div class="act-home-title"><?php echo e($row->act_name); ?></div>
                                <div class="act-category">Category: <?php echo e($row->act_id); ?></div>
                                <div class="act-law">Law Subject: <?php echo e($row->law_id); ?></div>
                                <div class="act-jurisdiction">Jurisdiction: <?php echo e($row->jurisdiction_id); ?></div>
                                <div class="act-description">Created: <?php echo e($row->created_at); ?></div>
                                <div class="view-button">View Document <i class="fas fa-arrow-right"></i></div>
                                
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-12 no-results">
                        <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                        <p>No legal acts found matching your search criteria.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="act-content list-view" style="display: none;">
                <?php if($results->count()): ?>
                    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                        <div class="col-lg-12 act-card btn-shadow" onclick="window.location='<?php echo e(url('view-legal-table/' . $row->table_name . '?category_id=' . $row->id . '&client_id=' . $client->id)); ?>'">
                            <div class="act-card-inner">
                                <div class="act-home-title"><?php echo e($row->act_name); ?></div>
                                <div class="act-description">Created: <?php echo e($row->created_at); ?></div>
                                <div class="view-button">View Document <i class="fas fa-arrow-right"></i></div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="col-12 no-results">
                        <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; color: #999;"></i>
                        <p>No legal acts found matching your search criteria.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Toggle between grid and list view
    document.querySelectorAll('.view-mode-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.view-mode-btn').forEach(b => b.classList.remove('active-view'));
            btn.classList.add('active-view');
            if (btn.dataset.viewMode === 'grid') {
                document.querySelector('.grid-view').style.display = '';
                document.querySelector('.list-view').style.display = 'none';
            } else {
                document.querySelector('.grid-view').style.display = 'none';
                document.querySelector('.list-view').style.display = '';
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Ardent\Desktop\j.v1-main\j.v1-main\resources\views/user-legal-tables.blade.php ENDPATH**/ ?>