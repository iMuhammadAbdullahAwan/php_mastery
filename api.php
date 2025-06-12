<?php

header('Content-Type: application/json');

$products = [
    [
        "id" => 1,
        "name" => "Laptop",
        "price" => 2000
    ],
    [
        "id" => 2,
        "name" => "Smartphone",
        "price" => 800
    ],
    [
        "id" => 3,
        "name" => "Tablet",
        "price" => 600
    ]
];

echo json_encode($products);
http_response_code(200);
