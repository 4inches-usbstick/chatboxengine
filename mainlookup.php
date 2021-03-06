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
?>