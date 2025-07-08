<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'JurisLocator' }}</title>
    
    <!-- Custom meta tags -->
    @yield('meta')
    
    <!-- CSS Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('user_assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('user_assets/css/login_styles.css') }}">
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
    </style>
    
    @php
    // Add this for pages that use TinyMCE
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Set global JavaScript variable for client ID
    echo '<script>';
    echo 'window.selectedClientId = ' . (isset($_SESSION['selected_client_id']) ? $_SESSION['selected_client_id'] : 'null') . ';';
    echo '</script>';
    @endphp

    @stack('styles')
</head>
<body id="body-pd" class="gap_right_home">
    <header class="header gradient-background" id="header">
        <div class="logo">
            <img src="{{ asset('user_assets/img/jurislocator-logo.png') }}" alt="jurislocator" />
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
                <a href="{{ route('profile.edit') }}" title="Edit Profile">
                    @if(Auth::user() && Auth::user()->profile_image)
                        <img src="{{ asset(Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }}'s Profile" class="profile-header-img">
                    @else
                        <div class="profile-header-placeholder">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    @endif
                </a> 
            </div>
        </div>
    </header>
    
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">            <div class="nav_list"> 
                <a href="{{ route('user.dashboard') }}" class="nav_link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"> 
                    <i class='bx bx-grid-alt nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Dashboard</span> 
                </a> 

                <a href="{{ route('client.management') }}" class="nav_link {{ request()->routeIs('client.management') ? 'active' : '' }}"> 
                    <i class='bx bx-user-plus nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                            <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Client Management</span> 
                </a> 

                <a href="{{ route('templates.select-client') }}" class="nav_link {{ request()->routeIs('templates.select-client') || request()->routeIs('templates.index') || request()->routeIs('templates.edit') ? 'active' : '' }}"> 
                    <i class='bx bx-message-square-detail nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Templates</span> 
                </a> 

                <a href="{{ route('user.government-links') }}" class="nav_link {{ request()->routeIs('user.government-links*') ? 'active' : '' }}"> 
                    <i class='bx bx-bookmark nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5m8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Government Links</span>
                </a> 

                <a href="{{ route('user.rcic-deadlines.index') }}" class="nav_link"> 
                    <i class='bx bx-time nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5 0M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                        </svg>
                    </i>
                    <span class="nav_name">RCIC Deadlines</span>
                </a>

                <a href="{{ route('user.legal-key-terms.index') }}" class="nav_link"> 
                    <i class='bx bx-book nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-journal-text" viewBox="0 0 16 16">
                            <path d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2"/>
                            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z"/>
                        </svg>
                    </i>
                    <span class="nav_name">Legal Key Terms</span>
                </a> 

                <a href="{{ route('payment.details') }}" class="nav_link {{ request()->routeIs('payment.details') ? 'active' : '' }}"> 
                    <i class='bx bx-bar-chart-alt-2 nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                            <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm5 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1z"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Payment Details</span>
                </a>

          
                <a href="{{ route('profile.edit') }}" class="nav_link {{ request()->routeIs('profile.edit') ? 'active' : '' }}"> 
                    <i class='bx bx-user nav_icon'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                    </i> 
                    <span class="nav_name">Profile Details</span>
                </a> 

            </div>

            <a href="{{ route('logout') }}" 
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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <footer class="gap_footer footer">
        <div class="row container">
            <p>&copy;<a target="_blank" href="https://immifocus.ca">immigopro</a> {{ date("Y") }} - All Rights Reserved</p>
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
    <script src="{{ asset('user_assets/js/template-manager.js') }}"></script>
    <script src="{{ asset('user_assets/js/config.js') }}"></script>
    <script src="{{ asset('user_assets/js/script.js') }}"></script>
    <script src="{{ asset('user_assets/js/side_bar.js') }}"></script>
    <script src="{{ asset('user_assets/js/navigation.js') }}"></script>
    
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
    
    @stack('scripts')
</body>
</html>
