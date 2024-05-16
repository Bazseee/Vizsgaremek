<?php
session_start();
// Adatbázis kapcsolódás
include("db.php");

// Ellenőrizze, hogy a POST kérés elküldte-e az adatokat
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username']; // Az éppen bejelentkezett felhasználó neve

        // Felhasználó ID-jének lekérdezése az adatbázisból
        $query = "SELECT id FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['id'];

            if(isset($_POST['anonymus']) && $_POST['anonymus'] =='anonymus')
                $user_id = 0;
            $title = $_POST['title'];
            $description = $_POST['description'];

            // Ellenőrizze, hogy az adott címmel már létezik-e topic az adatbázisban
            $query = "SELECT * FROM topics WHERE title = '$title'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 0) {
                // Ha nem létezik, akkor hozzáadjuk az új témát az adatbázishoz
                $query = "INSERT INTO topics (user_id, title, content) VALUES ('$user_id', '$title', '$description')";
                if (mysqli_query($conn, $query)) {
                    // Sikeresen létrehoztuk a topicot, üzenetet jelenítünk meg a forum.php oldalon
                    header("Location: menu.php?page=forum");
                } else {
                    header("Location: menu.php?page=forum");
                }
            } else {
                // Ha már létezik ilyen címmel topic
                header("Location: menu.php?page=forum");
            }
        } else {
            // Ha nem található a felhasználó az adatbázisban
            echo "User not found in database!";
        }
    } else {
        // Ha a felhasználó nincs bejelentkezve
        echo "User is not logged in!";
    }
}

// Adatbázis kapcsolat bezárása
mysqli_close($conn);
?>
