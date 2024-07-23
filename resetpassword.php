<?php
session_start();

// Check if session 'id' is not set, then redirect to login.php
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .reset-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .reset-container h2 {
            margin-top: 0;
            margin-bottom: 15px;
        }
        .reset-container form {
            display: flex;
            flex-direction: column;
        }
        .reset-container input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .reset-container input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .reset-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .reset-container .links {
            margin-top: 15px;
            text-align: center;
        }
        .reset-container .links a {
            color: #007bff;
            text-decoration: none;
        }
        .reset-container .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2>Reset Password</h2>
        <form action="resetpassword-execute.php" method="POST">
            <input type="password" name="newpassword" placeholder="New Password" required>
            <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
            <input type="submit" value="Reset Password">
        </form>
        <div class="links">
            <a href="login-success.php">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
