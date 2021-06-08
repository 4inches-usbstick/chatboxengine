<?php
if ($_GET["cmd"] == "clist") {
	$chatboxes = glob("*");
	echo("All Chatboxes:<br><br>");
	foreach($chatboxes as $i) {
		if (is_dir($i)) {
		//echo("$i: DIR-SKIP<br>");
		goto skipexec1;
		} 
		//if is dir
		
		if (substr_count($i, ".") > 0 && substr_count($i, ".html") == 0 && substr_count($i, ".cbedata") == 0) {
		goto skipexec1;
		}
		//if there is a dot and it"s not HTML
		if (substr_count(wr_db(), $i) != 0) {
		$v = ' : protected';
		} else {
			$v = ' : open';
		}
		
		if (substr_count($i, ".html") > 0 || substr_count($i, ".") == 0) {
		echo("$i $v<br>\n"); 
		}
		//if there are no dots or it"s HTML
		skipexec1:
		
	}
	$fs = wr_db();
	echo("\n\n\n<br><br><br>filesafe list: $fs");
	
}
//cload
if ($_GET["cmd"] == "cload" && $_GET["pass"] == $pass) {
copy("$rdir/sitechats/copies/$_GET[params]", "$rdir/sitechats/$_GET[params]");
echo("Copied");
}
?>