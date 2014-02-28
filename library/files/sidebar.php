<?php
echo '<div class = "top">';
include 'randomlink.php';
echo '</div>';
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include 'sidebar2.php';
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$path = $_SERVER["PHP_SELF"];
$path = substr($path, 1);
$result = mysqli_query($conn, "SELECT Map FROM map WHERE Pathname = '$path' ORDER BY Name ASC");  
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
if ($Map ==22)
{
$result22 = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Map = '$Map'");
while($row = mysqli_fetch_array($result22)){
$path22 = $row['Pathname'];
if ($path == $path22)
{
echo '<div id = "current">'.'&bull;'.$row['Name'].'</div>';
}
}
}
else
{
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
if ($Pathname == 'blog.php' or $Pathname == 'news.php')
{
$result2 = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Map = '$Map' ORDER BY Created DESC");
while($row = mysqli_fetch_array($result2)){
$path2 = $row['Pathname'];
if ($path == $path2)
{
echo '<div id = "current">'.'&bull;'.$row['Name'].'</div>';
}
else
{
echo '<a class = "sidebar2" href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'].'">&bull;'.$row['Name'].'</a>';
}
}
}
else
{
if (empty($Pathname2))
{
$Pathname2 = $Pathname;
}
else{
}
if ($Pathname2 == 'blog.php' or $Pathname2 =='news.php')
{
$result2 = mysqli_query($conn, "SELECT Pathname, Name, Child FROM map WHERE Map = '$Map' ORDER BY Created DESC");
}
else
{
$result2 = mysqli_query($conn, "SELECT Pathname, Name, Child FROM map WHERE Map = '$Map' ORDER BY Name ASC");
}
while($row = mysqli_fetch_array($result2)){
$path2 = $row['Pathname'];
$Child = $row['Child'];
if ($path == $path2)
if ($path =='blog.php' or $path =='news.php')
{
echo '<div id = "current">'.'&bull;'.$row['Name'].' (Dir)'.'</div>';
if ($path == 'blog.php' or $path =='news.php')
{
$result = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Map = '$Child'  ORDER BY Created DESC");
}
while($row = mysqli_fetch_array($result)){
echo '<a class = "sidebar3" href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'].'">&bull;'.$row['Name'].'</a>';
}
}
else
{
echo '<div id = "current">'.'&bull;'.$row['Name'].'</div>';
$result = mysqli_query($conn, "SELECT Child FROM map WHERE Pathname = '$path' ");
while($row = mysqli_fetch_array($result)){
$Map22 = $row['Child'];
if ($Map22 == 0)
{
}
if ($Pathname2 == 'blog.php' or $Pathname2 == 'news.php')
{
$result = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Map = '$Map22'  ORDER BY Created DESC");
}
else
{
$result = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Map = '$Map22'  ORDER BY Name ASC");
}
while($row = mysqli_fetch_array($result)){
echo '<a class = "sidebar3" href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'].'">&bull;'.$row['Name'].'</a>';
}
}
}
else
{
echo '<a class = "sidebar2" href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'].'">&bull;'.$row['Name'].'</a>';
}
}
}
}
}
echo '<div class = "center"><a href="http://www.dreamhost.com/donate.cgi?id=16711"><img alt="Donate towards my web hosting bill!" src="https://secure.newdream.net/donate3.gif" /></a></div>';
include 'closedb.php';
?>