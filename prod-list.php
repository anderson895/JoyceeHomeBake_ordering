<?php include 'include/nav.php';

//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	//unset qunatity
	unset($_SESSION['qty_array']);
	include_once("db.php");
	// echo ;
	if(!isset($_GET['category'])){
		header("Location:product.php");
	}
	$categ_id=$_GET['category'];

?>
<?php include('include/cart-count.php')?>
<link rel="stylesheet" href="css/new2.css">

<div class="container-fluid">
  <div class="row">
    <div class="col-10 mt-3">
      
      <div class="row justify-content-end  h6 mt-10">
      
      <div class="col-lg-12 text-center h2 mt-4">
        ALL PRODUCTS
    </div>
    <div class="col-sm-2 mb-2">
          <form action="prod-list.php" method="GET" id="form">
              <!-- <li class="nav-item nav2-item "><a href="prod-list.php?category=<?php echo $row['id'].'&title='.ucfirst($row['title'])?>"><?php echo $i.'. '.ucfirst($row['title'])?></a></li> -->
              <select name="category" class="form-control p-2" id="categ_selector">
              <option value="">Select Category</option>
              <?php 
              $select="SELECT * FROM tbl_category";

              $result = $con->query($select);

              if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']?>"><?php echo ucfirst($row['title'])?></option>
                <?php } 
                }
              ?>
              </select>
              </form>
          </div>
        <div class="col-sm-2 mb-2">
          <form method="POST">
            <input type="search" name="search" class="p-2 rounded form-control" placeholder="Search item">
          </form>
        </div>
    </div>
    </div>

    <div class="row justify-content-center">
        <?php
  if(!isset($_GET['id'])){
    if(isset($_SESSION['message'])){
      ?>
      <div class="alert alert-info text-center" >
        
        <p class='text-center text-primary'><?php echo $_SESSION['message']; ?></p>
  
      </div>
      <?php
        unset($_SESSION['message']);
        }
      }
      

if(isset($_POST['search'])){
  $search=htmlentities(trim($_POST['search']));
  $sql = "SELECT a.*,b.title as categ
  FROM tbl_product as a
  LEFT JOIN tbl_category as b
  ON a.category_id = b.id
  where a.category_id='$categ_id' and a.title LIKE '%{$search}%' and a.quantity>0";
}else{
  $sql = "SELECT a.*,b.title as categ
      FROM tbl_product as a
      LEFT JOIN tbl_category as b
      ON a.category_id = b.id
    where a.category_id='$categ_id' and a.quantity>0 ";
}

      $query = $con->query($sql);
      $inc = 4;
      $i=0;
      while($row = $query->fetch_assoc()){
        $inc = ($inc == 4) ? 1 : $inc + 1;
        if($inc == 1) ?>
          
          <div class="col-lg-3 text-center col-auto card">
            <img src="admin/<?php echo $row['image_name']?>" class="m-auto" width="300px" height="250px" alt="">
            <h6 class="text-center ttrow h2 m-1 p-2"><?php echo $row['title']?></h6>
            <?php echo '₱ '.$row['price']?>
            <?php echo isset($_SESSION['id']) ? '<a href="add_cart.php?id='.$row['id'].'" class="btn-order btn-none text-decoration-none text-dark"><span class="glyphicon glyphicon-plus"></span> Add to cart</a>' : '<a href="login.php" class="btn-order btn-none text-decoration-none text-dark"><span class="glyphicon glyphicon-plus"></span> Add to cart</a>' ?>
          </div>
          
        <?php 
        $i++;
        }
        if($i==0){
          echo '<p class="text-center text-danger h1">No Results.</p>';
        }
    ?>
    </div>
  </div>
</div>
<?php include 'include/footer.php';?>

<script>
   $('#categ_selector').on('change', function() {
    $('#form').submit();
  });
</script>
