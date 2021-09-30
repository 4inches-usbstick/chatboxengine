<title>engine page</title>
<?php
include 'mainlookup.php';
include 'validator.php';

$rdir = plsk(3);
date_default_timezone_set(plsk(9));
$maxfilesize = plsk(11);
$enable = plsk(13);
$canuseselfname = plsk(17);

if (!validate("$rdir/sitechats/media/$_POST[hidden]/.htafiletxpolicy", $_FILES['ftu']['name'])) {
	die('[err:19] Stop: VALIDATOR.php deems file to be illegal.');
}

if (file_exists("$rdir/sitechats/$_POST[hidden]")) {
	$m = 'f';
} else {
	die('[err:28] Stop: This chatbox does not actually exist');
}

if (is_dir("$rdir/sitechats/media/$_POST[hidden]/uploaded")) {
	$m = 'f';
} else {
	die('[err:28] Stop: This chatbox has a missing or damaged media dir');
}



if ($enable != 'YES') {
die('[err:26] Stop: Uploads stopped by .htamainpolicy');
}

$notallowed = array('<', '>', ':', '"', '/', '\\', '|', '?', '*', ';', 'NUL', 'COM', 'LPT', 'CON', 'PRN');

foreach ($notallowed as $i) {
if (substr_count($_POST['name'], $i) > 0) {
	die('[err:19] Stop: Illegal character in filename: ' . $i);
}
}


//echo("Chatbox directory: $_GET[chatnum1]");
error_reporting(1);
echo('Bytes: ' . strlen($_POST['content']));

if (strlen($_POST['content']) > $maxfilesize) {
	die('[err:27] Stop: Illegal payload size detected, halted<br>');
}

if ($canuseselfname == 'YES') {
$f = fopen("$rdir/sitechats/media/$_POST[hidden]/uploaded/$_POST[name]", 'w');
$str = base64_decode($_POST['content']);
fwrite($f, $str);
fclose($f);	
} else {
	$timestamp1 = date("H.i.s");
	$timestamp2 = date("d.m.y");
	$n = "$timestamp1-$timestamp2-$_POST[name]";
	
	$f = fopen("$rdir/sitechats/media/$_POST[hidden]/uploaded/$n", 'w');
	$str = base64_decode($_POST['content']);
	fwrite($f, $str);
	fclose($f);	
}
           
            
echo("\n<br>Path : $rdir/sitechats/media/$_POST[hidden]/uploaded/$n<br>\n");
echo("\n<br>URL : <a href='/textengine/sitechats/media/$_POST[hidden]/uploaded/$n'>/textengine/sitechats/media/$_POST[hidden]/uploaded/$n</a>");
		
		
		?>