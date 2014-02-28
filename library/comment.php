<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
<input name = "view" type ="submit" value="View Tables" /><br /><br />
</p>
</form>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
Comment to Delete (By ID Number):<br />
<input type ="text" name="Delete" size="30" /><br />
<input name = "delete" type ="submit" value="Delete" /><br />
</p>
</form>
<div class = "center">
<?php
if(isset($_POST['view']))
{
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Pname, Comment, Url, Number FROM comment ORDER BY Number ASC");
while($row = mysqli_fetch_array($result)){
echo $row['Number'] .'. '. $row['Pname'].': ' .$row['Comment']. ' In :'. $row['Url'].".<br />";
}
include 'files/closedb.php';
}
?>
<?php
if(isset($_POST['delete']))
{
include '../../opendb_gigi.php';
$delete = $_POST['Delete'];
$delete1 = "DELETE FROM comment WHERE Number=('$delete')";
mysqli_query($conn, $delete1);
echo $delete .' has been deleted.';
include 'files/closedb.php';
}
?>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>