<?php
	include_once ('functions.php');
	
	$prodDb = new ProductDB();
	$items = $prodDb->getAllCategories();
	
	$lang = get_param("lang", "de");


	function language()
	{
		//Sprach umstellung
		echo "<a href=\"".changeUrl(array ("lang"=>"de"))."\">DE</a> |";
		echo "<a href=\"".changeUrl(array ("lang"=>"en"))."\">EN</a>";
	}

	echo "<ul>";

	$text = "text_$lang";
	while ($item = $items->fetch_object())
	{
		//Alle Elemente der Liste als mainNav Liste anzeigen
		echo '<li class="mainNav">';
			echo "<a href=\"".changeUrl(array("idMain"=> $item->catId, "idSec"=> $item->defaultProd))."\">";
				echo $item->$text;
			echo "</a>";						
		echo '</li>';
	}
	
	echo '</ul>';
	echo '<p id="language">';
	
	language();
	
	echo '</p>';