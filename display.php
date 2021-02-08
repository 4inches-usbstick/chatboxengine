<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');
$chatbox = $_GET["chatbox"];

$iframe = substr_count($_GET["chatbox"], '.hta');

if ($iframe > 0) {
	header("HTTP/1.0 403 Forbidden");
	die("403 Forbidden");
}

echo(file_get_contents($chatbox));
?>