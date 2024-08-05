<?php
	session_start();
?>
<?php include_once("include/navbar.php")?>

	<h1 class="page-header text-center">My Cart</h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			
			<form method="POST" action="save_cart.php">
			<table class="table table-bordered">
				<thead>
					<th></th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
				</thead>
				<tbody>
					
				<tr>
					<td>
						<a href="" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-trash"></span>
						</a>
						<button type="submit" class="btn btn-success" name="save">
							<span class="glyphicon glyphicon-check"></span>
						</button>
					</td>
					<td></td>
					<td></td>
					<input type="hidden" name="indexes[]" value="">
					<td><input type="text" class="form-control" value=""></td>
					<td></td>
					
				</tr>
								
					<tr>
						<td colspan="4" align="right"><b>Total</b></td>
						<td><b></b></td>
					</tr>
				</tbody>
			</table>
			</form>
		</div>
	</div>
</div>
</body>
</html>
