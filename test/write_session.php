<?php

include "../Product.class.php";
include "../Cart.class.php";
include "../Utils.class.php";


class Produto extends Product {

	public function NetPrice(){
		return $this->price - $this->vat;
	}

}



session_start();



//HERE //////////////////////////////////////

if(!isset($_SESSION['cart'])){
$cart = new Cart();


for($i = 0; $i < 10; $i++){

	$c = new Produto();

	$c->id =  rand(1,300);
	$c->name = "Produto ".$i;
	$c->description = "Description ".$i;
	$c->price = pow($i, 2) / 2.4 - sqrt(2);
	$c->quantity = $i * rand(1,20);


	$cart->add($c);


	//var_dump($c);

}




$_SESSION['cart'] =  $cart;

}else {

	echo 'Run <a href="test.php">test.php</a>  to see the results';

}

//END COMMENT /////////////////////////////

?>