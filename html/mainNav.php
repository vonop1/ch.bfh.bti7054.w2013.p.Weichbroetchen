<?php
	include_once ('functions.php');
	$menuItems = array(	"de" => array(0 =>"Burger", 1 => "Beilagen", 2 => "Getränke"), 
						"en" => array(0 =>"Burger", 1 => "Sides", 2 => "Drinks"));

	function mainNav($items)
	{
		$language = get_param("lang", "de");
		$languageItems = $items[$language];	//Array entsprechend der Sprache nehmen
		foreach ($languageItems as $key => $value)
		{
			//Alle Elemente der Liste als mainNav Liste anzeigen
			echo '<li class="mainNav">';
				echo "<a href=\"".changeUrl("idMain", $key)."\">";
					echo "$value";
				echo "</a>";						
			echo '</li>';	
		}
				
	}

	function language()
	{
		//Sprach umstellung
		echo "<a href=\"".changeUrl("lang","de")."\">DE</a> |";
		echo "<a href=\"".changeUrl("lang","en")."\">EN</a>";
	}
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