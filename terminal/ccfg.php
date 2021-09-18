<?php 
if ($_GET["cmd"] == "ccfg" && $_GET["pass"] == $pass) {
$cfg = file_get_contents('.htamainpolicy');
echo("<div style='white-space: pre;'>$cfg</div>");
}