<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';




// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_thor";

// Check if email is submitted
if(isset($_POST['email'])){
    $email = $_POST['email'];



    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Generate a random reset token
    $reset_token = bin2hex(random_bytes(32));

    // Prepare SQL statement to update reset token
    $stmt = $conn->prepare("UPDATE tbl_users SET reset_token = ? WHERE email = ?");
    $stmt->bind_param("ss", $reset_token, $email);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Send reset password email using PHPMailer

        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'jf231203@gmail.com';                     // SMTP username
            $mail->Password   = 'jecqycnenbwsmysj';                               // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
            // Sender
            $mail->setFrom('jf231203@gmail.com', 'Thor');
            
            // Recipient
            $mail->addAddress($email);     // Add a recipient
            
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Reset Your Password';
            $mail->Body    = 'Click the following link to reset your password: <a href="http://localhost/mylogin/resetpassword-token.php?token='.$reset_token.'">Reset Password</a>';
            
            $mail->send();

            // Redirect to forgotpassword-success.php
            header("Location: forgotpassword-success.php");
            exit();
        } catch (Exception $e) {
            // Redirect to forgotpassword-failed.php if sending email failed
            header("Location: forgotpassword-failed.php");
            exit();
        }
    } else {
        // Redirect to forgotpassword-failed.php if execution of SQL statement failed
        header("Location: forgotpassword-failed.php");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect to forgotpassword.php if email is not submitted
    header("Location: forgotpassword.php");
    exit();
}
?>
