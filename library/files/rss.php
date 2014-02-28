<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/config_gigi.php';
$fname = $doc_root .'/rss.xml';
$fhandle = fopen($fname,"r");
$open = '<?xml version="1.0"?><rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom"><channel><title>' .$site_name .'</title><description>Newest pages to ' .$site_name .'.</description><link>' .'http://' .$_SERVER['SERVER_NAME'] .'/index.php</link><atom:link href="http://' .$_SERVER['SERVER_NAME'] .'/rss.xml" rel="self" type="application/rss+xml" />';
$end = '</channel></rss>';
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$content4 = '';
$result = mysqli_query ($conn, "SELECT Name, Pathname FROM map Where Map <> 22 and Map <> 23 and Map <> 24 ORDER BY Created DESC LIMIT 12");
while($row = mysqli_fetch_array($result)){
$Title = $row['Name'];
$Url = 'http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'];
$item = '<item><title>'.$Title .'</title><link>' .$Url .'</link><guid>' .$Url .'</guid></item>';
$content4 = $content4 .$item;
}
$content4 = $open .$content4 .$end;
$fhandle = fopen($fname,"w");
fwrite($fhandle,$content4);
fclose($fhandle);
?>