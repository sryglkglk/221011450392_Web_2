<?php
$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_query($con, "DELETE FROM tbl_mhs WHERE LastName='Prabowo'");

mysqli_close($con);
// Project 12.2 By ASEP SURYA AGUSTIN - 221011450392
?>