<html>

<title>New Chatbox</title>
<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;     /* oranges! yey */
}

</style>


<p>
Create a new chatbox. The chatbox name cannot have any special characters / spaces, only the 26 letters of the alphabet, and the numbers 0-9. No spaces or punctuation either. This slot cannot be left blank.
</p>
<br><br>
<form action="newchat_integration.php" method="get">
<fieldset>
<legend>Create a new chatbox</legend>
<br>
Session number: <input type="text" name="newname" size="100" height="10"><br><br>

<b>Create a:</b><br>

Legacy Chatbox <input type="radio" id="male" name="option" value="l" checked="checked"><br>
HTML Chatbox <input type="radio" id="male1" name="option" value="h"><br><br>
CBEDATA Chatbox <input type="radio" id="male1" name="option" value="d"><br><br>

<b>Options:</b><br>
Allow Media Upload? <input type="checkbox" id="allowmed" name="allowmed" value="allowmed" checked="checked"><br><br>


<input type="submit" value="Create" style="color:black">
</fieldset>
</form>



</html>