<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Pathname, Name FROM map Where Map <> 22 and Map <> 23 and Map <> 24 ORDER BY Rand() LIMIT 1");
while($row = mysqli_fetch_array($result)){
echo '<a class = "center" href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'] .'">Random Link:<br />' .$row['Name'] .'</a>';
}
?> 