

<?php
function ccp($src, $dst) {  
   
    // open the source directory 
    $dir = opendir($src);  
   
    // Make the destination directory if not exist 
    @mkdir($dst);  
   
    // Loop through the files in source directory 
    foreach (scandir($src) as $file) {
		copy($src . '/' . $file, $dst . '/' . $file);  
		echo($src . '/' . $file . $dst . '/' . $file . '<br>');  
        }
    closedir($dir); 		
    }
	
   
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

  
 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control');


//this script is all the other scripts combined into one,
//also because i want to do things without being at pc

//update the credits up here now
$version = file_get_contents('http://71.255.240.10:8080/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-version&type=attr');
$date = file_get_contents('http://71.255.240.10:8080/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-date&type=attr');
$credits = "We are on Chatbox Engine version $version, revised $date, created 28.OCT.2020.";
$pass = file_get_contents('C:/wamp64/www/textengine/sitechats/.htapassword');
$params = $_GET['params'];

//error_reporting(0);
//wipe
if ($_GET["cmd"] == 'wipe' and $_GET['pass'] == $pass) {
	
	$banned = file_get_contents('.htaterminalaccess');
	$script = substr_count($banned, $params);
	
	if ($script > 0) {
	die("This Chatbox is protected and thus cannot be wiped.<br>");
}
	
	$f1 = fopen($params, 'w');
	fwrite($f1, "");
	fclose($f1);
	echo("Chatbox wiped.");
	
	
}


//ban
if ($_GET["cmd"] == 'banhammer' and $_GET['pass'] == $pass) {
	$f1 = fopen("C:/wamp64/www/.htaccess", 'a');
	fwrite($f1, "deny from $_GET[params]\n");
	fclose($f1);
	echo("IP banned: $_GET[params]");
}

//change
if ($_GET["cmd"] == 'change' and $_GET['pass'] == $pass) {
	$f1 = fopen("C:/wamp64/www/textengine/sitechats/.htapassword", 'w');
	fwrite($f1, "$_GET[params]");
	fclose($f1);
	echo("Password changed: $_GET[params]");
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




//edit
if ($_GET["cmd"] == "xedit") {
	echo("<iframe src=\"http://71.255.240.10:8080/textengine/sitechats/admineditsutil.php\"></iframe>");
}


if ($_GET["cmd"] == "loadexe" and $_GET["pass"] == $pass) { 
	$contents = file_get_contents("loader.py");
	$newcontents = str_replace('%%replace01', $_GET['params'], $contents);
	unlink('loader-tmp.py');
	$f = fopen('loader-tmp.py', 'w');
	fwrite($f, $newcontents);
	fclose($f);
	echo("<b>Script loaded.</b><br>");
	
	$f = fopen('.htaremotedesktop', 'w');
	fwrite($f, 'shell;cd C:/wamp64/www/textengine/sitechats/');
	fclose($f);
	echo("<b>CD command sent.</b><br>");
	sleep(7);
	$f = fopen('.htaremotedesktop', 'w');
	fwrite($f, 'shell;start C:/wamp64/www/textengine/sitechats/loader-tmp.py');
	fclose($f);
	echo("<b>START command sent.</b><br>");
	//print_r($output);
}

//version
if ($_GET["cmd"] == "vers" && $_GET['params'] == "showall::YES")
{
	$filevers = file_get_contents('credits.cbedata');
echo("<div style='white-space: pre;'>$filevers</div>");
}

if ($_GET["cmd"] == "vers" && $_GET['params'] != "showall::YES")
{
echo($credits);
}

//media copy
if ($_GET["cmd"] == "mcopy" && $_GET['params'] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("C:/wamp64/www/textengine/sitechats/media/");
	$medirs = glob('*', GLOB_ONLYDIR);
	
	foreach($medirs as $i) {
		print("$i<br>");
		ccp("C:/wamp64/www/textengine/sitechats/media/$i/uploaded", "C:/wamp64/www/textengine/sitechats/copies/media/$i");
		echo('Copied Media Dir');
	}
}
if ($_GET["cmd"] == "mcopy" && $_GET['params'] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("C:/wamp64/www/textengine/sitechats/media/");
		ccp("C:/wamp64/www/textengine/sitechats/media/$_GET[params]/uploaded", "C:/wamp64/www/textengine/sitechats/copies/media/$_GET[params]");
echo('Copied Media Dir');
}
//media delete
if ($_GET["cmd"] == "mdel" && $_GET['params'] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("C:/wamp64/www/textengine/sitechats/media/");
	delete_directory("C:/wamp64/www/textengine/sitechats/media/$_GET[params]");
	$ff1 = rmdir("C:/wamp64/www/textengine/sitechats/media/$_GET[params]");
	echo('Deleted Media Dir');
}
if ($_GET["cmd"] == "mdel" && $_GET['params'] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo('WARNING: WILDCARD-ALL REMOVES ALL MEDIA DIRS<br>');
	chdir("C:/wamp64/www/textengine/sitechats/media/");
	$medirs = glob('*', GLOB_ONLYDIR);
	foreach($medirs as $i) {
	delete_directory("C:/wamp64/www/textengine/sitechats/media/$i");
	$ff1 = rmdir("C:/wamp64/www/textengine/sitechats/media/$i");
	echo('Deleted Media Dir');
}
}
//media reload
if ($_GET["cmd"] == "mload" && $_GET['params'] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo('WARNING: MEDIA DIRECTORIES MUST EXIST BEFORE YOU LOAD THEM');
	chdir("C:/wamp64/www/textengine/sitechats/copies/media/");
	$medirs = glob('*', GLOB_ONLYDIR);
	
	foreach($medirs as $i) {
		echo("$i<br>");
		ccp("C:/wamp64/www/textengine/sitechats/copies/media/$i", "C:/wamp64/www/textengine/sitechats/media/$i/uploaded");
		echo('Loaded Media Dir');
	}
}
if ($_GET["cmd"] == "mload" && $_GET['params'] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo('WARNING: MEDIA DIRECTORIES MUST EXIST BEFORE YOU LOAD THEM');
	chdir("C:/wamp64/www/textengine/sitechats/copies/media/");
		ccp("C:/wamp64/www/textengine/sitechats/copies/media/$_GET[params]", "C:/wamp64/www/textengine/sitechats/media/$_GET[params]/uploaded");
		echo('Loaded Media Dir');
}
//mkdir
if ($_GET["cmd"] == "mkdir" && $_GET["pass"] == $pass) {
	echo('WARNING: EXISTING MEDIA DIRS MAY BE OVERWRITTEN');
	mkdir("C:/wamp64/www/textengine/sitechats/media/$_GET[params]", 0700);
	mkdir("C:/wamp64/www/textengine/sitechats/media/$_GET[params]/uploaded", 0700);
		echo('Made directory');
}
//ADDED mkdir, mload, mdel, mcopy

//help
if ($_GET["cmd"] == "help")
{
echo("
COMMAND LIST: (commands with stars require admin password)<br><br>
*del: deletes chatbox with number (parameter). <br>
*delhtml: same as del, but only for html chatboxes <br>
*xcopy: copies chatbox with number (parameter) to a separate area for safekeeping <br>
*wipe: delete the contents of a Chatbox but not the Chatbox itself<br>
vers: shows the CBE version, no required parameters. use 'showall::YES' to bring up the entire credits file instead of just a version number <br>
xedit: brings up the remote message editing terminal, no parameters<br>
*banhammer: bans IP address with value (parameter)<br>
*change: changes the admin password to (parameter)<br>
*mkdir: make a Media Directory where there wasn't one, the media directory will be named (parameter)<br>
*mcopy: copy Media Directory with name (parameter) to the specified separate area for safekeeping. Using WILDCARD-ALL as the parameter allows you to copy all media dirs<br>
*mload: pull Media Directory with name (parameter) from safekeeping to the main Media dir. Note that when you try to load Backup Media Dir contents into the main Media dir, the destination dir must already exist. Do not use WILDCARD-ALL with this command unless you are sure all the necessary directories are present.<br>
*mdel: remove a specific Media Directory with name (parameter) without deleting the Chatbox. Using WILDCARD-ALL removes all media directories, so be careful.<br>
*loadexe: sideloads an extension. requires Python, active RDC connection that is listening to .htaremotedesktop and sideloader extension.<br>
help: brings up this help message, no parameters<br><br>



No Verbose allows you to suppress the output of the command (unless a fatal error happens on command execution).
This feature is only for the web client.<br><br>

If there are dangerous commands, there are people who will find a way to mess it up. This terminal does not stop you from making bad decisions.
If we are only free to make good decisions, we are not free at all.


");
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
	

