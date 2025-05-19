<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    if (!$title || !$description || !$event_date || !$location) {
        echo "Please fill in all required fields.";
        exit;
    }

    $stmt = $conn->prepare("UPDATE events SET title=?, description=?, event_date=?, location=? WHERE id=? AND user_id=?");
    if ($stmt->execute([$title, $description, $event_date, $location, $event_id, $_SESSION['user_id']])) {
        echo "Event updated successfully!";
    } else {
        echo "Error updating event.";
    }
}
?>
