<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
  <h3 class="text-dark mb-0" style="font-size: 1.25rem;">
    <i class="fas fa-users me-2 text-danger"></i> Daftar Pelanggan
  </h3>
  <div class="d-flex gap-2 flex-wrap">
    <a href="<?= site_url('admin/pelanggan/create') ?>" class="btn btn-primary btn-sm">
      <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Tambah</span>
    </a>

    <a href="<?= site_url('admin/pelanggan/import_excel') ?>" class="btn btn-success btn-sm">
      <i class="fas fa-file-import"></i> <span class="d-none d-sm-inline">Import Data</span>
    </a>

    <a href="<?= site_url('admin/pelanggan/import_status_bayar') ?>" class="btn btn-warning btn-sm">
      <i class="fas fa-money-bill-wave"></i> <span class="d-none d-sm-inline">Import Status</span>
    </a>
  </div>
</div>


<!-- Form Pencarian -->
<form method="get" action="<?= site_url('admin/pelanggan') ?>" class="mb-3 d-flex">
  <input type="text" 
         name="keyword" 
         class="form-control form-control-sm me-2 border-secondary"
         placeholder="Cari nama / kontak / paket"
         value="<?= html_escape($keyword ?? '') ?>">
  <button type="submit" class="btn btn-dark btn-xs shadow-sm me-2">
    <i class="fas fa-search me-1"></i> Cari
  </button>
  <a href="<?= site_url('admin/pelanggan') ?>" class="btn btn-secondary btn-xs shadow-sm">
    <i class="fas fa-undo me-1"></i> Reset
  </a>
</form>

<!-- Table View untuk Desktop -->
<div class="table-responsive d-none d-md-block">
  <table class="table table-striped align-middle table-hover" style="font-size:0.75rem;">
    <thead class="table-dark text-white" style="font-size:0.7rem;">
      <tr class="text-center">
        <th style="min-width: 35px;">ID</th>
        <th style="min-width: 60px;">VA</th>
        <th style="min-width: 120px;">NAMA</th>
        <th style="min-width: 90px;">KONTAK</th>
        <th style="min-width: 80px;">PAKET</th>
        <th style="min-width: 70px;">SPEED</th>
        <th style="min-width: 70px;">J.TEMPO</th>
        <th style="min-width: 75px;">TGL DAFTAR</th>
        <th style="min-width: 75px;">TGL N/A</th>
        <th style="min-width: 65px;">AKTIF</th>
        <th style="min-width: 75px;">STATUS</th>
        <th style="min-width: 85px;">AKSI</th>
      </tr>
    </thead>
    <tbody style="font-size:0.75rem;">
      <?php if(!empty($members)): ?>
        <?php foreach($members as $m): ?>
        <tr class="align-middle text-center">
          <td><?= html_escape($m['id_member']) ?></td>
          <td><?= html_escape($m['va']) ?></td>
          <td class="text-start"><?= html_escape($m['nama']) ?></td>
          <td class="text-start"><?= html_escape($m['kontak']) ?></td>
          <td class="text-start"><?= html_escape($m['nama_paket']) ?></td>
          <td><?= html_escape($m['kecepatan']) ?></td>
          <td><?= html_escape($m['jatuh_tempo']) ?></td>
          <td><?= html_escape($m['tanggal_daftar']) ?></td>
          <td><?= html_escape($m['tanggal_non_aktif']) ?></td>
          
          <!-- 🟢 Kolom Aktif -->
          <td>
            <?= $m['aktif'] == 1 
              ? '<span class="badge bg-success" style="font-size:0.65rem;">Aktif</span>' 
              : '<span class="badge bg-danger" style="font-size:0.65rem;">Nonaktif</span>' ?>
          </td>
          <!-- 🟢 Kolom Status Bayar -->
          <td>
            <?= $m['status_bayar'] === 'Lunas'
                ? '<span class="badge bg-success" style="font-size:0.65rem;">Lunas</span>'
                : '<span class="badge bg-danger" style="font-size:0.65rem;">Belum</span>' ?>
          </td>

          <td class="text-center">
            <a href="<?= site_url('admin/pelanggan/edit/'.$m['id_member']) ?>" class="btn btn-warning btn-sm me-1 text-dark shadow-sm" style="padding: 0.15rem 0.4rem; font-size: 0.7rem;">
              <i class="fas fa-edit"></i>
            </a>
            <a href="<?= site_url('admin/pelanggan/delete/'.$m['id_member']) ?>" 
               class="btn btn-danger btn-sm shadow-sm" style="padding: 0.15rem 0.4rem; font-size: 0.7rem;"
               onclick="return confirm('Yakin hapus?')">
              <i class="fas fa-trash-alt"></i>
            </a>
          </td>
        </tr>
        <?php endforeach ?>
      <?php else: ?>
        <tr>
          <td colspan="12" class="text-center text-muted py-2">Tidak ada data pelanggan</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
  <!-- Pagination -->
  <div>
    <?= $pagination ?>
  </div>
</div>

<!-- 🟢 Versi Mobile -->
<div class="d-block d-md-none">
  <?php if(!empty($members)): ?>
    <?php foreach($members as $m): ?>
      <div class="card mb-3 shadow-sm border-0 rounded-3">
        <div class="card-body p-3">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <div>
              <h6 class="card-title mb-1 fw-bold"><?= html_escape($m['nama']) ?></h6>
              <small class="text-muted">ID: <?= html_escape($m['id_member']) ?></small>
            </div>
            <span class="badge bg-primary"><?= html_escape($m['va']) ?></span>
          </div>

          <ul class="list-unstyled mb-2">
            <li><strong>Kontak:</strong> <?= html_escape($m['kontak']) ?></li>
            <li><strong>Paket:</strong> <?= html_escape($m['nama_paket']) ?></li>
            <li><strong>Kecepatan:</strong> <?= html_escape($m['kecepatan']) ?></li>
            <li><strong>Jatuh Tempo:</strong> <span class="text-danger fw-semibold"><?= html_escape($m['jatuh_tempo']) ?></span></li>
            <li><strong>Tgl Daftar:</strong> <?= html_escape($m['tanggal_daftar']) ?></li>
            <li><strong>Tgl Non Aktif:</strong> <?= html_escape($m['tanggal_non_aktif']) ?></li>

            <!-- 🟢 Tambahan kolom Aktif -->
            <li>
              <strong>Aktif:</strong>
              <?= $m['aktif'] == 1 
                ? '<span class="badge bg-success">Aktif</span>' 
                : '<span class="badge bg-danger">Nonaktif</span>' ?>
            </li>
            <li>
              <strong>Status Bayar:</strong>
              <?= $m['status_bayar'] === 'Lunas'
                  ? '<span class="badge bg-success">Lunas</span>'
                  : '<span class="badge bg-danger">Belum Lunas</span>' ?>
            </li>
          </ul>

          <div class="d-flex justify-content-end mt-2 gap-2">
            <a href="<?= site_url('admin/pelanggan/edit/'.$m['id_member']) ?>" 
               class="btn btn-warning btn-sm text-dark shadow-sm">
              <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="<?= site_url('admin/pelanggan/delete/'.$m['id_member']) ?>" 
               class="btn btn-danger btn-sm shadow-sm"
               onclick="return confirm('Yakin hapus?')">
              <i class="fas fa-trash-alt me-1"></i> Hapus
            </a>
          </div>
        </div>
      </div>
    <?php endforeach ?>
  <?php else: ?>
    <p class="text-center text-muted mt-3">Tidak ada data pelanggan</p>
  <?php endif ?>
</div>

<!-- Pagination untuk Mobile -->
<?php if(!empty($members) && isset($pagination)): ?>

<!-- Pagination untuk Mobile -->
<div class="mt-2 d-flex justify-content-center d-block d-md-none">
  <?= $pagination ?>
</div>
<?php endif; ?>