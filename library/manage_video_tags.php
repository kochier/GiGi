<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
<input name = "view_pending" type ="submit" value="View Pending" />
<input name = "view_accepted" type ="submit" value="View Accepted" /><br /><br />
</p>
</form>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
Tag to Delete (Number):<br />
<input type ="text" name="Delete" size="30" /><br />
<input name = "delete" type ="submit" value="Delete" /><br />
</p>
</form>
<div class = "center">
<?php
if(isset($_POST['view_pending']))
{
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Tag, Video_url, Number FROM video_tags WHERE Pending = 1 ORDER BY Number ASC");
while($row = mysqli_fetch_array($result)){
$Tag = $row['Tag'];
$Video_url = $row['Video_url'];
$Number = $row['Number'];
$result2 = mysqli_query($conn, "SELECT Url FROM video WHERE Src = '$Video_url'");
while($row = mysqli_fetch_array($result2)){
$Url = $row['Url'];
echo '<form method = "post" action = "'. $Action .'">' .$Number .'. <a href ="' .'../'.$Url .'">'. $Tag. '</a><input type="checkbox" value="Accept" name ="' .$Number .'"><br />';
}
}
echo '<input name ="approval" type ="submit" value="Accept" /></form>';
include 'files/closedb.php';
}
?>
<?php
if(isset($_POST['view_accepted']))
{
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Tag, Video_url, Number FROM video_tags WHERE Pending = 0 ORDER BY Number ASC");
while($row = mysqli_fetch_array($result)){
$Tag = $row['Tag'];
$Video_url2 = $row['Video_url'];
$Number = $row['Number'];
$result3 = mysqli_query($conn, "SELECT Url FROM video WHERE Src = '$Video_url2'");
while($row = mysqli_fetch_array($result3)){
$Url = $row['Url'];
echo $Number .'. <a href ="' .'../'.$Url .'">'. $Tag. '</a><br />';
}
}
include 'files/closedb.php';
}
?>
<?php
if(isset($_POST['approval']))
{
$result = mysqli_query($conn, "SELECT Tag, video_url, Number FROM video_tags WHERE Pending = 1 ORDER BY Number DESC");
while($row = mysqli_fetch_array($result)){
$Number = $row['Number'];
if (empty($_POST[$Number]))
{
}
else{
$Tag = $row['Tag'];
$Video_url = $row['video_url'];
$update = "UPDATE video_tags SET Pending = 0 WHERE Number = '$Number'";
mysqli_query($conn, $update);
$result4 = mysqli_query($conn, "SELECT Url FROM video WHERE Src = '$Video_url'");
while($row = mysqli_fetch_array($result4)){
$Url = $row['Url'];
echo $Number .'. <a href ="' .'../'.$Url .'">'. $Tag. '</a> Has been approved.<br />';
}
}
}
}
?>
<?php
if(isset($_POST['delete']))
{
include '../../opendb_gigi.php';
$delete = $_POST['Delete'];
$delete1 = "DELETE FROM video_tags WHERE Number=('$delete')";
mysqli_query($conn, $delete1);
echo $delete .' has been deleted.';
include 'files/closedb.php';
}
?>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>