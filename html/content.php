<?php
	$title = "Hamburger";
	$image = "images/hamburger.jpg";
	
	function crateContentBurger($title, $image)
	{
		echo "<h2>".$title."</h2>";
		echo "<img src=\"$image\" alt=\"$image\"/>";
	}
	
?>