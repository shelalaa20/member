<!DOCTYPE html>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= isset($title) ? $title : 'Admin Panel' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* Base Typography */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, table, input, button, .navbar, .sidebar, .content {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
    }

    body {
      font-size: 14px !important;
      background: #f5f6fa;
      color: #2c3e50;
      line-height: 1.6;
      overflow-x: hidden;
    }

    /* Navbar - Fixed Top */
    .navbar {
      background: linear-gradient(135deg, #b30000 0%, #8b0000 100%);
      color: #fff !important;
      box-shadow: 0 2px 12px rgba(179, 0, 0, 0.2);
      padding: 0.875rem 1.25rem;
      height: 70px;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1040;
      backdrop-filter: blur(10px);
    }
    
    .navbar .navbar-brand {
      color: #fff !important;
      font-weight: 700;
      font-size: 1.3rem;
      display: flex;
      align-items: center;
      text-decoration: none;
      letter-spacing: -0.5px;
    }
    
    .navbar .navbar-brand:hover {
      color: #ffeaa7 !important;
      transform: scale(1.02);
      transition: all 0.3s ease;
    }
    
    .navbar .navbar-brand img {
      height: 42px;
      width: auto;
      margin-right: 12px;
      object-fit: contain;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }
    
    .navbar .btn-outline-light {
      border: 2px solid rgba(255,255,255,0.3);
      color: #fff;
      font-size: 0.9rem;
      font-weight: 600;
      padding: 0.5rem 1.25rem;
      border-radius: 25px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      backdrop-filter: blur(10px);
    }
    
    .navbar .btn-outline-light:hover {
      background: rgba(255,255,255,0.15);
      border-color: #fff;
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(255,255,255,0.2);
    }

    .navbar-text {
      color: rgba(255,255,255,0.95) !important;
      font-size: 0.95rem;
      font-weight: 500;
      display: flex;
      align-items: center;
    }

    /* Sidebar - Fixed Position with Better Styling */
    .sidebar {
      position: fixed;
      top: 70px;
      left: 0;
      width: 280px;
      height: calc(100vh - 70px);
      background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
      color: #fff;
      overflow-y: auto;
      overflow-x: hidden;
      z-index: 1030;
      box-shadow: 4px 0 20px rgba(0,0,0,0.1);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-header {
      padding: 1.75rem 1.25rem 1.25rem;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      text-align: center;
      background: rgba(0,0,0,0.1);
    }

    .sidebar-header h6 {
      color: rgba(255,255,255,0.8);
      font-size: 0.8rem;
      margin: 0;
      letter-spacing: 2px;
      text-transform: uppercase;
      font-weight: 600;
    }
    
    .sidebar-nav {
      padding: 1.5rem 0;
    }

    .sidebar a {
      color: rgba(255,255,255,0.85);
      text-decoration: none;
      display: flex;
      align-items: center;
      padding: 1rem 1.75rem;
      position: relative;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-size: 0.95rem;
      font-weight: 500;
      margin: 0.25rem 1rem;
      border-radius: 12px;
      border-left: 4px solid transparent;
    }
    
    .sidebar a:hover {
      background: linear-gradient(135deg, rgba(179,0,0,0.2), rgba(179,0,0,0.1));
      color: #fff;
      border-left-color: #b30000;
      transform: translateX(8px);
      box-shadow: 0 4px 15px rgba(179,0,0,0.2);
    }
    
    .sidebar a.active {
      background: linear-gradient(135deg, rgba(179,0,0,0.25), rgba(179,0,0,0.15));
      color: #fff;
      border-left-color: #b30000;
      box-shadow: 0 4px 20px rgba(179,0,0,0.3);
      transform: translateX(4px);
    }

    .sidebar a.active::before {
      content: "";
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      width: 6px;
      height: 6px;
      background: #b30000;
      border-radius: 50%;
      box-shadow: 0 0 10px rgba(179,0,0,0.6);
    }
    
    .sidebar a i {
      margin-right: 15px;
      width: 20px;
      text-align: center;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }
    
    .sidebar a:hover i {
      transform: scale(1.15);
      color: #ff6b6b;
    }

    .sidebar a.active i {
      color: #ff6b6b;
      text-shadow: 0 0 10px rgba(255,107,107,0.4);
    }

    /* Content Area - Adjusted for Fixed Sidebar */
    .content {
      margin-left: 280px;
      margin-top: 70px;
      padding: 2rem;
      min-height: calc(100vh - 70px);
      background: #f5f6fa;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Cards - Modern Design */
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
      backdrop-filter: blur(10px);
      background: rgba(255,255,255,0.95);
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }

    .card-header {
      background: linear-gradient(135deg, #b30000 0%, #8b0000 100%) !important;
      color: #fff !important;
      font-weight: 700;
      font-size: 1.05rem;
      border-radius: 16px 16px 0 0 !important;
      padding: 1.25rem 1.5rem;
      border: none;
      letter-spacing: 0.5px;
      position: relative;
      overflow: hidden;
    }

    .card-header::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.5s;
    }

    .card:hover .card-header::before {
      left: 100%;
    }

    .card-body {
      padding: 2rem 1.5rem;
      background: #fff;
    }

    .dashboard-card {
      cursor: pointer;
      border: 2px solid transparent;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dashboard-card:hover {
      transform: translateY(-6px) scale(1.02);
      border-color: rgba(179,0,0,0.2);
      box-shadow: 0 15px 50px rgba(179,0,0,0.2) !important;
    }

    /* Tables - Enhanced Styling */
    .table {
      font-size: 0.9rem;
      margin-bottom: 0;
      border-collapse: collapse !important;
      border-spacing: 0;
    }
    
    .table thead {
  background: linear-gradient(135deg, rgba(44,62,80,0.6), rgba(52,73,94,0.6)) !important;
}

.table thead th {
  background: transparent !important; /* ✅ biar gak kotak-kotak */
  color: #fff !important;
}

    
    .table thead th {
      border: none;
      font-weight: 700;
      font-size: 0.85rem;
      text-transform: uppercase;
      letter-spacing: 1px;
      padding: 1.25rem 1rem;
      position: relative;
    }

    .table thead th:first-child,
.table thead th:last-child {
  border-radius: 0 !important; /* ✅ sudut lurus */
}
    
    .table td, .table tbody th {
      vertical-align: middle;
      padding: 1rem;
      border-color: rgba(0,0,0,0.06);
      background: #fff;
      transition: all 0.3s ease;
    }

    .table tbody tr:hover td {
      background: #f8f9ff;
      transform: scale(1.01);
    }
    
    .table-responsive {
  border-radius: 0 !important; /* ✅ hilangin lengkung */
  box-shadow: none !important; /* ✅ hilangin shadow */
}

    /* Buttons - Enhanced Design */
    .btn {
      font-size: 0.9rem !important;
      padding: 0.625rem 1.25rem !important;
      border-radius: 8px !important;
      font-weight: 600 !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
      letter-spacing: 0.5px;
      position: relative;
      overflow: hidden;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      background: rgba(255,255,255,0.2);
      border-radius: 50%;
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .btn:hover::before {
      width: 300px;
      height: 300px;
    }

    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }

    .btn-sm {
      padding: 0.5rem 1rem !important;
      font-size: 0.85rem !important;
      border-radius: 6px !important;
    }

    .btn-xs {
  padding: 0.25rem 0.6rem !important;
  font-size: 0.75rem !important;
  border-radius: 4px !important;
}


    /* Alerts - Modern Design */
    .alert {
      border: none;
      border-radius: 12px;
      font-size: 0.95rem;
      padding: 1.25rem 1.5rem;
      border-left: 4px solid;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      backdrop-filter: blur(10px);
    }

    .alert-success {
      background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
      border-left-color: #28a745;
      color: #155724;
    }

    .alert-danger {
      background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
      border-left-color: #dc3545;
      color: #721c24;
    }

    /* Responsive Design - Enhanced */
    @media (max-width: 1400px) {
      .sidebar {
        width: 260px;
      }
      
      .content {
        margin-left: 260px;
        padding: 1.75rem;
      }
    }

    @media (max-width: 1200px) {
      .content {
        padding: 1.5rem;
      }
    }

    @media (max-width: 992px) {
      .sidebar {
        transform: translateX(-100%);
        width: 280px;
      }
      
      .sidebar.show {
        transform: translateX(0);
      }

      .content {
        margin-left: 0;
        padding: 1.25rem;
      }

      .navbar .btn-outline-light {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
      }
    }

    @media (max-width: 768px) {
      .navbar {
        height: 65px;
        padding: 0.75rem 1rem;
      }

      .sidebar {
        top: 65px;
        height: calc(100vh - 65px);
        width: 280px;
      }

      .content {
        margin-top: 65px;
        padding: 1rem;
      }

      .navbar .navbar-brand {
        font-size: 1.2rem;
      }

      .navbar .navbar-brand img {
        height: 36px;
        margin-right: 10px;
      }

      .card-body {
        padding: 1.5rem 1rem;
      }

      .table {
        font-size: 0.85rem;
      }
    }

    @media (max-width: 576px) {
      .content {
        padding: 0.75rem;
      }

      .navbar .navbar-brand {
        font-size: 1.1rem;
      }

      .navbar .navbar-brand img {
        height: 32px;
        margin-right: 8px;
      }

      .sidebar {
        width: 260px;
      }

      .card-header {
        padding: 1rem 1.25rem;
        font-size: 1rem;
      }

      .card-body {
        padding: 1.25rem;
      }
    }

    /* Loading States */
    .loading {
      opacity: 0.7;
      pointer-events: none;
      position: relative;
    }

    .loading::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 20px;
      height: 20px;
      margin: -10px 0 0 -10px;
      border: 2px solid #f3f3f3;
      border-top: 2px solid #b30000;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Custom Scrollbar - Enhanced */
    .sidebar::-webkit-scrollbar {
      width: 8px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.1);
      border-radius: 4px;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: linear-gradient(180deg, rgba(179,0,0,0.6), rgba(179,0,0,0.4));
      border-radius: 4px;
      transition: all 0.3s ease;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(180deg, rgba(179,0,0,0.8), rgba(179,0,0,0.6));
      box-shadow: 0 0 10px rgba(179,0,0,0.4);
    }

    /* Smooth Animations */
    * {
      scroll-behavior: smooth;
    }

    /* Focus States */
    .btn:focus,
    .sidebar a:focus {
      outline: 2px solid rgba(179,0,0,0.5);
      outline-offset: 2px;
    }

    /* Backdrop for Mobile */
    .sidebar-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1020;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      backdrop-filter: blur(4px);
    }

    .sidebar-backdrop.show {
      opacity: 1;
      visibility: visible;
    }

    
  </style>

</head>
<body>

<!-- Navbar -->
<?php if(!isset($hideNavbar) || !$hideNavbar): ?>
<nav class="navbar navbar-dark">
  <div class="container-fluid">
    <button class="btn btn-outline-light d-lg-none" id="toggleSidebar">
      <i class="fas fa-bars"></i>
    </button>
    
    <!-- Logo + Brand -->
    <a class="navbar-brand ms-2" href="<?= base_url('admin/dashboard') ?>">
      <img src="<?= base_url('assets/img/logo.png') ?>" alt="Pang5Net">
      <span>Admin Panel</span>
    </a>

    <div class="ms-auto d-flex align-items-center">
  <?php if($this->session->userdata('role') === 'admin'): ?>
    <span class="navbar-text me-3 d-none d-lg-inline">
      <i class="fas fa-user-circle me-2"></i>
      Hi, <?= $this->session->userdata('nama') ?>
    </span>

    <a href="<?= base_url('logout') ?>" class="btn btn-outline-light d-none d-lg-inline">
      <i class="fas fa-sign-out-alt me-1"></i>
      Logout
    </a>
  <?php endif; ?>
</div>
  </div>
</nav>
<?php endif; ?>

<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop" id="sidebarBackdrop"></div>

<!-- Sidebar -->
<?php if(!isset($hideSidebar) || !$hideSidebar): ?>
<div class="sidebar" id="sidebarMenu">
  <div class="sidebar-header"></div>
  
  <div class="sidebar-nav">
    <a href="<?= base_url('admin/dashboard') ?>" class="<?= uri_string() === 'admin/dashboard' ? 'active' : '' ?>">
      <i class="fas fa-home"></i> 
      Dashboard
    </a>
    <a href="<?= base_url('admin/pelanggan') ?>" class="<?= uri_string() === 'admin/pelanggan' ? 'active' : '' ?>">
      <i class="fas fa-users"></i> 
      Pelanggan
    </a>
    <a href="<?= base_url('admin/banner') ?>" class="<?= uri_string() === 'admin/banner' ? 'active' : '' ?>">
      <i class="fas fa-image"></i> 
      Banner
    </a>
    <a href="<?= base_url('admin/layanan') ?>" class="<?= uri_string() === 'admin/layanan' ? 'active' : '' ?>">
      <i class="fas fa-cogs"></i> 
      Layanan
    </a>
    <a href="<?= base_url('admin/user') ?>" class="<?= uri_string() === 'admin/user' ? 'active' : '' ?>">
      <i class="fas fa-user-cog"></i> 
      Pengguna
    </a>
    <a href="<?= base_url('logout') ?>" class="d-lg-none">
      <i class="fas fa-sign-out-alt"></i>
      Logout
    </a>
  </div>
</div>
<?php endif; ?>
  
<!-- Content -->
<div class="content">
  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fas fa-exclamation-circle me-2"></i>
      <?= $this->session->flashdata('error') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>
  
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="fas fa-check-circle me-2"></i>
      <?= $this->session->flashdata('success') ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  <?php endif; ?>

  <?= isset($content) ? $content : '' ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Enhanced Sidebar Toggle
  const toggleButton = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebarMenu');
  const backdrop = document.getElementById('sidebarBackdrop');

  function toggleSidebar() {
    sidebar.classList.toggle('show');
    backdrop.classList.toggle('show');
    document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : 'auto';
  }

  function closeSidebar() {
    sidebar.classList.remove('show');
    backdrop.classList.remove('show');
    document.body.style.overflow = 'auto';
  }

  if (toggleButton) {
    toggleButton.addEventListener('click', toggleSidebar);
  }

  if (backdrop) {
    backdrop.addEventListener('click', closeSidebar);
  }

  // Close sidebar on window resize
  window.addEventListener('resize', function() {
    if (window.innerWidth >= 992) {
      closeSidebar();
    }
  });


  // Auto-dismiss alert kecuali di halaman pelanggan
  if (!window.location.href.includes('/admin/pelanggan')) {
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        if (alert.querySelector('.btn-close')) {
          const bsAlert = new bootstrap.Alert(alert);
          bsAlert.close();
        }
      });
    }, 6000); // 6 detik
  }


  // Enhanced form loading states
  document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function() {
      const submitBtn = form.querySelector('button[type="submit"]');
      if (submitBtn && !submitBtn.disabled) {
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
        
        // Reset button after 10 seconds as fallback
        setTimeout(() => {
          submitBtn.disabled = false;
          submitBtn.classList.remove('loading');
          submitBtn.innerHTML = originalText;
        }, 10000);
      }
    });
  });

  // Smooth scroll for internal links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });

  // Add loading animation to page navigation
  document.querySelectorAll('a:not([href^="#"]):not([href^="javascript:"]):not([target="_blank"])').forEach(link => {
    link.addEventListener('click', function() {
      // Add subtle loading indication
      this.style.opacity = '0.7';
      this.style.pointerEvents = 'none';
    });
  });

  // Keyboard shortcuts
  document.addEventListener('keydown', function(e) {
    // Alt + S to toggle sidebar on mobile
    if (e.altKey && e.key === 's' && window.innerWidth < 992) {
      e.preventDefault();
      toggleSidebar();
    }
    
    // Escape to close sidebar
    if (e.key === 'Escape' && sidebar.classList.contains('show')) {
      closeSidebar();
    }
  });

  // Add focus management for accessibility
  sidebar.addEventListener('transitionend', function() {
    if (this.classList.contains('show')) {
      // Focus first link when sidebar opens
      const firstLink = this.querySelector('a');
      if (firstLink) firstLink.focus();
    }
  });
</script>


</body>
</html>