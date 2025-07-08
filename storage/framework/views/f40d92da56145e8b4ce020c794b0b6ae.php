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

    /* World Clock Header Dropdown Styles */

    .world-clock-dropdown {

        position: relative;

    }



    .world-clock-toggle {

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



    .world-clock-toggle:hover {

        background-color: rgba(255, 255, 255, 0.1);

        transform: scale(1.1);

    }



    .world-clock-header-panel {

        position: absolute;

        top: 100%;

        left: 0;

        right: 0;

        background: white;

        border-radius: 0 0 12px 12px;

        box-shadow: 0 8px 32px rgba(0,0,0,0.15);

        padding: 0;

        width: 100vw;

        max-width: none;

        z-index: 1000;

        margin-top: 0;

        margin-left: calc(-100vw + 100%);

        overflow: hidden;

    }



    .world-clock-header-panel.hidden {

        display: none;

    }



    .world-clock-header-content {

        padding: 20px 40px;

        max-width: 1200px;

        margin: 0 auto;

    }



    .pinned-timezones-header-list {

        display: flex;

        flex-wrap: wrap;

        gap: 16px;

        min-height: 80px;

        align-items: center;

        justify-content: flex-start;

    }



    .pinned-timezone-header-item {

        background: linear-gradient(135deg, #f8f9fa, #e9ecef);

        border-radius: 10px;

        padding: 16px 20px;

        display: flex;

        align-items: center;

        gap: 12px;

        min-width: 180px;

        border: 1px solid #dee2e6;

        transition: all 0.3s ease;

        box-shadow: 0 2px 8px rgba(0,0,0,0.08);

    }



    .pinned-timezone-header-item:hover {

        transform: translateY(-2px);

        box-shadow: 0 4px 12px rgba(0,0,0,0.1);

    }



    .pinned-timezone-header-flag {

        font-size: 1.2rem;

    }



    .pinned-timezone-header-info {

        flex: 1;

    }



    .pinned-timezone-header-info .city {

        font-size: 0.75rem;

        font-weight: 600;

        color: #495057;

        margin: 0;

        line-height: 1.2;

    }



    .pinned-timezone-header-info .time {

        font-size: 0.9rem;

        font-weight: 700;

        color: #212529;

        margin: 2px 0 0 0;

        line-height: 1;

    }



    /* Pinned Timezones Inline with Header Controls */

    .pinned-timezones-inline {

        display: flex;

        align-items: center;

        gap: 16px;

        margin-right: 16px;

        flex-wrap: wrap;

    }



    .pinned-timezone-inline-item {

        background: rgba(255, 255, 255, 0.15);

        border-radius: 20px;

        padding: 6px 14px;

        display: flex;

        align-items: center;

        gap: 8px;

        backdrop-filter: blur(10px);

        border: 1px solid rgba(255, 255, 255, 0.2);

        transition: all 0.3s ease;

        color: white;

        font-size: 0.85rem;

        font-weight: 500;

        min-width: 100px;

        justify-content: center;

    }



    .pinned-timezone-inline-item:hover {

        background: rgba(255, 255, 255, 0.25);

        transform: translateY(-1px);

        box-shadow: 0 4px 12px rgba(0,0,0,0.15);

    }



    .pinned-timezone-inline-flag {

        font-size: 0.9rem;

    }



    .pinned-timezone-inline-info {

        display: flex;

        flex-direction: column;

        align-items: center;

        line-height: 1.1;

    }



    .pinned-timezone-inline-info .city {

        font-size: 0.75rem;

        margin: 0;

        opacity: 0.9;

    }



    .pinned-timezone-inline-info .time {

        font-size: 0.8rem;

        font-weight: 600;

        margin: 0;

    }



    /* Responsive adjustments */

    @media (max-width: 768px) {

        .pinned-timezones-inline {

            display: none; /* Hide on mobile to save space */

        }

    }

    /* Sidebar Scrollbar Styles */
    .l-navbar .nav {
        height: 100vh;
        overflow-y: auto;
        padding-bottom: 60px; /* Space for logout button */
    }

    .l-navbar .nav_list {
        max-height: calc(100vh - 120px); /* Account for header and logout button */
        overflow-y: auto;
        padding-right: 5px;
    }

    /* Custom Scrollbar for Webkit browsers */
    .l-navbar .nav_list::-webkit-scrollbar {
        width: 6px;
    }

    .l-navbar .nav_list::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    .l-navbar .nav_list::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
        transition: background 0.3s ease;
    }

    .l-navbar .nav_list::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Firefox scrollbar */
    .l-navbar .nav_list {
        scrollbar-width: thin;
        scrollbar-color: rgba(255, 255, 255, 0.3) rgba(255, 255, 255, 0.1);
    }

    /* Ensure logout button stays at bottom */
    .l-navbar .nav {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .l-navbar .nav_list {
        flex: 1;
        overflow-y: auto;
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
            <!-- Pinned Timezones - Inline with header controls -->
            <div id="pinned-timezones-inline" class="pinned-timezones-inline"></div>

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
        <nav class="nav">
            <div class="nav_list"> 
                <!-- Dashboard -->
                <a href="<?php echo e(route('user.dashboard')); ?>" class="nav_link <?php echo e(request()->routeIs('user.dashboard') ? 'active' : ''); ?>"> 
                    <i class='bx bx-grid-alt nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Dashboard</span> 
                </a> 

                <!-- Calendar -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-calendar nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5 0M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Calendar</span> 
                </a>

                <!-- Contacts (Clients module) -->
                <a href="<?php echo e(route('client.management')); ?>" class="nav_link <?php echo e(request()->routeIs('client.management') ? 'active' : ''); ?>"> 
                    <i class='bx bx-user-plus nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Contacts</span> 
                </a> 

                <!-- Legislation -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-book nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
                            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Legislation</span> 
                </a>

                <!-- CaseLaw -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-library nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-bookmark" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8"/>
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">CaseLaw</span> 
                </a>

                <!-- My Notes & Annotations -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-note nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                            <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">My Notes & Annotations</span> 
                </a>

                <!-- Templates -->
                <a href="<?php echo e(route('templates.select-client')); ?>" class="nav_link <?php echo e(request()->routeIs('templates.select-client') || request()->routeIs('templates.index') || request()->routeIs('templates.edit') ? 'active' : ''); ?>"> 
                    <i class='bx bx-message-square-detail nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Templates</span> 
                </a> 

                <!-- Resources -->
                <a href="<?php echo e(route('user.government-links')); ?>" class="nav_link <?php echo e(request()->routeIs('user.government-links*') ? 'active' : ''); ?>"> 
                    <i class='bx bx-bookmark nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Resources</span>
                </a> 

                <!-- Immigration Programs -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-globe nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-globe" viewBox="0 0 16 16">
                            <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Immigration Programs</span> 
                </a>

                <!-- Immigration Calculators -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-calculator nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calculator" viewBox="0 0 16 16">
                            <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                            <path d="M4 2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                            <path d="M7.5 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Immigration Calculators</span> 
                </a>
                <!-- Finder tools -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-search nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Finder tools</span> 
                </a>

                <!-- Tools -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-wrench nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                            <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293L2.793 6.5 1.414 5.121A2 2 0 0 0 0 5.914v.586C0 7.333.667 8 1.5 8H4.5v-.5A2.5 2.5 0 0 1 7 5a2.5 2.5 0 0 1 2.449 2.022c-.023.004-.048.006-.072.009a1.5 1.5 0 0 0-1.121.773l-.5.83-.5-.83a1.5 1.5 0 0 0-1.122-.773L6.23 7a2.5 2.5 0 0 1 .771 2H15a1 1 0 0 1 1 1v.5a.5.5 0 0 1-.5.5h-2A1.5 1.5 0 0 1 12 9.5V9h-1v-.5A1.5 1.5 0 0 1 9.5 7H9v.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5V7h-.5A1.5 1.5 0 0 1 4 8.5V9H3v-.5A1.5 1.5 0 0 1 1.5 7H1z"/>
                            <path d="m5.433 2.304-.846-.762a.5.5 0 1 0-.672.748l.846.762a.5.5 0 1 0 .672-.748M9 6.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Tools</span> 
                </a>

                <!-- Events & News -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-news nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                            <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972a.54.54 0 0 1-.68.294A8.88 8.88 0 0 1 8.5 12.5a8.88 8.88 0 0 1-4.582 1.794.54.54 0 0 1-.68-.294A1.9 1.9 0 0 1 3 13.472V2.5z"/>
                            <path d="M1.5 2A.5.5 0 0 0 1 2.5v11.028c0 .2.032.352.071.479.04.132.096.262.134.391a9.9 9.9 0 0 0 4.795-1.814A9.9 9.9 0 0 0 13 14.5V2.5a.5.5 0 0 0-.5-.5z"/>
                            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5M10 8.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0 2.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Events & News</span> 
                </a>

                <!-- Settings -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-cog nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492M5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Settings</span> 
                </a>

                <!-- Subscription -->
                <a href="<?php echo e(route('payment.details')); ?>" class="nav_link <?php echo e(request()->routeIs('payment.details') ? 'active' : ''); ?>"> 
                    <i class='bx bx-bar-chart-alt-2 nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Subscription</span>
                </a>

                <!-- Refer a Friend -->
                <a href="#" class="nav_link"> 
                    <i class='bx bx-user-plus nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Refer a Friend</span> 
                </a>

                <!-- Profile Details -->
                <a href="<?php echo e(route('profile.edit')); ?>" class="nav_link <?php echo e(request()->routeIs('profile.edit') ? 'active' : ''); ?>"> 
                    <i class='bx bx-user nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Profile Details</span>
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
                <span class="nav_name">Sign Out</span>
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
    // Theme functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Theme elements
        const themeToggle = document.getElementById('theme-toggle');
        const themePanel = document.getElementById('theme-panel');
        const themeBtns = document.querySelectorAll('.theme-btn');
        
        // Theme switcher toggle
        themeToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            themePanel.classList.toggle('hidden');
        });
        
        // Close panels when clicking outside
        document.addEventListener('click', function(e) {
            if (!themePanel.contains(e.target) && !themeToggle.contains(e.target)) {
                themePanel.classList.add('hidden');
            }
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
        const savedTheme = localStorage.getItem('selectedTheme') || 'default';
        
        // Initialize inline pinned timezones functionality
        function updateHeaderWorldClock() {
            const pinnedTimezones = JSON.parse(localStorage.getItem('pinnedTimezones') || '[]');
            const inlineContainer = document.getElementById('pinned-timezones-inline');
            
            // Clear the inline container
            inlineContainer.innerHTML = '';
            
            if (pinnedTimezones.length === 0) {
                // Hide the container when no timezones are pinned
                inlineContainer.style.display = 'none';
                return;
            }
            
            // Show the container when there are pinned timezones
            inlineContainer.style.display = 'flex';
            
            pinnedTimezones.forEach(timezoneData => {
                const now = new Date();
                const timeString = now.toLocaleString('en-US', { 
                    timeZone: timezoneData.timezone,
                    hour12: true,
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                const cityName = timezoneData.name.split('(')[0].trim();
                
                // Create inline header item
                const inlineItem = document.createElement('div');
                inlineItem.className = 'pinned-timezone-inline-item';
                inlineItem.innerHTML = `
                    <div class="pinned-timezone-inline-flag">${timezoneData.flag}</div>
                    <div class="pinned-timezone-inline-info">
                        <p class="city">${cityName}</p>
                        <p class="time">${timeString}</p>
                    </div>
                `;
                inlineContainer.appendChild(inlineItem);
            });
        }
        
        // Update inline pinned timezones every minute
        setInterval(updateHeaderWorldClock, 60000);
        
        // Listen for pinned timezone updates from tools page
        window.addEventListener('pinnedTimezonesUpdated', function(e) {
            updateHeaderWorldClock();
        });
        
        // Initial load
        updateHeaderWorldClock();        
        // Apply saved theme
        document.body.classList.add('theme-' + savedTheme);
        updateActiveTheme(savedTheme);
        
        // Notification functionality
        const notificationBtn = document.getElementById('notification-toggle');
        if (notificationBtn) {
            notificationBtn.addEventListener('click', function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Notifications',
                        html: `
                            <div style="text-align: left;">
                                <p><strong>• New deadline reminder</strong><br><small>RCIC deadline in 3 days</small></p>
                                <p><strong>• Template updated</strong><br><small>Legal template has been modified</small></p>
                                <p><strong>• System maintenance</strong><br><small>Scheduled for tonight at 2 AM</small></p>
                            </div>
                        `,
                        showConfirmButton: true,
                        confirmButtonText: 'Mark as Read'
                    });
                }
            });
        }
    });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\User\Desktop\13\jurislocator_laravel\resources\views/layouts/user-layout.blade.php ENDPATH**/ ?>