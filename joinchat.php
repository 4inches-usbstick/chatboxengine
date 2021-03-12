<title>engine page</title>
<?php
include 'mainlookup.php';
$rdir = plsk(3);
$ip = plsk(1);
$tz = plsk(9);

date_default_timezone_set($tz);
$directives = file_get_contents(".htaconnectionpolicy");
echo($directives);
$name = $_POST['name'];
$write = $_POST['nums'];
$doc = 'connect';
$alias= substr_count($directives, 'showalias:YES');
$ts_yes = substr_count($directives, 'showts:YES');
$ts_LCL = substr_count($directives, 'showts:LOCAL');
$enable = substr_count($directives, 'shownewconnect:YES');

$offset1 = strpos($directives, '-->');
$offset2 = strpos($directives, '<--');
$length = $offset2 - $offset1;
$messages = substr($directives, $offset1, $length);
$pieces = explode('::', $messages);

if ($enable == 0) {
$doc = 'sdf';
}
$timestamp1 = date("H:i:s");
$timestamp2 = date("d.m.y");
$ts = "[$timestamp1, $timestamp2]";
if ($doc == 'connect') {
//user and ts
if ($alias == 1 && $ts_yes == 1) {
	$text = $pieces[1];
	$text = str_replace('%name', $name, $text);
	$text = str_replace('%ts', $ts, $text);
	$retuls = $text;
	echo('M::1<br>');
}
//user but no ts
if ($alias == 1 && $ts_yes == 0) {
	$text = $pieces[2];
	$text = str_replace('%name', $name, $text);
	$retuls = $text;
	echo('M::2<br>');
}
//ts but no user
if ($alias == 0 && $ts_yes == 1) {
	$text = $pieces[3];
	$text = str_replace('%ts', $ts, $text);
	$retuls = $text;
	echo('M::3<br>');
}
//ts but no user
if ($alias == 0 && $ts_yes == 0) {
	$text = $pieces[4];
	$retuls = $text;
	echo('M::4<br>');
}
}
//echo($text);
if ($ts_LCL == 1) {
$change = file_get_contents("http://$ip/textengine/sitechats/sendmsg_integration.php?write=$write&msg=$text&encode=UTF-8&referer=norefer&namer=");
} else {
$f = fopen($write, 'a');	
fwrite($f, $retuls);
fclose($f);
}

echo("</p></p><hr>");
error_reporting(0);
echo("<b>Attempting to open a Chatbox</b><p></p>");
$ok = 1;

if (file_exists($_POST["nums"])) {
	echo("<b>Chatbox found</b> <p></p>");
	echo("<p>[1] Complete </p> <p></p>");
} else {
    echo("<p>Error: Chatbox not found </p> <p></p>");
	die();
}


$rerate = $_POST["refreshrate"];
//echo("<iframe src=$_POST[nums]></iframe>");
echo("<p></p>");
$tolink = "<a href=\"inchat.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]\"> Connect to the chatbox (Legacy Mode, Iframe Standard) </a><br>";
echo($tolink);
$tolink = "<a href=\"inchat-div.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]\"> Connect to the chatbox (Legacy Mode, Div Standard) </a><br>";
echo($tolink);
$tolink = "<a href=\"inchat4html.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0\"> Connect to the chatbox (HTML Mode) </a><br>";
//echo($tolink);
$tolink = "<a href=\"inchatcss1m.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0\"> Connect to the chatbox (CSS'd up) </a><br><br>";
//echo($tolink);

echo("joining: $_POST[nums]<br>");
echo("rr: $_POST[refreshrate]<br>");
//$link = "http://$ip/textengine/sitechats/connectionpolicy.php?write=$_POST[nums]&namer=$_POST[name]&opt=connect";
//echo("<iframe src='$link' width='1' height='1'></iframe>");
?>

<script>
console.log("JS check passed.")
</script>



<b>If you are joining a HTML chatbox, you must use the Div standard. If you are joining a Legacy Chatbox, you can use either.</b>

