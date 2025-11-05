<div class="card shadow-sm border-0">
  <div class="card-header bg-danger text-white">
    <h5 class="mb-0">
      <i class="fas fa-plus-circle me-2"></i> Tambah Banner
    </h5>
  </div>

  <div class="card-body">

    <form action="<?php echo site_url('admin/banner/store'); ?>" method="post" enctype="multipart/form-data" class="row g-3">

      <div class="col-12">
        <label for="judul" class="form-label fw-bold">Judul Banner</label>
        <input type="text" name="judul" id="judul" class="form-control form-control-sm" required>
      </div>

      <div class="col-12">
        <label for="gambar" class="form-label fw-bold">Gambar Banner</label>
        <input type="file" name="gambar" id="gambar" class="form-control form-control-sm" accept="image/*" required>
      </div>

      <div class="col-md-6">
        <label for="status" class="form-label fw-bold">Status</label>
        <select name="status" id="status" class="form-select form-select-sm">
          <option value="aktif" selected>Aktif</option>
          <option value="nonaktif">Nonaktif</option>
        </select>
      </div>

      <div class="col-12">
        <div class="card-footer d-flex justify-content-between px-0">
          <a href="<?php echo site_url('admin/banner'); ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-times me-1"></i> Batal
          </a>
          <button type="submit" class="btn btn-success btn-sm">
            <i class="fas fa-save me-1"></i> Simpan Banner
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
