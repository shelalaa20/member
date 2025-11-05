<div class="card shadow-sm border-0">
  <div class="card-header bg-danger text-white">
    <h5 class="mb-0">
      <i class="fas fa-user-plus me-2"></i> Tambah User
    </h5>
  </div>

  <div class="card-body">
    <form action="<?= site_url('admin/user/store') ?>" method="post" class="row g-3">
      
      <div class="col-md-6">
        <label class="form-label fw-bold">Username</label>
        <input type="text" name="username" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Password</label>
        <input type="text" name="password" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Nama</label>
        <input type="text" name="nama" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Role</label>
        <select name="role" class="form-select form-select-sm" required>
          <option value="admin">Admin</option>
          <option value="pelanggan">Pelanggan</option>
        </select>
      </div>

      <div class="col-md-6">
  <label class="form-label fw-bold">Status Aktif</label>
  <select name="aktif" class="form-select form-select-sm" required>
    <option value="1" <?= isset($user) && $user['aktif'] == 1 ? 'selected' : '' ?>>Aktif</option>
    <option value="0" <?= isset($user) && $user['aktif'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
  </select>
</div>


      <div class="col-12 d-flex justify-content-between mt-3">
        <a href="<?= site_url('admin/user') ?>" class="btn btn-secondary btn-sm">
          <i class="fas fa-arrow-left me-1"></i> Batal
        </a>
        <button type="submit" class="btn btn-success btn-sm">
          <i class="fas fa-save me-1"></i> Simpan
        </button>
      </div>
    </form>
  </div>
</div>
