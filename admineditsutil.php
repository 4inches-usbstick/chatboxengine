<? //i don't like the fact that Github says 2% hack so i put this here to shift the numbers ?>
<title>Editing Terminal</title>
<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;   
}

input[type=password] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=password]:focus{
  outline: 2px solid Crimson;   
}
</style>



<form action="admineditsreverse.php" method="GET" autocomplete="off">
<fieldset>
<legend>Nth Instance</legend>
<br>
Path: <input type="text" name="cb" size="100" height="10"><br>
Find str: <input type="text" name="gro" size="100" height="10"><br>
Index (begins at 0): <input type="text" name="index" size="100" height="10"><br>
Replace with str: <input type="text" name="rw" size="100" height="10"><br><br>
Key: <input type="password" name="key" size="100" height="10"><br><br><hr>

UID: <input type="text" name="uid" size="100" height="10"><br><br>
UKEY: <input type="text" name="ukey" size="100" height="10"><br><br>
<br>
<input type="submit" value="Send command" style="color:black">
</fieldset>
</form>

<form action="adminedits.php" method="GET" autocomplete="off">
<fieldset>
<legend>All Instance</legend>
<br>
Path: <input type="text" name="cb" size="100" height="10"><br>
Find str: <input type="text" name="gro" size="100" height="10"><br>
Replace with str: <input type="text" name="rw" size="100" height="10"><br><br>
Key: <input type="password" name="key" size="100" height="10"><br><br><hr>

UID: <input type="text" name="uid" size="100" height="10"><br><br>
UKEY: <input type="text" name="ukey" size="100" height="10"><br><br>
<br>
<input type="submit" value="Send command" style="color:black">
</fieldset>
</form>