
<?php
include 'mainlookup.php';
$protec = explode('//', plsk(31));
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');


$rdir = plsk(3);
$data = file_get_contents("$rdir/sitechats/$_GET[src]");

$data = str_replace('^[', '{special}1',$data);
$data = str_replace('^]', '{special}2',$data);
$data = str_replace('^==', '{special}3',$data);
$data = str_replace('^>', '{special}4',$data);
$data = str_replace('^;', '{special}5',$data);


//error_reporting(0);
//$data = file_get_contents("C:/wamp64/www/textengine/sitechats/$_GET[src]");
$datapath = $_GET['path'];
$startfrom = "00";

if (plsk(21) != 'YES') {
	die('[err:4] Stop: API is locked down.');
}
if (strpos($data, 'begin CBEDATA') === false && plsk(57) == 'YES') {
    die("[err:24]Stop: CBEDATA files must begin with a declaration [PID 57]");
}

$protec = explode('//', plsk(31));
foreach ($protec as $i) {
	$iframe = 0;
	$iframe = substr_count(strtolower($_GET["src"]), $i);
	if ($iframe > 0) {
		die('[err:7] Stop: Illegal destination, halted');
	}
}

$getclass = $_GET['type'];
if (empty($_GET['type'])) {
die('[err:25] Stop: missing data type, no data can be given.');
}


//echo('<b>info</b><br>');
$split_datapath = explode("-", $datapath);
$layer = 0;
$lengthofpath = count($split_datapath) - 1;
//echo("$split_datapath[$lengthofpath]<br><br>");
//echo("$datapath<br><br>");

//echo('<b>filepath info</b><br>');

for($x=0; $x<=count($split_datapath)-2; $x++) {
$startfrom = stripos($data,"class[$split_datapath[$layer]", $startfrom);
//echo("$startfrom<br>");
$layer++;
}
//echo('<b>range of chars, begin</b><br>');
//echo("<br>$startfrom<br>");

$range2 = stripos($data, "]", $startfrom);
//$range2 = -1 * $range2;
//echo('<b>range of chars, end</b><br>');
//echo("<br>$range2<br>");
$length = $range2 - $startfrom;

//echo('<b>class</b><br>');
$return = substr($data, $startfrom, $length);
//$return = substr($return, 0, -24);


//echo("<br>$return<br><br>");
//echo(strlen($return));
//echo('<br>');

//echo('<b>var assignment</b><br>');
$actualdata0 = explode(">", $return);
//echo("$actualdata0[1]<br><br>");
$vars = $actualdata0[1];

$listofdata0 = explode(";", $vars);
$whatwewant = $split_datapath[$lengthofpath];
for($y=0; $y<=count($listofdata0)-1; $y++) {
if (strpos($listofdata0[$y], $whatwewant) != false) {
	$index = $y;
	//echo("$index<br>");
}
}



//echo('<b>var name</b><br>');
$actualdata1 = explode("==", $listofdata0[$index]);
//echo("$actualdata1[0]<br>");
//echo("<b>var value</b><br>");
if ($getclass == 'var') {
	$listofdata0[$index] = str_replace('{special}1', '[',$listofdata0[$index]);
	$listofdata0[$index] = str_replace('{special}2', ']',$listofdata0[$index]);
	$listofdata0[$index] = str_replace('{special}3', '==',$listofdata0[$index]);
	$listofdata0[$index] = str_replace('{special}4', '>',$listofdata0[$index]);
	$listofdata0[$index] = str_replace('{special}5', ';',$listofdata0[$index]);
	echo($listofdata0[$index]);
	die();
}
if ($getclass == 'attr') {
	$actualdata1[1] = str_replace('{special}1', '[',$actualdata1[1]);
	$actualdata1[1] = str_replace('{special}2', ']',$actualdata1[1]);
	$actualdata1[1] = str_replace('{special}3', '==',$actualdata1[1]);
	$actualdata1[1] = str_replace('{special}4', '>',$actualdata1[1]);
	$actualdata1[1] = str_replace('{special}5', ';',$actualdata1[1]);
	echo($actualdata1[1]);
	die();
}

if ($getclass == 'attr-name') {
	$actualdata1[0] = str_replace('{special}1', '[',$actualdata1[0]);
	$actualdata1[0] = str_replace('{special}2', ']',$actualdata1[0]);
	$actualdata1[0] = str_replace('{special}3', '==',$actualdata1[0]);
	$actualdata1[0] = str_replace('{special}4', '>',$actualdata1[0]);
	$actualdata1[0] = str_replace('{special}5', ';',$actualdata1[0]);
	echo($actualdata1[0]);
	die();
}

if ($getclass == 'class') {
	$return = str_replace('{special}1', '[',$return);
	$return = str_replace('{special}2', ']',$return);
	$return = str_replace('{special}3', '==',$return);
	$return = str_replace('{special}4', '>',$return);
	$return = str_replace('{special}5', ';',$return);
	echo($return);
	die();
}

if ($getclass == 'raw') {
	$data = str_replace('{special}1', '[',$data);
	$data = str_replace('{special}2', ']',$data);
	$data = str_replace('{special}3', '==',$data);
	$data = str_replace('{special}4', '>',$data);
	$data = str_replace('{special}5', ';',$data);
	echo($data);
	die();
}

if ($getclass != 'var' and $getclass != 'attr' and $getclass != 'attr-name' and $getclass != 'class' and $getclass != 'raw') {
		echo('[err:25] Stop: unspecified data type, no data can be given.');
		die();
}
//echo('<br>');

//echo('<b>raw data</b><br>');
//echo($data);
?>