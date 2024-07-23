<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_thor";

// Check if session 'id' is not set, then redirect to login.php
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize user input
$input_newpassword = isset($_POST['newpassword']) ? $_POST['newpassword'] : '';
$input_confirmpassword = isset($_POST['confirmpassword']) ? $_POST['confirmpassword'] : '';

// Check if new password matches confirm password
if ($input_newpassword !== $input_confirmpassword) {
    // Redirect to resetpassword-failed.php if new password and confirm password do not match
    header("Location: resetpassword-failed.php");
    exit();
}

// Hash the new password
$hashed_password = password_hash($input_newpassword, PASSWORD_DEFAULT);

// Prepare SQL statement to prevent SQL injection
$sql = "UPDATE tbl_users SET password = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $hashed_password, $_SESSION['id']);

// Execute the prepared statement
if ($stmt->execute()) {
    // Password reset success, redirect to resetpassword-success.php
    header("Location: resetpassword-success.php");
    exit();
} else {
    // Password reset failed, redirect to resetpassword-failed.php
    header("Location: resetpassword-failed.php");
    exit();
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
