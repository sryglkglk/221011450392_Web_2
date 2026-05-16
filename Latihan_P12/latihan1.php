<?php
$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

mysqli_query($con, "UPDATE tbl_mhs SET Age = '36'
WHERE FirstName = 'Karina' AND LastName = 'Suwandi'");

mysqli_close($con);
// Project 12.1 By ASEP SURYA AGUSTIN - 221011450392
?>