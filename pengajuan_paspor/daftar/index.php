<?php
require '../includes/koneksi.php';

// ============================================
// FUNGSI: Hitung hari & tanggal harus datang
// Aturan: kapasitas 1 hari maksimal 5 orang.
// Jika hari itu sudah penuh (>=5), maju ke hari berikutnya, dst.
// ============================================
function hitungJadwal($koneksi, $tglDaftar) {
    $tanggalCek = $tglDaftar;
    while (true) {
        $q = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM pendaftar WHERE tanggal = '$tanggalCek'");
        $row = mysqli_fetch_assoc($q);
        if ($row['jumlah'] < 5) {
            // Hari ini masih ada slot
            $hariIndo = namaHariIndo($tanggalCek);
            return ['hari' => $hariIndo, 'tanggal' => $tanggalCek];
        }
        // Sudah penuh (5 orang), maju ke hari berikutnya
        $tanggalCek = date('Y-m-d', strtotime($tanggalCek . ' +1 day'));
    }
}

function namaHariIndo($tanggal) {
    $hari = ['Sunday'=>'Minggu','Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu',
             'Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu'];
    return $hari[date('l', strtotime($tanggal))];
}

// ============================================
// PROSES SIMPAN DATA PENDAFTAR BARU
// ============================================
if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pemohon']);
    $tglDaftar = $_POST['tgl_daftar'];
    $jam = $_POST['jam'];

    // Hitung otomatis hari & tanggal harus datang berdasarkan kapasitas
    $jadwal = hitungJadwal($koneksi, $tglDaftar);

    mysqli_query($koneksi, "INSERT INTO pendaftar (nama_pemohon, tgl_daftar, hari, tanggal, jam)
        VALUES ('$nama', '$tglDaftar', '{$jadwal['hari']}', '{$jadwal['tanggal']}', '$jam')");

    header("Location: index.php?msg=sukses");
    exit;
}

// ============================================
// PROSES HAPUS
// ============================================
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pendaftar WHERE no_daftar = $id");
    header("Location: index.php");
    exit;
}

// Ambil data untuk mode edit (jika ada)
$editData = null;
if (isset($_GET['edit'])) {
    $id = (int) $_GET['edit'];
    $q = mysqli_query($koneksi, "SELECT * FROM pendaftar WHERE no_daftar = $id");
    $editData = mysqli_fetch_assoc($q);
}

// Ambil semua data pendaftar
$data = mysqli_query($koneksi, "SELECT * FROM pendaftar ORDER BY no_daftar DESC");

require '../includes/header.php';
?>

<div class="info">
    Aturan: kapasitas 1 hari maksimal <b>5 orang</b>. Jika sudah penuh, sistem otomatis menjadwalkan ke hari berikutnya.
</div>

<h3>Input Pendaftaran</h3>
<?php if (isset($_GET['msg'])): ?>
    <p style="color:green;"><b>Data berhasil disimpan. Jadwal kedatangan dihitung otomatis di bawah.</b></p>
<?php endif; ?>

<form method="POST" action="proses_edit.php">
<?php if ($editData): ?>
    <input type="hidden" name="no_daftar" value="<?= $editData['no_daftar'] ?>">
<?php endif; ?>
    <label>No. Daftar</label>
    <input type="text" value="<?= $editData ? $editData['no_daftar'] : '(otomatis)' ?>" disabled><br>

    <label>Nama Pemohon</label>
    <input type="text" name="nama_pemohon" required value="<?= $editData ? htmlspecialchars($editData['nama_pemohon']) : '' ?>"><br>

    <label>Tanggal Daftar</label>
    <input type="date" name="tgl_daftar" required value="<?= $editData ? $editData['tgl_daftar'] : date('Y-m-d') ?>"><br>

    <label>Jam</label>
    <input type="time" name="jam" required value="<?= $editData ? $editData['jam'] : '' ?>"><br>

    <?php if ($editData): ?>
        <button type="submit" class="btn">Update</button>
        <a href="index.php">Batal</a>
    <?php else: ?>
        <button type="submit" formaction="index.php" name="simpan" class="btn">Simpan</button>
    <?php endif; ?>
</form>

<h3>Data Pendaftar</h3>
<table>
    <tr>
        <th>No. Daftar</th>
        <th>Nama Pemohon</th>
        <th>Tgl Daftar</th>
        <th>Hari</th>
        <th>Tanggal</th>
        <th>Jam</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $row['no_daftar'] ?></td>
        <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
        <td><?= $row['tgl_daftar'] ?></td>
        <td><?= $row['hari'] ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= substr($row['jam'],0,5) ?></td>
        <td class="aksi">
            <a href="index.php?edit=<?= $row['no_daftar'] ?>">edit</a>
            <a href="index.php?hapus=<?= $row['no_daftar'] ?>" onclick="return confirm('Hapus data ini?')">hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php require '../includes/footer.php'; ?>
