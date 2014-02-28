<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$path_parts = pathinfo(($_SERVER["SCRIPT_FILENAME"]));
$path = $path_parts['basename'];
echo '<ul>';
if ($path == 'index.php')
{
}
else
{
if ($path =='images.php')
{
echo '</ul><div class = "images"><h2>Galleries</h2></div>';
$result = mysqli_query($conn, "SELECT Child FROM map WHERE Pathname = '$path'");
while($row = mysqli_fetch_array($result)){
$Child = $row['Child'];
}
$result2 = mysqli_query($conn, "SELECT Pathname, Child, Name FROM map WHERE Map = '$Child' Order By Name");
while($row = mysqli_fetch_array($result2)){
$Child2 = $row['Child'];
$Pathname = $row['Pathname'];
$Name = $row['Name'];
$result3 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Map = '$Child2' ORDER BY RAND() LIMIT 1");
while($row = mysqli_fetch_array($result3)){
$Pathname2 = $row['Pathname'];
$result4 = mysqli_query($conn, "SELECT Src FROM images WHERE Url = '$Pathname2'");
while($row = mysqli_fetch_array($result4)){
$Src = $row['Src'];
$Src = '/thumbnails/thumb' .$Src;
echo '<a href ="' .$Pathname .'"><img src ="' .$Src .'" alt =" Thumbnail " title ="'.$Name .'" width ="125" height ="125"/></a> ';
}
}
}
echo '</div>';
include $doc_root .'/library/files/recent_image_tags.php';
echo '<ul>';
}
elseif ($path =='videos.php')
{
echo '</ul><div class = "images"><h2>Galleries</h2></div>';
$result = mysqli_query($conn, "SELECT Child FROM map WHERE Pathname = '$path'");
while($row = mysqli_fetch_array($result)){
$Child = $row['Child'];
}
$result2 = mysqli_query($conn, "SELECT Pathname, Child, Name FROM map WHERE Map = '$Child' Order By Name");
while($row = mysqli_fetch_array($result2)){
$Child2 = $row['Child'];
$Pathname = $row['Pathname'];
$Name = $row['Name'];
$result3 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Map = '$Child2' ORDER BY RAND() LIMIT 1");
while($row = mysqli_fetch_array($result3)){
$Pathname2 = $row['Pathname'];
$result4 = mysqli_query($conn, "SELECT Src FROM video WHERE Url = '$Pathname2'");
while($row = mysqli_fetch_array($result4)){
$Src = $row['Src'];
$path_parts = pathinfo(($Src));
$Src2 = $path_parts['filename'];
$Src2 = $Src2 .'.jpg';
$Src = '/video_thumbs/' .$Src;
$Src2 = '/video_thumbs/' .$Src2;
echo '<div class = "video_overlay"><a href ="' .$Pathname .'"><img src ="' .$Src2 .'" onmouseover="this.src=\'' .$Src.'\'" onmouseout="this.src=\'' .$Src2 .'\'" alt =" Thumbnail " title ="'.$Name .'" width ="125" height ="125"/></a></div> ';
}
}
}
echo '</div>';
include $doc_root .'/library/files/recent_video_tags.php';
echo '<ul>';
}
else
{
$result = mysqli_query($conn, "SELECT Child, Map FROM map WHERE Pathname = '$path' ");
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
$Child = $row['Child'];
}
$result2 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Child = '$Map'");
while($row = mysqli_fetch_array($result2)){
$Pathname = $row['Pathname'];
}
if ($Pathname == 'images.php')
{
echo '</ul>';
$result = mysqli_query($conn, "SELECT Pathname FROM map WHERE Map = '$Child' ORDER BY Name");
while($row = mysqli_fetch_array($result)){
$Pathname = $row['Pathname'];
$result2 = mysqli_query($conn, "SELECT Url, Title, Src FROM images WHERE Url = '$Pathname' ORDER BY Title ASC");
while($row = mysqli_fetch_array($result2)){
$Title = $row['Title'];
$Src = $row['Src'];
$Url = $row['Url'];
$Src = '/thumbnails/thumb' .$Src;
echo '<a href ="' .$Url .'"><img src ="' .$Src .'" alt =" Thumbnail " title ="'.$Title .'" width ="125" height ="125"/></a> ';
}
}
echo '<ul>';
}
elseif ($Pathname =='videos.php')
{
echo '</ul>';
$result = mysqli_query($conn, "SELECT Pathname FROM map WHERE Map = '$Child' ORDER BY Name");
while($row = mysqli_fetch_array($result)){
$Pathname = $row['Pathname'];
$result2 = mysqli_query($conn, "SELECT Url, Name, Src FROM video WHERE Url = '$Pathname' ORDER BY Name ASC");
while($row = mysqli_fetch_array($result2)){
$Name = $row['Name'];
$Src = $row['Src'];
$path_parts = pathinfo(($Src));
$Src2 = $path_parts['filename'];
$Src2 = $Src2 .'.jpg';
$Url = $row['Url'];
$Src = '/video_thumbs/' .$Src;
$Src2 = '/video_thumbs/' .$Src2;
echo '<div class = "video_overlay"><a href ="' .$Pathname .'"><img src ="' .$Src2 .'" onmouseover="this.src=\'' .$Src.'\'" onmouseout="this.src=\'' .$Src2 .'\'" alt =" Thumbnail " title ="'.$Name .'" width ="125" height ="125"/></a></div> ';
}
}
echo '<ul>';
}
else
{
if ($Pathname == 'blog.php' or $Pathname == 'news.php')
{
$result = mysqli_query($conn, "SELECT Pathname, Name, Created FROM map WHERE Map = '$Child' ORDER BY Created DESC");
while($row = mysqli_fetch_array($result)){
echo '<li><a href="' .$row['Pathname'] .'">' .$row['Name'] .'</a> - ' .$row['Created']. '</li>';
}
}
else
{
if ($path == 'blog.php' or $path == 'news.php')
{
$result = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Map = '$Child' ORDER BY Created DESC");
}
else
{
$result = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Map = '$Child' ORDER BY Name ASC");
}
while($row = mysqli_fetch_array($result)){
$pathname = $row['Pathname'];
echo '<li><a href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'] .'">' .$row['Name'] .'</a></li>';
}
}
}
}
}
echo '</ul>';
include $doc_root .'/library/files/closedb.php';
?>