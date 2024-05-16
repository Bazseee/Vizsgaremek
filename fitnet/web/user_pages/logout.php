<?php
session_start();
session_unset();
session_destroy();
header("Location: ../user_pages/landing.php"); // Átirányítjuk a felhasználót a bejelentkezési oldalra.
exit;
?>