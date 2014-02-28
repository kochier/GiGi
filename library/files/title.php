<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$test = $_SERVER["PHP_SELF"];
$test = substr($test, 1);
if ($test == 'index.php')
{
}
else
{
echo '<h2 class = "center">';
$result = mysqli_query($conn, "SELECT Name, Created, Map, Pathname FROM map WHERE Pathname = '$test'");
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
$Name = $row['Name'];
$Created = $row['Created'];
$Pathname = $row['Pathname'];
$result24 = mysqli_query($conn, "SELECT Map FROM map WHERE Child = '$Map'");
while($row = mysqli_fetch_array($result24)){
$Map2 = $row['Map'];
}
$result33 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Child = '$Map2'");
while($row = mysqli_fetch_array($result33)){
$Pathname3 = $row['Pathname'];
}
$result44 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Child = '$Map'");
while($row = mysqli_fetch_array($result44)){
$Pathname2 = $row['Pathname'];
}
if (empty($Pathname3))
{
$Pathname3 = $Pathname2;
}
else{
}
if ($Pathname3== 'blog.php' or $Pathname3 == 'news.php')
{
echo $Name;
echo ': ' .$Created;
}
else
{
echo $Name;
}
}
echo '</h2>';
include 'closedb.php';
}
?>