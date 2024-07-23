<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
        .forgot-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .forgot-container h2 {
            margin-top: 0;
            margin-bottom: 15px;
        }
        .forgot-container form {
            display: flex;
            flex-direction: column;
        }
        .forgot-container input[type="email"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .forgot-container input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .forgot-container input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .forgot-container .links {
            margin-top: 15px;
            text-align: center;
        }
        .forgot-container .links a {
            color: #007bff;
            text-decoration: none;
        }
        .forgot-container .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
        <h2>Forgot Password</h2>
        <form action="forgotpassword-execute.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="submit" value="Reset Password">
        </form>
        <div class="links">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</body>
</html>
