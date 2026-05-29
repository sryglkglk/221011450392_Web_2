<?php
/****************************************************
 * Halaman ini merupakan contoh halaman pemeriksaan session.
 * Pemeriksaan session biasanya dilakukan jika suatu halaman
 * memiliki akses terbatas. Misalnya harus login terlebih dahulu.
 ****************************************************/
session_start();

// Pemeriksaan session
if (isset($_SESSION['login'])) {
    // Jika sudah login, tampilkan isi session
    echo "<h1>Selamat Datang, " . $_SESSION['login'] . "!</h1>";
    echo "<h2>Halaman ini hanya bisa diakses jika Anda sudah login</h2>";
    echo "<h2>Klik <a href='session3.php'>di sini (session3.php)</a> untuk LOGOUT</h2>";
} else {
    // Session belum ada artinya belum login
    die("Anda belum login! Anda tidak berhak masuk ke halaman ini. Silahkan login <a href='session1.php'>di sini</a>");
}

// <!-- Project 14.1 By ASEP SURYA AGUSTIN - 221011450392  -->
?>