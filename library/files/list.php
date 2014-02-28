<?php
include '../opendb_gigi.php';
$result = mysqli_query ($conn, "SELECT Created, Name, Pathname FROM map Where Map <> 22 and Map <> 23 and Map <> 24 ORDER BY Created DESC LIMIT 12");
echo '<ul>';
while($row = mysqli_fetch_array($result)){
echo '<li><a href ="' .$row['Pathname'] .'">' .$row['Name'] .'</a> - ';
$cdate = $row['Created'];
$cdate2 = strtotime("$cdate");
echo date("m d Y", "$cdate2") .'</li>';
}
echo '</ul>';
include 'closedb.php';
?>