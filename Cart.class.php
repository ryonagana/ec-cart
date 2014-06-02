<?php

class Cart extends ArrayObject {



	public function __construct(){
		parent::__construct();
	}


	//append a new object to array
	public  function add($product){

		if($product->quantity >= 1) $this->append($product);
		//else $product->quantity = 1; $this->append($product);
	}


	//this function searchs the objects by their index array
	// do not use this if you want to use a database
	// use search by ID, dont forget to append an id in object before
	//append it
	public function search_by_index($index){

		try{
		 $obj = $this->offsetGet($index);
		 return $obj;
		}catch(Exception $ex){
			print "Indice Inexistente";
			
		}
	}


	// this function searches object in the cart by the name 
	// not recommended using this is safe using id or index
	public function  search_by_name($prod){
		
		$it = $this->getIterator();

		while($it->valid()){

			if(strcmp($prod, $this->current()->name)){
				return $this->current();
			}
			$it->next();
		}
		//foreach($this as $p){
		//	return strcmp($p->name, $prod) ? $p : null;
		//}
	}


	/*
		this funtion is responsible to search by id
		you NEED to store your database id row into id attribute before
		append it to cart of you want this  function working nicely!
	*/
	public function search_by_id($id){
		$it = $this->getIterator();

		while($it->valid()){

			if(strcmp($id, $this->current()->id)){
				return $this->current();
			}
			$it->next();
		}
	}


	public function getId($product){
		$it = $this->getIterator();

		while($it->valid()){

			if($it->current()->id === $product->id){
				return $it->current()->id;
			}

			$it->next();

		}
	}


	//returns the sum of all prices (or just use  SUM() from mysql/oracle/psgre )
	public function getTotal($vat = false){
		$tot = 0.0;
		$it = $this->getIterator();

		while($it->valid()){


			if( $it->current()->quantity >= 1){
				$tot += $it->current()->fullPrice();
			}else {
				$obj = $this->search_by_index($it->key());
				$obj->quantity = 1;
				$this->updateProduct($it->key(), $obj);

			}
			//$this->offsetUnset($it->key());	
			$it->next();
		}

		return $tot;
	}


	// this function remove a object in the array searching by the index

	public function remove($index){

		$it = $this->getIterator();
		
		while($it->valid()){

			if(is_numeric($index) && $index == $it->key()){

				//var_dump($it->current());
				//print "Removido: ".$it->current()->name;
				$this->offsetUnset($it->key());
				break;

			}
			$it->next();
		}

	}

	/*
		This function os very important if you you want  to  use it with any database
		you need to put an id in the object before append or this function wont work

	*/
	public function remove_by_id($id){

		$it = $this->getIterator();
		
		while($it->valid()){

			if(is_numeric($id) && $id == $it->current()->id){

				//var_dump($it->current());
				//print "Removido: ".$it->current()->name;
				$this->offsetUnset($it->key());
				break;

			}
			$it->next();
		}

	}


	//just empty the array
	public function emptyCart(){
		$it = $this->getIterator();

		while($it->valid()){

			$it->offsetUnset($it->key());	
			$it->next();
		}
	}


	public function updateProduct($index,$product){

		$obj = $this->search_by_index($index);
		$this->offsetSet($index, $product);
		
	}





}


?>