<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <!-- Hero Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="hero-card">
                <div class="hero-content">
                    <div class="hero-icon">
                        <i class="bi bi-credit-card-2-back"></i>
                    </div>
                    <h1 class="hero-title" data-en="Subscription Management" data-fr="Gestion de l'abonnement">Subscription Management</h1>
                    <p class="hero-subtitle" data-en="Manage your subscription plans and payment details" data-fr="Gérez vos plans d'abonnement et vos détails de paiement">Manage your subscription plans and payment details</p>
                </div>
                <div class="hero-decoration">
                    <div class="decoration-circle"></div>
                    <div class="decoration-circle"></div>
                    <div class="decoration-circle"></div>
                </div>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show modern-alert" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Current Subscription Status -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-header">
                <h2 class="section-title" data-en="Current Subscription Status" data-fr="Statut actuel de l'abonnement">Current Subscription Status</h2>
                <div class="section-line"></div>
            </div>
            
            <?php
                $activeSubscription = $subscriptions->where('status', 'active')->first() 
                    ?? $subscriptions->where('status', 'trial')
                        ->where('trial_ends_at', '>', now())
                        ->first();
            ?>

            <?php if($activeSubscription): ?>
                <div class="subscription-card active-subscription">
                    <div class="subscription-header">
                        <div class="subscription-icon">
                            <?php if($activeSubscription->status === 'trial'): ?>
                                <i class="bi bi-clock-history"></i>
                            <?php else: ?>
                                <i class="bi bi-shield-check"></i>
                            <?php endif; ?>
                        </div>
                        <div class="subscription-info">
                            <h3 class="subscription-title"><?php echo e($activeSubscription->package->name); ?></h3>
                            <div class="subscription-badges">
                                <?php if($activeSubscription->status === 'trial'): ?>
                                    <span class="status-badge trial" data-en="Trial" data-fr="Essai">Trial</span>
                                <?php else: ?>
                                    <span class="status-badge active" data-en="Active" data-fr="Actif">Active</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="subscription-details">
                        <?php if($activeSubscription->status === 'trial'): ?>
                            <div class="detail-item">
                                <i class="bi bi-calendar-range"></i>
                                <div>
                                    <span class="detail-label" data-en="Trial Period" data-fr="Période d'essai">Trial Period</span>
                                    <span class="detail-value"><?php echo e($activeSubscription->trial_starts_at->format('M d, Y')); ?> - <?php echo e($activeSubscription->trial_ends_at->format('M d, Y')); ?></span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-hourglass-split"></i>
                                <div>
                                    <span class="detail-label" data-en="Days Remaining" data-fr="Jours restants">Days Remaining</span>
                                    <span class="detail-value highlight"><?php echo e(now()->diffInDays($activeSubscription->trial_ends_at, false)); ?> <span data-en="days" data-fr="jours">days</span></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="detail-item">
                                <i class="bi bi-infinity"></i>
                                <div>
                                    <span class="detail-label" data-en="Access Type" data-fr="Type d'accès">Access Type</span>
                                    <span class="detail-value" data-en="Lifetime Access" data-fr="Accès à vie">Lifetime Access</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-calendar-check"></i>
                                <div>
                                    <span class="detail-label" data-en="Purchase Date" data-fr="Date d'achat">Purchase Date</span>
                                    <span class="detail-value"><?php echo e($activeSubscription->created_at->format('M d, Y')); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if($activeSubscription->status === 'active'): ?>
                        <div class="subscription-actions">
                            <form action="<?php echo e(route('payment.subscription.cancel', $activeSubscription->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to cancel your subscription? This action cannot be undone.');">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-danger btn-modern">
                                    <i class="bi bi-x-circle me-2"></i>
                                    <span data-en="Cancel Subscription" data-fr="Annuler l'abonnement">Cancel Subscription</span>
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="no-subscription-card">
                    <div class="no-subscription-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="no-subscription-content">
                        <h3 data-en="No Active Subscription" data-fr="Aucun abonnement actif">No Active Subscription</h3>
                        <p class="text-muted">
                            <span data-en="You don't have an active subscription." data-fr="Vous n'avez pas d'abonnement actif.">You don't have an active subscription.</span>
                            <span data-en="to access all features." data-fr="pour accéder à toutes les fonctionnalités.">to access all features.</span>
                        </p>
                        <a href="<?php echo e(route('subscription.pricing')); ?>" class="btn btn-primary btn-modern">
                            <i class="bi bi-plus-circle me-2"></i>
                            <span data-en="Purchase a subscription" data-fr="Acheter un abonnement">Purchase a subscription</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Available Packages Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-header">
                <h2 class="section-title" data-en="Available Packages" data-fr="Forfaits disponibles">Available Packages</h2>
                <div class="section-line"></div>
            </div>
            
            <?php if($activeSubscription && $activeSubscription->status === 'trial'): ?>
            <div class="info-banner trial">
                <i class="bi bi-info-circle"></i>
                <span data-en="Your trial will expire soon. Purchase a subscription to continue accessing all features." data-fr="Votre essai expirera bientôt. Achetez un abonnement pour continuer à accéder à toutes les fonctionnalités.">Your trial will expire soon. Purchase a subscription to continue accessing all features.</span>
            </div>
            <?php elseif($activeSubscription && $activeSubscription->status === 'active'): ?>
            <div class="info-banner active">
                <i class="bi bi-info-circle"></i>
                <span data-en="You already have an active subscription, but you can purchase an additional package if needed." data-fr="Vous avez déjà un abonnement actif, mais vous pouvez acheter un forfait supplémentaire si nécessaire.">You already have an active subscription, but you can purchase an additional package if needed.</span>
            </div>
            <?php else: ?>
            <div class="info-banner warning">
                <i class="bi bi-exclamation-triangle"></i>
                <span data-en="You don't have an active subscription. Purchase a subscription to access all features." data-fr="Vous n'avez pas d'abonnement actif. Achetez un abonnement pour accéder à toutes les fonctionnalités.">You don't have an active subscription. Purchase a subscription to access all features.</span>
            </div>
            <?php endif; ?>
            
            <div class="row g-4 mt-3">
                <?php $__currentLoopData = $availablePackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6">
                    <div class="package-card <?php if($loop->index === 1): ?> featured <?php endif; ?>">
                        <?php if($loop->index === 1): ?>
                            <div class="featured-badge">
                                <span data-en="Most Popular" data-fr="Le plus populaire">Most Popular</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="package-header">
                            <div class="package-icon">
                                <i class="bi bi-gem"></i>
                            </div>
                            <h3 class="package-title"><?php echo e($package->name); ?></h3>
                            <div class="package-price">
                                <span class="currency">$</span>
                                <span class="amount"><?php echo e(number_format($package->price, 0)); ?></span>
                                <span class="period">/lifetime</span>
                            </div>
                        </div>
                        
                        <div class="package-description">
                            <p><?php echo e($package->description); ?></p>
                        </div>
                        
                        <div class="package-features">
                            <?php $__currentLoopData = $package->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span><?php echo e($feature); ?></span>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        
                        <div class="package-action">
                            <a href="<?php echo e(route('payment.subscription.activate', $package->id)); ?>" class="btn btn-package <?php if($loop->index === 1): ?> btn-featured <?php endif; ?>">
                                <i class="bi bi-lightning-charge me-2"></i>
                                <span data-en="Purchase Now" data-fr="Acheter maintenant">Purchase Now</span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Subscription History Section -->
    <div class="row">
        <div class="col-12">
            <div class="section-header">
                <h2 class="section-title" data-en="Subscription History" data-fr="Historique des abonnements">Subscription History</h2>
                <div class="section-line"></div>
            </div>
            
            <?php if($subscriptions->isEmpty()): ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h3 data-en="No History Available" data-fr="Aucun historique disponible">No History Available</h3>
                    <p class="text-muted" data-en="No subscription history found." data-fr="Aucun historique d'abonnement trouvé.">No subscription history found.</p>
                </div>
            <?php else: ?>
                <div class="history-table-container">
                    <div class="table-responsive">
                        <table class="table modern-table">
                            <thead>
                                <tr>
                                    <th data-en="Package" data-fr="Forfait">Package</th>
                                    <th data-en="Status" data-fr="Statut">Status</th>
                                    <th data-en="Start Date" data-fr="Date de début">Start Date</th>
                                    <th data-en="End Date" data-fr="Date de fin">End Date</th>
                                    <th data-en="Payment Status" data-fr="Statut du paiement">Payment Status</th>
                                    <th data-en="Reference" data-fr="Référence">Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="history-row">
                                    <td class="package-name">
                                        <div class="package-info">
                                            <i class="bi bi-box"></i>
                                            <span><?php echo e($subscription->package->name); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                                    <?php if($subscription->status === 'active'): ?>
                                                        <span class="badge bg-success" data-en="Active" data-fr="Actif">Active</span>
                                                    <?php elseif($subscription->status === 'trial'): ?>
                                                        <?php if($subscription->trial_ends_at > now()): ?>
                                                            <span class="badge bg-info" data-en="Trial" data-fr="Essai">Trial</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger" data-en="Expired Trial" data-fr="Essai expiré">Expired Trial</span>
                                                        <?php endif; ?>
                                                    <?php elseif($subscription->status === 'pending'): ?>
                                                        <span class="badge bg-warning text-dark" data-en="Pending" data-fr="En attente">Pending</span>
                                                    <?php elseif($subscription->status === 'canceled'): ?>
                                                        <span class="badge bg-danger" data-en="Canceled" data-fr="Annulé">Canceled</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->status)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($subscription->status === 'trial'): ?>
                                                        <?php echo e($subscription->trial_starts_at ? $subscription->trial_starts_at->format('M d, Y') : 'N/A'); ?>

                                                    <?php else: ?>
                                                        <?php echo e($subscription->created_at->format('M d, Y')); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($subscription->status === 'trial'): ?>
                                                        <?php echo e($subscription->trial_ends_at ? $subscription->trial_ends_at->format('M d, Y') : 'N/A'); ?>

                                                    <?php elseif($subscription->status === 'active'): ?>
                                                        <span data-en="Lifetime" data-fr="À vie">Lifetime</span>
                                                    <?php else: ?>
                                                        <?php echo e($subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A'); ?>

                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if($subscription->payment_status === 'completed'): ?>
                                                        <span class="badge bg-success" data-en="Completed" data-fr="Terminé">Completed</span>
                                                    <?php elseif($subscription->payment_status === 'pending'): ?>
                                                        <span class="badge bg-warning text-dark" data-en="Pending" data-fr="En attente">Pending</span>
                                                    <?php elseif($subscription->payment_status === 'failed'): ?>
                                                        <span class="badge bg-danger" data-en="Failed" data-fr="Échoué">Failed</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary"><?php echo e(ucfirst($subscription->payment_status)); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
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
            
            // Translate table data labels for mobile view
            document.querySelectorAll('td').forEach(function(td, index) {
                const headerTexts = {
                    en: ['Package', 'Status', 'Start Date', 'End Date', 'Payment Status', 'Reference'],
                    fr: ['Forfait', 'Statut', 'Date de début', 'Date de fin', 'Statut du paiement', 'Référence']
                };
                
                const cellIndex = index % 6; // 6 columns in the table
                if (cellIndex < headerTexts[language].length) {
                    td.setAttribute('data-label', headerTexts[language][cellIndex]);
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
        
        // Add entrance animations to cards
        const cards = document.querySelectorAll('.package-card, .subscription-card, .no-subscription-card');
        cards.forEach((card, index) => {
            card.classList.add('card-entrance');
            card.style.animationDelay = (index * 0.1) + 's';
        });
        
        // Enhanced button interactions
        const buttons = document.querySelectorAll('.btn-modern');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                // Add loading state for purchase buttons
                if (this.href && this.href.includes('activate')) {
                    this.classList.add('loading');
                    this.style.pointerEvents = 'none';
                    
                    // Remove loading state after a delay if navigation fails
                    setTimeout(() => {
                        this.classList.remove('loading');
                        this.style.pointerEvents = '';
                    }, 5000);
                }
            });
        });
        
        // Add hover effects to package cards
        const packageCards = document.querySelectorAll('.package-card');
        packageCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                if (this.classList.contains('featured')) {
                    this.style.transform = 'scale(1.05)';
                } else {
                    this.style.transform = '';
                }
            });
        });
        
        // Subscription cancellation with enhanced confirmation
        const cancelForms = document.querySelectorAll('form[action*="cancel"]');
        cancelForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const currentLang = localStorage.getItem('selectedLanguage') || 'en';
                const messages = {
                    en: {
                        title: 'Cancel Subscription',
                        text: 'Are you sure you want to cancel your subscription? This action cannot be undone.',
                        confirmButton: 'Yes, Cancel',
                        cancelButton: 'Keep Subscription',
                        cancelled: 'Cancellation cancelled',
                        cancelling: 'Cancelling subscription...'
                    },
                    fr: {
                        title: 'Annuler l\'abonnement',
                        text: 'Êtes-vous sûr de vouloir annuler votre abonnement ? Cette action ne peut pas être annulée.',
                        confirmButton: 'Oui, annuler',
                        cancelButton: 'Garder l\'abonnement',
                        cancelled: 'Annulation annulée',
                        cancelling: 'Annulation de l\'abonnement...'
                    }
                };
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: messages[currentLang].title,
                        text: messages[currentLang].text,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: messages[currentLang].confirmButton,
                        cancelButtonText: messages[currentLang].cancelButton,
                        reverseButtons: true,
                        customClass: {
                            popup: 'modern-alert'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            Swal.fire({
                                title: messages[currentLang].cancelling,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                showConfirmButton: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                            
                            // Submit the form
                            this.submit();
                        } else {
                            Swal.fire({
                                title: messages[currentLang].cancelled,
                                icon: 'info',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    });
                } else {
                    // Fallback for basic confirm dialog
                    if (confirm(messages[currentLang].text)) {
                        this.submit();
                    }
                }
            });
        });
        
        // Add pulse animation to active subscription badge
        const activeBadges = document.querySelectorAll('.status-badge.active');
        activeBadges.forEach(badge => {
            badge.classList.add('notification-pulse');
        });
        
        // Smooth scroll to sections
        const anchorLinks = document.querySelectorAll('a[href*="#"]');
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.hash !== '') {
                    e.preventDefault();
                    const target = document.querySelector(this.hash);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
        
        // Auto-refresh subscription status every 30 seconds (optional)
        // Uncomment if you want real-time updates
        /*
        setInterval(function() {
            fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newStatusSection = doc.querySelector('.subscription-card, .no-subscription-card');
                const currentStatusSection = document.querySelector('.subscription-card, .no-subscription-card');
                
                if (newStatusSection && currentStatusSection && 
                    newStatusSection.innerHTML !== currentStatusSection.innerHTML) {
                    currentStatusSection.innerHTML = newStatusSection.innerHTML;
                    translatePage(currentLanguage);
                    
                    // Show notification
                    if (typeof Swal !== 'undefined') {
                        const message = currentLanguage === 'fr' 
                            ? 'Statut d\'abonnement mis à jour' 
                            : 'Subscription status updated';
                        
                        Swal.fire({
                            icon: 'info',
                            title: message,
                            timer: 2000,
                            showConfirmButton: false,
                            position: 'top-end',
                            toast: true
                        });
                    }
                }
            })
            .catch(error => console.log('Status refresh failed:', error));
        }, 30000);
        */
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/immif732/jurislocator/resources/views/payment/details.blade.php ENDPATH**/ ?>