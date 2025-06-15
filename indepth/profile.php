<?php

$name = "Muhammad Abdullah Awan";
$age = 21;
$is_student = true;
$hobbies = ["Programming", "Youtube Scrowling", "Reading"];

echo "<p>My name is $name, I am $age years old. I am " . ($is_student ? "a student" : "not a student") . ".</p>";
echo "<p>My hobbies include:</p>";
echo "<ul>";
foreach ($hobbies as $hobby) {
    echo "<li>$hobby</li>";
}
echo "</ul>";
