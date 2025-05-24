<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $event_id = $_POST['event_id'] ?? null;
    $file = $_FILES['file'] ?? null;
    $type = $_POST['type'] ?? null; // 'profile' or 'poster'

    if (!$file || !$type || (!$user_id && !$event_id)) {
        echo json_encode(['error' => 'Invalid parameters.']);
        exit;
    }

    $upload_dir = 'uploads/';
    $filename = basename($file['name']);
    $target_file = $upload_dir . uniqid() . '_' . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        if ($type === 'profile' && $user_id) {
            $stmt = $conn->prepare("UPDATE users SET profile_picture = ? WHERE id = ?");
            $stmt->execute([$target_file, $user_id]);
        } elseif ($type === 'poster' && $event_id) {
            $stmt = $conn->prepare("UPDATE events SET poster = ? WHERE id = ?");
            $stmt->execute([$target_file, $event_id]);
        } else {
            echo json_encode(['error' => 'Invalid type or missing ID.']);
            exit;
        }
        echo json_encode(['success' => true, 'path' => $target_file]);
    } else {
        echo json_encode(['error' => 'File upload failed.']);
    }
}
?>