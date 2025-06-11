<?php

$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Connetion failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    $conn->query($sql);
}

// Fetch and display data
$result = $conn->query("SELECT * FROM users");

echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: left; padding: 8px;'>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
          </tr>";
}

echo "</table>";

$conn->close();
