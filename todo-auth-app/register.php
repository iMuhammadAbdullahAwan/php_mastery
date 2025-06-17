<?php
session_start();
require 'config/db_connect.php';
require 'includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validate_csrf_token($_POST['csrf_token'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        if (strlen($password) < 6) {
            $error = "Password must be at least 6 characters!";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $error = "Username already exists!";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashed_password);
                $stmt->execute();
                $_SESSION['success'] = "Registration successful! Please login.";
                header('Location: login.php');
                exit;
            }
        }
    } else {
        $error = "Please fill in all fields!";
    }
}
include 'includes/header.php';
?>

<h2>Register</h2>
<?php if (isset($error)): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form action="register.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
    <input type="text" name="username" placeholder="Username" required aria-label="Username">
    <input type="password" name="password" placeholder="Password" required aria-label="Password">
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="login.php">Login</a></p>
<?php include 'includes/footer.php'; ?>