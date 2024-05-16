<?php
include("db.php");

// Ellenőrizzük, hogy az "announcementId" paraméter át van-e adva az URL-en
if (isset($_GET['announcementId'])) {
    $announcementId = $_GET['announcementId'];

    // Törlés a notifications táblából
    $delete_notification_query = "DELETE FROM notifications WHERE announcement_id = '$announcementId'";

    if ($conn->query($delete_notification_query) === TRUE) {
        // Sikeres törlés esetén folytatjuk az üzenet törlését az announcements táblából
        $delete_announcement_query = "DELETE FROM announcements WHERE id = '$announcementId'";

        if ($conn->query($delete_announcement_query) === TRUE) {
            // Sikeres törlés esetén JavaScript kód a felugró ablakhoz
            echo "
            <script>
                window.onload = function() {
                    window.location.href = 'admin.php?page=announcements';
                    alert('Announcement and related notifications deleted successfully.');
                };
            </script>";
        } else {
            echo "
            <script>
                window.onload = function() {
                    window.location.href = 'admin.php?page=announcements';
                    alert('Error deleting announcement: " . $conn->error . "');
                };
            </script>";
        }
    } else {
        echo "
        <script>
            window.onload = function() {
                window.location.href = 'admin.php?page=announcements';
                alert('Error deleting related notifications: " . $conn->error . "');
            };
        </script>";
    }
} else {
    echo "Unknown id or wrong.";
}

$conn->close();
?>
