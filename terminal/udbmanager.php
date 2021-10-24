<?php
if (empty($_GET['params']))  {
	die('[err:30] Cannot have BLANK UID');
}
if ($_GET['cmd'] == 'udb add' && $_GET['pass'] == $pass) {
	if (plsk(51) == 'YES' && $useduid) {
		die('[err:23] Stop: Master password required to run udb add command (PID 51)');
	}
	$ps = explode(' ', $_GET['params']);
	//$c = uid_db();
	$f = file_get_contents('.htamainpolicy');
	//$pos = strpos($c, '0::1::2::3;');
	$newcc = str_replace("0::1::2::3;", "$ps[0]::$ps[1]::$ps[2]::$ps[3];\n0::1::2::3;", $f);
	//echo("<div style='white-space: pre;'>$newc</div>");
	//$newcc = str_replace(uid_db(), $newc, $f);
	file_put_contents('.htamainpolicy', $newcc);
}
if ($_GET['cmd'] == 'udb del' && $_GET['pass'] == $pass) {
	if (plsk(51) == 'YES' && $useduid) {
		die('[err:23] Stop: Master password required to run udb del command (PID 51)');
	}
	$ps = explode(' ', $_GET['params']);
	$f = file_get_contents('.htamainpolicy');
	$rrr = random_int(10000000, 99999999);
	$newcc = str_replace("$ps[0]::$ps[1]::$ps[2]::$ps[3];", "", $f);
	file_put_contents('.htamainpolicy', $newcc);
	if ($newcc == $f) {
		die('[warn:30] Warning: No user was found<br>');
	}
}
if ($_GET['cmd'] == 'udb sdel' && $_GET['pass'] == $pass) {
	if (plsk(51) == 'YES' && $useduid) {
		die('[err:23] Stop: Master password required to run udb sdel command (PID 51)');
	}
	$ps = explode(' ', $_GET['params']);
	$f = file_get_contents('.htamainpolicy');
	$rrr = random_int(10000000, 99999999);
	
	$ps[1] = uid($_GET['params'], "0", 1);
	$ps[2] = uid($_GET['params'], "0", 2);
	$ps[3] = uid($_GET['params'], "0", 4);
	
	echo "$ps[0]::$ps[1]::$ps[2]::$ps[3];";
	
	$newcc = str_replace("$ps[0]::$ps[1]::$ps[2]::$ps[3];", "", $f);
	file_put_contents('.htamainpolicy', $newcc);
	if ($newcc == $f) {
		die('[warn:30] Warning: No user was found<br>');
	}
}
?>