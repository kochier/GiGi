<?php
include '../opendb_gigi.php';
$result = mysqli_query ($conn, "SELECT Pname, Url, Created FROM comment ORDER BY Created DESC LIMIT 5");
echo '<ul>';
while($row = mysqli_fetch_array($result)){
$Url = $row['Url'];
$Pname = $row['Pname'];
$cdate = $row['Created'];
$cdate2 = strtotime("$cdate");
$result2 = mysqli_query ($conn, "SELECT Name FROM map WHERE Pathname = '$Url'");
while($row = mysqli_fetch_array($result2)){
$Name = $row['Name'];
echo '<li><a href ="' .$Url .'#comments">' .$Pname .' Commented On: '.$row['Name'].'</a> - ';
echo date("m d Y h:i:s", "$cdate2") .'</li>';
}
}
echo '</ul>';
include 'library/files/closedb.php';
?>
