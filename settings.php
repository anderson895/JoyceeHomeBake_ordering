<?php
	include_once("include/nav.php");
	// check();
	include_once("db.php");


	if(isset($_SESSION['user'])&&$_SESSION['user']==1){
		header("Location:logout.php");
	}
	$sql = "SELECT * FROM users WHERE id = '{$_SESSION['id']}'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	
?>
<br><br>
	<center><h1 class="myOrders">Checkout Form</h1></center>
	<form method="POST" class="sform">
	<input type="text" disabled class="form-control" value="<?=isset($row['contact_name'])? ucwords($row['contact_name']):''?>" placeholder="Contact name" style="width: 40%; margin-left:30%; margin-bottom:1%;" disabled name="check_name" >
	<input type="text" class="form-control" value="<?=isset($row['contact_address'])? ucwords($row['contact_address']):''?>" placeholder="Contact address" style="width: 40%; margin-left:30%; margin-bottom:1%;" disabled name="check_address" >
	<input type="text" class="form-control" title="eg: +63915124225"  pattern="\+639[0-9]{9}" value="<?=isset($row['contact_number'])? ucwords($row['contact_number']):''?>" placeholder="Contact number" style="width: 40%; margin-left:30%; margin-bottom:1%;" disabled name="check_contact" >
	<input type="password" class="form-control" value="<?=isset($row['password'])? ($row['password']):''?>" placeholder="Password" style="width: 40%; margin-left:30%; margin-bottom:1%;" disabled name="password" >
	<input type="submit" hidden name="confirmed" id="save" class="btn btn-success" style="width: 40%; margin-left:30%; margin-bottom:1%;">
	<input type="button" value="Edit" id="edit" class="btn btn-primary" style="width: 40%; margin-left:30%; margin-bottom:1%;">
	</form>
</html>
<script>
	$(edit).click(function(){
		$(this).hide()
		$(save).attr("hidden",false)
		$('input').prop('disabled', false);
	})
</script>
<?php 
if(isset($_POST['confirmed'])){
	$name = htmlentities($_POST['check_name']);
	$address = htmlentities($_POST['check_address']);
	$contact = htmlentities($_POST['check_contact']);
	if($_POST['password']==$row['password']){
		$password = htmlentities($_POST['password']);
	}else{
		$password = md5(htmlentities($_POST['password']));
	}
	$sql="UPDATE `users` SET `password` = '$password', `contact_name` = '$name', `contact_address` = '$address', `contact_number` = '$contact' WHERE `users`.`id` = '{$_SESSION['id']}'";
	if(mysqli_query($con,$sql)){
		echo '<script>
		alert("Save Successfully")
		window.location="settings.php"
		</script>';
	}else{
		echo '<script>
		alert("Save Unsuccessful")
		window.location="settings.php"
		</script>';
	}
}
?>
