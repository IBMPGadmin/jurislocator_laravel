<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? 'JurisLocator'); ?></title>
    
    <!-- Custom meta tags -->
    <?php echo $__env->yieldContent('meta'); ?>
    
    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('user_assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('user_assets/css/login_styles.css')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
    <style>
    .profile-header-img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .profile-header-img:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .profile-header-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e9ecef;
        border: 2px solid #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #6c757d;
        transition: all 0.3s ease;
    }
    
    .profile-header-placeholder:hover {
        background-color: #dee2e6;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .header-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .language-switcher {
        position: relative;
    }

    .language-toggle {
        background: none;
        border: none;
        color: var(--header-text-color);
        font-size: 1rem;
        cursor: pointer;
        padding: 6px 10px;
        border-radius: 20px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .language-toggle:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: scale(1.05);
    }

    .current-lang {
        font-size: 0.8rem;
        font-weight: 600;
    }

    .language-panel {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        padding: 15px;
        min-width: 150px;
        z-index: 1000;
        margin-top: 10px;
    }

    .language-panel.hidden {
        display: none;
    }

    .language-panel h4 {
        margin: 0 0 10px 0;
        color: #333;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .language-options {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .lang-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border: none;
        background: #f8f9fa;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.85rem;
        text-align: left;
    }

    .lang-btn:hover {
        background: #e9ecef;
        transform: translateX(2px);
    }

    .lang-btn.active {
        background: var(--color-button-bg-hover-2);
        color: white;
    }

    .flag {
        font-size: 1.2rem;
    }

    .notification-icon {
        position: relative;
    }

    .notification-btn {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: all 0.3s ease;
        position: relative;
    }

    .notification-btn:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: scale(1.1);
    }

    .notification-badge {
        position: absolute;
        top: 2px;
        right: 2px;
        background-color: #dc3545;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .theme-selector {
        position: relative;
    }

    .theme-toggle {
        background: none;
        border: none;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .theme-toggle:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: scale(1.1);
    }

    .theme-panel {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        padding: 20px;
        min-width: 200px;
        z-index: 1000;
        margin-top: 10px;
    }

    .theme-panel.hidden {
        display: none;
    }

    .theme-panel h4 {
        margin: 0 0 15px 0;
        color: #333;
        font-size: 1rem;
        font-weight: 600;
    }

    .theme-options {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .theme-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        border: none;
        background: #f8f9fa;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .theme-btn:hover {
        background: #e9ecef;
        transform: translateX(2px);
    }

    .theme-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    </style>
    
    <?php
    // Add this for pages that use TinyMCE
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Set global JavaScript variable for client ID
    echo '<script>';
    echo 'window.selectedClientId = ' . (isset($_SESSION['selected_client_id']) ? $_SESSION['selected_client_id'] : 'null') . ';';
    echo '</script>';
    ?>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body id="body-pd" class="gap_right_home">
    <header class="header gradient-background" id="header">
        <div class="logo">
            <img src="<?php echo e(asset('user_assets/img/jurislocator-logo.png')); ?>" alt="jurislocator" />
        </div>

        <div class="header_toggle"> 
            <i class="bi bi-list" id="header-toggle"></i> 
        </div>
        
        <div class="header-controls">
            <!-- Language Switcher -->
            <div class="language-switcher">
                <button class="language-toggle" id="language-toggle" title="Change Language">
                    <i class="bi bi-translate"></i>
                    <span class="current-lang" id="current-lang">EN</span>
                </button>
                <div id="language-panel" class="language-panel hidden">
                    <h4>Select Language</h4>
                    <div class="language-options">
                        <button class="lang-btn active" data-lang="en" data-flag="🇺🇸">
                            <span class="flag">🇺🇸</span>
                            English
                        </button>
                        <button class="lang-btn" data-lang="fr" data-flag="🇫🇷">
                            <span class="flag">🇫🇷</span>
                            Français
                        </button>
                    </div>
                </div>
            </div>

            <!-- Notification Icon -->
            <div class="notification-icon">
                <button class="notification-btn" id="notification-toggle" title="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
            </div>

            <!-- Theme Selector -->
            <div class="theme-selector">
                <button class="theme-toggle" id="theme-toggle" title="Change Theme">
                    <i class="bi bi-palette"></i>
                </button>
                <div id="theme-panel" class="theme-panel hidden">
                    <h4>Choose Theme</h4>
                    <div class="theme-options">
                        <button class="theme-btn" data-theme="default">
                            <span class="theme-color" style="background: linear-gradient(45deg, #007bff, #0056b3);"></span>
                            Default
                        </button>
                        <button class="theme-btn" data-theme="dark">
                            <span class="theme-color" style="background: linear-gradient(45deg, #343a40, #212529);"></span>
                            Dark Mode
                        </button>
                        <button class="theme-btn" data-theme="blue">
                            <span class="theme-color" style="background: linear-gradient(45deg, #17a2b8, #138496);"></span>
                            Blue Theme
                        </button>
                        <button class="theme-btn" data-theme="green">
                            <span class="theme-color" style="background: linear-gradient(45deg, #28a745, #1e7e34);"></span>
                            Green Theme
                        </button>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="header_img"> 
                <a href="<?php echo e(route('profile.edit')); ?>" title="Edit Profile">
                    <?php if(Auth::user() && Auth::user()->profile_image): ?>
                        <img src="<?php echo e(asset(Auth::user()->profile_image)); ?>" alt="<?php echo e(Auth::user()->name); ?>'s Profile" class="profile-header-img">
                    <?php else: ?>
                        <div class="profile-header-placeholder">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    <?php endif; ?>
                </a> 
            </div>
        </div>
    </header>
    
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">            <div class="nav_list"> 
                <a href="<?php echo e(route('user.dashboard')); ?>" class="nav_link <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>"> 
                    <i class='bx bx-grid-alt nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                        </svg>
                    </i> 
                    <span class="nav_name" data-en="Dashboard" data-fr="Tableau de bord">Dashboard</span> 
                </a> 

                <a href="<?php echo e(route('templates.select-client')); ?>" class="nav_link <?php echo e(request()->routeIs('templates.select-client') || request()->routeIs('templates.index') || request()->routeIs('templates.edit') ? 'active' : ''); ?>"> 
                    <i class='bx bx-message-square-detail nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                        </svg>
                    </i> 
                    <span class="nav_name" data-en="Templates" data-fr="Modèles">Templates</span> 
                </a> 

                <a href="<?php echo e(route('user.government-links')); ?>" class="nav_link <?php echo e(request()->routeIs('user.government-links*') ? 'active' : ''); ?>"> 
                    <i class='bx bx-bookmark nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        </svg>
                    </i> 
                    <span class="nav_name" data-en="Government Links" data-fr="Liens gouvernementaux">Government Links</span>
                </a> 

                <a href="<?php echo e(route('user.rcic-deadlines.index')); ?>" class="nav_link"> 
                    <i class='bx bx-time nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5 0M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                    </i>
                    <span class="nav_name" data-en="RCIC Deadlines" data-fr="Délais RCIC">RCIC Deadlines</span>
                </a>

                <a href="<?php echo e(route('user.legal-key-terms.index')); ?>" class="nav_link"> 
                    <i class='bx bx-book nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                            <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                        </svg>
                    </i>
                    <span class="nav_name" data-en="Legal Key Terms" data-fr="Termes juridiques clés">Legal Key Terms</span>
                </a> 

                <a href="<?php echo e(route('payment.details')); ?>" class="nav_link <?php echo e(request()->routeIs('payment.details') ? 'active' : ''); ?>"> 
                    <i class='bx bx-bar-chart-alt-2 nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1z"/>
                        </svg>
                    </i> 
                    <span class="nav_name" data-en="Payment Details" data-fr="Détails de paiement">Payment Details</span>
                </a>

          
                <a href="<?php echo e(route('profile.edit')); ?>" class="nav_link <?php echo e(request()->routeIs('profile.edit') ? 'active' : ''); ?>"> 
                    <i class='bx bx-user nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </i> 
                    <span class="nav_name" data-en="Profile Details" data-fr="Détails du profil">Profile Details</span>
                </a> 

            </div>

            <a href="<?php echo e(route('logout')); ?>" 
               class="nav_link" 
               id="logout-link" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                <i class='bx bx-log-out nav_icon'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                    </svg>
                </i> 
                <span class="nav_name" data-en="Sign Out" data-fr="Se déconnecter">Sign Out</span>
            </a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
        </nav>
    </div>

    <div class="main-content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <footer class="gap_footer footer">
        <div class="row container">
            <p>&copy;<a target="_blank" href="https://immifocus.ca">immigopro</a> <?php echo e(date("Y")); ?> - All Rights Reserved</p>
        </div>
    </footer>

    <!-- JavaScript Dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.4.1/tinymce.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Scripts -->
    <script src="<?php echo e(asset('user_assets/js/template-manager.js')); ?>"></script>
    <script src="<?php echo e(asset('user_assets/js/config.js')); ?>"></script>
    <script src="<?php echo e(asset('user_assets/js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('user_assets/js/side_bar.js')); ?>"></script>
    <script src="<?php echo e(asset('user_assets/js/navigation.js')); ?>"></script>
    
    <script>
    // Language and Theme functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Language switcher functionality
        const languageToggle = document.getElementById('language-toggle');
        const languagePanel = document.getElementById('language-panel');
        const langBtns = document.querySelectorAll('.lang-btn');
        const currentLangSpan = document.getElementById('current-lang');
        
        // Theme elements
        const themeToggle = document.getElementById('theme-toggle');
        const themePanel = document.getElementById('theme-panel');
        const themeBtns = document.querySelectorAll('.theme-btn');
        
        // Language switcher toggle
        languageToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            languagePanel.classList.toggle('hidden');
            // Close theme panel if open
            themePanel.classList.add('hidden');
        });
        
        // Theme switcher toggle
        themeToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            themePanel.classList.toggle('hidden');
            // Close language panel if open
            languagePanel.classList.add('hidden');
        });
        
        // Close panels when clicking outside
        document.addEventListener('click', function(e) {
            if (!languagePanel.contains(e.target) && !languageToggle.contains(e.target)) {
                languagePanel.classList.add('hidden');
            }
            if (!themePanel.contains(e.target) && !themeToggle.contains(e.target)) {
                themePanel.classList.add('hidden');
            }
        });
        
        // Translation function
        function translateNavigation(language) {
            const navItems = document.querySelectorAll('.nav_name[data-en][data-fr]');
            navItems.forEach(item => {
                const translation = item.getAttribute('data-' + language);
                if (translation) {
                    item.textContent = translation;
                }
            });
        }

        // Global translation function for page content
        function translatePageContent(language) {
            // Translate all elements with data attributes
            const elements = document.querySelectorAll('[data-en][data-fr]');
            elements.forEach(element => {
                const translation = element.getAttribute('data-' + language);
                if (translation) {
                    element.textContent = translation;
                }
            });

            // Translate placeholder texts
            const placeholderElements = document.querySelectorAll('[data-placeholder-en][data-placeholder-fr]');
            placeholderElements.forEach(element => {
                const placeholder = element.getAttribute('data-placeholder-' + language);
                if (placeholder) {
                    element.placeholder = placeholder;
                }
            });

            // Translate select options
            const options = document.querySelectorAll('option[data-en][data-fr]');
            options.forEach(option => {
                const translation = option.getAttribute('data-' + language);
                if (translation) {
                    option.textContent = translation;
                }
            });

            // Translate optgroup labels
            const optgroups = document.querySelectorAll('optgroup[data-label-en][data-label-fr]');
            optgroups.forEach(optgroup => {
                const label = optgroup.getAttribute('data-label-' + language);
                if (label) {
                    optgroup.label = label;
                }
            });

            // Translate button text
            const buttons = document.querySelectorAll('button[data-en][data-fr]');
            buttons.forEach(button => {
                const translation = button.getAttribute('data-' + language);
                if (translation) {
                    button.textContent = translation;
                }
            });

            // Translate input values for buttons
            const inputButtons = document.querySelectorAll('input[type="submit"][data-en][data-fr], input[type="button"][data-en][data-fr]');
            inputButtons.forEach(input => {
                const translation = input.getAttribute('data-' + language);
                if (translation) {
                    input.value = translation;
                }
            });
        }
        
        // Update active language button
        function updateActiveLanguage(selectedLang) {
            langBtns.forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-lang') === selectedLang) {
                    btn.classList.add('active');
                    const flag = btn.getAttribute('data-flag');
                    currentLangSpan.textContent = selectedLang.toUpperCase();
                }
            });
        }
        
        // Language selection
        langBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const lang = this.getAttribute('data-lang');
                const flag = this.getAttribute('data-flag');
                
                // Update current language display
                currentLangSpan.textContent = lang.toUpperCase();
                
                // Update active button
                updateActiveLanguage(lang);
                
                // Translate navigation
                translateNavigation(lang);
                
                // Translate page content
                translatePageContent(lang);
                
                // Save language preference
                localStorage.setItem('selectedLanguage', lang);
                
                // Dispatch custom event for other components to listen
                window.dispatchEvent(new CustomEvent('languageChanged', { 
                    detail: { language: lang } 
                }));
                
                // Close panel
                languagePanel.classList.add('hidden');
                
                // Show success message
                if (typeof Swal !== 'undefined') {
                    const message = lang === 'fr' 
                        ? 'Langue changée en Français!' 
                        : 'Language changed to English!';
                    
                    Swal.fire({
                        icon: 'success',
                        title: lang === 'fr' ? 'Langue changée' : 'Language Changed',
                        text: message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });
        
        // Function to update active theme button
        function updateActiveTheme(selectedTheme) {
            themeBtns.forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-theme') === selectedTheme) {
                    btn.classList.add('active');
                }
            });
        }
        
        // Theme selection
        themeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const theme = this.getAttribute('data-theme');
                
                // Remove existing theme classes
                document.body.className = document.body.className.replace(/theme-\w+/g, '');
                
                // Add new theme class
                document.body.classList.add('theme-' + theme);
                
                // Update active button
                updateActiveTheme(theme);
                
                // Save theme preference
                localStorage.setItem('selectedTheme', theme);
                
                // Close panel
                themePanel.classList.add('hidden');
                
                // Show success message
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Theme Changed',
                        text: 'Theme has been updated successfully!',
                        timer: 1500,
                        showConfirmButton: false
                    });
                }
            });
        });
        
        // Load saved preferences
        const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';
        const savedTheme = localStorage.getItem('selectedTheme') || 'default';
        
        // Global translation dictionary for JavaScript messages
        window.translations = {
            en: {
                // Popup control messages
                'save_popups_success': 'Successfully saved {count} popup(s)',
                'save_popups_failed': 'Failed to save popups',
                'fetch_popups_success': 'Successfully fetched {count} popup(s)',
                'fetch_popups_failed': 'Failed to fetch popups',
                'clear_popups_success': 'Successfully cleared all popups',
                'clear_popups_failed': 'Failed to clear popups',
                'no_popups_to_save': 'No popups to save',
                'no_popups_found': 'No saved popups found',
                // General messages
                'error': 'Error',
                'success': 'Success',
                'warning': 'Warning',
                'info': 'Information'
            },
            fr: {
                // Popup control messages
                'save_popups_success': '{count} popup(s) sauvegardé(s) avec succès',
                'save_popups_failed': 'Échec de la sauvegarde des popups',
                'fetch_popups_success': '{count} popup(s) récupéré(s) avec succès',
                'fetch_popups_failed': 'Échec de la récupération des popups',
                'clear_popups_success': 'Tous les popups ont été effacés avec succès',
                'clear_popups_failed': 'Échec de l\'effacement des popups',
                'no_popups_to_save': 'Aucun popup à sauvegarder',
                'no_popups_found': 'Aucun popup sauvegardé trouvé',
                // General messages
                'error': 'Erreur',
                'success': 'Succès',
                'warning': 'Avertissement',
                'info': 'Information'
            }
        };

        // Global function to get translated text
        window.getTranslation = function(key, params = {}) {
            const currentLang = localStorage.getItem('selectedLanguage') || 'en';
            let text = window.translations[currentLang][key] || window.translations['en'][key] || key;
            
            // Replace parameters like {count}
            Object.keys(params).forEach(param => {
                text = text.replace(new RegExp(`{${param}}`, 'g'), params[param]);
            });
            
            return text;
        };

        // Apply saved language
        updateActiveLanguage(savedLanguage);
        translateNavigation(savedLanguage);
        translatePageContent(savedLanguage);
        
        // Apply saved theme
        document.body.classList.add('theme-' + savedTheme);
        updateActiveTheme(savedTheme);
        
        // Notification functionality
        const notificationBtn = document.getElementById('notification-toggle');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                const currentLang = localStorage.getItem('selectedLanguage') || 'en';
                const notifications = {
                    en: {
                        title: 'Notifications',
                        content: `
                            <div style="text-align: left;">
                                <p><strong>• New deadline reminder</strong><br><small>RCIC deadline in 3 days</small></p>
                                <p><strong>• Template updated</strong><br><small>Legal template has been modified</small></p>
                                <p><strong>• System maintenance</strong><br><small>Scheduled for tonight at 2 AM</small></p>
                            </div>
                        `,
                        button: 'Mark as Read'
                    },
                    fr: {
                        title: 'Notifications',
                        content: `
                            <div style="text-align: left;">
                                <p><strong>• Nouveau rappel d'échéance</strong><br><small>Échéance RCIC dans 3 jours</small></p>
                                <p><strong>• Modèle mis à jour</strong><br><small>Le modèle juridique a été modifié</small></p>
                                <p><strong>• Maintenance du système</strong><br><small>Prévue ce soir à 2h du matin</small></p>
                            </div>
                        `,
                        button: 'Marquer comme lu'
                    }
                };
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'info',
                        title: notifications[currentLang].title,
                        html: notifications[currentLang].content,
                        showConfirmButton: true,
                        confirmButtonText: notifications[currentLang].button
                    });
                }
            });
        }
    });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/immif732/jurislocator/resources/views/layouts/user-layout.blade.php ENDPATH**/ ?>