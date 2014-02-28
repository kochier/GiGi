<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
echo '<link rel="stylesheet" type="text/css" href="http://' .$_SERVER['SERVER_NAME'] .'/style.css"/>';
echo '<link rel="shortcut icon" href="http://' .$_SERVER['SERVER_NAME'] .'/icon.ico"/>';
echo '<link rel="apple-touch-icon" href="http://' .$_SERVER['SERVER_NAME'] .'/favicon.png"/>';
include $path_parts_1['dirname'] .'/config_gigi.php';
echo '<link rel="alternate" type="application/rss+xml" href="rss.xml" title="' .$site_name .'\'s Feed" />';
$ip = getenv ("REMOTE_ADDR");
$server_name = getenv ("SERVER_NAME");
$request_uri = getenv ("REQUEST_URI"); 
$request_uri = 'http://' .$server_name .$request_uri;
$http_ref = getenv ("HTTP_REFERER"); 
$error_date = date("D M j Y g:i:s a");
if ($request_uri == $http_ref or $http_ref == '' or $http_ref ==null)
{
}
else
{
$message = '<strong>When: </strong>'.$error_date .'<br /><strong>IP Address:</strong> '.$ip .'<br /><strong>Accessed:</strong>'.$request_uri .'<br /><strong>Referer:</strong> '.$http_ref .'<br /><br />';
$alpha2 = "<?php include \$_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>";
$omega2 = "<?php include \$_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>";
$fname = $doc_root .'/library/log.php';
$fhandle = fopen($fname,"r");
$content = fread($fhandle,filesize($fname));
$content = str_replace($alpha2, '', $content);
$content = str_replace($omega2, '', $content);
$content = $content .' ' .$message;
$content = $alpha2 .$content .$omega2;
$fhandle = fopen($fname,"w");
fwrite($fhandle,$content);
fclose($fhandle);
}
include $doc_root .'/library/files/title2.php';
echo ' </head><body><h1><a href="http://' .$_SERVER['SERVER_NAME'] .'/index.php">' .$site_name .'</a></h1>';
include $doc_root .'/library/files/date.php';
?>
<div id ="wrap">
<div id = "sidebar">
<?php
include $doc_root .'/library/files/sidebar.php';
?>
</div>
<div id ="content">
<?php
$i = 0;
include $doc_root .'/library/files/title.php';
?>
<div class ="in">
<?php
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$path = $_SERVER["PHP_SELF"];
$path = substr($path, 1);
$result = mysqli_query($conn, "SELECT Map, Pathname, Child, Parent FROM map WHERE Pathname = '$path'");
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
$Pathname = $row['Pathname'];
$Child = $row['Child'];
$Parent = $row['Parent'];
if ($Map ==40 or $Map ==50 or $Pathname =='images.php' or $Pathname =='videos.php')
{
echo '<div class ="center">';
}
elseif ($Parent ==40 or $Parent ==50)
{
echo '<div class ="center">';
$result33 = mysqli_query($conn, "SELECT Pathname FROM map WHERE Map = '$Map' ORDER BY Name");
while($row = mysqli_fetch_array($result33)){
$Pathname2 = $row['Pathname'];
If ($Pathname2 != $Pathname)
{
$i = $i +1;
}
else
{
$total = mysqli_num_rows($result33);
$p = $i - 1;
$n = $i + 1;
if ($n == $total)
{
$n = 0;
}
if ($p == -1)
{
$p = $total -1;
}
$p = mysqli_data_seek($result33, $p);
$p = mysqli_fetch_row($result33);
$n = mysqli_data_seek($result33, $n);
$n = mysqli_fetch_row($result33);
echo '<a href="' .$p[0] .'">Prev</a> ';
echo '<a href="' .$n[0] .'">Next</a>';
echo '<br /><br />';
break;
}
}
}
else
{
break;
}
}
if ($Child > 0)
{
include $doc_root .'/library/files/category.php';
}
?>