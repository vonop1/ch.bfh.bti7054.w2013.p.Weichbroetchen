<?php
	include_once ('functions.php');
	
	$prodDb = new ProductDB();
	
	$idMain = (get_param("idMain", 1));
	$res = $prodDb->getAllProducts($idMain);
	
	if ($item = $res->fetch_object())
	{
		echo '<ul>';

		$lang = get_param("lang", "de");
		$text = "text_$lang";
		do 
		{
			echo '<li class="secNav">';
				echo "<a href=\"".changeUrl(array("idSec" => $item->prodId))."\">";
				echo $item->$text;
				echo "</a>";
			echo '</li>';
		}
		while ($item = $res->fetch_object());
		echo '</ul>';
	}	
?>

