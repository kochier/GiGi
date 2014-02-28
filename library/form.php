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
<p>Created Date (YYYY-MM-DD):<br />
<input type ="text" name="Created" size="30" /><br />
Name (End Of World):<br />
<input type ="text" name="Name" size="30" /><br />
Pathname (mayan.php):<br />
<input type ="text" name="Pathname" size="30" /><br />
Map Number (666):<br />
<input type ="text" name="Map" size="30" /><br />
Child Number (981):<br />
<input type ="text" name="Child" size="30" /><br />
Parent Number (222):<br />
<input type ="text" name="Parent" size="30" /><br />
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
Pathname to Delete(mayan.php):<br />
<input type ="text" name="Delete" size="30" /><br />
<input name = "delete" type ="submit" value="Delete" /><br />
</p>
</form>
<br />
<br />
<div class = "center">
<?php
if(isset($_POST['update']))
{
include '../../opendb_gigi.php';
$Created = $_POST['Created'];
$Name = $_POST['Name'];
$Pathname = $_POST['Pathname'];
$Map = $_POST['Map'];
$Child = $_POST['Child'];
$Parent = $_POST['Parent'];
if ($Map == null or $Pathname == null or $Name ==null or $Created ==null or $Child ==null or $Parent ==null)
{
die ('No Data value added');
}
else
{
$insert = ("INSERT INTO map (Created, Name, Pathname, Map, Child, Parent) VALUES ('$Created', '$Name', '$Pathname', '$Map' , '$Child' , '$Parent')");
mysqli_query($conn, $insert);
echo $Pathname .' was updated to have a map value of: <strong>' .$Map .'</strong>, a child value of: <strong>' .$Child .'</strong>, a parent value of: <strong>' .$Parent .'</strong> and a name of <strong>' .$Name .'</strong>. The creation date is: <strong>' .$Created .'</strong>.';
include 'files/closedb.php';
}
}
echo '<br />';
if(isset($_POST['delete']))
{
include '../../opendb_gigi.php';
$delete = $_POST['Delete'];
$delete1 = "DELETE FROM map WHERE Pathname=('$delete')";
mysqli_query($conn, $delete1);
include 'files/rss.php';
echo $delete;
echo ' has been removed from the database.';
include 'files/closedb.php';
}
if(isset($_POST['view']))
{
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Created, Pathname, Name, Map, Child, Parent FROM map ORDER BY Map ASC");
while($row = mysqli_fetch_array($result)){
	echo $row['Pathname'] ." has a map value of: <strong>" .$row['Map'] ."</strong>, a child value of: <strong>" .$row['Child'] ."</strong>, a parent value of: <strong>" .$row['Parent'] ."</strong> and a name of <strong>" .$row['Name'] ."</strong>. The creation date is: <strong>" .$row['Created'] ."</strong>.<br />";
}
include 'files/closedb.php';
}
?>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>