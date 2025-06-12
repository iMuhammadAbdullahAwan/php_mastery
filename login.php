<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username is set
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $_SESSION["username"] = htmlspecialchars($_POST['username']);
        $_SESSION["logged_in"] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Please enter a username.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 300px;
            margin: auto;
        }

        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Login</h2>
    <?php if (isset($error)) {
        echo "<p class='error'>$error</p>";
    } ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Enter your username" required>
        <input type="submit" value="Login">
    </form>
    <p>Already logged in? <a href="dashboard.php">Go to Dashboard</a></p>
</body>