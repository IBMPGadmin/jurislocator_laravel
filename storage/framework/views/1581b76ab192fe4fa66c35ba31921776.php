

<?php $__env->startSection('meta'); ?>
    <!-- Current document context meta tags (USER-CENTRIC) -->
    <meta name="current-document-table" content="<?php echo e($tableName); ?>">
    <meta name="current-document-category-id" content="<?php echo e($categoryId); ?>">
    <meta name="current-user-id" content="<?php echo e(auth()->id()); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .clickable-heading {
        cursor: pointer;
        color: #007bff;
        transition: color 0.2s;
    }
    .clickable-heading:hover {
        color: #0056b3;
        text-decoration: underline;
    }    
    .ref {
        color: #28a745;
        cursor: pointer;
        font-weight: 600;
        text-decoration: underline;
        transition: all 0.2s;
        padding: 0 2px;
        border-radius: 3px;
        position: relative;
    }
    .ref:hover {
        color: #218838;
        background-color: rgba(40, 167, 69, 0.1);
    }
    .ref:after {
        content: " 🔍";
        font-size: 10px;
        vertical-align: super;
    }
    .personal-research-badge {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1rem;
    }
    /* French-specific styles */
    .french-document {
        direction: ltr;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .french-content {
        line-height: 1.6;
        letter-spacing: 0.3px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Personal Research Header (French) -->
    <div class="personal-research-header">
        <div class="personal-research-badge">
            <i class="fas fa-user"></i>
            Recherche Personnelle - Mode Utilisateur
        </div>
        <h1 class="document-title french-content"><?php echo e($document->title ?? 'Document Juridique'); ?></h1>
        <p class="document-subtitle">Recherche juridique personnelle - Données sauvegardées par ID utilisateur uniquement</p>
    </div>

    <div class="row">
        <!-- Main Document Content (French) -->
        <div class="col-lg-8">
            <div class="document-viewer french-document">
                <div class="document-content french-content">
                    <?php if(isset($document->text_content)): ?>
                        <?php echo $document->text_content; ?>

                    <?php else: ?>
                        <p>Contenu du document non disponible.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Personal Research Sidebar (French) -->
        <div class="col-lg-4">
            <div class="research-sidebar">
                <!-- Personal Notes Section -->
                <div class="notes-section">
                    <h3><i class="fas fa-sticky-note"></i> Mes Notes Personnelles</h3>
                    <div class="text-editor" id="personalTextEditor">
                        <textarea 
                            id="userPersonalNotes" 
                            placeholder="Ajoutez vos notes de recherche personnelles ici..."
                            data-user-id="<?php echo e(auth()->id()); ?>"
                            data-table-name="<?php echo e($tableName); ?>"
                            data-category-id="<?php echo e($categoryId); ?>"><?php echo e($userTextData->text_content ?? ''); ?></textarea>
                    </div>
                    <button class="btn btn-success btn-sm save-personal-notes">
                        <i class="fas fa-save"></i> Sauvegarder les Notes
                    </button>
                </div>

                <!-- Personal Popups Section -->
                <div class="popups-section">
                    <h3><i class="fas fa-bookmark"></i> Mes Signets Personnels</h3>
                    <div class="popup-drop-area" id="personalPopupArea">
                        <p>Glissez et déposez les références ici pour créer des signets personnels</p>
                        <div class="personal-popups-list" id="personalPopupsList">
                            <?php if($userPopupData && $userPopupData->popup_data): ?>
                                <?php $__currentLoopData = $userPopupData->popup_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="personal-popup-item">
                                        <strong><?php echo e($popup['title'] ?? 'Signet'); ?></strong>
                                        <p><?php echo e($popup['content'] ?? ''); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm save-personal-popups">
                        <i class="fas fa-bookmark"></i> Sauvegarder les Signets
                    </button>
                </div>

                <!-- Document Info (French) -->
                <div class="document-info">
                    <h4>Informations du Document</h4>
                    <ul>
                        <li><strong>Table:</strong> <?php echo e($tableName); ?></li>
                        <li><strong>Catégorie ID:</strong> <?php echo e($categoryId); ?></li>
                        <li><strong>Utilisateur:</strong> <?php echo e(auth()->user()->name); ?></li>
                        <li><strong>Mode:</strong> Recherche Personnelle</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
// Personal research JavaScript (French version)
document.addEventListener('DOMContentLoaded', function() {
    const userId = <?php echo e(auth()->id()); ?>;
    const tableName = '<?php echo e($tableName); ?>';
    const categoryId = '<?php echo e($categoryId); ?>';

    // Save personal notes
    document.querySelector('.save-personal-notes').addEventListener('click', function() {
        const notes = document.getElementById('userPersonalNotes').value;
        
        fetch('/user/annotations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                table_name: tableName,
                category_id: categoryId,
                section: 'personal_notes',
                text: notes
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Notes personnelles sauvegardées avec succès!', 'success');
            } else {
                showNotification('Erreur lors de la sauvegarde des notes', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Erreur lors de la sauvegarde', 'error');
        });
    });

    // Save personal popups/bookmarks
    document.querySelector('.save-personal-popups').addEventListener('click', function() {
        const popups = getPersonalPopups();
        
        fetch('/user/popups/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                table_name: tableName,
                category_id: categoryId,
                popups: popups
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Signets personnels sauvegardés avec succès!', 'success');
            } else {
                showNotification('Erreur lors de la sauvegarde des signets', 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Erreur lors de la sauvegarde', 'error');
        });
    });

    function getPersonalPopups() {
        const popupItems = document.querySelectorAll('.personal-popup-item');
        const popups = [];
        
        popupItems.forEach(item => {
            const title = item.querySelector('strong').textContent;
            const content = item.querySelector('p').textContent;
            popups.push({ title, content });
        });
        
        return popups;
    }

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} notification`;
        notification.textContent = message;
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '9999';
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.with-sidebar-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\juris_1.0\resources\views/view-legal-table-data-personal-french.blade.php ENDPATH**/ ?>