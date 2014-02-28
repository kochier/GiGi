<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<?php
if(isset($_POST['Files']))
{
$Path = 'style.css';
$fname = '../' .$Path;
echo 'Now editing: <a href ="../style.css">Stylesheet</a>';
$fhandle = fopen($fname,"r");
$content2 = fread($fhandle,filesize($fname));
}
if(isset($_POST['edit']))
{
$content2 = $_POST['Conten'];
$Path3 = 'style.css';
$fname = '../' .$Path3;
$fhandle = fopen($fname,"w");
fwrite($fhandle,$content2);
fclose($fhandle);
$content = '';
$content2 = '';
echo '<a href ="../style.css">Stylesheet</a> has been edited.';
}
?>
<form method = "post" id = "form" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
<?php
if(isset($_POST['Files']))
{
}
else
{
echo '<select name="Files">';
echo '<option value="style.css">Stylesheet</option>';
}
?>
</select>
<?php
if(isset($_POST['Files']))
{
}
else
{
echo '<input name ="files" title = "Select Edit Page" type ="submit" value="Select" /><br />';
}
?>
<textarea name="Conten" rows="15" cols = "60"><?php echo $content2;?></textarea><br />
<?php
if(isset($_POST['Files']))
{
echo '<input name ="edit" title = "Edit Page" type ="submit" value="Edit" /><input name ="cancel" title = "Cancel Edit" type ="submit" value="Cancel" /><br />';
}
else
{
echo '<input name ="edit" disabled="disabled" title = "Edit Page" type ="submit" value="Edit" /><input name ="cancel" disabled="disabled" title = "Cancel Edit" type ="submit" value="Cancel" /><br />';
}
?>
</p>
</form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>