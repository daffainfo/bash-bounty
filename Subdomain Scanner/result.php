<?php
error_reporting(0);
	$nomer = 1;
	$input = $_POST['subdomain'];

	$url = parse_url($input, PHP_URL_HOST);

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "https://sonar.omnisint.io/subdomains/".$url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	$output = curl_exec($ch); 
	curl_close($ch); 
	
	$json = json_decode($output, true);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Result Subdomain</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>List Subdomain</h1>
		<table class="table table-bordered">
			<tr>
				<th>No.</th>
				<th>List Subdomain</th>
			<tr>
			<?php
				for($i=0; $i < count($json); $i++) {
					$target = "_blank";
					echo "<tr>";
					echo "<td>".$nomer++."</td>";
				    echo "<td><a target='".$target."' href='http://".$json[$i]."'>".$json[$i]."</a></td>";
				    echo "</tr>";
				}
			?>
		</table>
	</div>
</body>
</html>
