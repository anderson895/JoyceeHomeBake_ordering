<?php
	session_start();

	if(!isset($_SESSION['user']))
	{
		//check if product is already in the cart
	if(!in_array($_GET['id'], $_SESSION['cart'])){
		array_push($_SESSION['cart'], $_GET['id']);
		$_SESSION['message'] = 'Product added to cart';
	}
	else{
		$_SESSION['message'] = 'Product already in cart';
	}

	header('location: prod.php');
	}else{
		require_once("db.php");
		try {
			$sql="INSERT INTO `tbl_cart` (`id`, `food_id`, `food_quantity`, `user_id`,checker) VALUES 
				(NULL, '{$_GET['id']}', '1', '{$_SESSION["id"]}','{$_SESSION["id"]}{$_GET['id']}')";
		if(mysqli_query($con,$sql)){
			$_SESSION['message'] = 'Product added to cart';
		}else{
			$_SESSION['message'] = 'Product already in cart';
		}
		header('location: prod.php');
		} catch (\Throwable $th) {
		$_SESSION['message'] = 'Product already in cart';
		header('location: prod.php');
		}
		
	}
?>
