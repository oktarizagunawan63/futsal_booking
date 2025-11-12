<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Futsal Taruna Mandiri - Sistem pemesanan lapangan futsal online yang mudah, cepat, dan efisien di Pamulang.">
  <title>Beranda | Futsal Taruna Mandiri - Booking Lapangan Futsal Terbaik</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #00ff9d;
      --secondary-color: #08111e;
      --accent-color: #00b4ff;
      --text-color: #e6e6e6;
      --text-light: #cfcfcf;
      --card-bg: rgba(255, 255, 255, 0.05);
      --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: var(--secondary-color);
      color: var(--text-color);
      font-family: 'Poppins', sans-serif;
      line-height: 1.8;
      overflow-x: hidden;
    }

    /* Header & Navigation */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 10%;
      background: rgba(8, 17, 30, 0.95);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
      backdrop-filter: blur(10px);
      transition: var(--transition);
    }

    .navbar.scrolled {
      padding: 15px 10%;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--primary-color);
    }

    .logo-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--primary-color);
      transition: var(--transition);
    }

    .logo:hover .logo-img {
      transform: rotate(10deg);
    }

    nav {
      display: flex;
      gap: 30px;
    }

    nav a {
      color: var(--text-color);
      text-decoration: none;
      font-weight: 500;
      position: relative;
      padding: 8px 0;
      transition: var(--transition);
    }

    nav a:hover, nav a.active {
      color: var(--primary-color);
    }

    nav a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary-color);
      transition: var(--transition);
    }

    nav a:hover::after, nav a.active::after {
      width: 100%;
    }

    /* Hero Section */
    .hero {
      display: flex;
      align-items: center;
      justify-content: space-between;
      min-height: 100vh;
      padding: 120px 10% 80px;
      position: relative;
      overflow: hidden;
    }

    .hero::before {
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

    .hero-content {
      flex: 1;
      max-width: 600px;
      animation: fadeInLeft 1s ease;
    }

    .hero-content h1 {
      font-size: 3.5rem;
      line-height: 1.2;
      margin-bottom: 20px;
      color: var(--primary-color);
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    }

    .hero-content h1::after {
      content: '';
      display: block;
      width: 100px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      margin: 15px 0;
      border-radius: 2px;
    }

    .hero-content p {
      font-size: 1.2rem;
      color: var(--text-light);
      margin-bottom: 30px;
    }

    .btn-book {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: var(--secondary-color);
      padding: 15px 35px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.1rem;
      transition: var(--transition);
      box-shadow: 0 5px 15px rgba(0, 255, 157, 0.3);
      position: relative;
      overflow: hidden;
    }

    .btn-book::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: 0.5s;
    }

    .btn-book:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 255, 157, 0.4);
    }

    .btn-book:hover::before {
      left: 100%;
    }

    .hero-image {
      flex: 1;
      display: flex;
      justify-content: flex-end;
      animation: fadeInRight 1s ease;
    }

    .hero-image img {
      max-width: 100%;
      height: auto;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
      transform: perspective(1000px) rotateY(-10deg) rotateX(5deg);
      transition: var(--transition);
      border: 2px solid rgba(0, 255, 157, 0.2);
    }

    .hero-image img:hover {
      transform: perspective(1000px) rotateY(0) rotateX(0);
      box-shadow: 0 25px 50px rgba(0, 255, 157, 0.2);
    }

    /* Features Section */
    .features {
      padding: 100px 10%;
      background: rgba(255, 255, 255, 0.02);
    }

    .section-title {
      text-align: center;
      margin-bottom: 60px;
    }

    .section-title h2 {
      font-size: 2.5rem;
      color: var(--primary-color);
      margin-bottom: 15px;
      position: relative;
      display: inline-block;
    }

    .section-title h2::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--primary-color);
      border-radius: 3px;
    }

    .section-title p {
      color: var(--text-light);
      max-width: 600px;
      margin: 0 auto;
      font-size: 1.1rem;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .feature-card {
      background: var(--card-bg);
      border-radius: 16px;
      padding: 40px 30px;
      text-align: center;
      transition: var(--transition);
      border: 1px solid rgba(255, 255, 255, 0.05);
      position: relative;
      overflow: hidden;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      transform: scaleX(0);
      transform-origin: left;
      transition: var(--transition);
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      border-color: rgba(0, 255, 157, 0.2);
    }

    .feature-card:hover::before {
      transform: scaleX(1);
    }

    .feature-icon {
      font-size: 3rem;
      margin-bottom: 20px;
      display: block;
    }

    .feature-card h3 {
      color: var(--primary-color);
      margin-bottom: 15px;
      font-size: 1.5rem;
    }

    .feature-card p {
      color: var(--text-light);
    }

    /* CTA Section */
    .cta {
      padding: 100px 10%;
      text-align: center;
      background: linear-gradient(135deg, rgba(0,255,157,0.1), rgba(0,180,255,0.1));
      position: relative;
      overflow: hidden;
    }

    .cta::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(0,255,157,0.05) 0%, transparent 70%);
      animation: rotate 20s linear infinite;
      z-index: 0;
    }

    .cta-content {
      position: relative;
      z-index: 1;
    }

    .cta h2 {
      font-size: 2.5rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }

    .cta p {
      color: var(--text-light);
      margin-bottom: 30px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      font-size: 1.1rem;
    }

    /* Footer */
    .footer {
      text-align: center;
      padding: 40px 0;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #999;
      font-size: 0.9rem;
      background: rgba(8, 17, 30, 0.8);
    }

    /* Animations */
    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(50px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes rotate {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(360deg);
      }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .hero {
        flex-direction: column;
        text-align: center;
        padding: 120px 5% 60px;
      }

      .hero-content, .hero-image {
        max-width: 100%;
      }

      .hero-image {
        justify-content: center;
        margin-top: 40px;
      }

      .hero-content h1 {
        font-size: 3rem;
      }
    }

    @media (max-width: 768px) {
      .navbar {
        padding: 15px 5%;
        flex-direction: column;
        gap: 15px;
      }

      nav {
        gap: 20px;
      }

      .hero-content h1 {
        font-size: 2.5rem;
      }

      .hero-content p {
        font-size: 1.1rem;
      }

      .section-title h2 {
        font-size: 2rem;
      }

      .features, .cta {
        padding: 80px 5%;
      }

      .feature-card {
        padding: 30px 20px;
      }
    }

    @media (max-width: 480px) {
      .hero-content h1 {
        font-size: 2rem;
      }

      .btn-book {
        padding: 12px 25px;
        font-size: 1rem;
      }

      .section-title h2 {
        font-size: 1.8rem;
      }

      .cta h2 {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <img src="assets/images/logo.jpg" alt="logo" class="logo-img">
      <span>Futsal Taruna Mandiri</span>
    </div>
    <nav>
      <a href="index.php" class="active">Beranda</a>
      <a href="lapangan.php">Lapangan</a>
      <a href="tentang.php">Tentang</a>
      <a href="admin/login.php">Admin</a>
    </nav>
  </header>

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-content">
      <h1>⚽ Booking Lapangan Futsal ⚽</h1>
      <p>
        Sistem pemesanan lapangan futsal online yang mudah, cepat, dan efisien.<br>
        Nikmati pengalaman bermain terbaik dengan fasilitas lengkap dan pelayanan profesional.
      </p>
      <a href="lapangan.php" class="btn-book">Booking Sekarang</a>
    </div>

    <div class="hero-image">
      <img src="assets/images/futsal.jpg" alt="Lapangan Futsal">
    </div>
  </section>

  <!-- FEATURES SECTION -->
  <section class="features">
    <div class="section-title">
      <h2>Mengapa Memilih Kami?</h2>
      <p>Kami menyediakan pengalaman bermain futsal terbaik dengan berbagai keunggulan</p>
    </div>

    <div class="features-grid">
      <div class="feature-card">
        <span class="feature-icon">🚀</span>
        <h3>Booking Online Mudah</h3>
        <p>Pesan lapangan kapan saja, di mana saja melalui sistem booking online yang sederhana dan cepat.</p>
      </div>

      <div class="feature-card">
        <span class="feature-icon">⭐</span>
        <h3>Fasilitas Premium</h3>
        <p>Lapangan berkualitas tinggi, pencahayaan optimal, dan fasilitas pendukung lengkap untuk kenyamanan bermain.</p>
      </div>

      <div class="feature-card">
        <span class="feature-icon">💰</span>
        <h3>Harga Terjangkau</h3>
        <p>Nikmati tarif kompetitif dengan berbagai pilihan paket sesuai kebutuhan dan budget Anda.</p>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <p>© 2025 Futsal Taruna Mandiri | Semua Hak Dilindungi</p>
  </footer>

  <script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
      const navbar = document.querySelector('.navbar');
      if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });

    // Smooth scroll for navigation links
    document.querySelectorAll('nav a').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if(targetId === 'index.php' || targetId === 'lapangan.php' || targetId === 'tentang.php' || targetId === 'admin/login.php') {
          window.location.href = targetId;
          return;
        }
        
        const targetElement = document.querySelector(targetId);
        if(targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 100,
            behavior: 'smooth'
          });
        }
      });
    });

    // Add animation to feature cards on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animation = `fadeInUp 0.6s ease forwards`;
          entry.target.style.opacity = '0';
          entry.target.style.transform = 'translateY(30px)';
          setTimeout(() => {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }, 200);
        }
      });
    }, observerOptions);

    // Observe feature cards
    document.querySelectorAll('.feature-card').forEach(card => {
      observer.observe(card);
    });
  </script>
</body>
</html>