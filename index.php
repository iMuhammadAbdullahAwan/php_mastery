<?php

echo "Hello, World! <br>";

$name = "Ali";
$age = 21;
$price = 19.99;
$is_student = true;
$fruits = ["Apple", "Banana", "Orange"];

echo "Name: $name, Age: $age, Favorite Fruit: $fruits[0] <br>";

$a = 10;
$b = 5;

$sum = $a + $b;
$product = $a * $b;

$is_equal = ($a == $b);
$is_greater = ($a > $b);

$greeting = "Hello, " . $name;

echo "Sum: $sum, Equal: $is_equal, Greeting: $greeting <br>";


if ($age >= 18) {
    echo "You can vote! <br>";
} else {
    echo "Too young to vote. <br>";
}

for ($i = 1; $i <= 3; $i++) {
    echo "Count : $i <br>";
}

foreach ($fruits as $fruit) {
    echo "Fruit: $fruit <br>";
}

$hobbies = ["Youtube Reel Scrowling", "Over Thinking", "Day Dreming"];
foreach ($hobbies as $hobby) {
    echo "Hobby: $hobby <br>";
}


function greet($name)
{
    return "Hello, $name!";
}

echo greet("Ali");

// Function with default parameter
function add($a, $b = 10)
{
    return $a + $b;
}

echo add(5); // 15 (5 + 10)
echo add(5, 20); // 25

?>

<form action="process.php" method="post">
    <label for="username">Name:</label>
    <input type="text" id="username" name="username">
    <button>Submit</button>
</form>

<br>


<form action="contact.php" method="post">
    <label for="username">Name:</label>
    <input type="text" id="username" name="username">
    <br>
    <label for="email">Name:</label>
    <input type="email" id="email" name="email">
    <br>
    <button>Submit</button>
</form>


<?php

$conn = new mysqli("localhost", "root", "", "mydb");

if ($conn->connect_error) {
    die("Connetion failed: " . $conn->connect_error);
}

// Insert data
$name = "Ali";
$email = "ali@example.com";
$sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
$conn->query($sql);


$result = $conn->query("SELECT * FROM users");

while ($row = $result->fetch_assoc()) {
    echo "ID: {$row['id']}, Name: {$row['name']}, Email: {$row['email']} <br>";
}

$conn->close();
