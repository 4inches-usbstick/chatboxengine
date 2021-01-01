<title>engine page</title>

<?php
echo("</p></p><hr>");
error_reporting(0);
echo("<b>Remote Command</b><br>");

$tolink = "http://71.255.240.10:8080/textengine/sitechats/newchat_integration.php?newname=$_POST[URL]&option=$_POST[mess]&allowmed=$_POST[enc]&rurl=$_POST[ref]";
$to = "http&colon;&sol;&sol;71&period;255&period;240&period;10:8080/textengine/sitechats/sendmsg&lowbar;integration.php&quest;write=$_POST[URL]&amp;encode=$_POST[enc]&amp;msg=$_POST[mess]&amp;namer=$_POST[namer]&amp;rurl=$_POST[return]";






echo("
$tolink
");

?>
