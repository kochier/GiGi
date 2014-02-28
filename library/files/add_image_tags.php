<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$test = $_SERVER["PHP_SELF"];
$test = substr($test, 1);
$result = mysqli_query($conn, "SELECT Src FROM images WHERE Url = '$test'");
while($row = mysqli_fetch_array($result)){
$Src = $row['Src'];
$result2 = mysqli_query($conn, "SELECT Tag FROM image_tags WHERE Image_url = '$Src' AND Pending = 0 ORDER BY Number ASC");
echo 'Tags: <strong>';
$count = mysqli_num_rows($result2) -1;
$x = 0;
while($row = mysqli_fetch_array($result2)){
  {
$Tag = $row['Tag'];
if ($x == $count)
{
$link = '/search_image_tags.php?search_string=' .$Tag;
echo '"<a href ="' .$link .'">' .$Tag .'</a>" ';
}
else
{
$x = $x +1;
$link = '/search_image_tags.php?search_string=' .$Tag;
echo '"<a href ="' .$link .'">' .$Tag .'</a>", ';
}
}
}
echo '</strong>';
}
?>
<br /><br />
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<input type ="text" name="Tag" size="30" />
<input name ="update" type ="submit" value="Add Tags" /></form>
<?php
if(isset($_POST['update']))
{
$Tag = $_POST['Tag'];
$Tag = htmlspecialchars($Tag);
$Tag = stripslashes($Tag);
if ($Tag ==null)
{
echo 'You didn\'t type in any tags to be added.';
}
else
{
$Pending = 1;
$Tag2 = preg_split("/[,+&]+/", $Tag, 0, PREG_SPLIT_NO_EMPTY);
$arrlength=count($Tag2);
for($x=0;$x<$arrlength;$x++)
  {
$Tag3 = $Tag2[$x];
$Tag3 = trim($Tag3);
$Tag3= ucfirst(strtolower($Tag3));
$Tag3 = htmlspecialchars($Tag3, ENT_QUOTES);
$insert = ("INSERT INTO image_tags (Tag, Image_url, Pending) VALUES ('$Tag3', '$Src', '$Pending')");
mysqli_query($conn, $insert);
$link = '/search_image_tags.php?search_string=' .$Tag3;
echo '<br />"<a href ="' .$link .'"><strong>' .$Tag3 .'</strong></a>" has been added to the pending queue. Once it has been approved it will show up on this page. Thank you.';
}
include $doc_root .'/library/files/closedb.php';
}
}
?>