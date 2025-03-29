<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    if ($stmt->execute([$event_id])) {
        echo "Event deleted successfully!";
    } else {
        echo "Error deleting event.";
    }
}
?>
