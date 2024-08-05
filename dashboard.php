<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
user();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Client area</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(images/logo.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #edd7ac;
            background-position: top;
        }
        .form-container {
            margin-top: 100px;
        }
        .form-box {
            width: 450px;
            padding: 50px 40px;
            background: white;
            border-radius: 10px;
        }
        .form-box p {
            font-size: 18px;
        }
        .btn-continue {
            font-size: 16px;
            padding: 10px 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh;">
            <div class="col-md-6">
                <div class="form-box">
                    <p>Hey, <?php echo $_SESSION['username']; ?>! Thank you! Hope to see you again!</p>
                    <div class="text-center">
                        <a href="index.php" class="btn btn-primary btn-continue">Continue</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
