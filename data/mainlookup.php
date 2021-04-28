<?php
$regpath = "C:/wamp64/www/textengine/sitechats/.htamainpolicy";

//get the value of a policy
function plsk($pid) {
	global $regpath;
	$f = file_get_contents("$regpath");
	$fs = explode('::', $f);
	return $fs[$pid];
}


//verify the identity of a UID
function uidlsk($uid, $skey) {
	global $regpath;
	$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN CBAUTH]');
	$offset1 = strpos($f, '[END CBAUTH]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	$ckey = uid($uid, $skey, 2);
	//echo($ckey);
	if ($ckey == $skey) {
		return true;
	} else {
		return false;
	}
}
//get UID info
function uid($uid, $skey, $attrno) {
	global $regpath;
	$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN CBAUTH]');
	$offset1 = strpos($f, '[END CBAUTH]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	
	//get the user
	$offset0 = strpos($fs, "$uid::");
	$offset1 = strpos($fs, ';', $offset0);
	$user = substr($fs, $offset0, $offset1 - $offset0);
	
	$userats = explode('::', $user);
	return $userats[$attrno];
}
//get whole UID list
function uid_db() {
	global $regpath;
$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN CBAUTH]');
	$offset1 = strpos($f, '[END CBAUTH]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}


//get whole RW protection list
function wr_db() {
	global $regpath;
$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN FILESAFE]');
	$offset1 = strpos($f, '[END FILESAFE]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}
//get RW info by Chatbox
function wr_bycb($cb, $attrno) {
	global $regpath;
	$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN FILESAFE]');
	$offset1 = strpos($f, '[END FILESAFE]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	$fs = preg_replace("/\s\s+/", "", $fs); //thank you to this question (https://stackoverflow.com/questions/3760816/remove-new-lines-from-string-and-replace-with-one-empty-space) for the regex 
	$ffs = explode('::', $fs);
	$key = array_search($cb, $ffs);
	echo "FOUND: $key<br>\n";
	$key = $key + 1;
	return $ffs[$key];
}

//get scripting 
function gs() {
	global $regpath;
$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN C-CMD]');
	$offset1 = strpos($f, '[END C-CMD]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}

//get custom
function gcpp() {
	global $regpath;
$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN CPOLICY]');
	$offset1 = strpos($f, '[END CPOLICY]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}

//get access
function ga() {
	global $regpath;
$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN UIDUKEY LOCKOUT]');
	$offset1 = strpos($f, '[END UIDUKEY LOCKOUT]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}

function speakout($name, $write) {
global $regpath;
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

$text = '';
$retuls = '';

if ($enable == 0) {
$doc = 'sdf';
}
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");
$ts = "[$timestamp1, $timestamp2]";

$text = null;
$retuls = null;


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

if ($alias == 0 && $ts_yes == 0) {
	$text = $pieces[4];
	$retuls = $text;
}
}
//echo($text);
if ($ts_LCL == 1) {
$change = file_get_contents("$pcl://$ip/textengine/sitechats/sendmsg_integration.php?write=$write&msg=$text&encode=UTF-8&referer=norefer&namer=");
} else {
$f = fopen($write, 'a');	
fwrite($f, $retuls);
fclose($f);
}
}
?>