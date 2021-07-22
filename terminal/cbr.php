<?php
$sc = plsk(107);
if ($_GET["cmd"] == "cbroadcast" && $_GET["pass"] == $pass) {
	$chatboxes = glob("*");
	echo("FILE LIST:<br><br>");
	foreach($chatboxes as $i) {
		if (is_dir($i)) {
		echo("$i: DIR-SKIP<br>");
		goto skipexec;
		} 
		//if is dir
		
		if (substr_count($i, ".") > 0 && substr_count($i, ".html") == 0) {
		echo("$i: FILE-SKIP<br>"); 
		goto skipexec;
		}
		//if there is a dot and it"s not HTML
		
		if (substr_count($i, ".html") > 0 || substr_count($i, ".") == 0) {
		echo("$i: WRITE<br>"); 
		
		if ($_GET["params"] == "DRYRUN") {
			echo("$i: DRYRUN-SKIP<br>");
			goto skipexec;
		}
		$g = fopen($i, "a");
		fwrite($g, "$_GET[params]\n");
		fclose($g);
		}
		//if there are no dots or it"s HTML
		skipexec:
		
	}
	
}
?>