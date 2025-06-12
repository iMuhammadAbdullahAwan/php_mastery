<?php

class Student
{
    public $name;
    public $age;
    public $grade;

    public function __construct($name, $age, $grade)
    {
        $this->name = $name;
        $this->age = $age;
        $this->grade = $grade;
    }

    public function displayInfo()
    {
        return "Name: $this->name, Age: $this->age, Grade: $this->grade";
    }

    public function study($hours)
    {
        return "$this->name has studied for $hours hours.";
    }

    public function takeExam()
    {
        return "$this->name is taking an exam.";
    }
}

$student1 = new Student("Alice", 20, "A");
echo $student1->displayInfo() . "\n";
echo $student1->study(3) . "\n";
echo $student1->takeExam() . "\n";
$student2 = new Student("Bob", 22, "B");
echo $student2->displayInfo() . "\n";
echo $student2->study(2) . "\n";
echo $student2->takeExam() . "\n";
