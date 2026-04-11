<?php
$file = fopen("test1.txt", "r");
while (!feof($file)) {
    echo fgets($file) . "<br />";
}
fclose($file);
//Project 5.3 By ASEP SURYA AGUSTIN - 221011450392
?>