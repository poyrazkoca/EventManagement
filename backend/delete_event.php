<?php
include 'db.php'; // Veritabanına bağlanma

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    if ($stmt->execute([$id])) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid";
}
?>
