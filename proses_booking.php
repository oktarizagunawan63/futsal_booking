<?php
session_start();
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_lapangan = (int)$_POST['id_lapangan'];
    $nama_pemesan = mysqli_real_escape_string($conn, $_POST['nama_pemesan']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $jam_mulai = mysqli_real_escape_string($conn, $_POST['jam_mulai']);
    $durasi = (int)$_POST['durasi'];

    $start_time = strtotime($jam_mulai);
    $end_time = strtotime("+$durasi hours", $start_time);
    $jam_selesai = date('H:i', $end_time);

    $bukti_transfer = '';
    if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] === 0) {
        $file_name = $_FILES['bukti_transfer']['name'];
        $file_tmp = $_FILES['bukti_transfer']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];

        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = uniqid() . '.' . $file_ext;
            $upload_path = 'uploads/' . $new_file_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                $bukti_transfer = $new_file_name;
            }
        }
    }

    $query = "INSERT INTO booking (id_lapangan, nama_pemesan, no_hp, tanggal, jam_mulai, jam_selesai, durasi, bukti_transfer) 
              VALUES ('$id_lapangan', '$nama_pemesan', '$no_hp', '$tanggal', '$jam_mulai', '$jam_selesai', '$durasi', '$bukti_transfer')";

    if (mysqli_query($conn, $query)) {
        $success = true;
        $booking_id = mysqli_insert_id($conn);
    } else {
        $error = "Terjadi kesalahan saat memproses booking.";
    }
} else {
    header('Location: lapangan.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Booking Berhasil | Futsal Taruna Mandiri</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root {
  --green: #00ff9d;
  --blue: #00b4ff;
  --dark: #06121f;
  --text: #eaeaea;
}
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #06121f, #0b2338);
  color: var(--text);
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  overflow: hidden;
}
.container {
  background: rgba(8, 24, 38, 0.95);
  border: 1px solid rgba(0,255,157,0.2);
  padding: 40px 35px;
  border-radius: 16px;
  text-align: center;
  box-shadow: 0 0 30px rgba(0,255,157,0.1);
  max-width: 450px;
  width: 90%;
  position: relative;
}
.container::before {
  content: '';
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 4px;
  background: linear-gradient(90deg, var(--green), var(--blue));
  border-radius: 4px 4px 0 0;
}
h1 {
  color: var(--green);
  font-size: 1.8rem;
  margin-top: 15px;
}
.details {
  text-align: left;
  margin-top: 25px;
  border-top: 1px solid rgba(255,255,255,0.1);
  padding-top: 15px;
}
.details p {
  margin: 8px 0;
  display: flex;
  justify-content: space-between;
  font-size: 0.95rem;
}
.details span {
  color: var(--green);
  font-weight: 600;
}
.note {
  background: rgba(255, 215, 0, 0.1);
  border: 1px solid #ffd700;
  border-radius: 10px;
  padding: 12px;
  margin-top: 18px;
  font-size: 0.9rem;
  color: #ffd700;
}
.redirect {
  margin-top: 20px;
  font-size: 0.85rem;
  color: #ccc;
}
.redirect span {
  color: var(--green);
  font-weight: bold;
}
</style>
</head>
<body>
<div class="container">
  <div style="font-size:3rem;">🎉</div>
  <h1>Booking Berhasil!</h1>
  <p>Terima kasih telah memilih <strong>Futsal Taruna Mandiri</strong></p>

  <?php if(isset($success) && $success): ?>
  <div class="details">
    <p><strong>ID Booking:</strong> <span>#<?= str_pad($booking_id, 6, '0', STR_PAD_LEFT) ?></span></p>
    <p><strong>Nama:</strong> <span><?= htmlspecialchars($nama_pemesan) ?></span></p>
    <p><strong>Tanggal:</strong> <span><?= htmlspecialchars($tanggal) ?></span></p>
    <p><strong>Jam:</strong> <span><?= htmlspecialchars($jam_mulai) ?> - <?= htmlspecialchars($jam_selesai) ?></span></p>
    <p><strong>Durasi:</strong> <span><?= $durasi ?> jam</span></p>
  </div>
  <div class="note">
    💳 Silakan tunggu verifikasi admin. Booking aktif setelah DP 50% diverifikasi.
  </div>
  <?php endif; ?>

  <p class="redirect">Anda akan diarahkan ke beranda dalam <span id="countdown">10</span> detik...</p>
</div>

<script>
let countdown = 6;
const timer = setInterval(() => {
  countdown--;
  document.getElementById('countdown').textContent = countdown;
  if (countdown <= 0) {
    clearInterval(timer);
    window.location.href = 'index.php';
  }
}, 1000);
</script>
</body>
</html>
