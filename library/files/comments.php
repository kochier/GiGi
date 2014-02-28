<?php
$path2 = $_SERVER["PHP_SELF"];
$path2 = substr($path2, 1);
if ($path2 == 'index.php' or $path2 =='sitemap.php' or $path2 =='contact.php' or $path2 =='404.php' or $path2 =='403.php' or $path2 =='401.php')
{
}
else
{
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Pname FROM comment WHERE Url = '$path2'");
$total = 0;
while($row = mysqli_fetch_array($result)){
$total = mysqli_num_rows($result);
}
echo '<h3><a ID ="comments">('.$total .') Comments:</a></h3>';
if(isset($_POST['comment']))
{
$Pname = $_POST['Name']; 
$Question2 = $_POST['Question'];
$Comment = $_POST['Comment'];
//$Captcha = $_POST['Captcha']; //commented out to disable captcha
$Pname = substr($Pname,0,30);
$Question2 = substr($Question2,0,250);
$Comment = substr($Comment,0,2500);
//$Captcha = substr($Captcha,0,250);
$Pname = htmlspecialchars($Pname, ENT_QUOTES);
$Pname = stripslashes($Pname);
$Question2 = htmlspecialchars($Question2, ENT_QUOTES);
$Question2 = stripslashes($Question2);
$Comment = htmlspecialchars($Comment, ENT_QUOTES);
$Comment = stripslashes($Comment);
//$Captcha = htmlspecialchars($Captcha, ENT_QUOTES);
//$Captcha = stripslashes($Captcha);
$result3 = mysqli_query($conn, "SELECT Answer, Question FROM captchas WHERE Question = '$Question2'");
while($row = mysqli_fetch_array($result3)){
$Question3 = $row['Question'];
if ($Question3 == null)
{
echo 'You seem to have tried editing a bot catching field that is usually hidden by CSS, if you would like to try to post again don\'t alter the text area that contains the captcha question.';
}
else
{
$Answer = $row['Answer'];
$Captcha = $row['Answer']; //comment out this line if I want to re-enable captcha
}
if ($Pname == null and $Comment == null)
{
echo "<p>You didn't leave a valid name and comment, so nothing was saved.</p>";
}
elseif ($Comment == null)
{
echo "<p>You didn't leave a valid comment, so nothing was saved.</p>";
}
elseif ($Pname == null)
{
echo "<p>You didn't leave a valid name, so nothing was saved.</p>";
}

elseif ($Answer != $Captcha)
{
echo '<p>I\'m sorry but you failed to answer the question correctly and your comment was not saved.</p>';
}
else
{
$Created = date('Y-m-d H:i:s');
$insert = ("INSERT INTO comment (Pname, Comment, Url, Created) 
VALUES ('$Pname', '$Comment', '$path2', '$Created')");
mysqli_query($conn, $insert);
echo 'Your comment has been saved.';
}
}
}
$path_parts = pathinfo(($_SERVER["SCRIPT_FILENAME"]));
$path = $path_parts['basename'];
$result = mysqli_query($conn, "SELECT Pname, Comment, Created FROM comment WHERE URL = '$path' ORDER BY Created ASC");
while($row = mysqli_fetch_array($result)){
echo "<h4>" .$row['Pname']. ' - '. $row['Created'] .":</h4><p>" .$row['Comment'] ."</p><br />";
}
echo '<div class ="inno">';
echo '<form method = "post" id = "comment" action = "'.$_SERVER['PHP_SELF'].'">';
$result = mysqli_query($conn, "SELECT Question FROM captchas ORDER BY RAND() LIMIT 1");
while($row = mysqli_fetch_array($result)){
$Question = $row['Question'];
echo '<textarea class = "files" name="Question" rows="1" cols = "1">' .$Question .'</textarea><br />';
}
echo '<p>Name (30 Characters or less):<br /><input type ="text" name="Name" size="30" /><br /><br />Comment (2500 Characters or less):<br /><textarea name="Comment" rows="15" cols = "60"></textarea><br /><br /> <input name ="comment" title = "Comment On This Page" type ="submit" value="Comment" /><br /></p></form></div>'; //use this echo statement if captcha is disabled
//echo '<p>Name (30 Characters or less):<br /><input type ="text" name="Name" size="30" /><br /><br />Comment (2500 Characters or less):<br /><textarea name="Comment" rows="15" cols = "60"></textarea><br /><br />'.$Question.' <input type ="text" name="Captcha" size="30" /> <input name ="comment" title = "Comment On This Page" type ="submit" value="Comment" /><br /></p></form></div>'; //use this echo statement if captcha is enabled
include $doc_root .'/library/files/closedb.php';
}
?>