<title>engine page</title>

<?php
echo("</p></p><hr>");
error_reporting(0);
echo("<b>Embed HTML:</b><br>");

$tolink = "\"&lt;iframe id=&quot;$_POST[domid]&quot; src=&quot;$_POST[URL]&quot; height=&quot;$_POST[height]&quot; width=	&quot;$_POST[width]&quot;&gt;&lt;/iframe&gt;\"";






echo("

<p id=\"OP\">Embed failed to generate</p>
<script>
function myFunction() {
  document.getElementById(\"OP\").innerHTML = $tolink;
}

var t = setTimeout(myFunction, 0100)

</script>

<noscript>
<hr>
<i style=\"color:red\">ERROR:</i> Your browser does not support JS (JavaScript). 
This will prevent you from creating an embed link.
<hr>
</noscript>
	  

");

?>
