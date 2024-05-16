<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Announcements</title>
    <style>
        textarea {
            width: 100%;
            display: block
        }
    </style>
</head>

<body>
    <h1 class="text-xl">Send announcement</h1>
    <br>
    <form action="upload_announcements_work.php" method="post">
        <input type="text" name="announcementName" id="announcementName" placeholder="Name of announcement"
            style="border: 1px solid black; border-radius: 5px; padding: 2px;" required>
        <br>
        <br>
        <textarea name="announcementInput" id="announcementInput" cols="30" rows="5"
            style="border: 1px solid black; border-radius: 5px; padding: 2px; max-width: 900px; display: block;"
            placeholder="Please input the announcement text" required></textarea>
        <br>
        <input type="datetime-local" name="announcementDate" id="announcementDate" step="1"
            style="border: 1px solid black; border-radius: 5px; padding: 2px;" required><br><br>
        <input type="submit" value="Send announcement" class="button">
    </form>
    <br>
    <h1 class='text-xl'>Delete announcement</h1>
    <br>



    <?php
    include ("db.php");

    $sql = "SELECT id, announcementsText, announcementName, date FROM announcements";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<form action='delete_announcements_work.php' method='get'>";
            echo "<input type='hidden' name='announcementId' value='" . $row['id'] . "'>";
            echo "<div style='background-color: #f9f4f4; padding: 15px; border-radius: 10px; margin-top: 10px;'>";
            echo "<h2 style='text-align: center;'>Announcement: " . $row['announcementName'] . "<h2>";
            echo "<h2 style='text-align: center;'>Date: " . $row['date'] . "</h2>";
            echo "<div style='text-align: center; color: red; ' class='text-xl'>" . $row['announcementsText'] . "</div>";
            echo "<input type='submit' value='Delete announcement' class='button'>";
            echo "</div>";
            echo "</form>";
        }
    } else {
        echo "<p>There is no announcement to delete.</p>";
    }

    ?>

</body>

</html>