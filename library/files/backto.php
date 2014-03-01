<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/opendb_gigi.php';
echo '<div class = "backto">';
$path = $_SERVER["PHP_SELF"];
$path = substr($path, 1);
$result = mysqli_query($conn, "SELECT Map, Parent FROM map WHERE Pathname = '$path'");  
while($row = mysqli_fetch_array($result))
    {
    $Map = $row['Map'];
    $Parent =$row['Parent'];
    }
while($Parent > 0)
    {
    $result2 = mysqli_query($conn, "SELECT Pathname, Name, Parent, Map FROM map WHERE Child = '$Map'");
while($row = mysqli_fetch_array($result2))
        {
        $Map = $row['Map'];
        $Parent = $row['Parent'];
        echo '<a  href="http://' .$_SERVER['SERVER_NAME'] .'/' .$row['Pathname'] .'">Back To '.$row['Name'] .'</a><br />';
        }
    }
echo '</div>';
include 'closedb.php';
?>
