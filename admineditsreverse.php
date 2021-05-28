<title>engine page</title>

<?php
$pass = file_get_contents('.htapassword');
include 'mainlookup.php';
$rdir = plsk(3);
if (plsk(21) != 'YES') {
	die('[err:4] Stop: API is locked down.');
}

function str_replace_index( $search , $replace , $st , $index ) {
	$stillon = True;
	$rlist = array();
	$offset = 0;
	$str = '/' . $st;
	echo('executing...');
	while (strpos($str,$search,$offset)) {
		$k = strpos($str,$search,$offset);
		print_r('NEW OFFSET: ' . $k . '<br>');
		array_push($rlist,$k);
		$offset = $k + 1;
		if ($offset === False) {
			#print_r('OFFSET: ' . $stillon);
			$stillon = False;
		}
	}
	
		if ($index == -1) {
			$index = count($rlist) - 1;
		}
		
	
	if (!array_key_exists($index, $rlist)) {
		echo("[err:39] Stop: invalid index for adminedits");
		return $st;
	}
	
	if (count($rlist) != 0) {
	$tr = substr_replace($str, $replace, $rlist[$index], strlen($search));
	return ltrim($tr,'/');
	} else {
		echo("[warn:37] Unable to locate replacement string (0 instance)<br>\n");
	}
	

}



$useduid = false;
if (empty($_GET['index'])) {
	$ine = 0;
} else {
	$ine = $_GET['index'];
}
if (empty($_GET['uid']) || empty($_GET['ukey'])) {
	goto skipverify;
}

if (uidlsk($_GET['uid'], $_GET['ukey']) && uid($_GET['uid'], $_GET['ukey'], 3) == 'sudo') {
	$_GET['key'] = $pass;
	$useduid = true;
}

if (uidlsk($_GET['uid'], $_GET['ukey']) && uid($_GET['uid'], $_GET['ukey'], 3) != 'sudo') {
	echo('[err:21] Stop: You are not a sudo user.<br>');
}

skipverify:
if ($_GET["key"] == $pass and $useduid == false) {
	echo("Logged in with Master Password<br>");
}
if ($_GET["key"] == $pass and $useduid == true && plsk(41) == 'YES') {
	die('[err:23] Stop: UID/UKEY users cannot edit');
}
if ($_GET["key"] == $pass and $useduid == true && plsk(41) == 'NO') {
	echo('PID41 ok<br>');
}

$dots = plsk(23);
$nogo = explode('//', plsk(29));
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');

foreach ($nogo as $i) {
	$iframe = 0;
	$iframe = substr_count(strtolower($_GET["rw"]), $i);
	if ($iframe > 0) {
		die('[err:6] Stop: Illegal element in string detected, halted');
	}
}

if (empty($_GET['type'])) {
	$type = 'all';
}


if ($type == 'all' && $_GET['cb'] != 'WILDCARD-ALL') {
if ($_GET["key"] == $pass) {
$thecb = $_GET["cb"];
$getridof = str_replace("%nl","\n", $_GET["gro"]);
$replacewith = str_replace("%nl","\n", $_GET["rw"]);
$path = "$rdir/sitechats/$thecb";
echo("abs path in: $path<br>");
echo("rel path in: $thecb<br>");
echo("str to edit: $getridof<br>");
echo("str for overwrite: $replacewith<br>");
$homepage = file_get_contents("$path");
$onlyconsonants = str_replace_index($getridof, $replacewith, $homepage, $ine);
echo("Echo new/old strs: false");
//echo("new str: $onlyconsonants<br>");
//echo("old str: $homepage<br>");
file_put_contents($thecb, $onlyconsonants);

echo("<br>output:");
if ($homepage == $onlyconsonants) {
	echo("<br>Found 0 instances.");
} else {
	echo("<br>Found at least 1 instance of");
}


//passcheck
} else {
echo("[err:16] Stop: Incorrect or missing password. This command failed to execute.");
}
}

//WILDCARD

if ($type == 'all' && $_GET['cb'] == 'WILDCARD-ALL' && plsk(63) == 'YES') {
if ($_GET["key"] == $pass) {
//$thecb = $_GET["cb"];
$getridof = $_GET["gro"];
$replacewith = $_GET["rw"];
$getridof = str_replace("%nl","\n", $_GET["gro"]);
$replacewith = str_replace("%nl","\n", $_GET["rw"]);
echo("str to edit: $getridof<br>");
echo("str for overwrite: $replacewith<br>");

$chatboxes = glob("*");
foreach($chatboxes as $i) {
	if (is_dir($i)) {
		echo("$i: DIR-SKIP<br>");
		goto skipexec;
		} 
		//if is dir
		
		//if is a file or html
		if (substr_count($i, ".") > 0 && substr_count($i, ".html") == 0) {
		echo("$i: FILE-SKIP<br>"); 
		goto skipexec;
		}
		
$homepage = file_get_contents($i);
$onlyconsonants = str_replace_index($getridof, $replacewith, $homepage, $ine);
//echo("Echo new/old strs: false");
//echo("new str: $onlyconsonants<br>");
//echo("old str: $homepage<br>");
file_put_contents($i, $onlyconsonants);

echo("<br>output:<br>");
if ($homepage == $onlyconsonants) {
	echo("Found 0 instances in Chatbox $i<br>");
} else {
	echo("Found at least 1 instance in Chatbox $i<br>");
}
skipexec:
}

} else {
echo("[err:16] Stop: Incorrect or missing password. This command failed to execute.");
}
}





?>