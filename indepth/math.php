<?php

function square($num)
{
    return $num * $num;
}

function cube($num)
{
    return $num * $num * $num;
}

function power($num, $exp)
{
    $result = 1;
    for ($i = 0; $i < $exp; $i++) {
        $result *= $num;
    }
    return $result;
}

function factorial($num)
{
    if ($num < 0) {
        return "Undefined for negative numbers";
    }
    $result = 1;
    for ($i = 1; $i <= $num; $i++) {
        $result *= $i;
    }
    return $result;
}

function fibonacci($n)
{
    if ($n < 0) {
        return "Undefined for negative numbers";
    }
    $fib = [0, 1];
    for ($i = 2; $i <= $n; $i++) {
        $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
    }
    return $fib[$n];
}

function gcd($a, $b)
{
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

echo "Square of 5: " . square(5) . "<br>";
echo "Cube of 3: " . cube(3) . "<br>";
echo "5 to the power of 3: " . power(5, 3) . "<br>";
echo "Factorial of 5: " . factorial(5) . "<br>";
echo "Fibonacci of 7: " . fibonacci(7) . "<br>";
echo "GCD of 48 and 18: " . gcd(48, 18) . "<br>";
