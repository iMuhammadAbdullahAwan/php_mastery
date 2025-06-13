<?php

class Task
{
    private $conn;
    private $username;

    public function __construct($conn, $username)
    {
        $this->conn = $conn;
        $this->username = $username;
    }

    public function add($title)
    {
        $stmt = $this->conn->prepare("INSERT INTO tasks (title, completed, username) VALUES (?, 0, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("ss", $title, $this->username);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        return true;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE username = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("s", $this->username);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Get result failed: " . $stmt->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ? AND username = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("is", $id, $this->username);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        return true;
    }

    public function toggle($id)
    {
        $stmt = $this->conn->prepare("UPDATE tasks SET completed = NOT completed WHERE id = ? AND username = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("is", $id, $this->username);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        return true;
    }

    public function update($id, $title)
    {
        $stmt = $this->conn->prepare("UPDATE tasks SET title = ? WHERE id = ? AND username = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("sis", $title, $id, $this->username);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        return true;
    }

    public function get($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tasks WHERE id = ? AND username = ?");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $this->conn->error);
        }
        $stmt->bind_param("is", $id, $this->username);
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Get result failed: " . $stmt->error);
        }
        return $result->fetch_assoc();
    }
}
