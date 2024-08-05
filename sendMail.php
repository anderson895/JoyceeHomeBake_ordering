
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require('db.php');


// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    // removes backslashes
    $username = stripslashes($_REQUEST['username']);
    //escapes special characters in a string
    $username = mysqli_real_escape_string($con, $username);
    $email    = stripslashes($_REQUEST['email']);
    $email    = mysqli_real_escape_string($con, $email);
    $generated = stripslashes(generateRandomString(9));
    $password = mysqli_real_escape_string($con, $generated);
    $fullname = htmlentities($_POST['name']);
    $address = htmlentities($_POST['address']);
    $contact = htmlentities($_POST['add']).htmlentities($_POST['number']);
    $create_datetime = date("Y-m-d H:i:s");
   try {
    $query    = "INSERT into `users` (username, password, email, create_datetime,contact_name,contact_address,contact_number)
    VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime','$fullname','$address','$contact')";
    $result   = mysqli_query($con, $query);
    if ($result) {
          
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'dummydummy1stapador@gmail.com';                     //SMTP username
                $mail->Password   = 'gshabvilydndzpux';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('JHBS@website.com', 'Joycee Home Baked Shop');
                $mail->addAddress($email, $fullname);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Registration Confirmation';
                $mail->Body    = 'Your OTP for our website is <b>'.$generated.'</b> you can now login and change your password.';
                $mail->AltBody = 'Your OTP for our website is <b>'.$generated.'</b> you can now login and change your password.';
                

                $mail->send();
                echo '<script>
                        alert("You are registered successfully, Please check your email for your otp")
                        window.location="login.php"
                    </script>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

            }   
    } else {
            echo '<script>
                alert("Required fields are missing")
                window.location="registration.php"
            </script>';
    }
   } catch (\Throwable $th) {
    echo '<script>
        alert("Use Other Username")
        window.location="registration.php"
    </script>';
   }

}
else{
    header("Location:registration.php");
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $result = '';
    for ($i = 0; $i < $length; $i++) {
        $result .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $result;
}?>