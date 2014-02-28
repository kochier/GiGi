<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/config_gigi.php';
include $path_parts_1['dirname'] .'/opendb_gigi.php';
echo '<title>' .$site_name .' - ';
$test = $_SERVER["PHP_SELF"];
$test = substr($test, 1);
$result = mysqli_query($conn, "SELECT Name,Created,Map FROM map WHERE Pathname = '$test'");
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
$Name = $row['Name'];
$Created = $row['Created'];
$Map2 = '0';
$result24 = mysqli_query($conn, "SELECT Map FROM map WHERE Child = '$Map'");
while($row = mysqli_fetch_array($result24)){
$Map2 = $row['Map'];
}
$result33 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Child = '$Map2'");
while($row = mysqli_fetch_array($result33)){
$Pathname = $row['Pathname'];
}
$result44 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Child = '$Map'");
while($row = mysqli_fetch_array($result44)){
$Pathname2 = $row['Pathname'];
}
if (empty($Pathname))
{
$Pathname = $Pathname2;
}
else{
}
if ($Pathname == 'blog.php' or $Pathname == 'news.php')
{
echo $Name;
$cdate = $Created;
$cdate2 = strtotime("$cdate");
echo ': ' .date("m d Y", "$cdate2");
}
else
{
echo $Name;
}
}
echo '</title>';
include 'closedb.php';
?>