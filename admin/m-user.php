<?php
	session_start();
?>
<?php include_once("include/navbar.php")?>
<?php include_once("../db.php");
if(isset($_POST['save']))
{
	$user=mysqli_escape_string($con,$_POST['user']);
	$pass1=mysqli_escape_string($con,$_POST['pass1']);
	$pass2=mysqli_escape_string($con,$_POST['pass2']);
	$email=mysqli_escape_string($con,$_POST['email']);

	if($pass1==$pass2)
	{
		$pass=md5($pass1);
		$insert="INSERT INTO `users` (`username`, `email`, `password`, `user`) VALUES ('$user', '$email', '$pass','0')";

		if(mysqli_query($con,$insert))
		{
		success("Insert Successfully");
		}else{
		error("Failed in inserting Data");
		}
	}
	else{
		error("Password must be same.");
	}

}
?>

	<h1 class="page-header text-center"><b>MANAGE USERS</b></h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
		<ul class="nav navbar-nav navbar-right">
	      	<li class="well-sm"><button class="btn btn-primary " data-toggle="modal" data-target="#flipFlop" style="color: white; background-color:black;">Add User
			<span class="glyphicon glyphicon-plus"></span>
		</button></li>
	      </ul>
			<table class="table table-bordered text-center tble" style="background-color:black;">
				<thead style="color:white;">
					<th class="name">ID</th>
					<th class="name">Username</th>
					<th class="desc">Email</th>
					<th class="desc">Created Date</th>
					<th style="width: 15%;">Action</th>
				</thead>
				<tbody>

				<?php
					$select="SELECT * FROM users where user ='0'";

					$result = $con->query($select);

					if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) { ?>

				<tr style="color:white;">
					<td><?php echo $row["id"]; ?></td>
					<td><?php echo $row["username"]; ?></td>
					<td><?php echo $row["email"]; ?></td>
					<td><?php echo $row["create_datetime"]; ?></td>

					<td>
						<a href="d-user.php?delete=<?php echo $row['id']?>" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
						<a href="u-user.php?update=<?php echo $row['id']?>" class="btn btn-success" name="save">
							<span class="glyphicon glyphicon-check"></span>
						</a>
					</td>

				</tr>
				<?php
					}
					} else {
					echo "<tr><td colspan='7'>0 results</td></tr>";
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
<h4 class="modal-title" id="modalLabel">Add User</h4>
</div>
<div class="modal-body add">
	<form method="post" enctype="multipart/form-data">
		<input type="text" name="user" class="form-control " placeholder="Input Username" required>
		<input type="password" name="pass1" class="form-control " placeholder="Input Password" required>
		<input type="password" name="pass2" class="form-control " placeholder="Confirm Password" required>
		<input type="email" name="email" class="form-control " placeholder="Input email" required>


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
