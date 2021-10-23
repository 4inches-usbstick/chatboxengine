<?php
$te = plsk(3);
$sc = plsk(107);
if ($_GET['cmd'] == 'validatormgr' && $_GET['pass'] == $pass) {
	$params = explode('/', $_GET['params']); // validator add 1943/mode:GATEMODE
	$f = fopen("$te/$sc/media/$params[0]/uploaded/.htafiletxpolicy", "a");
	fwrite($f, $params[1] . "\n");
	fclose($f);
	echo("$te/$sc/media/$params[0]/uploaded/.htafiletxpolicy");
}
?>