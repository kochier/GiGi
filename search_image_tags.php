<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<form method = "get" action = "<?php echo $_SERVER['PHP_SELF'];?>">
Image Search:<br />
<input type ="text" name="search_string" size="30" />
<input name ="search" type ="submit" value="Search" /> Seperate tags by a (,) comma, (&amp;) ampersand, or (+) plus sign.<br />
</form>
<?php
if(isset($_GET['search_string']))
{
$Search = $_GET['search_string'];
$Search = htmlspecialchars($Search);
$Search = stripslashes($Search);
$word_count = str_word_count($Search, 0);
$Tag = preg_split("/[,+&]+/", $Search, 0, PREG_SPLIT_NO_EMPTY);
$Check = preg_match("/[,+&]+/", $Search);
if ($Check == false)
{
}
$search_or = '';
$array_tags[] = '';
$count_or = 0;
$count_and = 0;
$count_word = 0;
$and_array = array();
$and_sql = null;
if ($word_count > 1)
{
foreach($Tag as &$tag) {
$tag = trim($tag);
$tag = ucfirst(strtolower($tag));
$tag = htmlspecialchars($tag, ENT_QUOTES);
$and_array[] = "tag_group.tags like binary '%{$tag}%'";
}
$tag_sql1 = implode("','", $Tag);
if(count($and_array)) {
$and_sql = ' and ' . implode(' and ', $and_array);
}
$sql = "select distinct Image_url from image_tags inner join (select Image_url, GROUP_CONCAT(DISTINCT Tag SEPARATOR ' ') as tags from image_tags group by Image_url) as tag_group using (Image_url) where 1=1 {$and_sql}";
$result0 = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result0)){
$Image_url = $row['Image_url'];
$array_tags[] = $Image_url;
}
$count_and = count($array_tags) -1;
$search_and = preg_replace("[',']", "\" and \"", $tag_sql1);
if ($count_and == 0 or $Check == false)
{
}
else
{
echo '<h4><strong>(' .$count_and .')</strong> Results for tags: "'. $search_and .'":</h4><br />';
foreach ($array_tags as $Image_url2)
{
$result4 = mysqli_query($conn, "SELECT Url FROM images WHERE Src = '$Image_url2'");
while($row = mysqli_fetch_array($result4)){
$Url = $row['Url'];
$Src = '/thumbnails/thumb' .$Image_url2;
$result5 = mysqli_query($conn, "SELECT Name, Pathname FROM map WHERE Pathname = '$Url'");
while($row = mysqli_fetch_array($result5)){
$Name = $row['Name'];
$Pathname = $row['Pathname'];
echo '<a href ="' .$Pathname .'"><img src ="' .$Src .'" alt =" Thumbnail " title ="'.$Name .'" width ="125" height ="125"/></a> ';
}
}
}
}
}
foreach($Tag as &$tag2)
{
    $tag2 = trim($tag2);
    $tag2 = ucfirst(strtolower($tag2));
    $tag2 = htmlspecialchars($tag2, ENT_QUOTES);
}
$tag_sql = implode("','", $Tag);
$query = "SELECT Tag, Image_url FROM image_tags WHERE Tag IN ('{$tag_sql}')AND Pending = 0 ORDER BY Number DESC";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)){
$Image_url = $row['Image_url'];
$array_tags[] = $Image_url;
}
$array_tags = array_unique($array_tags);
$count_or = count($array_tags) -1;
$search_or = preg_replace("[',']", "\" or \"", $tag_sql);
$pos = strpos($search_or, " or ");
if ($count_or == 0 and $word_count > 1 and $pos ===false)
{
$Tag = preg_split("/[ ]+/", $search_or, 0, PREG_SPLIT_NO_EMPTY);
foreach($Tag as &$tag2)
{
    $tag2 = trim($tag2);
    $tag2 = ucfirst(strtolower($tag2));
    $tag2 = htmlspecialchars($tag2, ENT_QUOTES);
}
$tag_sql = implode("','", $Tag);
$query = "SELECT Tag, Image_url FROM image_tags WHERE Tag IN ('{$tag_sql}')AND Pending = 0 ORDER BY Number DESC";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)){
$Image_url = $row['Image_url'];
$array_tags[] = $Image_url;
}
$array_tags = array_unique($array_tags);
$count_word = count($array_tags) -1;
$search_word = preg_replace("[',']", "\" or \"", $tag_sql);
echo '<h4><strong>(' .$count_or .')</strong> Results for tags: "'. $search_or .'". Searched instead for tags: "' .$search_word .'" and found (' .$count_word .') results.</h4><br />';
}
else
{
  echo '<h4><strong>(' .$count_or .')</strong> Results for tag(s): "'. $search_or .'":</h4><br />';
}
foreach ($array_tags as $Image_url2)
{
$result4 = mysqli_query($conn, "SELECT Url FROM images WHERE Src = '$Image_url2'");
while($row = mysqli_fetch_array($result4)){
$Url = $row['Url'];
$Src = '/thumbnails/thumb' .$Image_url2;
$result5 = mysqli_query($conn, "SELECT Name, Pathname FROM map WHERE Pathname = '$Url'");
while($row = mysqli_fetch_array($result5)){
$Name = $row['Name'];
$Pathname = $row['Pathname'];
echo '<a href ="' .$Pathname .'"><img src ="' .$Src .'" alt =" Thumbnail " title ="'.$Name .'" width ="125" height ="125"/></a> ';
}
}
}
echo '<br />';
}
echo '<br />';
?>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>