<?php 
	include 'header.php';
	if(isset($_GET['purchase'])){
		try{
			$conn = new PDO("mysql:host=localhost:3306;dbname=cheapbooks","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			$conn->beginTransaction();
			$conn->exec("insert into ShoppingBasket values('".session_id()."', '".$_SESSION['login_user']."')");
			foreach ($_SESSION['cart'] as $item) {
				$conn->exec("insert into Contains values('".$item['ISBN']."', '".session_id()."', '".$item['quantity']."')");
				$conn->exec("insert into ShippingOrder values('".$item['ISBN']."', '".$defaultWarehouse."', '".$_SESSION['login_user']."', '".$item['quantity']."') on duplicate key update number=".$item['quantity']);
				$rows = $conn->exec("update stocks set number=number-".$item['quantity']." where number>=".$item['quantity']." and warehousecode='".$defaultWarehouse."' and ISBN='".$item['ISBN']."'"); 

				if($rows==0)
				{
					$rows = $conn->exec("update stocks set number=number-".$item['quantity']." where number>=".$item['quantity']." and warehousecode='".$secondaryWarehouse."' and ISBN='".$item['ISBN']."'");
					if($rows==0)
					{
	 					$rows = $conn->exec("update stocks set number=number-".$item['quantity']." where number>=".$item['quantity']." and warehousecode='".$backupWarehouse."' and ISBN='".$item['ISBN']."'");						
					}
				}
			}
			$conn->commit();
			header('location: logout.php');

		}catch(PDOException $pe){	
			echo "Something went wrong, ".$pe;
		}
	}
?>
<div class="container" style="text-align:center">
<h3 style="text-align: left">Your books in the cart</h3><br>
<table class="table" id="cartTable" style="text-align: left">
	<tr>
		<th>ISBN</th>
		<th>Title</th>
		<th>Stocks</th>
		<th>Quantity</th>
		<th>Price</th>
	</tr>
	<?php
	$cart_totalPrice = 0.00;

	if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
   		foreach($_SESSION['cart'] as $item){
		$item_totalPrice = floatval($item['price']) * intval($item['quantity']);
		$cart_totalPrice += $item_totalPrice;
		$item_totalPrice = number_format($item_totalPrice,2);
		echo "<tr>
				<td>".$item['ISBN']."</td>
				<td>".$item['title']." by ".$item['author']."</td>
				<td>".$item['number']."</td>
				<td>".$item['quantity']."</td>
				<td>$".$item_totalPrice." </td>
			</tr>";
	}
	}
	// else if(empty($_SESSION['cart'])) {
	// 	if($_SESSION['login_user']!= "")
	// 	{
	// 		echo "There are no items in your shopping cart.";
	// 	}
	// }
	else{
		echo "There are no items in your shopping cart.";
	}

	
	$cart_totalPrice = number_format($cart_totalPrice,2);
	?>
</table>
<span class="totalPriceDisplay"> <?= "Total Price : $".$cart_totalPrice ?></span> <br>
<a href="?purchase" class="btn btn-primary" id="purchaseBtn">Purchase</a>
</div>
