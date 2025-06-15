<?php

$apple_quantity = 2;
$banana_quantity = 5;

$price_apple = 10;
$price_banana = 20;

$total_price = ($apple_quantity * $price_apple) + ($banana_quantity * $price_banana);

if ($total_price > 100) {
    $discount = $total_price * 0.05; // 5% discount
    $total_price -= $discount;
    $discount_status = "A discount of 5% has been applied.";
} else {
    $discount_status = "No discount applied.";
}

echo "Total Price: $" . $total_price . "\n";
echo $discount_status . "\n";
