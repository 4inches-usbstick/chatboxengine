<title>engine page</title>
<?php
include 'mainlookup.php';
$rdir = plsk(3);
$dots = plsk(23);
$ip = plsk(1);
$pcl = plsk(59);

if (file_exists($_POST['nums'])) {
	$myfile = fopen("$_POST[nums]", "a");
	$myfile = fclose($myfile);
} else {
	die('This chatbox does not actually exist');
}

date_default_timezone_set(plsk(9));
$directives = file_get_contents(".htaconnectionpolicy");
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
}
//user but no ts
if ($alias == 1 && $ts_yes == 0) {
	$text = $pieces[2];
	$text = str_replace('%name', $name, $text);
	$retuls = $text;
}
//ts but no user
if ($alias == 0 && $ts_yes == 1) {
	$text = $pieces[3];
	$text = str_replace('%ts', $ts, $text);
	$retuls = $text;
}
//ts but no user
if ($alias == 0 && $ts_yes == 0) {
	$text = $pieces[4];
	$retuls = $text;
}
}
echo($text);
if ($ts_LCL == 1) {
$change = file_get_contents("$pcl://$ip/textengine/sitechats/sendmsg_integration.php?write=$write&msg=$text&encode=UTF-8&referer=norefer&namer=");
} else {
$f = fopen($write, 'a');	
fwrite($f, $retuls);
fclose($f);
}


//error_reporting(0);
$link = "$pcl://$ip/textengine/sitechats/connectionpolicy.php?write=$_POST[nums]&namer=$_POST[name]&opt=connect";
//echo("<iframe src='$link' width='1' height='1'></iframe>");

if ($_POST['option'] == 'div') {
$tolink = "inchat-div.php?chatnum=$_POST[nums]&refreshrate=$_POST[refreshrate]&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]&bbg=$_POST[bbg]";
}
if ($_POST['option'] == 'ifr') {
$tolink = "inchat.php?chatnum=$_POST[nums]&refreshrate=$_POST[refreshrate]&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]&bbg=$_POST[bbg]";
}
echo("<meta http-equiv=\"refresh\" content=\"0; URL=$tolink\">");


echo("Not redirected within 3 seconds? Use <a href='$pcl://$ip/textengine/sitechats/$tolink'>this button</a>");
//header("Location: $tolink");

?>

<script>
console.log("JS check passed.")
</script>





