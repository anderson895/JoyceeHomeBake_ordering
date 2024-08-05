<?php
	session_start();
	if(isset($_POST['save'])){
		foreach($_POST['indexes'] as $key){
			$_SESSION['qty_array'][$key] = $_POST['qty_'.$key];
			$_SESSION['qty'][$key] = $_POST['qty_'.$key];
		}

		$_SESSION['message'] = 'Cart updated successfully';
		header('location: view_cart.php');
	}
	// if(isset($_POST['save'])&& isset($_SESSION['user']) && $_SESSION['user']=='0'){
	// 	// foreach($_POST['indexes'] as $key){
	// 	// 	$_SESSION['qty_array'][$key] = $_POST['qty_'.$key];
	// 	// }

		
	// }else if($_SESSION['user']=='1')
	// {
	// 	header('location: login.php');
	// }
	// else{
	// 	$_SESSION['message'] = 'Please login to checkout';
	// 	header('location: login.php');
	// }
?>
