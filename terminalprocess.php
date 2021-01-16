

<?php


//this script is all the other scripts combined into one,
//also because i want to do things without being at pc

//update the credits up here now
$version = file_get_contents('http://71.255.240.10:8080/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-version&type=attr');
$date = file_get_contents('http://71.255.240.10:8080/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-date&type=attr');
$credits = "We are on Chatbox Engine version $version, revised $date, created 28.OCT.2020.";
$pass = file_get_contents('C:/wamp64/www/textengine/sitechats/.htapassword');

error_reporting(0);


//ban
if ($_GET["cmd"] == 'banhammer' and $_GET['pass'] == $pass) {
	$f1 = fopen("C:/wamp64/www/.htaccess", 'a');
	fwrite($f1, "deny from $_GET[params]\n");
	fclose($f1);
	echo("IP banned: $_GET[params]");
}

//del
if ($_GET["cmd"] == "del" and $_GET["pass"] == $pass) {
$params = $_GET["params"];
$abspath = dirname($params);
$path = "$abspath/$params";
echo($params);
echo($abspath);
echo($path);
	
//echo($path);
$haystaq = file_get_contents('C:\wamp64\www\textengine\sitechats\.htaterminalaccess');
$findme = $params;
$pos = strpos($haystaq, $findme);

if ($pos === false) {
    echo "<br>";
} else {
    echo "This file is protected and thus cannot be accessed";
	die();
}





$ff1 = fopen($path);
$ff1 = fclose($path);
$ff1 = unlink($path);
function delete_directory($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}

delete_directory("C:/wamp64/www/textengine/sitechats/media/$params");
$ff1 = rmdir("C:/wamp64/www/textengine/sitechats/media/$params");
//system("rm -rf ".escapeshellarg("C:/wamp64/www/textengine/sitechats/media/$params"));

if (file_exists($path)) {
    echo "Chatbox failed to delete<br>";
} else {
    echo "Chatbox deleted<br>";
}



if (file_exists("C:/wamp64/www/textengine/sitechats/media/$params")) {
    echo "Media directory failed to delete<br>";
} else {
    echo "Media directory deleted<br>";
}
}

//del html
if ($_GET["cmd"] == "delhtml" and $_GET["pass"] == $pass) {
$params = $_GET["params"];
$abspath = dirname($params);
$path = "C:/wamp64/www/textengine/sitechats/$params";
//echo($params);
//echo($abspath);
//echo($path);
	
//echo($path);
$haystaq = file_get_contents('C:\wamp64\www\textengine\sitechats\.htaterminalaccess');
$findme = $params;
$pos = strpos($haystaq, $findme);

if ($pos === false) {
    echo "<br>";
} else {
    echo "This file is protected and thus cannot be accessed";
	die();
}





$ff1 = fopen($path);
$ff1 = fclose($path);
$ff1 = unlink($path);
function delete_directory($dirname) {
         if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}


$mediadir0 = substr($params, 0, -5);
$mediadir = "$mediadir0-med";

echo("
$mediadir0<br>
$mediadir<br>
$path<br>");
delete_directory("C:/wamp64/www/textengine/sitechats/media/$mediadir");
$ff1 = rmdir("C:/wamp64/www/textengine/sitechats/media/$mediadir");
//system("rm -rf ".escapeshellarg("C:/wamp64/www/textengine/sitechats/media/$params"));


}





//make a copy of a chat
if ($_GET["cmd"] == "xcopy" and $_GET["pass"] == $pass)
{


$params = $_GET["params"];
$abspath = dirname($params);
$path = "$abspath/$params";
$takesrc = $path;
$destiny = "C:/wamp64/www/textengine/sitechats/copies/$params";

$yes = copy($takesrc, $destiny);
echo("Copied files");

}
//sleep(0.15);







//remote shutdown, disabled
if ($_GET["cmd"] == "rsd" and $_GET["pass"] == $pass)
{
$path = "control.txt";
//echo("Shutting down server...");
//$ff1 = fopen($path);

//$ff1 = unlink($path);
}

//edit
if ($_GET["cmd"] == "xedit") {
	echo("<a href=\"http://71.255.240.10:8080/textengine/sitechats/admineditsutil.php\">Open Editing Terminal</a>");
}

//execute editing command
if ($_GET["cmd"] == "exe" and $_GET["pass"] == $pass) { 
    echo("<b>Processing command...</b><br>");
	echo("<iframe src=\"$_GET[params]\" width=\"720\" height=\"400\"></iframe>");
	//$contents = file_get_contents("$_GET[params]");
	echo($contents);
	sleep(0.5);
}



//help
if ($_GET["cmd"] == "help")
{
echo("
del: deletes chatbox with number (parameter). <br>
delhtml: same as del, but only for html chatboxes <br>
xcopy: copies chatbox with number (parameter) to a separate area for safekeeping <br>
vers: shows the CBE version, no parameters <br>
[DISABLED] rsd: shuts down the server remotely, no parameters<br>
xedit: brings up the remote message editing terminal<br>
exe: executes a URL command (i.e. remote edit command)<br>
banhammer: bans an IP address<br>
help: brings up this help message<br><br>
The del, delhtml, xcopy, rsd, and exe commands require the Administrator password. The vers, xedit and help commmands require no such password (but the edit terminal itself takes a password).


No Verbose means that there will be nothing returned. Note that this option must be unchecked for the check, dir, connect, vers, xedit, exe and help commands. If policy blocks a command's execution
the No Verbose will be bypassed.


");
}


if ($_GET["cmd"] == "basdfsdfn" and $_GET["pass"] == $pass) {
$file = fopen("C:/wamp64/www/.htaccessboi", "a");
$ban = $_GET["params"];
fwrite($file, "deny from $ban\n");
fclose("C:/wamp64/www/.htaccessboi");
}







//pw error
if ($_GET["pass"] != $pass)
{
echo("
<hr>
<b>The password entered was incorrect or missing. Elevated priviledge commands will be blocked from running if the password is not correct.</b>
<hr>
");
}
//verbose mode
if ($_GET["horns"] == "on") {
	$URL = $_SERVER['HTTP_REFERER'];
	header("Location: $URL");
} 



//$boi = file_get_contents("C:/wamp64/www/textengine/sitechats/0000");
//echo("<textarea>$boi</textarea>");
?>
	

