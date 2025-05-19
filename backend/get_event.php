<?php
include 'db.php'; // Veritabanı bağlantısı

// id parametresi kontrolü
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Etkinliği veritabanından çek
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->execute([$id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    $event['event_date'] = date('Y-m-d', strtotime($event['event_date']));


    // Sonucu JSON olarak döndür
    echo json_encode($event);
} else {
    echo json_encode(['error' => 'ID not provided']);
}
?>