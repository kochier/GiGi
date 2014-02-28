<?php
include '../opendb_gigi.php';
$result2 = mysqli_query($conn, "SELECT Modified, Pathname, Name, Created FROM map Where Map <> 22 and Map <> 23 and Map <> 24 ORDER BY Modified DESC");
echo '<ul>';
$arry = array();
while($row = mysqli_fetch_assoc($result2)){
$mdate = $row['Modified'];
$fmtime = "";
$arry[$mdate] = $fmtime;
$mdate2 = date("m d Y", "$mdate"); 
$cdate = $row['Created']; 
$cdate2 = strtotime("$cdate");
$cdate3 = date("m d Y", "$cdate2");
if ($cdate3 == $mdate2)
{
array_pop($arry);
}
else
{
echo '<li><a href ="' .$row['Pathname'] .'">' .$row['Name'] .'</a> - ' .$mdate2 .'</li>';
if(count($arry) == 7){
      break;
   }
}
}
echo '</ul>';
include 'closedb.php';
?> 