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

// Prepare SQL statement to prevent SQL injection
$sql = "SELECT id, password FROM tbl_users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $input_username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Bind result variables
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    // Verify password
    if (password_verify($input_password, $hashed_password)) {
        // Password is correct, create session and redirect to login-success.php
        $_SESSION['id'] = $user_id;
        header("Location: login-success.php");
    } else {
        // Password is incorrect, redirect to login-failed.php
        header("Location: login-failed.php");
    }
} else {
    // Username not found, redirect to login-failed.php
    header("Location: login-failed.php");
}

// Close statement and connection
$stmt->close();
$conn->close();
exit();
?>
