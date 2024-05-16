<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usersname = $_POST['username'];
    $isBanned = $_POST['isBanned'];

    // Az adatbázis kapcsolódás
    include('db.php');

    // Az adatbázisban a felhasználó kitiltásának/feloldásának frissítése
    $stmt = $conn->prepare("UPDATE user SET is_banned = ? WHERE username = ?");
    $newBanStatus = ($isBanned == 1) ? 0 : 1;
    $stmt->bind_param("is", $newBanStatus, $usersname);
    $stmt->execute();
    $stmt->close();

    $conn->close();

} else {
    header("Location: ../admin_pages/admin.php");
    exit;
}
?>
