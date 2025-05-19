<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Boş alan kontrolü
    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    }

    // TEDU mail kontrolü
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@tedu\.edu\.tr$/", $email)) {
        echo "Only TEDU email addresses are allowed.";
        exit;
    }

    // Kullanıcıyı bul
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Giriş başarılı
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "Login successful";
        // Yönlendirme frontend tarafından yapılacaksa sadece mesaj döndürün
        // Eğer PHP ile yönlendirme isterseniz:
        // header("Location: ../public/html/index.html");
        // exit;
    } else {
        echo "Invalid email or password.";
    }
}
?>