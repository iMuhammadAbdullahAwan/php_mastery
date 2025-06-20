<?php
session_start();

if (isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}

$error = '';
$success = '';

$conn = new mysqli("localhost", "root", "", "todo");
if ($conn->connect_error) {
    die("Database connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $conn->query($sql);

    if (!$username || !$password) {
        $error = 'Please fill all fields';
    } elseif (isset($users[$username])) {
        $error = 'Username already exists';
    } else {
        $users[$username] = password_hash($password, PASSWORD_DEFAULT);
        $success = 'Registration successful! <a href="login.php">Sign in</a>.';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Sign Up</h2>
        <?php if ($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
        <?php if ($success): ?><p class="success"><?php echo $success; ?></p><?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Sign In</a></p>
    </div>
</body>

</html>