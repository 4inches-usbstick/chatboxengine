<?php
if ($_GET["cmd"] == "banhammer" and $_GET["pass"] == $pass) {
	$towrite = plsk(27);
	$tofile = plsk(25);
	$f1 = fopen($tofile, "a");
	$tt = str_replace('%ip', $_GET['params'], $towrite);
	fwrite($f1, "$tt\n");
	echo(str_replace('%ip', $_GET['params'], $towrite) . '<br>');
	fclose($f1);
	echo("IP banned: $_GET[params]");
}
?>