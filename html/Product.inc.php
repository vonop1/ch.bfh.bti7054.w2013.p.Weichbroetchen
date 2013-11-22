<?php
	class Product
	{
		private $prodName = "";
		private $price = 0;
		
		//Konstruktor
		public function __construct($id)
		{
			$this->prodName = $id;
		}
		

		//show Product Info
		public function display() {
			echo "<td>$this->prodName</td><td>$this->prodName</td>";
		}
		
	}
?>