
<br><br>
<h1 class="page-header text-center myOrders">My Cart</h1>
<div class="row justify-content-center">
		<div class="col-sm-8 col-sm-offset-2">
			
			<?php
			if(isset($_SESSION['message'])){
				?>
				<div class="alert alert-info text-danger text-center">
					<?=$_SESSION['message']?>
				</div>
				<?php
				unset($_SESSION['message']);
			}

			?>
		</div>
	</div>
		<div class="container-fluid w-75">
			<form method="POST">
			<table class="table table-striped table-bordered text-center">
				<thead>
					<th></th>
					<th class="w-25">Image</th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<!-- <th>Add ons</th> -->
					<th>Subtotal</th>
				</thead>
				<tbody>
					<?php
						//initialize total
						$total = 0;
						$index = 0;
						$checker=1;
 						
						$sql = "SELECT a.*,b.image_name, b.title as prodname , b.price,b.quantity
						FROM `tbl_cart` as a
						LEFT JOIN tbl_product as b
						ON a.food_id = b.id
						WHERE a.user_id='{$_SESSION['id']}'";

						$query = $con->query($sql);
							while($row = $query->fetch_assoc()){
								?>
								<tr><center>
									<td>
										<a href="delete_item.php?id=<?php echo $row['id']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm">
										<span class="glyphicon glyphicon-trash"></span> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
</svg></a>
									</td>
									<td><img style="width: 100%;" src="admin/<?php echo $row['image_name'] ?>"  ></td>
									<td><?php echo $row['prodname']; ?></td>
									<td><?php echo number_format($row['price'], 2); ?></td>
									<input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
									<input type="hidden" name="food_id[<?php echo $index?>]" value="<?php echo $row['food_id']?>">
									<input type="hidden" name="id[<?php echo $index?>]" value="<?php echo $row['id']?>">
									<td>
										<input max="<?php echo $row['quantity']?>"  type="number" min="1" class="form-control" value="<?php echo $row['food_quantity'] ?>" name="qty_<?php echo $index; ?>" >
									</td>
									<td hidden>
										<select name="addons[]" id="" class="form-control">
											<option value="0">Select Add ons</option>
											<option value="10">P10 Pearl </option>
											<option value="15">P15 Nata </option>
										</select>
									</td>
									<td>
										<?php echo number_format( $row['price'] *$row['food_quantity'], 2); ?>
									</td>
									
									<?php $total +=  $row['price'] *$row['food_quantity']?>
								</center></tr>
								
								<?php
								$index ++;
								$checker++;
							}
						if($checker==1){
							?>
							<tr>
								<td colspan="10" class="text-center">No Item in Cart</td>
							</tr>
							<?php
						}else{
							echo'<tr>
							<td colspan="5" align="right"><b>Total</b></td>
							<td><b>'.number_format($total, 2).'</b></td>
							</tr>
						';
						}

					?>

				</tbody>
			</table>
			