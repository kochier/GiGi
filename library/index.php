<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class ="inno">
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
if(isset($_POST['update']))
{
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$Created = date('Y-m-d');
$Name = $_POST['Name'];
$Name = htmlspecialchars($Name, ENT_QUOTES);
$result3 = mysqli_query($conn, "SELECT Map FROM map");
$total = mysqli_num_rows($result3) -1;
$Pathname = preg_replace("/[^a-zA-Z0-9]/", "", $Name);
$Pathname = substr($Pathname,0,15);
$Pathname = $Pathname .$total.".php";
$Pathname = strtolower($Pathname);
$Map = $_POST['Map'];
$Child = '0';
$result = mysqli_query($conn, "SELECT Map FROM map WHERE Child = '$Map'")  or die(mysql_error());
while($row = mysqli_fetch_array($result)){
$Parent = $row['Map'];
}
if ($Map =='23')
{
$Pathname = 'library/' .$Pathname;
}
if ($Map =='24')
{
$Pathname = 'library/drafts/' .$Pathname;
}
$Conten = $_POST['Conten'];
{
if ($Map == null or $Pathname == null or $Name ==null or $Created ==null or $Conten ==null)
{
die ('No Data value added');
}
else
{
$insert = ("INSERT INTO map (Created, Name, Pathname, Map, Child, Parent) 
VALUES ('$Created', '$Name', '$Pathname', '$Map', '$Child', '$Parent')");
mysqli_query($conn, $insert);
$Conten2 = htmlspecialchars($Conten, ENT_QUOTES);
$Conten2 = stripslashes($Conten2);
$original = array("<img src =\"", "\" alt =\"", "\" title =\"", "\" width =\"", "\" height =\"", "\"/>", "<p>", "</p>", "<br />", "<strong>", "</strong>", "<em>", "</em>", "<ol>", "</ol>", "<li>", "</li>", "<h3>", "</h3>", "<h4>", "</h4>", "<ul>", "</ul>", "<a href =\"", "\">", "</a>", "<div class = 'center'>", "</div>");
$new = array("[IMG]", "[ALT]", "[TITLE]", "[WIDTH]", "[HEIGHT]", "[/IMG]", "[PARA]", "[/PARA]", "[BR /]", "[BOLD]", "[/BOLD]", "[ITAL]", "[/ITAL]", "[OL]", "[/OL]", "[LI]", "[/LI]", "[H3]", "[/H3]", "[H4]", "[/H4]", "[UL]", "[/UL]", "[LINK]", "[1]", "[/LINK]", "[CENTER]", "[/ENDD]");
$Conten2 = str_replace($new, $original, $Conten2);
$fname = 'files/template.php';
$fhandle = fopen($fname,"r");
$content = fread($fhandle,filesize($fname));
$content = str_replace("CONTENT", $Conten2, $content);
$fhandle = fopen( '../' .$Pathname,"w");
fwrite($fhandle,$content);
fclose($fhandle);
include 'files/closedb.php';
echo '<a href ="' .'../'.$Pathname .'">'. $Name. '</a> has been created.';
include 'files/rss.php';
}
}
}
?>
<form method = "post" id = "form" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>Title:<br />
<input type ="text" name="Name" size="30" /><br />
Category:<br />
<select name="Map">
<?php
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Name, Child, Map FROM map WHERE Child > '0' ORDER BY Map ASC") or die(mysql_error());
while($row = mysqli_fetch_array($result)){
$Child = $row['Child'];
$Name = $row['Name'];
$Map = $row['Map'];
if ($Map == 0 or $Name =='Drafts')
{
echo '<option value="' .$Child .'">' .$Name .'</option>';
}
else
{
$result3 = mysqli_query($conn, "SELECT Pathname, Name FROM map WHERE Child = $Map") or die(mysql_error());
while($row = mysqli_fetch_array($result3)){
$Pathname = $row['Pathname'];
$Name2 = $row['Name'];
}
if ($Pathname =='blog.php' or $Pathname == 'news.php')
{
echo '<option value="' .$Child .'">' .$Name2 .'-' .$Name .'</option>';
}
else
{
echo '<option value="' .$Child .'">' .$Name .'</option>';
}
}

}
include 'files/closedb.php';
?>
</select>
<br />
Content Goes Here:<br />
<textarea name="Conten" rows="15" cols = "60"></textarea><br />
<input name ="update" title = "Update Site" type ="submit" value="Create" /><br />
</p>
</form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>