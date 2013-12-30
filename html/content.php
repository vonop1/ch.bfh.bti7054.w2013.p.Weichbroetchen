<?php
	$productDb = new ProductDB();
	$idMain = (get_param("idMain", 0));
	$idSec = (get_param("idSec", 1));
	$res = $productDb->getAllProducts($idMain);
	
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
			break;
			
		default:
			$lang = get_param("lang", "de");
			$res = $productDb->getProduct($idSec);
			$select = $productDb->getProductSelectExt($idSec, $lang);
			$check = $productDb->getProductCheckExt($idSec, $lang);
			$radio = $productDb->getProductRadioExt($idSec, $lang);
			$prod = new Product($res->fetch_object(), $lang, $select, $check, $radio);
			$prod->display();
			break;
	
	}
?>