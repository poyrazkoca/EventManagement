<?php
include 'db.php';

// Fetch events
$stmt = $conn->prepare("SELECT * FROM events ORDER BY event_date ASC");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the events as JSON
echo json_encode($events);
?>