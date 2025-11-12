<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Tentang Futsal Taruna Mandiri - Pusat olahraga futsal terbaik di wilayah Pamulang dengan fasilitas modern dan layanan profesional.">
  <title>Tentang Kami | Futsal Taruna Mandiri - Fasilitas Futsal Terbaik di Pamulang</title>
  <link rel="stylesheet" href="assets/css/style.css">
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
    .hero-about {
      background: linear-gradient(135deg, rgba(0, 255, 157, 0.15), rgba(0, 180, 255, 0.1)),
                  url('assets/images/lapangan-hero.jpg') center/cover no-repeat;
      color: #fff;
      text-align: center;
      padding: 180px 20px 100px;
      border-bottom: 2px solid var(--primary-color);
      backdrop-filter: blur(3px);
      position: relative;
      overflow: hidden;
    }

    .hero-about::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(8, 17, 30, 0.6);
      z-index: 0;
    }

    .hero-about > * {
      position: relative;
      z-index: 1;
    }

    .hero-about h1 {
      font-size: 3.5rem;
      color: var(--primary-color);
      margin-bottom: 20px;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      animation: fadeInUp 1s ease;
    }

    .hero-about p {
      font-size: 1.2rem;
      max-width: 750px;
      margin: 0 auto;
      color: #d4d4d4;
      animation: fadeInUp 1s ease 0.2s both;
    }

    /* Tentang Section */
    .about-section {
      padding: 80px 10%;
      text-align: center;
    }

    .about-section h2 {
      color: var(--primary-color);
      font-size: 2.5rem;
      margin-bottom: 25px;
      position: relative;
      display: inline-block;
    }

    .about-section h2::after {
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

    .about-section p {
      max-width: 900px;
      margin: 0 auto 40px;
      font-size: 1.1rem;
      color: var(--text-light);
    }

    /* Visi Misi Section */
    .visi-misi {
      background: linear-gradient(135deg, rgba(0,255,157,0.08), rgba(255,255,255,0.02));
      border-radius: 16px;
      padding: 50px 30px;
      margin: 60px auto;
      max-width: 1000px;
      box-shadow: 0 0 20px rgba(0, 255, 157, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.05);
      transition: var(--transition);
    }

    .visi-misi:hover {
      box-shadow: 0 0 30px rgba(0, 255, 157, 0.15);
      transform: translateY(-5px);
    }

    .visi-misi h3 {
      color: var(--primary-color);
      margin-bottom: 20px;
      font-size: 1.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .visi-misi p {
      font-size: 1.1rem;
      color: var(--text-light);
      margin-bottom: 30px;
    }

    .visi-misi ul {
      list-style: none;
      padding: 0;
      text-align: left;
      max-width: 800px;
      margin: 0 auto;
    }

    .visi-misi li {
      background: var(--card-bg);
      border-left: 3px solid var(--primary-color);
      margin: 15px 0;
      padding: 15px 20px;
      border-radius: 8px;
      transition: var(--transition);
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .visi-misi li::before {
      content: '✓';
      color: var(--primary-color);
      font-weight: bold;
    }

    .visi-misi li:hover {
      background: rgba(0,255,157,0.1);
      transform: translateX(10px);
    }

    /* Fasilitas */
    .fasilitas-container {
      margin-top: 80px;
    }

    .fasilitas-container h2 {
      color: var(--primary-color);
      margin-bottom: 40px;
      font-size: 2.5rem;
      position: relative;
      display: inline-block;
    }

    .fasilitas-container h2::after {
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

    .fasilitas-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 30px;
    }

    .fasilitas-card {
      background: var(--card-bg);
      border: 1px solid rgba(255, 255, 255, 0.08);
      border-radius: 12px;
      padding: 30px 25px;
      text-align: center;
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .fasilitas-card::before {
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

    .fasilitas-card:hover {
      background: rgba(0, 255, 157, 0.1);
      border-color: var(--primary-color);
      transform: translateY(-10px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .fasilitas-card:hover::before {
      transform: scaleX(1);
    }

    .fasilitas-card h3 {
      color: var(--primary-color);
      margin-bottom: 15px;
      font-size: 1.3rem;
    }

    .fasilitas-card p {
      color: var(--text-light);
      font-size: 1rem;
    }

    /* Stats Section */
    .stats-section {
      background: linear-gradient(135deg, rgba(0, 180, 255, 0.1), rgba(0, 255, 157, 0.05));
      padding: 80px 10%;
      margin: 80px 0;
      text-align: center;
    }

    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 40px;
      max-width: 1000px;
      margin: 0 auto;
    }

    .stat-item {
      padding: 30px 20px;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 10px;
      display: block;
    }

    .stat-label {
      font-size: 1.1rem;
      color: var(--text-light);
    }

    /* CTA Section */
    .cta-section {
      background: linear-gradient(135deg, rgba(0,255,157,0.1), rgba(0,180,255,0.1));
      padding: 80px 10%;
      text-align: center;
      border-radius: 16px;
      margin: 80px auto;
      max-width: 1000px;
      border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .cta-section h2 {
      color: var(--primary-color);
      font-size: 2.2rem;
      margin-bottom: 20px;
    }

    .cta-section p {
      color: var(--text-light);
      margin-bottom: 30px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .cta-button {
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
    }

    .cta-button:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 255, 157, 0.4);
    }

    /* Footer */
    .footer {
      text-align: center;
      padding: 40px 0;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #999;
      font-size: 0.9rem;
      margin-top: 60px;
      background: rgba(8, 17, 30, 0.8);
    }

    .highlight {
      color: var(--primary-color);
      font-weight: 600;
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive Design */
    @media(max-width: 1024px) {
      .navbar {
        padding: 20px 5%;
      }
      
      .hero-about h1 {
        font-size: 3rem;
      }
    }

    @media(max-width: 768px) {
      .navbar {
        flex-direction: column;
        gap: 15px;
        padding: 15px 5%;
      }
      
      nav {
        gap: 20px;
      }
      
      .hero-about {
        padding: 150px 20px 80px;
      }
      
      .hero-about h1 {
        font-size: 2.5rem;
      }
      
      .about-section, .stats-section, .cta-section {
        padding: 60px 5%;
      }
      
      .about-section h2, .fasilitas-container h2 {
        font-size: 2rem;
      }
      
      .visi-misi {
        padding: 40px 20px;
      }
      
      .stat-number {
        font-size: 2.5rem;
      }
    }

    @media(max-width: 480px) {
      .hero-about h1 {
        font-size: 2rem;
      }
      
      .hero-about p {
        font-size: 1rem;
      }
      
      .about-section h2, .fasilitas-container h2 {
        font-size: 1.8rem;
      }
      
      .visi-misi h3 {
        font-size: 1.5rem;
      }
      
      .fasilitas-grid {
        grid-template-columns: 1fr;
      }
      
      .stats-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
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
      <a href="index.php">Beranda</a>
      <a href="lapangan.php">Lapangan</a>
      <a href="tentang.php" class="active">Tentang</a>
      <a href="admin/index.php">Admin</a>
    </nav>
  </header>

  <!-- Hero -->
  <section class="hero-about">
    <h1>Futsal Taruna Mandiri</h1>
    <p>Pusat olahraga futsal terbaik di wilayah Pamulang — menghadirkan kenyamanan, profesionalitas, dan semangat sportivitas.</p>
  </section>

  <!-- Tentang -->
  <section class="about-section">
    <h2>Kenapa Memilih Kami?</h2>
    <p>
      <span class="highlight">Futsal Taruna Mandiri</span> bukan sekadar lapangan futsal biasa. Kami adalah ruang bagi para pemain,
      komunitas, dan penggemar futsal untuk berkembang, berkompetisi, dan menikmati setiap detik permainan.
      Dengan fasilitas modern dan layanan ramah, kami berkomitmen menciptakan pengalaman olahraga terbaik.
    </p>

    <!-- Visi & Misi -->
    <div class="visi-misi">
      <h3>🎯 Visi Kami</h3>
      <p>Menjadi pusat olahraga futsal unggulan yang menginspirasi semangat sportivitas, kesehatan, dan kebersamaan masyarakat.</p>

      <h3>🚀 Misi Kami</h3>
      <ul>
        <li>Menyediakan fasilitas futsal yang nyaman, bersih, dan profesional.</li>
        <li>Mendukung komunitas lokal dengan program turnamen dan pelatihan.</li>
        <li>Mengutamakan pelayanan ramah dan cepat untuk semua pelanggan.</li>
        <li>Mendorong gaya hidup sehat melalui olahraga yang menyenangkan.</li>
        <li>Mengembangkan kolaborasi dengan sekolah, kampus, dan komunitas futsal daerah.</li>
      </ul>
    </div>

    <!-- Fasilitas -->
    <div class="fasilitas-container">
      <h2>🏟️ Fasilitas Kami</h2>
      <div class="fasilitas-grid">
        <div class="fasilitas-card">
          <h3>🚗 Parkiran Luas</h3>
          <p>Area parkir aman dan nyaman untuk motor maupun mobil dengan pengawasan 24 jam.</p>
        </div>

        <div class="fasilitas-card">
          <h3>☕ Kantin & Coffee Corner</h3>
          <p>Tempat nongkrong santai dengan pilihan kopi dan camilan untuk pemain & penonton.</p>
        </div>

        <div class="fasilitas-card">
          <h3>🚿 Ruang Ganti & Shower</h3>
          <p>Dilengkapi air panas & dingin serta locker untuk kenyamanan pemain setelah bertanding.</p>
        </div>

        <div class="fasilitas-card">
          <h3>🪑 Ruang Tunggu Nyaman</h3>
          <p>Dilengkapi TV layar lebar, kipas pendingin, dan kursi empuk untuk istirahat antar pertandingan.</p>
        </div>

        <div class="fasilitas-card">
          <h3>🏆 Turnamen & Event</h3>
          <p>Kami rutin mengadakan turnamen antar komunitas dan kompetisi tahunan tingkat regional.</p>
        </div>
        
        <div class="fasilitas-card">
          <h3>🔧 Perlengkapan Futsal</h3>
          <p>Menyediakan bola futsal berkualitas tinggi dan perlengkapan lainnya untuk disewa.</p>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
      <h2>Siap Bermain Futsal?</h2>
      <p>Jadwalkan sesi futsal Anda sekarang dan rasakan pengalaman bermain di lapangan terbaik di Pamulang. Kami siap melayani Anda dengan fasilitas terbaik dan pelayanan profesional.</p>
      <a href="lapangan.php" class="cta-button">Booking Lapangan Sekarang</a>
    </div>
  </section>

  <footer class="footer">
    <p>© 2025 Futsal Taruna Mandiri | Semua Hak Dilindungi</p>
  </footer>

  <script>
    // Animasi untuk angka statistik
    function animateStats() {
      const statNumbers = document.querySelectorAll('.stat-number');
      
      statNumbers.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const step = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(() => {
          current += step;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          stat.textContent = Math.floor(current);
        }, 16);
      });
    }
    
    // Trigger animasi ketika elemen masuk ke viewport
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateStats();
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.5 });
    
    observer.observe(document.querySelector('.stats-section'));
    
    // Smooth scroll untuk navigasi
    document.querySelectorAll('nav a').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if(targetId === 'index.php' || targetId === 'lapangan.php' || targetId === 'tentang.php' || targetId === 'admin/index.php') {
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
  </script>
</body>
</html>