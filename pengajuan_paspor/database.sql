-- ============================================
-- DATABASE: pengajuan_paspor
-- UAS Pemrograman Web II
-- ============================================

CREATE DATABASE IF NOT EXISTS pengajuan_paspor;
USE pengajuan_paspor;

-- Tabel 1: Pendaftaran Awal (Daftar)
CREATE TABLE IF NOT EXISTS pendaftar (
    no_daftar INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemohon VARCHAR(100) NOT NULL,
    tgl_daftar DATE NOT NULL,
    hari VARCHAR(20) NOT NULL,       -- hari harus datang (hasil hitung)
    tanggal DATE NOT NULL,           -- tanggal harus datang (hasil hitung)
    jam TIME NOT NULL                -- jam harus datang
);

-- Tabel 2: Daftar Ulang
CREATE TABLE IF NOT EXISTS daftar_ulang (
    no_daftar_ulang INT AUTO_INCREMENT PRIMARY KEY,
    no_daftar INT NOT NULL,          -- relasi ke tabel pendaftar
    nama_pemohon VARCHAR(100) NOT NULL,
    keperluan VARCHAR(20) NOT NULL,  -- Daftar / Perpanjang (contoh)
    ktp ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    kk ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    ijazah_akta ENUM('Ada','Tidak') NOT NULL DEFAULT 'Tidak',
    hari_daftar_ulang VARCHAR(20),
    tgl_daftar_ulang DATE,
    keterangan VARCHAR(10),          -- OK / tidak
    no_antrian VARCHAR(20),          -- otomatis jika keterangan OK
    FOREIGN KEY (no_daftar) REFERENCES pendaftar(no_daftar)
);

-- Tabel 3: Pengurusan Paspor
CREATE TABLE IF NOT EXISTS pengurusan (
    id_pengurusan INT AUTO_INCREMENT PRIMARY KEY,
    no_antrian VARCHAR(20) NOT NULL,
    no_daftar INT NOT NULL,
    nama_pemohon VARCHAR(100) NOT NULL,
    berkas VARCHAR(20),              -- Lengkap / Tidak Lengkap
    status VARCHAR(20),              -- Diterima / Ditolak
    keterangan VARCHAR(10),          -- OK / tidak
    pembayaran INT DEFAULT 0,        -- 355000 jika diterima
    FOREIGN KEY (no_daftar) REFERENCES pendaftar(no_daftar)
);
