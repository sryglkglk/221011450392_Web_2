<?php
// ============================================
// KONEKSI DATABASE
// Sesuaikan host/user/pass jika perlu
// ============================================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pengajuan_paspor";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
