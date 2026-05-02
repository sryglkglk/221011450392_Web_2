<?php
mysql_connect("localhost","root","");
mysql_select_db("lat_dbase");

$hasil = mysql_query("SELECT * FROM tbl_mhs");

while ($data = mysql_fetch_array($hasil)) {
    echo "$data[FirstName] $data[LastName] $data[Age]<br>";
}
?>