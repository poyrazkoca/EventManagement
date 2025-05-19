<?php
header('Content-Type: application/json');

// Veritabanı bağlantısı
$conn = new mysqli("localhost", "root", "", "event_management");

if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Tüm alanları seçiyoruz
$sql = "SELECT * FROM events ORDER BY event_date DESC";
$result = $conn->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
$conn->close();
?>
