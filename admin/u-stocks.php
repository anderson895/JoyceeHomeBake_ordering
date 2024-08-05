<?php
session_start();
include_once("include/navbar.php");
include_once("../db.php");
if(isset($_GET['stocks']))
{
    $id = $_GET['stocks'];
	if(isset($_POST['save']))
	{
	$qty=mysqli_escape_string($con,$_POST['qty']);
	$addqty=mysqli_escape_string($con,$_POST['addqty']);
	$qty+=$addqty;
	echo $qty;
	$update="UPDATE `tbl_product` set `quantity` = '$qty' WHERE `tbl_product`.`id` = '$id'";
		if(mysqli_query($con,$update)){
			header("Location:m-prod.php");
		}else{
			header("Location:m-prod.php");
		}	

	}
}else
{
    // header("Location:m-prod.php");
}
?>

	<h1 class="page-header text-center">Add stocks</h1>
	<style>
		.form-control{
			width: 50%;
			margin-left: 25%;
		}
		.modal-footer{
			margin-left: 0;
			padding: 0;
			margin-right: 25%;
		}
	</style>
<div class="modal-body add">
	<form method="post" enctype="multipart/form-data">		
		
		<?php
		$select="SELECT a.*, b.title as categ 
		from tbl_product as a
		LEFT JOIN tbl_category as b
		ON a.category_id = b.id
		where a.id='$id'";
		
		$result = $con->query($select);
		while($row1 = $result->fetch_assoc()) { ?> 
		<input type="text" min="1" value="Current Quantity: <?php echo $row1['quantity']?>" class="form-control " placeholder="Input Product Quantity" disabled>
		<input type="text" name="qty" value="<?php echo $row1['quantity']?>" hidden>
		<input type="number" min="1" name="addqty" value="1" class="form-control " placeholder="Input Product Quantity" required>
<?php 
		}
?>

	<div class="modal-footer">
		<button type="submit" name="save" class="btn btn-primary">Update</button>
		<a href="m-prod.php" class="btn btn-danger">Cancel</a>
		</form>
</div>
</body>
</html>
