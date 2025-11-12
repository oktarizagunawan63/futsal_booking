<?php
// admin/auth.php
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// ganti sesuai permintaan lu: admin123
$PASSWORD_ADMIN = 'admin123';

if ($password === $PASSWORD_ADMIN) {
    // sukses
    $_SESSION['admin'] = true;
    // opsional: bisa simpan waktu login / username dst
    header('Location: index.php');
    exit;
} else {
    // gagal - kembali dengan pesan error (simple)
    $_SESSION['login_error'] = 'Password salah.';
    header('Location: login.php');
    exit;
}
