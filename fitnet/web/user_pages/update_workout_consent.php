<?php
// Adatbázis kapcsolat beállítása (példa)
include ("db.php");

// Ellenőrizzük, hogy a kérés POST metódussal érkezett-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
    session_start();
    if (!isset($_SESSION['username'])) {
        http_response_code(403); // Forbidden
        echo "Forbidden";
        exit();
    }

    // Felhasználó azonosító lekérése felhasználónév alapján
    $username = $_SESSION['username'];
    $sql = "SELECT id, workout_consent FROM user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Felhasználó adatainak ellenőrzése
        $row = $result->fetch_assoc();
        $userId = $row["id"];
        $workoutConsent = $row["workout_consent"];

        // Ellenőrizzük, hogy a workout_consent értéke 0 vagy 1
        if ($workoutConsent == 1) {
            http_response_code(400); // Bad request
            echo "Workout consent is already accepted";
            exit();
        }

        // Frissítjük a workout_consent értékét 1-re az adatbázisban
        $sql_update = "UPDATE user SET workout_consent = 1 WHERE id = $userId";
        if ($conn->query($sql_update) === TRUE) {
            http_response_code(200); // OK
            echo "Workout consent updated successfully";
        } else {
            http_response_code(500); // Internal server error
            echo "Error updating workout consent: " . $conn->error;
        }
    } else {
        http_response_code(404); // Not found
        echo "User not found";
    }
} else {
    http_response_code(405); // Method not allowed
    echo "Method not allowed";
}

// Adatbázis kapcsolat bezárása
$conn->close();
?>