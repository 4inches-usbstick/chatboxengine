<?php
//$hostname = gethostbyaddr('71.255.240.10');
//echo $hostname;

include 'mainlookup.php';
$sc = plsk(107);
$rdir = plsk(3);
error_reporting(0);
clearstatcache();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, GET, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');


function r_bycb($cb, $attrno) {
	global $regpath;
	$f = file_get_contents("$regpath");
	$offset0 = strpos($f, '[BEGIN READSAFE]');
	$offset1 = strpos($f, '[END READSAFE]');
	$fs = substr($f, $offset0, $offset1 - $offset0);
	$fs = preg_replace("/\s\s+/", "", $fs); //thank you to this question (https://stackoverflow.com/questions/3760816/remove-new-lines-from-string-and-replace-with-one-empty-space) for the regex 
	$ffs = explode('::', $fs);
	$key = array_search($cb, $ffs);
	//echo "FOUND READSAFE: $key<br>\n";
	$key = $key + 1;
	return $ffs[$key];
}


if (substr_count(customreturn('READSAFE'), $_GET['chatbox']) != 0) {
		//echo('File protected, checking permissions...<br>');
		//user didnt try to authenticate
		if (empty($_GET['uid']) || empty($_GET['ukey'])) {
			header("HTTP/1.0 401 Unauthorized");
			die('[err:8] Stop: Read-protected file and no UID/UKEY');
		}
		//user did try and got it
		if (uidlsk($_GET['uid'], $_GET['ukey']) == true && r_bycb($_GET['chatbox'], 2)[0] != 'g') {
			//only login
			//echo(r_bycb($_GET['chatbox'], 2));
			if (r_bycb($_GET['chatbox'], 2) == 'login') {
				$b = 'c';
			}
			//local needed
			if (r_bycb($_GET['chatbox'], 2) == 'local') {
				header("HTTP/1.0 403 Forbidden");
				die('[err:9] Stop: No read access.');
			}
			//sudo needed and not provided
			if (r_bycb($_GET['chatbox'], 2) == 'sudo' && uid($_GET['uid'], $_GET['ukey'], 3) != 'sudo') {
								header("HTTP/1.0 403 Forbidden");
				die('[err:10] Stop: Read access available to sudo users only.');
			}
			//echo r_bycb($_GET['chatbox'], 2);
			//sudo needed and was provided
			if (r_bycb($_GET['chatbox'], 2) == 'sudo' && uid($_GET['uid'], $_GET['ukey'], 3) == 'sudo') {
				$b = 'd';
			}
		}
		//group declaration and user did get it and g declaration was on
		if (uidlsk($_GET['uid'], $_GET['ukey']) == true && r_bycb($_GET['chatbox'], 2)[0] == 'g') {
			$thing = explode(":", r_bycb($_GET['chatbox'], 2));
			$allowed = explode('//', $thing[1]);
			$count = 0;
			$yes = False;
			//print_r($allowed);
			while ($count < count($allowed)) {
				//if the allowed group appears in the user's groups
				$s = uid($_GET['uid'], $_GET['ukey'], 4);
				//echo("checking: $allowed[$count] in array object $s");
				//echo '<br><br>' . in_array($allowed[$count], explode('//', uid($_GET['uid'], $_GET['ukey'], 4)) , TRUE);
				if (in_array($allowed[$count], explode('//', uid($_GET['uid'], $_GET['ukey'], 4)) , TRUE)) {
					$yes = True;
				}
				$count = $count + 1;
			}
			if ($yes != True) {
								header("HTTP/1.0 403 Forbidden");
				die('[err:33] Stop: This group does not have read permissions.');
			}
			
		}
		//user did try but did not GET it
		if (uidlsk($_GET['uid'], $_GET['ukey']) == false) {
			header("HTTP/1.0 401 Unauthorized");
			die('[err:8] Stop: Invalid UID/UKEY and read protection');
		}
	}
	
	
	
	
	

if (empty($_GET['encode'])) {
	$_GET['encode'] = "UTF-8";
}



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');
$chatbox = "$rdir/$sc/$_GET[chatbox]";

$iframe = substr_count($_GET["chatbox"], '.hta');

if ($iframe > 0) {
	header("HTTP/1.0 403 Forbidden");
	die("[err:13] Stop: 403 Forbidden");
}

if ($_GET['divecho']) {
	echo('<div style="white-space: pre;">');
}
if (file_exists($chatbox)) {
$f = fopen($chatbox, 'rb');
$c = fread($f,filesize($chatbox));
fclose($f);
if ($_GET['encode'] != "none") {	
echo(mb_convert_encoding($c, $_GET['encode']));
} else {
echo($c);
}
} else {
	echo('[err:14] Stop: 404 Not Found');
	header("HTTP/1.0 404 Not Found");
}

if ($_GET['divecho']) {
	echo('</div>');
}
?>