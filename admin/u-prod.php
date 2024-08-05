<?php
session_start();
include_once("include/navbar.php");
include_once("../db.php");
if(isset($_GET['update']))
{
    $id = $_GET['update'];
	if(isset($_POST['save']))
	{
	$name=mysqli_escape_string($con,$_POST['name']);
	$description=mysqli_escape_string($con,$_POST['description']);
	$price=mysqli_escape_string($con,$_POST['price']);
	$quantity=mysqli_escape_string($con,$_POST['quantity']);
	$category=mysqli_escape_string($con,$_POST['category']);
	$featured=mysqli_escape_string($con,$_POST['featured']);
	$active=mysqli_escape_string($con,$_POST['active']);
	if( isset($_FILES['img']['name'])&& !empty($_FILES['img']['name']))
	{
		$var1 = rand(1111,9999);  
		$var2 = rand(1111,9999); 
		$var3 = $var1.$var2; 
		$var3 = md5($var3);   
		$fnm = $_FILES["img"]["name"]; 
		$dst = "all_images/".$var3.$fnm; 
		$dst_db = "all_images/".$var3.$fnm; 
		move_uploaded_file($_FILES["img"]["tmp_name"],$dst);
		$update="UPDATE `tbl_product` SET `title` = '$name', `description` = '$description', `price` = '$price', `image_name` = '$dst_db', `category_id` = '$category', `featured` = '$featured', `active` = '$active', `quantity` = '$quantity' WHERE `tbl_product`.`id` = '$id'";

			if(mysqli_query($con,$update)){
				header("Location:m-prod.php");
			}else{
				header("Location:m-prod.php");
			}
	}
	else{
		echo $_FILES['img']['name'];
		$update="UPDATE `tbl_product` SET `title` = '$name', `description` = '$description', `price` = '$price', `category_id` = '$category', `featured` = '$featured', `active` = '$active', `quantity` = '$quantity' WHERE `tbl_product`.`id` = '$id'";
		if(mysqli_query($con,$update)){
			header("Location:m-prod.php");
		}else{
			header("Location:m-prod.php");
		}	
	}
	

}
}else
{
    header("Location:m-prod.php");
}
?>

	<h1 class="page-header text-center">Update Product</h1>
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
		<input type="file" class="form-control " value="" name="img">
		<input type="text" name="name" value="<?php echo $row1['title']?>" class="form-control " placeholder="Input Product Name" required>
		<input type="description" name="description" value="<?php echo $row1['description']?>" class="form-control " placeholder="Input Product Description" required>
		<input type="number" min="1" name="price" value="<?php echo $row1['price']?>" class="form-control " placeholder="Input Product Price" required>
		<input type="number" min="1" name="quantity" value="<?php echo $row1['quantity']?>" class="form-control " placeholder="Input Product Quantity" required>
		<select name="category" class="form-control"  required>
		<option value="<?php echo $row1['category_id']?>"><?php echo $row1['categ']?></option>
		<?php
					$select="SELECT * from tbl_category where active ='Yes'";

					$result = $con->query($select);

					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) { ?> 
					<option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>
					<?php	
							}
							} else {
							echo '<option value="">0 Results</option>';
							}
						?>
				
		</select>
		<select name="featured" class="form-control " id="" required>
			<option value="<?php echo $row1['featured']?>"><?php echo $row1['featured']?></option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
		<select name="active" class="form-control " id="" required>
			<option value="<?php echo $row1['active']?>"><?php echo $row1['active']?></option>
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
<?php 
		}
?>

</div>
	<div class="modal-footer">
		<button type="submit" name="save" class="btn btn-primary">Update</button>
		<a href="m-prod.php" class="btn btn-danger">Cancel</a>
		</form>
</body>
</html>
