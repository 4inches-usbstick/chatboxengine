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
error_reporting(0);

$coder = $_GET['encoderm'];
if (empty($_GET['encoderm'])) {
    $coder = "UTF-8";
}

$mediaoptions = 0;
$med = substr($_GET['chatnum'], 0, -5);
$gethttd = file_get_contents("http://71.255.240.10:8080/textengine/sitechats/media/$med-med");
//echo("http://71.255.240.10:8080/textengine/sitechats/media/$med");

if ($gethttd === false) {
	$mediaoptions = "<code style=\"background: black; color: white\">Media uploads have been disabled for this Chatbox.</code><br>";
} else {
	$mediaoptions = "Media Options: <a href=$formact>Upload Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=1&encoderm=$coder&bbg=$_GET[bbg]\">Find / Post Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]\">Close Media Finder, </a><br>";
}





echo("<title>[ifr] Chatbox $_GET[chatnum]</title>

<style>
body {
  background-image: url($_GET[bbg]);
}
</style>



");
echo("<code style=\"color:red\">trigger warning: this site contains flashing images. </code>");
//echo("chatbox number: $_GET[chatnum]  <br>");
//echo("refresh rate: ");
//echo("<b>$_GET[refreshrate]</b>ms"   );
//echo("   ");
//echo("<a href=\"http://71.255.240.10:8080/textengine/change.txt\">Learn more</a>, <a href=\"http://71.255.240.10:8080/textengine/map.html\">Homepage</a><br>");

echo("refresh rate: ");
echo("$_GET[refreshrate]ms"   );
echo("   ");
//echo("<a href=\"http://71.255.240.10:8080/textengine/change.txt\">Learn more</a>, <a href=\"http://71.255.240.10:8080/textengine/map.html\">Homepage</a>");
echo("<br>encoder: $coder<br>");



$explorer = $_GET[explorer];
if ($explorer == "0")
{
echo("<iframe id=\"iframe1\" src=$_GET[chatnum] width=\"1080\" height=\"400\"></iframe>");
}

if ($explorer == "1")
{
$mediadir0 = substr($_GET[chatnum], 0, -5);
$mediadir = "$mediadir0-med";
echo("<iframe id=\"iframe1\" src=$_GET[chatnum] width=\"700\" height=\"400\"></iframe>");
echo("<iframe id=\"iframe2\" src=\"http://71.255.240.10:8080/textengine/sitechats/media/$mediadir/uploaded\" width=\"610\" height=\"400\"></iframe>");
//echo("<p></p>");
}



$formact = "http://71.255.240.10:8080/textengine/sitechats/media/uploadform.php?chatnum1=$_GET[chatnum]&rr=$_GET[refreshrate]";

echo("
<form action=\"sendmsg4html-ext.php\" method=\"POST\" autocomplete=\"off\">
<fieldset>
<legend>Options</legend>

<!--for secutity reasons we don't allow ifrmes-->

<code><b>
br<input type=\"radio\" id=\"male934\" name=\"option\" value=\"break\">
h1<input type=\"radio\" id=\"male\" name=\"option\" value=\"h1\">
h2<input type=\"radio\" id=\"male1\" name=\"option\" value=\"h2\">
h3<input type=\"radio\" id=\"male2\" name=\"option\" value=\"h3\">
h4<input type=\"radio\" id=\"male3\" name=\"option\" value=\"h4\">
h5<input type=\"radio\" id=\"male4\" name=\"option\" value=\"h5\">
h6<input type=\"radio\" id=\"male5\" name=\"option\" value=\"h6\">
a<input type=\"radio\" id=\"male6\" name=\"option\" value=\"a\">
p<input type=\"radio\" id=\"male7\" name=\"option\" value=\"p\">
i<input type=\"radio\" id=\"male8\" name=\"option\" value=\"i\">
b<input type=\"radio\" id=\"male9\" name=\"option\" value=\"b\">
u<input type=\"radio\" id=\"male86\" name=\"option\" value=\"u\">
s<input type=\"radio\" id=\"male93\" name=\"option\" value=\"s\">
c<input type=\"radio\" id=\"male911\" name=\"option\" value=\"c\">
img<input type=\"radio\" id=\"male12\" name=\"option\" value=\"img\">
vid<input type=\"radio\" id=\"male82\" name=\"option\" value=\"video\">
aud<input type=\"radio\" id=\"male94\" name=\"option\" value=\"audio\">
ptx<input type=\"radio\" id=\"male13\" name=\"option\" value=\"pt\"  checked=\"checked\"><br>

</code></b>

<i><code>
$mediaoptions
</code>
</i>

</fieldset>

<fieldset>
<legend>Input</legend>
<code>
Message: <input type=\"text\" name=\"msg\">
<input type=\"hidden\" id=\"custid\" name=\"write\" value=\"$_GET[chatnum]\"> 
<input type=\"hidden\" id=\"custid\" name=\"encode\" value=\"$_GET[encoderm]\"> 

<input type=\"submit\" style=\"color:black\" value=\"Send\">
</fieldset>
</code>

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
            //document.getElementById(\"iframe1\").contentWindow.location.assign('$_GET[chatnum]');
			//document.getElementById(\"iframe1\").contentWindow.scrollTo(0,999999999999999999999999999999999999,false);
        }
    </script>
	
<noscript>
<hr>
<i style=\"color:red\">WARNING:</i> Your browser does not support JS (JavaScript). 
This will break live-updating functionality, but it will not stop you from chatting.
<hr>
</noscript>

<code><a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat4html.php?chatnum=$_GET[chatnum]&refreshrate=foobar&explorer=0&encoderm=$coder\">Watch Media Mode</a></code>
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
	



<br>
");



};
if ($_GET[refreshrate] == "foobar")
{
echo("
<br><code style=\"color:green;\">[!]: Watch Media mode is on. <a href=\"javascript:history.back()\">Turn it off.</a>
 </code>
");
}

?>
