<?php
	include_once("include/nav.php");
	// check();
	include_once("db.php");

	$sql = "SELECT * FROM users WHERE id = '{$_SESSION['id']}'";
	$result = mysqli_query($con, $sql);
	$row2 = mysqli_fetch_assoc($result);
	if(isset($_SESSION['user'])&&$_SESSION['user']==1){
		header("Location:logout.php");
	}
	// echo $_SESSION['username'];
?>
<?php
		if(isset($_POST['login'])&& isset($_POST['user'])&& isset($_POST['pass'])){

		$username = stripslashes($_REQUEST['user']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['pass']);
        $password = mysqli_real_escape_string($con, $password);

        $query = "SELECT * FROM `users` WHERE username='$username'
                     AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $rows = mysqli_num_rows($result);
        $row=$result->fetch_assoc();
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['user']=$row['user'];
			$_SESSION['id']=$row['id'];
			// sss

			foreach($_POST['indexes'] as $key){
				$sql="INSERT INTO `tbl_cart` (`id`, `food_id`, `food_quantity`, `user_id`,checker) VALUES
				(NULL, '{$_SESSION["cart"][$key]}', '{$_POST["qty_".$key]}', '{$_SESSION["id"]}','{$_SESSION["id"]}{$_SESSION["cart"][$key]}')";
				if(mysqli_query($con,$sql)){
					// success("corr");
				}else{
					// error("mali");
				}
			}
			// ss
			unset($_SESSION['cart']);
			unset($_SESSION['qty_array']);
			unset($_SESSION['qty']);
			header("Refresh:0");
        } else {
            error('incorrect password');
        }
		}

	?>


<?php
if(isset($_SESSION['user'])&&$_SESSION['user']=='0'&& !isset($_POST['checkout'])&& !isset($_POST['confirmed']))
{
	include_once("view_cart-user.php");
	if($checker==1)
	{
		echo'<a href="index.php" class="btn btn-primary" style="margin-right:2%;"><span class="glyphicon glyphicon-arrow-left"></span>Back</a>';
	}else{
		echo'<a href="index.php" class="btn btn-primary" style="margin-right:2%;"><span class="glyphicon glyphicon-arrow-left"></span>Back</a>';
		echo'<button type="submit" name="checkout" class="btn btn-success"><span class="glyphicon glyphicon-check"></span>Checkout</button> </form>' ;
		// echo'<input type="submit" name="checkout"></form>';
	}
}else if(isset($_POST['checkout'])|| isset($_POST['confirmed']))
{
	if(isset($_POST['checkout']))
		{

			echo'<form method="POST" enctype="multipart/form-data">';
			for($i=0; $i<sizeof($_POST['id']); $i++)
			{
				?>
				<input type="hidden" name="check_id[]" value="<?php echo $_POST['id'][$i]?>">
				<input type="hidden" name="check_quantity[]" value="<?php echo $_POST['qty_'.$i]?>">
				<input type="hidden" name="check_food_id[]" value="<?php echo $_POST['food_id'][$i]?>">
				<input type="hidden" name="check_addons[]" value="<?php echo $_POST['addons'][$i]?>">


		<?php	} ?>
		<style>
	
		form{
	      margin: 175px auto;
	      width: 1000px;
	      padding: 30px 25px;
	      background: rgba(220, 220, 220, .5);
	      border-radius: 5px;
	  }
		</style>
	<center><h1>Checkout Form</h1></center>
	<form>
	<input type="text" value="<?=isset($row2['contact_name'])? ucwords($row2['contact_name']):''?>" class="form-control" required placeholder="Contact name" style="width: 40%; margin-left:30%; margin-bottom:1%;" name="check_name" >
	<input type="text" value="<?=isset($row2['contact_address'])? ucwords($row2['contact_address']):''?>" class="form-control" required placeholder="Contact address" style="width: 40%; margin-left:30%; margin-bottom:1%;" name="check_address" >
	<input type="text" value="<?=isset($row2['contact_number'])? ucwords($row2['contact_number']):''?>" class="form-control" required placeholder="Contact number" style="width: 40%; margin-left:30%; margin-bottom:1%;" name="check_contact" >
	<select class="form-control" style="width: 40%; margin-left:30%; margin-bottom:1%;" name="check_sel" id="select" required>
		<option selected value="">Mode of Payment</option>
		<option value="Gcash">Gcash</option>
		<option value="COD">Cash on Delivery</option>
		<option value="OTC">OTC(Cash)</option>
	</select>
	<input type="file" id="sel_file" class="form-control" style="width: 40%; margin-left:30%; margin-bottom:1%;" name="check_img">
	<input type="submit" name="confirmed" class="btn btn-success" style="width: 40%; margin-left:30%; margin-bottom:1%;">
	</form>

	<?php	}
	?>

	<?php
	if(isset($_POST['confirmed'])&&isset($_FILES['check_img']))
	{ //gcash payment
		$var1 = rand(1111,9999);
		$var2 = rand(1111,9999);
		$var3 = $var1.$var2;
		$var3 = md5($var3);
		$fnm = $_FILES["check_img"]["name"];
		$dst = "admin/all_images/".$var3.$fnm;
		$dst_db = "all_images/".$var3.$fnm;
		move_uploaded_file($_FILES["check_img"]["tmp_name"],$dst);
		$check_name = mysqli_real_escape_string($con, $_POST['check_name']);
		$check_address = mysqli_real_escape_string($con, $_POST['check_address']);
		$check_contact = mysqli_real_escape_string($con, $_POST['check_contact']);
		$check_sel = mysqli_real_escape_string($con, $_POST['check_sel']);
		$unique= md5(rand());
		$checker=0;
		$size=sizeof($_POST['check_food_id']);

		for($i=0; $i<$size; $i++)
			{
				$delete="DELETE FROM tbl_cart where id ='{$_POST['check_id'][$i]}'";
				$sql="INSERT INTO `checkout` (`checkout_id`, `checkout_name`, `checkout_address`, `checkout_product_id`, `checkout_quantity`, `checkout_img`, `checkout_united_id`, `checkout_date`, `checkout_status`, `checkout_mode`, `checkout_user_id`,checkout_addons)
				VALUES
				(NULL, '$check_name', '$check_address', '{$_POST['check_food_id'][$i]}', '{$_POST['check_quantity'][$i]}', '$dst_db', '$unique', current_timestamp(), '', '$check_sel','{$_SESSION['id']}','{$_POST['check_addons'][$i]}')";
				if(mysqli_query($con,$sql)&&mysqli_query($con,$delete)){
					$checker++;
				}else{
					echo mysqli_error($con);
				}
			}
			if($checker==$size)
			{

				header("Location:view-orders.php");
			}else{
				header("Location:view-orders.php");

				// $_SESSION['message']="Erroror in checking out";
				// header("refresh:0");
			}
	}
	else if(isset($_POST['confirmed'])&&$_POST['check_sel']!='Gcash' && !isset($_POST['check_img']))
	{ //not gcash
		$check_name = mysqli_real_escape_string($con, $_POST['check_name']);
		$check_address = mysqli_real_escape_string($con, $_POST['check_address']);
		$check_contact = mysqli_real_escape_string($con, $_POST['check_contact']);
		$check_sel = mysqli_real_escape_string($con, $_POST['check_sel']);
		$unique= md5(rand());
		$checker=0;
		$size=sizeof($_POST['check_food_id']);
		
		for($i=0; $i<$size; $i++)
			{
				$delete="DELETE FROM tbl_cart where id ='{$_POST['check_id'][$i]}'";
				$sql="INSERT INTO `checkout` (`checkout_id`, `checkout_name`, `checkout_address`, `checkout_product_id`, `checkout_quantity`, `checkout_img`, `checkout_united_id`, `checkout_date`, `checkout_status`, `checkout_mode`, `checkout_user_id`)
				VALUES (NULL, '$check_name', '$check_address', '{$_POST['check_food_id'][$i]}', '{$_POST['check_quantity'][$i]}', '', '$unique', current_timestamp(), '', '$check_sel','{$_SESSION['id']}')";
				if(mysqli_query($con,$sql)&&mysqli_query($con,$delete)){
					$checker++;

				}else{
					echo '<p class="myOrders">'.mysqli_error($con).'</p>';
				}
			}
			if($checker==$size)
			{

				header("Location:view-orders.php");
			}else{
				header("Location:view-orders.php");

				// $_SESSION['message']="Erroror in checking out";
				// header("refresh:0");
			}
		// print_r($_POST);

	}else if(isset($_POST['confirmed'])) {
		$_SESSION['message']="Error in Checkout";
		header("refresh:0");
		header("Location:view-orders5.php");

	}
	?>
	<!-- for selecting payment mode -->
	<script>
		$('#sel_file').hide();
		$("#select").change(function(){
		if($(this).val()==="Gcash")
		{
			$('#sel_file').show();
			$('#sel_file').attr('disabled',false);

		}else{
			$('#sel_file').hide();
			$('#sel_file').attr('disabled',true);
		}
		});
	</script>

<?php
}

else{
	include_once("view_cart-non-user.php");
	echo'<a href="index.php" class="btn btn-primary" style="margin-right:2%;"><span class="glyphicon glyphicon-arrow-left"></span>Back</a>';
	echo'<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-check"></span>Checkout</button>
	';
}
?>
		</div>
	</div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Login</h4>
      </div>
      <div class="modal-body">
        <input type="text" name="user" class="form-control" placeholder="Input Username" style="margin-bottom: 2%;" required>
		<input type="password" name="pass" class="form-control" placeholder="Input Password" required>
      </div>
      <div class="modal-footer">
		<button type="submit" name="login" class="btn btn-success">Login</button>

        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      </div>
	  </form>
    </div>

  </div>
</div>
</body>
</html>
