<div class="card shadow-sm border-0">
  <div class="card-header bg-danger text-white">
    <h5 class="mb-0">
      <i class="fas fa-user-plus me-2"></i> Tambah Pelanggan
    </h5>
  </div>

  <div class="card-body">
    <?php echo form_open('admin/pelanggan/store', ['id' => 'form-pelanggan', 'class' => 'row g-3']); ?>
      
      <div class="col-md-6">
        <label class="form-label fw-bold">ID Member</label>
        <input type="text" name="id_member" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">VA</label>
        <input type="text" name="va" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Nama</label>
        <input type="text" name="nama" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Kontak</label>
        <input type="text" name="kontak" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Paket</label>
        <input type="text" name="nama_paket" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Kecepatan</label>
        <input type="text" name="kecepatan" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Jatuh Tempo</label>
        <input type="text" name="jatuh_tempo" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Tanggal Daftar</label>
        <input type="date" name="tanggal_daftar" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Tanggal Non Aktif</label>
        <input type="date" name="tanggal_non_aktif" class="form-control form-control-sm">
      </div>

      <!-- ✅ Tambahan baru -->
      <div class="col-md-6">
        <label class="form-label fw-bold">Status Aktif</label>
        <select name="aktif" class="form-select form-select-sm">
          <option value="1" selected>Aktif</option>
          <option value="0">Non Aktif</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Status Bayar</label>
        <select name="status_bayar" class="form-select form-select-sm">
          <option value="Belum Lunas" selected>Belum Lunas</option>
          <option value="Lunas">Lunas</option>
        </select>
      </div>
      <!-- ✅ Selesai tambahan -->

      <div class="col-12 d-flex justify-content-between mt-3">
        <a href="<?php echo site_url('admin/pelanggan'); ?>" class="btn btn-secondary btn-sm">
          <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success btn-sm">
          <i class="fas fa-save me-1"></i> Simpan
        </button>
      </div>

    <?php echo form_close(); ?>
  </div>
</div>
