<div class="container mt-3">
<div class="d-flex align-items-center mb-3">

</div>
  <!-- Detail Profil -->
  <div class="card mb-3">
    <div class="card-header py-2">
      <i class="fas fa-id-card me-2"></i>
      Detail Profil
    </div>
    <div class="card-body py-3">
      <div class="row g-3">

        <!-- ID Member -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-hashtag"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">ID / VA</small>
              <div class="profile-info"><?= esc($member['va']) ?></div>
            </div>
          </div>
        </div>

        <!-- Nama -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-user"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">Nama</small>
              <div class="profile-info"><?= esc($member['nama']) ?></div>
            </div>
          </div>
        </div>

        <!-- Kontak -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-phone-alt"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">Kontak</small>
              <div class="profile-info"><?= esc($member['kontak']) ?></div>
            </div>
          </div>
        </div>

        <!-- Paket -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-box"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">Paket</small>
              <div class="profile-info"><?= esc($member['nama_paket']) ?></div>
            </div>
          </div>
        </div>

        <!-- Kecepatan -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">Kecepatan</small>
              <div class="profile-info"> Up To <?= esc($member['kecepatan']) ?></div>
            </div>
          </div>
        </div>

        <!-- Jatuh Tempo -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">Jatuh Tempo</small>
              <div class="profile-info">Tanggal <?= esc($member['jatuh_tempo']) ?></div>
            </div>
          </div>
        </div>

        <?php
        function format_tanggal_indo($tanggal) {
            if (!$tanggal) return '-';
            $bulan = [
                1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ];
            $tgl = date('j', strtotime($tanggal));
            $bln = $bulan[(int)date('m', strtotime($tanggal))];
            $thn = date('Y', strtotime($tanggal));
            return "$tgl $bln $thn";
        }
        ?>


        <!-- Tanggal Daftar -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-calendar-plus"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">Tanggal Daftar</small>
              <div class="profile-info">
                <?= format_tanggal_indo($member['tanggal_daftar']) ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
            </div>
            <div>
              <small class="text-muted">Status Bayar</small>
              <div class="profile-info"><?= esc($member['status_bayar']) ?></div>
            </div>
          </div>
        </div>


<!-- Username -->
<div class="col-md-6">
  <div class="d-flex align-items-center">
    <div class="me-3">
      <div class="profile-icon">
        <i class="fas fa-user-circle"></i>
      </div>
    </div>
    <div>
      <small class="text-muted">Username</small>
      <div class="profile-info"><?= esc($user['username'] ?? 'Belum ada username') ?></div>
    </div>
  </div>
</div>


        <!-- Password -->
        <div class="col-md-6">
          <div class="d-flex align-items-center">
            <div class="me-3">
              <div class="profile-icon">
                <i class="fas fa-lock"></i>
              </div>
            </div>
            <div class="d-flex align-items-center flex-grow-1">
              <div class="flex-grow-1">
                <small class="text-muted">Password</small>
                <div class="profile-info">••••••••</div>
              </div>
              <button class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#modalPassword">
                <i class="fas fa-edit"></i>
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>



</div>

<!-- Modal Password -->
<div class="modal fade" id="modalPassword" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
  <form action="<?= site_url('pelanggan/profile/updatePassword') ?>" method="post" class="modal-content">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title">
          <i class="fas fa-key text-danger me-2"></i>
          Ubah Password
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body pt-2">
        <div class="mb-3">
          <label class="form-label small text-muted">Password Lama</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-lock text-muted"></i>
            </span>
            <input type="password" name="old_password" class="form-control" required placeholder="Masukkan password lama">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label small text-muted">Password Baru</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-key text-muted"></i>
            </span>
            <input type="password" name="new_password" class="form-control" required placeholder="Masukkan password baru">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label small text-muted">Konfirmasi Password Baru</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-check text-muted"></i>
            </span>
            <input type="password" name="confirm_password" class="form-control" required placeholder="Konfirmasi password baru">
          </div>
        </div>
      </div>
      <div class="modal-footer border-0 pt-0">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
          <i class="fas fa-times me-1"></i> Batal
        </button>
        <button type="submit" class="btn btn-danger btn-sm">
          <i class="fas fa-save me-1"></i> Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<style>
/* Konsisten dengan dashboard */
.card-header {
  font-size: 0.9rem !important;
  font-weight: 600;
  padding: 0.8rem 1rem !important;
}

.card-body {
  padding: 1rem !important;
}

/* Profile Icons - sama seperti dashboard */
.profile-icon {
  width: 35px;
  height: 35px;
  background: linear-gradient(135deg, #b30000, #800000);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 0.9rem;
}

.profile-info {
  font-weight: 600;
  font-size: 0.9rem;
  color: #2c3e50;
  line-height: 1.3;
}

/* Enhanced hover effects */
.col-md-6 > div {
  padding: 0.5rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.col-md-6 > div:hover {
  background: rgba(179, 0, 0, 0.05);
  transform: translateY(-1px);
}

.col-md-6 > div:hover .profile-icon {
  background: linear-gradient(135deg, #cc0000, #990000);
  transform: scale(1.05);
}

/* Modal styling */
.modal-content {
  border: none;
  border-radius: 12px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

.modal-header .modal-title {
  font-size: 1rem;
  font-weight: 600;
}

.input-group-text {
  background: #f8f9fa;
  border: 1px solid #dee2e6;
  color: #6c757d;
}

.form-control {
  border: 1px solid #dee2e6;
  font-size: 0.9rem;
}

.form-control:focus {
  border-color: #b30000;
  box-shadow: 0 0 0 0.2rem rgba(179, 0, 0, 0.25);
}

.form-label {
  font-weight: 500;
}

/* Button styles - konsisten dengan dashboard */
.btn-secondary {
  background: #6c757d;
  border-color: #6c757d;
  font-size: 0.85rem;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background: #545862;
  border-color: #545862;
  transform: translateY(-1px);
}

.btn-danger {
  background: linear-gradient(135deg, #b30000, #800000);
  border: none;
  font-size: 0.85rem;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn-danger:hover {
  background: linear-gradient(135deg, #cc0000, #990000);
  transform: translateY(-1px);
}

.btn-outline-danger {
  color: #b30000;
  border-color: #b30000;
  background: transparent;
  transition: all 0.3s ease;
}

.btn-outline-danger:hover {
  background: #b30000;
  border-color: #b30000;
  color: white;
  transform: scale(1.05);
}

/* Responsive adjustments - sama seperti dashboard */
@media (max-width: 768px) {
  .card-header {
    font-size: 0.8rem !important;
    padding: 0.7rem 0.9rem !important;
  }
  
  .card-body {
    padding: 0.9rem !important;
  }
  
  .profile-icon {
    width: 30px;
    height: 30px;
    font-size: 0.8rem;
  }
  
  .profile-info {
    font-size: 0.8rem;
  }
  
  small.text-muted {
    font-size: 0.7rem;
  }
}

@media (max-width: 576px) {
  .container {
    padding-left: 0.8rem;
    padding-right: 0.8rem;
  }
  
  .card-header {
    font-size: 0.75rem !important;
    padding: 0.6rem 0.8rem !important;
  }
  
  .card-body {
    padding: 0.8rem !important;
  }
  
  .profile-icon {
    width: 28px;
    height: 28px;
    font-size: 0.7rem;
  }
  
  .profile-info {
    font-size: 0.75rem;
  }
  
  small.text-muted {
    font-size: 0.65rem;
  }
}

/* Loading animation - konsisten dengan dashboard */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.card {
  animation: fadeInUp 0.5s ease forwards;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
}

/* Modal animation */
.modal.fade .modal-dialog {
  transform: translateY(-50px);
  transition: transform 0.3s ease;
}

.modal.show .modal-dialog {
  transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Form validation
  const form = document.querySelector('form');
  if (form) {
    form.addEventListener('submit', function(e) {
      const newPassword = document.querySelector('input[name="new_password"]').value;
      const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
      
      if (newPassword !== confirmPassword) {
        e.preventDefault();
        alert('Password baru dan konfirmasi password tidak cocok!');
        return false;
      }
      
      if (newPassword.length < 6) {
        e.preventDefault();
        alert('Password minimal 6 karakter!');
        return false;
      }
    });
  }
  
  // Add loading state to submit button
  document.addEventListener('DOMContentLoaded', function() {
  const form = document.querySelector('#modalPassword form');
  const submitBtn = form.querySelector('button[type="submit"]');

  form.addEventListener('submit', function(e) {
    const oldPassword = form.querySelector('input[name="old_password"]').value.trim();
    const newPassword = form.querySelector('input[name="new_password"]').value.trim();
    const confirmPassword = form.querySelector('input[name="confirm_password"]').value.trim();

    // Validasi client-side
    if (newPassword !== confirmPassword) {
      e.preventDefault();
      alert('Password baru dan konfirmasi password tidak cocok!');
      return false;
    }

    if (newPassword.length < 6) {
      e.preventDefault();
      alert('Password minimal 6 karakter!');
      return false;
    }

    // Validasi lolos, baru aktifkan spinner
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
    submitBtn.disabled = true;
  });
});


// Add click animation to profile items
document.querySelectorAll('.col-md-6 > div').forEach(item => {
  item.addEventListener('click', function(e) {
    if (!e.target.closest('button')) {
      this.style.transform = 'scale(0.98)';
      setTimeout(() => {
        this.style.transform = '';
      }, 150);
    }
  });
});
</script>
