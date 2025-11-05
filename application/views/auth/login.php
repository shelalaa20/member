<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Google Fonts (Poppins) -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body, html { height:100%; margin:0; font-family:'Poppins', sans-serif; background:linear-gradient(135deg,#f8f9fa,#e9ecef); }
    .login-container{ min-height:100vh; display:flex; justify-content:center; align-items:center; padding:12px; }
    .login-card{ width:100%; max-width:380px; background:#fff; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,0.1); overflow:hidden; animation:fadeIn 0.6s ease-in-out; }
    .login-header{ background:linear-gradient(135deg,#b30000 0%,#800000 100%); color:#fff; text-align:center; padding:18px 12px; }
    .login-header img{ max-height:45px; margin-bottom:6px; }
    .login-header h4{ margin:0; font-weight:600; font-size:1rem; }
    .login-body{ padding:18px 20px; }
    .form-label{ font-weight:500; font-size:0.8rem; color:#333; }
    .form-control{ border-radius:8px; padding:8px 10px; font-size:0.85rem; }
    .input-group-text{ border-radius:8px; font-size:0.85rem; }
    .btn-danger{ border-radius:8px; padding:9px; font-weight:600; font-size:0.85rem; background:linear-gradient(135deg,#b30000,#800000); border:none; transition:all 0.3s ease; }
    .btn-danger:hover{ background:linear-gradient(135deg,#cc0000,#990000); transform:translateY(-1px); box-shadow:0 4px 10px rgba(179,0,0,0.25); }
    .login-footer{ text-align:center; font-size:0.72rem; color:#6c757d; padding:10px; background:#f8f9fa; border-top:1px solid #eee; }
    .login-footer i{ color:#28a745; }
    a.text-danger{ font-weight:500; font-size:0.78rem; text-decoration:none; }
    a.text-danger:hover{ text-decoration:underline; }
    @keyframes fadeIn{ from{opacity:0; transform:translateY(-15px);} to{opacity:1; transform:translateY(0);} }
    @media(max-width:576px){ .login-card{ margin:0 8px; } }
  </style>
</head>
<body>

<div class="login-container">
  <div class="login-card">
    <!-- Header -->
    <div class="login-header">
      <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo"> 
      <h4><i class="fas fa-user-lock me-2"></i> Masuk ke Akun</h4>
    </div>

    <!-- Body -->
    <div class="login-body">
      <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger small mb-3"><?= $this->session->flashdata('error') ?></div>
      <?php endif; ?>

      <form action="<?= base_url('login/process') ?>" method="post">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-group">
            <input type="password" id="passwordInput" name="password" class="form-control" placeholder="Masukkan password" required>
            <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
              <i class="fas fa-eye"></i>
            </span>
          </div>
          <small class="text-muted" style="font-size:0.7rem;">Pelanggan gunakan ID sebagai password default</small>
        </div>
        <button type="submit" class="btn btn-danger w-100">
          <i class="fas fa-sign-in-alt me-2"></i> Masuk
        </button>
      </form>
    </div>


  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const passwordInput = document.querySelector('#passwordInput');
  const icon = togglePassword.querySelector('i');

  togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
  });
</script>

</body>
</html>
