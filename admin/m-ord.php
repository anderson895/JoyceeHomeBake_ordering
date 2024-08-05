<?php
	session_start();
?>
<?php include_once("include/navbar.php")?>
<?php include("../db.php");
?>
<style>
.sss:active{
	transform: scale(9.5);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}
</style>

	<h1 class="page-header text-center"><b>MANAGE ORDER</b></h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">

	      </ul>
			<table class="table table-bordered text-center tble" style="background-color:black;">
				<thead style="color:white;">
					<th>Customer</th>
					<th>Product</th>
					<th>Product Image</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Payment</th>
					<th>Receipt Image</th>
					<th>Date</th>
					<th>Time</th>
					<th>Status</th>
					<th>Action</th>
				</thead>
				<tbody>

				<?php
					$select="SELECT a.*,SUM((b.price*a.checkout_quantity)) as checkout_price, b.title as prodname, b.price as prodprice,SUM(a.checkout_quantity) as check_qty
					,SUM(a.checkout_addons) as addons,TIME_FORMAT(checkout_time, '%h:%i %p') AS time,
					GROUP_CONCAT( b.title SEPARATOR ', ') as grp_title,
						GROUP_CONCAT( b.price SEPARATOR ', ') as grp_price,
						GROUP_CONCAT( a.checkout_quantity SEPARATOR ', ') as grp_quantity,
						GROUP_CONCAT( a.checkout_quantity*b.price SEPARATOR ', ') as grp_sub_total,
						GROUP_CONCAT( b.image_name SEPARATOR ', ') as grp_image
					FROM `checkout` as a
					LEFT JOIN tbl_product as b
					ON a.checkout_product_id = b.id
					LEFT JOIN users as c
					ON a.checkout_user_id = c.id
					WHERE a.checkout_status!='3' and a.checkout_status!='4'
					GROUP BY a.checkout_united_id
					ORDER BY checkout_id desc;";
					//GROUP BY checkout_united_id";
					$result = $con->query($select);
					$result2 = $con->query($select);
					$cc=$result2->fetch_assoc();
					if ($result->num_rows > 0 && !is_null($cc["checkout_id"])) {
					// output data of each row
					while($row = $result->fetch_assoc()) { ?>

				<tr style="color:white;">
					<td><?php echo $row["checkout_name"]; ?></td>
					<td><?php spliterist($row["grp_title"],'str')?></td>
					<td style="text-align: center;">
						<?php 
							spliterist($row["grp_image"],'img')
						?>
					</td>
					<td><?php spliterist($row["grp_quantity"],'str')?></td>
					<td><?php spliterist($row["grp_price"],'num')?></td>
					<td><?php echo $row["checkout_mode"]; ?></td>


					
					<td><?php echo $row["checkout_img"]=="" ? 'N/A':'<a id="view_receiptToggle" data-toggle="modal" data-target="#view_receiptModal" data-proofImages="'.$row["checkout_img"].'" target="_blank">Image</a>'; ?></td>


					<td style="width:15%"><?php echo $row["checkout_date"]; ?></td>
					<td style="width:15%"><?php echo $row["time"]; ?></td>
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
						if($row['checkout_status']==0){
							echo'
							<a href="d-prod.php?delete_check='.$row["checkout_united_id"].'" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-trash"></span>
							</a>';
						}
						?>

						<button href="<?php echo $row['checkout_united_id'].'/'.$row['checkout_status']?>" class="btn btn-success zz btn-sm" data-toggle="modal" data-target="#exampleModal">
							<span class="glyphicon glyphicon-pencil"></span>
						</button>


					


					</td>

				</tr>
				<?php
					}
					} else {
					echo "<tr><td colspan='10'>0 results</td></tr>";
					}
				?>
				<script>
					$(".zz").click(function(){
						$('#update_select option[value="0"]').show();
						$('#update_select option[value="1"]').show();
						$('#update_select option[value="2"]').show();
						$('#update_select option[value="3"]').show();

					var data = $(this).attr('href');
					$("#update_id").val(data.split("/")[0]);
					val = data.split("/")[1];
					$("#update_select").val(val);
					if(val==0){
						console.log(0)
						$('#update_select option[value="0"]').hide();
						$('#update_select option[value="1"]').show();
						$('#update_select option[value="2"]').hide();
						$('#update_select option[value="3"]').hide();

					}
					else if(val==1){
						console.log(1)

						$('#update_select option[value="0"]').hide();
						$('#update_select option[value="1"]').hide();
						$('#update_select option[value="2"]').show();
						$('#update_select option[value="3"]').show();
					}else{
						console.log(2)
						$('#update_select option[value="0"]').hide();
						$('#update_select option[value="1"]').hide();
						$('#update_select option[value="2"]').hide();
						$('#update_select option[value="3"]').show();
					}

				});
				</script>
				</tbody>
			</table>
		</div>
	</div>


<div class="modal fade" id="view_receiptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Proof of payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <img id="Proof_receipt_Image" src="" alt="Proof of Payment" style="max-width: 100%; max-height: 100%;">
      </div>
    </div>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form method="POST">
				<input type="hidden" class="form-control" id="update_id" value="" name="upd_united_id">
				<select class="form-control" id="update_select" value="" name="upd_sel" >
						<option value="0">Pending</option>
						<option value="1">Preparing</option>
						<option value="2">On the way</option>
						<option value="3">Delivered</option>
				</select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="u-ord" class="btn btn-primary">Save changes</button>
			</form>
			
      </div>
    </div>
  </div>
</div>





		<br><br>
	</body>
</html>
<?php
				if(isset($_POST['u-ord'])){
					$select = htmlentities($_POST['upd_sel']);
					if($select==1){
						$checker= searchInDatabase($_POST['upd_united_id']);
						echo $checker;
						if($checker=="0"){
								foreach ($_SESSION['s_data_id'] as $key => $product_id) {
									$sql="UPDATE `tbl_product` SET `quantity` = '{$_SESSION['s_data'][$key]}' WHERE `tbl_product`.`id` = '$product_id'";
									mysqli_query($con,$sql);
								}
								
								$sql="UPDATE `checkout` SET `checkout_status` = '$select' WHERE `checkout`.`checkout_united_id` = '{$_POST['upd_united_id']}'";
						}else{
								echo'
								<script>
								alert("Order Cannot be Proceed insufficient stocks \nCheck your Product Stocks")
								window.location.replace("m-ord.php");
								</script>
								';
							
						}
					}
					else{
						$sql="UPDATE `checkout` SET `checkout_status` = '$select' WHERE `checkout`.`checkout_united_id` = '{$_POST['upd_united_id']}'";
						
					}
					if(mysqli_query($con,$sql)){
						echo'
						<script>
						window.location.replace("m-ord.php");
						</script>
						';
					}
					
				}
			?>
<?php 
function spliterist($array, $type) {
	$titles = explode(",", $array);
	foreach ($titles as $title) {
		if ($type == "str") {
			echo $title . '<br>';
		} elseif ($type == "num") {
			echo 'P' . $title . '<br>';
		} elseif ($type == "img") {
			echo '<a id="view_productsToggle" data-toggle="modal" data-target="#view_productsModal" data-product_images="' . trim($title) . '" target="_blank">Image</a><br>';
			
			echo '<div class="modal fade" id="view_productsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">View Proof of payment</h5>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
				<img id="modalImage_list_products" src="" alt="Proof of Payment" style="max-width: 100%; max-height: 100%;">
				</div>
			  </div>
			</div>
			</div>';
		}
	}
}
?>
<script>
$(document).ready(function(){
    // When the modal is opened
    $('#view_productsModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var product_images = button.data('product_images'); // Extract info from data-* attributes

        console.log(product_images);

        // Set the src attribute of the image tag with the path of the image
        $(this).find('.modal-body #modalImage_list_products').attr('src', product_images);
    });


	$('#view_receiptModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var proofImages = button.data('proofimages'); // Extract info from data-* attributes
		console.log(proofImages)
        // Set the src attribute of the image tag with the path of the image
		$(this).find('.modal-body #Proof_receipt_Image').attr('src', proofImages);
    });

});
</script>




<?php
function searchInDatabase($item){
	$_SESSION['s_data']=array();
	$_SESSION['s_data_id']=array();

     $con = mysqli_connect("localhost","root","","db_backeshop");
//	$con = mysqli_connect("localhost","id20748868_name_onemoto","Motoecom2023!","id20748868_db_onemoto");

	$sql = "SELECT * ,(a.quantity-b.checkout_quantity) as quantitystock
	FROM `tbl_product` as a  
	LEFT JOIN checkout as b 
	ON a.id = b.checkout_product_id
	WHERE b.checkout_united_id ='$item'
	";
	$result = $con->query($sql);

if ($result->num_rows > 0) {
  $i=0;
  while($row = $result->fetch_assoc()) {

if(intval($row['quantitystock'])<0){
	$i++;
}else{
	array_push($_SESSION['s_data'],$row['quantitystock']);
	array_push($_SESSION['s_data_id'],$row['checkout_product_id']);
}
}
} else {
	return 1;
}
return $i;
}
?>


