<?php
require '../includes/koneksi.php';

// Update tidak menghitung ulang jadwal otomatis (jadwal dikunci saat pertama simpan),
// hanya memperbarui data yang diinput ulang oleh admin.
if (isset($_POST['no_daftar'])) {
    $id = (int) $_POST['no_daftar'];
    $nama = mysqli_real_escape_string($GLOBALS['koneksi'], $_POST['nama_pemohon']);
    $tglDaftar = $_POST['tgl_daftar'];
    $jam = $_POST['jam'];

    mysqli_query($koneksi, "UPDATE pendaftar SET
        nama_pemohon = '$nama',
        tgl_daftar = '$tglDaftar',
        jam = '$jam'
        WHERE no_daftar = $id");
}

header("Location: index.php");
exit;
