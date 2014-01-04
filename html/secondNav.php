<?php
include_once ('functions.php');

//get the product sub-categories from database
$prodDb = new ProductDB();
$idMain = (get_param("idMain", 1));	
$items = $prodDb->getAllProducts($idMain);

//create second navigation with elements from the db
if ($item = $items->fetch_object()){
	echo '<ul>';
	do {
		echo '<li class="secNav"><a href="' .changeUrl(array("idSec" => $item->prodId)). '">' .$item->$texts. '</a></li>';
	}while ($item = $items->fetch_object());
	echo '</ul>';
}

?>

