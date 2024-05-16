<?php
session_start();

include("db.php");

$username = $_SESSION['username'];
$sql = "SELECT generated_workout FROM user WHERE username = '$username'";
$result = $conn->query($sql);

// JSON adatok elkészítése
$workoutData = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $workoutData = json_decode($row['generated_workout'], true);
}

// JSON adatok küldése
header('Content-Type: application/json');
echo json_encode($workoutData);

$conn->close();
?>
