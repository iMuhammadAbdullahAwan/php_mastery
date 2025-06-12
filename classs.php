<?php

class Car
{
    public $brand;
    public $speed;
    public $color;

    public function __construct($brand, $speed, $color)
    {
        $this->brand = $brand;
        $this->speed = $speed;
        $this->color = $color;
    }

    public function displayInfo()
    {
        return "Brand: $this->brand, Speed: $this->speed km/h, Color: $this->color";
    }

    public function accelerate($increase)
    {
        $this->speed += $increase;
        return "New speed: $this->speed km/h";
    }

    public function drive($distance)
    {
        return "Driving $distance km at $this->speed km/h.";
    }
}

$myCar = new Car("Toyota", 120, "Red");
echo $myCar->displayInfo() . "\n";
echo $myCar->drive(30);
