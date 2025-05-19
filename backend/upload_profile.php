<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

$targetDir = __DIR__ . "/";
$filename = basename($_FILES["profileImage"]["name"]);
$targetFile = $targetDir . $filename;

if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFile)) {
    echo json_encode([
        "status" => "success",
        "imageUrl" => "../../../backend/uploads/" . $filename
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Upload failed."
    ]);
}
?>
