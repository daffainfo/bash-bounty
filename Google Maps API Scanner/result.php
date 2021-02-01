<?php
error_reporting(0);
$input = $_POST['apikey'];

$url = 'https://maps.googleapis.com/maps/api/staticmap?center=45%2C10&zoom=7&size=400x400&key='.$input;
$url2 = 'https://maps.googleapis.com/maps/api/streetview?size=400x400&location=40.720032,-73.988354&fov=90&heading=235&pitch=10&key='.$input;
$url3 = 'https://www.google.com/maps/embed/v1/place?q=place_id:ChIJyX7muQw8tokR2Vf5WBBk1iQ&key='.$input;
$url4 = 'https://maps.googleapis.com/maps/api/directions/json?origin=Disneyland&destination=Universal+Studios+Hollywood4&key='.$input;
$url5 = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=40,30&key='.$input;
$url6 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=40.6655101,-73.89188969999998&destinations=40.6905615%2C-73.9976592%7C40.6905615%2C-73.9976592%7C40.6905615%2C-73.9976592%7C40.6905615%2C-73.9976592%7C40.6905615%2C-73.9976592%7C40.6905615%2C-73.9976592%7C40.659569%2C-73.933783%7C40.729029%2C-73.851524%7C40.6860072%2C-73.6334271%7C40.598566%2C-73.7527626%7C40.659569%2C-73.933783%7C40.729029%2C-73.851524%7C40.6860072%2C-73.6334271%7C40.598566%2C-73.7527626&key='.$input;
$url7 = 'https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=Museum%20of%20Contemporary%20Art%20Australia&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key='.$input;
$url8 = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input=Bingh&types=%28cities%29&key='.$input;
$url9 = 'https://maps.googleapis.com/maps/api/elevation/json?locations=39.7391536,-104.9847034&key='.$input;
$url10 = 'https://maps.googleapis.com/maps/api/timezone/json?location=39.6034810,-119.6822510&timestamp=1331161200&key='.$input;
$url11 = 'https://roads.googleapis.com/v1/nearestRoads?points=60.170880,24.942795|60.170879,24.942796|60.170877,24.942796&key='.$input;

$urlArr = array($url,$url2,$url3,$url4,$url5,$url6,$url7,$url8,$url9,$url10,$url11);
$urlArr2 = array($url4,$url5,$url6,$url7,$url8,$url9,$url10);
$yourProducts = array();
$yourProducts1 = array();
foreach ($urlArr as $key => $value) {
    $yourProducts[] = yourCurl($value);
}
foreach ($urlArr2 as $key => $value) {
	$yourProducts1[] = getContents($value);
}

function yourCurl($url){
    $ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, true);  
	curl_setopt($ch, CURLOPT_NOBODY, true);    
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_ENCODING,"");
	curl_setopt($ch, CURLOPT_TIMEOUT,10);
	$output = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $httpcode;
}

function getContents($url) {
	$data = file_get_contents($url);
	return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Result Google Map API Key</title>
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
	<h5>Staticmap API</h5>
	<?php 
		if ($yourProducts[0] == 200) {
			echo "<p>API key is vulnerable for Staticmap API</p>";
			echo "<a href='".$url."' target='_blank'>Staticmap API</a>";
		} else if ($yourProducts[0] == 403) {
			echo "<p>API key is not vulnerable for Staticmap API</p>";
		}
	?>
	<h5>Streetview API</h5>
	<?php
		if ($yourProducts[1] == 200) {
			echo "<p>API key is vulnerable for Streetview API</p>";
			echo "<a href='".$url2."' target='_blank'>Streetview API</a>";
		} else if ($yourProducts[1] == 403) {
			echo "<p>API key is not vulnerable for Streetview API</p>";
		}
	?>
	<h5>Embed API</h5>
	<?php
		if ($yourProducts[2] == 200) {
			echo "<p>API key is vulnerable for Embed API</p>";
			echo "<a href='".$url3."' target='_blank'>Embed API</a>";
		} else if ($yourProducts[2] == 403) {
			echo "<p>API key is not vulnerable for Embed API</p>";
		}
	?>
	<h5>Directions API</h5>
	<?php
		if (strpos($yourProducts1[0], 'REQUEST_DENIED' === false)) {
			echo "<p>API key is vulnerable for Directions API</p>";
			echo "<a href='".$url4."' target='_blank'>Directions API</a>";
		} else if ($yourProducts[3] == 200) {
			echo "<p>API key is not vulnerable for Directions API</p>";
		}
	?>
	<h5>Geocoding API</h5>
	<?php
		if (strpos($yourProducts1[1], 'REQUEST_DENIED') === false) {
			echo "<p>API key is vulnerable for Geocoding API</p>";
			echo "<a href='".$url5."' target='_blank'>Geocoding API</a>";
		} else if ($yourProducts[4] == 200) {
			echo "<p>API key is not vulnerable for Geocoding API</p>";
		}
	?>
	<h5>Matrix API</h5>
	<?php
		if (strpos($yourProducts1[2], 'REQUEST_DENIED') === false) {
			echo "<p>API key is vulnerable for Matrix API</p>";
			echo "<a href='".$url6."' target='_blank'>Matrix API</a>";
		} else if ($yourProducts[5] == 200) {
			echo "<p>API key is not vulnerable for Matrix API</p>";
		}
	?>
	<h5>Find Place from Text API</h5>
	<?php
		if (strpos($yourProducts1[3], 'REQUEST_DENIED') === false) {
			echo "<p>API key is vulnerable for Find Place from Text API</p>";
			echo "<a href='".$url7."' target='_blank'>Find Place from Text API</a>";
		} else if ($yourProducts[6] == 200) {
			echo "<p>API key is not vulnerable for Find Place from Text API</p>";
		}
	?>
	<h5>Autocomplete API</h5>
	<?php
		if (strpos($yourProducts1[4], 'REQUEST_DENIED') === false) {
			echo "<p>API key is vulnerable for Autocomplete API</p>";
			echo "<a href='".$url8."' target='_blank'>Autocomplete API</a>";
		} else if ($yourProducts[7] == 200) {
			echo "<p>API key is not vulnerable for Autocomplete API</p>";
		}
	?>
	<h5>Elevation API</h5>
	<?php
		if (strpos($yourProducts1[4], 'REQUEST_DENIED') === false) {
			echo "<p>API key is vulnerable for Elevation API</p>";
			echo "<a href='".$url9."' target='_blank'>Elevation API</a>";
		} else if ($yourProducts[7] == 200) {
			echo "<p>API key is not vulnerable for Elevation API</p>";
		}
	?>
	<h5>Timezone API</h5>
	<?php
		if (strpos($yourProducts1[5], 'REQUEST_DENIED') === false) {
			echo "<p>API key is vulnerable for Timezone API</p>";
			echo "<a href='".$url10."' target='_blank'>Timezone API</a>";
		} else if ($yourProducts[9] == 200) {
			echo "<p>API key is not vulnerable for Timezone API</p>";
		}
	?>
	<h5>Roads API</h5>
	<?php
		if (strpos($yourProducts1[6], 'REQUEST_DENIED') === false) {
			echo "<p>API key is vulnerable for Roads API</p>";
			echo "<a href='".$url11."' target='_blank'>Roads API</a>";
		} else if (strpos($yourProducts[10], '403') === false) {
			echo "<p>API key is not vulnerable for Roads API</p>";
		}
	?>
</body>
</html>