Diags (REMOTE SENDING PAGE)
<?php
error_reporting(1);
include 'mainlookup.php';

if (plsk(21) != 'YES') {
	die('API is locked down.');
}
//print uid_db();
//name in there?
	if (substr_count(uid_db(), $_GET['namer']) != 0) {
	//echo('Name found in UID pool<br>');
	$b = 'b';
	}
//no keypair there
	if ((empty($_GET['uid']) || empty($_GET['ukey'])) && substr_count(uid_db(), $_GET['namer']) > 0) {
		die('Stop: No UKEY');
	}
//keypair there, but not right
	if (uidlsk($_GET['uid'], $_GET['ukey']) == false && substr_count(uid_db(), $_GET['namer']) != 0) {
		die('Stop: invalid UKEY');
	}
//name in and right UID/UKEY pair
	if (uidlsk($_GET['uid'], $_GET['ukey']) == true && substr_count(uid_db(), $_GET['namer']) != 0) {
		echo('UID ' . $_GET['uid'] . ' used to send a message as ' . uid($_GET['uid'], $_GET['ukey'], 1));
	}
	


$rdir = plsk(3);
$dots = plsk(23);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');


date_default_timezone_set(plsk(9));
//error_reporting(1);
if (file_exists($_GET['write'])) {
	$myfile = fopen("$_GET[write]", "a");
} else {
	die('This chatbox does not actually exist');
}

//check for iframes or js, security measure
$iframe = substr_count(strtolower($_GET["msg"]), 'iframe');
$script = substr_count(strtolower($_GET["msg"]), 'script');
$scrip = substr_count(strtolower($_GET["write"]), '.hta');

if ($iframe > 0 or $script > 0) {
	die("Illegal element found in string detected, halted.<br>");
}

if ($scrip > 0) {
	die("Stop: illegal destination.<br>");
}
//end that





//ts on?
if ($dots == 'YES') {
$contents = file_get_contents("$rdir/sitechats/$_GET[write]");
//echo("$contents, C:/wamp64/www/textengine/sitechats/$_GET[write]");
$needle = "rule.Timestamps(1)";
$timestamps = strpos("$contents", "rule.Timestamps(1)");
echo("<br><br>timestamps at $timestamps<br>");
}

//encoding yes
$mess = $_GET["msg"];
$emptyencode = empty($_GET["encode"]);
$coder = $_GET["encode"];

if (empty($coder) or $coder == "UTF-8") {
    //echo('UTF8');
	$coder = "UTF-8";
}

$URL = $_GET["rurl"];
//set return url
$returnbool = 1;
if ($URL == "norefer") {
	$returnbool = "no";
}

$ref = $_SERVER['HTTP_REFERER'];
if (strpos($ref, 'inchat')) {
$URL = $ref;
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
fwrite($myfile, "$txt\n");
fclose($myfile);
echo("submitted<br>");
echo("$coder encoder<br>");
echo("$mess1 = message<br>");
echo("$URL = referer<br>");

if ($returnbool != "no") {
header("Location: $URL");
} else {
echo ("Will not return to referer");
}
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


fwrite($myfile, "$txt\n");
fclose($myfile);
echo("submitted<br>");

echo("$coder encoder<br>");
echo("$mess1 = message<br>");
echo("$URL = referer<br>");

if ($returnbool != "no") {
header("Location: $URL");
} else {
echo ("Will not return to referer");
}
}

//echo(file_get_contents("C:/wamp64/www/textengine/sitechats/.htabannednumbers"));

?>

<p></p>


