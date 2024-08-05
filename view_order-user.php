
<br><br>

<h1 class="page-header text-center myOrders">My Orders</h1>
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
<div class="container-fluid w-75 ">
<form method="POST">
			<table class="table table-striped table-bordered text-center">
				<thead>
					<th></th>
					<th class="w-25">Image</th>
					<th>Name</th>
					<th>Date</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>Status</th>
					<th>Mode of Payment</th>
					
				</thead>
				<tbody>
					<?php
						//initialize total
						$total = 0;
						$index = 0;
						$checker=1;
 					
						$sql = "SELECT a.*,b.image_name,b.title,b.price,
						GROUP_CONCAT( b.title SEPARATOR ', ') as grp_title,
						GROUP_CONCAT( b.price SEPARATOR ', ') as grp_price,
						GROUP_CONCAT( a.checkout_quantity SEPARATOR ', ') as grp_quantity,
						GROUP_CONCAT( a.checkout_quantity*b.price SEPARATOR ', ') as grp_sub_total,
						GROUP_CONCAT( b.image_name SEPARATOR ', ') as grp_image,
						SUM(a.checkout_quantity*b.price) as total
						FROM checkout as a
						LEFT JOIN tbl_product as b
						ON a.checkout_product_id = b.id
						WHERE a.checkout_user_id = '{$_SESSION['id']}'
						GROUP BY a.checkout_united_id
						ORDER BY checkout_id desc";
						

						$query = $con->query($sql);
							while($row = $query->fetch_assoc()){
								?>
								<tr><center>
									<td>
									<?php 
										if($row['checkout_status']==0){
											echo'
											<a href="delete_item.php?united_id='.$row["checkout_united_id"].'&index='.$index.'" class="btn btn-danger btn-sm">
											<span class="glyphicon glyphicon-trash"></span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
</svg></a>';
										}
									?>
										
										
									</td>
									<td>
										<?php  
												spliterist($row['grp_image'],'img');
										?>
									</td>
									<td>
										<?php  
												spliterist($row['grp_title'],'str');
										?>
									</td>
									<td><?php echo $row['checkout_date'] ?></td>

									<td><?php spliterist($row['grp_price'],'num')?></td>
									<td>
									<?php spliterist($row['grp_quantity'],'str') ?>
									</td>
									
									<td>
										<?php spliterist($row['grp_sub_total'],'num')?>
									</td>
									<td>
									<?php 
										if($row['checkout_status']==0){
											echo "Pending";
										}else if($row['checkout_status']==1){
											echo "Preparing";
										}else if ($row['checkout_status']==2){
											echo "To received";
										}else if ($row['checkout_status']==3){
											echo "Delivered";
										}else if ($row['checkout_status']==4){
											echo "Canceled";
										}
										?>
									</td>
									<td>
									<?php 
										if($row['checkout_mode']=='Gcash'){
											echo "Gcash";
										}else if($row['checkout_mode']=='OTC'){
											echo "OTC(Cash)";
										}else if ($row['checkout_mode']=='COD'){
											echo "Cash on Delivery";
										}
										?>
									</td>
									<?php $total +=  $row['total'] ?>
								</center></tr>
								
								<?php
								$index ++;
								$checker++;
							}
						if($checker==1){
							?>
							<tr>
								<td colspan="9" class="text-center">You don't have orders yet</td>
							</tr>
							<?php
						}else{
							echo'<tr>
							<td colspan="9" align="right"><b>Total</b></td>
							<td><b>'.number_format($total, 2).'</b></td>
							</tr>
						';
						}

					?>

				</tbody>
			</table>
			</form>
			<a href="index.php" class="btn btn-primary" ><span class="glyphicon glyphicon-arrow-left"></span>Back</a>
</div>
<?php 
function spliterist($array,$type){
	$titles = explode(",", $array);
	foreach ($titles as $title) {
		if($type=="str"){
			echo $title.'<br>';
		}
		else if($type=="num"){
				echo 'P'.$title.'<br>';
		}
		else if($type=="img"){
			echo '<img style="width: 20%;" src="admin/'.trim($title).'"  >';
		}
	}
}
?>