<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>Pathname (index.php):<br />
<input type ="text" name="Pathname" size="30" /><br />
Map (1):<br />
<input type ="text" name="Map" size="30" /><br />
Child(ren) (2):<br />
<input type ="text" name="Child" size="30" /><br />
Parent (0):<br />
<input type ="text" name="Parent" size="30" /><br />
<input name ="update" type ="submit" value="Update" /><br />
</p>
</form>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
<input name = "view" type ="submit" value="View Tables" /><br /><br />
</p>
</form>
<?php
if(isset($_POST['update']))
{
include '../../opendb_gigi.php';
$Pathname = $_POST['Pathname'];
$Map = $_POST['Map'];
$Child = $_POST['Child'];
$Parent = $_POST['Parent'];
if ($Map == null)
{
die ('No map value added.');
}
if ($Pathname == null)
{
die ('No pathname value chosen.');
}
else
{
$update = "UPDATE map SET Map = '$Map', Child = '$Child', Parent = '$Parent' WHERE Pathname = '$Pathname'";
mysqli_query($conn, $update);
echo $Pathname .' was updated to have a map value of: <strong>' .$Map .'</strong>, a child value of: <strong>' .$Child .'</strong>, and a parent value of: <strong>' .$Parent .'</strong>.';
}
}
?>
<?php
if(isset($_POST['view']))
{
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Pathname, Name, Map, Child, Parent FROM map ORDER BY Map ASC");
while($row = mysqli_fetch_array($result)){
	echo $row['Name'] ."(" .$row['Pathname'] .") - <strong>Map: </strong>" .$row['Map'] ." <strong>Child: </strong> " .$row['Child'] ." <strong>Parent: </strong> " .$row['Parent'] ."<br />";
}
include 'files/closedb.php';
}
?>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>