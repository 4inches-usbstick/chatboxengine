<?php
if ($_GET['cmd'] == 'cmd add' && $_GET['pass'] == $pass) {
	if ($useduid) {
		die('[err:23] Stop: Master password required to run cmd add command');
	}
	$ps = explode(';', $_GET['params']);
	$f = file_get_contents('.htamainpolicy');
	$pos = strpos($f, '[END C-CMD]');
	$newc = str_replace("[END C-CMD]", "$ps[0]::$ps[1]::$ps[2]::$ps[3];\n[END C-CMD]", $f);
	file_put_contents('.htamainpolicy', $newc);
}
if ($_GET['cmd'] == 'cmd del' && $_GET['pass'] == $pass) {
	if ($useduid) {
		die('[err:23] Stop: Master password required to run cmd del command');
	}
	$ps = explode(';', $_GET['params']);
	$f = file_get_contents('.htamainpolicy');
	$pos = strpos($f, '[END C-CMD]');
	$newc = str_replace("$ps[0]::$ps[1]::$ps[2]::$ps[3];", "", $f);
	file_put_contents('.htamainpolicy', $newc);
}
?>