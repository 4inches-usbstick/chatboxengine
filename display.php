<?php
//$hostname = gethostbyaddr('71.255.240.10');
//echo $hostname;
include 'mainlookup.php';
$rdir = plsk(3);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');
$chatbox = "$rdir/sitechats/$_GET[chatbox]";

$iframe = substr_count($_GET["chatbox"], '.hta');

if ($iframe > 0) {
	header("HTTP/1.0 403 Forbidden");
	die("403 Forbidden");
}

echo(file_get_contents($chatbox));
?>