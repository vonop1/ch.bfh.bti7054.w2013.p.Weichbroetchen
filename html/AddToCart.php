<?php
	require_once 'functions.php';
	
	if (!isSet($_SESSION["cart"]))
	{
		$_SESSION["cart"] = new Cart();
	}
	$_SESSION["cart"]->addItem(new Product($_POST["id"]));

?>
<script type="text/javascript">
	window.location.replace("../index.php");
</script>