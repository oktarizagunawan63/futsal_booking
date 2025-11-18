<?php
// admin/index.php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
  header('Location: login.php');
  exit;
}

include_once '../includes/config.php';

// update harga lapangan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_price'])) {
  $id = (int) $_POST['id_lapangan'];
  $harga = (int) $_POST['harga_per_jam'];
  mysqli_query($conn, "UPDATE lapangan SET harga_per_jam = $harga WHERE id_lapangan = $id");
  header('Location: index.php');
  exit;
}

// ambil data lapangan
$lapQ = "SELECT DISTINCT id_lapangan, nama_lapangan, harga_per_jam FROM lapangan ORDER BY id_lapangan ASC";
$lapR = mysqli_query($conn, $lapQ);

// ambil data booking
$bookQ = "SELECT b.*, l.nama_lapangan 
          FROM booking b 
          LEFT JOIN lapangan l ON b.id_lapangan = l.id_lapangan 
          ORDER BY b.tanggal DESC, b.jam_mulai";
$bookR = mysqli_query($conn, $bookQ);
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Futsal Taruna Mandiri</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #00ff9d;
      --secondary-color: #06121f;
      --accent-color: #00b4ff;
      --text-color: #f2f2f2;
      --text-light: #cfcfcf;
      --card-bg: rgba(9, 28, 40, 0.9);
      --danger-color: #ff4757;
      --warning-color: #ffa502;
      --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #06121f 0%, #0a2434 50%, #051a2b 100%);
      color: var(--text-color);
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    body::before {
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

    .wrap {
      max-width: 1300px;
      margin: 0 auto;
      padding: 30px;
    }

    /* Header Styles */
    .admin-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
      padding-bottom: 20px;
      border-bottom: 2px solid rgba(0, 255, 157, 0.2);
    }

    .header-content h1 {
      font-size: 2.8rem;
      color: var(--primary-color);
      margin-bottom: 8px;
      font-weight: 700;
      text-shadow: 0 2px 10px rgba(0, 255, 157, 0.3);
    }

    .header-content p {
      color: var(--text-light);
      font-size: 1.1rem;
    }

    .admin-actions {
      display: flex;
      gap: 15px;
    }

    .btn {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: var(--secondary-color);
      padding: 12px 24px;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      transition: var(--transition);
      box-shadow: 0 5px 15px rgba(0, 255, 157, 0.3);
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }

    .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0, 255, 157, 0.4);
    }

    .btn-logout {
      background: linear-gradient(135deg, var(--danger-color), #ff6b81);
    }

    .btn-logout:hover {
      box-shadow: 0 8px 20px rgba(255, 71, 87, 0.4);
    }

    /* Stats Cards */
    .stats-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 25px;
      margin-bottom: 40px;
    }

    .stat-card {
      background: var(--card-bg);
      border-radius: 16px;
      padding: 30px 25px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.08);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
      border-color: rgba(0, 255, 157, 0.2);
    }

    .stat-icon {
      font-size: 3rem;
      margin-bottom: 15px;
      display: block;
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 8px;
      display: block;
    }

    .stat-label {
      color: var(--text-light);
      font-size: 1rem;
      font-weight: 500;
    }

    /* Card Styles */
    .card {
      background: var(--card-bg);
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 35px;
      border: 1px solid rgba(255, 255, 255, 0.08);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      transition: var(--transition);
      position: relative;
      overflow: hidden;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    }

    .card:hover {
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
      border-color: rgba(0, 255, 157, 0.2);
    }

    .card h2 {
      color: var(--primary-color);
      margin-bottom: 25px;
      font-size: 1.8rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .card h2::before {
      font-size: 1.5rem;
    }

    /* Price Update Forms */
    .price-form {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      padding: 20px;
      background: rgba(255, 255, 255, 0.03);
      border-radius: 12px;
      transition: var(--transition);
      border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .price-form:hover {
      background: rgba(255, 255, 255, 0.05);
      border-color: rgba(0, 255, 157, 0.1);
    }

    .price-form strong {
      width: 250px;
      color: var(--primary-color);
      font-size: 1.1rem;
      font-weight: 600;
    }

    .price-input {
      width: 150px;
      padding: 12px 15px;
      margin-right: 15px;
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.1);
      outline: none;
      background: rgba(3, 25, 32, 0.8);
      color: var(--text-color);
      font-size: 1rem;
      font-weight: 500;
      transition: var(--transition);
    }

    .price-input:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px rgba(0, 255, 157, 0.1);
      background: rgba(3, 25, 32, 1);
    }

    .btn-save {
      background: linear-gradient(135deg, var(--primary-color), #00cc7a);
      padding: 12px 20px;
      font-size: 0.9rem;
    }

    /* Table Styles */
    .table-container {
      overflow-x: auto;
      border-radius: 12px;
      margin-top: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(5, 24, 35, 0.8);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    th, td {
      padding: 16px 12px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      text-align: center;
      font-size: 0.95rem;
    }

    th {
      background: linear-gradient(135deg, rgba(0, 255, 157, 0.1), rgba(0, 180, 255, 0.1));
      color: var(--primary-color);
      font-weight: 600;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    tbody tr {
      transition: var(--transition);
    }

    tbody tr:hover {
      background: rgba(255, 255, 255, 0.05);
    }

    tbody tr:last-child td {
      border-bottom: none;
    }

    .action-link {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: 600;
      transition: var(--transition);
      padding: 6px 12px;
      border-radius: 6px;
      display: inline-block;
    }

    .action-link:hover {
      background: rgba(0, 255, 157, 0.1);
      transform: translateY(-2px);
    }

    .action-delete {
      color: var(--danger-color);
    }

    .action-delete:hover {
      background: rgba(255, 71, 87, 0.1);
    }

    .bukti-link {
      color: var(--accent-color);
      text-decoration: none;
      font-weight: 600;
      transition: var(--transition);
      display: inline-flex;
      align-items: center;
      gap: 5px;
    }

    .bukti-link:hover {
      color: var(--primary-color);
      transform: translateY(-2px);
    }

    /* Custom Modal Styles */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
      backdrop-filter: blur(5px);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
      animation: fadeIn 0.3s ease;
    }

    .modal-content {
      background: var(--card-bg);
      border-radius: 20px;
      padding: 40px;
      max-width: 450px;
      width: 90%;
      text-align: center;
      border: 1px solid rgba(0, 255, 157, 0.2);
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
      animation: slideUp 0.3s ease;
      position: relative;
    }

    .modal-content::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 4px;
      background: linear-gradient(90deg, var(--danger-color), #ff6b81);
      border-radius: 20px 20px 0 0;
    }

    .modal-icon {
      font-size: 4rem;
      margin-bottom: 20px;
      display: block;
    }

    .modal-title {
      color: var(--danger-color);
      font-size: 1.8rem;
      margin-bottom: 15px;
      font-weight: 600;
    }

    .modal-message {
      color: var(--text-light);
      font-size: 1.1rem;
      margin-bottom: 30px;
      line-height: 1.6;
    }

    .modal-actions {
      display: flex;
      gap: 15px;
      justify-content: center;
    }

    .btn-cancel {
      background: rgba(255, 255, 255, 0.1);
      color: var(--text-color);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-cancel:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateY(-2px);
    }

    .btn-confirm {
      background: linear-gradient(135deg, var(--danger-color), #ff6b81);
      color: white;
    }

    .btn-confirm:hover {
      box-shadow: 0 8px 20px rgba(255, 71, 87, 0.4);
      transform: translateY(-2px);
    }

    /* Modal Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px) scale(0.9);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
      .wrap {
        padding: 20px;
      }
      
      .admin-header {
        flex-direction: column;
        gap: 20px;
        text-align: center;
      }
      
      .header-content h1 {
        font-size: 2.4rem;
      }
    }

    @media (max-width: 768px) {
      .price-form {
        flex-direction: column;
        gap: 15px;
        text-align: center;
      }
      
      .price-form strong {
        width: 100%;
      }
      
      .price-input {
        width: 100%;
        margin-right: 0;
        margin-bottom: 10px;
      }
      
      .stats-container {
        grid-template-columns: 1fr;
      }
      
      th, td {
        padding: 12px 8px;
        font-size: 0.85rem;
      }

      .modal-actions {
        flex-direction: column;
      }

      .modal-content {
        padding: 30px 20px;
      }
    }

    @media (max-width: 480px) {
      .wrap {
        padding: 15px;
      }
      
      .header-content h1 {
        font-size: 2rem;
      }
      
      .admin-actions {
        flex-direction: column;
        width: 100%;
      }
      
      .btn {
        justify-content: center;
      }
      
      .card {
        padding: 20px 15px;
      }
    }

    /* Animation */
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

    .fade-in {
      animation: fadeInUp 0.6s ease forwards;
    }
  </style>
</head>

<body>
  <!-- Custom Confirmation Modal -->
  <div class="modal-overlay" id="confirmationModal">
    <div class="modal-content">
      <span class="modal-icon">⚠️</span>
      <h2 class="modal-title">Hapus Data Booking</h2>
      <p class="modal-message" id="modalMessage">Yakin mau hapus data booking ini?</p>
      <div class="modal-actions">
        <button class="btn btn-cancel" id="cancelBtn">Batal</button>
        <button class="btn btn-confirm" id="confirmBtn">Ya, Hapus</button>
      </div>
    </div>
  </div>

  <div class="wrap">
    <!-- Header -->
    <div class="admin-header fade-in">
      <div class="header-content">
        <h1>🏆 Admin Dashboard</h1>
        <p>Kelola sistem booking lapangan futsal Futsal Taruna Mandiri</p>
      </div>
      <div class="admin-actions">
        <a href="../index.php" class="btn">
          🏠 Beranda
        </a>
        <a href="logout.php" class="btn btn-logout">
          🚪 Logout
        </a>
      </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-container">
      <div class="stat-card fade-in">
        <span class="stat-icon">⚽</span>
        <span class="stat-number">3</span>
        <span class="stat-label">Total Lapangan</span>
      </div>
      <div class="stat-card fade-in">
        <span class="stat-icon">📅</span>
        <span class="stat-number"><?= mysqli_num_rows($bookR) ?></span>
        <span class="stat-label">Total Booking</span>
      </div>
    </div>

    <!-- Price Management Card -->
    <div class="card fade-in">
      <h2>💰 Ubah Harga Lapangan</h2>
      <?php while ($lap = mysqli_fetch_assoc($lapR)): ?>
        <form class="price-form" method="post" action="index.php">
          <input type="hidden" name="id_lapangan" value="<?= (int) $lap['id_lapangan'] ?>">
          <strong><?= htmlspecialchars($lap['nama_lapangan']) ?></strong>
          <input type="number" name="harga_per_jam" value="<?= (int) $lap['harga_per_jam'] ?>" required class="price-input">
          <button class="btn btn-save" name="update_price" type="submit">
            💾 Simpan
          </button>
        </form>
      <?php endwhile; ?>
    </div>

    <!-- Booking List Card -->
    <div class="card fade-in">
      <h2>📋 Daftar Booking</h2>
      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>No HP</th>
              <th>Lapangan</th>
              <th>Tanggal</th>
              <th>Jam</th>
              <th>Durasi</th>
              <th>Bukti Transfer</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            mysqli_data_seek($bookR, 0); // Reset pointer
            $i=1; while($b = mysqli_fetch_assoc($bookR)): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= htmlspecialchars($b['nama_pemesan']) ?></td>
                <td><?= htmlspecialchars($b['no_hp']) ?></td>
                <td><?= htmlspecialchars($b['nama_lapangan'] ?? '-') ?></td>
                <td><?= htmlspecialchars($b['tanggal']) ?></td>
                <td><?= htmlspecialchars($b['jam_mulai']) ?> - <?= htmlspecialchars($b['jam_selesai']) ?></td>
                <td><?= htmlspecialchars($b['durasi'] ?? '-') ?></td>
                <td>
                  <?php if(!empty($b['bukti_transfer'])): ?>
                    <a href="../uploads/<?= htmlspecialchars($b['bukti_transfer']) ?>" target="_blank" class="bukti-link">
                      👁️ Lihat
                    </a>
                  <?php else: echo '-'; endif; ?>
                </td>
                <td>
                  <a href="#" 
                     class="action-link action-delete delete-btn"
                     data-id="<?= $b['id_booking'] ?>"
                     data-name="<?= htmlspecialchars($b['nama_pemesan']) ?>"
                     data-date="<?= htmlspecialchars($b['tanggal']) ?>"
                     data-time="<?= htmlspecialchars($b['jam_mulai']) ?>">
                    🗑️ Hapus
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // Custom Confirmation Modal
    const modal = document.getElementById('confirmationModal');
    const modalMessage = document.getElementById('modalMessage');
    const cancelBtn = document.getElementById('cancelBtn');
    const confirmBtn = document.getElementById('confirmBtn');
    let deleteUrl = '';

    // Add click event to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        
        const bookingId = this.getAttribute('data-id');
        const customerName = this.getAttribute('data-name');
        const bookingDate = this.getAttribute('data-date');
        const bookingTime = this.getAttribute('data-time');
        
        // Set custom message
        modalMessage.innerHTML = `Yakin mau hapus booking dari <strong>${customerName}</strong>?<br>
                                 <small>Tanggal: ${bookingDate} | Jam: ${bookingTime}</small>`;
        
        // Set delete URL
        deleteUrl = `hapus_booking.php?id=${bookingId}`;
        
        // Show modal
        modal.style.display = 'flex';
      });
    });

    // Cancel button
    cancelBtn.addEventListener('click', function() {
      modal.style.display = 'none';
      deleteUrl = '';
    });

    // Confirm button
    confirmBtn.addEventListener('click', function() {
      if (deleteUrl) {
        window.location.href = deleteUrl;
      }
    });

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        modal.style.display = 'none';
        deleteUrl = '';
      }
    });

    // Add animation to elements on scroll
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
          entry.target.style.opacity = '0';
          setTimeout(() => {
            entry.target.style.opacity = '1';
          }, 200);
        }
      });
    }, observerOptions);

    // Observe all cards and stats
    document.querySelectorAll('.card, .stat-card').forEach(element => {
      observer.observe(element);
    });

    // Add loading state to save buttons
    document.querySelectorAll('.btn-save').forEach(button => {
      button.addEventListener('click', function() {
        const originalText = this.innerHTML;
        this.innerHTML = '⏳ Menyimpan...';
        this.disabled = true;
        
        setTimeout(() => {
          this.innerHTML = originalText;
          this.disabled = false;
        }, 2000);
      });
    });

    // Add hover effects to table rows
    document.querySelectorAll('tbody tr').forEach(row => {
      row.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.01)';
      });
      
      row.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
      });
    });
  </script>
</body>
</html>