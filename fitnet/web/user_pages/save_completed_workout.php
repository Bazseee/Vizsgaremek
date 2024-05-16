<?php
session_start();
// Kapcsolódás az adatbázishoz
include ("db.php");

// Adatok fogadása a POST kéréstől
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $date = $_POST['date'];

    // Felhasználó azonosítójának lekérése a username alapján
    $user_query = "SELECT id FROM user WHERE username = '$username'";
    $user_result = $conn->query($user_query);
    if ($user_result->num_rows > 0) {
        $row = $user_result->fetch_assoc();
        $userId = $row['id'];

        // Ellenőrizzük, hogy az adott felhasználóhoz már hozzá lett-e rendelve ez a dátum
        $check_duplicate_query = "SELECT * FROM workout_completed WHERE user_id = '$userId' AND completion_date = '$date'";
        $duplicate_result = $conn->query($check_duplicate_query);
        if ($duplicate_result->num_rows == 0) {
            // Ha nincs duplikátum, akkor elmentjük az adatokat
            $sql = "INSERT INTO workout_completed (user_id, completion_date) VALUES ('$userId', '$date')";
            if ($conn->query($sql) === TRUE) {
                echo "Workout saved successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: This workout date is already saved for the user";
        }
    } else {
        echo "Error: User not found";
    }
}

// Adatbázis kapcsolat bezárása
$conn->close();
?>