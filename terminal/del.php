<?php
if ($_GET["cmd"] == "del" and $_GET["pass"] == $pass) {
$params = $_GET["params"];
$abspath = dirname($params);
$path = "$abspath/$params";
echo($params);
echo($abspath);
echo($path);
	
//echo($path);
$haystaq = file_get_contents("$rdir/sitechats/.htaterminalaccess");
$findme = $params;
$pos = strpos($haystaq, $findme);

if ($pos === false) {
    echo "<br>";
} else {
    echo "[err:29] Stop: This file is protected and thus cannot be accessed";
	die();
}



$ff1 = unlink($path);


delete_directory("$rdir/sitechats/media/$params");
$ff1 = rmdir("$rdir/sitechats/media/$params");
//system("rm -rf ".escapeshellarg("$rdir/sitechats/media/$params"));

if (file_exists($path)) {
    echo "[err:31] Stop: Chatbox failed to delete<br>";
} else {
    echo "Chatbox deleted<br>";
}



if (file_exists("$rdir/sitechats/media/$params")) {
    echo "[err:31] Stop: Media directory failed to delete<br>";
} else {
    echo "Media directory deleted<br>";
}
}
?>