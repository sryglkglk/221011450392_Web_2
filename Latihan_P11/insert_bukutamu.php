<?php
$con = mysql_connect("localhost","root","");
mysql_select_db("lat_dbase", $con);

// Buat tabel jika belum ada
mysql_query("CREATE TABLE IF NOT EXISTS buku_tamu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50),
    email VARCHAR(50),
    pesan TEXT
)");

$sql = "INSERT INTO buku_tamu (nama, email, pesan)
        VALUES ('$_POST[nama]', '$_POST[email]', '$_POST[pesan]')";

if (!mysql_query($sql, $con)) {
    die('Error: ' . mysql_error());
}
echo "Terima kasih, data buku tamu tersimpan.";
mysql_close($con);
// Project 11.11 By ASEP SURYA AGUSTIN - 221011450392
?>