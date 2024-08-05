<?php include 'include/nav.php';
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}	

?>

<link rel="stylesheet" href="css/new2.css">
<div class="container-fluid">
  <div class="row">
    <div class="col-2 text-left nav2">
      <h2 class="text-center">CATEGORY</h2>
        <ul class="navbar-nav">
        <?php 
          $select="SELECT * FROM tbl_category";

          $result = $con->query($select);

          if ($result->num_rows > 0) {
          // output data of each row
          $i=1;
          while($row = $result->fetch_assoc()) { ?>
          <li class="nav-item nav2-item "><a href="prod-list.php?category=<?php echo $row['id'].'&title='.ucfirst($row['title'])?>"><?php echo $i.'. '.ucfirst($row['title'])?></a></li>
          <?php $i++;} }
          ?>
          
        </ul>
    </div>
    <div class="col-10 mt-3">
      
      <div class="row ms-5 justify-content-center">
      <div class="col-sm-3 ms-auto h2 mt-10">
        <form method="POST">
          <input type="search" name="search" class="p-2" placeholder="Search item">
        </form>
      </div>
      <div class="col-lg-12 text-center h2">
        ALL PRODUCTS
    </div>
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
      $sql = "SELECT a.*
      FROM tbl_product as a
      LEFT JOIN tbl_category as b
      ON a.category_id = b.id
      WHERE a.title LIKE '%{$search}%' and a.quantity>0	 
      ";
    }else{
      $sql = "SELECT a.*
      FROM tbl_product as a
      LEFT JOIN tbl_category as b
      ON a.category_id = b.id
      WHERE a.quantity>0";
    }
    $query = $con->query($sql);
    $inc = 4;
    $i=0;

    while($row = $query->fetch_assoc()){
      $inc = ($inc == 4) ? 1 : $inc + 1;
      if($inc == 1) ?>
        
        <div class="col-lg-3 text-center col-auto card">
          <img src="admin/<?php echo $row['image_name']?>" width="300px" height="250px" alt="">
          <h6 class="text-center ttrow h2 m-1 p-2"><?php echo $row['title']?></h6>
          <?php echo isset($_SESSION['id']) ? '<a href="add_cart.php?id='.$row['id'].'" class="btn-order btn-none text-decoration-none text-dark"><span class="glyphicon glyphicon-plus"></span> Add to cart</a>' : '<a href="login.php" class="btn-order btn-none text-decoration-none text-dark"><span class="glyphicon glyphicon-plus"></span> Add to cart</a>' ?>
        </div>
        
      <?php $i++;
        }
        if($i==0){
          echo '<p class="text-center text-danger h1">No Results.</p>';
        }
      
  ?>
    </div>
  </div>
</div>
<?php include 'include/footer.php';?>
