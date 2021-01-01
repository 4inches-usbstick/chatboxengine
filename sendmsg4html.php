Diags<br>
<?php
date_default_timezone_set('America/New_York');
//error_reporting(0);
$myfile = fopen("$_POST[write]", "a");

//check for iframes or js, security measure
$iframe = substr_count($_POST["msg"], 'iframe');
$script = substr_count($_POST["msg"], 'script');

if ($iframe > 0 or $script > 0) {
	die("Illegal element found in string detected, halted.<br>");
}
//end that


//encoding yes
$mess = $_POST["msg"];
$emptyencode = empty($_POST["encode"]);
$coder = $_POST["encode"];

if (empty($coder) or $coder == "UTF-8") {
    //echo('UTF8');
	$coder = "UTF-8";
}

$mess = $_POST["msg"];
$mess1 = mb_convert_encoding($mess, $coder);

$option = $_POST["option"];

if ($option == "h1") { 
$mess2 = "<h1>$mess1</h1>";
}

if ($option == "h2") { 
$mess2 = "<h2>$mess1</h2>";
}

if ($option == "h3") { 
$mess2 = "<h3>$mess1</h3>";
}

if ($option == "h4") { 
$mess2 = "<h4>$mess1</h4>";
}

if ($option == "h5") { 
$mess2 = "<h5>$mess1</h5>";
}

if ($option == "h6") { 
$mess2 = "<h6>$mess1</h6>";
}
//sdf
if ($option == "p") { 
$mess2 = "<p>$mess1</p>";
}

if ($option == "b") { 
$mess2 = "<b>$mess1</b><br>";
}

if ($option == "i") { 
$mess2 = "<i>$mess1</i><br>";
}

if ($option == "a") { 
$mess2 = "<a href=\"$mess1\">$mess1</a><br>";
}

if ($option == "img") { 
$mess2 = "<img src=\"$mess1\" style=\"max-height: 216px;  max-width: 384px;\"></img><br>";
}

if ($option == "video") { 
$mess2 = "<video width=\"384\" height=\"216\" controls> <source src=\"$mess1\" type=\"video/mp4\"></video><br>";
}

if ($option == "audio") { 
$mess2 = "<audio controls> <source src=\"$mess1\" type=\"audio/mpeg\"></audio><br>";
}

if ($option == "break") { 
$mess2 = "<br>";
}


if ($option == "pt") { 
$mess2 = "$mess1<br>";
}

if ($option == "c") { 
$mess2 = "<code>$mess1</code><br>";
}

if ($option == "u") { 
$mess2 = "<u>$mess1</u><br>";
}

if ($option == "s") { 
$mess2 = "<s>$mess1</s><br>";
}


fwrite($myfile, "$mess2\n");
fclose($myfile);
echo("submitted<br>");
$URL = $_SERVER['HTTP_REFERER'];
header("Location: $URL");
echo("$coder encoder<br>");
echo("$mess1 = message<br>");
echo("$mess2 = messageHTML<br>");

?>

<p></p>
<form>
 <input type="button" value="← Back" onclick="history.back()">
</form>


