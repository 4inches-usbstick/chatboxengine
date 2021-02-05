<?php
if (file_exists($_GET['write'])) {
	$myfile = fopen("$_GET[write]", "a");
	$myfile = fclose($myfile);
} else {
	die('This chatbox does not actually exist');
}

date_default_timezone_set('America/New_York');
$directives = file_get_contents(".htaconnectionpolicy");
$name = $_GET['namer'];
$write = $_GET['write'];
$doc = $_GET['opt'];
$alias= substr_count($directives, 'showalias:YES');
$ts_yes = substr_count($directives, 'showts:YES');
$ts_LCL = substr_count($directives, 'showts:LOCAL');
$enable = substr_count($directives, 'shownewconnect:YES');
if ($enable == 0) {
die();	
}
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");
$ts = "[$timestamp1, $timestamp2]";
if ($doc == 'connect') {
//user and ts
if ($alias == 1 && $ts_yes == 1) {
	$text = "\n<i> SERVER - User <b>$name</b> has connected at $ts</i>\n";
}
//user but no ts
if ($alias == 1 && $ts_yes == 0) {
	$text = "\n<i> SERVER - User <b>$name</b> has connected</i>\n";
}
//ts but no user
if ($alias == 0 && $ts_yes == 1) {
	$text = "\n<i> SERVER - A user has connected at $ts</i>\n";
}
//ts but no user
if ($alias == 0 && $ts_yes == 0) {
	$text = "\n<i> SERVER - A user has connected<i>\n";
}
}
if ($doc == 'disconnect') {
//user and ts
if ($alias == 1 && $ts_yes == 1) {
	$text = "\n<i> SERVER - User <b>$name</b> has disconnected at $ts</i>\n";
}
//user but no ts
if ($alias == 1 && $ts_yes == 0) {
	$text = "\n<i> SERVER - User <b>$name</b> has disconnected</i>\n";
}
//ts but no user
if ($alias == 0 && $ts_yes == 1) {
	$text = "\n<i> SERVER - A user has disconnected at $ts</i>\n";
}
//ts but no user
if ($alias == 0 && $ts_yes == 0) {
	$text = "\n<i> SERVER - A user has disconnected<i>\n";
}
}
echo($text);
if ($ts_LCL == 1) {
$change = file_get_contents("http://71.255.240.10:8080/textengine/sitechats/sendmsg_integration.php?write=$write&msg=$text&encode=UTF-8&referer=norefer&namer=");
} else {
$f = fopen($write, 'a');	
fwrite($f, $text);
fclose($f);
}