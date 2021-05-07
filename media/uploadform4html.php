
 
<style>

input[type=text] {
  border: 1px solid LightSlateGrey;
  border-radius: 4px;
}

input[type=text]:focus{
  outline: 2px solid Crimson;     /* oranges! yey */
}

</style>
<h2>Upload file page</h2><hr>
<?php
echo("
<title>Upload page $_GET[chatnum1]</title>
        <form action=\"upload1process4html.php\" method=\"POST\" enctype=\"multipart/form-data\" id='formobj'>
            <input type=\"file\" name=\"ftu\" id='inputobj'>
			Chatbox<input type=\"text\" name=\"hidden\" value=$_GET[chatnum1]>
            <input type=\"submit\" name=\"submit\" style=\"color:black\">
        </form>
		
		<hr>
				You can copy-paste an image to choose it and hit Submit.
		<!--a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum1]&refreshrate=$_GET[rr]&explorer=0\">Back to Chatbox</a--><br>
		<hr>

      <script>
	  const form = document.getElementById(\"formobj\");
	const fileInput = document.getElementById(\"inputobj\");

fileInput.addEventListener('change', () => {
  form.submit();
});

window.addEventListener('paste', e => {
  fileInput.files = e.clipboardData.files;
});
</script>


      
		
		
		
<!--Possible Outcomes:
1. It appears the same after submitting == Success <p></p>
2. Error pops up == Failure <p></p>
3. Brower hangs == Failure <p></p>

");


