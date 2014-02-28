<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<form method = "post" enctype="multipart/form-data" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>Select A File:<br />
<input type="file" name="user_file" size="60" /><br />
Gallery:<br />
<select name="Map">
<?php
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Name, Child FROM map WHERE Map = '50' ORDER BY Name ASC");
while($row = mysqli_fetch_array($result)){
$Child = $row['Child'];
$Name = $row['Name'];
echo '<option value="' .$Child .'">' .$Name .'</option>';
}
include 'files/closedb.php';
?>
</select>
<br />
Name:<br />
<input type ="text" name="Title" size="30" /><br />
Comment:<br />
<textarea name="Comment" rows="15" cols = "60"></textarea><br />
<input name ="update" type ="submit" value="Update" /><br />
</p>
</form>
<div class = "center">
<?php
if(isset($_POST['update']))
{
include '../../opendb_gigi.php';
$Title = $_POST['Title'];
$Src = $_FILES['user_file']['name'];
$Width = '500';
$Height = '400';
$Comment = $_POST['Comment'];
$Map = $_POST['Map'];
$result3 = mysqli_query($conn, "SELECT Pathname FROM map");
$total = mysqli_num_rows($result3) -1;
$Url = preg_replace("/[^a-zA-Z0-9]/", "", $Title);
$Url = substr($Url,0,15);
$Url = $Url .$total.".php";
$Url = strtolower($Url);
$result = mysqli_query($conn, "SELECT Src FROM video");
while($row = mysqli_fetch_array($result)){
$Src2 = $row['Src'];
if ($Src == $Src2)
{
echo 'The filename already exists.';
die ();
}
}
$type = $_FILES['user_file']['type'];
if ($type == 'video/webm')
{
$path = '../videos/' .$Src;
$tmp_name = $_FILES["user_file"]["tmp_name"];
move_uploaded_file($tmp_name, $path);
if ($Title == null or $Src ==null or $Url ==null)
{
echo 'Missing critical values.';
}
else
{
$insert = ("INSERT INTO video (Name, Src, Url) VALUES ('$Title', '$Src', '$Url')");
mysqli_query($conn, $insert);
$Created = date('Y-m-d');
$Name = $Title;
$result3 = mysqli_query("SELECT Pathname FROM map");
$total = mysqli_num_rows($result3) -1;
$Pathname = $Url;
$Comment = htmlspecialchars($Comment, ENT_QUOTES);
$Comment = stripslashes($Comment);
$Text = htmlspecialchars($Text, ENT_QUOTES);
$Text = stripslashes($Text);
$Name = htmlspecialchars($Name, ENT_QUOTES);
$Name = stripslashes($Name);
$Parent = 50;
$Child = 0;
$Conten2 = '<video width="500" height="400" controls="controls"> <source src="' .$path .'" type="video/webm" /> <source src="' .$path .'" type="video/mp4" />Your browser does not support the HTML5 video codec this video is encoded in. You can still download the video <a href="' .$path .'">here(.webm)</a> or <a href="' .$path .'">here(.mp4)</a> and play it on your computer. Otherwise please update your browser to the latest version.</video>';
if ($Map == null or $Pathname == null or $Name ==null or $Created ==null)
{
die ('No Data value added');
}
else
{
$insert = ("INSERT INTO map (Created, Name, Pathname, Map, Parent, Child) VALUES ('$Created', '$Name', '$Pathname', '$Map', '$Parent', '$Child')");
mysqli_query($conn, $insert);
echo '<a href ="' .'../'.$Pathname .'">'. $Name. '</a> has been created.';
include 'files/rss.php';
$fname = 'files/template.php';
$fhandle = fopen($fname,"r");
$content = fread($fhandle,filesize($fname));
$content = str_replace("CONTENT", $Conten2, $content);
$fhandle = fopen( '../' .$Pathname,"w");
fwrite($fhandle,$content);
fclose($fhandle);
include 'files/closedb.php';
}
}
}
else
{
echo 'Not a valid video type.';
}
}
echo '<br />';
?>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>