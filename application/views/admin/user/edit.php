<div class="card shadow-sm border-0">
  <div class="card-header bg-danger text-white">
    <h5 class="mb-0">
      <i class="fas fa-user-edit me-2"></i> Edit User
    </h5>
  </div>

  <div class="card-body">
    <form action="<?= site_url('admin/user/update/'.$user['id']) ?>" method="post" class="row g-3">
      
      <div class="col-md-6">
        <label class="form-label fw-bold">Username</label>
        <input type="text" name="username" class="form-control form-control-sm" 
               value="<?= $user['username'] ?>" required>
      </div>

      <div class="col-md-6">
  <label class="form-label fw-bold">Password <small>(kosongkan jika tidak diubah)</small></label>
  <div class="input-group input-group-sm">
    <input type="text" name="password" class="form-control" id="password" placeholder="••••••">
    <button 
      type="button" 
      class="btn btn-outline-danger" 
      onclick="resetPassword('<?= $user['id'] ?>', '<?= $user['username'] ?>')">
      <i class="fas fa-undo"></i> Reset
    </button>
  </div>
</div>

<script>
function resetPassword(id, username) {
  if (confirm('Yakin mau reset password jadi sama dengan username?')) {
    fetch(`<?= site_url('admin/user/reset_password/') ?>${id}`, {
      method: 'POST'
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Password berhasil direset jadi username!');
        document.getElementById('password').value = username;
      } else {
        alert('Gagal reset password.');
      }
    })
    .catch(() => alert('Terjadi kesalahan.'));
  }
}
</script>


      <div class="col-md-6">
        <label class="form-label fw-bold">Nama</label>
        <input type="text" name="nama" class="form-control form-control-sm" 
               value="<?= $user['nama'] ?>" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Role</label>
        <select name="role" class="form-select form-select-sm" required>
          <option value="admin" <?= ($user['role']=='admin')?'selected':'' ?>>Admin</option>
          <option value="pelanggan" <?= ($user['role']=='pelanggan')?'selected':'' ?>>Pelanggan</option>
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
          <i class="fas fa-save me-1"></i> Update
        </button>
        
      </div>
    </form>
  </div>
</div>
