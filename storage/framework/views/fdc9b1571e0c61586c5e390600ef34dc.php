

<?php $__env->startSection('content'); ?>
<!-- Full Screen Overlay -->
<div class="workflow-overlay">
    <div class="workflow-modal">
        <!-- Modal Header -->
        <div class="modal-header-custom">
            <div class="modal-icon-wrapper">
                <div class="modal-icon">
                    <i class="fas fa-route"></i>
                </div>
            </div>
            <h2 class="modal-title" data-en="Choose Your Workflow" data-fr="Choisissez votre flux de travail">Choose Your Workflow</h2>
            <p class="modal-subtitle" data-en="How would you like to access legal documents today?" data-fr="Comment souhaitez-vous accéder aux documents juridiques aujourd'hui ?">How would you like to access legal documents today?</p>
        </div>

        <!-- Modal Content -->
        <div class="modal-content-custom">
            <div class="workflow-options">
                <!-- Client-Centric Workflow -->
                <div class="workflow-option" onclick="selectWorkflow('client')">
                    <div class="option-icon client-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="option-content">
                        <h3 data-en="Client-Centric" data-fr="Centré sur le client">Client-Centric</h3>
                        <p data-en="Work with legal documents for a specific client. All annotations, notes, and templates will be saved for that client." data-fr="Travaillez avec des documents juridiques pour un client spécifique. Toutes les annotations, notes et modèles seront sauvegardés pour ce client.">Work with legal documents for a specific client. All annotations, notes, and templates will be saved for that client.</p>
                        
                        <div class="option-features">
                            <span class="feature-tag" data-en="Client-specific notes" data-fr="Notes spécifiques au client">Client-specific notes</span>
                            <span class="feature-tag" data-en="Client-based templates" data-fr="Modèles basés sur le client">Client-based templates</span>
                            <span class="feature-tag" data-en="Client document history" data-fr="Historique des documents du client">Client document history</span>
                        </div>
                    </div>
                    <div class="option-action">
                        <button class="action-btn client-btn" data-en="Select Client" data-fr="Sélectionner le client">Select Client</button>
                    </div>
                </div>

                <!-- User-Centric Workflow -->
                <div class="workflow-option" onclick="selectWorkflow('user')">
                    <div class="option-icon user-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="option-content">
                        <h3 data-en="User-Centric" data-fr="Centré sur l'utilisateur">User-Centric</h3>
                        <p data-en="Work directly with legal documents. All annotations, notes, and templates will be saved to your personal workspace." data-fr="Travaillez directement avec des documents juridiques. Toutes les annotations, notes et modèles seront sauvegardés dans votre espace de travail personnel.">Work directly with legal documents. All annotations, notes, and templates will be saved to your personal workspace.</p>
                        
                        <div class="option-features">
                            <span class="feature-tag" data-en="Personal notes" data-fr="Notes personnelles">Personal notes</span>
                            <span class="feature-tag" data-en="Personal templates" data-fr="Modèles personnels">Personal templates</span>
                            <span class="feature-tag" data-en="Personal workspace" data-fr="Espace de travail personnel">Personal workspace</span>
                        </div>
                    </div>
                    <div class="option-action">
                        <button class="action-btn user-btn" data-en="Browse Documents" data-fr="Parcourir les documents">Browse Documents</button>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer-custom">
                <p class="footer-note" data-en="You can change your workflow type anytime from the navigation menu." data-fr="Vous pouvez changer votre type de flux de travail à tout moment depuis le menu de navigation.">You can change your workflow type anytime from the navigation menu.</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function selectWorkflow(type) {
        // Add loading state
        const options = document.querySelectorAll('.workflow-option');
        options.forEach(option => {
            option.style.pointerEvents = 'none';
            option.style.opacity = '0.7';
        });
        
        // Show loading
        const selectedOption = event.currentTarget;
        const button = selectedOption.querySelector('.action-btn');
        const originalText = button.textContent;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
        button.disabled = true;
        
        // Send request to set session mode
        fetch('/set-session-mode', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ mode: type })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (type === 'client') {
                    window.location.href = '/home';
                } else {
                    window.location.href = '/user/legal-tables';
                }
            } else {
                alert('Error setting session mode. Please try again.');
                // Reset UI
                options.forEach(option => {
                    option.style.pointerEvents = 'auto';
                    option.style.opacity = '1';
                });
                button.textContent = originalText;
                button.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error setting session mode. Please try again.');
            // Reset UI
            options.forEach(option => {
                option.style.pointerEvents = 'auto';
                option.style.opacity = '1';
            });
            button.textContent = originalText;
            button.disabled = false;
        });
    }
    
    // Add hover effects for workflow options
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.workflow-option').forEach(option => {
            option.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
                this.classList.add('hovered');
            });
            
            option.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.classList.remove('hovered');
            });
        });
        
        // Apply saved language on page load
        const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
        translateSessionModePage(savedLanguage);
    });
    
    // Translation functionality
    function translateSessionModePage(language) {
        const elements = document.querySelectorAll('[data-en][data-fr]');
        elements.forEach(element => {
            const translation = element.getAttribute('data-' + language);
            if (translation) {
                element.textContent = translation;
            }
        });
    }
    
    // Listen for language change events from the main layout
    window.addEventListener('languageChanged', function(event) {
        const selectedLanguage = event.detail.language;
        translateSessionModePage(selectedLanguage);
    });
    
    // Apply saved language on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
        translateSessionModePage(savedLanguage);
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Full Screen Modal Overlay */
    .workflow-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(44, 46, 67, 0.85); /* --color-theme-1 with opacity */
        backdrop-filter: blur(12px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 20px;
        animation: fadeIn 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    @keyframes fadeIn {
        from { 
            opacity: 0; 
            backdrop-filter: blur(0px);
        }
        to { 
            opacity: 1; 
            backdrop-filter: blur(12px);
        }
    }
    
    /* Main Modal Container */
    .workflow-modal {
        background: var(--color-widget-bg, #ffffffd6);
        border-radius: 20px;
        box-shadow: 
            0 20px 40px rgba(44, 46, 67, 0.15),
            0 8px 16px rgba(44, 46, 67, 0.1),
            0 0 0 1px rgba(215, 167, 105, 0.1); /* subtle accent border */
        max-width: 700px;
        width: 100%;
        max-height: 85vh;
        overflow-y: auto;
        overflow-x: hidden;
        animation: slideUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        border: 1px solid var(--color-border, #dddddd);
        scrollbar-width: thin;
        scrollbar-color: var(--color-theme-3, #d7a769) var(--color-content-bg, #f2f2f2);
    }
    
    /* Custom Scrollbar for Webkit browsers */
    .workflow-modal::-webkit-scrollbar {
        width: 8px;
    }
    
    .workflow-modal::-webkit-scrollbar-track {
        background: var(--color-content-bg, #f2f2f2);
        border-radius: 4px;
    }
    
    .workflow-modal::-webkit-scrollbar-thumb {
        background: var(--color-theme-3, #d7a769);
        border-radius: 4px;
        transition: background 0.3s ease;
    }
    
    .workflow-modal::-webkit-scrollbar-thumb:hover {
        background: var(--color-theme-1, #2c2e43);
    }
    
    @keyframes slideUp {
        from { 
            opacity: 0; 
            transform: translateY(40px) scale(0.95); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) scale(1); 
        }
    }
    
    /* Modal Header */
    .modal-header-custom {
        background-color: var(--color-theme-1, #2c2e43);
        color: var(--color-text-light, #f2f2f2);
        padding: 30px 25px;
        text-align: center;
        position: relative;
        border-bottom: 3px solid var(--color-theme-3, #d7a769);
    }
    
    .modal-header-custom::after {
        content: '';
        position: absolute;
        bottom: -3px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background-color: var(--color-theme-3, #d7a769);
        border-radius: 2px;
    }
    
    .modal-icon-wrapper {
        margin-bottom: 20px;
    }
    
    .modal-icon {
        width: 60px;
        height: 60px;
        background-color: var(--color-theme-3, #d7a769);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(215, 167, 105, 0.3);
        transition: all 0.3s ease;
    }
    
    .modal-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(215, 167, 105, 0.4);
    }
    
    .modal-icon i {
        font-size: 24px;
        color: var(--color-text-light, #f2f2f2);
    }
    
    .modal-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0 0 10px 0;
        color: var(--color-text-light, #f2f2f2);
        letter-spacing: -0.02em;
    }
    
    .modal-subtitle {
        font-size: 1rem;
        margin: 0;
        color: var(--color-theme-2, #828498);
        font-weight: 400;
        letter-spacing: 0.01em;
    }
    
    /* Modal Content */
    .modal-content-custom {
        padding: 30px 25px;
        background-color: var(--color-content-bg, #f2f2f2);
        min-height: auto;
        flex-shrink: 0;
    }
    
    /* Workflow Options */
    .workflow-options {
        display: flex;
        flex-direction: row;
        gap: 20px;
        justify-content: space-between;
        min-height: auto;
    }
    
    .workflow-option {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 24px 20px;
        border: 2px solid var(--color-border, #dddddd);
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: var(--color-widget-bg, #ffffffd6);
        position: relative;
        overflow: hidden;
        flex: 1;
        text-align: center;
        min-height: 280px;
        justify-content: space-between;
    }
    
    .workflow-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: rgba(215, 167, 105, 0.05); /* subtle theme accent sweep */
        transition: left 0.6s ease;
    }
    
    .workflow-option:hover::before {
        left: 100%;
    }
    
    .workflow-option:hover {
        border-color: var(--color-theme-3, #d7a769);
        box-shadow: 
            0 12px 28px rgba(44, 46, 67, 0.12),
            0 4px 8px rgba(215, 167, 105, 0.15);
        transform: translateY(-3px) scale(1.01);
        background-color: #ffffff;
    }
    
    .workflow-option:active {
        transform: translateY(-1px) scale(1.005);
        transition: all 0.15s ease;
    }
    
    /* Option Icons */
    .option-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px auto;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .client-icon {
        background-color: var(--color-ref, #176bc4);
        color: var(--color-text-light, #f2f2f2);
        box-shadow: 0 4px 12px rgba(23, 107, 196, 0.25);
    }
    
    .user-icon {
        background-color: var(--color-theme-3, #d7a769);
        color: var(--color-text-light, #f2f2f2);
        box-shadow: 0 4px 12px rgba(215, 167, 105, 0.25);
    }
    
    .workflow-option:hover .option-icon {
        transform: translateY(-2px) rotate(2deg);
        box-shadow: 0 6px 16px rgba(44, 46, 67, 0.2);
    }
    
    .option-icon i {
        font-size: 24px;
        transition: all 0.3s ease;
    }
    
    .workflow-option:hover .option-icon i {
        transform: scale(1.1);
    }
    
    /* Option Content */
    .option-content {
        flex: 1;
        padding: 0;
        margin-bottom: 18px;
    }
    
    .option-content h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0 0 10px 0;
        color: var(--color-theme-1, #2c2e43);
        letter-spacing: -0.01em;
        transition: color 0.3s ease;
    }
    
    .workflow-option:hover .option-content h3 {
        color: var(--color-theme-3, #d7a769);
    }
    
    .option-content p {
        font-size: 0.9rem;
        color: var(--color-theme-2, #828498);
        margin: 0 0 16px 0;
        line-height: 1.5;
        font-weight: 400;
    }
    
    /* Feature Tags */
    .option-features {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 18px;
    }
    
    .feature-tag {
        background-color: var(--color-content-bg, #f2f2f2);
        color: var(--color-theme-1, #2c2e43);
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid var(--color-border, #dddddd);
        transition: all 0.3s ease;
        letter-spacing: 0.01em;
        text-align: center;
    }
    
    .workflow-option:hover .feature-tag {
        background-color: var(--color-theme-3, #d7a769);
        color: var(--color-text-light, #f2f2f2);
        border-color: var(--color-theme-3, #d7a769);
        transform: translateY(-1px);
    }
    
    /* Action Buttons */
    .option-action {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    
    .action-btn {
        padding: 12px 24px;
        border: 2px solid transparent;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        min-width: 120px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(44, 46, 67, 0.15);
        width: 100%;
        max-width: 160px;
    }
    
    .client-btn {
        background-color: var(--color-ref, #176bc4);
        color: var(--color-text-light, #f2f2f2);
        border-color: var(--color-ref, #176bc4);
    }
    
    .client-btn:hover {
        background-color: var(--color-theme-1, #2c2e43);
        border-color: var(--color-theme-1, #2c2e43);
        box-shadow: 0 6px 16px rgba(44, 46, 67, 0.25);
        transform: translateY(-2px);
    }
    
    .client-btn:active {
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(44, 46, 67, 0.2);
    }
    
    .user-btn {
        background-color: var(--color-theme-3, #d7a769);
        color: var(--color-text-light, #f2f2f2);
        border-color: var(--color-theme-3, #d7a769);
    }
    
    .user-btn:hover {
        background-color: var(--color-theme-1, #2c2e43);
        border-color: var(--color-theme-1, #2c2e43);
        box-shadow: 0 6px 16px rgba(44, 46, 67, 0.25);
        transform: translateY(-2px);
    }
    
    .user-btn:active {
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(44, 46, 67, 0.2);
    }
    
    .action-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: 0 2px 4px rgba(44, 46, 67, 0.1) !important;
    }
    
    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transition: left 0.4s ease;
    }
    
    .action-btn:hover::before {
        left: 100%;
    }
    
    /* Modal Footer */
    .modal-footer-custom {
        background-color: var(--color-widget-bg, #ffffffd6);
        padding: 20px 25px;
        text-align: center;
        border-top: 1px solid var(--color-border, #dddddd);
        position: relative;
        flex-shrink: 0;
        margin-top: auto;
    }
    
    .modal-footer-custom::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 1px;
        background-color: var(--color-theme-3, #d7a769);
    }
    
    .footer-note {
        margin: 0;
        color: var(--color-theme-2, #828498);
        font-size: 0.85rem;
        font-weight: 500;
        line-height: 1.4;
    }
    
    /* Enhanced Responsive Design */
    
    /* Large laptops and desktops */
    @media (min-width: 1200px) {
        .workflow-modal {
            max-width: 750px;
            max-height: 80vh;
        }
        
        .workflow-option {
            min-height: 300px;
            padding: 28px 22px;
        }
        
        .option-icon {
            width: 70px;
            height: 70px;
        }
        
        .option-icon i {
            font-size: 28px;
        }
        
        .option-content h3 {
            font-size: 1.4rem;
        }
        
        .option-content p {
            font-size: 0.95rem;
        }
    }
    
    /* Standard laptops */
    @media (max-width: 1199px) and (min-width: 969px) {
        .workflow-modal {
            max-width: 650px;
            max-height: 85vh;
        }
        
        .modal-content-custom {
            padding: 25px 20px;
        }
        
        .workflow-options {
            gap: 18px;
        }
        
        .workflow-option {
            min-height: 260px;
            padding: 22px 18px;
        }
        
        .option-content h3 {
            font-size: 1.2rem;
        }
        
        .option-content p {
            font-size: 0.85rem;
            margin-bottom: 14px;
        }
        
        .feature-tag {
            font-size: 0.7rem;
            padding: 5px 10px;
        }
        
        .action-btn {
            font-size: 0.8rem;
            padding: 10px 20px;
            max-width: 140px;
        }
    }
    
    /* Tablets and small laptops */
    @media (max-width: 968px) {
        .workflow-modal {
            max-width: 600px;
            max-height: 90vh;
        }
        
        .workflow-options {
            flex-direction: column;
            gap: 16px;
        }
        
        .workflow-option {
            flex-direction: row;
            align-items: center;
            text-align: left;
            min-height: auto;
            padding: 20px;
        }
        
        .option-icon {
            margin: 0 20px 0 0;
            width: 50px;
            height: 50px;
        }
        
        .option-icon i {
            font-size: 20px;
        }
        
        .option-content {
            margin-bottom: 0;
            padding-right: 16px;
        }
        
        .option-content h3 {
            font-size: 1.2rem;
        }
        
        .option-content p {
            font-size: 0.85rem;
        }
        
        .option-features {
            flex-direction: row;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 0;
        }
        
        .feature-tag {
            padding: 4px 8px;
            font-size: 0.7rem;
        }
        
        .option-action {
            justify-content: flex-start;
        }
        
        .action-btn {
            width: auto;
            min-width: 110px;
            max-width: none;
            font-size: 0.8rem;
            padding: 10px 16px;
        }
    }
    
    /* Mobile phones */
    @media (max-width: 768px) {
        .workflow-overlay {
            padding: 10px;
        }
        
        .workflow-modal {
            margin: 0;
            border-radius: 16px;
            max-height: 95vh;
            max-width: 100%;
        }
        
        .workflow-modal::-webkit-scrollbar {
            width: 6px;
        }
        
        .modal-header-custom {
            padding: 25px 20px;
        }
        
        .modal-title {
            font-size: 1.6rem;
        }
        
        .modal-subtitle {
            font-size: 0.9rem;
        }
        
        .modal-content-custom {
            padding: 25px 15px;
        }
        
        .workflow-option {
            flex-direction: column;
            text-align: center;
            padding: 20px 15px;
            align-items: center;
            min-height: auto;
        }
        
        .option-icon {
            margin: 0 auto 14px auto;
            width: 50px;
            height: 50px;
        }
        
        .option-icon i {
            font-size: 20px;
        }
        
        .option-content {
            padding-right: 0;
            margin-bottom: 14px;
        }
        
        .option-content h3 {
            font-size: 1.1rem;
        }
        
        .option-content p {
            font-size: 0.8rem;
        }
        
        .option-features {
            justify-content: center;
            margin-bottom: 14px;
            flex-direction: column;
            gap: 6px;
        }
        
        .action-btn {
            padding: 10px 20px;
            min-width: 110px;
            font-size: 0.8rem;
            width: 100%;
            max-width: 150px;
        }
        
        .modal-footer-custom {
            padding: 18px 15px;
        }
        
        .footer-note {
            font-size: 0.8rem;
        }
    }
    
    /* Small mobile phones */
    @media (max-width: 480px) {
        .workflow-modal {
            max-height: 98vh;
        }
        
        .workflow-modal::-webkit-scrollbar {
            width: 4px;
        }
        
        .modal-title {
            font-size: 1.4rem;
        }
        
        .modal-subtitle {
            font-size: 0.85rem;
        }
        
        .workflow-option {
            padding: 18px 12px;
        }
        
        .option-content h3 {
            font-size: 1rem;
        }
        
        .option-content p {
            font-size: 0.75rem;
        }
        
        .feature-tag {
            font-size: 0.65rem;
            padding: 4px 8px;
        }
        
        .action-btn {
            font-size: 0.75rem;
            padding: 8px 16px;
        }
    }
    
    /* Smooth Loading Animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .fa-spinner {
        animation: spin 1s linear infinite;
    }
    
    /* Focus accessibility */
    .workflow-option:focus,
    .action-btn:focus {
        outline: 2px solid var(--color-theme-3, #d7a769);
        outline-offset: 2px;
    }
    
    /* Subtle pulse animation for modal icon */
    @keyframes subtlePulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .modal-icon {
        animation: subtlePulse 3s ease-in-out infinite;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Dileesha\Desktop\jurislocator_laravel\resources\views\session-mode-selection.blade.php ENDPATH**/ ?>