<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<script type="text/javascript">
<!--
function confirmPost()
{
var agree=confirm("Are you sure you want to delete?");
if (agree)
return true ;
else
return false ;
}
// -->
</script>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>Text:<br />
<input type ="text" name="Title" size="30" /><br />
Src:<br />
<input type ="text" name="Src" size="30" /><br />
Url:<br />
<input type ="text" name="Url" size="30" /><br />
<input name ="update" type ="submit" value="Update" /><br />
</p>
</form>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
<input name = "view" type ="submit" value="View Tables" /><br /><br />
</p>
</form>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
Image to Delete(src):<br />
<input type ="text" name="Delete" size="30" /><br />
<input name = "delete" type ="submit" value="Delete" /><br />
</p>
</form>
<div class = "center">
<?php
if(isset($_POST['update']))
{
include '../../opendb_gigi.php'; 
$Title = $_POST['Title'];
$Src = $_POST['Src'];;
$Url = $_POST['Url'];
{
if ($Title == null or $Src ==null or $Url ==null)
{
die ('No Data value added');
}
else
{
$insert = ("INSERT INTO images (Title, Src, Url) VALUES ('$Title', '$Src', '$Url')");
mysqli_query($conn, $insert);
echo '"' .$Title .' ' .$Src .' ' .$Url .'" has been added to the database';
include 'closedb.php';
}
}
}
echo '<br />';
?>
<?php
if(isset($_POST['view']))
{
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT * FROM images ORDER BY Src ASC");
while($row = mysqli_fetch_array($result)){
	echo $row['Title'];
echo " ";
	echo $row['Src'];
echo " ";
	echo $row['Url'];
	echo "<br />";
}
include 'files/closedb.php';
}
?>
<?php
if(isset($_POST['delete']))
{
include '../../opendb_gigi.php';
$delete = $_POST['Delete'];
$delete1 = "DELETE FROM images WHERE Src=('$delete')";
mysqli_query($conn, $delete1);
echo $delete;
echo ' has been deleted.';
include 'files/closedb.php';
}
?>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>