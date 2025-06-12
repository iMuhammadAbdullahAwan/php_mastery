<?php

header('Content-Type: application/json');

$todos = [
    [
        "id" => 1,
        "title" => "Sample Todo",
        "completed" => false
    ],
    [
        "id" => 2,
        "title" => "Sample Todo1",
        "completed" => true
    ],
    [
        "id" => 3,
        "title" => "Sample Todo2",
        "completed" => false
    ]
];

echo json_encode($todos);
http_response_code(200);
