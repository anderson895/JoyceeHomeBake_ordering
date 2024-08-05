<?php
session_start();
include_once("include/navbar.php");
include_once("../db.php");
if(isset($_GET['update']))
{
    $id = $_GET['update'];
	if(isset($_POST['save']))
	{
	$user=mysqli_escape_string($con,$_POST['user']);
	$email=mysqli_escape_string($con,$_POST['email']);
	$pass=md5(mysqli_escape_string($con,$_POST['pass']));

		$update="UPDATE `users` SET `username` = '$user', `email` = '$email', `password` = '$pass' WHERE `users`.`id` = '$id' and user='1'";
		if(mysqli_query($con,$update)){
			header("Location:m-adm.php");
		}else{
			header("Location:m-adm.php");
		}	
	}
}else
{
    header("Location:m-adm.php");
}
?>

	<h1 class="page-header text-center">Update Admin</h1>
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
		$select="SELECT * FROM users where id = '$id' and user='1'";
		
		$result = $con->query($select);
		while($row1 = $result->fetch_assoc()) { ?> 
		<input type="text" name="user" value="<?php echo $row1['username']?>" class="form-control " placeholder="Input Username" required>
		<input type="email" name="email" value="<?php echo $row1['email']?>" class="form-control " placeholder="Input Email" required>
		<input type="password" name="pass" value="<?php echo $row1['password']?>" class="form-control " placeholder="Input Password" required>
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
