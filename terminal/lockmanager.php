<?php
if ($_GET['cmd'] == 'lock add' && $_GET['pass'] == $pass) {
	if ($useduid && plsk(73) != 'YES') {
		die('[err:23] Stop: Master password required to run lock add command');
	}
	$f = file_get_contents('.htamainpolicy');
	//$pos = strpos($f, '[END UIDUKEY LOCKOUT]');
	$newc = str_replace('[END UIDUKEY LOCKOUT]', "$_GET[params]\n[END UIDUKEY LOCKOUT]", $f);
	file_put_contents('.htamainpolicy', $newc);
	//echo $newc;
}
if ($_GET['cmd'] == 'lock del' && $_GET['pass'] == $pass) {
	if ($useduid && plsk(73) != 'YES') {
		die('[err:23] Stop: Master password required to run lock del command');
	}
	$f = file_get_contents('.htamainpolicy');
	$pos = strpos($f, '[END UIDUKEY LOCKOUT]');
	$newc = str_replace("$_GET[params]", "", $f);
	file_put_contents('.htamainpolicy', $newc);
}
?>