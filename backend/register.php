<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TEDU mail kontrolü
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@tedu\.edu\.tr$/", $email)) {
        echo "Only TEDU email addresses are allowed.";
        exit;
    }

    // Şifreyi hashle
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Aynı e-mail var mı?
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        echo "Email already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $email, $hashedPassword])) {
            echo "Register successful.";
        } else {
            echo "Registration failed.";
        }
    }
}
?>
