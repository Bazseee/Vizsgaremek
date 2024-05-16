<?php
include("db.php");

// Keresési kifejezés lekérdezése
$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// Felhasználók lekérdezése az adatbázisból a keresési kifejezés alapján
$sql = "SELECT username, avatar FROM user WHERE username LIKE '%$search_term%'";
$result = $conn->query($sql);

// Keresési eredmények formázása asszociatív tömb formátumba
$search_results = array();
while ($row = $result->fetch_assoc()) {
    $search_results[] = $row;
}

// JSON kimenet küldése
echo json_encode($search_results);

// Adatbázis kapcsolat bezárása
$conn->close();
?>