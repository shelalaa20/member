<div class="container mt-4">
  <h4>Import Status Bayar</h4>
  <form action="<?= site_url('admin/pelanggan/do_import_status_bayar') ?>" method="post" enctype="multipart/form-data">
      <div class="form-group mt-3">
          <label>Pilih File Excel (.xlsx)</label>
          <input type="file" name="file_excel" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Import Sekarang</button>
      <a href="<?= site_url('admin/pelanggan') ?>" class="btn btn-secondary mt-3">Kembali</a>
  </form>
</div>
