<title>engine page</title>
<?php
include 'mainlookup.php';
$rdir = plsk(3);
$ip = plsk(1);
$tz = plsk(9);
$pcl = plsk(59);

if (file_exists($_POST["nums"])) {
	echo("<b>Chatbox found</b> <p></p>");
	echo("<p>[1] Complete </p> <p></p>");
} else {
    echo("<p>Stop: Chatbox not found </p> <p></p>");
	die();
}

speakout($_POST['name'], $_POST['nums']);

echo("</p></p><hr>");
error_reporting(0);
echo("<b>Attempting to open a Chatbox</b><p></p>");
$ok = 1;

if (file_exists($_POST["nums"])) {
	echo("<b>Chatbox found</b> <p></p>");
	echo("<p>[1] Complete </p> <p></p>");
} else {
    echo("<p>Stop: Chatbox not found </p> <p></p>");
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

