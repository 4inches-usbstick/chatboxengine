

 
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
        <form action=\"upload1process.php\" method=\"POST\" enctype=\"multipart/form-data\">
            <input type=\"file\" name=\"ftu\">
			<input type=\"hidden\" name=\"hidden\" value=$_GET[chatnum1]>
            <input type=\"submit\" name=\"submit\" style=\"color:black\">
        </form>
		
		<hr>
		<!--a href=\"http://71.255.240.10:8080/textengine/sitechats/inchat.php?chatnum=$_GET[chatnum1]&refreshrate=$_GET[rr]&explorer=0\">Back to Chatbox</a--><br>
		<hr>


      
		
		
		
<!--Possible Outcomes:
1. It appears the same after submitting == Success <p></p>
2. Error pops up == Failure <p></p>
3. Brower hangs == Failure <p></p>

");



