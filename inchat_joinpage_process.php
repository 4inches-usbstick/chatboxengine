<title>engine page</title>
<?php

if ($_POST['option'] == 'div') {
$tolink = "inchat-div.php?chatnum=$_POST[nums]&refreshrate=$_POST[refreshrate]&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]&bbg=$_POST[bbg]";
}
if ($_POST['option'] == 'ifr') {
$tolink = "inchat.php?chatnum=$_POST[nums]&refreshrate=$_POST[refreshrate]&explorer=0&encoderm=$_POST[enc]&namer=$_POST[name]&bbg=$_POST[bbg]";
}

echo("Not redirected? Use $tolink");
header("Location: $tolink");

?>

<script>
console.log("JS check passed.")
</script>





