<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;   
}
</style>
<title>Join Chatbox</title>
<form action="joinchat.php" method="post">
<fieldset>
<legend>Join a chatbox</legend>
<br>
Chatbox number: <input type="text" name="nums" size="100" height="10"><br>
Refresh rate: <input type="text" name="refreshrate" size="100" height="10" value="30000"> <br>
Encoder: <input type="text" name="enc" size="100" height="10" value="UTF-8"> <br>
Name: <input type="text" name="name" size="100" height="10"> <br>
<br>
<input type="submit" value="Join" style="color:Gray">
</fieldset>
</form>

<p></p>
<br>
<!--p>Default Refresh Rate: 30000</p-->
<a href="http://71.255.240.10:8080/textengine/map.html">Go back to home</a> <p></p>
<a href="http://71.255.240.10:8080/textengine/sitechats/info/change.txt">Read before changing refresh rate</a>

<p></p>
<!--
WARNING: If you are joining a chatbox with .html on the end, make sure that you trust this chatbox. These are pages that take HTML elements as input and makes a webpage you all can see and modify.
Anyone can add JS, which can execute somewhat malicious code on your end, or force downloads of files. These can be a real problem if you do not protect yourself. If there is another file extension in the name, do
NOT join the chatbox.
-->