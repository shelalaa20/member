<!-- Page Header -->
<div class="page-header mb-4">
  <div class="d-flex justify-content-between align-items-center">
    <div>
      <h1 class="page-title">
        <i class="fas fa-tachometer-alt me-2"></i>
        Dashboard
      </h1>
      <p class="text-muted mb-0">Selamat datang di panel administrasi</p>
    </div>
    <div class="time-widget d-none d-md-block">
      <div class="text-end">
        <div class="fw-bold text-danger" id="currentTime"><?= date('H:i:s') ?></div>
        <small class="text-muted"><?= date('d M Y') ?> WIB</small>
      </div>
    </div>
  </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="stat-card bg-danger text-white">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0"><?= $totalPelanggan ?></h4>
          <small>Total Pelanggan</small>
        </div>
        <i class="fas fa-users fa-2x opacity-75"></i>
      </div>
    </div>
  </div>
  
  <div class="col-6 col-lg-3">
    <div class="stat-card bg-success text-white">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0"><?= $pelangganAktif ?></h4>
          <small>Pelanggan Aktif</small>
        </div>
        <i class="fas fa-user-check fa-2x opacity-75"></i>
      </div>
    </div>
  </div>
  
  <div class="col-6 col-lg-3">
    <div class="stat-card bg-warning text-white">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0"><?= $bannerAktif ?></h4>
          <small>Banner Aktif</small>
        </div>
        <i class="fas fa-images fa-2x opacity-75"></i>
      </div>
    </div>
  </div>
  
  <div class="col-6 col-lg-3">
    <div class="stat-card bg-info text-white">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <h4 class="mb-0"><?= $layananCount ?></h4>
          <small>Layanan Tersedia</small>
        </div>
        <i class="fas fa-cogs fa-2x opacity-75"></i>
      </div>
    </div>
  </div>
</div>

<!-- Menu Cards -->
<div class="row g-4">
  <div class="col-sm-6 col-lg-3">
    <div class="menu-card">
      <div class="card-body text-center">
        <div class="menu-icon text-danger mb-3">
          <i class="fas fa-users fa-3x"></i>
        </div>
        <h5 class="card-title">Data Pelanggan</h5>
        <p class="card-text text-muted">Kelola seluruh data pelanggan</p>
        <a href="<?= site_url('admin/pelanggan') ?>" class="btn btn-danger">
          Kelola Pelanggan
        </a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="menu-card">
      <div class="card-body text-center">
        <div class="menu-icon text-warning mb-3">
          <i class="fas fa-images fa-3x"></i>
        </div>
        <h5 class="card-title">Promosi & Banner</h5>
        <p class="card-text text-muted">Kelola banner promosi</p>
        <a href="<?= site_url('admin/banner') ?>" class="btn btn-warning">
          Kelola Banner
        </a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="menu-card">
      <div class="card-body text-center">
        <div class="menu-icon text-info mb-3">
          <i class="fas fa-cogs fa-3x"></i>
        </div>
        <h5 class="card-title">Info Layanan</h5>
        <p class="card-text text-muted">Kelola informasi layanan</p>
        <a href="<?= site_url('admin/layanan') ?>" class="btn btn-info">
          Kelola Layanan
        </a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="menu-card">
      <div class="card-body text-center">
        <div class="menu-icon text-secondary mb-3">
          <i class="fas fa-user-cog fa-3x"></i>
        </div>
        <h5 class="card-title">Kelola Pengguna</h5>
        <p class="card-text text-muted">Manajemen pengguna sistem</p>
        <a href="<?= site_url('admin/user') ?>" class="btn btn-secondary">
          Kelola Pengguna
        </a>
      </div>
    </div>
  </div>
</div>

<style>
/* Simple Dashboard Styles */
.page-header {
  background: linear-gradient(135deg, rgba(220,53,69,0.1) 0%, rgba(220,53,69,0.05) 100%);
  border-radius: 10px;
  padding: 1.5rem;
  margin-bottom: 1.5rem;
}

.page-title {
  font-size: 2rem;
  font-weight: 700;
  color: #333;
  margin-bottom: 0.5rem;
}

.time-widget {
  background: rgba(255,255,255,0.8);
  padding: 0.75rem 1rem;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* Stats Cards */
.stat-card {
  background: linear-gradient(135deg, var(--bs-danger) 0%, var(--bs-danger) 100%);
  padding: 1.25rem;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-3px);
}

.stat-card.bg-success {
  background: linear-gradient(135deg, var(--bs-success) 0%, #198754 100%);
}

.stat-card.bg-warning {
  background: linear-gradient(135deg, var(--bs-warning) 0%, #e0a800 100%);
}

.stat-card.bg-info {
  background: linear-gradient(135deg, var(--bs-info) 0%, #087990 100%);
}

/* Menu Cards */
.menu-card {
  background: white;
  border: none;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  height: 100%;
}

.menu-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}

.menu-icon {
  transition: transform 0.3s ease;
}

.menu-card:hover .menu-icon {
  transform: scale(1.1);
}

.card-title {
  font-weight: 600;
  color: #333;
}

.card-text {
  font-size: 0.9rem;
  margin-bottom: 1.5rem;
}

.btn {
  font-weight: 600;
  padding: 0.6rem 1.5rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn:hover {
  transform: translateY(-1px);
}

/* Responsive */
@media (max-width: 768px) {
  .page-header {
    padding: 1rem;
  }
  
  .page-title {
    font-size: 1.5rem;
  }
  
  .stat-card {
    padding: 1rem;
  }
  
  .stat-card h4 {
    font-size: 1.5rem;
  }
  
  .menu-card .card-body {
    padding: 1.5rem 1rem;
  }
  
  .menu-icon {
    margin-bottom: 1rem !important;
  }
  
  .menu-icon i {
    font-size: 2rem !important;
  }
}

@media (max-width: 576px) {
  .page-header .d-flex {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }
  
  .stat-card {
    margin-bottom: 0.75rem;
  }
  
  .card-text {
    margin-bottom: 1rem;
  }
}
</style>

<script>
// Real-time clock update
function updateClock() {
  const now = new Date();
  const timeString = now.toLocaleTimeString('id-ID', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit'
  });
  
  const clockElement = document.querySelector('#currentTime');
  if (clockElement) {
    clockElement.textContent = timeString;
  }
}

// Update clock every second
setInterval(updateClock, 1000);

// Initialize clock immediately
updateClock();
</script>
