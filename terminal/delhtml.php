<?php
$sc = plsk(107);
if ($_GET["cmd"] == "delhtml" and $_GET["pass"] == $pass) {
$params = $_GET["params"];
$abspath = dirname($params);
$path = "$rdir/$sc/$params";
//echo($params);
//echo($abspath);
//echo($path);
	
//echo($path);
$haystaq = file_get_contents("$rdir/$sc/.htaterminalaccess");
$findme = $params;
$pos = strpos($haystaq, $findme);

if ($pos === false) {
    echo "<br>";
} else {
    echo "[err:29] Stop: This file is protected and thus cannot be accessed";
	die();
}





$ff1 = unlink($path);


$mediadir0 = substr($params, 0, -5);
$mediadir = "$mediadir0-med";

echo("
$mediadir0<br>
$mediadir<br>
$path<br>");
delete_directory("$rdir/$sc/media/$mediadir");
$ff1 = rmdir("$rdir/$sc/media/$mediadir");
//system("rm -rf ".escapeshellarg("$rdir/$sc/media/$params"));


}
?>