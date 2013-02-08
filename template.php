<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="icon" type="image/png" href="assets/img/wildcat-icon.png" />
	
		<link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/vendors/bootstrap/css/bootstrap-responsive.min.css" />
		<link rel="stylesheet" type="text/css" href="assets/styles.css" />
		
		<script src="assets/vendors/jquery/jquery.min.js"></script>
		<!--<script src="assets/vendors/jquery/jquery-ui.min.js"></script>-->
		<script src="assets/vendors/bootstrap/js/bootstrap.js"></script>

		<!--<script type="text/javascript" src="assets/vendors/highcharts/js/highcharts.src.js"></script>-->
		<script src="//code.highcharts.com/highcharts.js"></script>

		<script src="assets/studycenter.js"></script>
		
		<title>Wildcat Tracks</title>
	</head>
	<body>
		<div id="wrapper" class="container container-fluid">
			<header>
				<?php include('layout/header.php');?>
			</header>
			<nav>
				<?php include('layout/nav.php');?>
			</nav>
			<div id="message">
				<?php include('layout/message.php');?>
			</div>
			<div id="content">
				<?php include('layout/content.php');?>
			</div>
			<footer>
				<?php include('layout/footer.php');?>
			</footer>
		</div>
	</body>
</html>