<?php
if ($_GET["cmd"] == "wipe" and $_GET["pass"] == $pass) {
	
	$banned = file_get_contents(".htaterminalaccess");
	$script = substr_count($banned, $params);
	
	if ($script > 0) {
	die("[err:29] Stop: This Chatbox is protected and thus cannot be wiped.<br>");
}
	
	$f1 = fopen($params, "w");
	fwrite($f1, "");
	fclose($f1);
	echo("Chatbox wiped.");
	
	
}
?>