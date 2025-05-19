<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Giriş yapılmamışsa login sayfasına yönlendir
    header("Location: login.html");
    exit;
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Event Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="event_form.html">Add Event</a></li>
            <li><a href="profile.html">Profile</a></li>
            <li><a href="register.html">New Account</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
    <!-- ...buraya mevcut HTML içeriğinizi ekleyin... -->
</body>
</html>