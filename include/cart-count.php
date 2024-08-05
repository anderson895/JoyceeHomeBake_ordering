<?php
if(!isset($_SESSION['user'])){?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	<!-- left nav here -->
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<li><a href="view_cart.php" style="color: black;">
			<span class="badge"><?php echo count($_SESSION['cart']); ?>
		</span> Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
	      </ul>
	    </div>
<?php
}else{
    $sql="SELECT * FROM tbl_cart where user_id='{$_SESSION['id']}'";
    $result = mysqli_query($con, $sql);?>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	<!-- left nav here -->
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	      	<li><a href="view_cart.php" style="color: black;">
			<span class="badge"><?php echo mysqli_num_rows($result);?>
		</span> Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
	      </ul>
	    </div>
<?php }
?>