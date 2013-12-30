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
			echo "<a href=\"".changeUrl(array("idMain" => 100, "idSec" => 0))."\">"; 
			echo "$userTexts->LoginLink";
			echo "</a>";
		echo '</li>';
	

		echo '<li class="user">';
			echo "<a href=\"".changeUrl(array("idMain" => 101, "idSec" => 0))."\">";
			echo "$userTexts->RegistrationLink";
			echo "</a>";
		echo '</li>';
		
		echo '<li class="user">';
			echo "<a href=\"".changeUrl(array("idMain" => 102, "idSec" => 0))."\">";
			echo "$userTexts->Cart";
			echo "</a>";
		echo '</li>';
	?>
</ul>