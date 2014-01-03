<?php
	include_once ('functions.php');
	session_start();
	$cart = unserialize($_SESSION["cart"]);
	$cart->printCart();
?>