<?php
$dsn = "mysql:host=localhost;dbname=lab3_shop;charset=utf8mb4";
$username = "root";   
$password = "";       

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
