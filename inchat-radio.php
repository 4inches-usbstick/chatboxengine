<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;   
}

//audio { width: 1050px; height: 200px; display: block; }



</style>

<?php


$formact = "http://71.255.240.10:8080/textengine/sitechats/media/uploadform.php?chatnum1=$_GET[chatnum]&rr=$_GET[refreshrate]";
error_reporting(1);
$mediaoptions = 0;
$gethttd = file_get_contents("http://71.255.240.10:8080/textengine/sitechats/media/$_GET[chatnum]");


if ($gethttd === false) {
	$bruh = 'bruh';
} else {
	$mediaoptions = "<a href='http://71.255.240.10:8080/textengine/sitechats/media/uploadform.php?chatnum1=$_GET[chatnum]&rr=$_GET[refreshrate]'>Upload Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat-div.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=1&encoderm=$coder&bbg=$_GET[bbg]\">Find / Post Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat-div.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]\">Close Media Finder, </a><br>";
	$type = 'leg';
}


$nub = substr($_GET['chatnum'], 0, -5);
$gethttd = file_get_contents("http://71.255.240.10:8080/textengine/sitechats/media/$nub-med");

if ($gethttd === false) {
	$bruh = 'bruh';
} else {
	$mediaoptions = "<a href='http://71.255.240.10:8080/textengine/sitechats/media/uploadform4html.php?chatnum1=$_GET[chatnum]&rr=$_GET[refreshrate]'>Upload Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat-div.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=1&encoderm=$coder&bbg=$_GET[bbg]\">Find / Post Media, </a>
<a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat-div.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]\">Close Media Finder, </a><br>";
	$type = 'htm';
}
echo($type);

if(empty($type)) {
		$mediaoptions = "<code style=\"background: black; color: white\">Media uploads have been disabled for this Chatbox.</code><br>";
}


error_reporting(0);

$coder = $_GET['encoderm'];
if (empty($_GET['encoderm'])) {
    $coder = "UTF-8";
}



echo("<title>[radio-div] Chatbox $_GET[chatnum]</title>

");
echo("refresh rate: ");
echo("$_GET[refreshrate]ms<br>"   );

echo("tuned into: ");
echo("$_GET[chatnum]<br>"   );


echo("   ");
//echo("<a href=\"http://71.255.240.10:8080/textengine/change.txt\">Learn more</a>, <a href=\"http://71.255.240.10:8080/textengine/map.html\">Homepage</a>");
//echo("<br>encoder: $coder<br>");
echo("<code style=\"color:red\" draggable=\"false\">trigger warning: this site contains flashing images. </code><br><br>");


$width = $_GET["wide"]; 
if (empty($width)) {
    $width = "800";
}

$explorer = $_GET[explorer];

//echo("<iframe id=\"iframe1\" src='display.php?path=$_GET[chatnum]&pass=$_GET[pass]' width=\"$width\" height=\"400\"></iframe>");

$getter = "http://71.255.240.10:8080/textengine/sitechats/display.php?chatbox=$_GET[chatnum]";
echo("<div id='mydiv' style='height:400px;width:800px;overflow:auto;background-color:white;color:black;scrollbar-base-color:gold;padding:10px;border-style: solid;border-width: 1px;'><p id='stuff'><p id=\"funstart\"> </p><audio controls id='bruh1'><source src='bruh.mp3' type='audio/mpeg'></audio><br><br><p id=\"fun\"> </p></p></div>");

if ($_GET['explorer'] == 1 and $type == 'leg') {
	echo("<iframe id=\"iframe2\" src=\"http://71.255.240.10:8080/textengine/sitechats/media/$_GET[chatnum]/uploaded\" width=\"610\" height=\"400\">no</iframe>");
}
if ($_GET['explorer'] == 1 and $type == 'htm') {
	echo("<iframe id=\"iframe3\" src=\"http://71.255.240.10:8080/textengine/sitechats/media/$nub-med/uploaded\" width=\"610\" height=\"400\">no</iframe>");
}


$formaction = substr_count($_GET["chatnum"], '.html');
if ($formaction > 0) {
	$form = 'sendmsg4html.php';
	$way = 'POST';
} else {
	$form = 'sendmsg_integration.php';
	$way = 'GET';
	echo("<style>div { white-space: pre-wrap; }</style>");
}
	
echo("



  <script>


function inihttpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
			//console.log(xmlHttp.responseText);
			//document.getElementById(\"stuff\").innerHTML = xmlHttp.responseText;
			
			var str = xmlHttp.responseText
			var things = str.split(\";;\");
		

			
			document.getElementById(\"bruh1\").src = things[0];
			//document.getElementById(\"bruh1\").load();
			document.getElementById(\"bruh1\").play();
			document.getElementById(\"funstart\").innerHTML = things[1];
			document.getElementById(\"fun\").innerHTML = things[2];
			document.getElementById(\"mydiv\").scrollTo(0,999999999999999);
			var str1 = theUrl;
			var str2 = \"?math=\";
			var str3 = Math.random();
			var res = str1.concat(str2);
			var url = res.concat(str3);
			console.log(url);
			console.log(xmlHttp.responseText);
			
		
			



    }
    xmlHttp.open(\"GET\", theUrl, true); // true for asynchronous 
	xmlHttp.setRequestHeader(\"Cache-Control\", \"no-cache, no-store, max-age=0\");
    xmlHttp.send(null);
}

function scrollToBottom (id) {
   var div = document.getElementById(id);
   div.scrollTop = div.scrollHeight - div.clientHeight;
}

var pre = inihttpGet(\"$getter\");
	

   var myIframe = document.getElementById('iframe1');
//myIframe.onload = function () {
  //  myIframe.contentWindow.scrollTo(0,99999999999999999999);
//}
   var _refreshrate = $_GET[refreshrate] 
   setInterval(function(){ reloadiframe(); }, _refreshrate);


        function reloadiframe() {
          var whatin = document.getElementById(\"bruh1\");
		  console.log(whatin.currentTime);
		  console.log(whatin.duration);
		  				//document.getElementById(\"bruh1\").play();
						//document.getElementById(\"bruh1\").muted = false;
						//console.log('P-no reload');
						//document.getElementById(\"src\").innerHTML = document.getElementById(\"bruh1\").src;
			if (whatin.currentTime == whatin.duration || isNaN(whatin.duration)) {
				//document.getElementById(\"stuff\").innerHTML = inihttpGet(\"$getter\");
				inihttpGet(\"$getter\")
				console.log('reloaded.');
				//console.log(inihttpGet(\"$getter\"))
				//document.getElementById(\"bruh1\").play()
				//setTimeout(function() { document.getElementById(\"bruh1\").play(); }, 5000);
				//window.location.href=window.location.href;
			}
		function send() {
			          var whatin = document.getElementById(\"bruh1\");
					  whatin.currentTime = whatin.duration;
		}
			
			
		
			
			
			
			
        }
    </script>

<noscript>
<hr>
<i style=\"color:red\">WARNING:</i> Your browser does not support JS (JavaScript). 
This will break live-updating functionality, but it will not stop you from chatting.
<hr>
</noscript>
<!--script>
document.getelementbyid('iframe1').contentwindow.location.reload();
</script-->




<fieldset>
<legend>Actions</legend>
 <input type=\"button\" style=\"color:black\" value=\"HARD RELOAD\" onclick='window.location.href=window.location.href' >
 <input type=\"button\" style=\"color:black\" value=\"SOFT RELOAD\" onclick='reloadiframe()' >
&nbsp;&nbsp;&nbsp;&nbsp;
  <input type=\"button\" style=\"color:black\" value=\"REWIND\" onclick='document.getElementById(\"bruh1\").currentTime = 0' >
  <input type=\"button\" style=\"color:black\" value=\"STOP\" onclick='document.getElementById(\"bruh1\").pause(); document.getElementById(\"bruh1\").muted = true; '>
  <input type=\"button\" style=\"color:black\" value=\"START\" onclick='document.getElementById(\"bruh1\").play(); document.getElementById(\"bruh1\").muted = false;'>
 <input type=\"button\" style=\"color:black\" value=\"FORWARD\" onclick='document.getElementById(\"bruh1\").currentTime = document.getElementById(\"bruh1\").duration' >



<!--input type=\"button\" style=\"color:black\" onclick=\"location.href='http://71.255.240.10:8080/textengine/sitechats/high-security/media/uploadform.php';\" value=\"Upload Files\" /-->
</fieldset>
<br>

");


//echo("<code>Join by URL:<br></code><code>http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]</code>  <br>");
//echo("<code>Join by URL:<br></code><code><a href='http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]'>http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]</a></code>  <br>");


