<?php
include("db.php");

// Ellenőrizzük, hogy a "id" paraméter át van-e adva az URL-en
if (isset($_GET['id'])) {
    $exercise_id = $_GET['id'];

    // Kép nevének lekérdezése
    $image_query = "SELECT imageOfExercise FROM workout_exercises WHERE id = $exercise_id";
    $image_result = $conn->query($image_query);

    if ($image_result->num_rows > 0) {
        $row = $image_result->fetch_assoc();
        $imageFileName = $row['imageOfExercise'];

        // Kép törlése a fájlszerverről
        $imageFilePath = '../uploads/exercises/' . $imageFileName;
        if (file_exists($imageFilePath)) {
            unlink($imageFilePath);
        }
    }

    // Törlés a feladatok táblából
    $delete_query = "DELETE FROM workout_exercises WHERE id = $exercise_id";

    if ($conn->query($delete_query) === TRUE) {
        // Sikeres törlés esetén JavaScript kód a felugró ablakhoz
        echo "
        <script>
            window.onload = function() {
                window.location.href = 'admin.php?page=exercise_delete';
                alert('Exercise deleted successfully.');
            };
        </script>";
    } else {
        echo "
        <script>
            window.onload = function() {
                window.location.href = 'admin.php?page=exercise_delete';
                alert('Error deleting exercise: " . $conn->error . "');
            };
        </script>";
    }
} else {
    echo "Hibás vagy hiányzó azonosító.";
}

$conn->close();
?>