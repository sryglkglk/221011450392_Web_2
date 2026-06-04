<?php
/**
 * PERTEMUAN 16 - Demo: Penggunaan session_start() yang benar
 *
 * Pola benar: session_start() dipanggil PERTAMA,
 * sebelum output HTML apapun.
 *
 * Letakkan file ini di folder htdocs Laragon dan akses lewat browser.
 */

// BENAR: session_start() di baris paling atas sebelum apapun
session_start();

// Simpan data ke sesi
$_SESSION['nama'] = 'Mahasiswa Unpam';
$_SESSION['matkul'] = 'Pemrograman Web 2';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Demo Session - Pertemuan 16</title>
</head>
<body>
    <h2>Demo Session PHP yang Benar</h2>
    <p>Nama: <?= htmlspecialchars($_SESSION['nama']) ?></p>
    <p>Mata Kuliah: <?= htmlspecialchars($_SESSION['matkul']) ?></p>
    <p>Session ID: <?= session_id() ?></p>
</body>
<!-- Project 16.1 By ASEP SURYA AGUSTIN - 221011450392  -->
</html>