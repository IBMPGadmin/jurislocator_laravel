<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home | Mantis Bootstrap 5 Admin Template</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework.">
  <meta name="keywords" content="Mantis, Dashboard, Admin Template">
  <meta name="author" content="CodedThemes">
  <link rel="icon" href="<?php echo e(asset('admin_assets/images/favicon.svg')); ?>" type="image/x-icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
  <link rel="stylesheet" href="<?php echo e(asset('admin_assets/fonts/tabler-icons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin_assets/fonts/feather.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin_assets/fonts/fontawesome.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin_assets/fonts/material.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin_assets/css/style.css')); ?>" id="main-style-link">
  <link rel="stylesheet" href="<?php echo e(asset('admin_assets/css/style-preset.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admin/texteditor/assets/css/form_styles.css')); ?>">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="<?php echo e(asset('tinymce/tinymce.min.js')); ?>"></script>
    <!-- Custom Pagination Styles -->
  <style>
    .pagination {
      display: flex;
      justify-content: center;
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .pagination .page-item {
      margin: 0 3px;
    }
    .pagination .page-link {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 36px;
      height: 36px;
      padding: 6px 12px;
      text-decoration: none;
      border-radius: 4px;
      color: #444;
      background-color: #f5f5f5;
      border: 1px solid #ddd;
      transition: all 0.2s ease;
    }
    .pagination .page-item.active .page-link {
      background-color: #4680ff;
      color: white;
      border: 1px solid #4680ff;
      box-shadow: 0 2px 6px rgba(70, 128, 255, 0.2);
    }
    .pagination .page-item.disabled .page-link {
      color: #aaa;
      background-color: #f5f5f5;
      cursor: not-allowed;
      opacity: 0.6;
    }
    .pagination .page-link:hover:not(.disabled) {
      background-color: #e9ecef;
      border-color: #d0d0d0;
      z-index: 2;
    }
    .pagination .page-link:focus {
      box-shadow: 0 0 0 0.2rem rgba(70, 128, 255, 0.25);
      z-index: 3;
    }
  </style>
</head>
<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
<style>.img-fluid { max-width: 100%; height: 50px !important; }</style>
<!-- Pre-loader -->
<div class="loader-bg"><div class="loader-track"><div class="loader-fill"></div></div></div>
<!-- Sidebar -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="<?php echo e(url('/admin-dashboard')); ?>" class="b-brand text-primary">
        <img src="/admin_assets/images/jurislocator-logo.png" class="img-fluid logo-lg" alt="logo">
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">        
        <li class="pc-item">
          <a href="<?php echo e(route('admin.dashboard')); ?>" class="pc-link">
            <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
            <span class="pc-mtext">Dashboard</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#" class="pc-link"><span class="pc-micon"><i class="ti ti-users"></i></span><span class="pc-mtext">Users</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="/admin/users/add"><i class="ti ti-user-plus me-2"></i>Add new Users</a></li>
            <li class="pc-item"><a class="pc-link" href="/admin/users"><i class="ti ti-list me-2"></i>All Users</a></li>
          </ul>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#" class="pc-link"><span class="pc-micon"><i class="ti ti-file-text"></i></span><span class="pc-mtext">Legal Documents</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="/admin/legal-documents/add/standard"><i class="ti ti-file-plus me-2"></i>Add Legal Documents (Standard Process)</a></li>
            <li class="pc-item"><a class="pc-link" href="/admin/legal-documents/add/alternative"><i class="ti ti-upload me-2"></i>Add Legal Documents (Alternative Process)</a></li>
            <li class="pc-item"><a class="pc-link" href="#"><i class="ti ti-files me-2"></i>All Legal Documents</a></li>
            <li class="pc-item"><a class="pc-link" href="#"><i class="ti ti-forms me-2"></i>Add Forms & Schedule</a></li>
          </ul>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#" class="pc-link"><span class="pc-micon"><i class="ti ti-link"></i></span><span class="pc-mtext">Resource pages</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.government-links.index')); ?>"><i class="ti ti-building-bank me-2"></i>Government Links</a></li>
            <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.rcic-deadlines.index')); ?>"><i class="ti ti-calendar-event me-2"></i>RCIC Deadlines</a></li>
            <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.legal-key-terms.index')); ?>"><i class="ti ti-vocabulary me-2"></i>Legal key terms</a></li>
          </ul>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#" class="pc-link"><span class="pc-micon"><i class="ti ti-report"></i></span><span class="pc-mtext">All Reports</span><span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>          <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.payments.index')); ?>"><i class="ti ti-receipt me-2"></i>Payment Dashboard</a></li>
            <li class="pc-item"><a class="pc-link" href="<?php echo e(route('admin.reports.users')); ?>"><i class="ti ti-user-search me-2"></i>Users Report</a></li>
          </ul>
        </li>
        <li class="pc-item">
          <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();" class="pc-link">
            <span class="pc-micon"><i class="ti ti-logout"></i></span>
            <span class="pc-mtext">Logout</span>
          </a>
          <form id="sidebar-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Header -->
<header class="pc-header">
  <div class="header-wrapper">
    <div class="me-auto pc-mob-drp">
      <ul class="list-unstyled">
        <li class="pc-h-item pc-sidebar-collapse"><a href="#" class="pc-head-link ms-0" id="sidebar-hide"><i class="ti ti-menu-2"></i></a></li>
        <li class="pc-h-item pc-sidebar-popup"><a href="#" class="pc-head-link ms-0" id="mobile-collapse"><i class="ti ti-menu-2"></i></a></li>
        <li class="pc-h-item d-none d-md-inline-flex">
          <form class="header-search"><i data-feather="search" class="icon-search"></i><input type="search" class="form-control" placeholder="Search here..."></form>
        </li>
      </ul>
    </div>    <div class="ms-auto">
      <ul class="list-unstyled">
        <li class="pc-h-item">
          <a href="<?php echo e(route('logout')); ?>" class="pc-head-link me-2 btn btn-danger btn-sm text-white" onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();">
            <i class="ti ti-logout me-1"></i> Logout
          </a>
          <form id="header-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
        </li>
        <li class="dropdown pc-h-item header-user-profile">
          <a class="pc-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
            <span><?php echo e(Auth::user()->name ?? 'Admin'); ?></span>
          </a>
          <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
            <div class="dropdown-header">
              <div class="d-flex mb-1">
                <div class="flex-grow-1 ms-3">
                  <h6 class="mb-1"><?php echo e(Auth::user()->name ?? 'Admin'); ?></h6>
                  <span>Admin</span>
                </div>
                <a href="<?php echo e(route('logout')); ?>" class="pc-head-link bg-transparent" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti ti-power text-danger"></i></a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
              </div>
            </div>
            <ul class="nav drp-tabs nav-fill nav-tabs">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="drp-t1" data-bs-toggle="tab" data-bs-target="#drp-tab-1" type="button" role="tab"><i class="ti ti-user"></i> Profile</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="drp-t2" data-bs-toggle="tab" data-bs-target="#drp-tab-2" type="button" role="tab"><i class="ti ti-settings"></i> Setting</button>
              </li>
            </ul>            <div class="tab-content">
              <div class="tab-pane fade show active" id="drp-tab-1">
                <a href="#" class="dropdown-item"><i class="ti ti-edit-circle me-2"></i><span>Edit Profile</span></a>
                <a href="#" class="dropdown-item"><i class="ti ti-user me-2"></i><span>View Profile</span></a>
                <a href="#" class="dropdown-item"><i class="ti ti-wallet me-2"></i><span>Billing</span></a>
                <a href="<?php echo e(route('logout')); ?>" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ti ti-logout me-2"></i><span>Logout</span></a>
              </div>
              <div class="tab-pane fade" id="drp-tab-2">
                <a href="#" class="dropdown-item"><i class="ti ti-help me-2"></i><span>Support</span></a>
                <a href="#" class="dropdown-item"><i class="ti ti-lock me-2"></i><span>Privacy Center</span></a>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</header>
<div class="pc-container">
    <div class="pc-content">
        <?php echo $__env->yieldContent('admin-content'); ?>
    </div>
</div>
<!-- [ Main Content ] end -->
<footer class="pc-footer">
  <div class="footer-wrapper container-fluid">
    <div class="row">
      <div class="col-sm my-1">
        <p class="m-0">crafted by Team <a href="#" target="_blank">Jurislocator</a></p>
      </div>
    </div>
  </div>
</footer>

<!-- Required Js -->
<script src="<?php echo e(asset('admin_assets/js/plugins/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/plugins/simplebar.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/plugins/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/fonts/custom-font.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/pcoded.js')); ?>"></script>
<script src="<?php echo e(asset('admin_assets/js/plugins/feather.min.js')); ?>"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>

<script>layout_change('light');</script>
<script>change_box_container('false');</script>
<script>layout_rtl_change('false');</script>
<script>preset_change("preset-1");</script>
<script>font_change("Public-Sans");</script>
</body>
</html>
<?php /**PATH C:\Users\Dileesha\Desktop\j.v1-main\resources\views/layouts/admin.blade.php ENDPATH**/ ?>