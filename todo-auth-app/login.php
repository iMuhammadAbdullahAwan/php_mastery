<?php
session_start();
require 'config/db_connect.php';
require 'includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validate_csrf_token($_POST['csrf_token'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Please fill in all fields!";
    }
}
include 'includes/header.php';
?>

<h2>Login</h2>
<?php if (isset($_SESSION['success'])): ?>
    <div class="success"><?php echo htmlspecialchars($_SESSION['success']);
                            unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if (isset($error)): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form action="login.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
    <input type="text" name="username" placeholder="Username" required aria-label="Username">
    <input type="password" name="password" placeholder="Password" required aria-label="Password">
    <button type="submit">Login</button>
</form>
<p>Need an account? <a href="register.php">Register</a></p>
<?php include 'includes/footer.php'; ?>