<?php
if ($_GET['pass'] == $pass && $useduid == false) {
	$ps = uid($_GET['params'], "0", 2);
} else {
	$ps = '-- [warn:33] Warning: No permissions, nonfatal. --';
}
echo("User ID: " . uid($_GET['params'], "0", 0) . "<br>\n");
echo("OS Alias: " . uid($_GET['params'], "0", 1) . "<br>\n");
echo("Password: " . "$ps" . "<br>\n");
echo("Perms string: " . uid($_GET['params'], "0", 3) . "<br>\n");
echo("Groups string: " . uid($_GET['params'], "0", 4) . "<br>\n");
?>