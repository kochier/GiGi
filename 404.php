<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';
$ip = getenv ("REMOTE_ADDR");
$server_name = getenv ("SERVER_NAME");
$request_uri = getenv ("REQUEST_URI"); 
$http_ref = getenv ("HTTP_REFERER"); 
$error_date = date("D M j Y g:i:s a T");
$message = 'There was a 404 error on the '.$server_name .' domain. 
When: '.$error_date 
.'
IP Address: '.$ip
.'
Tried to Access: http://'.$server_name.$request_uri
.'
Referer: '.$http_ref;  
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$path_parts_1 = pathinfo($doc_root);
include $path_parts_1['dirname'] .'/config_gigi.php';
$to = $email;
$subject = '404 Error';
$headers = 'From: 404error@' .$server_name;
mail($to, $subject, $message, $headers) or exit('mail fail');
?>
<p>The page you are looking for can not be found, there are several things you can do about this.</p>
<ul>
<li>If the link came from my site contact me <a href="contact.php">here</a> to let me know about the faulty link.</li>
<li>Otherwise you can simply go <a href = "javascript:history.back()">back</a> to where you came from and try another link. </li>
<li>Or you can visit my <a href ="index.php">home</a> page and browse from there.</li>
</ul>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>