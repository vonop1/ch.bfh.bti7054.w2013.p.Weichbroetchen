<?php
	include_once ('functions.php');	
?>
<ul>
	<?php
		$language = get_param("lang", "de");
		$texts = simplexml_load_file("./text/$language.xml");
		$userTexts = $texts->user;
		
		echo '<li class="user">';
		// 100 Offset to identify non product ids
			echo "<a href=\"".changeUrl("idMain", 100)."\">"; 
			echo "$userTexts->LoginLink";
			echo "</a>";
		echo '</li>';
	

		echo '<li class="user">';
			echo "<a href=\"".changeUrl("idMain", 101)."\">";
			echo "$userTexts->RegistrationLink";
			echo "</a>";
		echo '</li>';
	?>
</ul>