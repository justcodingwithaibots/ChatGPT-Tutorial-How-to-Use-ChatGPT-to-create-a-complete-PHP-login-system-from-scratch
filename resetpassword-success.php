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
    <title>Password Reset Success</title>
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
        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            text-align: center;
        }
        .container h2 {
            margin-top: 0;
            margin-bottom: 15px;
        }
        .container .links a {
            display: block;
            margin: 10px 0;
            color: #007bff;
            text-decoration: none;
        }
        .container .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Reset Successful</h2>
        <p>Your password has been successfully reset!</p>
        <div class="links">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
