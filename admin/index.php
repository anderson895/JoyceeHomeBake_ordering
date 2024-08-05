<?php
	session_start();
?>
<?php include_once("include/navbar.php")?>
<link rel="stylesheet" href="css/admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<h1 class="page-header text-center myOrders"><b>ADMIN DASHBOARD</b></h1>
	<div class="container">
		<div class="row card-con">
			<div class="col-md-4">
			<a href="m-prod.php">
			<div class="card"style="background-color:	#d8ab7d; color:white;"><i class="fa fa-shopping-bag" style="font-size:60px;color:white;"></i><br><br>
					MANAGE PRODUCT
				</div>
			</a>
			</div>
			<div class="col-md-4">
		<a href="m-ord.php">
			<div class="card"style="background-color:#a67b2d; color:white;"><i class="fa fa-bell" style="font-size:60px;color:white;"></i><br><br>
			MANAGE ORDER
				</div>
			</a>
			</div>
			<div class="col-md-4">
		<a href="m-user.php">
			<div class="card" style="background-color:#591202; color:white;"><i class="fa fa-user" style="font-size:60px;color:white;"></i><br><br>
			 MANAGE USERS
				</div>
			</a>
			</div>
		</div>


		<div class="row card-con">
			<div class="col-md-4">
			<a href="m-adm.php">
			<div class="card" style="background-color:#a63f03; color:white;"><i class="fa fa-lock" style="font-size:60px;color:white;"></i><br><br>
				MANAGE ADMIN
				</div>
			</a>
			</div>
			<div class="col-md-4">
			<a href="m-rep.php">
			<div class="card" style="background-color:#d9bc9a; color:white;"><i class="fa fa-clipboard" style="font-size:60px;color:white;"></i><br><br>
				SALES REPORT
				</div>
			</a>
			</div>
			<div class="col-md-4">
			<a href="m-his.php">
				<div class="card" style="background-color:	#886451; color:white;"><i class="fa fa-file" style="font-size:60px;color:white;"></i><br><br>
					ORDER HISTORY
					</div>
				</div>
			</a>
		</div>

	</div>
</body>
</html>
