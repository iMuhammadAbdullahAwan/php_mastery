<?php
require 'includes/auth.php';
require 'config/db_connect.php';
require 'includes/csrf.php';

$user_id = $_SESSION['user_id'];
if (isset($_GET['id']) && isset($_GET['csrf_token']) && validate_csrf_token($_GET['csrf_token'])) {
    $id = (int)$_GET['id'];
    $stmt = $conn->prepare("SELECT user_id FROM tasks WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $task = $stmt->fetch();

    if ($task && $task['user_id'] == $user_id) {
        $stmt = $conn->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
header('Location: dashboard.php');
exit;
