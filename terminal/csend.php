<?php
if ($_GET["cmd"] == "csend" && $_GET["pass"] == $pass) {
$conditions = explode(';', $_GET['params']);
$f = fopen($conditions[0], 'a');
$conditions[1] = str_replace("%nl","\n", $conditions[1]);
fwrite($f, "$conditions[1]\n");
fclose($f);
echo("Wrote '$conditions[1]' to $conditions[0]");
}
//send
if ($_GET["cmd"] == "csend --nobreak" && $_GET["pass"] == $pass) {
$conditions = explode(';', $_GET['params']);
$f = fopen($conditions[0], 'a');
fwrite($f, "$conditions[1]");
fclose($f);
echo("Wrote '$conditions[1]' to $conditions[0]");
}
?>