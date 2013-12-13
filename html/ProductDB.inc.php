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