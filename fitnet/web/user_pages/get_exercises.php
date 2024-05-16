<?php
session_start();
// Adatbázis csatlakozás
include ("db.php");

// Ellenőrzés, hogy van-e bejelentkezett felhasználó
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // A bejelentkezett felhasználó neve

    // Lekérdezés a generált edzésért a felhasználó alapján
    $sql = "SELECT generated_workout FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Ellenőrzés, hogy van-e találat
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $json_data = $row['generated_workout'];

        // Kapott adatok JSON dekódolása
        $data = json_decode($json_data, true);

        // Ellenőrzés, hogy a GET paraméterben van-e dátum, amit átadtak
        if (isset($_GET['date'])) {
            $date = $_GET['date']; // A kapott dátum

            // Ellenőrzés, hogy a kapott dátum megtalálható-e az adatok között
            foreach ($data as $week => $week_data) {
                if (isset($week_data[$date])) {
                    // Ha megtaláltuk a megfelelő dátumot, csak az azonosítókat küldjük vissza az upper_body halmazból
                    $upper_body_ids = isset($week_data[$date]['upper_body']) ? array_values($week_data[$date]['upper_body']) : [];
                    $lower_body_ids = isset($week_data[$date]['lower_body']) ? array_values($week_data[$date]['lower_body']) : [];
                    $response = [
                        'upper_body' => $upper_body_ids,
                        'lower_body' => $lower_body_ids
                    ];
                    echo json_encode($response);
                    exit(); // Kilépünk a ciklusból, ha megtaláltuk a dátumot
                }
            }
            // Ha a dátum nincs megtalálva a JSON adatban, akkor hibát jelzünk
            echo json_encode(array("error" => "Date not found"));
        } else {
            // Ha nincs dátum paraméter átadva, akkor hibát jelzünk
            echo json_encode(array("error" => "Date parameter not provided"));
        }
    } else {
        echo json_encode(array("error" => "User not found in database"));
    }
} else {
    // Ha nincs bejelentkezett felhasználó, akkor hibát jelzünk
    echo json_encode(array("error" => "User not logged in"));
}

// Adatbázis kapcsolat bezárása
mysqli_close($conn);
?>