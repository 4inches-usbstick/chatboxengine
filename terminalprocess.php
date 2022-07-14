


<?php
include 'mainlookup.php';
$sc = plsk(107);
$rdir = plsk(3);
$ip = plsk(1);
$mcc = plsk(7);
$cc = plsk(5);
$pcl = plsk(59);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Cache-Control");

error_reporting(plsk(37));
chdir("$rdir/$sc");

$pass = file_get_contents("$rdir/$sc/.htapassword");
$useduid = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
if (empty($_GET['uid']) == false && empty($_GET['ukey']) == false) {$useduid = true;}

if (empty($_GET['uid']) || empty($_GET['ukey'])) {
	goto skipverify;
}

if (uidlsk($_GET['uid'], $_GET['ukey'])) {
	$_GET['pass'] = $pass;
	$_POST['pass'] = $pass;
	//echo('<hr>You are a sudo user. You are able to run most commands, except for the CHANGE and INICFG commands.<hr>');
}
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
if (empty($_POST['uid']) == false && empty($_POST['ukey']) == false) {$useduid = true;}

if (empty($_POST['uid']) || empty($_POST['ukey'])) {
	goto skipverify;
}

if (uidlsk($_POST['uid'], $_POST['ukey'])) {
	$_POST['pass'] = $pass;
	$_GET['pass'] = $pass;
	//echo('<hr>You are a sudo user. You are able to run most commands, except for the CHANGE and INICFG commands.<hr>');
}
}

skipverify:

function logger($ins) {
	if (empty($ins['cmd'])) {
		return 0;
	}
	global $useduid, $pass;
	//good with master
	$addon = '';
	//echo $ins['pass'];
	//echo $pass;
	//echo $useduid;
	#echo plsk(49);
	if (substr_count(plsk(49), $ins['cmd']) > 0) {
		return 0;
	}
	if ($ins['pass'] == $pass && !$useduid) {
		$addon = "*MASTERKEY";
	}
	
	//good with uidukey
	if ($ins['pass'] == $pass && $useduid) {
		$addon = "$ins[uid]";
	}
	
	//bad
	if ($ins['pass'] != $pass && !$useduid) {
		$addon = "*NOMASTERKEY";
	}
	
	if ($ins['pass'] != $pass && $useduid) {
		$addon = "*NOUKEY:$ins[uid]";
	}
	
	if ($useduid) { $useduidstr = '*TRUE'; } else { $useduidstr = '*FALSE'; }
	
	if (plsk(47) != 'YES') {
		return 0;
	}
	
	$ret = plsk(111);
	$ret = str_replace('%cmd',$ins['cmd'],$ret);
	$ret = str_replace('%params',$ins['params'],$ret);
	$ret = str_replace('%uid',$addon,$ret);
	$ret = str_replace('%useduid',$useduidstr,$ret);
	$ret = str_replace('%verb',$_SERVER['REQUEST_METHOD'],$ret);
	date_default_timezone_set(plsk(9));
	$timestamp1 = date(plsk(105));
	$timestamp2 = date(plsk(103));
	$ret = str_replace('%time',$timestamp1,$ret);
	$ret = str_replace('%date',$timestamp2,$ret);


	
	$f = fopen(plsk(45), 'a');
	fwrite($f, "$ret\n");
	fclose($f);
}

$admincmds = explode('//', plsk(101));
foreach ($admincmds as $i) {
	//echo $i . '<br>';
	if ($_GET['cmd'] == $i && $useduid) {
		die('[err:23] Stop: PID 101 dictates that this command requires an admin password instead of a UID/UKEY');
	}
}

if (true) {
$groupsin = explode('//', uid($_GET['uid'], $_GET['ukey'], 4));

foreach($groupsin as $ugroup) {
	if(substr_count(group_db(), "$ugroup cantrun $_GET[cmd]") > 0 && $useduid) { die('[err:33] Stop: this user group cannot run cmd: ' . $_GET['cmd']); }
	
	if(substr_count(group_db(), "$ugroup canrun $_GET[cmd]") > 0 && $useduid) { goto bypasschecker1; }
	
	if(substr_count(group_db(), "$ugroup cantrun *") > 0 && $useduid) { die('[err:33] Stop: this user group cannot run *[global]'); }
	if(substr_count(group_db(), "$ugroup cantrun WILDCARD-ALL") > 0 && $useduid) { die('[err:33] Stop: this user group cannot run WILDCARD-ALL[global]'); }
}
}

//log
bypasschecker1:
if ($_SERVER['REQUEST_METHOD'] == 'GET') { logger($_GET); }
if ($_SERVER['REQUEST_METHOD'] == 'POST') { logger($_POST); }

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

  
 



//this script is all the other scripts combined into one,
//also because i want to do things without being at pc

//update the credits up here now
$version = file_get_contents("$pcl://$ip/textengine/$sc/data/datacall.php?src=credits.cbedata&path=main-credits-version&type=attr");
$date = file_get_contents("$pcl://$ip/textengine/$sc/data/datacall.php?src=credits.cbedata&path=main-credits-date&type=attr");
$credits = "We are on Chatbox Engine version $version, revised $date, created 28.OCT.2020.";

$params = $_GET["params"];

//error_reporting(0);
//wipe
//change
if ($_GET["cmd"] == "change" and $_GET["pass"] == $pass and $useduid == false) {
	$f1 = fopen("$rdir/$sc/.htapassword", "w");
	fwrite($f1, "$_GET[params]");
	fclose($f1);
	echo("Password changed: $_GET[params]");
}
if ($_GET["cmd"] == "change" and $_GET["pass"] == $pass and $useduid == true) {
	echo("[err:23] Stop: Master password required to run the CHANGE command.");
}

//uid db management


//work with FILESAFE to restrict chatboxes to certain user groups such as local


//policy
if ($_POST["cmd"] == "inicfg" and $_POST["pass"] == $pass) {
	$f1 = fopen("$rdir/$sc/.htamainpolicy", "w");
	fwrite($f1, "$_POST[params]");
	fclose($f1);
	echo("Written to file: $_POST[params]");
}
if ($_POST["cmd"] == "inicfg" and $_POST["pass"] == $pass) {
	echo("[err:23] Stop: You must use the main admin password to run the INICFG command.");
}

if ($_GET['cmd'] == 'ecfg' and $_GET["pass"] == $pass and $useduid == false) {
	echo("<a href=\"maineditor.php?pass=$_GET[pass]\">Open</a>");
}
if ($_GET['cmd'] == 'ecfg' and $_GET["pass"] == $pass and $useduid == true) {
	echo("[err:23] Stop: Master password required to run ECFG command");
}

//del


//del html



if ($_GET["cmd"] == "loadexe" and $_GET["pass"] == $pass) { 
die('[err:42069] Stop: This command was removed permanently for a number of reasons.');
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


//ADDED mkdir, mload, mdel, mcopy

//broadcast


//

//send


if ($_GET['cmd'] == "inirecovery") {
	if (plsk(97) != 'YES') {
		die('[err:32] Stop: This procedure has been disabled by PID 97. Recovery cannot continue.');
	}
	$f = fopen(plsk(93), 'w');
	fclose($f);
	sleep(plsk(99));
	$c = file_get_contents(plsk(93));
		unlink(plsk(93));
	if ($c == plsk(95)) {
		echo(file_get_contents('.htapassword'));
	} else {
		die('[err:33] Stop: Incorrect recovery password');
	}

}
//help
if ($_GET["cmd"] == "help")
{
echo("
COMMANDS: <br><br>
*del: deletes chatbox with number (parameter). <br>
*delhtml: same as del, but only for html chatboxes <br>
*xcopy: copies chatbox with number (parameter) to a separate area for safekeeping. use xcopy --append to not erase any currently existing copies of that chatbox <br>
*wipe: delete the contents of a Chatbox but not the Chatbox itself<br><br>

vers: shows the CBE version, no required parameters. use 'showall::YES' to bring up the entire credits file instead of just a version number <br>

*banhammer: bans IP address with value (parameter)<br><br>

*mkdir: make a Media Directory where there wasn't one, the media directory will be named (parameter)<br>
*mcopy: copy Media Directory with name (parameter) to the specified separate area for safekeeping. Using WILDCARD-ALL as the parameter allows you to copy all media dirs<br>
*mload: pull Media Directory with name (parameter) from safekeeping to the main Media dir. The destination dir must already exist. Do not use WILDCARD-ALL with this command.<br>
*mdel: remove a specific Media Directory with name (parameter) without deleting the Chatbox. Using WILDCARD-ALL removes all media directories, so be careful.<br><br>

*cbroadcast: broadcast message with contents (parameter) to all legacy and HTML chatboxes. Use DRYRUN to show which files will be written to without actually writing.<br>
*^_copen: open a Chatbox. parameters slot syntax: FILENAME.FILE-EXT --MEDIAOPTION<br>
clist: list all Chatboxes and whether or not they are protected<br>
*cload: copy Chatbox from designated dir to main $sc dir<br>
*csend: write a message to a Chatbox bypassing nogo phrases and UID/UKEY checking. Use csend --nobreak to not use a newline char when writing to the Chatbox. Can be disabled by PID 77. Use chatbox;message in the params box.<br>

help: brings up this help message, no parameters<br><br>

*^ecfg: configure .htamainpolicy. this command can be disabled by PID 35<br>
*^change: change Master Admin Password<br><br>

*^cmd add: add a custom command in this syntax: @Event;Condition;String;Includepath<br>
*^cmd del: remove a custom command in this syntax: @Event;Condition;String;Includepath<br>
*^udb add: add a user and give them a permission. the parameter should be in this syntax: UID Name Password Groups (space char as delimiter)<br>
*^udb sdel: delete a user with UID as parameters. works when you only have a UID and no other details<br>
*^udbgrab: grab user info. without sudo you'll get their groups and perm level and name, with sudo powers you get all details. takes UID as params<br>
*^udb del: delete a user. you'll need to provide their information in the parameter slot with this syntax: UID Name Password Groups (space char as delimiter)<br><br>
*^lock add: lock a UID out from a Chatbox in this syntax: [chatbox no.] deny from [UID]<br>
*^lock del: unlock a UID from a Chatbox with the same syntax as LOCK ADD<br>
*^filesafe add: add a file to be write protected. syntax: chatbox::who to restrict to (sudo, login or local):: OR g:group1//group2<br>
*^filesafe del: remove a file to be write protected. syntax: chatbox::who to restrict to (sudo, login or local):: OR g:group1//group2<br>
*^readsafe add: add a file to be read protected. syntax: chatbox::who to restrict to (sudo, login or local):: OR g:group1//group2<br>
*^readsafe del: remove a file to be read protected. syntax: chatbox::who to restrict to (sudo, login or local):: OR g:group1//group2<br>
*^group add: add a user group command, either GROUPNAME give sudo or GROUPNAME cantrun CMDNAME<br>
*^group del: removes a user group command, in the same syntax as group add<br>
*validatormgr: adds a validator command to a media dir (the media dir must exist before hand). param syntax: [chatbox]/[command].<br>

*^ccfg: show entire config file to see which parts you want gone and which parts to add too

inirecovery: starts the 'I FORGOT THE PASSWORD'  procedure. Opens a Chatbox then gives you time to enter the backup code from .htamainpolicy.<br><br>


No Verbose allows you to suppress the output of the command (unless a fatal error happens on command execution).
This feature is only for the web client.<br><br>

* = requires UID/UKEY or password<br>
^ = requires password and cannot take UID/UKEY (by default, it is possible to change some of these commands in .htamainpolicy)<br>
_ = three options: --allowmed, --allowmedhtml, --forbidmed<br>

If there are dangerous commands, there are people who will find a way to mess it up. This terminal does not stop you from making bad decisions.
If we are only free to make good decisions, we are not free at all.


");
}

$imfedupwiththisshit = str_replace("\n", "", file_get_contents('.htaterminalkeys'));
$imfedupwiththisshit = str_replace("%rdir", $rdir, $imfedupwiththisshit);
$imfedupwiththisshit = str_replace("%sc", $sc, $imfedupwiththisshit);
$keys = explode(";", $imfedupwiththisshit);
#print_r($keys);
$done = False;


//this is broken
foreach($keys as $i) {
	$things = explode("::", $i);
	//echo(str_replace("\n", "", $things[0] . '<br>'));
	//echo("compare: " . $_GET['cmd'] . '==' . substr($things[0],1) . '<br>');
	//and this is the problem
	if ($_GET['cmd'] == substr($things[0],1)) {
		echo("filepath: " . str_replace("%rdir", $rdir, $things[1])) . "<br>\n";
		include str_replace("%rdir", $rdir, $things[1]);
		$done = True;
	}
}
clearstatcache();
if (file_exists("$rdir/$sc/terminal/" . $_GET['cmd'] . '.php') && !$done) {
	include "$rdir/$sc/terminal/$_GET[cmd].php";
}


foreach($keys as $i) {
	$things = explode("::", $i);
	//echo(str_replace("\n", "", $things[0] . '<br>'));
	//echo("compare: " . $_GET['cmd'] . '==' . substr($things[0],1) . '<br>');
	//and this is the problem
	if ($_POST['cmd'] == substr($things[0],1)) {
		echo("filepath: " . str_replace("%rdir", $rdir, $things[1])) . "<br>\n";
		include str_replace("%rdir", $rdir, $things[1]);
		$done = True;
	}
}
clearstatcache();
if (file_exists("$rdir/$sc/terminal/" . $_POST['cmd'] . '.php') && !$done) {
	include "$rdir/$sc/terminal/$_POST[cmd].php";
}



//pw error
if ($_GET["pass"] != $pass)
{
echo("
<hr><b>(Auth-Warning) UID/UKEY or MASTERKEY was not valid [warn:33]</b><hr>
");
}
//verbose mode
if ($_GET["horns"] == "on") {
	$URL = $_SERVER["HTTP_REFERER"];
	header("Location: $URL");
} 



//$boi = file_get_contents("$rdir/$sc/0000");
//echo("<textarea>$boi</textarea>");
?>
	

