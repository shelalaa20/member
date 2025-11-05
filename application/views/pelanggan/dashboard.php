
<?php 
// langsung pakai link yang sudah disimpan admin
$waLink = $infoLayanan['wa_cs']; 
$fullName = trim($member['nama']);
$firstName = explode(' ', $fullName)[0];
?>
<div class="container mt-3">

<!-- Enhanced Greeting -->
<div class="card mb-3 greeting-card">
  <div class="card-body p-3">
    <div class="d-flex align-items-center justify-content-between">
  <div class="d-flex align-items-center">
    <div class="greeting-avatar me-3">
      <i class="fas fa-user-circle"></i>
    </div>
    <div>
      <div class="greeting-time mb-1" id="greetingTime">Selamat Pagi</div>
      <div class="greeting-name"><?= esc($firstName) ?> 👋</div>
    </div>
  </div>

  <!-- Kanan: icon + tanggal realtime -->
  <div class="text-end">
    <div class="greeting-decoration mb-1">
      <i class="fas fa-sun greeting-icon" id="greetingIcon"></i>
    </div>
    <div id="currentDate" class="text-white small fw-semibold"></div>
  </div>
</div>

  </div>
</div>

<!-- Informasi Profil -->
<div class="card mb-3">
  <div class="card-header py-2">
    <i class="fas fa-user me-2"></i>
    Informasi Profil Anda
  </div>
  <div class="card-body py-3">
    <div class="d-flex align-items-center">
      <div class="me-3">
        <div class="profile-icon">
          <i class="fas fa-id-card"></i>
        </div>
      </div>
      <div>
        <div class="profile-name">
          <?= str_replace('.', ".<br>", esc($member['nama'])) ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer dengan link detail -->
  <div class="card-footer text-end py-2">
  <a href="<?= site_url('pelanggan/profile') ?>" class="text-dark fw-bold text-decoration-none small">
      <i class="fas fa-eye me-1"></i> Detail Profil
    </a>
  </div>
</div>

<!-- Informasi Paket -->
<div class="card">
  <div class="card-header py-2">
    <i class="fas fa-box me-2"></i>
    Informasi Paket Anda
  </div>
  <div class="card-body py-3">
    <div class="row g-3">
      <div class="col-md-4">
        <div class="d-flex align-items-center">
          <div class="me-3">
            <div class="package-icon">
              <i class="fas fa-tag"></i>
            </div>
          </div>
          <div>
            <small class="text-muted">Paket</small>
            <div class="package-info"><?= esc($member['nama_paket']) ?></div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="d-flex align-items-center">
          <div class="me-3">
            <div class="package-icon">
              <i class="fas fa-tachometer-alt"></i>
            </div>
          </div>
          <div>
            <small class="text-muted">Kecepatan</small>
            <div class="package-info"> Up To <?= esc($member['kecepatan']) ?></div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="d-flex align-items-center">
          <div class="me-3">
            <div class="package-icon">
              <i class="fas fa-calendar-alt"></i>
            </div>
          </div>
          <div>
            <small class="text-muted">Jatuh Tempo</small>
            <div class="package-info">Tiap tanggal <?= esc($member['jatuh_tempo']) ?></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
  <div class="d-flex align-items-center">
    <div class="me-3">
      <div class="package-icon">
        <i class="fas fa-wallet"></i>
      </div>
    </div>
    <div>
      <small class="text-muted">Status Bayar</small>
      <div class="package-info">
        <?php if ($member['status_bayar'] == 'Lunas'): ?>
          <span class="text-success fw-bold">Lunas</span>
        <?php elseif ($member['status_bayar'] == 'Belum Bayar'): ?>
          <span class="text-danger fw-bold">Belum Bayar</span>
        <?php else: ?>
          <span class="text-secondary"><?= esc($member['status_bayar']) ?></span>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
  <!-- Footer keterangan update -->
  <div class="card-footer text-end py-2">
    <small class="text-muted">Status pembayaran diperbarui setiap pukul <strong>17.00</strong></small>
  </div>
</div>


    </div>
  </div>
</div>

<!-- Menu Grid (Desktop) -->
<div class="menu-grid">
  <a href="<?= $waLink ?>" target="_blank" class="menu-item">
    <i class="fas fa-headset"></i>
    <span>Bantuan</span>
  </a>
  
  <!-- Menu Tutorial YouTube -->
<a href="<?= esc($infoLayanan['youtube']) ?>" target="_blank" class="menu-item">
  <i class="fab fa-youtube"></i>
  <span>Tutorial</span>
</a>

<!-- Menu Promo -->
<a href="<?= site_url('pelanggan/promo') ?>" class="menu-item">
    <i class="fas fa-gift"></i>
    <span>Promo</span>
  </a>

   <!-- Menu Profil -->
   <a href="<?= site_url('pelanggan/profile') ?>" class="menu-item">
    <i class="fas fa-user-cog"></i>
    <span>Profil</span>
  </a>

</div>

<!-- Banner Slider - Clean Version -->
<?php if (!empty($banners)): ?>
<div class="banner-container">
  <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php foreach ($banners as $i => $banner): ?>
        <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
          <img src="<?= base_url('assets/uploads/banner/' . $banner['gambar']) ?>" 
               class="d-block w-100 banner-img"
               alt="<?= esc($banner['judul']) ?>">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
            <h6 class="mb-1"><?= esc($banner['judul']) ?></h6>
            <?php if (!empty($banner['deskripsi'])): ?>
              <p class="mb-0 small"><?= esc($banner['deskripsi']) ?></p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    
    <?php if (count($banners) > 1): ?>
      <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
      
      <!-- Indicators -->
      <div class="carousel-indicators">
        <?php foreach ($banners as $i => $banner): ?>
          <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="<?= $i ?>" 
                  class="<?= $i === 0 ? 'active' : '' ?>"></button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?> 


<!-- Speedtest Widget
<div class="card mb-3">
  <div class="card-header py-2">
    <i class="fas fa-tachometer-alt me-2"></i>
    Speed Test
  </div>
  <div class="card-body py-3">
    <div style="text-align:center;">
      <div style="min-height:360px;">
        <div style="width:100%;height:0;padding-bottom:50%;position:relative;">
          <iframe 
            style="border:none;position:absolute;top:0;left:0;width:100%;height:100%;min-height:360px;overflow:hidden !important;" 
            src="//openspeedtest.com/speedtest">
          </iframe>
        </div>
      </div>
      <small class="text-muted">Provided by <a href="https://openspeedtest.com" target="_blank">OpenSpeedtest.com</a></small>
    </div>
  </div>
</div> -->

<!-- FAQ Section -->
<div class="card mb-3 faq-card">
  <div class="card-header py-2">
    <i class="fas fa-question-circle me-2"></i>
    FAQ
  </div>
  <div class="card-body py-3">
    <?php if (!empty($faqs)): ?>
      <div class="accordion" id="faqAccordion">
        <?php foreach ($faqs as $i => $faq): ?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading<?= $i ?>">
              <button class="accordion-button collapsed" type="button" 
                      data-bs-toggle="collapse" 
                      data-bs-target="#collapse<?= $i ?>" 
                      aria-expanded="false" 
                      aria-controls="collapse<?= $i ?>">
                <?= esc($faq['pertanyaan']) ?>
              </button>
            </h2>
            <div id="collapse<?= $i ?>" class="accordion-collapse collapse" 
                 aria-labelledby="heading<?= $i ?>" 
                 data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                <?= esc($faq['jawaban'],'raw') ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-muted small mb-0">Belum ada FAQ.</p>
    <?php endif; ?>
  </div>
</div>



<style>

/* Enhanced Greeting Card */
.greeting-card {
  background: linear-gradient(135deg, #b30000 0%, #800000 100%);
  border: none;
  border-radius: 16px;
  box-shadow: 0 4px 20px rgba(179,0,0,0.2);
  overflow: hidden;
  position: relative;
}

.greeting-card::before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 100px;
  height: 100px;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  border-radius: 50%;
  transform: translate(30px, -30px);
}

.greeting-avatar {
  width: 45px;
  height: 45px;
  background: rgba(255,255,255,0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(10px);
}

.greeting-avatar i {
  font-size: 1.5rem;
  color: white;
}

.greeting-time {
  color: rgba(255,255,255,0.9);
  font-size: 0.8rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.greeting-name {
  color: white;
  font-size: 1.1rem;
  font-weight: 700;
  text-shadow: 0 1px 3px rgba(0,0,0,0.3);
}

.greeting-decoration {
  opacity: 0.3;
}

.greeting-icon {
  font-size: 2rem;
  color: white;
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-5px); }
}

/* Profile and Package Icons */
.profile-icon,
.package-icon {
  width: 35px;
  height: 35px;
  background: linear-gradient(135deg, #b30000, #800000);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 0.9rem;
}

.profile-name,
.package-info {
  font-weight: 600;
  font-size: 0.9rem;
  color: #2c3e50;
  line-height: 1.3;
}

/* Card Headers - Smaller */
.card-header {
  font-size: 0.9rem !important;
  font-weight: 600;
  padding: 0.8rem 1rem !important;
}

.card-body {
  padding: 1rem !important;
}

.card-footer {
  padding: 0.6rem 1rem !important;
  font-size: 0.8rem;
}

/* Clean Banner Container - NO BORDER/PADDING */
.banner-container {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  margin-bottom: 1rem;
  background: transparent;
}

/* Banner Image - Clean */
.banner-img {
  width: 100%;
  aspect-ratio: 4 / 5;
  object-fit: cover;   /* penuh, biar rapi */
  display: block;
}

/* Carousel Controls */
.carousel-control-prev,
.carousel-control-next {
  width: 35px;
  height: 35px;
  background: rgba(179,0,0,0.8);
  border-radius: 50%;
  top: 50%;
  transform: translateY(-50%);
  backdrop-filter: blur(5px);
  transition: all 0.3s ease;
}

.carousel-control-prev:hover,
.carousel-control-next:hover {
  background: rgba(179,0,0,0.9);
  transform: translateY(-50%) scale(1.1);
}

.carousel-control-prev {
  left: 10px;
}

.carousel-control-next {
  right: 10px;
}

.carousel-indicators {
  bottom: 10px;
}

.carousel-indicators button {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background-color: rgba(255,255,255,0.5);
  border: 2px solid rgba(179,0,0,0.8);
}

.carousel-indicators button.active {
  background-color: #b30000;
}

/* Menu Grid - Updated untuk 5 menu */
.menu-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  gap: 1rem;
  margin: 1.5rem 0;
}

.menu-item {
  text-align: center;
  font-size: 0.85rem;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  color: var(--text-dark);
  background: linear-gradient(135deg, white 0%, #f8f9fa 100%);
  padding: 1rem;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  position: relative;
  overflow: hidden;
}

.menu-item i {
  font-size: 2rem;
  background: linear-gradient(135deg, var(--dark-red), var(--primary-red));
  color: #fff;
  border-radius: 50%;
  padding: 15px;
  margin-bottom: 10px;
  transition: all 0.3s ease;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 60px;
}

.menu-item span {
  display: block;
  margin-top: 5px;
  font-weight: 600;
  font-size: 0.85rem;
}

/* Bottom Navigation - Updated untuk 5 menu */
.bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  height: 65px;
  background: linear-gradient(135deg, var(--dark-red) 0%, var(--primary-red) 100%);
  display: none;
  justify-content: space-around;
  align-items: center;
  box-shadow: 0 -2px 15px rgba(0,0,0,0.15);
  z-index: 1000;
  backdrop-filter: blur(10px);
}

.bottom-nav .nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-decoration: none;
  color: rgba(255,255,255,0.8);
  transition: all 0.3s ease;
  padding: 6px 8px;
  border-radius: 10px;
  min-width: 45px;
  text-align: center;
}

.bottom-nav .nav-item:hover,
.bottom-nav .nav-item.active {
  color: white;
  background: rgba(255,255,255,0.15);
  transform: translateY(-2px);
  text-decoration: none;
}

.bottom-nav .nav-item i {
  font-size: 1.1rem;
  margin-bottom: 3px;
}

.bottom-nav .nav-item span {
  font-size: 0.65rem;
  font-weight: 500;
}

/* Mobile Responsive */
@media (max-width: 768px) {
  .greeting-card {
    margin-bottom: 1rem;
  }
  
  .greeting-avatar {
    width: 40px;
    height: 40px;
  }
  
  .greeting-avatar i {
    font-size: 1.3rem;
  }
  
  .greeting-time {
    font-size: 0.7rem;
  }
  
  .greeting-name {
    font-size: 1rem;
  }
  
  .greeting-icon {
    font-size: 1.5rem;
  }
  
  .banner-img {
    /* height: 140px;  <- hapus ini */
    aspect-ratio: 4 / 5;
    object-fit: cover;
  }
  
  .menu-grid {
    display: none;
  }
  
  .bottom-nav {
    display: flex;
    height: 60px;
  }
  
  .card-header {
    font-size: 0.8rem !important;
    padding: 0.7rem 0.9rem !important;
  }
  
  .card-body {
    padding: 0.9rem !important;
  }
  
  .profile-icon,
  .package-icon {
    width: 30px;
    height: 30px;
    font-size: 0.8rem;
  }
  
  .profile-name,
  .package-info {
    font-size: 0.8rem;
  }
  
  .carousel-control-prev,
  .carousel-control-next {
    width: 30px;
    height: 30px;
  }
}

@media (max-width: 576px) {
  .container {
    padding-left: 0.8rem;
    padding-right: 0.8rem;
  }
  
  .greeting-card .card-body {
    padding: 0.8rem !important;
  }
  
  .greeting-avatar {
    width: 35px;
    height: 35px;
  }
  
  .greeting-avatar i {
    font-size: 1.1rem;
  }
  
  .greeting-time {
    font-size: 0.65rem;
  }
  
  .greeting-name {
    font-size: 0.9rem;
  }
  
  .greeting-icon {
    font-size: 1.3rem;
  }
  
  .banner-img {
    aspect-ratio: 4 / 5;
  }
  
  .bottom-nav {
    height: 55px;
  }
  
  .bottom-nav .nav-item {
    padding: 4px 6px;
    min-width: 40px;
  }
  
  .bottom-nav .nav-item i {
    font-size: 0.9rem;
  }
  
  .bottom-nav .nav-item span {
    font-size: 0.6rem;
  }
  
  .card-header {
    font-size: 0.75rem !important;
    padding: 0.6rem 0.8rem !important;
  }
  
  .card-body {
    padding: 0.8rem !important;
  }
  
  .profile-icon,
  .package-icon {
    width: 28px;
    height: 28px;
    font-size: 0.7rem;
  }
  
  .profile-name,
  .package-info {
    font-size: 0.75rem;
  }
  
  small.text-muted {
    font-size: 0.65rem;
  }
}

/* Enhanced animations and interactions */
.greeting-card:hover {
  transform: translateY(-3px) scale(1.02);
  transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.greeting-card:active {
  transform: translateY(-1px) scale(1.01);
}

.card {
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
}

/* Banner hover effect */
.banner-container:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
}

/* Greeting interactions */
.greeting-name-wrapper:hover .greeting-wave {
  animation-duration: 0.6s;
}

.greeting-avatar:hover {
  transform: scale(1.05);
  background: rgba(255,255,255,0.25);
}

.floating-icon:hover {
  transform: scale(1.1) rotate(10deg);
  background: rgba(255,255,255,0.2);
}

/* Loading Animation */
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

.card,
.menu-item,
.banner-container {
  animation: fadeInUp 0.5s ease forwards;
}

.greeting-card {
  animation: fadeInUp 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
}

.menu-item:nth-child(2) {
  animation-delay: 0.1s;
}

.menu-item:nth-child(3) {
  animation-delay: 0.2s;
}

.menu-item:nth-child(4) {
  animation-delay: 0.3s;
}

.menu-item:nth-child(5) {
  animation-delay: 0.4s;
}
</style>

<script>
// Tampilkan tanggal saat ini
function setCurrentDate() {
  const now = new Date();
  const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
  const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  
  const namaHari = hari[now.getDay()];
  const tanggal = now.getDate();
  const namaBulan = bulan[now.getMonth()];
  const tahun = now.getFullYear();
  
  const hasil = `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
  
  const dateElement = document.getElementById('currentDate');
  if (dateElement) {
    dateElement.textContent = hasil;
  }
}

document.addEventListener('DOMContentLoaded', function() {
  setGreeting();
  setCurrentDate(); // ✅ panggil fungsi tanggal di sini
  
  // Add active nav item
  const currentPath = window.location.pathname;
  const navItems = document.querySelectorAll('.bottom-nav .nav-item');
  
  navItems.forEach(item => {
    if (item.getAttribute('href') === currentPath) {
      item.classList.add('active');
    }
  });

  // Carousel
  const carouselEl = document.querySelector('#promoCarousel');
  if (carouselEl) {
    new bootstrap.Carousel(carouselEl, {
      interval: 4000,
      wrap: true,
      pause: 'hover'
    });
  }
});

// Enhanced greeting with dynamic styling
function setGreeting() {
  const now = new Date();
  const hour = now.getHours();
  const greetingElement = document.getElementById('greetingTime');
  const greetingIcon = document.getElementById('greetingIcon');
  const greetingCard = document.querySelector('.greeting-card');
  
  let greeting, icon, cardClass;
  
  if (hour < 10) {
    greeting = 'Selamat Pagi';
    icon = 'fas fa-sun';
    cardClass = 'greeting-morning';
  } else if (hour < 15) {
    greeting = 'Selamat Siang';
    icon = 'fas fa-sun';
    cardClass = 'greeting-afternoon';
  } else if (hour < 18) {
    greeting = 'Selamat Sore';
    icon = 'fas fa-cloud-sun';
    cardClass = 'greeting-evening';
  } else {
    greeting = 'Selamat Malam';
    icon = 'fas fa-moon';
    cardClass = 'greeting-night';
  }
  
  if (greetingElement) {
    greetingElement.textContent = greeting;
  }
  
  if (greetingIcon) {
    greetingIcon.className = icon + ' greeting-icon';
  }
  
  if (greetingCard) {
    greetingCard.classList.add(cardClass);
  }
}

document.addEventListener('DOMContentLoaded', function() {
  // Set enhanced greeting
  setGreeting();
  
  // Add active class to current nav item
  const currentPath = window.location.pathname;
  const navItems = document.querySelectorAll('.bottom-nav .nav-item');
  
  navItems.forEach(item => {
    if (item.getAttribute('href') === currentPath) {
      item.classList.add('active');
    }
  });
  
  // Initialize carousel with custom settings
  const carousel = new bootstrap.Carousel(document.querySelector('#promoCarousel'), {
    interval: 4000,
    wrap: true,
    pause: 'hover'
  });
});

// Add click animation to menu items
document.querySelectorAll('.menu-item').forEach(item => {
  item.addEventListener('click', function(e) {
    this.style.transform = 'scale(0.95)';
    setTimeout(() => {
      this.style.transform = '';
    }, 150);
  });
});

// Add subtle parallax effect to greeting card
window.addEventListener('scroll', function() {
  const greetingCard = document.querySelector('.greeting-card');
  const scrolled = window.pageYOffset;
  if (greetingCard) {
    greetingCard.style.transform = `translateY(${scrolled * 0.1}px)`;
  }
});
</script>

