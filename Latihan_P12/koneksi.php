<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "lat_dbase";

// Lakukan koneksi dengan MySQL
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$connection) {
    echo "Tidak dapat terhubung dengan database";
    exit;
} else {
    echo "Database telah Terhubung!";
}

// Tidak perlu mysql_select_db() lagi, sudah include di mysqli_connect()
// Project 12.3 By ASEP SURYA AGUSTIN - 221011450392
?>