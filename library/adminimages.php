<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class = "inno">
<form method = "post" enctype="multipart/form-data" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<p>Select A File:<br />
<input type="file" name="user_file" size="60" /><br />
Gallery:<br />
<select name="Map">
<?php
include '../../opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Name, Child FROM map WHERE Map = '40' ORDER BY Name ASC");
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
Additional Text:<br />
<input type ="text" name="Text" size="30" /><br />
Width:<br />
<input type ="text" name="Width" size="30" /><br />
Height:<br />
<input type ="text" name="Height" size="30" /><br />
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
$Title = htmlspecialchars($Title, ENT_QUOTES);
$Src = $_FILES['user_file']['name'];
$Text = $_POST['Text'];
$Width = $_POST['Width'];
$Height = $_POST['Height'];
$Comment = $_POST['Comment'];
$Map = $_POST['Map'];
$result3 = mysqli_query($conn, "SELECT Pathname FROM map");
$total = mysqli_num_rows($result3) -1;
$Url = preg_replace("/[^a-zA-Z0-9]/", "", $Title);
$Url = substr($Url,0,15);
$Url = $Url .$total.".php";
$Url = strtolower($Url);
$result = mysqli_query($conn, "SELECT Src FROM images");
while($row = mysqli_fetch_array($result)){
$Src2 = $row['Src'];
if ($Src == $Src2)
{
die ('The filename already exists.');
}
}
$type = $_FILES['user_file']['type'];
if ($type == 'image/jpeg' or $type == 'image/gif' or $type == 'image/png')
{
$path = '../images/' .$Src;
$path2 = '../thumbnails/thumb' .$Src;
$tmp_name = $_FILES["user_file"]["tmp_name"];
move_uploaded_file($tmp_name, $path);
list($width2, $height2) = getimagesize($path);
$new_width = 125;
$new_height = 125;
$image_p = imagecreatetruecolor($new_width, $new_height);
if ($type == 'image/jpeg')
{
$image = imagecreatefromjpeg($path);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width2, $height2);
imagejpeg($image_p,$path2,100);
}
elseif ($type == 'image/png')
{
$image = imagecreatefrompng($path);
imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width2, $height2);
imagejpeg($image_p,$path2,100);
}
if ($Title == null or $Text ==null or $Src ==null or $Width ==null or $Height ==null or $Url ==null)
{
echo 'Missing critical values.';
}
else
{
$insert = ("INSERT INTO images (Title, Src, Url) VALUES ('$Title', '$Src', '$Url')");
mysqli_query($conn, $insert);
$Created = date('Y-m-d');
$Name = $Title;
$result3 = mysqli_query($conn, "SELECT Pathname FROM map");
$total = mysqli_num_rows($result3) -1;
$Pathname = $Url;
$Comment = htmlspecialchars($Comment, ENT_QUOTES);
$Comment = stripslashes($Comment);
$Text = htmlspecialchars($Text, ENT_QUOTES);
$Text = stripslashes($Text);
$Name = stripslashes($Name);
$Parent = 40;
$Child = 0;
$Conten2 = '<a href ="' .$path .'"><img src ="' .$path .'" title =" ' .$Text .'" alt ="'. $Name .'" width ="' .$Width .'" height ="'.$Height .'"/></a><p>' .$Comment .'</p>';
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
echo 'Not a valid image type.';
}
}
echo '<br />';
?>
</div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>