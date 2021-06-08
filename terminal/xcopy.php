<?php
//make a copy of a chat
if ($_GET["cmd"] == "xcopy" and $_GET["pass"] == $pass)
{


$params = $_GET["params"];
$abspath = dirname($params);
$path = "$abspath/$params";
$takesrc = $path;
$destiny = "$cc/$params";

$yes = copy($takesrc, $destiny);
echo("Copied files");

}

//make a copy of a chat but append it to the current file
if ($_GET["cmd"] == "xcopy --append" and $_GET["pass"] == $pass)
{

$cpc = file_get_contents($_GET['params']);
$f = fopen("$cc/$_GET[params]", 'a');
fwrite($f, $cpc);
fclose($f);
echo("Copied chatbox and appended it to any existing copies");

}
//sleep(0
?>