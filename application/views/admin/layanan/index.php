<div class="container mt-4">

  <!-- Form Layanan -->
  <div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="fas fa-cogs me-2 text-danger"></i> Kelola Info Layanan
      </h5>
    </div>
    <div class="card-body">
      <form action="<?php echo site_url('admin/layanan/update'); ?>" method="post" class="row g-3">
        <div class="col-md-6">
          <label for="wa" class="form-label fw-bold">Nomor WhatsApp CS</label>
          <input type="text" id="wa" name="wa_cs" 
                 class="form-control form-control-sm border-secondary"
                 value="<?php echo isset($layanan['wa_cs']) ? $layanan['wa_cs'] : ''; ?>" 
                 placeholder="https://wa.me/6234567" required>
        </div>
        <div class="col-md-6">
          <label for="youtube" class="form-label fw-bold">Link YouTube</label>
          <input type="text" id="youtube" name="youtube" 
                 class="form-control form-control-sm border-secondary"
                 value="<?php echo isset($layanan['youtube']) ? $layanan['youtube'] : ''; ?>" 
                 placeholder="https://www.youtube.com/channel/...">
        </div>
        <div class="col-12">
          <div class="d-flex justify-content-between mt-3">
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="btn btn-secondary btn-sm shadow-sm">
              <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <button type="submit" class="btn btn-success btn-sm shadow-sm">
              <i class="fas fa-save me-1"></i> Simpan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Daftar FAQ -->
  <div class="card shadow-sm border-0">
    <div class="card-header bg-dark text-white">
      <h5 class="mb-0">
        <i class="fas fa-question-circle me-2"></i> Daftar FAQ
      </h5>
    </div>
    <div class="card-body">

      <!-- Tombol Tambah FAQ -->
      <div class="mb-3">
        <a href="<?php echo site_url('admin/layanan/faq/create'); ?>" class="btn btn-primary btn-sm shadow-sm">
          <i class="fas fa-plus me-1"></i> Tambah FAQ
        </a>
      </div>

<!-- Table View untuk Desktop -->
<div class="table-responsive d-none d-md-block">
        <table class="table table-striped table-hover align-middle" style="font-size:0.85rem;">
          <thead class="table-dark text-white" style="font-size:0.8rem;">
            <tr class="text-center">
              <th class="py-2 px-2">Urutan</th>
              <th class="py-2 px-2">Pertanyaan</th>
              <th class="py-2 px-2">Jawaban</th>
              <th class="py-2 px-2">Status</th>
              <th class="py-2 px-2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($faqs)): ?>
              <?php foreach($faqs as $faq): ?>
              <tr>
                <td class="text-center"><?php echo $faq['urutan']; ?></td>
                <td><?php echo $faq['pertanyaan']; ?></td>
                <td><?php echo $faq['jawaban']; ?></td>
                <td class="text-center">
                  <span class="badge <?php echo ($faq['status'] === 'aktif') ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo $faq['status']; ?>
                  </span>
                </td>

                <td class="text-center">
                  <a href="<?php echo site_url('admin/layanan/faq/edit/'.$faq['id']); ?>" 
                     class="btn btn-warning btn-sm me-1 text-dark shadow-sm">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="<?php echo site_url('admin/layanan/faq/delete/'.$faq['id']); ?>" 
                        method="post" 
                        class="d-inline" 
                        onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
                    <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>

                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center text-muted py-2">Tidak ada FAQ ditemukan</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<!-- Versi Card untuk Mobile -->
<div class="d-block d-md-none">
  <?php if(!empty($faqs)): ?>
    <?php foreach($faqs as $faq): ?>
      <div class="card mb-2 shadow-sm">
        <div class="card-body p-2">
          <h6 class="mb-1"><strong>Urutan:</strong> <?= $faq['urutan'] ?></h6>
          <p class="mb-1"><strong>Pertanyaan:</strong> <?= $faq['pertanyaan'] ?></p>
          <p class="mb-1"><strong>Jawaban:</strong> <?= $faq['jawaban'] ?></p>
          <p class="mb-1">
            <strong>Status:</strong> 
            <span class="badge <?= ($faq['status'] === 'aktif') ? 'bg-success' : 'bg-secondary' ?>">
              <?= $faq['status'] ?>
            </span>
          </p>
          <div class="d-flex justify-content-end">
            <a href="<?= site_url('admin/layanan/faq/edit/'.$faq['id']) ?>" 
               class="btn btn-warning btn-sm me-1 text-dark shadow-sm">
              <i class="fas fa-edit"></i>
            </a>
            <form action="<?= site_url('admin/layanan/faq/delete/'.$faq['id']) ?>" 
                  method="post" class="d-inline"
                  onsubmit="return confirm('Yakin ingin menghapus FAQ ini?')">
              <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <p class="text-center text-muted">Tidak ada FAQ ditemukan</p>
  <?php endif; ?>
</div>

</div>
