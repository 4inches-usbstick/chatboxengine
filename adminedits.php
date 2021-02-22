<title>engine page</title>

<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');

$pass = file_get_contents('C:/wamp64/www/textengine/sitechats/.htapassword');
$iframe = substr_count(strtolower($_GET["rw"]), 'iframe');
$script = substr_count(strtolower($_GET["rw"]), 'script');

if ($iframe > 0 or $script > 0) {
	die("Illegal element found in string detected, halted.<br>");
}
if (empty($_GET['type'])) {
	$type = 'all';
}


if ($type == 'all') {
if ($_GET["key"] == $pass) {
$thecb = $_GET["cb"];
$getridof = $_GET["gro"];
$replacewith = $_GET["rw"];
$leadpath = 'textengine/sitechats';
$path = "http://71.255.240.10:8080/textengine/sitechats/$thecb";
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