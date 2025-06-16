<?php

class Product
{
    public $name;
    public $price;

    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function display()
    {
        echo "Product Name: " . htmlspecialchars($this->name) . "<br>";
        echo "Price: $" . htmlspecialchars(number_format($this->price, 2)) . "<br>";
    }

    public function applyDiscount($percentage)
    {
        if ($percentage < 0 || $percentage > 100) {
            throw new InvalidArgumentException("Discount percentage must be between 0 and 100.");
        }
        $this->price -= $this->price * ($percentage / 100);
    }

    public function getPrice()
    {
        return $this->price;
    }
}

// Example usage
$product = new Product("Sample Product", 100.00);
$product->display();
$product->applyDiscount(10);
$product->display();
// Output the final price after discount
echo "Final Price after discount: $" . htmlspecialchars(number_format($product->getPrice(), 2)) . "<br>";
