<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';
$ip = getenv ("REMOTE_ADDR");
$server_name = getenv ("SERVER_NAME");
$request_uri = getenv ("REQUEST_URI"); 
$http_ref = getenv ("HTTP_REFERER"); 
$error_date = date("D M j Y g:i:s a T");
$message = 'There was a 401 error on the '.$server_name .' domain. 
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
$subject = '401 Error';
$headers = 'From: 401error@' .$server_name;
mail($to, $subject, $message, $headers) or exit('mail fail');
?>
<p>You can not access the page you are trying to access, you do not have valid credientials to gain access. Please check that the user name and password you are using are correct.</p>
<ul>
<li>If you think you should have access or that there is an error in the login please contact me <a href="contact.php">here</a> to let me know about the error.</li>
<li>Otherwise you can simply go <a href = "javascript:history.back()">back</a> to where you came from and try another link. </li>
<li>Or you can visit my <a href ="index.php">home</a> page and browse from there.</li>
</ul>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>