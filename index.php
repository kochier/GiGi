<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';
echo '<h4>Newest Pages <a class = "rss" href="http://' .$_SERVER['SERVER_NAME'] .'/rss.xml"><img alt="RSS feed" src="feed.png"/></a></h4>';
include 'library/files/list.php';
?>
<h4>Latest Updated Pages</h4>
<?php
include 'library/files/list2.php';
?>
<h4>Recent Comments:</h4>
<?php
include 'library/files/list3.php';
include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>