<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
echo '<p id = "date">';
$test = $_SERVER["PHP_SELF"];
$test = substr($test, 1);
$result = mysqli_query($conn, "SELECT Created FROM map WHERE Pathname = '$test'");
while($row = mysqli_fetch_array($result)){
$cdate = $row['Created'];
$cdate2 = strtotime("$cdate");
echo date("m d Y", "$cdate2");
}
echo " - " .date("m d Y", filemtime($_SERVER["SCRIPT_FILENAME"])) .'</p>';
include 'closedb.php';
?>