<?php
// Buat koneksi ke MySQL
$conn = mysqli_connect("localhost", "root", "");

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$dbname = "lat_dbase";

// Jalankan query dengan koneksi
$sql = "CREATE DATABASE $dbname";
$cek = mysqli_query($conn, $sql);

if ($cek) {
    echo "Database $dbname berhasil dibuat";
} else {
    echo "Error: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);

// Project 11.2 By ASEP SURYA AGUSTIN - 221011450392
?>