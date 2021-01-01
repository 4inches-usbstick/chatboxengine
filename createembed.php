NOTE: Embeds are deprecated. Use the API instead.<br>
<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;   
}
</style>
<title>Embed Generator</title>
<form action="embed.php" method="post">
<fieldset>
<legend>Create an embed</legend>
<br>
Chatbox URL: <input type="text" name="URL" size="100" height="10"> (the Chatbox URL, not Chatbox number)<br>
Width: <input type="text" name="width" size="100" height="10" value="670"> (default: 670)<br>
Height: <input type="text" name="height" size="100" height="10" value="1000"> (default: 1000)<br>
DOM ID: <input type="text" name="domid" size="100" height="10" value="CBE0"> (default: CBE0)<br>
<br>
<input type="submit" value="Generate" style="color:Gray">
</fieldset>
</form>

<p></p>
<br>
<!--p>Default Refresh Rate: 30000</p-->
<a href="http://71.255.240.10:8080/textengine/map.html">Go back to home</a> <p></p>


To get a Chatbox URL, join the Chatbox and then get the Join By URL (or the URL you would use to join the Chatbox) then copy the URL and use it as you need.<br><br>
To embed, simply paste the iFrame into your webpage.