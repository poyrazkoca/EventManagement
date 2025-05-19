<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    // Opsiyonel alanlar
    $age_limit = $_POST['age_limit'] ?? '';
    $capacity = $_POST['capacity'] ?? '';
    $dress_code = $_POST['dress_code'] ?? '';
    $rules = $_POST['rules'] ?? '';
    $event_type = $_POST['event_type'] ?? '';
    $organizer = $_POST['organizer'] ?? '';

    // Yeni eklenen iletişim & bilet bilgileri
    $contact_instagram = $_POST['contact_instagram'] ?? '';
    $contact_email = $_POST['contact_email'] ?? '';
    $contact_phone = $_POST['contact_phone'] ?? '';
    $ticket_location = $_POST['ticket_location'] ?? '';

    $stmt = $conn->prepare("INSERT INTO events (
        user_id, title, description, event_date, location,
        age_limit, capacity, dress_code, rules, event_type, organizer,
        contact_instagram, contact_email, contact_phone, ticket_location
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt->execute([
        $user_id, $title, $description, $event_date, $location,
        $age_limit, $capacity, $dress_code, $rules, $event_type, $organizer,
        $contact_instagram, $contact_email, $contact_phone, $ticket_location
    ])) {
        echo "Event created successfully!";
    } else {
        echo "Error creating event.";
    }
}
?>
