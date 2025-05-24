<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'] ?? null;
    $user_id = $_POST['user_id'] ?? null;

    if (!$event_id || !$user_id) {
        echo json_encode(['error' => 'Invalid parameters.']);
        exit;
    }

    // Check if quota is available
    $stmt = $conn->prepare("SELECT capacity FROM events WHERE id = ?");
    $stmt->execute([$event_id]);
    $event = $stmt->fetch();

    if ($event && $event['capacity'] > 0) {
        // Register the user for the event
        $stmt = $conn->prepare("INSERT INTO event_registrations (event_id, user_id) VALUES (?, ?)");
        $stmt->execute([$event_id, $user_id]);

        // Decrement the capacity
        $stmt = $conn->prepare("UPDATE events SET capacity = capacity - 1 WHERE id = ?");
        $stmt->execute([$event_id]);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Event is full.']);
    }
}
?>