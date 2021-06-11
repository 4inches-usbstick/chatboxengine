<?php
if ($_GET['cmd'] == 'group add' && $_GET['pass'] == $pass) {
	echo 'ggg';
	$in = strpos(file_get_contents('.htamainpolicy'), '[END GROUPS]');
	$new = substr_replace(file_get_contents('.htamainpolicy'), $_GET['params'] . "\n", $in, 0);
	file_put_contents('.htamainpolicy', $new);
}
if ($_GET['cmd'] == 'group del' && $_GET['pass'] == $pass) {
	//echo wr_db();
	$new = str_replace($_GET['params'], "", file_get_contents('.htamainpolicy'));
	file_put_contents('.htamainpolicy', $new);
}
?>