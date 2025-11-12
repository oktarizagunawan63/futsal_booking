<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

include_once '../includes/config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Ambil id_lapangan SEBELUM data booking dihapus
    $getLapangan = mysqli_query($conn, "SELECT id_lapangan FROM booking WHERE id_booking = $id LIMIT 1");

    if ($getLapangan && mysqli_num_rows($getLapangan) > 0) {
        $lap = mysqli_fetch_assoc($getLapangan);
        $id_lapangan = (int)$lap['id_lapangan'];

        // Update status jadi tersedia dulu
        mysqli_query($conn, "UPDATE lapangan SET status = 'tersedia' WHERE id_lapangan = $id_lapangan");
    }

    // Setelah itu hapus data booking
    mysqli_query($conn, "DELETE FROM booking WHERE id_booking = $id");
}

// Balik ke dashboard
header('Location: index.php');
exit;
?>
