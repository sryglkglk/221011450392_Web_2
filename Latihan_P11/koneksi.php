<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";

$link = mysqli_connect($servername, $dbusername, $dbpassword)
    or die("Not able to connect to server");

if ($link) {
    echo "ok....koneksi berhasil";
}
// Project 11.1 By ASEP SURYA AGUSTIN - 221011450392 
?>