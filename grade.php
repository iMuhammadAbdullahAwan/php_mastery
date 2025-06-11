<?php

$scores = [49, 60, 70, 80, 90, 100];

foreach ($scores as $score) {
    if ($score <= 49) {
        echo "$score Fail <br>";
    } elseif ($score <= 60) {
        echo "$score C <br>";
    } elseif ($score <= 70) {
        echo "$score B <br>";
    } elseif ($score <= 80) {
        echo "$score A <br>";
    } elseif ($score <= 90) {
        echo "$score A+ <br>";
    } else {
        echo "$score A++ <br>";
    }
}
