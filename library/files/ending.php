<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$test = $_SERVER["PHP_SELF"];
$test = substr($test, 1);
$result = mysqli_query($conn, "SELECT Map, Pathname, Parent FROM map WHERE Pathname = '$test'");
while($row = mysqli_fetch_array($result)){
$Map = $row['Map'];
$Parent = $row['Parent'];
$Pathname = $row['Pathname'];
if ($Map ==40 or $Map ==50){
echo '</div>';
}
else{
break;
}
}
include $doc_root .'/library/files/closedb.php';
?>
</div>
<?php
if ($Pathname == 'index.php')
{
}
if ($Map == 23 or $Map == 24)
{
}
else
{
if ($Parent ==41)
{
include $doc_root .'/library/files/add_image_tags.php';
}
if ($Parent ==51)
{
include $doc_root .'/library/files/add_video_tags.php';
}
include $doc_root .'/library/files/comments.php';
}
include $doc_root .'/library/files/backto.php';
?>
</div>
<br />
<br />
</div>
<div id ="footer">
<div id ="quotes">
<?php
echo '<script type="text/javascript" src="http://' .$_SERVER['SERVER_NAME'] .'/quotes.js"></script>';
?>
</div>
<div id ="about">
<form style="display: inline;" method="get" action="http://www.google.com/search">
<input
type="text"
name="q"
size="18"
maxlength="255"
value="Search"
onfocus="this.value = '';"
/>
<?php
echo '<input type="hidden" name="sitesearch" value="' .$_SERVER['SERVER_NAME'] .'" />';
?>
<input type="submit" style="display: none;" />
</form>
<?php
echo '<a  href="http://' .$_SERVER['SERVER_NAME'] .'/contact.php">Contact</a>	&bull;<a href="http://' .$_SERVER['SERVER_NAME'] .'/about.php">About</a>	&bull;<a href="http://' .$_SERVER['SERVER_NAME'] .'/sitemap.php">Sitemap</a>';
?>
</div>
</div>
<div id = "valid">
<?php
echo '<a href="http://gigi.absurdity981.com"><img height="31" width="88" src="http://' .$_SERVER['SERVER_NAME'] .'/powered_by_gigi.jpg" title="Powered by GiGi V 0.6" alt="GiGi" /></a> ';
if ($Pathname == 'index.php')
{
echo '<a href="http://validator.w3.org/feed/check.cgi?url=http://' .$_SERVER['SERVER_NAME'] .'/rss.xml"><img height="31" width="88" src="http://' .$_SERVER['SERVER_NAME'] .'/valid-rss.png" title="Valid RSS!" alt="Valid RSS!" />
</a>';
echo '<a href="http://jigsaw.w3.org/css-validator/validator?uri=' .$_SERVER['SERVER_NAME'] .'&amp;profile=css3&amp;usermedium=all&amp;warning=1&amp;vextwarning=&amp;lang=en"><img height="31" width="88" src="http://' .$_SERVER['SERVER_NAME'] .'/vcss-blue.png" title="Valid CSS!" alt="Valid CSS!" /></a>';
}
?>
<a href="http://validator.w3.org/check?uri=referer"><img
<?php
echo 'src="http://' .$_SERVER['SERVER_NAME'] .'/HTML5_Logo_64.png"';
?>

        title="Valid HTML 5"
        alt="Valid HTML 5" height="31" width="58" /></a>
</div>
</body>
</html>