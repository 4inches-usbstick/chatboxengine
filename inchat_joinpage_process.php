<title>engine page</title>
<?php
include 'mainlookup.php';
$sc = plsk(107);
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

speakout($_POST['name'], $_POST['nums']);


//error_reporting(0);
$link = "$pcl://$ip/textengine/$sc/connectionpolicy.php?write=$_POST[nums]&namer=$_POST[name]&opt=connect";
//echo("<iframe src='$link' width='1' height='1'></iframe>");

if ($_POST['option'] == 'div') {
$tolink = "inchat-div.php?chatnum=$_POST[nums]&refreshrate=$_POST[refreshrate]&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]&bbg=$_POST[bbg]";
}
if ($_POST['option'] == 'ifr') {
$tolink = "inchat.php?chatnum=$_POST[nums]&refreshrate=$_POST[refreshrate]&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]&bbg=$_POST[bbg]";
}
echo("<meta http-equiv=\"refresh\" content=\"0; URL=$tolink\">");


echo("Not redirected within 3 seconds? Use <a href='$pcl://$ip/textengine/$sc/$tolink'>this button</a>");
//header("Location: $tolink");

?>

<script>
console.log("JS check passed.")
</script>





