<?php

class CartItem
{
	private $prodId = 0;
	private $extensions = "";
	private $price = 0;

	//Konstruktor
	public function __construct($product, $extension)
	{
		$this->prodId = $product;
		$this->extensions = $extension;
			
	}
	
	public function display ()
	{
		$prodDB = new ProductDB();
		$res = $prodDB->getProduct($this->prodId);
		
		if ($prod = $res->fetch_object())
		{
			$text = "text_". get_Param("lang","de");
			echo "<p>$prod->$text</p>";
		}
	}
}
?>