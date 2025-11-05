<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="text-dark mb-0">
    <i class="fas fa-image me-2 text-danger"></i> Daftar Banner
  </h3>
  <a href="<?php echo site_url('admin/banner/create'); ?>" class="btn btn-primary btn-sm shadow-sm">
    <i class="fas fa-plus-circle me-1"></i> Tambah Banner
  </a>
</div>

<form method="get" action="<?php echo site_url('admin/banner'); ?>" class="mb-3 d-flex">
  <input type="text" 
         name="keyword" 
         class="form-control form-control-sm me-2 border-secondary"
         placeholder="Cari judul banner..."
         value="<?php echo isset($keyword) ? $keyword : ''; ?>">

  <button type="submit" class="btn btn-dark btn-xs shadow-sm me-2">
    <i class="fas fa-search me-1"></i> Cari
  </button>

  <a href="<?php echo site_url('admin/banner'); ?>" class="btn btn-secondary btn-xs shadow-sm">
    <i class="fas fa-undo me-1"></i> Reset
  </a>
</form>

<!-- Desktop Table -->
<div class="d-none d-md-block">
  <div class="table-responsive">
  <table class="table table-striped align-middle table-hover" style="font-size:0.85rem;">
      <thead class="table-dark text-white">
        <tr class="text-center">
          <th>Judul</th>
          <th>Gambar</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Diubah</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($banners)): ?>
          <?php foreach($banners as $b): ?>
            <tr>
              <td><?php echo $b['judul']; ?></td>
              <td class="text-center">
                <img src="<?php echo base_url('assets/uploads/banner/'.$b['gambar']); ?>" 
                     alt="<?php echo $b['judul']; ?>" 
                     style="max-width:120px; max-height:70px" 
                     class="img-thumbnail">
              </td>
<td class="text-center">
<span class="badge rounded-pill bg-<?php echo $b['status']=='aktif' ? 'success' : 'secondary'; ?>">
  <?php echo $b['status']; ?>
</span>

</td>

              <td class="text-center"><?php echo $b['created_at'] ? date('d/m/Y', strtotime($b['created_at'])) : '-'; ?></td>
              <td class="text-center"><?php echo $b['updated_at'] ? date('d/m/Y', strtotime($b['updated_at'])) : '-'; ?></td>
              <td class="text-center">
                <a href="<?php echo site_url('admin/banner/edit/'.$b['id']); ?>" class="btn btn-warning btn-sm me-1 text-dark shadow-sm">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="<?php echo site_url('admin/banner/delete/'.$b['id']); ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Yakin hapus banner ini?')">
                  <i class="fas fa-trash-alt"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center text-muted">Belum ada banner</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Mobile Cards -->
<div class="d-md-none">
  <?php if(!empty($banners)): ?>
    <?php foreach($banners as $b): ?>
      <div class="card mb-3 shadow-sm">
        <div class="card-body p-2">
          <div class="d-flex align-items-center">
            <img src="<?php echo base_url('assets/uploads/banner/'.$b['gambar']); ?>" 
                 alt="<?php echo $b['judul']; ?>" 
                 style="width:100px; height:auto" 
                 class="img-thumbnail me-2">
            <div>
              <h6 class="mb-1 text-dark"><?php echo $b['judul']; ?></h6>
<small class="d-block">
  Status: 
<span class="badge rounded-pill bg-<?php echo $b['status']=='aktif' ? 'success' : 'secondary'; ?>">
  <?php echo $b['status']; ?>
</span>
</small>

              <small class="text-muted d-block">Dibuat: <?php echo $b['created_at'] ? date('d/m/Y', strtotime($b['created_at'])) : '-'; ?></small>
              <small class="text-muted d-block">Diubah: <?php echo $b['updated_at'] ? date('d/m/Y', strtotime($b['updated_at'])) : '-'; ?></small>
            </div>
          </div>
          <div class="mt-2 text-end">
            <a href="<?php echo site_url('admin/banner/edit/'.$b['id']); ?>" class="btn btn-warning btn-sm me-1 text-dark shadow-sm">
              <i class="fas fa-edit"></i>
            </a>
            <a href="<?php echo site_url('admin/banner/delete/'.$b['id']); ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Yakin hapus banner ini?')">
              <i class="fas fa-trash-alt"></i>
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="alert alert-secondary small text-center">
      Belum ada banner
    </div>
  <?php endif; ?>
</div>
