<?php
$link = mysqli_connect("localhost", "root", "") or die("Not able to connect to server");
mysqli_select_db($link, "lat_dbase");

// Membuat tabel
$sql = "CREATE TABLE tbl_mhs (
    mhsID int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(mhsID),
    FirstName varchar(15),
    LastName varchar(15),
    Age int
)";
mysqli_query($link, $sql);

// Input data awal
if (mysqli_query($link, "INSERT INTO tbl_mhs(FirstName, LastName, Age) VALUES('Anjar','Prabowo',25)")) {
    echo "Berhasil";
} else {
    echo "Error: " . mysqli_error($link);
}
// Project 11.3 By ASEP SURYA AGUSTIN - 221011450392
?>