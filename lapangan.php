<?php include('includes/config.php'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Daftar lapangan futsal Futsal Taruna Mandiri - Pilih lapangan terbaik untuk pengalaman bermain futsal yang optimal.">
  <title>Daftar Lapangan | Futsal Taruna Mandiri - Booking Lapangan Futsal Terbaik</title>
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
      --danger-color: #ff6868;
      --success-color: #00ff9d;
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

    /* Lapangan Section */
    .lapangan-section {
      padding: 140px 10% 80px;
      min-height: 100vh;
      position: relative;
    }

    .lapangan-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 80%, rgba(0, 255, 157, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(0, 180, 255, 0.05) 0%, transparent 50%);
      z-index: -1;
    }

    .lapangan-section h1 {
      text-align: center;
      font-size: 3rem;
      color: var(--primary-color);
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
      left: 50%;
      transform: translateX(-50%);
    }

    .lapangan-section h1::after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: var(--primary-color);
      border-radius: 3px;
    }

    .lapangan-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 40px;
      margin-top: 60px;
    }

    .lapangan-card {
      background: var(--card-bg);
      border-radius: 20px;
      overflow: hidden;
      transition: var(--transition);
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    .lapangan-card::before {
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

    .lapangan-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
      border-color: rgba(0, 255, 157, 0.2);
    }

    .lapangan-card:hover::before {
      transform: scaleX(1);
    }

    .lapangan-card img {
      width: 100%;
      height: 250px;
      object-fit: cover;
      transition: var(--transition);
    }

    .lapangan-card:hover img {
      transform: scale(1.05);
    }

    .lapangan-info {
      padding: 30px;
    }

    .lapangan-info h2 {
      color: var(--primary-color);
      font-size: 1.8rem;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .lapangan-info h2::before {
      content: '⚽';
      font-size: 1.5rem;
    }

    .lapangan-info p {
      color: var(--text-light);
      margin-bottom: 15px;
      line-height: 1.6;
    }

    .lapangan-info strong {
      color: var(--text-color);
      font-weight: 600;
    }

    .price-tag {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: var(--secondary-color);
      padding: 8px 16px;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1.1rem;
      margin: 10px 0;
      box-shadow: 0 4px 15px rgba(0, 255, 157, 0.3);
    }

    .noted {
      margin: 15px 0;
      font-size: 0.9rem;
      padding: 12px 15px;
      border-radius: 8px;
      background: rgba(255, 104, 104, 0.1);
      border-left: 3px solid var(--danger-color);
      transition: var(--transition);
    }

    .noted.ok {
      background: rgba(0, 255, 157, 0.1);
      border-left: 3px solid var(--success-color);
    }

    .noted:hover {
      transform: translateX(5px);
    }

    .booking-info {
      background: rgba(0, 180, 255, 0.1);
      border-radius: 10px;
      padding: 15px;
      margin: 15px 0;
      border-left: 3px solid var(--accent-color);
    }

    .booking-info h4 {
      color: var(--accent-color);
      margin-bottom: 10px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .booking-info h4::before {
      content: '⏰';
    }

    .booking-time {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 5px;
      color: var(--text-light);
      font-size: 0.9rem;
    }

    .btn-book {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: var(--secondary-color);
      padding: 12px 30px;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      transition: var(--transition);
      box-shadow: 0 5px 15px rgba(0, 255, 157, 0.3);
      text-align: center;
      width: 100%;
      margin-top: 15px;
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
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 255, 157, 0.4);
    }

    .btn-book:hover::before {
      left: 100%;
    }

    /* Availability Badge */
    .availability-badge {
      position: absolute;
      top: 20px;
      right: 20px;
      background: rgba(0, 0, 0, 0.7);
      color: white;
      padding: 8px 15px;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 600;
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      z-index: 2;
    }

    .availability-badge.available {
      background: rgba(0, 255, 157, 0.8);
      color: var(--secondary-color);
    }

    .availability-badge.booked {
      background: rgba(255, 104, 104, 0.8);
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

    /* Responsive Design */
    @media (max-width: 1024px) {
      .lapangan-section {
        padding: 140px 5% 80px;
      }
      
      .lapangan-container {
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
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

      .lapangan-section {
        padding: 120px 5% 60px;
      }

      .lapangan-section h1 {
        font-size: 2.5rem;
      }

      .lapangan-container {
        grid-template-columns: 1fr;
        gap: 30px;
      }

      .lapangan-info {
        padding: 25px;
      }
    }

    @media (max-width: 480px) {
      .lapangan-section h1 {
        font-size: 2rem;
      }

      .lapangan-container {
        grid-template-columns: 1fr;
      }

      .lapangan-card {
        margin: 0 10px;
      }

      .lapangan-info h2 {
        font-size: 1.5rem;
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
      <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Beranda</a>
      <a href="lapangan.php" class="<?= basename($_SERVER['PHP_SELF']) == 'lapangan.php' ? 'active' : '' ?>">Lapangan</a>
      <a href="tentang.php" class="<?= basename($_SERVER['PHP_SELF']) == 'tentang.php' ? 'active' : '' ?>">Tentang</a>
      <a href="admin/login.php" class="<?= strpos($_SERVER['PHP_SELF'], 'admin') !== false ? 'active' : '' ?>">Admin</a>
    </nav>
  </header>

  <section class="lapangan-section">
    <h1>Daftar Lapangan</h1>
    <div class="lapangan-container">
      <?php
      // Ambil data lapangan
      $query = "SELECT * FROM lapangan LIMIT 3";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        $id_lapangan = $row['id_lapangan'];
        $today = date('Y-m-d');

        // Ambil booking untuk hari ini (bisa ubah >= CURDATE() kalau mau tampilkan semua ke depan)
        $cek = mysqli_query($conn, "
          SELECT jam_mulai, jam_selesai 
          FROM booking 
          WHERE id_lapangan = $id_lapangan 
            AND tanggal = '$today'
        ");

        // Tentukan status ketersediaan
        $is_available = mysqli_num_rows($cek) === 0;
        $availability_class = $is_available ? 'available' : 'booked';
        $availability_text = $is_available ? 'Tersedia' : 'Terbooking';

        // Tentukan catatan
        if (mysqli_num_rows($cek) > 0) {
          $note = "<div class='booking-info'>";
          $note .= "<h4>Jam Terbooking Hari Ini:</h4>";
          while ($b = mysqli_fetch_assoc($cek)) {
            $note .= "<div class='booking-time'>";
            $note .= "⏰ {$b['jam_mulai']} - {$b['jam_selesai']}";
            $note .= "</div>";
          }
          $note .= "</div>";
          $note .= "<p class='noted'>Silakan pilih jam lain yang tersedia.</p>";
        } else {
          $note = "<p class='noted ok'>✅ Semua jam tersedia hari ini. Silakan booking kapan saja!</p>";
        }

        echo "
          <div class='lapangan-card'>
            <div class='availability-badge $availability_class'>$availability_text</div>
            <img src='assets/images/{$row['foto']}' alt='{$row['nama_lapangan']}'>
            <div class='lapangan-info'>
              <h2>{$row['nama_lapangan']}</h2>
              <p>{$row['deskripsi']}</p>
              <div class='price-tag'>Rp " . number_format($row['harga_per_jam'], 0, ',', '.') . " / jam</div>
              $note
              <a href='booking.php?id={$row['id_lapangan']}' class='btn-book'>Booking Sekarang</a>
            </div>
          </div>
        ";
      }
      ?>
    </div>
  </section>

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

    // Add animation to lapangan cards on scroll
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

    // Observe lapangan cards
    document.querySelectorAll('.lapangan-card').forEach(card => {
      observer.observe(card);
    });

    // Add fadeInUp animation
    const style = document.createElement('style');
    style.textContent = `
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
    `;
    document.head.appendChild(style);
  </script>
</body>
</html>