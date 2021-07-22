<?php
$sc = plsk(107);
if ($_GET["cmd"] == "del" and $_GET["pass"] == $pass) {
$params = $_GET["params"];
$abspath = dirname($params);
$path = "$abspath/$params";
echo($params);
echo($abspath);
echo($path);
	
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


delete_directory("$rdir/$sc/media/$params");
$ff1 = rmdir("$rdir/$sc/media/$params");
//system("rm -rf ".escapeshellarg("$rdir/$sc/media/$params"));

if (file_exists($path)) {
    echo "[err:31] Stop: Chatbox failed to delete<br>";
} else {
    echo "Chatbox deleted<br>";
}



if (file_exists("$rdir/$sc/media/$params")) {
    echo "[err:31] Stop: Media directory failed to delete<br>";
} else {
    echo "Media directory deleted<br>";
}
}
?>