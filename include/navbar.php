
<?php
      session_start();

    function Products()
    {

    ?>
        <!DOCTYPE html>
<html>
<head>
<title>RRG Onemoto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<style>
body{
  margin: 0;
  padding: 0;
  font-family: Arial;
}
nav{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 10%;
  padding: 10px 90px;
  box-sizing: border-box;
  background: #201F1F;
  border-bottom: 1px solid #ffff;
  font-size: 24px;
  border-radius: 10px;
}
nav .logo{
  padding: 22px 20px;
  height: 80px;
  float: left;
  font-size: 26px;
  font-weight: bold;
  text-transform: uppercase;
  color: #fff;
}
nav ul{
  list-style: none;
  float: right;
  margin: 0;
  padding: 0;
  display: flex;
}
nav ul li a{
  line-height: 80px;
  color: #fff;
  padding: 12px 30px;
  text-decoration: none;
  font-size: 14px;
  font-weight: bold;
  text-transform: uppercase;
  font-size: 16px;
}
nav ul li a:hover{
  background: white;
  border-radius: 6px;
  color: #201F1F;
}
.picture{
	margin:50px;
  margin-top: 75px;
	float:left;
	width:405px;
  justify-content: center;
}
.picture img{
	width:100%;
	height:100;
	border-radius:15px;
  border-color: aquamarine;
  padding:15px;
}
.picture:hover{
	background:#f2f2f2;
	border-radius:15px;
  text-transform: uppercase;
}
.desc{
	padding:15px;
	text-align:center;
	font-family:Arial;
}
</style>
</head>
<body>
  <div>
      <nav class="navbar navbar-default" style="background-color: black;">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" style="color: white;" href="homepage.php">RRG Onemoto</a>
            <a class="navbar-brand" style="color: white;" href="homepage.php">Home</a>
            <a class="navbar-brand" style="color: white;" href="prod.php">Product</a>
            <a class="navbar-brand" style="color: white;" href="about.php">About</a>
            <?php if(isset($_SESSION['user']))
              {
                echo '<a class="navbar-brand" style="color: white;" href="view-orders.php">Orders</a>';
                echo '<a class="navbar-brand" style="color: white;" href="logout.php">Logout</a>';
              }else{
                echo'<a class="navbar-brand" style="color: white;" href="login.php">Login</a>';
              }
            ?>


          </div>
        </div>
      </nav>
    </div>

    <?php
    }
    ?>
    <?php
    function homepage(){
        ?>
        <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RRG Onemoto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <style>
  .background-image{
    background-image: url(new.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    height: 190vh;
  }
  .bg-image{
    background-image: url(bseller.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    height: 140vh;
  }
  footer{
    background: black;
    padding: 20px;
}
footer p{
    color: #fff;
}

  </style>
  <body>
  
<style>


.navbar {
  overflow: hidden;
  background-color: #333;
  position: fixed;
  top: 0;
  width: 100%;
}

</style>

<div class="Fixednavbar">
        <nav class="navbar navbar-default" style="background-color: black;">
      	  <div class="container-fluid" style="">
      	    <div class="navbar-header">
			
      	      <a class="navbar-brand" style="color: white;" href="homepage.php">RRG Onemoto</a>
      				<a class="navbar-brand" style="color: white;" href="homepage.php">Home</a>
      				<a class="navbar-brand" style="color: white;" href="prod.php">Product</a>
      				<a class="navbar-brand" style="color: white;" href="about.php">About</a>
              <?php if(isset($_SESSION['user']))
              {
                echo '<a class="navbar-brand" style="color: white;" href="view-orders.php">Orders</a>';
                echo '<a class="navbar-brand" style="color: white;" href="logout.php">Logout</a>';
              }else{
                echo'<a class="navbar-brand" style="color: white;" href="login.php">Login</a>';
              }
            ?>

      	    </div>
      	  </div>
      	</nav>
		</div>
        <?php
    }
    function about(){
      ?>
      <!DOCTYPE>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABOUT US </title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
    *{
        padding: 0;
        margin: 0;
    }
    body{
        background-color: white;
    }
    .about-1{
        margin: 30px;
        padding: 5px;
    }
    .about-1 h1{
        text-align: center;
        color: black;
        font-weight: bold;
    }
    .about-1 p{
        text-align: center;
        padding: 3px;
        color: #fff;
    }
    .about-item{
        margin-bottom: 20px;
        margin-top: 20px;
        background-color: white;
        padding: 80px 30px;
        box-shadow: 0 0 9px rgba(0,0,0.6);
    }
    .about-item i{
        font-size: 43px;
        margin: 0;
    }
    .about-item h3{
        font-size: 25px;
        margin-bottom: 10px;
    }
    .about-item hr{
        width: 46px;
        height: 3px;
        background-color: #5fbff9;
        margin: 0 auto;
        border: none;
        text-align: center;
    }
    .about-item:hover{
        background-color: #5fbff9;
    }
    .about-item:hover i,
    .about-item:hover h3,
    .about-item:hover p{
        color: #fff;
    }
    .about-item:hover hr{
        background-color: #fff;
    }
    .about-item:hover i{
        transform: translateY(-20px);
    }
    .about-item:hover i,
    .about-item:hover h3,
    .about-item:hover hr{
        transition: all 400ms ease-in-out;
    }

    footer{
        background: black;
        padding: 20px;
    }
    footer p{
        color: #fff;
    }
    </style>
</head>
<body>
  <div>
      <nav class="navbar navbar-default" style="background-color: #000d04;">
    	  <div class="container-fluid">
    	    <div class="navbar-header">
    	      <a class="navbar-brand" style="color: white;" href="homepage.php">RRG Onemoto</a>
    				<a class="navbar-brand" style="color: white;" href="homepage.php">Home</a>
    				<a class="navbar-brand" style="color: white;" href="product.php">Product</a>
    				<a class="navbar-brand" style="color: white;" href="about.php">About</a>
            <?php if(isset($_SESSION['user']))
              {
                echo '<a class="navbar-brand" style="color: white;" href="view-orders.php">Orders</a>';
                echo '<a class="navbar-brand" style="color: white;" href="logout.php">Logout</a>';
              }else{
                echo'<a class="navbar-brand" style="color: white;" href="login.php">Login</a>';
              }
              ?>
    	    </div>
    	  </div>
    	</nav>
    </div>
   <?php }
   function cart(){ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>RRG Onemoto</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div>
	<nav class="navbar navbar-default" style="background-color: #000d04;">
	  <div class="container-fluid">
	    <div class="navbar-header">
				<a class="navbar-brand" style="color: white;" href="homepage.php">RRG Onemoto</a>
				<a class="navbar-brand" style="color: white;" href="homepage.php">Home</a>
				<a class="navbar-brand" style="color: white;" href="prod.php">Product</a>
				<a class="navbar-brand" style="color: white;" href="about.php">About</a>
				<?php if(isset($_SESSION['user']))
              {
                echo '<a class="navbar-brand" style="color: white;" href="view-orders.php">Orders</a>';
                echo '<a class="navbar-brand" style="color: white;" href="logout.php">Logout</a>';
              }else{
                echo'<a class="navbar-brand" style="color: white;" href="login.php">Login</a>';
              }
              ?>
	    </div>

	  </div>
	</nav>
<?php   }
function check(){
  echo '<pre>';
	print_r($_SESSION);
	echo '</pre>';
}
function prod_list(){?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>RRG Onemoto</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<style>
		.product_image{
			height:320px;
		}
		.product_name{
			height:80px;
			padding-left:20px;
			padding-right:20px;
		}
		.product_footer{
			padding-left:50px;
			padding-right:50px;
		}
		footer{
	background: black;
	padding: 20px;
}
footer p{
	color: #fff;
}
	</style>
</head>
<body>
	<div>
			<nav class="navbar navbar-default" style="background-color: black;">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" style="color: white;" href="homepage.php">RRG Onemoto</a>
						<a class="navbar-brand" style="color: white;" href="homepage.php">Home</a>
						<a class="navbar-brand" style="color: white;" href="product.php">Product</a>
						<a class="navbar-brand" style="color: white;" href="about.php">About</a>
						<?php if(isset($_SESSION['user']))
              {
                echo '<a class="navbar-brand" style="color: white;" href="view-orders.php">Orders</a>';
                echo '<a class="navbar-brand" style="color: white;" href="logout.php">Logout</a>';
              }else{
                echo'<a class="navbar-brand" style="color: white;" href="login.php">Login</a>';
              }
              ?>
					</div>
				</div>
			</nav>
		</div>
<?php }
    ?>
