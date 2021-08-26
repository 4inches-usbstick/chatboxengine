<h1>CBEData Getter</h1>
<h2>Verbose Mode</h2>
<hr>
<?php
include 'mainlookup.php';
$rdir = plsk(3);
$protec = explode('//', plsk(31));
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');


if (plsk(21) != 'YES') {
	die('[err:4] Stop: API is locked down.');
}

$data = file_get_contents("$rdir/sitechats/$_GET[src]");
$datapath = $_GET['path'];
$startfrom = "00";

if (strpos($data, 'begin CBEDATA') === false && plsk(57) == 'YES') {
    die("[err:24] Stop: CBEDATA files must begin with a declaration [PID 57]");
}

$protec = explode('//', plsk(31));
foreach ($protec as $i) {
	$iframe = 0;
	$iframe = substr_count(strtolower($_GET["src"]), $i);
	if ($iframe > 0) {
		die('[err:7] Stop: Illegal destination, halted');
	}
}



echo('<b>info</b><br>');
$split_datapath = explode(plsk(109), $datapath);
$layer = 0;
$lengthofpath = count($split_datapath) - 1;
echo("$split_datapath[$lengthofpath]<br><br>");
echo("$datapath<br><br>");

echo('<b>filepath info</b><br>');

for($x=0; $x<=count($split_datapath)-2; $x++) {
$startfrom = stripos($data,"class[$split_datapath[$layer]", $startfrom);
echo("$startfrom<br>");
$layer++;
}
echo('<b>range of chars, begin</b><br>');
echo("<br>$startfrom<br>");

$range2 = stripos($data, "]", $startfrom);
//$range2 = -1 * $range2;
echo('<b>range of chars, end</b><br>');
echo("<br>$range2<br>");
$length = $range2 - $startfrom;

echo('<b>class</b><br>');
$return = substr($data, $startfrom, $length);
//$return = substr($return, 0, -24);

echo("<br>$return<br><br>");
echo(strlen($return));
echo('<br>');

echo('<b>var assignment</b><br>');
$actualdata0 = explode(">", $return);
echo("$actualdata0[1]<br><br>");
$vars = $actualdata0[1];

$listofdata0 = explode(";", $vars);
$whatwewant = $split_datapath[$lengthofpath];
for($y=0; $y<=count($listofdata0)-1; $y++) {
if (strpos($listofdata0[$y], $whatwewant) != false) {
	$index = $y;
	echo("$index<br>");
}
}



echo('<b>var name</b><br>');
$actualdata1 = explode("==", $listofdata0[$index]);
echo("$actualdata1[0]<br>");
echo("<b>var value</b><br>");
echo($actualdata1[1]);
echo('<br>');

echo('<b>raw data</b><br>');
echo($data);
?>