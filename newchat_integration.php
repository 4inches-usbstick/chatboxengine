<title>engine page</title>

<?php
echo("This is a Chatbox Engine processing page. This page is part of the integration interface. </p></p><hr>");
error_reporting(0);
echo("<b>Attempting to create new chatbox</b><p></p>");
$ok = 1;

$filename = $_GET["newname"];

if (file_exists($filename)) {
    $ok = 0;
	echo("<b>Error: This chatbox number is in use.</b> <p></p>");
	die();
} else {
    echo("<p>[1] Complete </p> <p></p>");
}

$haystaq = file_get_contents('C:\wamp64\www\textengine\sitechats\.htabannednumbers');
$findme = $filename;
$pos = stristr($findme, ".");

if ($pos === false) {
    echo "[2] Complete<p></p>";
} else {
    echo "This is a forbidden Chatbox number";
	$ok = 0;
	die();
}



$haystaq = file_get_contents('C:\wamp64\www\textengine\sitechats\.htabannednumbers');
$findme = $filename;
$pos = strpos($haystaq, $findme);

if ($pos === false) {
    echo "[2] Complete<p></p>";
} else {
    echo "This is a forbidden Chatbox number";
	$ok = 0;
	die();
}

$option = $_GET['option'];
if ($option == "h") { 
$new = "$_GET[newname].html";
}
if ($option == "l") { 
$new = "$_GET[newname]";
}

$newmediadir = "$_GET[newname]-med";

if ($ok == "1" and $_GET["option"] == h) {
	echo("[3] Complete <p></p>");
	$myfile = fopen($new, "w");
	if ($_GET["allowmed"] == "allowmed") {
	mkdir("C:/wamp64/www/textengine/sitechats/media/$newmediadir", 0700);
	//chdir("C:/wamp64/www/textengine/sitechats/media/$_GET[newname]", 0700);
	mkdir("C:/wamp64/www/textengine/sitechats/media/$newmediadir/uploaded", 0700);
	}
	echo("<b>New Chatbox created with number $new. Give people the code $new if they want to join.</b> <p></p>");
	$txt = "This is chatbox with number $filename <p></p>.";
} 
if ($ok == "1" and $_GET["option"] == l) {
	$newmediadir = "$_GET[newname]";
	echo("[3] Complete <p></p>");
	$myfile = fopen($new, "w");
	if ($_GET["allowmed"] == "allowmed") {
	mkdir("C:/wamp64/www/textengine/sitechats/media/$newmediadir", 0700);
	//chdir("C:/wamp64/www/textengine/sitechats/media/$_GET[newname]", 0700);
	mkdir("C:/wamp64/www/textengine/sitechats/media/$newmediadir/uploaded", 0700);
	}
	echo("<b>New Chatbox created with number $new. Give people the code $new if they want to join.</b> <p></p>");
	$txt = "This is chatbox with number $filename <p></p>.";
}

if ($ok == '1' and $_POST['option'] == 'd') {
	echo("[3] Complete <p></p>");
	$myfile = fopen($new, "w");
	echo("<b>Chatbox $new created. This is a CBEDATA chatbox, meaning that people should not join as an ordinary user.</b>");
	fwrite($myfile, "class[main>\n");
}



$URL = $_GET["rurl"];

if ($URL == "norefer") {
die("Will not return to referer");
}
if (empty($URL)) {
$URL = "javascript://history.go(-1)";
}

header("Location: $URL");
?>

