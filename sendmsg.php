Diags
<?php
date_default_timezone_set('America/New_York');
//error_reporting(0);
$myfile = fopen("$_POST[write]", "a");

//check for iframes or js, security measure
$iframe = substr_count($_POST["msg"], 'iframe');
$script = substr_count($_POST["msg"], 'script');

if ($iframe > 0 or $script > 0) {
	die("Illegal element found in string detected, halted.<br>");
}
//end that


//ts on?
$contents = file_get_contents("C:/wamp64/www/textengine/sitechats/$_POST[write]");
//echo("$contents, C:/wamp64/www/textengine/sitechats/$_POST[write]");
$needle = "rule.Timestamps(1)";
$timestamps = strpos("$contents", "rule.Timestamps(1)");
echo("<br><br>timestamps at $timestamps<br>");

//encoding yes
$mess = $_POST["msg"];
$emptyencode = empty($_POST["encode"]);
$coder = $_POST["encode"];

if (empty($coder) or $coder == "UTF-8") {
    //echo('UTF8');
	$coder = "UTF-8";
}

$mess = $_POST["msg"];
$mess1 = mb_convert_encoding($mess, $coder);



//$ip = $_SERVER['REMOTE_ADDR'];
//yes ts
$name = $_POST["namer"];

if ($timestamps != "") {
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");
$txt = "$name [$timestamp1, $timestamp2]: $mess1";
//prevent name gap

if (empty($name)) {
    $txt = "[$timestamp1, $timestamp2]: $mess1";
}

//break check
if ($mess1 == "^^br") {
    $txt = "";
}
//end name gap checker
fwrite($myfile, "$txt\n");
fclose($myfile);
echo("submitted<br>");
$URL = $_SERVER['HTTP_REFERER'];
header("Location: $URL");

//no ts
} else {
$txt = "$name: $mess1";
//namegapfiller
if (empty($name)) {
    $txt = "$mess1";
}
//break check
if ($mess1 == "^^br") {
    $txt = "";
}

fwrite($myfile, "$txt\n");
fclose($myfile);
echo("submitted<br>");
$URL = $_SERVER['HTTP_REFERER'];
header("Location: $URL");
}
echo("$coder encoder<br>");
echo("$mess1 = message<br>");
echo("$name = name<br>")
?>

<p></p>
<form>
 <input type="button" value="← Back" onclick="history.back()">
</form>


