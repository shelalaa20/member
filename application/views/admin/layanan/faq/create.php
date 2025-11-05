<div class="container mt-4">

  <div class="card shadow-sm border-0">
    <div class="card-header bg-danger text-white">
      <h5 class="mb-0">
        <i class="fas fa-question-circle me-2"></i> Tambah FAQ
      </h5>
    </div>

    <div class="card-body">
      <form action="<?php echo site_url('admin/layanan/faq/store'); ?>" method="post" class="row g-3">
        <div class="col-md-6">
          <label for="pertanyaan" class="form-label fw-bold">Pertanyaan</label>
          <input type="text" name="pertanyaan" id="pertanyaan" class="form-control form-control-sm" required>
        </div>

        <div class="col-md-6">
          <label for="urutan" class="form-label fw-bold">Urutan</label>
          <input type="number" name="urutan" id="urutan" class="form-control form-control-sm" value="1" required>
        </div>

        <div class="col-12">
          <label for="jawaban" class="form-label fw-bold">Jawaban</label>
          <textarea name="jawaban" id="jawaban" class="form-control form-control-sm" rows="4" required></textarea>
        </div>

        <div class="col-md-6">
          <label for="status" class="form-label fw-bold">Status</label>
          <select name="status" id="status" class="form-select form-select-sm" required>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
          </select>
        </div>

        <div class="col-12 d-flex justify-content-between mt-3">
          <a href="<?php echo site_url('admin/layanan'); ?>" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
          </a>
          <button type="submit" class="btn btn-success btn-sm">
            <i class="fas fa-save me-1"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
