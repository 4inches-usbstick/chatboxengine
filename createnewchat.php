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
<form action="newchat.php" method="post">
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

<a href="http://71.255.240.10:8080/textengine/map.html">Go back to home</a><br>

A session number is a unique token that is used for identification. To open a specific Chatbox, you need the session number. It can also be called a Chatbox number, number, code, Chatbox code, and anything that means the same thing.<br><br>
HTML chatboxes allow you and those who join to 'draw' by pasting HTML elements. When you go to join an HTML chatbox with joinchatpublic.php, choose HTML mode.
<!--p>
New Fun:
If you add .html to the end of the Chatbox number, you can get it so by entering elements instead of text into the Chatbox, you can draw in HTML instead of chatting in plain text.
While this is not officially supported, it works. And it's fun. You can also add CSS and JS to customize it to your heart's content. Note however, that anyone can add JS and CSS, so unless you know you are safe, do not use this option. 
You cannot see things like CSS and JS without Inspector, so hidden elements may pose a threat.
<p></p>
However, .html chatboxes are very unsafe, which pose a real problem, so please don't do it. Also, users are advised not to join .html chatboxes they don't trust. Any other file type is also dangerous.
</p-->
</html>