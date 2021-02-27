<title>engine page</title>
<?php
		
ini_set('upload_max_filesize', '12M');
ini_set('post_max_size', '12M');
ini_set('max_input_time', 300);
ini_set('max_execution_time', 300);
//echo("Chatbox directory: $_GET[chatnum1]");
error_reporting(0);
		
     
//echo "<p>" . $_POST['ftu'] . "</p>";

$file_name = $_FILES['ftu']['name'];
$file_tmp = $_FILES['ftu']['tmp_name'];
$chatboxdir = $_POST["hidden"];
$target_dir = ("C:/wamp64/www/textengine/sitechats/media/$chatboxdir/uploaded/$file_name");

move_uploaded_file($file_tmp, $target_dir); 
//rename($target_dir/$file_name, $target_dir/$file_name/$chatboxdir);
echo($target_dir . "<br>");

$URL = $_SERVER['HTTP_REFERER'];
//header("Location: $URL");
			
           
            
        
		
		
		?>