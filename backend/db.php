<?php
$host = 'localhost';
$dbname = 'event-management';
$username = 'root';  // Default XAMPP MySQL username
$password = '';  // Default XAMPP MySQL password is empty

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>