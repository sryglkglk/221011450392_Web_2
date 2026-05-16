<?php
$con = mysqli_connect("localhost","root","","lat_dbase");
$hasil = mysqli_query($con, "SELECT * FROM tbl_mhs");
$hit = mysqli_num_rows($hasil);

echo "Jumlah record: $hit";
// Project 11.7 By ASEP SURYA AGUSTIN - 221011450392
?>