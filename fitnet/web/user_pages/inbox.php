<?php

// Adatbáziskapcsolat
include ("db.php");

// Ellenőrizzük, hogy a felhasználó átkattintott-e az üzenetre
if (isset($_GET['id'])) {
    // Ha átkattintott, akkor lekérjük az üzenet azonosítóját
    $announcementId = $_GET['id'];

    // Frissítjük az üzenet státuszát "read"-re az adatbázisban
    $update_status_query = "UPDATE notifications SET status = 'read' WHERE announcement_id = $announcementId";
    mysqli_query($conn, $update_status_query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Inbox</title>
</head>

<body>

    <h1 class="text-xl mb-3">Inbox</h1>
    <h2 class="text-l mb-3">On this page, you can see if you receive any notification regarding FitNet.</h2>

    <?php

    // Fogadott üzenetek lekérdezése az adatbázisból
    $sql = "SELECT id, announcementName, announcementsText, date FROM announcements";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div>";
        echo "<h1 class='text-xl'>Announcements:</h1>";
        while ($row = $result->fetch_assoc()) {
            echo "<div style='background-color: #f9f4f4; padding: 15px; border-radius: 10px; margin-top: 10px; text-align: center;'>";
            echo "<h2 style='text-align: center;'>Announcement: " . $row['announcementName'] . "<h2>";
            echo "<h2 style='text-align: center;'>Date: " . $row['date'] . "</h2>";
            echo "<div style='text-align: center; color: red; ' class='text-xl'>" . $row['announcementsText'] . " </div></div>";
        }
        echo "</div>"; // Fő div lezárása
    } else {
        echo "There are no announcements currently.";
    }

    $conn->close();
    ?>

</body>

</html>