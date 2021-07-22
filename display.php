<?php
//$hostname = gethostbyaddr('71.255.240.10');
//echo $hostname;

include 'mainlookup.php';
$sc = plsk(107);
$rdir = plsk(3);
error_reporting(0);
clearstatcache();

if (empty($_GET['encode'])) {
	$_GET['encode'] = "UTF-8";
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');
$chatbox = "$rdir/$sc/$_GET[chatbox]";

$iframe = substr_count($_GET["chatbox"], '.hta');

if ($iframe > 0) {
	header("HTTP/1.0 403 Forbidden");
	die("[err:13] Stop: 403 Forbidden");
}

if ($_GET['divecho']) {
	echo('<div style="white-space: pre;">');
}
if (file_exists($chatbox)) {
$f = fopen($chatbox, 'rb');
$c = fread($f,filesize($chatbox));
fclose($f);
if ($_GET['encode'] != "none") {	
echo(mb_convert_encoding($c, $_GET['encode']));
} else {
echo($c);
}
} else {
	echo('[err:14] Stop: 404 Not Found');
	header("HTTP/1.0 404 Not Found");
}

if ($_GET['divecho']) {
	echo('</div>');
}
?>