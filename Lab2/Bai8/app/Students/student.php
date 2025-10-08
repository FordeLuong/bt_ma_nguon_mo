<?php

Namespace App\Students;

class Person{
    public $name;
    public $age;

    public function __construct($name, $age){
        $this->name = $name;
        $this->age = $age;
    }
}

class Student extends Person{
    public $studentId;

    public function __construct($name, $age, $studentId){
        parent::__construct($name, $age);
        $this->studentId = $studentId;
    }

    public function displayInfo(){
        echo "Name: {$this->name}, Age: {$this->age}, Student ID: {$this->studentId}";
    }
}
?>