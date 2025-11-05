<!-- admin/user/index.php (CI3) -->

<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="text-dark mb-0">
    <i class="fas fa-user-cog me-2 text-primary"></i> <?= $title ?>
  </h3>
  <a href="<?= base_url('admin/user/create') ?>" class="btn btn-primary btn-sm shadow-sm">
    <i class="fas fa-user-plus me-1"></i> Tambah User
  </a>
</div>

<!-- Form pencarian & filter -->
<form method="get" class="mb-3 d-flex">
  <input type="text" 
         name="keyword" 
         class="form-control form-control-sm me-2 border-secondary" 
         placeholder="Cari username atau nama"
         value="<?= $keyword ?>">
  <select name="role" class="form-select form-select-sm me-2 border-secondary">
      <option value="all">Semua Role</option>
      <option value="admin" <?= ($role=='admin')?'selected':'' ?>>Admin</option>
      <option value="pelanggan" <?= ($role=='pelanggan')?'selected':'' ?>>Pelanggan</option>
  </select>
  <button class="btn btn-dark btn-sm shadow-sm me-2">
    <i class="fas fa-search me-1"></i> Cari
  </button>
  <a href="<?= base_url('admin/user') ?>" class="btn btn-secondary btn-sm shadow-sm">
    <i class="fas fa-undo me-1"></i> Reset
  </a>
</form>


<!-- Table View untuk Desktop -->
<div class="table-responsive d-none d-md-block">
  <table class="table table-striped align-middle table-hover" style="font-size:0.85rem;">
    <thead class="table-dark text-white" style="font-size:0.8rem;">
      <tr class="text-center">
        <th class="py-2 px-2">ID</th>
        <th class="py-2 px-2">Username</th>
        <th class="py-2 px-2">Nama</th>
        <th class="py-2 px-2">Role</th>
        <th class="py-2 px-2">Password</th>
        <th class="py-2 px-2">Aktif</th> <!-- ✅ Tambahan kolom aktif -->
        <th class="py-2 px-2">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if($users): ?>
        <?php foreach($users as $user): ?>
          <tr>
            <td class="py-1 px-2 text-center"><?= $user['id'] ?></td>
            <td class="py-1 px-2"><?= $user['username'] ?></td>
            <td class="py-1 px-2"><?= $user['nama'] ?></td>
            <td class="py-1 px-2 text-center"><?= $user['role'] ?></td>
            <td class="py-1 px-2"><?= $user['password'] ?></td>
            <td class="py-1 px-2 text-center">
              <?php if(isset($user['aktif'])): ?>
                <?php if($user['aktif'] == 1): ?>
                  <span class="badge bg-success">Aktif</span>
                <?php else: ?>
                  <span class="badge bg-danger">Nonaktif</span>
                <?php endif; ?>
              <?php else: ?>
                <span class="text-muted">-</span>
              <?php endif; ?>
            </td>
            <td class="py-1 px-2 text-center">
              <a href="<?= base_url('admin/user/edit/'.$user['id']) ?>" class="btn btn-warning btn-sm me-1 text-dark shadow-sm">
                <i class="fas fa-edit"></i>
              </a>
              <form action="<?= base_url('admin/user/delete/'.$user['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Hapus user ini?')">
                <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
                <button class="btn btn-danger btn-sm shadow-sm">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center text-muted py-2">Tidak ada data.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  <!-- Pagination -->
  <div>
    <?php if(isset($pagination)) echo $pagination; ?>
  </div>
</div>


<!-- Versi Card untuk Mobile -->
<div class="d-block d-md-none mt-3">
  <?php if($users): ?>
    <?php foreach($users as $user): ?>
      <div class="card mb-2 shadow-sm">
        <div class="card-body p-2">
          <p class="mb-1"><strong>ID:</strong> <?= $user['id'] ?></p>
          <p class="mb-1"><strong>Username:</strong> <?= $user['username'] ?></p>
          <p class="mb-1"><strong>Nama:</strong> <?= $user['nama'] ?></p>
          <p class="mb-1"><strong>Role:</strong> <?= $user['role'] ?></p>
          <p class="mb-1"><strong>Password:</strong> <?= $user['password'] ?></p>
          <p class="mb-1"><strong>Aktif:</strong> 
            <?php if(isset($user['aktif'])): ?>
              <?php if($user['aktif'] == 1): ?>
                <span class="badge bg-success">Aktif</span>
              <?php else: ?>
                <span class="badge bg-danger">Nonaktif</span>
              <?php endif; ?>
            <?php else: ?>
              <span class="text-muted">-</span>
            <?php endif; ?>
          </p>
          <div class="d-flex justify-content-end mt-2">
            <a href="<?= base_url('admin/user/edit/'.$user['id']) ?>" 
               class="btn btn-warning btn-sm me-1 text-dark shadow-sm">
              <i class="fas fa-edit"></i>
            </a>
            <form action="<?= base_url('admin/user/delete/'.$user['id']) ?>" 
                  method="post" class="d-inline" 
                  onsubmit="return confirm('Hapus user ini?')">
              <?php echo form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>
              <button class="btn btn-danger btn-sm shadow-sm">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <!-- Pagination untuk Mobile -->
    <?php if(isset($pagination)): ?>
      <div class="mt-2 d-flex justify-content-center">
        <?= $pagination ?>
      </div>
    <?php endif; ?>

  <?php else: ?>
    <p class="text-center text-muted">Tidak ada data.</p>
  <?php endif; ?>
</div>
