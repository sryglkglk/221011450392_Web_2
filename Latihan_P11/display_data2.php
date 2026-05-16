<?php
$con = mysqli_connect("localhost","root","","lat_dbase");
$hasil = mysqli_query($con, "SELECT * FROM tbl_mhs");

while ($data = mysqli_fetch_array($hasil)) {
    echo "$data[FirstName] $data[LastName] $data[Age]<br>";
}
// Project 11.6 By ASEP SURYA AGUSTIN - 221011450392
?>