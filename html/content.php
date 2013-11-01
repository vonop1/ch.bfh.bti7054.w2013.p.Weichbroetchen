<?php
	$title = "Hamburger";
	$image = "images/hamburger.jpg";
	
	function createContentBurger($title, $image)
	{
		echo "<h2>".$title."</h2>";
		echo "<img src=\"$image\" alt=\"$image\"/>";
	}
	
	
	createContentBurger($title, $image);
?>