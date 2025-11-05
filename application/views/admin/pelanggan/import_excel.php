<div class="card shadow-sm border-0">
  <div class="card-header bg-danger text-white">
    <h5 class="mb-0">
      <i class="fas fa-file-import me-2"></i> Import Data Pelanggan dari Excel
    </h5>
  </div>

  <div class="card-body">
    <?php if($this->session->flashdata('error')): ?>
      <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('admin/pelanggan/do_import') ?>" method="post" enctype="multipart/form-data" class="row g-3">
      <div class="col-md-6">
        <label for="file_excel" class="form-label fw-bold">Pilih file Excel (.xls / .xlsx / .csv)</label>
        <input type="file" name="file_excel" id="file_excel" class="form-control form-control-sm" accept=".xls,.xlsx,.csv" required>
      </div>

      <div class="col-12 d-flex justify-content-between mt-3">
        <a href="<?= site_url('admin/pelanggan') ?>" class="btn btn-secondary btn-sm">
          <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success btn-sm">
          <i class="fas fa-file-import me-1"></i> Import Sekarang
        </button>
      </div>
    </form>
  </div>
</div>
