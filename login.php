<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
login();
// print_r($_SESSION['qty']);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JHBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/new.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-H9XgNXUrPb6UJox6S1S6jyGJ+I/WfW1+t8IZ4jq4JG0jvUwpNV69c6BbrdKyBnCrmgFM+BNxbyWfFnG4iQX9jA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            </div>
        </a>
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
                <?php if(isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="view-orders.php">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_cart.php">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="logout.php">Logout</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link"  href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-order" id="ord" href="login.php">Buy Now</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container d-flex justify-content-center align-items-center vh-100 ">
    <div class="row shadow" style="width: 70%; border-radius:50px;">
        <div class="col-md-6 offset-md-3 " >
            <form class="form" method="post" name="login" id="loginForm">
                <h1 class="login-title mt-4 mb-4">Login</h1>
                <input type="text" class="login-input form-control mb-3"  name="username" placeholder="Username" autofocus="true"/>
                <input type="password" class="login-input form-control mb-3"  name="password" placeholder="Password"/>
                <input type="submit" value="Login" name="submit" class="login-button btn btn-primary btn-block"/>
                <p class="link text-center mt-3">Don't have an account? <br> <a href="registration.php">Register Now</a></p>
            </form>
        </div>
    </div>
</div>

<script>
    // JavaScript for displaying notification on incorrect username/password
    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'login_process.php', // Update the URL to your login processing script
                data: formData,
                success: function(response) {
                    console.log(response)
                    if (response === 'success') {
                        window.location.href = 'dashboard.php';
                    } else {
                        // Show notification for incorrect username/password
                        alert('Incorrect Username/password.');
                    }
                }
            });
        });
    });
</script>

</body>
</html>
