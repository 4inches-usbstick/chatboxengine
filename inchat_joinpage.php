
<form action="inchat_joinpage_process.php" method="post">
<fieldset>
<legend>Change your name before joining (leave blank for no name)</legend>
<br>
 <input type="hidden" name="nums" size="100" height="10" value=<?=$_GET["chatnum"]; ?>>
 <input type="hidden" name="refreshrate" size="100" height="10" value=<?=$_GET["refreshrate"]; ?>> 
 <input type="hidden" name="enc" size="100" height="10" value=<?=$_GET["encoderm"]; ?>> 
  <input type="hidden" name="bbg" size="100" height="10" value=<?=$_GET["bbg"]; ?>> 
<b>Name:</b> <input type="text" name="name" size="100" height="10"> <br>

<b>Standard: </b>
div<input type="radio" id="male" name="option" value="div">
ifr<input type="radio" id="male1" name="option" value="ifr" checked='checked'>

<br>
<input type="submit" value="Join" style="color:Gray">
</fieldset>
</form>