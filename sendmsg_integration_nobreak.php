<?php
error_reporting(1);
include 'mainlookup.php';

$rdir = plsk(3);
$dots = plsk(23);
$nogo = explode('//', plsk(29));
$protec = explode('//', plsk(31));
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');



if (plsk(21) != 'YES') {
	die('API is locked down.');
}

date_default_timezone_set(plsk(9));
//error_reporting(1);
if (file_exists($_GET['write'])) {
	$myfile = fopen("$_GET[write]", "a");
} else {
	die('Stop: This chatbox does not actually exist');
}

//banned words checker
foreach ($nogo as $i) {
	$iframe = 0;
	$iframe = substr_count(strtolower($_GET["msg"]), $i);
	if ($iframe > 0) {
		die('Stop: Illegal element in string detected, halted');
	}
}
//illegal destination checker
foreach ($protec as $i) {
	$iframe = 0;
	$iframe = substr_count(strtolower($_GET["write"]), $i);
	if ($iframe > 0) {
		die('Stop: Illegal destination, halted');
	}
}

	if (substr_count(uid_db(), $_GET['namer']) != 0) {
	//echo('Name found in UID pool<br>');
	$b = 'b';
	}
//no keypair there
	if ((empty($_GET['uid']) || empty($_GET['ukey'])) && substr_count(uid_db(), $_GET['namer']) > 0) {
		die('Stop: No UKEY');
	}
//keypair there, but not right
	if (uidlsk($_GET['uid'], $_GET['ukey']) == false && substr_count(uid_db(), $_GET['namer']) != 0) {
		die('Stop: invalid UKEY');
	}
//name in and right UID/UKEY pair
	if (uidlsk($_GET['uid'], $_GET['ukey']) == true && substr_count(uid_db(), $_GET['namer']) != 0) {
		echo('UID ' . $_GET['uid'] . ' used to send a message as ' . uid($_GET['uid'], $_GET['ukey'], 1));
		$_GET['namer'] = uid($_GET['uid'], $_GET['ukey'], 1);
	}

//print uid_db();
//name in there?


//ts on?
if ($dots == 'YES') {
$contents = file_get_contents("$rdir/sitechats/$_GET[write]");
//echo("$contents, C:/wamp64/www/textengine/sitechats/$_GET[write]");
$needle = "rule.Timestamps(1)";
$timestamps = strpos("$contents", "rule.Timestamps(1)");
echo("<br><br>timestamps at $timestamps<br>");
}

if (plsk(33) == 'YES') {
//encoding yes
$mess = $_GET["msg"];
if (empty($_GET["encode"])) {
	$_GET['encode'] = 'UTF-8';
}
$mess = mb_convert_encoding($mess, $_GET['encode']);
}

$URL = $_GET["rurl"];
//set return url
$returnbool = 1;
if ($URL == "norefer") {
	$returnbool = "no";
}




$name = $_GET['namer'];
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");

if ($timestamps != "" && !empty($name)) {
$txt = "$name [$timestamp1, $timestamp2]: $mess";
}
if ($timestamps != "" && empty($name)) {
$txt = "[$timestamp1, $timestamp2]: $mess";
}
if ($timestamps == "" && !empty($name)) {
$txt = "$name: $mess";
}
if ($timestamps == "" && empty($name)) {
$txt = "$mess";
}

fwrite($myfile, "$txt");
fclose($myfile);
echo("submitted<br>");
//echo("$coder encoder<br>");
//echo("$mess1 = message<br>");
//echo("$URL = referer<br>");

$ref = $_SERVER['HTTP_REFERER'];
if (strpos($ref, 'inchat')) {
header("Location: $ref");
}

?>

<p></p>

