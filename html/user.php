<?php
	include_once ('functions.php');
	$user = array (	"de" => array("Registrierung", "Login"),
			"en" => array(""));
	
?>
<ul>
	<?php
		$language = get_param("lang", "de");
		$languageItems = $user[$language];
		foreach ($languageItems as $key => $value)
		{
			echo '<li class="user">';
			echo "<a href=\"".changeUrl("idMain", $key + 100)."\">";
			echo "$value";
			echo "</a>";
			echo '</li>';
		}	
	?>
</ul>