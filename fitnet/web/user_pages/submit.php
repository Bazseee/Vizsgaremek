<?php
include ("db.php");

session_start();
$username = $_SESSION['username'];

$surname = $_POST['surname'];
$firstname = $_POST['firstname'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender']; // Módosított sor
$intention = $_POST['intention']; // Módosított sor
$workouttime = $_POST['workouttime'];

// Kód a gender és intention értékek beállításához
$gender_value = "";
switch ($gender) {
    case "Man":
        $gender_value = 0;
        break;
    case "Women":
        $gender_value = 1;
        break;
    case "Etc":
        $gender_value = 2;
        break;
    default:
        $gender_value = 2; // Alapértelmezett érték
}

$intention_value = "";
switch ($intention) {
    case "bulking":
        $intention_value = 0;
        break;
    case "cutting":
        $intention_value = 1;
        break;
    case "weight maintenance":
        $intention_value = 2;
        break;
    default:
        $intention_value = 0; // Alapértelmezett érték
}

// Felhasználó azonosítása a user táblából
$user_query = "SELECT id FROM user WHERE username = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("s", $username);
$user_stmt->execute();
$user_result = $user_stmt->get_result();
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['id'];

$user_stmt->close();

// Felhasználó adatainak beszúrása a user_data táblába
$insert_query = "INSERT INTO user_data (user_id, surname, firstname, weight, height, address, gender, birthday, phone, intention, desired_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_query);
$insert_stmt->bind_param("issiisissii", $user_id, $surname, $firstname, $weight, $height, $address, $gender_value, $birthday, $phone, $intention_value, $workouttime);

if ($insert_stmt->execute()) {
    // Sikeres beszúrás esetén átirányítás
    $update_query = "UPDATE user SET first_register = 0 WHERE username = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("s", $username);
    $update_stmt->execute();
    $update_stmt->close();

    include("functions.php");
    // Edzésterv generálása
    generateWorkouts($username, $intention, $workouttime);

    header("Location: ../user_pages/menu.php");
    exit();
} else {
    // Hiba esetén visszatérés az előző oldalra
    echo "<script>alert('There was an error inserting the data: " . $insert_stmt->error . "'); window.location.href='../user_pages/introducing.php';</script>";
}

?>