<?php
	$idMain = (get_param("idMain", 0));
	$idSec = (get_param("idSec", 1));
	
	processHttpRequests();
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
	
	/**
	 * 
	 */
	function processHttpRequests()
	{

		if (isSet($_SESSION["cart"]))
		{
			$shoppingCart = unserialize($_SESSION["cart"]);
		}
		else
		{
			$shoppingCart = new Cart();
		}
		
		//Add new items to shopping Cart
		if (isSet($_POST["idToAdd"]))
		{
			$extension = array();
			if (isSet($_POST["select"]))
			{
				$extension["select"] = $_POST["select"];
			}
			if (isSet($_POST["radio"]))
			{
				$extension["radio"] = $_POST["radio"];
			}
			foreach ($_POST as $key => $value)
			{
				//check for active checkboxes
				if (preg_match("/cb_.*/", $key))
				{
					$extension[$key] = substr($key, 3); //only cb value as key
				}
			}
			$shoppingCart->addItem(new CartItem($_POST["idToAdd"], $extension));
		}
		
		//remove items from shopping Cart
		if (isSet($_POST["itemToRemove"]))
		{
			$shoppingCart->removeItem($_POST["itemToRemove"]);
		}
		
		//clear shopping Cart after order
		if (isSet($_POST["order"]))
		{
			$shoppingCart->clearCart();
		}

		$_SESSION["cart"] = serialize($shoppingCart);
	}
?>