<?php
session_start();
include ("db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
    if (!isset($_SESSION['username'])) {
        http_response_code(403); // Hozzáférés megtagadva
        exit("Unauthorized access");
    }

    // Felhasználónév lekérése a munkamenetből
    $username = $_SESSION['username'];

    // Felhasználó azonosítójának lekérése a username alapján
    $user_query = "SELECT id FROM user WHERE username = '$username'";
    $user_result = $conn->query($user_query);
    if ($user_result->num_rows > 0) {
        $row = $user_result->fetch_assoc();
        $userId = $row['id'];

        // SQL lekérdezés előkészítése és végrehajtása a workout_completed táblából
        $completed_dates_query = "SELECT completion_date FROM workout_completed WHERE user_id = '$userId'";
        $completed_dates_result = $conn->query($completed_dates_query);
        $completed_dates = [];

        // Az eredményből kiolvassuk a befejezett dátumokat
        if ($completed_dates_result->num_rows > 0) {
            while ($row = $completed_dates_result->fetch_assoc()) {
                $completed_dates[] = $row['completion_date'];
            }
        }

        // Visszaadjuk a befejezett dátumokat JSON formátumban
        header('Content-Type: application/json');
        echo json_encode($completed_dates);
    } else {
        http_response_code(404); // Nem található a felhasználó
        exit("User not found");
    }
} else {
    http_response_code(405); // Nem engedélyezett kérési módszer
    exit("Method Not Allowed");
}
?>