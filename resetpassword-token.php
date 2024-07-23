<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_thor";

// Check if token is provided in the URL
if(isset($_GET['token'])){
    $token = $_GET['token'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to check the validity of the token
    $stmt = $conn->prepare("SELECT id FROM tbl_users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // If token is valid
    if ($result->num_rows > 0) {
        // Fetch user ID from the database
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Set session 'id' with the user ID
        $_SESSION['id'] = $user_id;

        // Prepare SQL statement to delete the reset token
        $stmt_delete = $conn->prepare("UPDATE tbl_users SET reset_token = NULL WHERE id = ?");
        $stmt_delete->bind_param("i", $user_id);
        $stmt_delete->execute();
        $stmt_delete->close();

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to resetpassword.php
        header("Location: resetpassword.php");
        exit();
    } else {
        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Redirect to resetpassword-failed.php if token is invalid
        header("Location: resetpassword-failed.php");
        exit();
    }
} else {
    // Redirect to resetpassword-failed.php if token is not provided in the URL
    header("Location: resetpassword-failed.php");
    exit();
}
?>
