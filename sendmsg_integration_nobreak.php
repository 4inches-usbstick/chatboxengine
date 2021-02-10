Diags (REMOTE SENDING PAGE)
<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');


error_reporting(0);
sleep(1.5);
date_default_timezone_set('America/New_York');
//error_reporting(0);
if (file_exists($_GET['write'])) {
	$myfile = fopen("$_GET[write]", "a");
} else {
	die('This chatbox does not actually exist');
}

//check for iframes or js, security measure
$iframe = substr_count(strtolower($_GET["msg"]), 'iframe');
$script = substr_count(strtolower($_GET["msg"]), 'script');

if ($iframe > 0 or $script > 0) {
	die("Illegal element found in string detected, halted.<br>");
}
//end that


//ts on?
$contents = file_get_contents("C:/wamp64/www/textengine/sitechats/$_GET[write]");
//echo("$contents, C:/wamp64/www/textengine/sitechats/$_GET[write]");
$needle = "rule.Timestamps(1)";
$timestamps = strpos("$contents", "rule.Timestamps(1)");
echo("<br><br>timestamps at $timestamps<br>");

//encoding yes
$mess = $_GET["msg"];
$emptyencode = empty($_GET["encode"]);
$coder = $_GET["encode"];

if (empty($coder) or $coder == "UTF-8") {
    //echo('UTF8');
	$coder = "UTF-8";
}





$mess = $_GET["msg"];
$mess1 = mb_convert_encoding($mess, $coder);



//$ip = $_SERVER['REMOTE_ADDR'];
//yes ts
$name = $_GET["namer"];

if ($timestamps != "") {
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");
$txt = "$name [$timestamp1, $timestamp2]: $mess1";

//break check
if ($mess1 == "^^br") {
    $txt = "";
}

if (empty($name)) {
    $txt = "[$timestamp1, $timestamp2]: $mess1";
}


//end name gap checker
fwrite($myfile, "$txt");
fclose($myfile);
echo("submitted<br>");
echo("$coder encoder<br>");
echo("$mess1 = message<br>");
echo("$URL = referer<br>");


//no ts
} else {
$txt = "$name: $mess1";

//break check
if ($mess1 == "^^br") {
    $txt = "";
}

if (empty($name)) {
    $txt = $mess1;
}


fwrite($myfile, "$txt");
fclose($myfile);
echo("submitted<br>");

echo("$coder encoder<br>");
echo("$mess1 = message<br>");
echo("$URL = referer<br>");


}

//echo(file_get_contents("C:/wamp64/www/textengine/sitechats/.htabannednumbers"));

?>

<p></p>


