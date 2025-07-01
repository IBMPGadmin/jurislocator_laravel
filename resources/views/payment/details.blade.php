@extends('layouts.user-layout')

@section('content')
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

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show modern-alert" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Current Subscription Status -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-header">
                <h2 class="section-title" data-en="Current Subscription Status" data-fr="Statut actuel de l'abonnement">Current Subscription Status</h2>
                <div class="section-line"></div>
            </div>
            
            @php
                $activeSubscription = $subscriptions->where('status', 'active')->first() 
                    ?? $subscriptions->where('status', 'trial')
                        ->where('trial_ends_at', '>', now())
                        ->first();
            @endphp

            @if($activeSubscription)
                <div class="subscription-card active-subscription">
                    <div class="subscription-header">
                        <div class="subscription-icon">
                            @if($activeSubscription->status === 'trial')
                                <i class="bi bi-clock-history"></i>
                            @else
                                <i class="bi bi-shield-check"></i>
                            @endif
                        </div>
                        <div class="subscription-info">
                            <h3 class="subscription-title">{{ $activeSubscription->package->name }}</h3>
                            <div class="subscription-badges">
                                @if($activeSubscription->status === 'trial')
                                    <span class="status-badge trial" data-en="Trial" data-fr="Essai">Trial</span>
                                @else
                                    <span class="status-badge active" data-en="Active" data-fr="Actif">Active</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="subscription-details">
                        @if($activeSubscription->status === 'trial')
                            <div class="detail-item">
                                <i class="bi bi-calendar-range"></i>
                                <div>
                                    <span class="detail-label" data-en="Trial Period" data-fr="Période d'essai">Trial Period</span>
                                    <span class="detail-value">{{ $activeSubscription->trial_starts_at->format('M d, Y') }} - {{ $activeSubscription->trial_ends_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="bi bi-hourglass-split"></i>
                                <div>
                                    <span class="detail-label" data-en="Days Remaining" data-fr="Jours restants">Days Remaining</span>
                                    <span class="detail-value highlight">{{ now()->diffInDays($activeSubscription->trial_ends_at, false) }} <span data-en="days" data-fr="jours">days</span></span>
                                </div>
                            </div>
                        @else
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
                                    <span class="detail-value">{{ $activeSubscription->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    @if($activeSubscription->status === 'active')
                        <div class="subscription-actions">
                            <form action="{{ route('payment.subscription.cancel', $activeSubscription->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel your subscription? This action cannot be undone.');">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-modern">
                                    <i class="bi bi-x-circle me-2"></i>
                                    <span data-en="Cancel Subscription" data-fr="Annuler l'abonnement">Cancel Subscription</span>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @else
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
                        <a href="{{ route('subscription.pricing') }}" class="btn btn-primary btn-modern">
                            <i class="bi bi-plus-circle me-2"></i>
                            <span data-en="Purchase a subscription" data-fr="Acheter un abonnement">Purchase a subscription</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Available Packages Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="section-header">
                <h2 class="section-title" data-en="Available Packages" data-fr="Forfaits disponibles">Available Packages</h2>
                <div class="section-line"></div>
            </div>
            
            @if($activeSubscription && $activeSubscription->status === 'trial')
            <div class="info-banner trial">
                <i class="bi bi-info-circle"></i>
                <span data-en="Your trial will expire soon. Purchase a subscription to continue accessing all features." data-fr="Votre essai expirera bientôt. Achetez un abonnement pour continuer à accéder à toutes les fonctionnalités.">Your trial will expire soon. Purchase a subscription to continue accessing all features.</span>
            </div>
            @elseif($activeSubscription && $activeSubscription->status === 'active')
            <div class="info-banner active">
                <i class="bi bi-info-circle"></i>
                <span data-en="You already have an active subscription, but you can purchase an additional package if needed." data-fr="Vous avez déjà un abonnement actif, mais vous pouvez acheter un forfait supplémentaire si nécessaire.">You already have an active subscription, but you can purchase an additional package if needed.</span>
            </div>
            @else
            <div class="info-banner warning">
                <i class="bi bi-exclamation-triangle"></i>
                <span data-en="You don't have an active subscription. Purchase a subscription to access all features." data-fr="Vous n'avez pas d'abonnement actif. Achetez un abonnement pour accéder à toutes les fonctionnalités.">You don't have an active subscription. Purchase a subscription to access all features.</span>
            </div>
            @endif
            
            <div class="row g-4 mt-3">
                @foreach($availablePackages as $package)
                <div class="col-lg-4 col-md-6">
                    <div class="package-card @if($loop->index === 1) featured @endif">
                        @if($loop->index === 1)
                            <div class="featured-badge">
                                <span data-en="Most Popular" data-fr="Le plus populaire">Most Popular</span>
                            </div>
                        @endif
                        
                        <div class="package-header">
                            <div class="package-icon">
                                <i class="bi bi-gem"></i>
                            </div>
                            <h3 class="package-title">{{ $package->name }}</h3>
                            <div class="package-price">
                                <span class="currency">$</span>
                                <span class="amount">{{ number_format($package->price, 0) }}</span>
                                <span class="period">/lifetime</span>
                            </div>
                        </div>
                        
                        <div class="package-description">
                            <p>{{ $package->description }}</p>
                        </div>
                        
                        <div class="package-features">
                            @foreach($package->features as $feature)
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="package-action">
                            <a href="{{ route('payment.subscription.activate', $package->id) }}" class="btn btn-package @if($loop->index === 1) btn-featured @endif">
                                <i class="bi bi-lightning-charge me-2"></i>
                                <span data-en="Purchase Now" data-fr="Acheter maintenant">Purchase Now</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
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
            
            @if($subscriptions->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h3 data-en="No History Available" data-fr="Aucun historique disponible">No History Available</h3>
                    <p class="text-muted" data-en="No subscription history found." data-fr="Aucun historique d'abonnement trouvé.">No subscription history found.</p>
                </div>
            @else
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
                                @foreach($subscriptions as $subscription)
                                <tr class="history-row">
                                    <td class="package-name">
                                        <div class="package-info">
                                            <i class="bi bi-box"></i>
                                            <span>{{ $subscription->package->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                                    @if($subscription->status === 'active')
                                                        <span class="badge bg-success" data-en="Active" data-fr="Actif">Active</span>
                                                    @elseif($subscription->status === 'trial')
                                                        @if($subscription->trial_ends_at > now())
                                                            <span class="badge bg-info" data-en="Trial" data-fr="Essai">Trial</span>
                                                        @else
                                                            <span class="badge bg-danger" data-en="Expired Trial" data-fr="Essai expiré">Expired Trial</span>
                                                        @endif
                                                    @elseif($subscription->status === 'pending')
                                                        <span class="badge bg-warning text-dark" data-en="Pending" data-fr="En attente">Pending</span>
                                                    @elseif($subscription->status === 'canceled')
                                                        <span class="badge bg-danger" data-en="Canceled" data-fr="Annulé">Canceled</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($subscription->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($subscription->status === 'trial')
                                                        {{ $subscription->trial_starts_at ? $subscription->trial_starts_at->format('M d, Y') : 'N/A' }}
                                                    @else
                                                        {{ $subscription->created_at->format('M d, Y') }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($subscription->status === 'trial')
                                                        {{ $subscription->trial_ends_at ? $subscription->trial_ends_at->format('M d, Y') : 'N/A' }}
                                                    @elseif($subscription->status === 'active')
                                                        <span data-en="Lifetime" data-fr="À vie">Lifetime</span>
                                                    @else
                                                        {{ $subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($subscription->payment_status === 'completed')
                                                        <span class="badge bg-success" data-en="Completed" data-fr="Terminé">Completed</span>
                                                    @elseif($subscription->payment_status === 'pending')
                                                        <span class="badge bg-warning text-dark" data-en="Pending" data-fr="En attente">Pending</span>
                                                    @elseif($subscription->payment_status === 'failed')
                                                        <span class="badge bg-danger" data-en="Failed" data-fr="Échoué">Failed</span>
                                                    @else
                                                        <span class="badge bg-secondary">{{ ucfirst($subscription->payment_status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection



@push('scripts')
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
@endpush
