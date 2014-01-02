<?php
	require_once 'functions.php';
	session_start();
	
	if (isSet($_SESSION["cart"]))
	{
		$shoppingCart = unserialize($_SESSION["cart"]);
	}
	else 
	{
		$shoppingCart = new Cart();
	}
	
	if (isSet($_POST["id"]))
	{
		$extension = array();
		if (isSet($_POST["select"]))
		{
			$extension["select"] = $_POST["select"];
		}
		if (isSet($_POST["radio"]))
		{
			$extension["radio"] = $_POST["radio"];
		}
		foreach ($_POST as $key => $value)
		{
			//check for active checkboxes
			if (preg_match("/cb_.*/", $key))	
			{
				$extension[$key] = substr($key, 3); //only cb value as key
			}
		}
		$shoppingCart->addItem(new CartItem($_POST["id"], $extension));
	}
	$_SESSION["cart"] = serialize($shoppingCart);

?>
<script type="text/javascript">
	window.location.replace("../index.php");
</script>