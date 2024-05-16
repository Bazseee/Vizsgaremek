<?php
session_start();

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../user_pages/landing.php"); // Átirányítás a bejelentkezési oldalra, ha nincs bejelentkezve
    exit;
}

// Ellenőrizzük, hogy a felhasználó nincs-e kitiltva
if (isset($_SESSION['is_banned']) && $_SESSION['is_banned'] == 1) {
    header("Location: ../user_pages/banned.php"); // Átirányítás a kitiltott felhasználók oldalra
    exit;
}
?>