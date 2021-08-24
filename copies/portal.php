  <?php
if ($_GET['password'] == file_get_contents('.htapassword')) {
	$content = file_get_contents($_GET['file']);
} else {
	$content = '[err:33] Stop: Generic Authorization Error prevented the loading of this file.';
}
?>

<h1>Remote Editing Portal</h1>

<form action="terminalprocess.php" method='post'>
 Command <input type="hidden" name="cmd" value='cedit'> <b>cedit</b> <p></p>
 Password <input type="password" name="pass" size="100" height="10"> <p></p>
 File <input type="text" name="write" size="100" height="10" value=<?=$_GET['file']?>> <p></p>
 
 <textarea id="w3review" name="params" rows="25" cols="100">
  <?=$content?> </textarea><br>
<input type='submit' value='Go'>
