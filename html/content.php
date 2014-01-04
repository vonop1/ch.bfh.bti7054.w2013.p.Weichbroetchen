<?php
	$idMain = (get_param("idMain", 0));
	$idSec = (get_param("idSec", 1));
	
	switch ($idMain)
	{
		case 100: 
			// Login
			include_once 'login.php';
			break;
		case 101:
			// Registrierung
			include_once 'registration.php';
			break;
		case 102:
			// Warenkorb
			if(isset($_SESSION["cart"]))
			{
				$shoppingCart = unserialize($_SESSION["cart"]);
				$shoppingCart->display();
			}
			else 
			{
				$shoppingCart = new Cart();
				$shoppingCart->display();
				$_SESSION["cart"] = serialize($shoppingCart);
			}
			break;
			
		default:
			$lang = get_param("lang", "de");
			$prod = new Product($idSec, $lang);
			$prod->display();
			break;
	
	}
?>