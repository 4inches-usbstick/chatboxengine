<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;   
}
</style>

<?php
include 'mainlookup.php';
$rdir = plsk(3);
$ip = plsk(1);

$formact = "http://$ip/textengine/sitechats/media/uploadform.php?chatnum1=$_GET[chatnum]&rr=$_GET[refreshrate]";
error_reporting(0);
$mediaoptions = 0;
$gethttd = file_get_contents("http://$ip/textengine/sitechats/media/$_GET[chatnum]");


if ($gethttd === false) {
	$mediaoptions = "<code style=\"background: black; color: white\">Media uploads have been disabled for this Chatbox.</code><br>";
} else {
	$mediaoptions = "<a href=$formact>Upload Media, </a>
<a href=\"http://$ip/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=1&encoderm=$coder&bbg=$_GET[bbg]&namer=$_GET[namer]\">Find / Post Media, </a>
<a href=\"http://$ip/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]&namer=$_GET[namer]\">Close Media Finder, </a><br>";
}
	


error_reporting(0);

$coder = $_GET['encoderm'];
if (empty($_GET['encoderm'])) {
    $coder = "UTF-8";
}

echo("<title>[ifr] Chatbox $_GET[chatnum]</title>
<style>
body {
  background-image: url($_GET[bbg]);
}
</style>
");
echo("refresh rate: ");
echo("$_GET[refreshrate]ms"   );
echo("   ");
//echo("<a href=\"http://$ip/textengine/change.txt\">Learn more</a>, <a href=\"http://$ip/textengine/map.html\">Homepage</a>");
echo("<br>encoder: $coder<br>");
echo("<code style=\"color:red\" draggable=\"false\">trigger warning: this site contains flashing images. </code><br>");


$width = $_GET["wide"]; 
if (empty($width)) {
    $width = "800";
}

$explorer = $_GET[explorer];
if ($explorer == "0")
{
echo("<iframe id=\"iframe1\" src=$_GET[chatnum] width=\"$width\" height=\"400\"></iframe>");
}

if ($explorer == "1")
{
echo("
<div style=\"overflow:scroll; -webkit-overflow-scrolling:touch; width:700px; height:400px;\">
<iframe id=\"iframe1\" src=$_GET[chatnum] width=\"700\" height=\"400\" ></iframe></div>");
echo("<
<div style=\"overflow:scroll; -webkit-overflow-scrolling:touch; width:700px; height:400px;\">
<iframe id=\"iframe2\" src=\"http://$ip/textengine/sitechats/media/$_GET[chatnum]/uploaded\" width=\"610\" height=\"400\"></iframe></div>");
//echo("<p></p>");
}



echo("

<form action=\"sendmsg_integration.php\" method=\"GET\" autocomplete=\"off\" onsubmit=\"sendmymessage(); reloadiframe(); return false\">
<fieldset draggable=\"false\">
<legend>Say something: </legend>
<br>
Message: <input id='msg' type=\"text\" name=\"msg\"><br>
<input type=\"hidden\" id=\"custid1\" name=\"write\" value=\"$_GET[chatnum]\"> 
<input type=\"hidden\" id=\"custid2\" name=\"encode\" value=\"$_GET[encoderm]\"> 
<input type=\"hidden\" id=\"custid3\" name=\"namer\" value=\"$_GET[namer]\"> 
<input type=\"hidden\" id=\"custid4\" name=\"name\" value=\"$_GET[namer]\"> 
<input type=\"hidden\" id=\"custid5\" name=\"uid\" value=\"$_GET[uid]\"> 
<input type=\"hidden\" id=\"custid6\" name=\"ukey\" value=\"$_GET[ukey]\"> 

Media Options: $mediaoptions
<input type=\"submit\" style=\"color:black\" value=\"Send\">
</fieldset>
</form>




<!--script>
document.getelementbyid('iframe1').contentwindow.location.reload();
</script-->


   <script>
   	function sendmymessage() {
	var msg = document.getElementById('msg').value;
	var des = document.getElementById('custid1').value;
	var enc = document.getElementById('custid2').value;
	var nam = document.getElementById('custid3').value;
	var nar = document.getElementById('custid4').value;
	var uid = document.getElementById('custid5').value;
	var uky = document.getElementById('custid6').value;
	var meaningfulname = [\"sendmsg_integration.php?msg=\",msg,\"&write=\",des,\"&encode=\",enc,\"&namer=\",nam,\"&rurl=norefer&referer=norefer&uid=\",uid,\"&ukey=\",uky];
	var theUrl = meaningfulname.join('');
	var boi = theUrl.concat(' :: sending request')
	console.log(boi);
	var msg = document.getElementById('msg').value = '';
	

	var xmlHttp = new XMLHttpRequest();
	xmlHttp.onreadystatechange = function() { 
			//console.log(xmlHttp.responseText);
			var boi = 'boi';
    }
	xmlHttp.open(\"GET\", theUrl, true); // true for asynchronous 
	xmlHttp.setRequestHeader(\"Cache-Control\", \"no-cache, no-store, max-age=0\");
    xmlHttp.send(null);
	}
	
   var myIframe = document.getElementById('iframe1');
myIframe.onload = function () {
    myIframe.contentWindow.scrollTo(0,99999999999999999999);
}

window.onload = function(){
   setTimeout(function () { window.scrollTo(0, 9999999999999999999999999); }, 100);
}

document.addEventListener('keydown', bruhw234re);

function bruhw234re() {
if (event.isComposing || event.keyCode === 27) {
    document.getElementById(\"msg\").focus();
  }
}

   var _refreshrate = $_GET[refreshrate] 
   setInterval(function(){ reloadiframe(); }, _refreshrate);


        function reloadiframe() {
            console.log('reloading..');
            document.getElementById(\"iframe1\").contentWindow.location.reload(false);
        }
    </script>
	
<noscript>
<hr>
<i style=\"color:red\">WARNING:</i> Your browser does not support JS (JavaScript). 
This will break live-updating functionality, but it will not stop you from chatting.
<hr>
</noscript>
");

if ($explorer == "1")
{
echo("
 <script>
   var _refreshrate = $_GET[refreshrate] 
   setInterval(function(){ reloadiframe(); }, 30000);

window.onload = function(){
   setTimeout(function () { window.scrollTo(0, 9999999999999999999999999); }, 100);
}

        function reloadiframe() {
            console.log('reloading..');
            document.getElementById(\"iframe2\").contentWindow.location.reload(false);
        }
    </script>
	
<!--meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"-->



<br>
");

};
$useleg = plsk(19);

if ($useleg == 'YES') {
echo("
<form action='http://$ip/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&encoderm=$_GET[encoderm]&namer=$_GET[namer]' method='get'>
<code>Change RR:</code> <input type='text' style='width: 69px;' name='refreshrate' value='$_GET[refreshrate]'>
<input type='hidden' name='chatnum' value='$_GET[chatnum]'>
<input type='hidden' name='encoderm' value='$_GET[encoderm]'>
<input type='hidden' name='namer' value='$_GET[namer]'>
<input type='hidden' name='explorer' value='$_GET[explorer]'>
<input type='submit' value='Go'>
</form>
<form action='http://$ip/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&encoderm=$_GET[encoderm]&namer=$_GET[namer]' method='get'>
<code>Authenticate with UID/UKEY:</code> <input type='text' style='width: 32px;' name='uid'><input type='text' style='width: 128px;' name='ukey'>
<input type='hidden' name='chatnum' value='$_GET[chatnum]'>
<input type='hidden' name='refreshrate' value='$_GET[refreshrate]'>
<input type='hidden' name='encoderm' value='$_GET[encoderm]'>
<input type='hidden' name='namer' value='$_GET[namer]'>
<input type='hidden' name='explorer' value='$_GET[explorer]'>
<input type='submit' value='Go'>
</form>
<code>Join by URL (USE THIS URL TO LET OTHERS IN):<br></code><code><a href='http://$ip/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]'>http://$ip/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]</a></code>  <br>");
} else {
echo("
<form action='http://$ip/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&encoderm=$_GET[encoderm]&namer=$_GET[namer]' method='get'>
<code>Change RR:</code> <input type='text' style='width: 69px;' name='refreshrate' value='$_GET[refreshrate]'>
<input type='hidden' name='chatnum' value='$_GET[chatnum]'>
<input type='hidden' name='encoderm' value='$_GET[encoderm]'>
<input type='hidden' name='namer' value='$_GET[namer]'>
<input type='hidden' name='explorer' value='$_GET[explorer]'>
<input type='submit' value='Go'>
</form>
<form action='http://$ip/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&encoderm=$_GET[encoderm]&namer=$_GET[namer]' method='get'>
<code>Authenticate with UID/UKEY:</code> <input type='text' style='width: 32px;' name='uid'><input type='text' style='width: 128px;' name='ukey'>
<input type='hidden' name='chatnum' value='$_GET[chatnum]'>
<input type='hidden' name='refreshrate' value='$_GET[refreshrate]'>
<input type='hidden' name='encoderm' value='$_GET[encoderm]'>
<input type='hidden' name='namer' value='$_GET[namer]'>
<input type='hidden' name='explorer' value='$_GET[explorer]'>
<input type='submit' value='Go'>
</form>
<code>Join by URL (USE THIS URL TO LET OTHERS IN):<br></code><code><a href='http://$ip/textengine/sitechats/joinchatpublic.php?cn=$_GET[chatnum]'>http://$ip/textengine/sitechats/joinchatpublic.php?cn=$_GET[chatnum]</a></code>  <br>");
}

