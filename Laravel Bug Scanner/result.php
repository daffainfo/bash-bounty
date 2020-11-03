<?php

$input = $_POST['website'];

$url = $input.'/.env';
$url2 = $input.'/storage/logs/laravel.log';
$url3 = $input.'/logout';

$urlArr = array($url,$url2,$url3);
$listUrl = array();
foreach ($urlArr as $key => $value) {
    $listUrl[] = getHttpcode($value);
}

function getHttpcode($url){
    $ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, true);    // we want headers
	curl_setopt($ch, CURLOPT_NOBODY, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT,10);
	$output = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $httpcode;
}

// var_dump($listUrl[0]);

if ($listUrl[0] == "200") {
	echo "<p>.env exposed</p>";
	echo '<a target="_blank" href="'.$url.'">'.$url.'</a><br>';
	echo "===========================================";
}
else if ($listUrl[0] != "200") {
	echo "<p>.env not exposed</p><br>";
	echo "===========================================";
}

if ($listUrl[1] == "200") {
	echo "<p>Logs exposed</p>";
	echo '<a target="_blank" href="'.$url2.'">'.$url2.'</a><br>';
	echo "===========================================";
}
else if ($listUrl[1] != "200") {
	echo "<p>Logs file not exposed</p><br>";
	echo "===========================================";
}

if ($listUrl[2] == "405") {
	echo '<p>Debug mode enabled</p>';
	echo '<a target="_blank" href="'.$url3.'">'.$url3.'</a><br>';
	echo "===========================================";
}
else if ($listUrl[2] != "405") {
	echo "<p>Debug mode in ".$input." disabled</p><br>";
	echo "===========================================";
}

?>