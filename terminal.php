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

<h2>Remote Management Terminal</h2>

<title>Chatbox Engine Terminal</title>
<!--img src="http://71.255.240.10:8080/textengine/engine.png"-->
<hr>
<a href="http://71.255.240.10:8080/textengine/map.html">Home</a>
<hr>
<form action="terminalprocess.php">
 Command <input type="text" name="cmd" size="100" height="10"> <p></p>
 Parameter <input type="text" name="params" size="100" height="10"> <p></p>
<p></p>
 Password <input type="password" name="pass" size="100" height="10"> <p></p>
 
 <hr>
 <input type="checkbox" name="horns" name="verbosemode" checked>
  <label for="horns">No Verbose</label><br><br>
  
<input id="verbose0" type="submit" value="Send Command" style="color:Gray"><br>
</form>


	
