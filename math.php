<?php

function square($number)
{
    return "Square of $number is " . $number * $number;
}

function qube($number)
{
    return "Qube of $number is " . $number * $number * $number;
}

echo square(4);
echo qube(4);
