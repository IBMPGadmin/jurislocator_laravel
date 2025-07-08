

<?php
// Helper mappings for converting IDs to names
$jurisdictions = [
    1 => 'Federal',
    2 => 'Alberta',
    3 => 'British Columbia',
    4 => 'Manitoba',
    5 => 'New Brunswick',
    6 => 'Newfoundland & Labrador',
    7 => 'Nova Scotia',
    8 => 'Ontario',
    9 => 'Prince Edward Island',
    10 => 'Quebec',
    11 => 'Saskatchewan',
    12 => 'Northwest Territories',
    13 => 'Nunavut',
    14 => 'Yukon'
];

$lawSubjects = [
    1 => 'Immigration',
    2 => 'Citizenship',
    3 => 'Criminal'
];

$acts = [
    1 => 'Acts',
    2 => 'Appeal & Review Processes',
    3 => 'CaseLaw',
    4 => 'Codes',
    5 => 'Enforcement',
    6 => 'Forms',
    7 => 'Guidelines',
    8 => 'Agreements',
    9 => 'Ministerial Instructions',
    10 => 'Operational Bulletins',
    11 => 'Policies',
    12 => 'Procedures',
    13 => 'Regulations'
];

$languages = [
    1 => 'English',
    2 => 'French',
    3 => 'Bilingual'
];
?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row gap_top">
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
                        <button type="button" class="btn btn-reset" onclick="window.location.href='<?php echo e(url()->current()); ?>'">
                            <i class="fas fa-undo"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <h2 class="gap_top">Client: <?php echo e($client->client_name ?? 'N/A'); ?></h2>
    <h3>Legal Tables</h3>
    <div class="row">
        <?php if($legalTables->isEmpty()): ?>
            <div class="col-12">
                <div class="alert alert-warning text-center mt-4">
                    <i class="fas fa-search"></i> No search results found.
                </div>
            </div>
        <?php else: ?>
            <?php $__currentLoopData = $legalTables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 act-card btn-shadow" onclick="redirectToDocument('<?php echo e($table->table_name); ?>', '<?php echo e($table->id); ?>', '<?php echo e($client->id ?? request('client_id')); ?>', '<?php echo e($table->language_id ?? $table->language ?? ''); ?>')">
                    <div class="act-card-inner">
                        <i class="fas fa-book act-icon"></i>
                        <div class="act-home-title"><?php echo e($table->act_name); ?></div>
                        <div class="act-category">Category: <?php echo e($acts[$table->act_id] ?? $table->act_id); ?></div>
                        <div class="act-law">Law Subject: <?php echo e($lawSubjects[$table->law_id] ?? $table->law_id); ?></div>
                        <div class="act-jurisdiction">Jurisdiction: <?php echo e($jurisdictions[$table->jurisdiction_id] ?? $table->jurisdiction_id); ?></div>
                        <?php if(isset($table->language_id) || isset($table->language)): ?>
                        <div class="act-language" style="color: red;">Language: 
                            <?php
                                $languageDisplay = '';
                                $languageId = $table->language_id ?? null;
                                $language = $table->language ?? null;
                                
                                if ($languageId) {
                                    $languageDisplay = $languages[$languageId] ?? $languageId;
                                } elseif ($language == 'en') {
                                    $languageDisplay = 'English';
                                } elseif ($language == 'fr') {
                                    $languageDisplay = 'French';
                                } elseif ($language == 'Both') {
                                    $languageDisplay = 'Bilingual';
                                } else {
                                    $languageDisplay = $language ?? 'N/A';
                                }
                            ?>
                            <?php echo e($languageDisplay); ?>

                        </div>
                        <?php endif; ?>
                        <div class="act-description">Created: <?php echo e($table->created_at); ?></div>
                        <div class="view-button">View Document <i class="fas fa-arrow-right"></i></div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Function to redirect to appropriate document view based on language
    function redirectToDocument(tableName, categoryId, clientId, language) {
        // Check if it's a French document
        const isFrench = (language === '2' || language === 'fr' || language === 'French');
        
        if (isFrench) {
            // Redirect to French view
            window.location = `/view-legal-table-french/${tableName}?category_id=${categoryId}&client_id=${clientId}`;
        } else {
            // Redirect to normal view
            window.location = `/view-legal-table/${tableName}?category_id=${categoryId}&client_id=${clientId}`;
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\client-legal-tables.blade.php ENDPATH**/ ?>