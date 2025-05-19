<?php
session_start();
include 'db.php'; // Veritabanına bağlanma

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM events WHERE id=? AND user_id=?");
    if ($stmt->execute([$id, $_SESSION['user_id']])) {
        echo "Event deleted successfully!";
    } else {
        echo "Error deleting event.";
    }
} else {
    echo "invalid";
}
?>
