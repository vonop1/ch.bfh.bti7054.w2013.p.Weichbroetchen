<?php
	$idMain = (get_param("idMain", 0));
	$idSec = (get_param("idSec", 1));
	
	switch ($idMain)
	{
		case 100: // Login
			include_once 'login.php';
			break;
		case 101: // Registration
			include_once 'registration.php';
			break;
		case 102: // Cart
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
		case 103: // Account
			include_once 'account.php';
			break;		
		default:
			$lang = getLanguage();
			$prod = new Product($idSec, $lang);
			$prod->display();
			break;
	
	}
?>