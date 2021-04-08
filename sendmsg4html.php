Diags<br>
<?php
include 'mainlookup.php';
if (plsk(21) != 'YES') {
	die('API is locked down.');
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
	

date_default_timezone_set(plsk(9));
//error_reporting(0);
if (file_exists($_GET['write'])) {
	$myfile = fopen("$_GET[write]", "a");
} else {
	die('This chatbox does not actually exist');
}

//check for iframes or js, security measure
$iframe = substr_count($_GET["msg"], 'iframe');
$script = substr_count($_GET["msg"], 'script');
$scrit = substr_count($_GET["write"], '.hta');

if ($iframe > 0 or $script > 0) {
	die("[err:6] Illegal element found in string detected, halted.<br>");
}

if ($scrit > 0) {
	die('[err:7] Stop: illegal destination')
}

if (plsk(75) == 'YES' && !empty($_GET['uid'])) {
if (substr_count(ga(), "$_GET[write] deny from $_GET[uid]") > 0 || substr_count(ga(), "WILDCARD-ALL deny from $_GET[uid]") > 0) {
	die("[err:11] Stop: This UID ($_GET[uid]) is locked out from this chatbox");
}
}

//end that


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

$option = $_GET["option"];

if ($option == "h1") { 
$mess2 = "<h1>$mess1</h1>";
}

if ($option == "h2") { 
$mess2 = "<h2>$mess1</h2>";
}

if ($option == "h3") { 
$mess2 = "<h3>$mess1</h3>";
}

if ($option == "h4") { 
$mess2 = "<h4>$mess1</h4>";
}

if ($option == "h5") { 
$mess2 = "<h5>$mess1</h5>";
}

if ($option == "h6") { 
$mess2 = "<h6>$mess1</h6>";
}
//sdf
if ($option == "p") { 
$mess2 = "<p>$mess1</p>";
}

if ($option == "b") { 
$mess2 = "<b>$mess1</b><br>";
}

if ($option == "i") { 
$mess2 = "<i>$mess1</i><br>";
}

if ($option == "a") { 
$mess2 = "<a href=\"$mess1\">$mess1</a><br>";
}

if ($option == "img") { 
$mess2 = "<a href='$mess' tarGET='_blank'><img src=\"$mess1\" alt='error loading this image' style=\"max-height: 216px;  max-width: 384px;\"></img></a><br>";
}

if ($option == "video") { 
$mess2 = "<video width=\"384\" height=\"216\" controls> <source src=\"$mess1\" type=\"video/mp4\"></video><br>";
}

if ($option == "audio") { 
$mess2 = "<audio controls> <source src=\"$mess1\" type=\"audio/mpeg\"></audio><br>";
}

if ($option == "break") { 
$mess2 = "<br>";
}


if ($option == "pt") { 
$mess2 = "$mess1<br>";
}

if ($option == "c") { 
$mess2 = "<code>$mess1</code><br>";
}

if ($option == "u") { 
$mess2 = "<u>$mess1</u><br>";
}

if ($option == "s") { 
$mess2 = "<s>$mess1</s><br>";
}


fwrite($myfile, "$mess2\n");
fclose($myfile);
echo("submitted<br>");
$URL = $_SERVER['HTTP_REFERER'];
header("Location: $URL");
echo("$coder encoder<br>");
echo("$mess1 = message<br>");
echo("$mess2 = messageHTML<br>");

?>

<p></p>
<form>
 <input type="button" value="Back" onclick="history.back()">
</form>


