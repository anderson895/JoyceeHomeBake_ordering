<?php
	session_start();
?>
<?php include_once("include/navbar.php")?>
<?php include_once("../db.php");

?>

	<h1 class="page-header text-center"><b>ORDER HISTORY</b></h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">

	      </ul>
			<table class="table table-bordered text-center tble" style="background-color:black;">
				<thead style="color:white;">
					<th class="text-center">Customer ID</th>
					<th class="text-center">Customer Name</th>
					<th class="text-center">Product Name</th>
					<th class="text-center">Quantity</th>
					<th class="text-center">Price</th>
					<th class="text-center">Subtotal</th>
					<th class="text-center">Payment</th>
					<th class="text-center">Date</th>
					<th class="text-center">Status</th>
				</thead>
				<tbody>

				<?php
					$select="SELECT a.*,SUM((b.price*a.checkout_quantity)) as total_price
					,SUM(a.checkout_quantity) as total_qty
					,b.price as prodprice,c.id as customer_id
					,SUM(a.checkout_addons) as addons,
					GROUP_CONCAT( b.title SEPARATOR ', ') as grp_title,
					GROUP_CONCAT( b.price SEPARATOR ', ') as grp_price,
					GROUP_CONCAT( a.checkout_quantity SEPARATOR ', ') as grp_quantity,
					GROUP_CONCAT( a.checkout_quantity*b.price SEPARATOR ', ') as grp_sub_total
					FROM `checkout` as a
					LEFT JOIN tbl_product as b
					ON a.checkout_product_id = b.id
					LEFT JOIN users as c
					ON a.checkout_user_id = c.id
					WHERE a.checkout_status='3' or a.checkout_status='4'
					GROUP BY checkout_united_id
					ORDER BY a.checkout_id desc;";

					$result = $con->query($select);

					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) { ?>

				<tr style="color:white;">
					<td><?php echo $row["customer_id"]; ?></td>
					<td><?php echo ucfirst($row["checkout_name"]); ?></td>
					<td><?php spliterist($row["grp_title"],'str') ?></td>
					<td><?php spliterist($row["grp_quantity"],'str') ?></td>
					<td><?php spliterist($row["grp_price"],'num') ?></td>
					<td><?php spliterist($row["grp_sub_total"],'num') ?></td>
					<td><?php echo $row["checkout_mode"]; ?></td>
					<td><?php echo $row["checkout_date"]; ?></td>
					<td class="text-primary" style="color:white;"><?php
					if($row["checkout_status"]==3){
						echo"Delivered";
					} else if($row["checkout_status"]==4){
						echo "Canceled";
					}
					?></td>


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

		<br><br>
	</body>
</html>
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
			echo '<a href="look.php?image='.trim($title).'" target="_blank">Image</a><br>';
			
		}
	}
}
?>