<?php
	session_start();
?>
<?php include_once("include/navbar.php")?>
<?php include_once("../db.php");
if(isset($_POST['save']))
{
	$var1 = rand(1111,9999);
	$var2 = rand(1111,9999);
	$var3 = $var1.$var2;
	$var3 = md5($var3);
	$fnm = $_FILES["img"]["name"];
	$dst = "all_images/".$var3.$fnm;
	$dst_db = "all_images/".$var3.$fnm;

	move_uploaded_file($_FILES["img"]["tmp_name"],$dst);
	$name=mysqli_escape_string($con,$_POST['name']);
	$description=mysqli_escape_string($con,$_POST['description']);
	$price=mysqli_escape_string($con,$_POST['price']);
	$quantity=mysqli_escape_string($con,$_POST['quantity']);
	$category=mysqli_escape_string($con,$_POST['category']);
	$featured=mysqli_escape_string($con,$_POST['featured']);

 $insert="INSERT INTO `tbl_product` (`title`, `description`, `price`, `image_name`, `category_id`, `featured`, `quantity`) VALUES ('$name', '$description', '$price', '$dst_db', '$category', '$featured', '$quantity')";

 if(mysqli_query($con,$insert))
 {
  success("Insert Successfully");
 }else{
  error("Failed in inserting Data");
}

}
?>
	<h1 class="page-header text-center"><b>MANAGE PRODUCTS</b></h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
		<ul class="nav navbar-nav navbar-right">
	      	<li class="well-sm"><button class="btn btn-primary " data-toggle="modal" data-target="#flipFlop" style="color: white; background-color:black;">Add Products
			<span class="glyphicon glyphicon-plus"></span>
		</button></li>
	      </ul>
			<table class="table table-bordered text-center tble"style="background-color:black">
				<thead style="color:white;">
					<th>Image</th>
					<th class="name text-white">Name</th>
					<th class="desc">Description</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Category</th>
					<th>Featured</th>
					<th>Active</th>
					<th style="width: 5%;">Action</th>
				</thead>
				<tbody>

				<?php
					$select="SELECT a.*,b.title as categ
					FROM `tbl_product` as a
					LEFT JOIN tbl_category as b
					on a.category_id = b.id";

					$result = $con->query($select);

					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) { ?>

				<tr style="color:white;">
					<td style="text-align: center;"><img src="<?php echo $row["image_name"]; ?>" style="width: 20%; border-radius:5px;"></td>
					<td><?php echo $row["title"]; ?></td>
					<td><?php echo $row["description"]; ?></td>
					<td><?php echo $row["price"]; ?></td>
					<td><?php echo $row["quantity"]; ?></td>
					<td><?php echo $row["categ"]; ?></td>
					<td><?php echo $row["featured"]; ?></td>
					<td><?php echo $row["active"]; ?></td>
					<td>
						<a href="d-prod.php?delete=<?php echo $row['id']?>" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
						<a href="u-prod.php?update=<?php echo $row['id']?>" class="btn btn-success" name="save">
							<span class="glyphicon glyphicon-check"></span>
						</a>
						<a href="u-stocks.php?stocks=<?php echo $row['id']?>" style="margin:5%" class="btn btn-info">
							Add stocks
						</a>
					</td>

				</tr>
				<?php
					}
					} else {
					echo "<tr><td colspan='10'>0 results</td></tr>";
					}
				?>

				</tbody>
			</table>
		</div>
	</div>

<!-- The modal -->
<div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="modalLabel">Add Products</h4>
</div>
<div class="modal-body add">
	<form method="post" enctype="multipart/form-data">
		<input type="file" class="form-control " name="img" required>
		<input type="text" name="name" class="form-control " placeholder="Input Product Name" required>
		<input type="description" name="description" class="form-control " placeholder="Input Product Description" required>
		<input type="number" min="1" name="price" class="form-control " placeholder="Input Product Price" required>
		<input type="number" min="1" name="quantity" class="form-control " placeholder="Input Product Quantity" required>
		<select name="category" class="form-control" required>
		<option value="">Select Category</option>
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


		<select style="display:none;" name="featured" class="form-control " id="" required>
			<option value="">Featured Product</option>
			<option value="Yes" selected>Yes</option>
			<option value="No">No</option>
		</select>


</div>
					<div class="modal-footer">
						<button type="submit" name="save" class="btn btn-primary">Add</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<br><br>
	</body>
</html>
