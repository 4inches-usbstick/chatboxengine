<title>engine page</title>

<?php
echo("</p></p><hr>");
error_reporting(0);
echo("<b>Remote Command</b><br>");

$tolink = "http://71.255.240.10:8080/textengine/sitechats/sendmsg_integration.php?write=$_POST[URL]&encode=$_POST[enc]&msg=$_POST[mess]&namer=$_POST[namer]&rurl=$_POST[ref]";
$to = "http&colon;&sol;&sol;71&period;255&period;240&period;10:8080/textengine/sitechats/sendmsg&lowbar;integration.php&quest;write=$_POST[URL]&amp;encode=$_POST[enc]&amp;msg=$_POST[mess]&amp;namer=$_POST[namer]&amp;rurl=$_POST[return]";






echo("
<p id=\"OP\">Remote send command failed to generate</p>
<script>
function myFunction() {
  document.getElementById(\"OP\").innerHTML = \"$tolink\";
}

var t = setTimeout(myFunction, 0100)

</script>

<noscript>
<hr>
<i style=\"color:red\">ERROR:</i> Your browser does not support JS (JavaScript). 
This will prevent you from creating an remote send command link.
<hr>
</noscript>
	  

");

?>
