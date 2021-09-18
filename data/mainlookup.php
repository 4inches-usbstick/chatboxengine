<?php
$regpath = "C:/wamp64/www/textengine/sitechats/.htamainpolicy";
const br = '<br>';
//get the value of a policy
function plsk($pid) {
	global $regpath;
	$f = file_get_contents("$regpath");
	$fs = explode('::', $f);
	return $fs[$pid];
}

function customreturn($section) {
	global $regpath;
	$f = file_get_contents("$regpath");
	$offset0 = strpos($f, "[BEGIN $section]");
	$offset1 = strpos($f, "[END $section]");
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;

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
//get group info
function group_db() {
	global $regpath;
$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN GROUPS]');
	$offset1 = strpos($f, '[END GROUPS]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	return $fs;
}
//echo group_db();
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
	if ($attrno < 3) {
	return $userats[$attrno];
	}
	
	if ($attrno == 3) {
	$groupsin = explode('//', $userats[3]);
	
	//users can be in multiple groups.
	$cs = 0;
	$has = False;
	while($cs < count($groupsin)) {
	$sssi = $groupsin[$cs];
	//echo $sssi . br;
	if (strlen($sssi) < 2) {
		die('[err:33] Stop: group names of one char or less are illegal.');
		return('notsudo');
	}
	//print_r($groupsin);
	//echo br;
	//echo "$sssi give sudo";
	//echo br;
	//echo "index: $cs";
	//echo br;
	if (substr_count(group_db(), "$sssi give sudo") > 0) {
		return 'sudo';
		$has = True;
	}
	$cs = $cs + 1;
	}
	if (!$has) {
		return 'notsudo';
	}
	
	}
	if ($attrno == 4) {
		return $userats[3];
	}
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

$text = null;
$retuls = null;

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