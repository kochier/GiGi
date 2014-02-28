<?php
include '../opendb_gigi.php';
echo '<h4>Recent Video Tags</h4>';
$result = mysqli_query($conn, "SELECT Tag, Video_url FROM video_tags WHERE Pending = 0 ORDER BY Number DESC LIMIT 5");
echo '<ul>';
while($row = mysqli_fetch_assoc($result)){
$Video_url = $row['Video_url'];
$Tag = $row['Tag'];
$result2 = mysqli_query($conn, "SELECT Url FROM video WHERE Src = '$Video_url'");
while($row = mysqli_fetch_assoc($result2)){
$Url = $row['Url'];
$result3 = mysqli_query($conn, "SELECT Name FROM map WHERE Pathname = '$Url'");
while($row = mysqli_fetch_assoc($result3)){
$Name = $row['Name'];
$link = '/search_image_tags.php?search_string=' .$Tag;
echo '<li><a href ="' .$Url .'">' .$Name .'</a> has been tagged: <a href ="' .$link .'">' .$Tag .'</a></li>';
}
}
}
echo '</ul>';
?>
Search video tags:
<form style="display: inline;" method="get" action="search_video_tags.php">
<input type ="text" name="search_string" size="30" />
<input name ="search" type ="submit" value="Search" /><br />
</form>