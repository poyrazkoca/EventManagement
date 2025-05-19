<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    if (!$username || !$email) {
        echo "Please fill in all fields.";
        exit;
    }

    // TEDU mail kontrolü
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@tedu\.edu\.tr$/", $email)) {
        echo "Only TEDU email addresses are allowed.";
        exit;
    }

    $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
    if ($stmt->execute([$username, $email, $_SESSION['user_id']])) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user.";
    }
}
?>