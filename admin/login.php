<?php
session_start();

// kalau admin udah login langsung ke dashboard
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    // password admin
    if ($password === 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = "Password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin | Futsal Taruna Mandiri</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #00ff9d;
      --secondary-color: #08111e;
      --accent-color: #00b4ff;
      --text-color: #e6e6e6;
      --text-light: #cfcfcf;
      --danger-color: #ff6868;
      --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: linear-gradient(135deg, #0b1628 0%, #112233 50%, #0a1525 100%);
      font-family: 'Poppins', sans-serif;
      color: var(--text-color);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 80%, rgba(0, 255, 157, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(0, 180, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(0, 255, 157, 0.05) 0%, transparent 50%);
      z-index: -1;
    }

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      max-width: 1200px;
      animation: fadeIn 0.8s ease;
    }

    .login-illustration {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .illustration-content {
      text-align: center;
      max-width: 400px;
    }

    .illustration-icon {
      font-size: 8rem;
      margin-bottom: 20px;
      display: block;
      filter: drop-shadow(0 0 20px rgba(0, 255, 157, 0.3));
    }

    .illustration-content h2 {
      color: var(--primary-color);
      font-size: 2rem;
      margin-bottom: 15px;
    }

    .illustration-content p {
      color: var(--text-light);
      font-size: 1.1rem;
      line-height: 1.6;
    }

    .login-box {
      flex: 1;
      max-width: 450px;
      background: rgba(15, 27, 44, 0.9);
      padding: 50px 40px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.05),
        0 0 30px rgba(0, 255, 157, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.08);
      position: relative;
      overflow: hidden;
      transition: var(--transition);
    }

    .login-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .login-box:hover {
      transform: translateY(-5px);
      box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        0 0 40px rgba(0, 255, 157, 0.15);
    }

    .logo {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
      margin-bottom: 30px;
    }

    .logo-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--primary-color);
    }

    .logo-text {
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--primary-color);
    }

    .login-box h2 {
      color: var(--primary-color);
      font-size: 2.2rem;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .login-subtitle {
      color: var(--text-light);
      margin-bottom: 30px;
      font-size: 1rem;
    }

    .error-message {
      background: rgba(255, 104, 104, 0.1);
      color: var(--danger-color);
      padding: 12px 20px;
      border-radius: 10px;
      margin-bottom: 25px;
      border-left: 3px solid var(--danger-color);
      text-align: left;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: shake 0.5s ease;
    }

    .error-message::before {
      content: '⚠';
      font-size: 1.2rem;
    }

    .form-group {
      margin-bottom: 25px;
      text-align: left;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      color: var(--text-light);
      font-weight: 500;
      font-size: 0.9rem;
    }

    .password-container {
      position: relative;
    }

    input[type="password"] {
      width: 100%;
      padding: 15px 20px;
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      font-size: 16px;
      color: var(--text-color);
      transition: var(--transition);
      font-family: 'Poppins', sans-serif;
    }

    input[type="password"]:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(0, 255, 157, 0.1);
      background: rgba(255, 255, 255, 0.08);
    }

    input[type="password"]::placeholder {
      color: #888;
    }

    .password-toggle {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: var(--text-light);
      cursor: pointer;
      font-size: 1.2rem;
      transition: var(--transition);
    }

    .password-toggle:hover {
      color: var(--primary-color);
    }

    .btn-login {
      width: 100%;
      padding: 16px;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: var(--secondary-color);
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 5px 15px rgba(0, 255, 157, 0.3);
      position: relative;
      overflow: hidden;
    }

    .btn-login::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: 0.5s;
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 255, 157, 0.4);
    }

    .btn-login:hover::before {
      left: 100%;
    }

    .btn-back {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin-top: 25px;
      text-decoration: none;
      color: var(--primary-color);
      font-weight: 500;
      transition: var(--transition);
      padding: 10px 20px;
      border-radius: 8px;
    }

    .btn-back:hover {
      color: var(--accent-color);
      background: rgba(0, 255, 157, 0.1);
      transform: translateX(-5px);
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }

    /* Floating elements */
    .floating-elements {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .floating-element {
      position: absolute;
      background: rgba(0, 255, 157, 0.1);
      border-radius: 50%;
      animation: float 6s ease-in-out infinite;
    }

    .floating-element:nth-child(1) {
      width: 80px;
      height: 80px;
      top: 10%;
      left: 10%;
      animation-delay: 0s;
    }

    .floating-element:nth-child(2) {
      width: 120px;
      height: 120px;
      top: 60%;
      right: 10%;
      animation-delay: 2s;
    }

    .floating-element:nth-child(3) {
      width: 60px;
      height: 60px;
      bottom: 20%;
      left: 20%;
      animation-delay: 4s;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        gap: 40px;
      }

      .login-illustration {
        padding: 20px;
      }

      .illustration-icon {
        font-size: 5rem;
      }

      .illustration-content h2 {
        font-size: 1.5rem;
      }

      .login-box {
        padding: 40px 30px;
      }

      .logo-text {
        font-size: 1.3rem;
      }

      .login-box h2 {
        font-size: 1.8rem;
      }
    }

    @media (max-width: 480px) {
      body {
        padding: 15px;
      }

      .login-box {
        padding: 30px 20px;
      }

      .illustration-icon {
        font-size: 4rem;
      }

      .logo {
        flex-direction: column;
        gap: 10px;
      }
    }
  </style>
</head>
<body>
  <!-- Floating background elements -->
  <div class="floating-elements">
    <div class="floating-element"></div>
    <div class="floating-element"></div>
    <div class="floating-element"></div>
  </div>

  <div class="login-container">
    <div class="login-illustration">
      <div class="illustration-content">
        <span class="illustration-icon">🔐</span>
        <h2>Admin Panel</h2>
        <p>Masuk ke dashboard admin untuk mengelola booking lapangan, melihat laporan, dan mengatur sistem.</p>
      </div>
    </div>

    <div class="login-box">
      <div class="logo">
        <img src="../assets/images/logo.jpg" alt="logo" class="logo-img">
        <span class="logo-text">Futsal Taruna Mandiri</span>
      </div>

      <h2>Login Admin</h2>
      <p class="login-subtitle">Masukkan password untuk mengakses panel admin</p>

      <?php if (!empty($error)): ?>
        <div class="error-message">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" id="loginForm">
        <div class="form-group">
          <label class="form-label">Password Admin</label>
          <div class="password-container">
            <input type="password" name="password" placeholder="Masukkan password admin" required id="password">
            <button type="button" class="password-toggle" id="togglePassword">👁️</button>
          </div>
        </div>

        <button type="submit" class="btn-login">
          🔐 Masuk ke Dashboard
        </button>
      </form>

      <!-- Tombol kembali -->
      <a href="../index.php" class="btn-back">
        ← Kembali ke Beranda
      </a>
    </div>
  </div>

  <script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.textContent = type === 'password' ? '👁️' : '🔒';
    });

    // Form submission animation
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(e) {
      const btn = this.querySelector('.btn-login');
      btn.textContent = '⏳ Memproses...';
      btn.disabled = true;
      
      // Simulate loading for better UX
      setTimeout(() => {
        btn.textContent = '🔐 Masuk ke Dashboard';
        btn.disabled = false;
      }, 2000);
    });

    // Add floating animation to login box on load
    document.addEventListener('DOMContentLoaded', function() {
      const loginBox = document.querySelector('.login-box');
      loginBox.style.animation = 'fadeIn 0.8s ease';
    });

    // Add focus effect to password input
    passwordInput.addEventListener('focus', function() {
      this.parentElement.style.transform = 'scale(1.02)';
    });

    passwordInput.addEventListener('blur', function() {
      this.parentElement.style.transform = 'scale(1)';
    });
  </script>
</body>
</html>