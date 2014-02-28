<?php
session_start();
$content2 = '';
include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<script type="text/javascript" src="files/buttons.js"></script>
<input type="button" onclick="surroundText('[PARA]' ,'[/PARA]' , document.getElementById('form').Conten)" value="Paragraph" name="paragraph" title="Add Paragraph" />
<input type="button" onclick="surroundText('' ,'[BR /]' , document.getElementById('form').Conten)" value="Line Break" name="linebreak" title="Add Line Break" />
<input type="button" onclick="surroundText('[BOLD]' ,'[/BOLD]' , document.getElementById('form').Conten)" value="Bold" name="bold" title="Bold Text" />
<input type="button" onclick="surroundText('[ITAL]' ,'[/ITAL]' , document.getElementById('form').Conten)" value="Italics" name="italics" title="Italic Text" />
<input type="button" onclick="surroundText('[UL]\n[LI]' ,'[/LI]\n[/UL]' , document.getElementById('form').Conten)" value="Unordered List" name="unordered" title="Unordered List" />
<input type="button" onclick="surroundText('[OL]\n[LI]' ,'[/LI]\n[/OL]' , document.getElementById('form').Conten)" value="Ordered List" name="ordered" title="Ordered List" />
<br />
<input type="button" onclick="surroundText('[LI]' ,'[/LI]' , document.getElementById('form').Conten)" value="List Item" name="list" title="List Item" />
<input type="button" onclick="surroundText('[IMG][ALT][TITLE][WIDTH][HEIGHT]' ,'[/IMG]' , document.getElementById('form').Conten)" value="Image" name="image" title="Image" />
<input type="button" onclick="surroundText('[LINK][1][IMG][ALT][TITLE][WIDTH][HEIGHT]' ,'[/IMG][/LINK]' , document.getElementById('form').Conten)" value="Image link" name="imagelink" title="Image Link" />
<input type="button" onclick="surroundText('[H3]' ,'[/H3]' , document.getElementById('form').Conten)" value="H3" name="H3" title="Headline 3" />
<input type="button" onclick="surroundText('[H4]' ,'[/H4]' , document.getElementById('form').Conten)" value="H4" name="H4" title="Headline 4" />
<input type="button" onclick="surroundText('[CENTER]' ,'[/ENDD]' , document.getElementById('form').Conten)" value="Center" name="center" title="Center Text" />
<input type="button" onclick="surroundText('[LINK]' ,'[1]Link[/LINK]' , document.getElementById('form').Conten)" value="Link" name="link" title="Insert Link" /><p><a href ="codes.php">Click here</a> to view the formatting codes if you have javascript disabled.</p>
<?php
$alpha = "<?php include \$_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>";
$omega = "<?php include \$_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>";
$original = array($alpha, $omega, "<img src =\"", "\" alt =\"", "\" title =\"", "\" width =\"", "\" height =\"", "\"/>", "<p>", "</p>", "<br />", "<strong>", "</strong>", "<em>", "</em>", "<ol>", "</ol>", "<li>", "</li>", "<h3>", "</h3>", "<h4>", "</h4>", "<ul>", "</ul>", "<a href =\"", "\">", "</a>", "<div class= 'center'>", "</div>");
$new = array("", "", "[IMG]", "[ALT]", "[TITLE]", "[WIDTH]", "[HEIGHT]", "[/IMG]", "[PARA]", "[/PARA]", "[BR /]", "[BOLD]", "[/BOLD]", "[ITAL]", "[/ITAL]", "[OL]", "[/OL]", "[LI]", "[/LI]", "[H3]", "[/H3]", "[H4]", "[/H4]", "[UL]", "[/UL]", "[LINK]", "[1]", "[/LINK]", "[CENTER]", "[/ENDD]");
if(isset($_POST['Files']))
{
$_SESSION['Path'] = $_POST['Files'];
$Path = $_SESSION['Path'];
$fname = '../' .$Path;
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Name, Pathname FROM map WHERE Pathname = '$Path'");
while($row = mysqli_fetch_array($result)){
echo 'Now editing: ' .'<a href ="../' .$row['Pathname'] .'">' .$row['Name'] .'</a>';
}
include 'files/closedb.php';
$fhandle = fopen($fname,"r");
$content = fread($fhandle,filesize($fname));
$content2 = str_replace($original, $new, $content);
}
if(isset($_POST['edit']))
{
$content2 = $_POST['Conten'];
$Path3 = $_SESSION['Path'];
$content2 = htmlspecialchars($content2, ENT_QUOTES);
$content2 = stripslashes($content2);
$content2 = str_replace($new, $original, $content2);
include '../../opendb_gigi.php';
$result23 = mysqli_query($conn, "SELECT Map FROM map WHERE Pathname = '$Path3'");
while($row = mysqli_fetch_array($result23)){
$Map = $row['Map'];
$content2 = $alpha .$content2 .$omega;
}
if ($Path3 == 'index.php')
{
echo "You can't edit that page.";
}
else
{
$fname = '../' .$Path3;
$fhandle = fopen($fname,"w");
fwrite($fhandle,$content2);
fclose($fhandle);
$content = '';
$content2 = '';
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Name FROM map WHERE Pathname = '$Path3'");
while($row = mysqli_fetch_array($result)){
$Name = $row['Name'];
}
$result = mysqli_query($conn, "SELECT Pathname FROM map");
while($row = mysqli_fetch_assoc($result)){
$list = $row['Pathname'];
$fmtime = filemtime("../" .$list);
$flist[$list] = $fmtime;
$update = "UPDATE map SET Modified = '$fmtime' WHERE Pathname = '$list'";
mysqli_query($conn, $update);
}
echo '<a href ="' .$fname .'">' .$Name .'</a>' ." has been edited.";
}
include 'files/closedb.php';
}
?>
<form method = "post" id = "form" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>
<?php
include '../../opendb_gigi.php';
if(isset($_POST['Files']))
{
}
else
{
echo '<select name="Files">';
$result = mysqli_query($conn, "SELECT Name, Pathname, Map FROM map ORDER BY Name ASC");
while($row = mysqli_fetch_array($result)){
$Name = $row['Name'];
$Map = $row['Map'];
$Pathname = $row['Pathname'];
if ($Pathname == 'index.php' or $Pathname == 'sitemap.php' or $Pathname == 'contact.php' or $Map == '22' or $Map == '23')
{
}
else
{
echo '<option value="'.$Pathname .'">'.$Name .'</option>';
}
}
}
include 'files/closedb.php';
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
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';
if(isset($_POST['edit']))
{
$_SESSION = array();
session_destroy();
}
?>