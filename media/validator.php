<?php
function inn($subs, $mai) {
var_dump(stripos($mai, $subs));
if (strpos($mai, $subs) !== false) {
return true;
} else {
return false;
}

}



function validate($fpath, $fname) {
if (!file_exists($fpath)) {
	echo('<br>VALIDATOR: no policy file<br>');
	return true;
}

$c = file_get_contents($fpath);
$directives = explode("\n", $c);
$mode = 'filter';
$currentlock = false;
$allowedtogo = null;

if (inn('mode:GATEMODE',$c)) { $mode = 'gate'; $allowedtogo = false; }
if (inn('mode:FILTERMODE',$c)) { $mode = 'filter'; $allowedtogo = true; }
var_dump($directives);
foreach ($directives as $i) {
	$twoelements = explode(':', $i);
	var_dump( inn($twoelements[1], $fname) );
	if ($twoelements[0] == 'pattern' && inn($twoelements[1], $fname) && $mode == 'filter') {return false;}
	if ($twoelements[0] == 'pattern' && inn($twoelements[1], $fname) && $mode == 'gate') {$allowedtogo = true;}
	if ($twoelements[0] == 'lock') {$currentlock = true;}
	if ($twoelements[0] == 'unlock') {$currentlock = false;}
}

if ($currentlock == false && $allowedtogo == true) {
	return true;
} else {
	return false;
}

}
?>