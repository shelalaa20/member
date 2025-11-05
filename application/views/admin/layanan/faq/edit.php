
<div class="card shadow-sm border-0">
  <div class="card-header bg-danger text-white">
    <h5 class="mb-0">
      <i class="fas fa-edit me-2"></i> Edit FAQ
    </h5>
  </div>

  <div class="card-body">
    <form action="<?php echo site_url('admin/layanan/faq/update/'.$faq['id']); ?>" method="post" class="row g-3">

      <div class="col-md-6">
        <label for="pertanyaan" class="form-label fw-bold">Pertanyaan</label>
        <input type="text" name="pertanyaan" id="pertanyaan" 
               class="form-control form-control-sm" 
               value="<?php echo $faq['pertanyaan']; ?>" required>
      </div>

      <div class="col-md-6">
        <label for="urutan" class="form-label fw-bold">Urutan</label>
        <input type="number" name="urutan" id="urutan" 
               class="form-control form-control-sm" 
               value="<?php echo $faq['urutan']; ?>" required>
      </div>

      <div class="col-12">
        <label for="jawaban" class="form-label fw-bold">Jawaban</label>
        <textarea name="jawaban" id="jawaban" 
                  class="form-control form-control-sm" rows="4" required><?php echo $faq['jawaban']; ?></textarea>
      </div>

      <div class="col-md-6">
        <label for="status" class="form-label fw-bold">Status</label>
        <select name="status" id="status" class="form-select form-select-sm" required>
          <option value="aktif" <?php echo $faq['status']=='aktif' ? 'selected' : ''; ?>>Aktif</option>
          <option value="nonaktif" <?php echo $faq['status']=='nonaktif' ? 'selected' : ''; ?>>Nonaktif</option>
        </select>
      </div>

      <div class="col-12 d-flex justify-content-between mt-3">
        <a href="<?php echo site_url('admin/layanan'); ?>" class="btn btn-secondary btn-sm">
          <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
        <button type="submit" class="btn btn-success btn-sm">
          <i class="fas fa-save me-1"></i> Update
        </button>
      </div>
    </form>
  </div>
</div>
