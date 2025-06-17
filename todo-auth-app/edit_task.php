<?php
require 'includes/auth.php';
require 'config/db_connect.php';
require 'includes/csrf.php';

$user_id = $_SESSION['user_id'];
$task_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
$stmt->bindParam(':id', $task_id);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$task = $stmt->fetch();

if (!$task) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && validate_csrf_token($_POST['csrf_token'])) {
    $new_task = filter_input(INPUT_POST, 'task', FILTER_SANITIZE_STRING);
    $due_date = !empty($_POST['due_date']) ? $_POST['due_date'] : null;

    if (!empty($new_task)) {
        $stmt = $conn->prepare("UPDATE tasks SET task = :task, due_date = :due_date WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':task', $new_task);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->bindParam(':id', $task_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Task cannot be empty!";
    }
}
include 'includes/header.php';
?>

<h2>Edit Task</h2>
<?php if (isset($error)): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form action="edit_task.php?id=<?php echo $task_id; ?>" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
    <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required aria-label="Task">
    <input type="date" name="due_date" value="<?php echo htmlspecialchars($task['due_date']); ?>" aria-label="Due date">
    <button type="submit">Save Changes</button>
</form>
<p><a href="dashboard.php">Back to Dashboard</a></p>
<?php include 'includes/footer.php'; ?>