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

if(!isset($_SESSION['cart']) || isset($_GET['force']) ){
$cart = new Cart();


for($i = 1; $i < rand(1,60); $i++){

	$c = new Produto();

	$c->id = mt_rand(1, 300);
	$c->name = "Produto ".$i;
	$c->description = "Description ".$i;
	$c->price = pow($i, 2) * 10 / sqrt($i * rand(2,10));
	$c->quantity = rand(1,10);


	$cart->add($c);


	//var_dump($c);

}




$_SESSION['cart'] =  $cart;
header("location: write_session.php");

}else {

	header("location: test.php");
	//echo 'Run <a href="test.php">test.php</a>  to see the results';

}

//END COMMENT /////////////////////////////

?>