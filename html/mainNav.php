<?php
	$menuItems = array("de" => array(0 =>"Burger", 1 => "Beilagen", 2 => "Getr�nke"), "en" => array(0 =>"Burger", 1 => "Supplies", 2 => "Drinks"));
	include_once ('functions.php');
?>
<ul>
<?php 
	mainNav($menuItems)
?>
</ul>
<p id="language">
<?php 
	language();
?>
</p>