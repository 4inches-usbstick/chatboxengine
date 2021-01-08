<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;   
}
</style>
<title>Remote Send Command Generator</title>
<form action="remote_chatbox_gen.php" method="post">
<fieldset>
<legend>Create a Remote Chatbox Command</legend>
<br>
Chatbox Number: <input type="text" name="URL" size="100" height="10"> (the Chatbox Number)<br>
HTML/Legacy: <input type="text" name="mess" size="100" height="10">(allowed values: h for HTML or l for legacy)<br>
Allow Media: <input type="text" name="enc" size="100" height="10" value="allowmed"> (allowed values: allowmed or forbidmed)<br>
Referer: <input type="text" name="ref" size="100" height="10" value=""> (default: empty for return to referer)<br>
<br>
<input type="submit" value="Generate" style="color:black">
</fieldset>
</form>

<p></p>
<br>
<!--p>Default Refresh Rate: 30000</p-->
<a href="http://71.255.240.10:8080/textengine/map.html">Go back to home</a> <p></p>



