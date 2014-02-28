<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<div class ="inno">
<form method = "post" id = "form" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<?php
if(isset($_POST['mail']))
{
include '../config_gigi.php';
$to = $email; 
$From = $_POST['From'];
if ($From == Null)
{
$From = $email;
}
$subject = $_POST['Subject'];  
$message = $_POST['Message'];
$headers = 'From:'. $From;
if ($message == Null)
{
echo '<p>There is no message to be sent.</p><p>Subject:<br /><input type ="text" name="Subject" size="30" value ="'. $subject. '"/><br />From:<br /><input type ="text" name="From" size="30" value ="'. $From. '"/><br />Message (Required):<br /><textarea name="Message" rows="15" cols = "60"></textarea><br /><input name ="mail" title = "Send Message" type ="submit" value="Mail" /><br />';
}
else
{
if ($subject == Null)
{
$subject = "No Subject";
}
mail($to, $subject, $message, $headers) or exit('Failure to mail.');
echo '<p>Your message has been sent.</p><p>Subject:<br /><input type ="text" name="Subject" size="30" /><br />From:<br /><input type ="text" name="From" size="30" /><br />Message (Required):<br /><textarea name="Message" rows="15" cols = "60"></textarea><br /><input name ="mail" title = "Send Message" type ="submit" value="Mail" /><br />';
}
}
else
{
echo '<p>Subject:<br /><input type ="text" name="Subject" size="30" /><br />From:<br /><input type ="text" name="From" size="30" /><br />Message (Required):<br /><textarea name="Message" rows="15" cols = "60"></textarea><br /><input name ="mail" title = "Send Message" type ="submit" value="Mail" /><br />';
}
?>
</p>
</form>
</div>
<p>Please use a real e-mail address in the from field if you wish for me to be able to reply to you, I won't store any addresses and it will never be sent any spam. Feel free to e-mail me about any questions or comments you may have about my site or anything in general. </p>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>