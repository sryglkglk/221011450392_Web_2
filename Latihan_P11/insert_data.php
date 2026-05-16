<?php
$con = mysqli_connect("localhost","root","");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli_select_db($con, "lat_dbase");

if (mysqli_query($con, "INSERT INTO tbl_mhs (FirstName, LastName, Age) VALUES ('Karina', 'Suwandi', 29)")) {
    echo "Berhasil!";
} else {
    echo mysqli_error($con);
}
if (mysqli_query($con, "INSERT INTO tbl_mhs (FirstName, LastName, Age) VALUES ('Glenn', 'Gandari', 32)")) {
    echo "Berhasil!";
} else {
    echo mysqli_error($con);
}

mysqli_close($con);
// Project 11.4 By ASEP SURYA AGUSTIN - 221011450392
?>