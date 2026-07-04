<?php
require '../includes/koneksi.php';

// ============================================
// FUNGSI: Cek kelengkapan berkas sesuai keperluan
// Aturan sederhana:
// - Daftar Baru   -> wajib KTP + KK + Ijazah/Akta
// - Perpanjang    -> wajib KTP + KK
// - Rusak/Hilang  -> wajib KTP + Ijazah/Akta
// Jika sesuai persyaratan keperluan -> Keterangan "OK", selain itu "tidak"
// ============================================
function cekKeterangan($keperluan, $ktp, $kk, $ijazah) {
    $syarat = [
        'Daftar Baru' => ['ktp' => true, 'kk' => true, 'ijazah' => true],
        'Perpanjang'  => ['ktp' => true, 'kk' => true, 'ijazah' => false],
        'Rusak/Hilang'=> ['ktp' => true, 'kk' => false, 'ijazah' => true],
    ];

    if (!isset($syarat[$keperluan])) return 'tidak';

    $s = $syarat[$keperluan];
    if ($s['ktp']    && $ktp    !== 'Ada') return 'tidak';
    if ($s['kk']     && $kk     !== 'Ada') return 'tidak';
    if ($s['ijazah'] && $ijazah !== 'Ada') return 'tidak';

    return 'OK';
}

// ============================================
// FUNGSI: Generate nomor antrian otomatis
// Format: AYYMMDD-XXX (urut per hari)
// ============================================
function generateNoAntrian($koneksi, $tanggal) {
    $kode = 'A' . date('ymd', strtotime($tanggal));
    $q = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM daftar_ulang WHERE no_antrian LIKE '$kode%'");
    $row = mysqli_fetch_assoc($q);
    $urut = $row['jumlah'] + 1;
    return $kode . '-' . str_pad($urut, 3, '0', STR_PAD_LEFT);
}

// ============================================
// PROSES SIMPAN
// ============================================
if (isset($_POST['simpan'])) {
    $noDaftar = (int) $_POST['no_daftar'];
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_pemohon']);
    $keperluan = $_POST['keperluan'];
    $ktp    = isset($_POST['ktp']) ? 'Ada' : 'Tidak';
    $kk     = isset($_POST['kk']) ? 'Ada' : 'Tidak';
    $ijazah = isset($_POST['ijazah_akta']) ? 'Ada' : 'Tidak';
    $hariDU = $_POST['hari_daftar_ulang'];
    $tglDU  = $_POST['tgl_daftar_ulang'];

    $keterangan = cekKeterangan($keperluan, $ktp, $kk, $ijazah);
    $noAntrian = ($keterangan === 'OK') ? generateNoAntrian($koneksi, $tglDU) : null;

    $noAntrianSql = $noAntrian ? "'$noAntrian'" : "NULL";

    mysqli_query($koneksi, "INSERT INTO daftar_ulang
        (no_daftar, nama_pemohon, keperluan, ktp, kk, ijazah_akta, hari_daftar_ulang, tgl_daftar_ulang, keterangan, no_antrian)
        VALUES ($noDaftar, '$nama', '$keperluan', '$ktp', '$kk', '$ijazah', '$hariDU', '$tglDU', '$keterangan', $noAntrianSql)");

    header("Location: index.php?msg=sukses");
    exit;
}

// PROSES HAPUS
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM daftar_ulang WHERE no_daftar_ulang = $id");
    header("Location: index.php");
    exit;
}

// Ambil data pendaftar untuk pilihan No. Daftar (dropdown)
$listPendaftar = mysqli_query($koneksi, "SELECT no_daftar, nama_pemohon FROM pendaftar ORDER BY no_daftar DESC");

// Ambil semua data daftar ulang
$data = mysqli_query($koneksi, "SELECT * FROM daftar_ulang ORDER BY no_daftar_ulang DESC");

require '../includes/header.php';
?>

<div class="info">
    Kelengkapan berkas ditentukan oleh <b>Keperluan</b>:<br>
    - Daftar Baru: wajib KTP + KK + Ijazah/Akta &nbsp;|&nbsp;
    - Perpanjang: wajib KTP + KK &nbsp;|&nbsp;
    - Rusak/Hilang: wajib KTP + Ijazah/Akta<br>
    Jika sesuai syarat &rarr; Keterangan <b>OK</b> dan No. Antrian terbit otomatis. Jika tidak sesuai &rarr; Keterangan <b>tidak</b>.
</div>

<h3>Input Daftar Ulang</h3>
<?php if (isset($_GET['msg'])): ?>
    <p style="color:green;"><b>Data berhasil disimpan.</b></p>
<?php endif; ?>

<form method="POST" action="index.php">
    <label>No. Daftar</label>
    <select name="no_daftar" required>
        <option value="">-- pilih --</option>
        <?php while ($p = mysqli_fetch_assoc($listPendaftar)): ?>
            <option value="<?= $p['no_daftar'] ?>"><?= $p['no_daftar'] ?> - <?= htmlspecialchars($p['nama_pemohon']) ?></option>
        <?php endwhile; ?>
    </select><br>

    <label>Nama Pemohon</label>
    <input type="text" name="nama_pemohon" required><br>

    <label>Hari Datang</label>
    <input type="text" name="hari_daftar_ulang" placeholder="misal: Senin" required><br>

    <label>Tgl Datang</label>
    <input type="date" name="tgl_daftar_ulang" required><br>

    <label>Berkas</label>
    <input type="checkbox" name="ktp"> KTP
    <input type="checkbox" name="kk"> KK
    <input type="checkbox" name="ijazah_akta"> Ijazah/Akta<br>

    <label>Keperluan</label>
    <select name="keperluan" required>
        <option value="Daftar Baru">Daftar Baru</option>
        <option value="Perpanjang">Perpanjang</option>
        <option value="Rusak/Hilang">Rusak/Hilang</option>
    </select><br>

    <button type="submit" name="simpan" class="btn">Simpan</button>
</form>

<h3>Data Pendaftar Ulang</h3>
<table>
    <tr>
        <th>No. Daftar</th>
        <th>Nama Pemohon</th>
        <th>Keperluan</th>
        <th>KTP</th>
        <th>KK</th>
        <th>Ijazah/Akta</th>
        <th>Keterangan</th>
        <th>No. Antrian</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($data)): ?>
    <tr>
        <td><?= $row['no_daftar'] ?></td>
        <td><?= htmlspecialchars($row['nama_pemohon']) ?></td>
        <td><?= $row['keperluan'] ?></td>
        <td><?= $row['ktp'] ?></td>
        <td><?= $row['kk'] ?></td>
        <td><?= $row['ijazah_akta'] ?></td>
        <td class="<?= $row['keterangan']==='OK' ? 'badge-ok' : 'badge-no' ?>"><?= $row['keterangan'] ?></td>
        <td><?= $row['no_antrian'] ?? '-' ?></td>
        <td class="aksi">
            <a href="index.php?hapus=<?= $row['no_daftar_ulang'] ?>" onclick="return confirm('Hapus data ini?')">hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php require '../includes/footer.php'; ?>
