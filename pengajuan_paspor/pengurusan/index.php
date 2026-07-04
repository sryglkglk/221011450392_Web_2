<?php
require '../includes/koneksi.php';

// ============================================
// PROSES SIMPAN
// Aturan:
// - Jika KTP, KK, Ijazah/Akta SEMUA ada -> berkas "Lengkap", status "Diterima",
//   keterangan "OK", pembayaran = 355000
// - Jika tidak semua ada -> berkas "Tidak Lengkap", status "Ditolak",
//   keterangan "tidak", pembayaran = 0
// ============================================
if (isset($_POST['simpan'])) {
    $noAntrian = mysqli_real_escape_string($koneksi, $_POST['no_antrian']);
    $noDaftar  = (int) $_POST['no_daftar'];
    $nama      = mysqli_real_escape_string($koneksi, $_POST['nama_pemohon']);

    // Ambil status kelengkapan berkas dari data daftar_ulang terkait no_antrian
    $q = mysqli_query($koneksi, "SELECT ktp, kk, ijazah_akta FROM daftar_ulang WHERE no_antrian = '$noAntrian' LIMIT 1");
    $berkasRow = mysqli_fetch_assoc($q);

    $lengkap = $berkasRow && $berkasRow['ktp'] === 'Ada' && $berkasRow['kk'] === 'Ada' && $berkasRow['ijazah_akta'] === 'Ada';

    if ($lengkap) {
        $berkas = 'Lengkap';
        $status = 'Diterima';
        $keterangan = 'OK';
        $pembayaran = 355000;
    } else {
        $berkas = 'Tidak Lengkap';
        $status = 'Ditolak';
        $keterangan = 'tidak';
        $pembayaran = 0;
    }

    mysqli_query($koneksi, "INSERT INTO pengurusan
        (no_antrian, no_daftar, nama_pemohon, berkas, status, keterangan, pembayaran)
        VALUES ('$noAntrian', $noDaftar, '$nama', '$berkas', '$status', '$keterangan', $pembayaran)");

    header("Location: index.php?msg=sukses");
    exit;
}

// PROSES HAPUS
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pengurusan WHERE id_pengurusan = $id");
    header("Location: index.php");
    exit;
}

// Dropdown pilihan no. antrian (hanya yang keterangan OK dari daftar ulang)
$listAntrian = mysqli_query($koneksi, "SELECT no_antrian, no_daftar, nama_pemohon FROM daftar_ulang WHERE keterangan = 'OK' ORDER BY no_antrian DESC");

// Ambil semua data pengurusan
$data = mysqli_query($koneksi, "SELECT * FROM pengurusan ORDER BY id_pengurusan DESC");

// Hitung total pendapatan
$totalQ = mysqli_query($koneksi, "SELECT SUM(pembayaran) AS total FROM pengurusan");
$total = mysqli_fetch_assoc($totalQ)['total'] ?? 0;

require '../includes/header.php';
?>

<div class="info">
    Jika KTP, KK, dan Ijazah/Akta <b>semua ada</b> &rarr; Berkas = Lengkap, Status = Diterima, Keterangan = OK, Pembayaran = Rp355.000 (otomatis).<br>
    Jika salah satu tidak ada &rarr; Status = Ditolak, Pembayaran = Rp0.
</div>

<h3>Input Pengurusan Berkas</h3>
<?php if (isset($_GET['msg'])): ?>
    <p style="color:green;"><b>Data berhasil disimpan.</b></p>
<?php endif; ?>

<form method="POST" action="index.php" id="formPengurusan">
    <label>No. Antrian</label>
    <select name="no_antrian" id="no_antrian" required onchange="isiOtomatis(this)">
        <option value="">-- pilih --</option>
        <?php while ($a = mysqli_fetch_assoc($listAntrian)): ?>
            <option value="<?= $a['no_antrian'] ?>" data-nodaftar="<?= $a['no_daftar'] ?>" data-nama="<?= htmlspecialchars($a['nama_pemohon']) ?>">
                <?= $a['no_antrian'] ?> - <?= htmlspecialchars($a['nama_pemohon']) ?>
            </option>
        <?php endwhile; ?>
    </select><br>

    <label>No. Daftar</label>
    <input type="text" name="no_daftar" id="no_daftar" readonly required><br>

    <label>Nama Pemohon</label>
    <input type="text" name="nama_pemohon" id="nama_pemohon" readonly required><br>

    <button type="submit" name="simpan" class="btn">Proses</button>
</form>

<script>
// Isi otomatis No. Daftar & Nama Pemohon berdasarkan No. Antrian yang dipilih
function isiOtomatis(select) {
    const opt = select.options[select.selectedIndex];
    document.getElementById('no_daftar').value = opt.getAttribute('data-nodaftar') || '';
    document.getElementById('nama_pemohon').value = opt.getAttribute('data-nama') || '';
}
</script>

<h3>Data Pengurusan Paspor</h3>
<table>
    <tr>
        <th>No. Antrian</th>
        <th>No. Daftar</th>
        <th>Nama Pemohon</th>
        <th>Berkas</th>
        <th>Status</th>
        <th>Keterangan</th>
        <th>Pembayaran</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $row['no_antrian'] ?></td>
        <td><?= $row['no_daftar'] ?></td>
        <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
        <td><?= $row['berkas'] ?></td>
        <td><?= $row['status'] ?></td>
        <td class="<?= $row['keterangan']==='OK' ? 'badge-ok' : 'badge-no' ?>"><?= $row['keterangan'] ?></td>
        <td>Rp<?= number_format($row['pembayaran'],0,',','.') ?></td>
        <td class="aksi">
            <a href="index.php?hapus=<?= $row['id_pengurusan'] ?>" onclick="return confirm('Hapus data ini?')">hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<h3>Pendapatan</h3>
<input type="text" value="Rp<?= number_format($total,0,',','.') ?>" disabled style="font-weight:bold; font-size:16px; width:200px;">

<?php require '../includes/footer.php'; ?>
