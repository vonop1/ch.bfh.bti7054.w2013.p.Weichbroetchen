<?php
	include_once ('functions.php');
	$burgers = array (	"de" => array("Hamburger", "Chesseburger", "Pouletburger", "Vegiburger"),
						"en" => array(""));
	$sides = array (	"de" => array("Firtes","Country Fries","Salat"),
						"en" => array(""));
	$drinks = array (	"de" => array("Cola","Fanta","Sprite"),
						"en" => array("Cola","Fanta","Sprite"));

	function secNav($items)
	{
		$language = get_param("lang", "de");
		$languageItems = $items[$language];
		foreach ($languageItems as $key => $value)
		{
			echo '<li class="secNav">';
			echo "<a href=\"".changeUrl("idMain", $key)."\">";
			echo "$value";
			echo "</a>";
			echo '</li>';
		}
	
	}
	

?>
<ul>
<?php
	$idMain = (get_param("idMain", 0));
	switch ($idMain)
	{
		case 0:
			secNav($burgers);
			break;
		case 1:
			secNav($sides);
			break;
		case 2:
			secNav($drinks);
			break;
				
	}	
?>
</ul>

