<!DOCTYPE html>
<html lang="en" ng-app="RFA">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>RFA</title>
	<!-- Bootstrap core CSS -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="main.css" rel="stylesheet">
	<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<!-- <script src="bootstrap/js/ie-emulation-modes-warning.js"></script> -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<?php 
	$servername = "localhost";
	$username = "username";
	$password = "password";
	$dbname = "test";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed" . $conn->connect_error);
	}
?>
	<div class="col-md-12"><h1>RFA Queue</h1></div>
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<ul class="list-unstyled">
			<li><h3>Submited</h3></li>
			<li class="green-colored"> 
				<div class='col-md-1 inner'>#0000</div>
				<div class="col-md-1"></div>
				<div class="col-md-3 inner">James Kertice</div>
				<div class="col-md-1"></div>
				<div class='col-md-3 inner'>Table Broken</div>
				&nbsp
				<div class="col-md-2 inner" style="text-align: right;">Feb 4</div>
			</li>
<?php	
	$sql = "SELECT id, user_id, current_status, description FROM rfa_queue";
	$result = $conn->query($sql);
	if ($result->num_rows >0) {
		while ($row = $result->fetch_assoc()) {
			echo "
			<li class='green-colored'> 
				<div class='col-md-1 inner'>#" . str_pad($row['id'], 4, '0', STR_PAD_LEFT) . "</div>
				<div class='col-md-1'></div>
				<div class='col-md-3 inner'>" . $row['user_id'] . "</div>
				<div class='col-md-1'></div>
				<div class='col-md-3 inner'>" . $row['description'] . "</div>
				&nbsp
				<div class='col-md-2 inner' style='text-align: right;''>Feb 4</div>
			</li>";
		}
	}
	$conn->close();
?>
			<li><h3>In Progress</h3></li>
			<li><h3>Waiting</h3></li>
		</ul>
	</div>
	<div class="col-md-1"></div>

</body>
</html>
