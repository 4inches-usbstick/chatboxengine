<?php

//error_reporting(1);
include 'mainlookup.php';
error_reporting(0);

$rdir = plsk(3);
$dots = plsk(23);
$nogo = explode('//', plsk(29));
$protec = explode('//', plsk(31));
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, GET, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');

if (!function_exists('str_starts_with')) {
    function str_starts_with($haystack, $needle) {
          return strpos($haystack, $needle) === 0;
    }
}

if (plsk(65) == 'YES') {
function sendcmd($tp) {
	$ff = str_replace("[BEGIN C-CMD]", "", gs());
	$ff = preg_replace("/\s\s+/", "", $ff);  //thank you to this question (https://stackoverflow.com/questions/3760816/remove-new-lines-from-string-and-replace-with-one-empty-space) for the regex
	$a = explode(';', $ff);
	print_r($a);
	//$f = array_slice($a, -1);
	$f = $a;
	echo(count($f) . '<br>');
	foreach ($f as $i) {
		//echo('trigger<br>');
		$i = substr_replace($i, "event", 0,0);
		//$i = substr($i, 1);
		echo $i . '<br>';
		$args = explode('::', $i);
		echo(count($args) . ' items<br>');
		//echo($i . '<br>');
		if ($args[0] != 'event@Pre' && $args[0] != 'event@Mid' && $args[0] != 'event@POST' && $i != 'event') {
			echo("[err:1] Stop: EXECUTIONPOINT error, $args[0] is not a valid execution point in '$i'<br>");
			die();
		}
		if ($args[1] != 'BEGINSWITH' && $args[1] != 'HAS' && $i != 'event') {
			echo("[err:2] Stop: CHECKCONDITION error, $args[1] is not a valid CHECKCONDITION in '$i'<br>");
			die();
		}
		if (!file_exists($args[3]) && $i != 'event') {
			echo("[err:3] Stop: FILEOPEN error, $args[3] does not exist in '$i'<br>");
			die();
		}
		
		if ($args[0] == $tp && $i != 'event') {
			if ($args[1] == 'BEGINSWITH') {
				if (str_starts_with($_GET['msg'], $args[2])) {
					include $args[3];
					//echo($i);
				}
			}
			if ($args[1] == 'HAS') {
				//echo('sdf');
				if (substr_count($_GET["msg"], $args[2]) > 0) {
					include $args[3];
					//echo($i);
				}
			}
		} else {
			$b = 'b';
		}
		
	}
}
}

if (plsk(21) != 'YES') {
	die('[err:4] API is locked down.');
}

if (plsk(67) == 'YES') {
sendcmd('event@Pre');
}

date_default_timezone_set(plsk(9));
error_reporting(1);
if (file_exists($_GET['write'])) {
	$myfile = fopen("$_GET[write]", "a");
} else {
	die('[err:5] Stop: This chatbox does not actually exist');
}

//banned words checker
foreach ($nogo as $i) {
	$iframe = 0;
	$iframe = substr_count(strtolower($_GET["msg"]), $i);
	if ($iframe > 0) {
		die('[err:6] Stop: Illegal element in string detected, halted');
	}
}
//illegal destination checker
foreach ($protec as $i) {
	$iframe = 0;
	$iframe = substr_count(strtolower($_GET["write"]), $i);
	if ($iframe > 0) {
		die('[err:7] Stop: Illegal destination, halted');
	}
}
	if (empty($_GET['namer'])) {
		$_GET['namer'] = 'PHR-NUL';
	}
	if (substr_count(uid_db(), $_GET['namer']) != 0) {
	//echo('Name found in UID pool<br>');
	$b = 'b';
	}
//no keypair there
	if ((empty($_GET['uid']) || empty($_GET['ukey'])) && substr_count(uid_db(), $_GET['namer']) > 0) {
		die('[err:16] Stop: No UKEY');
	}
//keypair there, but not right
	if (uidlsk($_GET['uid'], $_GET['ukey']) == false && substr_count(uid_db(), $_GET['namer']) != 0) {
		die('[err:16] Stop: invalid UKEY');
	}
//name in and right UID/UKEY pair
	if (uidlsk($_GET['uid'], $_GET['ukey']) == true && substr_count(uid_db(), $_GET['namer']) != 0) {
		echo('UID ' . $_GET['uid'] . ' used to send a message as ' . uid($_GET['uid'], $_GET['ukey'], 1));
		$_GET['namer'] = uid($_GET['uid'], $_GET['ukey'], 1);
	}

//write protecc?
	if (substr_count(wr_db(), $_GET['write']) != 0) {
		echo('File protected, checking permissions...<br>');
		//user didnt try to authenticate
		if (empty($_GET['uid']) || empty($_GET['ukey'])) {
			die('[err:8] Stop: Protected file and no UID/UKEY');
		}
		//user did try and got it
		if (uidlsk($_GET['uid'], $_GET['ukey']) == true) {
			//only login
			//echo(wr_bycb($_GET['write'], 2));
			if (wr_bycb($_GET['write'], 2) == 'login') {
				$b = 'c';
			}
			//local needed
			if (wr_bycb($_GET['write'], 2) == 'local') {
				die('[err:9] Stop: Protected file with local access only.');
			}
			//sudo needed and not provided
			if (wr_bycb($_GET['write'], 2) == 'sudo' && uid($_GET['uid'], $_GET['ukey'], 3) != 'sudo') {
				die('[err:10] Stop: Protected file with sudo access only.');
			}
			//sudo needed and was provided
			if (wr_bycb($_GET['write'], 2) == 'sudo' && uid($_GET['uid'], $_GET['ukey'], 3) == 'sudo') {
				$b = 'd';
			}
		}
		//user did try but did not GET it
		if (uidlsk($_GET['uid'], $_GET['ukey']) == false) {
			die('[err:8] Stop: Protected file and invalid UID/UKEY');
		}
	} else {
		echo('File not protected<br>');
		//echo(wr_db() . '<b>d</b><br>');
	}

if (plsk(75) == 'YES' && !empty($_GET['uid'])) {
if (substr_count(ga(), "$_GET[write] deny from $_GET[uid]") > 0 || substr_count(ga(), "WILDCARD-ALL deny from $_GET[uid]") > 0) {
	die("[err:11] Stop: This UID ($_GET[uid]) is locked out from this chatbox");
}
}

if (plsk(69) == 'YES') {
sendcmd('event@Mid');
}
//ts on?
if ($dots == 'YES') {
$contents = file_GET_contents("$rdir/sitechats/$_GET[write]");
//echo("$contents, C:/wamp64/www/textengine/sitechats/$_GET[write]");
$needle = "rule.Timestamps(1)";
$timestamps = strpos("$contents", "rule.Timestamps(1)");
echo("<br><br>timestamps at $timestamps<br>");
}

if (plsk(33) == 'YES') {
//encoding yes
$mess = $_GET["msg"];
if (empty($_GET["encode"])) {
	$_GET['encode'] = 'UTF-8';
}
$mess = mb_convert_encoding($mess, $_GET['encode']);
}

$URL = $_GET["rurl"];
//set return url
$returnbool = 1;
if ($URL == "norefer") {
	$returnbool = "no";
}

$name = $_GET['namer'];
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");

if ($timestamps != "" && !empty($name) && $name != 'PHR-NUL') {
$txt = "$name [$timestamp1, $timestamp2]: $mess";
}
if ($timestamps != "" && !empty($name) && $name == 'PHR-NUL') {
$txt = "[$timestamp1, $timestamp2]: $mess";
}
if ($timestamps != "" && empty($name)) {
$txt = "[$timestamp1, $timestamp2]: $mess";
}
if ($timestamps == "" && !empty($name) && $name != 'PHR-NUL') {
$txt = "$name: $mess";
}
if ($timestamps == "" && !empty($name) && $name == 'PHR-NUL') {
$txt = "$mess";
}
if ($timestamps == "" && empty($name)) {
$txt = "$mess";
}

fwrite($myfile, "$txt\n");
fclose($myfile);
echo("submitted<br>");


if (plsk(71) == 'YES') {
sendcmd('event@Pst');
}


//echo("$coder encoder<br>");
//echo("$mess1 = message<br>");
//echo("$URL = referer<br>");

?>

<p></p>

