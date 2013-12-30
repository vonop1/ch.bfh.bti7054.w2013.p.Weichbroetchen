<?php
	require_once 'functions.php';
	
	if (!isSet($_SESSION["cart"]))
	{
		$_SESSION["cart"] = new Cart();
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
			if (preg_match("/cb_.*/", $key))	
			{
				$extension[$key] = $value;
			}
		}
		$_SESSION["cart"]->addItem(new CartItem($_POST["id"], $extension));
	}

?>
<script type="text/javascript">
	window.location.replace("../index.php");
</script>