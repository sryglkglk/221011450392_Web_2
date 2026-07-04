# Pengajuan Paspor - Kantor Imigrasi Cabang
UAS Pemrograman Web II - PHP Native + MySQL

## Struktur Folder
```
pengajuan_paspor/
├── database.sql          -> import ini dulu ke phpMyAdmin/MySQL
├── includes/
│   ├── koneksi.php       -> setting koneksi database
│   ├── header.php        -> navbar + style bersama
│   └── footer.php
├── daftar/
│   ├── index.php         -> fitur Daftar (pendaftaran awal)
│   └── proses_edit.php
├── daftar_ulang/
│   └── index.php         -> fitur Daftar Ulang
└── pengurusan/
    └── index.php         -> fitur Pengurusan Paspor
```

## Cara Menjalankan (pakai Laragon)
1. Copy folder `pengajuan_paspor` ke folder `www` di Laragon (misal: `C:\laragon\www\pengajuan_paspor`).
2. Buka phpMyAdmin, import file `database.sql` (otomatis membuat database `pengajuan_paspor` beserta 3 tabel).
3. Cek `includes/koneksi.php` — default sudah cocok untuk Laragon (`root`, tanpa password).
4. Jalankan Laragon (Start All), buka browser: `http://localhost/pengajuan_paspor/daftar/index.php`

## Alur Pemakaian (sesuai soal)
1. **Daftar** (`/daftar/`)
   - Input Nama, Tanggal Daftar, Jam.
   - Sistem otomatis menghitung **Hari & Tanggal harus datang**, berdasarkan kapasitas
     maksimal 5 orang per hari. Jika tanggal sudah penuh (>=5 pendaftar), otomatis
     digeser ke hari berikutnya (fungsi `hitungJadwal()`).

2. **Daftar Ulang** (`/daftar_ulang/`)
   - Pilih No. Daftar dari dropdown (relasi ke data Daftar).
   - Centang berkas yang dibawa: KTP, KK, Ijazah/Akta.
   - Pilih Keperluan (Daftar Baru / Perpanjang / Rusak-Hilang) — masing-masing
     punya syarat kelengkapan berkas berbeda (lihat fungsi `cekKeterangan()`).
   - Jika berkas sesuai syarat keperluan -> Keterangan = **OK** dan
     **No. Antrian** terbit otomatis (format: A + YYMMDD + nomor urut).
   - Jika tidak sesuai -> Keterangan = **tidak**, tanpa No. Antrian.

3. **Pengurusan** (`/pengurusan/`)
   - Pilih No. Antrian (hanya yang Keterangan = OK dari Daftar Ulang yang muncul).
   - No. Daftar & Nama Pemohon terisi otomatis (JS) begitu No. Antrian dipilih.
   - Sistem cek ulang ke data Daftar Ulang: jika KTP + KK + Ijazah/Akta **semua ada**
     -> Berkas = Lengkap, Status = Diterima, Keterangan = OK, Pembayaran = **Rp355.000** otomatis.
   - Jika tidak lengkap -> Status = Ditolak, Pembayaran = Rp0.
   - Total **Pendapatan** dihitung otomatis (SUM dari semua pembayaran).

## Catatan
- Kode sengaja dibuat sederhana dari sisi tampilan (tanpa Bootstrap/framework CSS)
  tapi lengkap dari sisi fungsi & logika (CRUD, relasi antar tabel, kalkulasi otomatis).
- Menggunakan mysqli (bukan PDO) supaya sesuai kebiasaan pembelajaran dasar Pemrograman Web II.
- Untuk produksi sebaiknya pakai prepared statement; di sini masih pakai
  `mysqli_real_escape_string` untuk kesederhanaan submission tugas.

## CREDITS
ASEP SURYA AGUSTIN - 221011450392 - 07TPLE004
