<?php

$scores = [
    85,
    92,
    78,
    88,
];

foreach ($scores as $score) {
    if ($score >= 90) {
        $grade = 'A <br>';
    } elseif ($score >= 80) {
        $grade = 'B <br>';
    } elseif ($score >= 70) {
        $grade = 'C <br>';
    } elseif ($score >= 60) {
        $grade = 'D <br>';
    } else {
        $grade = 'F <br>';
    }

    echo " Score = $score, Grade = $grade";
}
