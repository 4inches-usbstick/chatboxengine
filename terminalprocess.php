

<?php
include 'mainlookup.php';
$rdir = plsk(3);
$ip = plsk(1);
$mcc = plsk(7);
$cc = plsk(5);
$pass = file_get_contents("$rdir/sitechats/.htapassword");

if (empty($_GET['uid']) || empty($_GET['ukey'])) {
	goto skipverify;
}

if (uidlsk($_GET['uid'], $_GET['ukey']) && uid($_GET['uid'], $_GET['ukey'], 3) == 'sudo') {
	$_GET['pass'] = $pass;
}

if (uidlsk($_GET['uid'], $_GET['ukey']) && uid($_GET['uid'], $_GET['ukey'], 3) != 'sudo') {
	echo('You are not a sudo user.<br>');
}

skipverify:
function ccp($src, $dst) {  
   
    // open the source directory 
    $dir = opendir($src);  
   
    // Make the destination directory if not exist 
    @mkdir($dst);  
   
    // Loop through the files in source directory 
    foreach (scandir($src) as $file) {
		copy($src . "/" . $file, $dst . "/" . $file);  
		echo($src . "/" . $file . $dst . "/" . $file . "<br>");  
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
                     delete_directory($dirname."/".$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname);
     return true;
}

  
 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control");


//this script is all the other scripts combined into one,
//also because i want to do things without being at pc

//update the credits up here now
$version = file_get_contents("http://$ip/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-version&type=attr");
$date = file_get_contents("http://$ip/textengine/sitechats/data/datacall.php?src=credits.cbedata&path=main-credits-date&type=attr");
$credits = "We are on Chatbox Engine version $version, revised $date, created 28.OCT.2020.";

$params = $_GET["params"];

//error_reporting(0);
//wipe
if ($_GET["cmd"] == "wipe" and $_GET["pass"] == $pass) {
	
	$banned = file_get_contents(".htaterminalaccess");
	$script = substr_count($banned, $params);
	
	if ($script > 0) {
	die("This Chatbox is protected and thus cannot be wiped.<br>");
}
	
	$f1 = fopen($params, "w");
	fwrite($f1, "");
	fclose($f1);
	echo("Chatbox wiped.");
	
	
}


//ban
if ($_GET["cmd"] == "banhammer" and $_GET["pass"] == $pass) {
	$towrite = plsk(27);
	$tofile = plsk(25);
	$f1 = fopen($tofile, "a");
	$tt = str_replace('%ip', $_GET['params'], $towrite);
	fwrite($f1, "$tt\n");
	echo(str_replace('%ip', $_GET['params'], $towrite) . '<br>');
	fclose($f1);
	echo("IP banned: $_GET[params]");
}

//change
if ($_GET["cmd"] == "change" and $_GET["pass"] == $pass) {
	$f1 = fopen("$rdir/sitechats/.htapassword", "w");
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
$haystaq = file_get_contents("$rdir/sitechats/.htaterminalaccess");
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


delete_directory("$rdir/sitechats/media/$params");
$ff1 = rmdir("$rdir/sitechats/media/$params");
//system("rm -rf ".escapeshellarg("$rdir/sitechats/media/$params"));

if (file_exists($path)) {
    echo "Chatbox failed to delete<br>";
} else {
    echo "Chatbox deleted<br>";
}



if (file_exists("$rdir/sitechats/media/$params")) {
    echo "Media directory failed to delete<br>";
} else {
    echo "Media directory deleted<br>";
}
}

//del html
if ($_GET["cmd"] == "delhtml" and $_GET["pass"] == $pass) {
$params = $_GET["params"];
$abspath = dirname($params);
$path = "$rdir/sitechats/$params";
//echo($params);
//echo($abspath);
//echo($path);
	
//echo($path);
$haystaq = file_get_contents("$rdir/sitechats/.htaterminalaccess");
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
delete_directory("$rdir/sitechats/media/$mediadir");
$ff1 = rmdir("$rdir/sitechats/media/$mediadir");
//system("rm -rf ".escapeshellarg("$rdir/sitechats/media/$params"));


}





//make a copy of a chat
if ($_GET["cmd"] == "xcopy" and $_GET["pass"] == $pass)
{


$params = $_GET["params"];
$abspath = dirname($params);
$path = "$abspath/$params";
$takesrc = $path;
$destiny = "$cc/$params";

$yes = copy($takesrc, $destiny);
echo("Copied files");

}
//sleep(0.15);




//edit
if ($_GET["cmd"] == "xedit") {
	echo("<iframe src=\"http://$ip/textengine/sitechats/admineditsutil.php\" width='720' height='660'></iframe>");
}


if ($_GET["cmd"] == "loadexe" and $_GET["pass"] == $pass) { 

if (plsk(15) == 'YES') {
	$contents = file_get_contents("loader.py");
	$newcontents = str_replace("%%replace01", $_GET["params"], $contents);
	unlink("loader-tmp.py");
	$f = fopen("loader-tmp.py", "w");
	fwrite($f, $newcontents);
	fclose($f);
	echo("<b>Script loaded.</b><br>");
	
	$f = fopen(".htaremotedesktop", "w");
	fwrite($f, "shell;cd $rdir/sitechats/");
	fclose($f);
	echo("<b>CD command sent.</b><br>");
	sleep(7);
	$f = fopen(".htaremotedesktop", "w");
	fwrite($f, "shell;start $rdir/sitechats/loader-tmp.py");
	fclose($f);
	echo("<b>START command sent.</b><br>");
	//print_r($output);
} else {
die('Stop: loadexe disabled by .htamainpolicy');
}
}

//version
if ($_GET["cmd"] == "vers" && $_GET["params"] == "showall::YES")
{
	$filevers = file_get_contents("credits.cbedata");
echo("<div style='white-space: pre;'>$filevers</div>");
}

if ($_GET["cmd"] == "vers" && $_GET["params"] != "showall::YES")
{
echo($credits);
}

//media copy
if ($_GET["cmd"] == "mcopy" && $_GET["params"] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("$rdir/sitechats/media/");
	$medirs = glob("*", GLOB_ONLYDIR);
	
	foreach($medirs as $i) {
		print("$i<br>");
		ccp("$rdir/sitechats/media/$i/uploaded", "$mcc/$i");
		echo("Copied Media Dir");
	}
}
if ($_GET["cmd"] == "mcopy" && $_GET["params"] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("$rdir/sitechats/media/");
		ccp("$rdir/sitechats/media/$_GET[params]/uploaded", "$mcc/$_GET[params]");
echo("Copied Media Dir");
}
//media delete
if ($_GET["cmd"] == "mdel" && $_GET["params"] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	chdir("$rdir/sitechats/media/");
	delete_directory("$rdir/sitechats/media/$_GET[params]");
	$ff1 = rmdir("$rdir/sitechats/media/$_GET[params]");
	echo("Deleted Media Dir");
}
if ($_GET["cmd"] == "mdel" && $_GET["params"] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo("WARNING: WILDCARD-ALL REMOVES ALL MEDIA DIRS<br>");
	chdir("$rdir/sitechats/media/");
	$medirs = glob("*", GLOB_ONLYDIR);
	foreach($medirs as $i) {
	delete_directory("$rdir/sitechats/media/$i");
	$ff1 = rmdir("$rdir/sitechats/media/$i");
	echo("Deleted Media Dir");
}
}
//media reload
if ($_GET["cmd"] == "mload" && $_GET["params"] == "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo("WARNING: MEDIA DIRECTORIES MUST EXIST BEFORE YOU LOAD THEM");
	chdir("$rdir/sitechats/copies/media/");
	$medirs = glob("*", GLOB_ONLYDIR);
	
	foreach($medirs as $i) {
		echo("$i<br>");
		ccp("$mcc/$i", "$rdir/sitechats/media/$i/uploaded");
		echo("Loaded Media Dir");
	}
}
if ($_GET["cmd"] == "mload" && $_GET["params"] != "WILDCARD-ALL" && $_GET["pass"] == $pass) {
	echo("WARNING: MEDIA DIRECTORIES MUST EXIST BEFORE YOU LOAD THEM");
	chdir("$rdir/sitechats/copies/media/");
		ccp("$mcc/$_GET[params]", "$rdir/sitechats/media/$_GET[params]/uploaded");
		echo("Loaded Media Dir");
}
//mkdir
if ($_GET["cmd"] == "mkdir" && $_GET["pass"] == $pass) {
	echo("WARNING: EXISTING MEDIA DIRS MAY BE OVERWRITTEN");
	mkdir("$rdir/sitechats/media/$_GET[params]", 0700);
	mkdir("$rdir/sitechats/media/$_GET[params]/uploaded", 0700);
		echo("Made directory");
}
//ADDED mkdir, mload, mdel, mcopy

//broadcast
if ($_GET["cmd"] == "cbroadcast" && $_GET["pass"] == $pass) {
	$chatboxes = glob("*");
	echo("FILE LIST:<br><br>");
	foreach($chatboxes as $i) {
		if (is_dir($i)) {
		echo("$i: DIR-SKIP<br>");
		goto skipexec;
		} 
		//if is dir
		
		if (substr_count($i, ".") > 0 && substr_count($i, ".html") == 0) {
		echo("$i: FILE-SKIP<br>"); 
		goto skipexec;
		}
		//if there is a dot and it"s not HTML
		
		if (substr_count($i, ".html") > 0 || substr_count($i, ".") == 0) {
		echo("$i: WRITE<br>"); 
		
		if ($_GET["params"] == "DRYRUN") {
			echo("$i: DRYRUN-SKIP<br>");
			goto skipexec;
		}
		$g = fopen($i, "a");
		fwrite($g, "$_GET[params]\n");
		fclose($g);
		}
		//if there are no dots or it"s HTML
		skipexec:
		
	}
	
}
//cload
if ($_GET["cmd"] == "cload" && $_GET["pass"] == $pass) {
copy("$rdir/sitechats/copies/$_GET[params]", "$rdir/sitechats/$_GET[params]");
echo("Copied");
}

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
*cbroadcast: broadcast message with contents (parameter) to all legacy and HTML chatboxes. Use DRYRUN to show which files are affected by using CBROADCAST without actually writing to the files.<br>
*loadexe: sideloads an extension. this requires Python, an active RDC connection that is listening to .htaremotedesktop and the sideloader extension. this command can be disabled with PID 15.<br>
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
<b>The password entered was incorrect or missing.</b>
<hr>
");
}
//verbose mode
if ($_GET["horns"] == "on") {
	$URL = $_SERVER["HTTP_REFERER"];
	header("Location: $URL");
} 



//$boi = file_get_contents("$rdir/sitechats/0000");
//echo("<textarea>$boi</textarea>");
?>
	

