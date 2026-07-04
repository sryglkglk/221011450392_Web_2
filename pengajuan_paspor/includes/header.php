<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengajuan Paspor - Kantor Imigrasi Cabang</title>
<style>
    body { font-family: Arial, sans-serif; margin: 30px; background: #f4f4f4; }
    .container { background: #fff; padding: 20px; border-radius: 8px; max-width: 950px; margin: auto; }
    h2, h3 { margin-bottom: 5px; }
    .nav a {
        margin-right: 15px; text-decoration: none; color: #fff;
        background: #2c3e50; padding: 8px 14px; border-radius: 4px;
    }
    .nav a.active { background: #2980b9; }
    table { border-collapse: collapse; width: 100%; margin-top: 15px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: center; font-size: 14px; }
    th { background: #2c3e50; color: #fff; }
    form label { display: inline-block; width: 160px; font-weight: bold; }
    form input, form select { padding: 5px; width: 250px; margin-bottom: 10px; }
    .btn { padding: 8px 16px; background: #27ae60; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    .btn:hover { background: #219150; }
    .aksi a { margin: 0 4px; text-decoration: none; }
    .info { background: #eef6ff; border-left: 4px solid #2980b9; padding: 10px; margin-bottom: 15px; font-size: 14px; }
    .badge-ok { color: #27ae60; font-weight: bold; }
    .badge-no { color: #c0392b; font-weight: bold; }
</style>
</head>
<body>
<div class="container">
    <h2>PENGAJUAN PASPOR</h2>
    <h3>Kantor Imigrasi Cabang</h3>
    <p><b>Programmer:</b> [Nama Mahasiswa]</p>
    <?php $uri = $_SERVER['REQUEST_URI']; ?>
    <div class="nav">
        <a href="/daftar/index.php" class="<?= (strpos($uri,'/daftar/')!==false) ? 'active' : '' ?>">Daftar</a>
        <a href="/daftar_ulang/index.php" class="<?= (strpos($uri,'/daftar_ulang/')!==false) ? 'active' : '' ?>">Daftar Ulang</a>
        <a href="/pengurusan/index.php" class="<?= (strpos($uri,'/pengurusan/')!==false) ? 'active' : '' ?>">Pengurusan</a>
    </div>
    <hr>
</div>
