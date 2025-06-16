<?php
header("Content-Type: application/json; charset=UTF-8");

$tasks = [
    [
        "id" => 1,
        "title" => "Task 1",
        "description" => "Description for Task 1",
        "status" => "pending"
    ],
    [
        "id" => 2,
        "title" => "Task 2",
        "description" => "Description for Task 2",
        "status" => "completed"
    ],
    [
        "id" => 3,
        "title" => "Task 3",
        "description" => "Description for Task 3",
        "status" => "in-progress"
    ]
];

echo json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
// Note: In a real application, you would typically fetch tasks from a database.