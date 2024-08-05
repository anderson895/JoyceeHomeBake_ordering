<?php
	session_start();
?>
<?php include_once("include/navbar.php")?>
<?php include_once("../db.php");

?>
<style type="text/css" media="print">
   .navbar,.container{
        display: none;
       }
</style>
	<h1 class="page-header text-center"><b>SALES REPORT</b></h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
		<div class="content">
	<div class="container" >
		<form method="POST">
		<div class="row">
			<div class="col-sm-3">
				<select name="select" id="selector" class="form-control  mt-2" style="background-color:black; color:white;">
					<option value="" style="color:white;">Select Sales</option>
					<option value="day" style="color:white;">Sales Per Day</option>
					<option value="month" style="color:white;">Sales Per Month</option>
					<option value="year" style="color:white;">Sales Per Year</option>
				</select>
			</div>
			<div class="col-sm-2" id="datePickerDiv">
				<input type="date" id="datePicker" name="datePicker" class="form-control mt-2" style="background-color:black; color:white"; >
			</div>
			<div class="col-sm-2">
				<input type="submit" value="Check" name="Check" class="form-control mt-2" style="background-color:black; color:white"; >
			</div>
			<div class="col-sm-2">
			<button class="form-control mt-2" style="background-color:black; color:white"; onclick="window.print()">Print</button>	
		</div>
		</div>
		</div>

		</div>
		</form>
	<table class="table bg-light mt-2 text-center text-white">

	      </ul>
<div>
		  <table class="table table-bordered text-center tble text-white" style="background-color:black;">
				<thead>
					<th style="text-align:center; color:white;">Date</th>
					<!-- <th style="text-align:center;">Quantity</th> -->
					<th style="text-align:center; color:white;">Total Sales</th>
				</thead>
				<tbody style="color:white;">

<?php
	if(!empty($_POST["Check"])) {
	
	if($_POST['select']=='day')
	{
		include("perday.php");
	}
	else if($_POST['select']=='month')
	{
		include("permonth.php");
	}
	else if($_POST['select']=='year')
	{
		include("peryear.php");
	}
	else {
		include("perday.php");
	}

}else {
	include("perday.php");
}?>
</div>
<script>
	$("#datePickerDiv").hide()
	document.getElementById('datePicker').valueAsDate = new Date();
	$('#selector').on('change', function() {
		if (this.value==="day"){
 		 $("#datePickerDiv").show()
		}else{
			$("#datePickerDiv").hide()
		}
		});
</script>
