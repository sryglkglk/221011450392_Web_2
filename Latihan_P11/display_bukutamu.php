<?php
mysql_connect("localhost","root","");
mysql_select_db("lat_dbase");

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$result = mysql_query("SELECT * FROM buku_tamu LIMIT $offset, $limit");

while ($row = mysql_fetch_array($result)) {
    echo "<p><b>$row[nama]</b> ($row[email])<br>$row[pesan]</p>";
}

// Hitung total halaman
$total = mysql_num_rows(mysql_query("SELECT * FROM buku_tamu"));
$pages = ceil($total / $limit);

for ($i=1; $i<=$pages; $i++) {
    echo "<a href='tampil_bukutamu.php?page=$i'>$i</a> ";
}
// Project 11.12 By ASEP SURYA AGUSTIN - 221011450392
?>