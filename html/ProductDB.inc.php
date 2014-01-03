<?php 
class ProductDB extends mysqli { 
	/**
	 * constructor, open the database connection
	 */
	function __construct() {
		parent::__construct("localhost", "root", "");
		parent::select_db("webshop");
	}
	/**
	 * destructor, close the database connection
	 */
	function __destruct()
	{
		parent::close();
	}

	/**
	 * returns all Categories 
	 * @return mysqli reslut
	 */
	public function getAllCategories()
	{
		return $this->query("SELECT * FROM productcategorie");
	}
	
	/**
	 * retruns all products of e given categorie
	 * @param int $categorie 
	 * @return mysqli reslut
	 */
	public function getAllProducts($categorie) 
	{ 
	  return $this->query("SELECT * FROM product WHERE prodCategorie = $categorie"); 
	}
	public function deleteProduct($id) 
	{ 
	  $this->query("DELETE FROM product WHERE prodId = $id"); 
	}

	/**
	 * returns the product given by the id
	 * @param int $id of the product
	 * @return mysqli reslut
	 */
	public function getProduct($id)
	{
		return $this->query("Select * From product WHERE prodId = $id");
	}

	/**
	 * returns the selectlist extensions for a product given by the id
	 * @param int $id of the product
	 * @param string $lang, language to display
	 * @return string array with all selectlist extensions
	 */
	public function getProductSelectExt($id, $lang)
	{
		$res = $this->query("Select * From product WHERE prodId = $id");
	  	if ($selectExt = $res->fetch_object())
	  	{
		  	$selectExtId = $selectExt->SelectList;
		  	if ($res = $this->query("Select * FROM extension WHERE extensionCat = $selectExtId"))
		  	{
		  	
			  	$returnVal = array();
			  	$text = "text_$lang";
			  	while ($ext = $res->fetch_object())
			  	{
			  		$returnVal[$ext->ExtId] = $ext->$text;
			  	}
		  		return $returnVal;
		  	}
		}
		return null;
	}

	/**
	 * returns the checkbox extensions for a product given by the id
	 * @param int $id of the product
	 * @param string $lang, language to display
	 * @return string array with all checkbox extensions
	 */
  	public function getProductCheckExt($id, $lang)
  	{
  		$res = $this->query("Select * From product WHERE prodId = $id");
  		if ($checkExt = $res->fetch_object())
	  	{
		  	$checkExtId = $checkExt->CheckboxList;
		  	if ($res = $this->query("Select * FROM extension WHERE extensionCat = $checkExtId"))
		  	{
		  	
			  	$returnVal = array();
			  	$text = "text_$lang";
			  	while ($ext = $res->fetch_object())
			  	{
					if ($ext->prize > 0)
					{
						$priceString = 'Fr. '.number_format($ext->prize, 2,".","'");
			  			$returnVal[$ext->ExtId] = $ext->$text."  (+".$priceString.")";	
					}
					else
					{
			  			$returnVal[$ext->ExtId] = $ext->$text;
					}
			  	}
		  		return $returnVal;
		  	}
	  	}
	  	return null;
  	}

	/**
	 * returns the radio-button extensions for a product given by the id
	 * @param int $id of the product
	 * @param string $lang, language to display
	 * @return string array with all radio-button extensions
	 */
  	public function getProductRadioExt($id, $lang)
  	{
	  	$res = $this->query("Select * From product WHERE prodId = $id");
	  	if ($radioExt = $res->fetch_object())
	  	{
		  	$radioExtId = $radioExt->RadioList;
		  	if ($res = $this->query("Select * FROM extension WHERE extensionCat = $radioExtId"))
		  	{
		  	
			  	$returnVal = array();
			  	$text = "text_$lang";
			  	while ($ext = $res->fetch_object())
			  	{
					if ($ext->prize > 0)
					{
						$priceString = 'Fr. '.number_format($ext->prize, 2,".","'");
			  			$returnVal[$ext->ExtId] = $ext->$text."  (+".$priceString.")";	
					}
					else
					{
			  			$returnVal[$ext->ExtId] = $ext->$text;
					}
			  	}
		  		return $returnVal;
		  	}
  		}
	  	return null;
  	}

  	/**
  	 * returns a extension given by the id
  	 * @param int $id of the extension
  	 * @return mysqli result
  	 */
  	public function getExtension($id)
  	{
  		return $this->query("Select * From extension WHERE ExtId = $id");
  	}
}
  
  ?>