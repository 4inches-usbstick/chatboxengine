
<title>engine page</title>

<style>
iframe {    
 border: 0;
}
</style>
<?php


//this script is all the other scripts combined into one,
//also because i want to do things without being at pc

//update the credits up here now
$version = file_get_contents('http://71.255.240.10:8080/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-version&type=attr');
$date = file_get_contents('http://71.255.240.10:8080/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-date&type=attr');
$credits = "We are on Chatbox Engine version $version, revised $date, created 28.OCT.2020.";
$pass = file_get_contents('C:/wamp64/www/textengine/sitechats/.htapassword');

error_reporting(0);
error_reporting(0);

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




//create
if ($_GET["cmd"] == "write1298437123098470123984701293847" and $_GET["pass"] == $pass)
{
$ok = 1;

$filename = $_GET["params"];

if (file_exists($filename)) {
    $ok = 0;
	echo("<b>Error: This chatbox number is in use.</b> <p></p>");
	die();
} else {
    echo("<p>[1] Complete </p> <p></p>");
}


$haystaq = file_get_contents('C:\wamp64\www\textengine\sitechats\.htabannednumbers');
$findme = $filename;
$pos = strpos($haystaq, $findme);

if ($pos === false) {
    echo "[2] Complete<p></p>";
} else {
    echo "This is a forbidden Chatbox number";
	$ok = 0;
	die();
}



if ($ok == "1") {
	echo("[2] Complete <p></p>");
	$myfile = fopen($_GET["params"], "w");
	mkdir("C:/wamp64/www/textengine/sitechats/media/$_GET[params]", 0700);
	//chdir("C:/wamp64/www/textengine/sitechats/media/$_GET[newname]", 0700);
	mkdir("C:/wamp64/www/textengine/sitechats/media/$_GET[params]/uploaded", 0700);
	echo("<b>New Chatbox created with number $filename. Give people the code $filename if they want to join.</b> <p></p>");
	//$txt = "This is chatbox with number $filename <p></p>.";
	echo("This process was executed under RM Terminal");
}
}
//sleep(0.15);


//if ($ok == "1");
	//echo("[2] Complete <p></p>");
	//$myfile = fopen($_GET["params"], "w");
	//mkdir("C:/wamp64/www/textengine/sitechats/media/$_POST[newname]", 0700);
	//echo("<b>New Chatbox created with number $filename. Give people the code $filename if they want to join.</b> <p></p>");
	//$txt = "This is chatbox with number $filename <p></p>.";

//checkifexist
if ($_GET["cmd"] == "check")
{

$params = $_GET["params"];
$abspath = dirname($params);
$path = "$abspath/$params";
$filename = $path;
//echo($params);
//echo($abspath);
//echo($path);


if (file_exists($filename)) {
    $ok = 0;
	echo("<b>This chatbox exists.</b> <p></p>");
	die();
} else {
    echo("<p>This chatbox does not exist. </p> <p></p>");
}
}
//sleep(0.15);

//connect

if ($_GET["cmd"] == "connect09870987")
{
$tolink = "<a href=\"inchat.php?chatnum=$_GET[params]&refreshrate=30000\">Connect to the chatbox</a>";
echo($tolink);
}
//sleep(0.15);

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


//version animated
if ($_GET["cmd"] == "versdy")
{

echo("
<head>
<style>
      div {
        background-color: #000000;
        color: #FFFF00;
        padding: 5px;
      }
      p {
        -moz-animation: marquee 10s linear infinite;
        -webkit-animation: marquee 10s linear infinite;
        animation: marquee 10s linear infinite;
      }
      @-moz-keyframes marquee {
        0% {
          transform: translateX(100%);
        }
        100% {
          transform: translateX(-100%);
        }
      }
      @-webkit-keyframes marquee {
        0% {
          transform: translateX(100%);
        }
        100% {
          transform: translateX(-100%);
        }
      }
      @keyframes marquee {
        0% {
          -moz-transform: translateX(100%);
          -webkit-transform: translateX(100%);
          transform: translateX(100%)
        }
        100% {
          -moz-transform: translateX(-100%);
          -webkit-transform: translateX(-100%);
          transform: translateX(-100%);
        }
      }
    </style>
  </head>
  <body>
    <div>
      <p>$credits</p>
    </div>
  </body>
");
//sleep(0.15);
}

if ($_GET["cmd"] == "vers")
{
	echo($credits);
}

//dir
if ($_GET["cmd"] == "dir")
{

echo("<iframe src=\"http://71.255.240.10:8080/textengine/sitechats\" width=\"666\" height=\"400\"></iframe>");
//sleep(0.15);
}

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

if ($_GET["cmd"] == "exe-python" and $_GET["pass"] == $pass) { 
    echo("<b>Processing command...</b><br>");
	//echo("<iframe src=\"$_GET[params]\" width=\"720\" height=\"400\"></iframe>");
	$contents = file_get_contents("$_GET[params]");
	echo($contents);
	sleep(0.5);
}


//help
if ($_GET["cmd"] == "help")
{
echo("
write: creates a chatbox with (parameter).<br>
del: deletes chatbox with number (parameter). <br>
delhtml: same as del, but only for html chatboxes <br>
check: check if chatbox with number (parameter) exists or not <br>
dir: check all files in sitechats, the directory where chats and policy files are stored, no parameters <br>
xcopy: copies chatbox with number (parameter) to a separate area for safekeeping <br>
connect: connect to chatbox with number (parameter) <br>
vers: shows the CBE version, no parameters <br>
rsd: shuts down the server remotely, no parameters, command is disabled for now<br>
xedit: brings up the remote message editing terminal<br>
exe: executes a URL command (i.e. remote edit command)<br>
ban: ban an IP address with address (parameter). for Apache servers specifically. (disabled rn)
help: brings up this help message<br><br>
The write, del, xcopy, rsd, and exe commands require the Administrator password. The check, dir, connect, vers, xedit and help commmands require no such password (but the edit terminal itself takes a password).
As of now this is the only command which requires you to go to another area to execute.<br><br>

No Verbose means that there will be nothing returned. Note that this option must be unchecked for the check, dir, connect, vers, xedit, exe and help commands. If policy blocks a command's execution
the No Verbose will be bypassed.

The write and connect commands are deprecated and are no longer in use.

Sending a command that doesn't exist will result in no output. Using the wrong password or omitting the password will present the user with a message saying so, and the password protected commands will be blocked from running.
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
//command not known
if ($_GET["cmd"] != "del" and $_GET["cmd"] != "delhtml" and $_GET["cmd"] != "check" and $_GET["cmd"] != "dir" and $_GET["cmd"] != "xcopy" and $_GET["cmd"] != "connect" and $_GET["cmd"] != "vers" and $_GET["cmd"] != "rsd" and $_GET["cmd"] != "edit" and $_GET["cmd"] != "xedit" and $_GET["cmd"] != "exe" and $_GET["cmd"] != "help" and $_GET["cmd"] != "ban") {
echo("The entered command was not interpreted because it was not known by the interpreter");
}

//$boi = file_get_contents("C:/wamp64/www/textengine/sitechats/0000");
//echo("<textarea>$boi</textarea>");
?>
	

