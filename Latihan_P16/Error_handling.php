<?php
/**
 * PEMROGRAMAN WEB 2 - PERTEMUAN 16
 * Error Handling 1
 *
 * Semua contoh ditulis ulang untuk PHP modern (PHP 8+).
 * Fungsi mysql_*() sudah dihapus sejak PHP 7, diganti dengan PDO.
 * Struktur dan semantik setiap contoh tetap dipertahankan.
 */

// ===========================================================
// KONFIGURASI DATABASE (sesuaikan dengan Laragon)
// ===========================================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'lat_dbase');       // ganti dengan nama database kamu
define('DB_USER', 'root');
define('DB_PASS', '');

echo "=======================================================\n";
echo " PERTEMUAN 16 - ERROR HANDLING 1\n";
echo "=======================================================\n\n";


// ===========================================================
// CONTOH 1 (Slide 6)
// Contoh error: query SQL salah, ditangani dengan or die()
// Versi modern: gunakan PDO dengan exception
// ===========================================================

echo "--- Contoh 1: Query SQL dengan penanganan error (Slide 6) ---\n";

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Simulasi query yang salah (nama tabel tidak ada)
    $query = "SELECT * FROM tabel_yang_tidak_ada";
    $pdo->query($query);

} catch (PDOException $e) {
    // Padanan modern dari: mysql_query($query) or die(mysql_error());
    die("Query error: " . $e->getMessage() . "\n");
}


// ===========================================================
// CONTOH 2 (Slide 9, Contoh Kiri)
// Error: echo sebelum session_start() → headers already sent
// Perbaikan: session_start() harus dipanggil sebelum output apapun
// ===========================================================

echo "\n--- Contoh 2: session_start() setelah echo (Slide 9, kiri) ---\n";
echo "POLA SALAH:\n";
echo "  echo \"Hallo...\";\n";
echo "  session_start(); // ERROR: headers already sent\n\n";

echo "POLA BENAR:\n";
echo "  session_start(); // harus di baris paling atas\n";
echo "  echo \"Hallo...\";\n\n";


// ===========================================================
// CONTOH 3 (Slide 9, Contoh Kanan)
// Error: HTML ditulis sebelum session_start()
// Perbaikan: session_start() harus sebelum tag HTML apapun
// ===========================================================

echo "--- Contoh 3: HTML sebelum session_start() (Slide 9, kanan) ---\n";
echo "POLA SALAH:\n";
echo "  <html><head><title>...</title></head>\n";
echo "  <?php session_start(); ?> // ERROR: headers already sent\n\n";

echo "POLA BENAR:\n";
echo "  <?php session_start(); ?>\n";
echo "  <html><head><title>...</title></head>\n\n";


// ===========================================================
// CONTOH 4 (Slide 10 & 11)
// Error: include file yang berisi echo, lalu session_start()
// Perbaikan: session_start() harus dipanggil sebelum include
// ===========================================================

echo "--- Contoh 4: include file dengan echo sebelum session_start() (Slide 10-11) ---\n";
echo "Isi header.php yang menyebabkan error:\n";
echo "  <?php echo \"hallo\"; ?>\n\n";

echo "POLA SALAH:\n";
echo "  include \"header.php\"; // header.php sudah echo string\n";
echo "  session_start();       // ERROR: headers already sent\n\n";

echo "POLA BENAR:\n";
echo "  session_start();       // dipanggil sebelum include\n";
echo "  include \"header.php\";\n\n";


// ===========================================================
// BONUS: Demo sesi yang benar (buat file demo_session.php)
// ===========================================================

echo "=======================================================\n";
echo " DEMO SESI YANG BENAR (lihat file demo_session.php)\n";
echo "=======================================================\n";
// <!-- Project 16.2 By ASEP SURYA AGUSTIN - 221011450392  -->
?>