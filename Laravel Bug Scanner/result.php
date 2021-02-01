<?php
error_reporting(0);
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Result Laravel</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style type="text/css">
		a {
			font-size: 1.25em;
		}
		h1 {
			margin: 25px 0px;
		}
	</style>
</head>
<body>
	<div class="container">
	<h1 class="text-center">Results</h1>
	<h5>.env File</h5>
	<?php
		if ($listUrl[0] == "200") {
			echo "<p>.env exposed</p>";
			echo '<a target="_blank" href="'.$url.'">'.$url.'</a><br>';
		}
		else if ($listUrl[0] != "200") {
			echo "<p>.env not exposed</p><br>";
		}
	?>
	<h5>Logs file</h5>
	<?php
		if ($listUrl[1] == "200") {
			echo "<p>Logs exposed</p>";
			echo '<a target="_blank" href="'.$url2.'">'.$url2.'</a><br>';
		}
		else if ($listUrl[1] != "200") {
			echo "<p>Logs file not exposed</p><br>";
		}
	?>
	<h5>Debug mode</h5>
	<?php
		if ($listUrl[2] == "405") {
			echo '<p>Debug mode enabled</p>';
			echo '<a target="_blank" href="'.$url3.'">'.$url3.'</a><br>';
		}
		else if ($listUrl[2] != "405") {
			echo "<p>Debug mode in ".$input." disabled</p><br>";
		}
	?>