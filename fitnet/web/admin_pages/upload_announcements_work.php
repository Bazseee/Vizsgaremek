<?php
session_start();
include("db.php");

$announcementsText = $_POST['announcementInput'];
$announcementName = $_POST['announcementName'];
$announcementDate = $_POST['announcementDate'];
$username = $_SESSION['username'];

$sql = "INSERT INTO announcements (announcementName, announcementsText, date) VALUES ('$announcementName', '$announcementsText', '$announcementDate')";

if (mysqli_query($conn, $sql)) {
    // Az announcement sikeresen beszúródott, most hozzáadjuk a notification-t is
    $announcement_id = mysqli_insert_id($conn); // Az utoljára beszúrt bejegyzés azonosítója
    $users_sql = "SELECT id FROM user WHERE username = '$username'";
    $users_result = mysqli_query($conn, $users_sql);

    while ($row = mysqli_fetch_assoc($users_result)) {
        $user_id = $row['id'];
        $notification_sql = "INSERT INTO notifications (announcement_id, user_id) VALUES ('$announcement_id', '$user_id')";
        mysqli_query($conn, $notification_sql);
    }

    echo "<script>
            window.onload = function() {
                window.location.href = 'admin.php?page=announcements';
                alert('Announcement sent successfully.');
            };
          </script>";
} else {
    echo "<script>
            window.onload = function() {
                window.location.href = 'admin.php?page=announcements';
                alert('Something went wrong. Please try again later!');
            };
          </script>";
}
?>
