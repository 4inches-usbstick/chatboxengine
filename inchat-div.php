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



echo("<title>[div] Chatbox $_GET[chatnum]</title>

");
echo("refresh rate: ");
echo("$_GET[refreshrate]ms"   );
echo("   ");
//echo("<a href=\"http://71.255.240.10:8080/textengine/change.txt\">Learn more</a>, <a href=\"http://71.255.240.10:8080/textengine/map.html\">Homepage</a>");
echo("<br>encoder: $coder<br>");
echo("<code style=\"color:red\" draggable=\"false\">trigger warning: this site contains flashing images. </code><br><br>");


$width = $_GET["wide"]; 
if (empty($width)) {
    $width = "800";
}

$explorer = $_GET[explorer];

//echo("<iframe id=\"iframe1\" src='display.php?path=$_GET[chatnum]&pass=$_GET[pass]' width=\"$width\" height=\"400\"></iframe>");

$getter = "http://71.255.240.10:8080/textengine/sitechats/display.php?chatbox=$_GET[chatnum]";
echo("<div id='mydiv' style='height:400px;width:800px;overflow:auto;background-color:white;color:black;scrollbar-base-color:gold;padding:10px;border-style: solid;border-width: 1px;'><p id='stuff'>Chatbox <b>$_GET[chatnum]</b> has failed to load</p></div>");

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

<form action=\"$form\" method=\"$way\" autocomplete=\"off\" onsubmit=\"sendmymessagebitch();return false\">
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
Message: <input type=\"text\" name=\"msg\" id=\"msg\">
<input type=\"hidden\" id=\"custid1\" name=\"write\" value=\"$_GET[chatnum]\"> 
<input type=\"hidden\" id=\"custid2\" name=\"encode\" value=\"$_GET[encoderm]\"> 
<input type=\"hidden\" id=\"custid3\" name=\"name\" value=\"$_GET[namer]\"> 
<input type=\"hidden\" id=\"custid4\" name=\"namer\" value=\"$_GET[namer]\"> 

<input type=\"submit\" style=\"color:black\" value=\"Send\">
</fieldset>
</code>

</form>

  <script>
	function sendmymessagebitch() {
	var msg = document.getElementById('msg').value;
	var des = document.getElementById('custid1').value;
	var enc = document.getElementById('custid2').value;
	var nam = document.getElementById('custid3').value;
	var nar = document.getElementById('custid4').value;
	var opt = document.getElementsByName('option').value;
	var meaningfulname = [\"$form?msg=\",msg,\"&write=\",des,\"&encode=\",enc,\"&namer=\",nam,\"&rurl=norefer&referer=norefer\"];
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

	

function httpGet(theUrl)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
			//console.log(xmlHttp.responseText);
			document.getElementById(\"stuff\").innerHTML = xmlHttp.responseText;
			setTimeout(document.getElementById(\"mydiv\").scrollTo(0,999999999999999), 10);
			var str1 = theUrl;
			var str2 = \"?math=\";
			var str3 = Math.random();
			var res = str1.concat(str2);
			var url = res.concat(str3);
			//console.log(url);


    }
    xmlHttp.open(\"GET\", theUrl, true); // true for asynchronous 
	xmlHttp.setRequestHeader(\"Cache-Control\", \"no-cache, no-store, max-age=0\");
    xmlHttp.send(null);
}

function scrollToBottom (id) {
   var div = document.getElementById(id);
   div.scrollTop = div.scrollHeight - div.clientHeight;
}


document.addEventListener('keydown', bruhw234re);

function bruhw234re() {
if (event.isComposing || event.keyCode === 27) {
    document.getElementById(\"msg\").focus();
  }
}

var pre = httpGet(\"$getter\");
var cur = httpGet(\"$getter\");
	

   var myIframe = document.getElementById('iframe1');
//myIframe.onload = function () {
  //  myIframe.contentWindow.scrollTo(0,99999999999999999999);
//}
   var _refreshrate = $_GET[refreshrate] 
   setInterval(function(){ reloadiframe(); }, _refreshrate);


        function reloadiframe() {
            console.log('reloading..');
            var currentvar = httpGet(\"$getter\");

		
			
			

			
        }
    </script>

<noscript>
<hr>
<i style=\"color:red\">WARNING:</i> Your browser does not support JS (JavaScript). 
All features have been disabled, except for media upload (which does not use JS) and message send (which has a backup in case JS is not working). Sending messages may be substantially slower without JS.
<hr>
</noscript>

<!--script>
document.getelementbyid('iframe1').contentwindow.location.reload();
</script-->




<fieldset>
<legend>Actions</legend>
 <input type=\"button\" style=\"color:black\" value=\"Force Reload\" onclick='httpGet(\"$getter\")'>
<input type=\"button\" style=\"color:black\" onclick=\"location.href='http://71.255.240.10:8080/textengine/sitechats/inchat-div.php?chatnum=$_GET[chatnum]&refreshrate=foobar&encoderm=$_GET[encoderm]&namer=$_GET[namer]';\" value=\"No Polling Mode\" />
<!--input type=\"button\" style=\"color:black\" onclick=\"location.href='http://71.255.240.10:8080/textengine/sitechats/high-security/media/uploadform.php';\" value=\"Upload Files\" /-->
</fieldset>
<br>
");


//echo("<code>Join by URL:<br></code><code>http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]</code>  <br>");
echo("<code>Join by URL (USE THIS ONE TO LET OTHERS IN):<br></code><code><a href='http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]'>http://71.255.240.10:8080/textengine/sitechats/inchat_joinpage.php?chatnum=$_GET[chatnum]&refreshrate=$_GET[refreshrate]&explorer=0&encoderm=$coder&bbg=$_GET[bbg]</a></code>  <br>");


