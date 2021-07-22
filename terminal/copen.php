<?php
$sc = plsk(107);
if ($_GET['cmd'] == 'copen' && $_GET['pass'] == $pass) {
	$ps = explode(' ', $_GET['params']);
	
	if (plsk(55) == 'YES' && $useduid) {
		die('[err:23] Stop: Need masterkey for COPEN command [PID55]');
	}
	if (file_exists($ps[0])) {
		die('[err:18] Stop: This chatbox exists');
	}
	$notallowed = array('<', '>', ':', '"', '/', '\\', '|', '?', '*', ';', 'NUL', 'COM', 'LPT', 'CON', 'PRN');

	foreach ($notallowed as $i) {
	if (substr_count($ps[0], $i) > 0) {
		die('[err:19] Stop: Illegal character in filename: ' . $i);
	}
	}
	
	$f = fopen($ps[0], 'w');
	fclose($f);
	
	$names = explode('.', $ps[0]);
	$name = $names[0];
	if ($ps[1] == '--allowmed') {
	mkdir("$rdir/$sc/media/$ps[0]", 0700);
	mkdir("$rdir/$sc/media/$ps[0]/uploaded", 0700);
	}
	if ($ps[1] == '--allowmedhtml') {
	mkdir("$rdir/$sc/media/$name-med", 0700);
	mkdir("$rdir/$sc/media/$name-med/uploaded", 0700);
	}
	if ($ps[1] == '--forbidmed') {
	echo('--forbidmed flag passed<br>');
	}
	echo('chatbox opened<br>');
	

}
?>