<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo isset($title) ? $title : 'Dashboard Pelanggan'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    :root {
      --primary-red: #b30000;
      --dark-red: #800000;
      --light-red: #dc3545;
      --accent-red: #ff4444;
      --text-dark: #2c3e50;
      --bg-light: #f8f9fa;
      --shadow: 0 4px 15px rgba(0,0,0,0.08);
      --shadow-hover: 0 8px 25px rgba(179,0,0,0.15);
      --bottom-nav-height: 70px; /* tinggi bottom nav default */
    }
    body, table, input, button, .navbar, .content {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
      font-size: 11pt !important;
      line-height: 1.6;
    }
    body { 
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); 
      color: var(--text-dark); 
      min-height: 100vh; 
      display: flex; 
      flex-direction: column; 
    }
    .navbar { 
      background: linear-gradient(135deg, var(--dark-red) 0%, var(--primary-red) 100%); 
      color: #fff !important; 
      box-shadow: var(--shadow); 
      backdrop-filter: blur(10px); 
      padding: 1rem 0; 
    }
    .navbar .navbar-brand { 
      color: #fff !important; 
      font-weight: 700; 
      font-size: 1.4rem; 
      display: flex; 
      align-items: center; 
      transition: all 0.3s ease; 
    }
    .navbar .navbar-brand:hover { transform: scale(1.05); }
    .navbar .navbar-brand i { margin-right: 8px; font-size: 1.6rem; }
    .navbar .btn-danger { 
      background: rgba(255,255,255,0.15); 
      border: 1px solid rgba(255,255,255,0.2); 
      color: white; 
      font-weight: 500; 
      border-radius: 25px; 
      font-size: 10pt; 
      padding: 8px 16px; 
      transition: all 0.3s ease; 
      backdrop-filter: blur(10px); 
      display: flex; 
      align-items: center; 
      gap: 5px; 
    }
    .navbar .btn-danger:hover { 
      background: rgba(255,255,255,0.25); 
      transform: translateY(-2px); 
      color: white; 
      box-shadow: 0 5px 15px rgba(0,0,0,0.2); 
    }
    .user-greeting { 
      color: rgba(255,255,255,0.9); 
      font-weight: 600; 
      font-size: 0.95rem; 
      margin-right: 15px; 
    }

    main.container { 
      padding-top: 2rem; 
      flex: 1; 
      max-width: 1200px; 
      padding-bottom: calc(var(--bottom-nav-height) + 30px); /* otomatis sesuai tinggi bottom nav */
    }

    .card { 
      border-radius: 15px; 
      margin-bottom: 1.5rem; 
      box-shadow: var(--shadow); 
      border: none; 
      overflow: hidden; 
      transition: all 0.3s ease; 
      background: linear-gradient(135deg, white 0%, #f8f9fa 100%); 
    }
    .card:hover { transform: translateY(-3px); box-shadow: var(--shadow-hover); }
    .card-header { 
      background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%) !important; 
      color: #fff !important; 
      font-weight: 600; 
      font-size: 1.1rem; 
      padding: 1.2rem 1.5rem; 
      border: none; 
      display: flex; 
      align-items: center; 
      gap: 10px; 
    }
    .card-body { padding: 1.5rem; }

    .alert { 
      border-radius: 12px; 
      border: none; 
      box-shadow: var(--shadow); 
      margin-bottom: 1.5rem; 
      padding: 1rem 1.5rem; 
      display: flex; 
      align-items: center; 
      gap: 10px; 
    }
    .alert-success { background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%); color: #155724; }
    .alert-danger { background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%); color: #721c24; }
    .alert i { font-size: 1.2rem; }

    /* Responsive */
    @media (max-width: 768px) { 
      main.container { padding: 1.5rem 1rem; padding-bottom: calc(var(--bottom-nav-height) + 40px); }
      .user-greeting { display: none; } 
    }
    @media (max-width: 576px) { 
      main.container { padding: 1rem 0.5rem; } 
    }
    body {
      padding-bottom: 70px; /* biar konten ga ketutup bottom nav */
    }

    /* Bottom Navigation - Merah gradasi + hover */
    .bottom-nav {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      height: 65px;
      background: linear-gradient(135deg, #800000 0%, #b30000 100%);
      display: flex;
      justify-content: space-around;
      align-items: center;
      box-shadow: 0 -2px 15px rgba(0,0,0,0.15);
      z-index: 1000;
      backdrop-filter: blur(10px);
    }
    .bottom-nav .nav-item.active {
  background: rgba(255,255,255,0.15);
  border-top: 2px solid #fff;
  font-weight: bold;
}


    .bottom-nav .nav-item {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-decoration: none;
      color: rgba(255,255,255,0.8);
      transition: all 0.3s ease;
      padding: 6px 8px;
      border-radius: 10px;
      min-width: 50px;
      text-align: center;
    }

    .bottom-nav .nav-item:hover,
    .bottom-nav .nav-item.active {
      color: #fff;
      background: rgba(255,255,255,0.15);
      transform: translateY(-2px);
      text-decoration: none;
    }

    .bottom-nav .nav-item i {
      font-size: 1.1rem;
      margin-bottom: 3px;
    }

    .bottom-nav .nav-item span {
      font-size: 0.7rem;
      font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 576px) {
      .bottom-nav {
        height: 55px;
      }
      .bottom-nav .nav-item {
        padding: 4px 6px;
        min-width: 40px;
      }
      .bottom-nav .nav-item i {
        font-size: 0.95rem;
      }
      .bottom-nav .nav-item span {
        font-size: 0.6rem;
      }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark px-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url('pelanggan/dashboard'); ?>">
      <img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Pang5Net" height="40">
    </a>
    <?php 
    // Ambil data info layanan sekali di layout
    $CI =& get_instance();
    $CI->load->model('LayananModel');
    $infoLayanan = $CI->LayananModel->getFirst();

    // Pastikan variabel tidak null
    $waLink = isset($infoLayanan['wa_cs']) ? $infoLayanan['wa_cs'] : '#';
    ?>

    <div class="ms-auto d-flex align-items-center">
      <?php if($this->session->userdata('isLoggedIn')): ?>
        <span class="user-greeting">
          Hi, <?php echo $this->session->userdata('nama'); ?>
        </span>
        <a href="<?php echo base_url('logout'); ?>" class="btn btn-outline-light btn-sm">
          <i class="fas fa-sign-out-alt me-1"></i>
          Logout
        </a>
      <?php endif; ?>
      
    </div>
  </div>
</nav>

<!-- Content -->
<main class="container">
  <?php if($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
      <i class="fas fa-exclamation-circle"></i>
      <?php echo $this->session->flashdata('error'); ?>
    </div>
  <?php endif; ?>
  
  <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i>
      <?php echo $this->session->flashdata('success'); ?>
    </div>
  <?php endif; ?>

  <!-- Content Section -->
  <?php if(isset($content)) echo $content; ?>
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Auto-hide alerts after 5s
  setTimeout(() => {
    document.querySelectorAll('.alert').forEach(a => {
      a.style.transition = 'all 0.3s ease';
      a.style.opacity = 0;
      setTimeout(() => a.remove(), 300);
    });
  }, 5000);
      // Biar nav yang sesuai halaman aktif
      document.addEventListener('DOMContentLoaded', function() {
      const currentPath = window.location.pathname;
      document.querySelectorAll('.bottom-nav .nav-item').forEach(item => {
        if (item.getAttribute('href') === currentPath) {
          item.classList.add('active');
        }
      });
    });
</script>
<!-- Bottom Navigation (Mobile) -->
<div class="bottom-nav">
  <a href="<?= $waLink ?>" target="_blank" class="nav-item">
    <i class="fas fa-headset"></i>
    <span>Bantuan</span>
  </a>
  <a href="<?= esc($infoLayanan['youtube']) ?>" target="_blank" class="nav-item">
    <i class="fab fa-youtube"></i>
    <span>Tutorial</span>
  </a>
  <a href="<?= site_url('pelanggan/dashboard') ?>" class="nav-item <?= ($activePage=='dashboard')?'active':'' ?>">
    <i class="fas fa-home"></i>
    <span>Home</span>
  </a>
  <a href="<?= site_url('pelanggan/speedtest') ?>" class="nav-item <?= ($activePage=='speedtest')?'active':'' ?>">
    <i class="fas fa-tachometer-alt"></i>
    <span>Speedtest</span>
  </a>
  <a href="<?= site_url('pelanggan/profile') ?>" class="nav-item <?= ($activePage=='profile')?'active':'' ?>">
    <i class="fas fa-user-cog"></i>
    <span>Profil</span>
  </a>
</div>
</body>
</html>
