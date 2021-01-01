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
<form action="remote_command_gen.php" method="post">
<fieldset>
<legend>Create an RSC</legend>
<br>
Chatbox Number: <input type="text" name="URL" size="100" height="10"> (the Chatbox Number, not Chatbox URL)<br>
Message: <input type="text" name="mess" size="100" height="10"><br>
Encoder: <input type="text" name="enc" size="100" height="10" value="UTF-8"> (default: UTF-8)<br>
Name: <input type="text" name="namer" size="100" height="10"><br>
Referer: <input type="text" name="ref" size="100" height="10" value="return"> (default: return)<br>
<br>
<input type="submit" value="Generate" style="color:Gray">
</fieldset>
</form>

<p></p>
<br>
<!--p>Default Refresh Rate: 30000</p-->
<a href="http://71.255.240.10:8080/textengine/map.html">Go back to home</a> <p></p>


<br><br>
To use the remote send command, just link to the URL and it will send the command to send a message.
<br>
<b>Special values: <br>"norefer" in the Referer box to not have an auto redirect to another page. <br>"return" in the Referer box to have it automatically redirect back to the previous page.<br>
 Leave the Name box empty to not use a name when posting into a Chatbox.<br>
 You must have a Chatbox Number and Message. Messages may not contain slashes, colons, or brackets.
