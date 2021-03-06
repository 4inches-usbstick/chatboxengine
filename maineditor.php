<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson
  ;   
}

input[type=password] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=password]:focus{
  outline: 2px solid Crimson
  ;   
}


</style>
<?php
$currentpolicy = file_get_contents('.htamainpolicy');
include 'mainlookup.php';
if (plsk(35) != 'YES') {
	die('This utility has been disabled by PID 35.');
}
?>

<h2>Main Policy Editor</h2>

<title>inieditor</title>
<!--img src="http://71.255.240.10:8080/textengine/engine.png"-->
<hr>
...
<hr>
<form action="terminalprocess.php" method='post'>
 Command <input type="hidden" name="cmd" value='inicfg'> <b>inicfg</b> <p></p>
 Password <input type="password" name="pass" size="100" height="10"> <p></p>
 
 <textarea id="w3review" name="params" rows="25" cols="100">
  <?=$currentpolicy?>
  </textarea>
 
 <br><hr>
 <hr>
  
<input id="verbose0" type="submit" value="Execute" style="color:black"><br>
</form>


	

