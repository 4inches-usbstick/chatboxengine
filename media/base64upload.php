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

if (!validate("$rdir/$sc/media/$_POST[hidden]/uploaded/.htafiletxpolicy", $_POST['name'])) {
	die('[err:19] Stop: VALIDATOR.php deems file to be illegal.');
}
if ($_POST['name'] == '.htafiletxpolicy') {
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
$f = fopen("$rdir/$sc/media/$_POST[hidden]/uploaded/$_POST[name]", 'w');
$str = base64_decode($_POST['content']);
fwrite($f, $str);
fclose($f);	
} else {
	$timestamp1 = date("H.i.s");
	$timestamp2 = date("d.m.y");
	$n = "$timestamp1-$timestamp2-$_POST[name]";
	
	$f = fopen("$rdir/$sc/media/$_POST[hidden]/uploaded/$n", 'w');
	$str = base64_decode($_POST['content']);
	fwrite($f, $str);
	fclose($f);	
}
           
            
echo("\n<br>Path : $rdir/$sc/media/$_POST[hidden]/uploaded/$n<br>\n");
echo("\n<br>URL : <a href='$_POST[hidden]/uploaded/$n'>media/$_POST[hidden]/uploaded/$n</a>");
		
		
		?>