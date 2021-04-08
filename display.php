<?php
//$hostname = gethostbyaddr('71.255.240.10');
//echo $hostname;
include 'mainlookup.php';
$rdir = plsk(3);
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');
$chatbox = "$rdir/sitechats/$_GET[chatbox]";

$iframe = substr_count($_GET["chatbox"], '.hta');

if ($iframe > 0) {
	header("HTTP/1.0 403 Forbidden");
	die("[err:13] Stop: 403 Forbidden");
}

if ($_GET['divecho']) {
	echo('<div style="white-space: pre;">');
}
if (file_exists($chatbox)) {
echo(file_get_contents($chatbox));
} else {
	echo('[err:14] Stop: 404 Not Found');
	header("HTTP/1.0 404 Not Found");
}

if ($_GET['divecho']) {
	echo('</div>');
}
?>