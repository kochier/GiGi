<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$path = $_SERVER["PHP_SELF"];
$path = substr($path, 1);
$sarray = array();
$result = mysqli_query($conn, "SELECT Map, Parent FROM map WHERE Pathname = '$path'");  
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
$Parent =$row['Parent'];
}
while($Parent > 0)
{
$result2 = mysqli_query($conn, "SELECT Pathname, Name, Parent, Map FROM map WHERE Child = '$Map'");
while($row = mysqli_fetch_assoc($result2)){
$Map = $row['Map'];
$Parent = $row['Parent'];
$sarray[] = '<a class = "sidebar2" href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'] .'">>'.$row['Name'] .'</a>';
}
} 
krsort($sarray);
foreach ($sarray as $value) {
echo $value;
}
include 'closedb.php';
?>