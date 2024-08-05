<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JHBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="css/new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-H9XgNXUrPb6UJox6S1S6jyGJ+I/WfW1+t8IZ4jq4JG0jvUwpNV69c6BbrdKyBnCrmgFM+BNxbyWfFnG4iQX9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-expand-lg bg-bg">
  <div class="container-fluid cf " >
    <a class="navbar-brand text-center nb col-6" href="#"> 
      <div class="row d-flex justify-content-center align-items-center">
      <div class="col-auto ">
        <img src="images/logo.jpg" class="ii" width="100" alt="">
        </div>
        <div class="col-auto" style="text-shadow: 2px 2px 4px #000;">
        Joy Cee Home Baked Shop<br>Food Ordering
</div>

        
      </div></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style="text-shadow: 2px 2px 4px #000;">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="prod.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <?php if(isset($_SESSION['user']))
              {
                echo ' <li class="nav-item">
                <a class="nav-link" href="view-orders.php">Orders</a>
                  </li>';
                  echo ' <li class="nav-item">
                <a class="nav-link" href="view_cart.php">Cart</a>
                  </li>';
                  echo ' <li class="nav-item">
                <a class="nav-link" href="settings.php">Settings</a>
                  </li>';
                  echo ' <li class="nav-item">
                <a class="nav-link"  href="logout.php">Logout</a>
                  </li>';
              }else{
                echo ' <li class="nav-item">
                <a class="nav-link"  href="login.php">Login</a>
                  </li>
                  <li class="nav-item">
            <a class="nav-link btn-order  " id="ord" href="login.php">Buy Now</a>
           </li>
                  ';
              }
            ?>
            
      </ul>
    </div>
  </div>
</nav>

<div class="container d-flex justify-content-center align-items-center vh-100 ">
    <div class="row shadow" style="width: 70%; border-radius:50px;">
        <div class="col-md-6 offset-md-3 " >
            <form class="form " action="sendMail.php" method="post">
                <h1 class="login-title mt-4 mb-4">Registration</h1>
                <input type="text" class="login-input form-control mb-3" name="username" placeholder="Username" required />
                <input type="email" pattern="[a-z0-9._%+-]+@gmail\.com$" required class="login-input form-control mb-3" name="email" placeholder="Google mail address">
                <input type="text" class="login-input form-control mb-3" name="name" placeholder="Your full contact name" required>
                <input type="text" class="login-input form-control mb-3" name="address" placeholder="Your contact address" required>
                <div class="row">
                    <div class="col-sm-4">
                            <input type="text" name="add" value="+639" class="login-input form-control text-center" style="pointer-events: none;"> 
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="login-input form-control" name="number" pattern="[0-9]{9}"  placeholder="Your contact number" title="9 digits number" required>
                    </div>
                </div>

                <input type="submit" name="submit" value="Register" class="login-button btn btn-primary btn-block mt-4">
                <p class="link mt-3">Already have an account? <a href="login.php">Login here</a></p>
            </form>
        </div>
    </div>
</div>



</body>
</html>
