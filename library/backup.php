<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/beginning.php';?>
<?php
include '../../opendb_gigi.php';
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$backup_path = $doc_root .'/library/';
define('BACKUPDIR', $backup_path);
 
// for making links to this page (form action etc.)
define('THISPAGE', $_SERVER['PHP_SELF']);
 
/**** SOME FUNCTIONS ****/
 
// if the filename variable in POST is set, the form has been submitted
if (!empty($_POST['filename'])) {
 
 
	// we're now going to go through and validate and verify the inputs
	// so we know what we're getting and to abort if something is wrong
 
	$errors = array();
	$n = 0;
	/* we'll put any errors inside this error array, and at the end we'll
	  list them all for the user to see everything's that's wrong so they
	  can fix it */
 
	if (empty($_POST['filename'])) { // no filename
 
		$errors[$n] = "You must enter a filename.";
		$n++;
 
	}
 
	if (empty($_POST['mysqluser'])) { // no MySQL username
		$errors[$n] = "You must enter a MySQL username.";
		$n++;
	}
 
	if (empty($_POST['mysqlpass'])) { // no MySQL password
		$errors[$n] = "You must enter a MySQL password.";
		$n++;
	}
 
	if ($_POST['backupall'] == 'false' AND empty($_POST['backupwhichdb'])) { // they select to back up a specific DB, but don't say which one
 
		$errors[$n] = "You selected to backup a specific database, but did not specify which one.";
		$n++;
	}
 
	if ($n > 0) { // if there were errors in the validation stage...
 
		// display an error page
 
		?>
		<h2>The backup could not be completed.</h2>
		<ul>
			<?php foreach ($errors as $err) { // loop through each error
				?><li><?php echo $err; // and display its text about it ?></li><?php
			}
			?>
		</ul>
		<?php
	}
 
	// if we're here, the validation must have been fine, so let's get on with the processing
 
	// escape shell arguments to mitigate command line injection
	// please note that this is only basic security, more layers would be added for serious production use
	$_POST['filename'] = escapeshellcmd($_POST['filename']);
	$_POST['mysqluser'] = escapeshellarg($_POST['mysqluser']);
	$_POST['mysqlpass'] = escapeshellcmd($_POST['mysqlpass']);
	$_POST['backupwhichdb'] = escapeshellarg($_POST['backupwhichdb']);
 
	// do we want to back up all databases?
	$backupall = ($_POST['backupall'] == 'false') ? false : true;
 
	// if we want to back up all databases, set this to -A in the command (backs up all), if not, set it to the name of the database to back up
	$dbarg = $backupall ? 'absurdity981_sitemap' : $_POST['backupwhichdb'];
 
	// form our command to execute
include '../../config_gigi.php';
$command = "mysqldump -c -u ".$_POST['mysqluser']." -p".$_POST['mysqlpass']." -h $db_host -A > ".$_POST['filename']." 2>&1";
 
	?><p>Running backup, please wait...</p><?php
 
	// execute the command we just set up
	system($command);
 
	// if they opted to bzip the backup, then do so
	if ($_POST['bzip'] == 'true') {
 
		system('bzip2 "'.BACKUPDIR.$_POST['filename'].'"');
 
	}
 
	// OK, we're done. Tell the user what happened.	If any errors occurred, they get displayed at the system() call.
 
	?><h3>Command executed. If any errors occurred, they will be displayed above.</h3>
 
<?php } ?>

<p><em><strong>Please note:</strong> once you hit Create, the backup may take up to 15 seconds or so to create. The page will not load immediately, so be patient.</em></p>
<form id="dbbackup" method="post" action="<?php echo THISPAGE;?>">
<div class = "inno">
<p>Backup file name: <?php echo BACKUPDIR;?><input type="text" name="filename" value="<?php echo date('dMY_H.i.s').'.sql';?>" /></p>
<p>
<input type="checkbox" name="bzip" value="true" id="bzipTick" /><label for="bzipTick">Compress backup file with Bzip2 compression</label><br /><br />
</p>
<p>MySQL username: <input type="text" name="mysqluser" value="" /></p>
<p>MySQL password: <input type="password" name="mysqlpass" value="" /></p>
<p>
<input type="radio" name="backupall" value="true" id="backupallTrue" /><label for="backupallTrue">Backup all databases</label><br />
<input type="radio" name="backupall" value="false" id="backupallFalse" /><label for="backupallFalse">Backup specific database</label> <input type="text" name="backupwhichdb" value="" /><br />
</p>
<p>
<input type="submit" value="Create" />
</p>
</div>
</form>
<?php include $_SERVER['DOCUMENT_ROOT'] .'/library/files/ending.php';?>