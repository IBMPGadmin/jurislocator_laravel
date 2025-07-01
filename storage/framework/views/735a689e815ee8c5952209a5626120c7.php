<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="container-fluid">
        <div class="row">
            <!-- Client Details Section -->
            <div class="gap_top col-12 mb-4 p-0">
                <div class="bg_custom p-4 rounded shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="client-avatar me-4 d-flex justify-content-center align-items-center rounded-circle bg-light text-primary" style="width: 60px; height: 60px; font-size: 24px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="client-info flex-grow-1">
                            <h4 class="mb-2" data-en="Client Details" data-fr="Détails du client">Client Details</h4>
                            <div class="d-flex flex-wrap">
                                <div class="me-4 mb-2">
                                    <span class="d-flex align-items-center">
                                        <strong data-en="Name:" data-fr="Nom :">Name:</strong>&nbsp;<?php echo e($client->client_name ?? '-'); ?>

                                    </span>
                                </div>
                                <div class="mb-2">
                                    <span class="d-flex align-items-center">
                                        <i class="fas fa-envelope me-2 text-secondary"></i>
                                        <strong data-en="Email:" data-fr="Courriel :">Email:</strong>&nbsp;<?php echo e($client->client_email ?? '-'); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Template Search Section -->
            <div class="gap_top col-lg-12 mb-4 p-0">
                <div class="btn-shadow bg_custom p-4 rounded shadow-sm">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group mb-4">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input type="text" id="templateSearch" class="form-control" placeholder="Search templates...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Mode Selector -->
            <div class="gap_top view-mode-selector col-lg-12 d-flex justify-content-end">
                <button class="btn btn-shadow btn-custom2 btn-outline-primary view-mode-btn me-2 active-view" data-view-mode="grid">
                    <i class="fas fa-th-large"></i> Grid View
                </button>
                <button class="btn btn-custom2 btn-outline-primary view-mode-btn" data-view-mode="list">
                    <i class="fas fa-list"></i> List View
                </button>
            </div>
            
            <!-- Template Selection Section -->
            <div class="row gap_top custom-container act-content">
                <div class="act-content grid-view">
                    <?php $__currentLoopData = ['Client Introduction Letter', 'Case Status Update Letter', 'Application Submission Letter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="act-card btn-shadow template-item">
                            <div class="act-card-inner">
                                <i class="fas fa-file-word act-icon"></i>
                                <div class="act-home-title"><?php echo e($template); ?></div>
                                <div class="act-category">Template Type: Document</div>
                                <div class="act-description">Template for <?php echo e(strtolower($template)); ?></div>
                                <a href="<?php echo e(route('templates.edit', ['client_id' => isset($client) ? $client->id : 1, 'template_id' => $index + 1])); ?>" 
                                class="view-button">
                                Use This Template <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <div class="act-content list-view" style="display: none;">
                    <?php $__currentLoopData = ['Client Introduction Letter', 'Case Status Update Letter', 'Application Submission Letter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-12 act-card btn-shadow template-item">
                            <div class="act-card-inner d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="act-home-title"><?php echo e($template); ?></div>
                                    <div class="act-description">Template for <?php echo e(strtolower($template)); ?></div>
                                </div>
                                <a href="<?php echo e(route('templates.edit', ['client_id' => isset($client) ? $client->id : 1, 'template_id' => $index + 1])); ?>" 
                                class="view-button">
                                Use This Template <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    /* Client Avatar and Info Styles */
    .client-avatar {
        width: 60px;
        height: 60px;
        background: var(--color-theme-3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .client-info {
        flex-grow: 1;
    }
    
    /* Template Card Styles - Based on Act Card */
    .bg_custom {
        background-color: var(--color-card-bg);
    }
    
    .btn-shadow {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .gap_top {
        margin-top: 1.5rem;
    }
    
    .custom-container {
        --bs-gutter-x: 0;
    }
    
    .act-content.grid-view {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }
    
    .act-content.list-view {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .act-card {
        background-color: var(--color-card-bg) !important;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
        width: 100%;
    }
    
    .act-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
    
    .act-card-inner {
        padding: 1.5rem;
    }
    
    .act-icon {
        font-size: 2rem;
        color: var(--color-theme-3);
        margin-bottom: 1rem;
    }
    
    .act-home-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: var(--color-table-header)
    }
    
    .act-category,
    .act-description {
        color: var(--color-table-header);
        margin-bottom: 0.5rem;
    }
    
    .view-button {
        color: var(--color-theme-3);
        font-weight: bold;
        text-align: right;
        display: block;
        text-decoration: none;
        margin-top: 1rem;
    }
    
    .view-button:hover {
        color: var(--color-theme-4);
        text-decoration: none;
    }
    
    .active-view {
        background-color: var(--color-theme-3) !important;
        color: white !important;
    }
    
    /* View Mode Selector */
    .view-mode-selector {
        margin-bottom: 1rem;
    }
    
    .btn-custom2 {
        border-color: var(--color-theme-3);
        color: var(--color-theme-3);
    }
    
    .btn-custom2:hover {
        background-color: var(--color-theme-3);
        color: white;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .act-content.grid-view {
            grid-template-columns: 1fr;
        }
        
        .view-mode-selector {
            justify-content: center !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Template search functionality
        const searchInput = document.getElementById('templateSearch');
        const templateCards = document.querySelectorAll('.template-item');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            templateCards.forEach(card => {
                const templateTitle = card.querySelector('.act-home-title').textContent.toLowerCase();
                const templateDesc = card.querySelector('.act-description').textContent.toLowerCase();
                
                if (templateTitle.includes(searchTerm) || templateDesc.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        
        // View mode toggle
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
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\New folder (5)\j.v1-main-2\resources\views/templates.blade.php ENDPATH**/ ?>