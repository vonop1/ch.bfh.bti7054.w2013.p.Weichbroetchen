<?php
	include_once ('functions.php');
	
	$prodDb = new ProductDB();
	
	$idMain = (get_param("idMain", 0));
	$res = $prodDb->getAllProducts($idMain);
	
	if ($res != null)
	{
		echo '<ul>';

		$lang = get_param("lang", "de");
		$text = "text_$lang";
		while ($item = $res->fetch_object())
		{
			echo '<li class="secNav">';
				echo "<a href=\"".changeUrl(array("idSec" => $item->prodId))."\">";
				echo $item->$text;
				echo "</a>";
			echo '</li>';
		}
		echo '</ul>';
	}	
?>

