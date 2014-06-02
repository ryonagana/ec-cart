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





if($_SERVER['REQUEST_METHOD'] == "GET"){

	if( isset($_GET['remover'])){
		//print "AHU";
		$_SESSION['cart']->remove($_GET['remover']);
		header("location: test.php");
	}

	if( isset($_GET['limpar_cart'])){

		$_SESSION['cart']->emptyCart();
		unset($_SESSION['cart']);
		header("location: test.php");
	}
	

}






//comment this code after  SESSION IS WROTE






//var_dump($_SESSION['cart']);

//foreach ($cart as $key => $value) {
//	var_dump($key, $value);
//}

//var_dump($cart->search_by_index(3));



//var_dump($_SESSION['cart']);

if(!isset($_SESSION['cart']) || empty($_SESSION['cart']) ){
	echo 'Write The Session in <a href="write_session.php">Write Session </a>Before Run';
	die();
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>


<form  method="POST">
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Preço</th>
				<th>Quantidade</th>
				<th>Ações</th>
			</tr>
		</thead>

		<tbody>
			<?php 
			$it = $_SESSION['cart']->getIterator();
			
			if(!$it->valid()){


				print "Sem Registros";

			}else {

				while($it->valid()){   ?>
					<tr>
						<td><?php echo  $it->current()->id; ?></td>
						<td><?php echo  $it->current()->name; ?></td>
						<td><?php echo  $it->current()->description; ?></td>
						<td><?php echo  Utils::Moneyformat($it->current()->price); ?></td>
						<td><?php echo  $it->current()->quantity; ?></td>
						<td><a href="<?php print "?remover=".$it->key(); ?>">Remover do Carrinho</a> </td>
					</tr>
			<?php 
					$it->next();

		}

		}
		  ?>

		<tr>
			<td>Total: <?php print sprintf("%01.2f",$_SESSION['cart']->getTotal()); ?></td>
		</tr>
		</tbody>
	</table>
	<a href="?limpar_cart=true">Limpar Carrinho</a>
</form>
</body>
</html>

<?php
	
	$d = $_SESSION['cart']->search_by_index(3);

	$id = $_SESSION['cart']->getId($d);
	var_dump($id);


?>

