<?php 
	include_once("include/navbar.php");
	cart();
	echo print_r($_SESSION)."<br>";
	// echo "<br>".implode(',',$_SESSION['cart']);
	// for($i=0; $i<=sizeof($_SESSION['cart']); $i++ )
	// {
		// echo $_SESSION['qty_array'][0];
	// }
	// echo sizeof($_SESSION['cart']);
	include_once("db.php");
		if(isset($_POST['login'])){
		foreach($_POST['indexes'] as $key){
			// $_SESSION['qty_array'][$key] = $_POST['qty_'.$key];
			// $_SESSION['qty'][$key] = $_POST['qty_'.$key];
			echo $_SESSION['cart'][$key];
			echo $_POST['qty_'.$key]."<br>";
			// echo $_SESSION['qty'][$key];

		}

		$_SESSION['message'] = 'Cart updated successfully';
	}
	if(isset($_SESSION['user'])&&$_SESSION['user']==1){
		header("Location:logout.php");
	}
	// echo $_SESSION['username'];
?>
<?php
		// if(isset($_POST['login'])&& isset($_POST['user'])&& isset($_POST['pass'])){
		
		// $username = stripslashes($_REQUEST['user']);    // removes backslashes
        // $username = mysqli_real_escape_string($con, $username);
        // $password = stripslashes($_REQUEST['pass']);
        // $password = mysqli_real_escape_string($con, $password);

        // $query = "SELECT * FROM `users` WHERE username='$username'
        //              AND password='" . md5($password) . "'";
        // $result = mysqli_query($con, $query) or die(mysqli_error($con));
        // $rows = mysqli_num_rows($result);
        // $row=$result->fetch_assoc();
        // if ($rows == 1) {
        //     $_SESSION['username'] = $username;
        //     $_SESSION['user']=$row['user'];
        //     // header("Location: dashboard.php");
		// 	echo"sdasdasd";
		// 	unset($_SESSION['cart']);
		// 	unset($_SESSION['qty_array']);
		// 	unset($_SESSION['qty']);
		// 	header("Refresh:0");
        // } else {
        //     error('incorrect password');
        // }
		// }
	?>
	
	
<?php
if(isset($_SESSION['user'])&&$_SESSION['user']=='0')
{
	include_once("view_cart-user.php");	
	echo'<a href="index.php" class="btn btn-primary" style="margin-right:2%;"><span class="glyphicon glyphicon-arrow-left"></span>Back</a>';
	echo'<button type="submit" name="save" class="btn btn-success"><span class="glyphicon glyphicon-check"></span>Checkout</button>
	';
}else{
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