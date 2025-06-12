<?php

session_start();

$_SESSION["username"] = "Muhammad Abdullah Awan";
$_SESSION["logged_in"] = true;

if (isset($_SESSION["username"]) && $_SESSION["logged_in"]) {
    echo "Welcome, " . $_SESSION["username"] . "!";
} else {
    echo "Please log in.";
}

session_destroy();
