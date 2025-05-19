<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("UPDATE events SET
        event_type = ?, 
        organizer = ?, 
        title = ?, 
        description = ?, 
        event_date = ?, 
        location = ?, 
        age_limit = ?, 
        capacity = ?, 
        dress_code = ?, 
        rules = ?, 
        contact_instagram = ?, 
        contact_email = ?, 
        contact_phone = ?, 
        ticket_location = ?
        WHERE id = ?
    ");

    $success = $stmt->execute([
        $_POST['event_type'],
        $_POST['organizer'],
        $_POST['title'],
        $_POST['description'],
        $_POST['event_date'],
        $_POST['location'],
        $_POST['age_limit'],
        $_POST['capacity'],
        $_POST['dress_code'],
        $_POST['rules'],
        $_POST['contact_instagram'],
        $_POST['contact_email'],
        $_POST['contact_phone'],
        $_POST['ticket_location'],
        $id
    ]);

    if ($success) {
        echo "Event updated successfully!";
    } else {
        echo "Update failed.";
    }
} else {
    echo "Invalid request.";
}
?>
