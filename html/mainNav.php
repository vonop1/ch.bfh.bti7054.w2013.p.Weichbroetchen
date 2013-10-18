<?php
	$menuItems = array(0 =>"Burger", 1 => "Beilagen", 2 => "Getränke");
	
?>
<ul>
		<?php 
			foreach ($menuItems as $item)
			{
				echo "<li class=\"mainNav\">$item</li>";	
			}
		
		?>
</ul>
