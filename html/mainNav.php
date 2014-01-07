<?php
include_once ('functions.php');

//get the product categories from database
$prodDb = new ProductDB();
$items = $prodDb->getAllCategories();
	
//create main navigation with elements from the db
echo "<ul>";
while ($item = $items->fetch_object()){
	echo '<li class="mainNav"><a href="' .changeUrl(array("idMain"=> $item->catId, "idSec"=> $item->defaultProd)). '">' .$item->$texts. '</a></li>';
}
echo '</ul>';

// create links to change site language
echo '<p id="language">';
echo '<a href ="." onClick="document.cookie = \'lang = de;\';">DE</a> |';
echo '<a href ="." onClick="document.cookie = \'lang = en;\';">EN</a>';
echo '</p>';

?>