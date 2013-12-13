<?php
	include_once ('functions.php');
	
	$prodDb = new ProductDB();
	
	$burgers = array (	"de" => array("Hamburger", "Chesseburger", "Pouletburger", "Vegiburger"),
						"en" => array(""));
	$sides = array (	"de" => array("Firtes","Country Fries","Salat"),
						"en" => array(""));
	$drinks = array (	"de" => array("Cola","Fanta","Sprite"),
						"en" => array("Cola","Fanta","Sprite"));

	function secNav($items)
	{
		if ($items != null)
		{
			echo '<ul>';
			foreach ($items as $key => $value)
			{
				echo '<li class="secNav">';
					echo "<a href=\"".changeUrl("idSec", $key)."\">";
					echo "$value";
					echo "</a>";
				echo '</li>';
	
			}
			echo '</ul>';
		}
	
	}
	

?>

<?php
	$idMain = (get_param("idMain", 0));
	$res = $prodDb->getAllProducts($idMain);
	
	$items = array();
	while ($item = $res->fetch_object())
	{
		$lang = get_param("lang", "de");
		$text = "text_$lang";
		$items[$item->prodId] = $item->$text;
	}
	
	secNav($items);
?>

