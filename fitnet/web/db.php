<?php
$servername = "localhost"; // A MySQL szerver neve
$username = "root"; // MySQL felhasználónév (alapértelmezett XAMPP beállítás)
$password = ""; // MySQL jelszó (alapértelmezett XAMPP beállítás)
$dbname = "mesterremek"; // Adatbázis neve

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Hiba a kapcsolódás közben: " . $conn->connect_error);
}
?>