<?php
	session_start();
       $ISBN=$_POST['isbn'];
       $title=$_POST['title'];
       $number=$_POST['number'];
       $quantity=$_POST['qty'];
       $price=$_POST['price'];
       $author=$_POST['author'];
       
       if(isset($_SESSION['cart'][$ISBN])){
       		// Update the quantity for this item and update the counter
       	    $oldqty = $_SESSION['cart'][$ISBN]['quantity'];
       		$_SESSION['cart'][$ISBN]['quantity'] = $quantity;
	       	if($quantity > $oldqty){
		       	$diff = $quantity - $oldqty;
		       	$_SESSION['counter'] += $diff;
		    }else if($quantity < $oldqty){
		       	$diff = $oldqty - $quantity;
		       	$_SESSION['counter'] -= $diff;
		    }
       }else{
       		// Add new item and update the counter
       		$itemArray = array("ISBN"=>$ISBN ,"title"=>$title ,"quantity"=>$quantity, "number"=>$number, "price"=>$price, "author"=>$author);
       		$_SESSION['cart'][$ISBN] = $itemArray;
       		$_SESSION['counter'] += $quantity;
       }	       

       $response_array = [];

       $response_array['counter'] = $_SESSION['counter'];
       $jsonResponse = json_encode($response_array);
       echo $jsonResponse;
?>