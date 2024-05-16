<?php
// Adatbázis kapcsolódás
include("db.php");

// Gyakorlat részleteinek lekérése az azonosító alapján
$id = $_GET['id']; // Azonosító, amelyet a JavaScript küldött át

$sql = "SELECT nameOfExercise, shortdescriptionOfExercise, imageOfExercise FROM workout_exercises WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // A gyakorlat részleteinek formázott kimenete JSON formátumban
    $row = $result->fetch_assoc();
    $exerciseDetails = array(
        'nameOfExercise' => $row['nameOfExercise'],
        'shortdescriptionOfExercise' => $row['shortdescriptionOfExercise'],
        'imageOfExercise' => $row['imageOfExercise']
    );
    echo json_encode($exerciseDetails);
} else {
    // Ha nem található gyakorlat az adatbázisban, üres objektummal térünk vissza JSON formátumban
    echo json_encode((object) []);
}

$conn->close();
?>
