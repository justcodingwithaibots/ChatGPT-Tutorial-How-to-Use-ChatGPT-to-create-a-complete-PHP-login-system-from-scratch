<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_thor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize user input
$input_username = isset($_POST['username']) ? $conn->real_escape_string($_POST['username']) : '';
$input_password = isset($_POST['password']) ? $_POST['password'] : '';
$input_email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';

// Hash the password
$hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

// Prepare SQL statement to prevent SQL injection
$sql = "INSERT INTO tbl_users (username, password, email) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $input_username, $hashed_password, $input_email);

// Execute the prepared statement
if ($stmt->execute()) {
    // Registration success, redirect to register-success.php
    header("Location: register-success.php");
} else {
    // Registration failed, redirect to register-failed.php
    header("Location: register-failed.php");
}

// Close statement and connection
$stmt->close();
$conn->close();
exit();
?>
