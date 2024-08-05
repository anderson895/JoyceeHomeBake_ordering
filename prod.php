<?php include 'include/nav.php';
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}	

?>

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
      


        <img class="TogglerViewProductDetails" src="admin/<?= $row['image_name']?>" class="m-auto" width="300px" height="250px" alt="" 
          data-bs-toggle="modal" 
          data-bs-target="#modalViewProductDetails"
          data-prod_name="<?= $row['title']?>"
          data-prod_description="<?= $row['description']?>"
          data-prod_price="<?= $row['price']?>"
          data-prod_qty="<?= $row['quantity']?>"
          data-image_name="<?= $row['image_name']?>"
      >


          <h6 class="text-center ttrow h2 m-1 p-2"><?php echo $row['title']?></h6>
          <?php echo '₱ '.$row['price']?>
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






<!-- Modal -->
<div class="modal fade" id="modalViewProductDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document"> <!-- Added modal-lg for a larger modal -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Product Details</h5>
        <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center"> <!-- Added text-center for centering content -->
        <img class="img-fluid product-image" src="admin/" alt=""> <!-- Added img-fluid class for responsive image -->
        <p>Name: <span class="productName"></span></p>
        <p>Description: <span class="productDescription"></span></p>
        <p>Price: <span class="productPrice"></span></p>
        <p>Quantity: <span class="productQuantity"></span></p>
      </div>
      <div class="modal-footer">
        <!-- Additional footer content if needed -->
      </div>
    </div>
  </div>
</div>




<script>


// jQuery script to handle the modal data loading
$(document).ready(function() {
  $('.TogglerViewProductDetails').click(function() {
    // Retrieve data attributes from the clicked image
    var productName = $(this).data('prod_name');
    var productDescription = $(this).data('prod_description');
    var productPrice = $(this).data('prod_price');
    var productQuantity = $(this).data('prod_qty');
    var productImages = $(this).data('image_name');

   

   $(".productName").text(productName);
   $(".productDescription").text(productDescription);
   $(".productPrice").text(productPrice);
   $(".productQuantity").text(productQuantity);

      // Set the src attribute of the image element
    $('.product-image').attr('src', 'admin/' + productImages);

    // Empty the content of another element (e.g., image-container) and add the image
    $('.image-container').empty().append('<img src="admin/' + productImages + '" alt="">');

  });
});








   $('#categ_selector').on('change', function() {
    $('#form').submit();
  });





</script>
