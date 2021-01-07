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

$formact = "http://71.255.240.10:8080/textengine/sitechats/media/uploadform.php?chatnum1=$_GET[chatnum]&rr=$_GET[refreshrate]";
error_reporting(0);
$mediaoptions = 0;
$gethttd = file_get_contents("http://71.255.240.10:8080/textengine/sitechats/media/$_GET[chatnum]");


if ($gethttd === false) {
	$mediaoptions = "<code style=\"background: black; color: white\">Media uploads have been disabled for this Chatbox.</code><br>";
} else {
	$mediaoptions = "<a href=$formact>Upload Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=1&encoderm=$coder&bbg=$_GET[bbg]\">Find / Post Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]\">Close Media Finder, </a><br>";
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
//echo("<a href=\"http://71.255.240.10:8080/textengine/change.txt\">Learn more</a>, <a href=\"http://71.255.240.10:8080/textengine/map.html\">Homepage</a>");
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
<iframe id=\"iframe2\" src=\"http://71.255.240.10:8080/textengine/sitechats/media/$_GET[chatnum]/uploaded\" width=\"610\" height=\"400\"></iframe></div>");
//echo("<p></p>");
}



echo("

<form action=\"sendmsg_integration.php\" method=\"GET\" autocomplete=\"off\">
<fieldset draggable=\"false\">
<legend>Say something: </legend>
<br>
Message: <input type=\"text\" name=\"msg\"><br>
<input type=\"hidden\" id=\"custid\" name=\"write\" value=\"$_GET[chatnum]\"> 
<input type=\"hidden\" id=\"custid\" name=\"encode\" value=\"$_GET[encoderm]\"> 
<input type=\"hidden\" id=\"custid\" name=\"namer\" value=\"$_GET[namer]\"> 

Media Options: $mediaoptions
<input type=\"submit\" style=\"color:black\" value=\"Send\">
</fieldset>
</form>




<!--script>
document.getelementbyid('iframe1').contentwindow.location.reload();
</script-->


   <script>
   var myIframe = document.getElementById('iframe1');
myIframe.onload = function () {
    myIframe.contentWindow.scrollTo(0,99999999999999999999);
}

window.onload = function(){
   setTimeout(function () { window.scrollTo(0, 9999999999999999999999999); }, 100);
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
echo("<code>Join by URL:<br></code><code><a href='http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]'>http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]</a></code>  <br>");

if ($explorer != '0' or $explorer != '1') {
	echo('<b style="color:red;">warning: explorer variable not set correctly.</b>');
}
