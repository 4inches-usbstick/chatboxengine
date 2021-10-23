<title>engine page</title>
<?php
include 'mainlookup.php';
include 'validator.php';

$rdir = plsk(3);
date_default_timezone_set(plsk(9));
$maxfilesize = plsk(11);
$enable = plsk(13);
$canuseselfname = plsk(17);
$sc = plsk(107);

if (!validate("$rdir/$sc/media/$_POST[hidden]/uploaded/.htafiletxpolicy", $_FILES['ftu']['name'])) {
	die('[err:19] Stop: VALIDATOR.php deems file to be illegal.');
}
if ($_FILES['ftu']['name'] == '.htafiletxpolicy') {
	die('[err:19] Stop: Illegal file name.');
}

if (file_exists("$rdir/$sc/$_POST[hidden]")) {
	$m = 'f';
} else {
	die('[err:28] Stop: This chatbox does not actually exist');
}
if (is_dir("$rdir/$sc/media/$_POST[hidden]/uploaded")) {
	$m = 'f';
} else {
	die('[err:28] Stop: This chatbox has a missing or damaged media dir');
}


$notallowed = array('<', '>', ':', '"', '/', '\\', '|', '?', '*', ';', 'NUL', 'COM', 'LPT', 'CON', 'PRN');

foreach ($notallowed as $i) {
if (substr_count($_FILES['ftu']['name'], $i) > 0) {
	die('[err:19] Stop: Illegal character in filename: ' . $i);
}
}

if ($enable != 'YES') {
die('[err:26] Stop: Uploads stopped by .htamainpolicy');
}


		$phpFileUploadErrors = array(
    0 => 'OK',
    1 => 'Stop: PAYLOAD TOO BIG (PHP.INI)',
    2 => 'Stop: PAYLOAD TOO BIG (HTML)',
    3 => 'Stop: PARTIAL UPLOAD',
    4 => 'Stop: BLANK PAYLOAD',
    6 => 'Stop: NO TMP DIR',
    7 => 'Stop: WRITING FAILURE',
    8 => 'Stop: EXTENSION CONFLICT',
);


//echo("Chatbox directory: $_GET[chatnum1]");
error_reporting(1);
echo('Bytes: ' . $_FILES['ftu']['size'] . '<br>PHP Status: ' . $_FILES['ftu']['error'] . '::' . $phpFileUploadErrors[$_FILES['ftu']['error']] . '<br>');

if (isset($_FILES['ftu'])) {
    if ($_FILES['ftu']['size'] > $maxfilesize) {
				echo('[err:27] Stop: Illegal payload size detected, halted<br>');
				die();
    } else {
        $b = 'b';
    }
}


		
     
//echo "<p>" . $_POST['ftu'] . "</p>";
if ($canuseselfname == 'YES') {
$file_name = $_FILES['ftu']['name'];
$file_tmp = $_FILES['ftu']['tmp_name'];
$stripped = substr($_POST['hidden'], 0, -5);
$chatboxdir = "$stripped-med";
$target_dir = ("$rdir/$sc/media/$chatboxdir/uploaded/$file_name");

move_uploaded_file($file_tmp, $target_dir); 
//rename($target_dir/$file_name, $target_dir/$file_name/$chatboxdir);
echo('Path: ' . $target_dir . "<br>");

$URL = $_SERVER['HTTP_REFERER'];
//header("Location: $URL");
} else {
$file_name = $_FILES['ftu']['name'];
$file_tmp = $_FILES['ftu']['tmp_name'];
$stripped = substr($_POST['hidden'], 0, -5);
$chatboxdir = "$stripped-med";

$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");
$txt = "$timestamp1-$timestamp2-$file_name";
$target_dir = ("$rdir/$sc/media/$chatboxdir/uploaded/$txt");

move_uploaded_file($file_tmp, $target_dir); 
//rename($target_dir/$file_name, $target_dir/$file_name/$chatboxdir);
echo('Path: ' . $target_dir . "<br>\n");
echo("\n<br>URL : <a href='/textengine/$sc/media/$_POST[hidden]/uploaded/$txt'>/textengine/$sc/media/$_POST[hidden]/uploaded/$txt</a>");

$URL = $_SERVER['HTTP_REFERER'];
}
			
           
            
        
		
		
		?>