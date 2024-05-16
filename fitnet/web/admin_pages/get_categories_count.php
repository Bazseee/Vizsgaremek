<?php
include("db.php");

// Adatok lekérdezése a workout_category táblából
$sqlCount = "SELECT COUNT(*) as count FROM workout_categories";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$categoryCount = $rowCount['count'];

// Visszaküldjük a kategóriák számát JSON formátumban
echo json_encode(array('categoryCount' => $categoryCount));

// Adatbázis kapcsolat lezárása
$conn->close();
?>
