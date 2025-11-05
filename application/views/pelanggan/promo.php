
<div class="container mt-3">
<div class="d-flex align-items-center mb-3">
  <a href="<?= site_url('pelanggan/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
  <i class="fas fa-arrow-left me-1"></i> Kembali
  </a>
</div>
  <!-- Header Section -->
  <div class="card mb-3 promo-header-card">
    <div class="card-body p-3">
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
          <div class="promo-header-icon me-3">
            <i class="fas fa-gift"></i>
          </div>
          <div>
            <div class="promo-header-title">Promo Aktif</div>
            <div class="promo-header-subtitle">Dapatkan penawaran terbaik untuk Anda</div>
          </div>
        </div>
        <div class="promo-decoration">
          <i class="fas fa-percentage promo-float-icon"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Banner Grid -->
  <div class="row g-3">
    <?php if (!empty($banners)): ?>
      <?php foreach ($banners as $banner): ?>
        <div class="col-12 col-md-6 col-lg-4">
          <div class="promo-card">
            <div class="promo-image-container">
              <img src="<?= base_url('assets/uploads/banner/' . $banner['gambar']) ?>" 
                   class="promo-image"
                   alt="<?= esc($banner['judul']) ?>"
                   loading="lazy">
              <div class="promo-overlay">
                <div class="promo-badge">
                  <i class="fas fa-star me-1"></i>
                  PROMO
                </div>
              </div>
            </div>
            <div class="promo-content">
              <h6 class="promo-title"><?= esc($banner['judul']) ?></h6>
              <?php if (!empty($banner['deskripsi'])): ?>
                <p class="promo-description"><?= esc($banner['deskripsi']) ?></p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="empty-state">
          <div class="empty-state-icon">
            <i class="fas fa-gift"></i>
          </div>
          <h5 class="empty-state-title">Belum Ada Promo Aktif</h5>
          <p class="empty-state-text">Tunggu promo menarik dari kami segera!</p>
        </div>
      </div>
    <?php endif; ?>
  </div>



</div>

<style>
/* Promo Header Card - mirip greeting card */
.promo-header-card {
  background: linear-gradient(135deg, #b30000 0%, #800000 100%);
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(179,0,0,0.2);
  overflow: hidden;
  position: relative;
}

.promo-header-card::before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 80px;
  height: 80px;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  border-radius: 50%;
  transform: translate(20px, -20px);
}

.promo-header-icon {
  width: 45px;
  height: 45px;
  background: rgba(255,255,255,0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(10px);
}

.promo-header-icon i {
  font-size: 1.5rem;
  color: white;
}

.promo-header-title {
  color: white;
  font-size: 1.1rem;
  font-weight: 700;
  text-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

.promo-header-subtitle {
  color: rgba(255,255,255,0.9);
  font-size: 0.8rem;
  font-weight: 500;
}

.promo-decoration {
  opacity: 0.3;
}

.promo-float-icon {
  font-size: 2rem;
  color: white;
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-5px); }
}

/* Promo Cards */
.promo-card {
  background: white;
  border-radius: 16px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  height: 100%;
  position: relative;
}

.promo-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.promo-image-container {
  position: relative;
  overflow: hidden;
}

.promo-image {
  width: 100%;
  aspect-ratio: 1 / 1; /* persegi */
  object-fit: cover;
  transition: transform 0.3s ease;
}


.promo-card:hover .promo-image {
  transform: scale(1.05);
}

.promo-overlay {
  position: absolute;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  background: linear-gradient(45deg, transparent 60%, rgba(179,0,0,0.1) 100%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.promo-card:hover .promo-overlay {
  opacity: 1;
}

.promo-badge {
  position: absolute;
  top: 12px;
  right: 12px;
  background: linear-gradient(135deg, #b30000, #800000);
  color: white;
  padding: 4px 8px;
  border-radius: 20px;
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.promo-content {
  padding: 1rem;
}

.promo-title {
  font-weight: 700;
  font-size: 0.95rem;
  color: #2c3e50;
  margin-bottom: 0.5rem;
  line-height: 1.3;
}

.promo-description {
  color: #6c757d;
  font-size: 0.85rem;
  line-height: 1.4;
  margin-bottom: 0.75rem;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.promo-footer {
  margin-top: auto;
}

.promo-footer small {
  font-size: 0.75rem;
  color: #adb5bd;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 3rem 1rem;
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border-radius: 16px;
  border: 2px dashed #dee2e6;
}

.empty-state-icon {
  width: 80px;
  height: 80px;
  background: linear-gradient(135deg, #b30000, #800000);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1rem;
  opacity: 0.8;
}

.empty-state-icon i {
  font-size: 2rem;
  color: white;
}

.empty-state-title {
  color: #495057;
  font-weight: 600;
  margin-bottom: 0.5rem;
  font-size: 1.1rem;
}

.empty-state-text {
  color: #6c757d;
  font-size: 0.9rem;
  margin-bottom: 0;
}

/* Button consistency */
.btn-secondary {
  background: #6c757d;
  border-color: #6c757d;
  font-size: 0.85rem;
  padding: 0.5rem 1rem;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn-secondary:hover {
  background: #545862;
  border-color: #545862;
  transform: translateY(-1px);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .promo-header-icon {
    width: 40px;
    height: 40px;
  }
  
  .promo-header-icon i {
    font-size: 1.3rem;
  }
  
  .promo-header-title {
    font-size: 1rem;
  }
  
  .promo-header-subtitle {
    font-size: 0.75rem;
  }
  
  .promo-float-icon {
    font-size: 1.5rem;
  }
  
  .promo-content {
    padding: 0.8rem;
  }
  
  .promo-title {
    font-size: 0.9rem;
  }
  
  .promo-description {
    font-size: 0.8rem;
  }
}

@media (max-width: 576px) {
  .container {
    padding-left: 0.8rem;
    padding-right: 0.8rem;
  }
  
  .promo-header-card .card-body {
    padding: 0.8rem !important;
  }
  
  .promo-header-icon {
    width: 35px;
    height: 35px;
  }
  
  .promo-header-icon i {
    font-size: 1.1rem;
  }
  
  .promo-header-title {
    font-size: 0.95rem;
  }
  
  .promo-header-subtitle {
    font-size: 0.7rem;
  }
  
  .promo-float-icon {
    font-size: 1.3rem;
  }
  
  .promo-content {
    padding: 0.7rem;
  }
  
  .promo-title {
    font-size: 0.85rem;
  }
  
  .promo-description {
    font-size: 0.75rem;
  }
  
  .promo-footer small {
    font-size: 0.7rem;
  }
  
  .empty-state {
    padding: 2rem 1rem;
  }
  
  .empty-state-icon {
    width: 60px;
    height: 60px;
  }
  
  .empty-state-icon i {
    font-size: 1.5rem;
  }
  
  .empty-state-title {
    font-size: 1rem;
  }
  
  .empty-state-text {
    font-size: 0.8rem;
  }
}

/* Loading animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.promo-header-card,
.promo-card,
.empty-state {
  animation: fadeInUp 0.5s ease forwards;
}

.promo-card:nth-child(2) {
  animation-delay: 0.1s;
}

.promo-card:nth-child(3) {
  animation-delay: 0.2s;
}

.promo-card:nth-child(4) {
  animation-delay: 0.3s;
}

/* Enhanced hover interactions */
.promo-header-card:hover {
  transform: translateY(-2px);
  transition: all 0.3s ease;
}

.promo-badge:hover {
  transform: scale(1.05);
  transition: transform 0.2s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Add click animation to promo cards
  document.querySelectorAll('.promo-card').forEach(card => {
    card.addEventListener('click', function(e) {
      this.style.transform = 'scale(0.98)';
      setTimeout(() => {
        this.style.transform = '';
      }, 150);
    });
  });
  
  // // Lazy loading for images
  // const images = document.querySelectorAll('.promo-image');
  // const imageObserver = new IntersectionObserver((entries, observer) => {
  //   entries.forEach(entry => {
  //     if (entry.isIntersecting) {
  //       const img = entry.target;
  //       img.style.opacity = '0';
  //       img.addEventListener('load', () => {
  //         img.style.transition = 'opacity 0.3s ease';
  //         img.style.opacity = '1';
  //       });
  //       observer.unobserve(img);
  //     }
  //   });
  // });
  
  // images.forEach(img => imageObserver.observe(img));
  
  // Add parallax effect to header
  window.addEventListener('scroll', function() {
    const header = document.querySelector('.promo-header-card');
    const scrolled = window.pageYOffset;
    if (header) {
      header.style.transform = `translateY(${scrolled * 0.1}px)`;
    }
  });
});
</script>

