<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
Pathname to Delete(mayan.php):<br />
<input type ="text" name="Delete" size="30" /><br />
<input name = "delete" type ="submit" value="Delete" /><br />
</p>
</form>
<?php
if(isset($_POST['delete']))
{
include '../../opendb_gigi.php';
$delete = $_POST['Delete'];
$delete2 = 'library/drafts/' .$delete;
$result = mysqli_query ($conn, "SELECT Map FROM map Where Pathname = '$delete2'");
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
if ($Map <> 24)
{
echo 'The file you are trying to delete either does not exist or is not a draft. Be sure <em>not</em> to include the "library/drafts/" in the path and make sure it is a draft file you are trying to remove.';
break;
}
else
{
$delete1 = "DELETE FROM map WHERE Pathname=('$delete2')";
mysqli_query($delete1);
$delete3 = $_SERVER['DOCUMENT_ROOT'] .'/' .$delete2;
unlink($delete3);
echo $delete;
echo ' has been deleted.';
}
}
include 'files/closedb.php';
}
?>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>