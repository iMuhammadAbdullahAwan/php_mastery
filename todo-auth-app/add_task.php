<?php
require 'includes/auth.php';
require 'config/db_connect.php';
require 'includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validate_csrf_token($_POST['csrf_token'])) {
    $task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_STRING);
    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;
    $user_id = $_SESSION['user_id'];

    if (!empty($task)) {
        $stmt = $conn->prepare("INSERT INTO tasks (user_id, task, due_date) VALUES (:user_id, :task, :due_date)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':task', $task);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->execute();
    }
}
header('Location: dashboard.php');
exit;
