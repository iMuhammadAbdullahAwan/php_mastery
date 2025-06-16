<?php

// welcome.php
session_start();
if (!isset($_SESSION["username"])) {
    echo "You must sign up first.";
    exit();
}
$name = $_SESSION["username"];
$email = $_SESSION["email"];

echo "Hi, $name. Your email is $email.";
