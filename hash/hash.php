<?php
function input_password_handler($uid, $skey, $ckey) {
	//echo(hash('sha512',str_replace("%%password",$skey,explode('=',explode('//',$ckey)[1])[0])) . '<br>');
	return(hash('sha512',str_replace("%%password",$skey,explode('=',explode('//',$ckey)[1])[0])));
}

function output_password_handler($uid, $skey, $ckey) {
	//echo explode('=',explode('//',$ckey)[1])[1];
	return explode('=',explode('//',$ckey)[1])[1];
}
?>