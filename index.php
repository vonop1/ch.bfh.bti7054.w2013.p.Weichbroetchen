<!DOCTYPE html>
<?php session_start(); ?>
<html>
	<head>
		<title>Weichbrötchen</title>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<script type="text/javascript" src="script/formValidation.js"></script>
		<script type="text/javascript" src="script/util.js"></script>
		<script type="text/javascript" src="script/cart.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<img src="images/banner.jpg" class="centerd"/>
			</div>
			<div id="mainNav">
				<?php include("html/mainNav.php");?>
			</div>
			<div id="contentliquid">
				<div id="content">
					<?php include("html/content.php"); ?>
				</div>
			</div>
			<div id="secondNav">
				<?php include("html/secondNav.php");?>
			</div>
			<div id="user">
				<?php include("html/user.php");?>
			</div>
			<div id="footer">
				<p>&copy;2013 bohnp1, vonop1</p>
			</div>
		</div>
	</body>
</html>