<title>engine page</title>
<?php
echo("</p></p><hr>");
error_reporting(0);
echo("<b>Attempting to open a Chatbox</b><p></p>");
$ok = 1;

if (file_exists($_POST[nums])) {
	echo("<b>Chatbox found</b> <p></p>");
	echo("<p>[1] Complete </p> <p></p>");
} else {
	sleep(1.5);
    echo("<p>Error: Chatbox not found </p> <p></p>");
	die();
}


sleep(1.5);
$rerate = $_POST[refreshrate];
//echo("<iframe src=$_POST[nums]></iframe>");
echo("<p></p>");
$tolink = "<a href=\"inchat.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]\">→ Connect to the chatbox (Legacy Mode, Iframe Standard) ←</a><br>";
echo($tolink);
$tolink = "<a href=\"inchat-div.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]\">→ Connect to the chatbox (Legacy Mode, Div Standard) ←</a><br>";
echo($tolink);
$tolink = "<a href=\"inchat4html.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0\">→ Connect to the chatbox (HTML Mode) ←</a><br>";
//echo($tolink);
$tolink = "<a href=\"inchatcss1m.php?chatnum=$_POST[nums]&refreshrate=$rerate&explorer=0\">→ Connect to the chatbox (CSS'd up) ←</a><br><br>";
//echo($tolink);

echo("joining: $_POST[nums]<br>");
echo("rr: $_POST[refreshrate]<br>");

?>

<script>
console.log("JS check passed.")
</script>



<b>If you are joining a HTML chatbox, you must use the Div standard. If you are joining a Legacy Chatbox, you can use either.</b>

