<title>engine page</title>

<?php
$pass = file_get_contents('.htapassword');
include 'mainlookup.php';
$rdir = plsk(3);
if (plsk(21) != 'YES') {
	die('API is locked down.');
}

$useduid = false;

if (empty($_GET['uid']) || empty($_GET['ukey'])) {
	goto skipverify;
}

if (uidlsk($_GET['uid'], $_GET['ukey']) && uid($_GET['uid'], $_GET['ukey'], 3) == 'sudo') {
	$_GET['key'] = $pass;
	$useduid = true;
}

if (uidlsk($_GET['uid'], $_GET['ukey']) && uid($_GET['uid'], $_GET['ukey'], 3) != 'sudo') {
	echo('You are not a sudo user.<br>');
}

skipverify:
if ($_GET["key"] == $pass and $useduid == false) {
	echo("Logged in with Master Password<br>");
}
if ($_GET["key"] == $pass and $useduid == true && plsk(41) == 'YES') {
	die('Stop: UID/UKEY users cannot edit');
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
		die('Stop: Illegal element in string detected, halted');
	}
}

if (empty($_GET['type'])) {
	$type = 'all';
}


if ($type == 'all') {
if ($_GET["key"] == $pass) {
$thecb = $_GET["cb"];
$getridof = $_GET["gro"];
$replacewith = $_GET["rw"];
$path = "$rdir/sitechats/$thecb";
echo("abs path in: $path<br>");
echo("rel path in: $thecb<br>");
echo("str to edit: $getridof<br>");
echo("str for overwrite: $replacewith<br>");
$homepage = file_get_contents("$path");
$onlyconsonants = str_replace($getridof, $replacewith, $homepage);
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



} else {
echo("Incorrect or missing password. This command failed to execute.");
}
} else {



if ($_GET["key"] == 'sekjhasdljkfhsladkjfhsakdjhlsdkhfklasdjfhklsadjfh') {
$thecb = $_GET["cb"];
$getridof = $_GET["gro"];
$replacewith = $_GET["rw"];
$leadpath = 'textengine/sitechats';
$path = "http://71.255.240.10:8080/textengine/sitechats/$thecb";
//echo("abs path in: $path<br>");
//echo("rel path in: $thecb<br>");
echo("[p mode] str to edit: $getridof<br>");
echo("str for overwrite: $replacewith<br>");
$homepage = file_get_contents("$path");
$offset = strpos($homepage, $getridof);
$offset0 = strpos($homepage, PHP_EOL, $offset);
echo("<b>$offset0<br>$offset0</b>");
$offset0f = $offset0 - $offset;
$onlyconsonants = substr_replace($homepage, $replacewith, $offset, $offset0f);
//echo("Echo new/old strs: false");
echo("new str: $onlyconsonants<br>");
echo("old str: $homepage<br>");
file_put_contents($thecb, $onlyconsonants);

echo("<br>output:");
if ($homepage == $onlyconsonants) {
	echo("<br>Found 0 instances.");
} else {
	echo("<br>Found at least 1 instance of");
}



} else {
echo("This function does not work and has been disabled");
}

}

?>