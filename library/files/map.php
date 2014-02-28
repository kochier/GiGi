<?php
include $path_parts_1['dirname'] .'/opendb_gigi.php';
$result = mysqli_query($conn, "SELECT Name, Pathname, Child FROM map Where Parent = 0 and Map <> 22 and Map <> 23 and Map <> 24");
echo '<ul>';
while($row = mysqli_fetch_array($result)){
$Child = $row['Child'];
if ($Child > 0)
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a><ul>';
$result = mysqli_query ($conn, "SELECT Name, Pathname, Child FROM map Where Map = $Child Order by Name ASC");
while($row = mysqli_fetch_array($result)){
$Child2 = $row['Child'];
if ($Child2 > 0)
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a><ul>';
$result2 = mysqli_query ($conn, "SELECT Name, Pathname, Child FROM map Where Map = $Child2 Order by Name ASC");
while($row = mysqli_fetch_array($result2)){
$Child3 = $row['Child'];
if ($Child3 > 0)
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a><ul>';
$pathname = $row['Pathname'];
if ($pathname == 'blog.php' or $pathname =='news.php')
{
$result3 = mysqli_query ($conn, "SELECT Name, Pathname, Child FROM map Where Map = $Child3 Order by Created DESC");
}
else
{
$result3 = mysqli_query ($conn, "SELECT Name, Pathname, Child FROM map Where Map = $Child3 Order by Name ASC");
}
while($row = mysqli_fetch_array($result3)){
$Child4 = $row['Child'];
if ($Child4 > 0)
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a><ul>';
if ($pathname == 'blog.php' or $pathname =='news.php')
{
$result4 = mysqli_query ($conn, "SELECT Name, Pathname, Child, Created FROM map Where Map = $Child4 Order by Created DESC");
while($row = mysqli_fetch_array($result4)){
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a></li>';

}
}
else
{
$result4 = mysqli_query ($conn, "SELECT Name, Pathname, Child FROM map Where Map = $Child4 Order by Name ASC");
while($row = mysqli_fetch_array($result4)){
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a></li>';

}
}
if ($Child4 > 0)
{
echo '</ul>';
}
}
else
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a></li>';
}
}
if ($Child3 > 0)
{
echo '</ul>';
}
}
else
{
$pathname = $row['Pathname'];
if ($pathname == 'sitemap.php')
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a> &lt;-- You Are Here.</li>';
}
else
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a></li>';
}
}
}
}
else
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a></li>';
}
if ($Child2 > 0)
{
echo '</ul>';
}
}
if ($Child > 0)
{
echo '</ul>';
}
}
else
{
echo '<li><a href="' . $row['Pathname'] . '">' . $row['Name'] . '</a></li>';
}
}
echo '</ul>';
$result = mysqli_query($conn, "SELECT Pathname FROM map WHERE map < '22' or map > '24'");
$total = mysqli_num_rows($result);
echo '<p>Total: ' .$total .'</p>'; 
include 'closedb.php';
?> 