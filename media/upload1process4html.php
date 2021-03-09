<title>engine page</title>
<?php
include 'mainlookup.php';
$rdir = plsk(3);
date_default_timezone_set(plsk(9));
$maxfilesize = plsk(11);
$enable = plsk(13);
$canuseselfname = plsk(17);

if (file_exists("$rdir/sitechats/$_POST[hidden]")) {
	$m = 'f';
} else {
	die('Stop: This chatbox does not actually exist');
}



$notallowed = array('<', '>', ':', '"', '/', '\\', '|', '?', '*', ';', 'NUL', 'COM', 'LPT', 'CON', 'PRN');

foreach ($notallowed as $i) {
if (substr_count($_FILES['ftu']['name'], $i) > 0) {
	die('Stop: Illegal character in filename: ' . $i);
}
}

if ($enable != 'YES') {
die('Stop: Uploads stopped by .htamainpolicy');
}

ini_set('upload_max_filesize', '12M');
ini_set('post_max_size', '14M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
ini_set('memory_limit', '128M');
		$phpFileUploadErrors = array(
    0 => 'OK',
    1 => 'PAYLOAD TOO BIG (PHP.INI)',
    2 => 'PAYLOAD TOO BIG (HTML)',
    3 => 'PARTIAL UPLOAD',
    4 => 'BLANK PAYLOAD',
    6 => 'NO TMP DIR',
    7 => 'WRITING FAILURE',
    8 => 'EXTENSION CONFLICT',
);


//echo("Chatbox directory: $_GET[chatnum1]");
error_reporting(1);
echo('Bytes: ' . $_FILES['ftu']['size'] . '<br>PHP Status: ' . $_FILES['ftu']['error'] . '::' . $phpFileUploadErrors[$_FILES['ftu']['error']] . '<br>');

if (isset($_FILES['ftu'])) {
    if ($_FILES['ftu']['size'] > $maxfilesize) {
				echo('Stop: Illegal payload size detected, halted<br>');
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
$target_dir = ("$rdir/sitechats/media/$chatboxdir/uploaded/$file_name");

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
$target_dir = ("$rdir/sitechats/media/$chatboxdir/uploaded/$txt");

move_uploaded_file($file_tmp, $target_dir); 
//rename($target_dir/$file_name, $target_dir/$file_name/$chatboxdir);
echo('Path: ' . $target_dir . "<br>");

$URL = $_SERVER['HTTP_REFERER'];
}
			
           
            
        
		
		
		?>