<?php
session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

require_once 'task.php';

$conn = new mysqli("localhost", "root", "", "todo");
if ($conn->connect_error) {
    die("Database connection failed");
}
$username = $_SESSION['username'];
$task = new Task($conn, $username);

$error = '';
$editTask = null;

// Handle add, delete, toggle, edit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $title = trim($_POST["title"]);
        if ($title) {
            $task->add($title);
        } else {
            $error = "Task title required.";
        }
    } elseif (isset($_POST['delete'])) {
        $task->delete((int)$_POST['delete']);
    } elseif (isset($_POST['toggle'])) {
        $task->toggle((int)$_POST['toggle']);
    } elseif (isset($_POST['edit_id'])) {
        $editTask = $task->get((int)$_POST['edit_id']);
    } elseif (isset($_POST['update'])) {
        $task->update((int)$_POST['update'], trim($_POST['title']));
    }
}

$tasks = $task->getAll();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Todos for <?php echo htmlspecialchars($username); ?></h1>
        <?php if ($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>

        <?php if ($editTask): ?>
            <form method="POST">
                <input type="text" name="title" value="<?php echo htmlspecialchars($editTask['title']); ?>" required>
                <button type="submit" name="update" value="<?php echo $editTask['id']; ?>">Update</button>
                <a href="index.php">Cancel</a>
            </form>
        <?php else: ?>
            <form method="POST">
                <input type="text" name="title" placeholder="New task..." required>
                <button type="submit" name="add">Add</button>
            </form>
        <?php endif; ?>

        <ul>
            <?php foreach ($tasks as $t): ?>
                <li class="<?php echo $t['completed'] ? 'completed' : ''; ?>">
                    <?php echo htmlspecialchars($t["title"]); ?>
                    <span class="todo-actions">
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="toggle" value="<?php echo $t['id']; ?>" class="toggle"><?php echo $t['completed'] ? 'Undo' : 'Done'; ?></button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="edit_id" value="<?php echo $t['id']; ?>" class="edit">Edit</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="delete" value="<?php echo $t['id']; ?>" class="delete" onclick="return confirm('Delete this task?')">Delete</button>
                        </form>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
        <form action="logout.php" method="post" style="text-align:center;">
            <button type="submit">Logout</button>
        </form>
    </div>
</body>

</html>