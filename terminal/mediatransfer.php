<?php
//media copy
if ($_GET["cmd"] == "mcopy" && $_GET["params"] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("$rdir/sitechats/media/");
	$medirs = glob("*", GLOB_ONLYDIR);
	
	foreach($medirs as $i) {
		print("$i<br>");
		ccp("$rdir/sitechats/media/$i/uploaded", "$mcc/$i");
		echo("Copied Media Dir");
	}
}
if ($_GET["cmd"] == "mcopy" && $_GET["params"] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("$rdir/sitechats/media/");
		ccp("$rdir/sitechats/media/$_GET[params]/uploaded", "$mcc/$_GET[params]");
echo("Copied Media Dir");
}
//media delete
if ($_GET["cmd"] == "mdel" && $_GET["params"] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("$rdir/sitechats/media/");
	delete_directory("$rdir/sitechats/media/$_GET[params]");
	$ff1 = rmdir("$rdir/sitechats/media/$_GET[params]");
	echo("Deleted Media Dir");
}
if ($_GET["cmd"] == "mdel" && $_GET["params"] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo("Notice: WILDCARD-ALL REMOVES ALL MEDIA DIRS<br>");
	chdir("$rdir/sitechats/media/");
	$medirs = glob("*", GLOB_ONLYDIR);
	foreach($medirs as $i) {
	delete_directory("$rdir/sitechats/media/$i");
	$ff1 = rmdir("$rdir/sitechats/media/$i");
	echo("Deleted Media Dir");
}
}
//media reload
if ($_GET["cmd"] == "mload" && $_GET["params"] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo("Notice: MEDIA DIRECTORIES MUST EXIST BEFORE YOU LOAD THEM");
	chdir("$rdir/sitechats/copies/media/");
	$medirs = glob("*", GLOB_ONLYDIR);
	
	foreach($medirs as $i) {
		echo("$i<br>");
		ccp("$mcc/$i", "$rdir/sitechats/media/$i/uploaded");
		echo("Loaded Media Dir");
	}
}
if ($_GET["cmd"] == "mload" && $_GET["params"] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo("Notice: MEDIA DIRECTORIES MUST EXIST BEFORE YOU LOAD THEM");
	chdir("$rdir/sitechats/copies/media/");
		ccp("$mcc/$_GET[params]", "$rdir/sitechats/media/$_GET[params]/uploaded");
		echo("Loaded Media Dir");
}
//mkdir
if ($_GET["cmd"] == "mkdir" && $_GET["pass"] == $pass) {
	echo("Notice: EXISTING MEDIA DIRS MAY BE OVERWRITTEN");
	mkdir("$rdir/sitechats/media/$_GET[params]", 0700);
	mkdir("$rdir/sitechats/media/$_GET[params]/uploaded", 0700);
		echo("Made directory");
}
?>