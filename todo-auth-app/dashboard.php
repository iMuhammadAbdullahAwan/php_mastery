<?php
require 'includes/auth.php';
require 'config/db_connect.php';
require 'includes/csrf.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$tasks = $stmt->fetchAll();

include 'includes/header.php';
?>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
<form action="add_task.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
    <input type="text" name="task" placeholder="Enter task..." required aria-label="Task">
    <input type="date" name="due_date" aria-label="Due date">
    <button type="submit">Add Task</button>
</form>

<div class="task-list">
    <?php foreach ($tasks as $task): ?>
        <div class="task-card <?php echo $task['status'] ? 'completed' : ''; ?>">
            <span>
                <?php echo htmlspecialchars($task['task']); ?>
                <?php if ($task['due_date']): ?>
                    <small>(Due: <?php echo htmlspecialchars($task['due_date']); ?>)</small>
                <?php endif; ?>
            </span>
            <div>
                <?php if (!$task['status']): ?>
                    <a href="#" class="complete-task" data-task-id="<?php echo $task['id']; ?>">Complete</a> |
                <?php endif; ?>
                <a href="edit_task.php?id=<?php echo $task['id']; ?>">Edit</a> |
                <a href="delete_task.php?id=<?php echo $task['id']; ?>&csrf_token=<?php echo generate_csrf_token(); ?>" onclick="return confirm('Delete task?')">Delete</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'includes/footer.php'; ?>