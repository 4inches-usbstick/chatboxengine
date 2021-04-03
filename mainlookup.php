<?php
//get the value of a policy
function plsk($pid) {
	$f = file_get_contents("C:/wamp64/www/textengine/sitechats/.htamainpolicy");
	$fs = explode('::', $f);
	return $fs[$pid];
}


//verify the identity of a UID
function uidlsk($uid, $skey) {
	$f = file_get_contents("C:/wamp64/www/textengine/sitechats/.htamainpolicy");
	$offset0 = strpos($f, '[BEGIN CBAUTH]');
	$offset1 = strpos($f, '[END CBAUTH]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	$ffs = explode(';', $fs);
	$user = $ffs[$uid];
	$userats = explode('::', $user);
	$ckey = $userats[2];
	//echo($ckey);
	if ($ckey == $skey) {
		return true;
	} else {
		return false;
	}
}
//get UID info
function uid($uid, $skey, $attrno) {
	$f = file_get_contents("C:/wamp64/www/textengine/sitechats/.htamainpolicy");
	$offset0 = strpos($f, '[BEGIN CBAUTH]');
	$offset1 = strpos($f, '[END CBAUTH]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	$ffs = explode(';', $fs);
	$user = $ffs[$uid];
	$userats = explode('::', $user);
	return $userats[$attrno];
}
//get whole UID list
function uid_db() {
$f = file_get_contents("C:/wamp64/www/textengine/sitechats/.htamainpolicy");
	$offset0 = strpos($f, '[BEGIN CBAUTH]');
	$offset1 = strpos($f, '[END CBAUTH]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}


//get whole RW protection list
function wr_db() {
$f = file_get_contents("C:/wamp64/www/textengine/sitechats/.htamainpolicy");
	$offset0 = strpos($f, '[BEGIN FILESAFE]');
	$offset1 = strpos($f, '[END FILESAFE]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}
//get RW info by Chatbox
function wr_bycb($cb, $attrno) {
	$f = file_get_contents("C:/wamp64/www/textengine/sitechats/.htamainpolicy");
	$offset0 = strpos($f, '[BEGIN FILESAFE]');
	$offset1 = strpos($f, '[END FILESAFE]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	$ffs = explode('::', $fs);
	$key = array_search($cb, $ffs);
	$key = $key + 1;
	return $ffs[$key];
}

//get scripting 
function gs() {
$f = file_get_contents("C:/wamp64/www/textengine/sitechats/.htamainpolicy");
	$offset0 = strpos($f, '[BEGIN C-CMD]');
	$offset1 = strpos($f, '[END C-CMD]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}

//I HATH CONNECT HELPERFUNCTION
function speakout($name, $write) {
date_default_timezone_set(plsk(9));
$directives = file_get_contents(".htaconnectionpolicy");
$doc = 'connect';
$alias= substr_count($directives, 'showalias:YES');
$ts_yes = substr_count($directives, 'showts:YES');
$ts_LCL = substr_count($directives, 'showts:LOCAL');
$enable = substr_count($directives, 'shownewconnect:YES');

$offset1 = strpos($directives, '-->');
$offset2 = strpos($directives, '<--');
$length = $offset2 - $offset1;
$messages = substr($directives, $offset1, $length);
$pieces = explode('::', $messages);

if ($enable == 0) {
$doc = 'sdf';
}
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");
$ts = "[$timestamp1, $timestamp2]";
if ($doc == 'connect') {
//user and ts
if ($alias == 1 && $ts_yes == 1) {
	$text = $pieces[1];
	$text = str_replace('%name', $name, $text);
	$text = str_replace('%ts', $ts, $text);
	$retuls = $text;
}
//user but no ts
if ($alias == 1 && $ts_yes == 0) {
	$text = $pieces[2];
	$text = str_replace('%name', $name, $text);
	$retuls = $text;
}
//ts but no user
if ($alias == 0 && $ts_yes == 1) {
	$text = $pieces[3];
	$text = str_replace('%ts', $ts, $text);
	$retuls = $text;
}
//ts but no user
if ($alias == 0 && $ts_yes == 0) {
	$text = $pieces[4];
	$retuls = $text;
}
}
echo($text);
if ($ts_LCL == 1) {
$change = file_get_contents("$pcl://$ip/textengine/sitechats/sendmsg_integration.php?write=$write&msg=$text&encode=UTF-8&referer=norefer&namer=");
} else {
$f = fopen($write, 'a');	
fwrite($f, $retuls);
fclose($f);
}
}
?>