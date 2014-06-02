<?php


abstract class Product {


	// you put  the attributes of the product here
	//under protected

	//example

	public $id; // must be UNIQUE
	public $name;
	public $description;
	public $price;
	public $quantity;
	public $vat;

	public function Product(){
		$this->vat = 0;
		$this->price = 0.00;
		$this->name = "";
		$this->description = "";
		$this->quantity = 1;
	}



	public function Price(){
		return $this->price;
	}

	public function fullPrice(){
		if($this->price >= 1){
			return ($this->price * $this->quantity); 
		}
	}



	public  abstract function NetPrice();








} 


?>

