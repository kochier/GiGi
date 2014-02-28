<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';
$ip = getenv ("REMOTE_ADDR");
$server_name = getenv ("SERVER_NAME");
$request_uri = getenv ("REQUEST_URI"); 
$http_ref = getenv ("HTTP_REFERER"); 
$error_date = date("D M j Y g:i:s a T");
$message = 'There was a 403 error on the '.$server_name .' domain. 
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
$subject = '403 Error';
$headers = 'From: 403error@' .$server_name;
mail($to, $subject, $message, $headers) or exit('mail fail');
?>
<p>You are not allowed to view the page you are trying to access.</p>
<ul>
<li>If you think you should be able to view this page contact me <a href="contact.php">here</a> to let me know about the problem.</li>
<li>Otherwise you can simply go <a href = "javascript:history.back()">back</a> to where you came from and try to go someplace else. </li>
<li>Or you can visit my <a href ="index.php">home</a> page and browse from there.</li>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>