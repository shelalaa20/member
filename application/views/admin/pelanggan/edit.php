<div class="card shadow-sm border-0">
  <div class="card-header bg-danger text-white">
    <h5 class="mb-0">
      <i class="fas fa-edit me-2"></i> Edit Pelanggan
    </h5>
  </div>

  <div class="card-body">
    <?= form_open('admin/pelanggan/update/' . $member['id_member'], ['class' => 'row g-3']) ?>

      <div class="col-md-6">
        <label class="form-label fw-bold">VA</label>
        <input type="text" name="va" value="<?= htmlspecialchars($member['va'], ENT_QUOTES, 'UTF-8') ?>" class="form-control form-control-sm" readonly>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($member['nama'], ENT_QUOTES, 'UTF-8') ?>" class="form-control form-control-sm" required>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Kontak</label>
        <input type="text" name="kontak" value="<?= htmlspecialchars($member['kontak'], ENT_QUOTES, 'UTF-8') ?>" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Paket</label>
        <input type="text" name="nama_paket" value="<?= htmlspecialchars($member['nama_paket'], ENT_QUOTES, 'UTF-8') ?>" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Kecepatan</label>
        <input type="text" name="kecepatan" value="<?= htmlspecialchars($member['kecepatan'], ENT_QUOTES, 'UTF-8') ?>" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Jatuh Tempo</label>
        <input type="text" name="jatuh_tempo" value="<?= htmlspecialchars($member['jatuh_tempo'], ENT_QUOTES, 'UTF-8') ?>" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Tanggal Daftar</label>
        <input type="date" name="tanggal_daftar" value="<?= htmlspecialchars($member['tanggal_daftar'], ENT_QUOTES, 'UTF-8') ?>" class="form-control form-control-sm">
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Tanggal Non Aktif</label>
        <input type="date" name="tanggal_non_aktif" 
       value="<?= htmlspecialchars($member['tanggal_non_aktif'] ?? '', ENT_QUOTES, 'UTF-8') ?>" 
       class="form-control form-control-sm">
      </div>

      <!-- ✅ Tambahan baru -->
      <div class="col-md-6">
        <label class="form-label fw-bold">Status Aktif</label>
        <select name="aktif" class="form-select form-select-sm">
          <option value="1" <?= $member['aktif'] == 1 ? 'selected' : '' ?>>Aktif</option>
          <option value="0" <?= $member['aktif'] == 0 ? 'selected' : '' ?>>Non Aktif</option>
        </select>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-bold">Status Bayar</label>
        <select name="status_bayar" class="form-select form-select-sm">
          <option value="Belum Lunas" <?= $member['status_bayar'] == 'Belum Lunas' ? 'selected' : '' ?>>Belum Lunas</option>
          <option value="Lunas" <?= $member['status_bayar'] == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
        </select>
      </div>
      <!-- ✅ Selesai tambahan -->

      <div class="col-12">
        <div class="card-footer d-flex justify-content-between px-0">
          <a href="<?= site_url('admin/pelanggan') ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <button type="submit" class="btn btn-success btn-sm">
            <i class="fas fa-save me-1"></i> Update
          </button>
        </div>
      </div>

    <?= form_close() ?>
  </div>
</div>
