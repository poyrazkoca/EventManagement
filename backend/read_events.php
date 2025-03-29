<?php
include 'db.php';

$stmt = $conn->prepare("SELECT * FROM events ORDER BY event_date ASC");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events);
?>
