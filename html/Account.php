<?php

if (isset($_SESSION["user"])){
	$username = $_SESSION["user"];
	$user = User::withUsername($username);
	$user->display();
}

?>