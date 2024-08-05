<?php
// Include the necessary files and start the session

// include("auth_session.php");
// login();


require('db.php');

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = md5($_POST['password']); // Using MD5 hashing for simplicity, consider using more secure hashing methods

    // Query the database to check if the username and password combination exists
    $query = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        // Authentication successful
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['user'] = $row['user'];
        $_SESSION['id'] = $row['id'];
        unset($_SESSION['cart']);
        unset($_SESSION['qty_array']);
        unset($_SESSION['qty']);

        echo 'success'; // Return success response
    } else {
        // Authentication failed
        echo 'error'; // Return error response
    }
} else {
    // Redirect if accessed directly
    header("Location: login.php");
}
?>
