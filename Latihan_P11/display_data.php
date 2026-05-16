<?php
$con = mysqli_connect("localhost","root","","lat_dbase");
$hasil = mysqli_query($con, "SELECT * FROM tbl_mhs");

while ($data = mysqli_fetch_row($hasil)) {
    echo "$data[0] $data[1] $data[2] $data[3]<br>";
}
// Project 11.5 By ASEP SURYA AGUSTIN - 221011450392
?>