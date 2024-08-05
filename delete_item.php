<?php
	session_start();
	
	if(!isset($_SESSION['user'])){
		//remove the id from our cart array
	$key = array_search($_GET['id'], $_SESSION['cart']);	
	unset($_SESSION['cart'][$key]);

	unset($_SESSION['qty_array'][$_GET['index']]);
	//rearrange array after unset
	$_SESSION['qty_array'] = array_values($_SESSION['qty_array']);

	$_SESSION['message'] = "Product deletedddd from cart";
	header('location: view_cart.php');
	}else if(isset($_GET['united_id'])){
		require("db.php");
		$sql="DELETE FROM checkout WHERE checkout_united_id = '{$_GET['united_id']}' and checkout_status='0' and checkout_user_id='{$_SESSION['id']}' ";
		mysqli_query($con,$sql);
		$_SESSION['message'] = "Order Canceled";
		header('location: view-orders.php');
	}
	else{
		require("db.php");
		$sql="DELETE FROM tbl_cart WHERE `tbl_cart`.`id` = '{$_GET['id']}'";
		mysqli_query($con,$sql);
		$_SESSION['message'] = "Product deleted from cart";
		header('location: view_cart.php');
	}

?>