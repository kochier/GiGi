<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>Question:<br />
<input type ="text" name="Question" size="30" /><br />
<br />
<p>Answer:<br />
<input type ="text" name="Answer" size="30" /><br />
<br />
<input name ="update" type ="submit" value="Update Captcha" /><br />
</p>
</form>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
<input name = "view" type ="submit" value="View Tables" /><br /><br />
</p>
</form>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
Question to Delete (By ID Number):<br />
<input type ="text" name="Delete" size="30" /><br />
<input name = "delete" type ="submit" value="Delete" /><br />
</p>
</form>
<div class = "center">
<?php
if(isset($_POST['update']))
{
include '../../opendb_gigi.php';
$Question = $_POST['Question'];
$Question = htmlspecialchars($Question, ENT_QUOTES);
$Question = stripslashes($Question);
$Answer = $_POST['Answer'];
$Answer = htmlspecialchars($Answer, ENT_QUOTES);
$Answer = stripslashes($Answer);
{
if ($Question ==null or $Answer ==null)
{
die ('Missing values.');
}
else
{
$insert = ("INSERT INTO captchas (Question, Answer) VALUES ('$Question', '$Answer')");
mysqli_query($conn, $insert);
echo '"' .$Question .'" has been added to the database with an answer of '. $Answer;
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
$result = mysqli_query($conn, "SELECT Question, Answer, Number FROM captchas ORDER BY Number ASC");
while($row = mysqli_fetch_array($result)){
	echo $row['Number'] .'. '. $row['Question'].' ' .$row['Answer'].".<br />";
}
include 'files/closedb.php';
}
?>
<?php
if(isset($_POST['delete']))
{
include '../../opendb_gigi.php'; 
$delete = $_POST['Delete'];
$delete1 = "DELETE FROM captchas WHERE Number=('$delete')";
mysqli_query($conn, $delete1);
echo $delete .' has been deleted.';
include 'files/closedb.php';
}
?>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>