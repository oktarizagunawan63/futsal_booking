<?php
include('includes/config.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: lapangan.php');
    exit;
}

$id_lapangan = (int)$_GET['id'];
$query = "SELECT * FROM lapangan WHERE id_lapangan = $id_lapangan";
$result = mysqli_query($conn, $query);
$lapangan = mysqli_fetch_assoc($result);

if (!$lapangan) {
    header('Location: lapangan.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Lapangan | Futsal Taruna Mandiri</title>
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
            --card-bg: rgba(9, 28, 40, 0.95);
            --danger-color: #ff4757;
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
                radial-gradient(circle at 80% 20%, rgba(0, 180, 255, 0.1) 0%, transparent 50%);
            z-index: -1;
        }

        /* Header */
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
            border: 2px solid var(--primary-color);
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

        /* Main Content */
        .booking-container {
            max-width: 900px;
            margin: 120px auto 50px;
            padding: 0 20px;
        }

        .booking-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .booking-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
        }

        .booking-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .booking-header h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .booking-header p {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Form Styles */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1rem;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1rem;
            color: var(--text-color);
            transition: var(--transition);
            font-family: 'Poppins', sans-serif;
        }

        .form-select option {
            background: var(--secondary-color);
            color: var(--text-color);
            padding: 10px;
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 255, 157, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }

        .file-input-container {
            position: relative;
        }

        .file-input {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: var(--text-color);
            cursor: pointer;
            transition: var(--transition);
        }

        .file-input:hover {
            border-color: var(--primary-color);
        }

        .file-input::file-selector-button {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--secondary-color);
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
            margin-right: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .file-input::file-selector-button:hover {
            transform: translateY(-2px);
        }

        /* Payment Info */
        .payment-info {
            background: rgba(0, 180, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            border: 1px solid rgba(0, 180, 255, 0.2);
        }

        .payment-info h3 {
            color: var(--accent-color);
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.3rem;
        }

        .bank-accounts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .bank-account {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .bank-logo {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: block;
        }

        .bank-name {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .bank-number {
            color: var(--text-color);
            font-family: monospace;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .bank-holder {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Price Summary */
        .price-summary {
            background: rgba(0, 255, 157, 0.1);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            border: 1px solid rgba(0, 255, 157, 0.2);
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .price-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .price-label {
            color: var(--text-light);
        }

        .price-value {
            color: var(--primary-color);
            font-weight: 600;
        }

        .dp-warning {
            background: rgba(255, 71, 87, 0.1);
            border: 1px solid var(--danger-color);
            border-radius: 10px;
            padding: 15px;
            margin-top: 15px;
            text-align: center;
        }

        .dp-warning p {
            color: var(--danger-color);
            font-weight: 600;
            margin: 0;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 16px 30px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 1rem;
            text-align: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            color: var(--secondary-color);
            box-shadow: 0 5px 15px rgba(0, 255, 157, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 255, 157, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-color);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-3px);
        }

        /* Lapangan Info */
        .lapangan-info {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-color);
        }

        .lapangan-info h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .bank-accounts {
                grid-template-columns: 1fr;
            }

            .booking-card {
                padding: 30px 25px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px 5%;
            }

            .booking-container {
                margin-top: 140px;
            }
        }

        @media (max-width: 480px) {
            .booking-card {
                padding: 25px 20px;
            }

            .booking-header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="navbar">
        <div class="logo">
            <img src="assets/images/logo.jpg" alt="logo" class="logo-img">
            <span>Futsal Taruna Mandiri</span>
        </div>
        <nav>
            <a href="index.php">Beranda</a>
            <a href="lapangan.php">Lapangan</a>
            <a href="tentang.php">Tentang</a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="booking-container">
        <div class="booking-card">
            <div class="booking-header">
                <h1>⚽ Booking Lapangan</h1>
                <p>Isi form berikut untuk memesan lapangan futsal</p>
            </div>

            <!-- Lapangan Info -->
            <div class="lapangan-info">
                <h3><?= htmlspecialchars($lapangan['nama_lapangan']) ?></h3>
                <p><?= htmlspecialchars($lapangan['deskripsi']) ?></p>
                <p><strong>Harga: Rp <?= number_format($lapangan['harga_per_jam'], 0, ',', '.') ?> / jam</strong></p>
            </div>

            <form action="proses_booking.php" method="POST" enctype="multipart/form-data" id="bookingForm">
                <input type="hidden" name="id_lapangan" value="<?= $id_lapangan ?>">
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nama Pemesan</label>
                        <input type="text" name="nama_pemesan" class="form-input" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">No HP</label>
                        <input type="tel" name="no_hp" class="form-input" placeholder="Contoh: 081234567890" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Main</label>
                        <input type="date" name="tanggal" class="form-input" min="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jam Mulai</label>
                        <select name="jam_mulai" class="form-select" required>
                            <option value="">Pilih Jam Mulai</option>
                            <?php for ($i = 8; $i <= 22; $i++): ?>
                                <option value="<?= sprintf('%02d:00', $i) ?>"><?= sprintf('%02d:00', $i) ?></option>
                                <option value="<?= sprintf('%02d:30', $i) ?>"><?= sprintf('%02d:30', $i) ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lama Bermain (jam)</label>
                        <select name="durasi" class="form-select" id="durasi" required>
                            <option value="">Pilih Durasi</option>
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label">Upload Bukti Transfer (JPG/PNG/PDF)</label>
                        <div class="file-input-container">
                            <input type="file" name="bukti_transfer" class="form-input file-input" accept=".jpg,.jpeg,.png,.pdf" required>
                        </div>
                        <small style="color: var(--text-light); margin-top: 5px; display: block;">
                            * Minimal DP 50% dari total biaya
                        </small>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="payment-info">
                    <h3>💳 Transfer ke Rekening Berikut</h3>
                    <div class="bank-accounts">
                        <div class="bank-account">
                            <span class="bank-logo">🏦</span>
                            <div class="bank-name">BCA</div>
                            <div class="bank-number">1234 5678 9012</div>
                            <div class="bank-holder">Futsal Taruna Mandiri</div>
                        </div>
                        <div class="bank-account">
                            <span class="bank-logo">🏦</span>
                            <div class="bank-name">Mandiri</div>
                            <div class="bank-number">9876 5432 1098</div>
                            <div class="bank-holder">Futsal Taruna Mandiri</div>
                        </div>
                    </div>
                    <p style="text-align: center; color: var(--text-light); font-size: 0.9rem; margin: 0;">
                        Transfer minimal 50% untuk konfirmasi booking
                    </p>
                </div>

                <!-- Price Summary -->
                <div class="price-summary">
                    <h3 style="color: var(--primary-color); margin-bottom: 20px; text-align: center;">💰 Rincian Biaya</h3>
                    <div class="price-item">
                        <span class="price-label">Harga per Jam:</span>
                        <span class="price-value" id="hargaPerJam">Rp <?= number_format($lapangan['harga_per_jam'], 0, ',', '.') ?></span>
                    </div>
                    <div class="price-item">
                        <span class="price-label">Durasi:</span>
                        <span class="price-value" id="durasiText">-</span>
                    </div>
                    <div class="price-item">
                        <span class="price-label">Total Biaya:</span>
                        <span class="price-value" id="totalBiaya">-</span>
                    </div>
                    <div class="price-item">
                        <span class="price-label">Minimal DP (50%):</span>
                        <span class="price-value" id="minimalDP" style="color: var(--danger-color);">-</span>
                    </div>
                    <div class="dp-warning">
                        <p>⚠️ Transfer minimal 50% dari total biaya untuk mengkonfirmasi booking</p>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="lapangan.php" class="btn btn-secondary">
                        ← Kembali Pilih Lapangan
                    </a>
                    <button type="submit" class="btn btn-primary">
                        ⚽ Booking Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const hargaPerJam = <?= $lapangan['harga_per_jam'] ?>;
        const durasiSelect = document.getElementById('durasi');
        const durasiText = document.getElementById('durasiText');
        const totalBiaya = document.getElementById('totalBiaya');
        const minimalDP = document.getElementById('minimalDP');

        function updatePriceSummary() {
            const durasi = parseInt(durasiSelect.value) || 0;
            
            if (durasi > 0) {
                const total = hargaPerJam * durasi;
                const dp = total * 0.5;
                
                durasiText.textContent = durasi + ' Jam';
                totalBiaya.textContent = 'Rp ' + formatRupiah(total);
                minimalDP.textContent = 'Rp ' + formatRupiah(dp);
            } else {
                durasiText.textContent = '-';
                totalBiaya.textContent = '-';
                minimalDP.textContent = '-';
            }
        }

        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        durasiSelect.addEventListener('change', updatePriceSummary);

        // Initialize price summary
        updatePriceSummary();

        // Form validation
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            const fileInput = document.querySelector('input[type="file"]');
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'application/pdf'];
            const maxSize = 5 * 1024 * 1024; // 5MB

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                
                if (!allowedTypes.includes(file.type)) {
                    e.preventDefault();
                    alert('Format file harus JPG, PNG, atau PDF!');
                    return;
                }
                
                if (file.size > maxSize) {
                    e.preventDefault();
                    alert('Ukuran file maksimal 5MB!');
                    return;
                }
            }

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '⏳ Memproses...';
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>