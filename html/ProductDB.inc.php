<?php 
class ProductDB extends mysqli { 
	  public function getAllProducts($categorie) 
	  { 
	    return $this->query("SELECT * FROM product WHERE prodCategorie = $categorie"); 
	  }
	   
	  public function deleteProduct($id) 
	  { 
	    $this->query("DELETE FROM product WHERE prodId = $id"); 
	  }

	  public function getProduct($id)
	  {
	  	return $this->query("Select * From product WHERE prodId = $id");
	  }

	  public function getProductSelectExt($id, $lang)
	  {
	  	$res = $this->query("Select * From prodextension WHERE prodId = $id");
	  	if ($selectExt = $res->fetch_object())
	  	{
		  	$selectExtId = $selectExt->selectExt;
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
	  
	  function __construct() { 
	    parent::__construct("localhost", "root", ""); 
	    parent::select_db("webshop"); 
	  } 
	  
	  function __destruct()
	  {
	  	parent::close();
	  }
}
  
  ?>