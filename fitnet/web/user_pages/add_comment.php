<?php
session_start(); // A session használatának megkezdése
include ("db.php");

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if (isset($_POST['topic_id']) && isset($_POST['comment'])) {
        $topicId = $_POST['topic_id'];
        $comment = $_POST['comment'];
        // Felhasználó ID lekérdezése a felhasználónév alapján
        $user_query = "SELECT id FROM user WHERE username = '$username'";
        $user_result = mysqli_query($conn, $user_query);

        if ($user_row = mysqli_fetch_assoc($user_result)) {
            $userId = $user_row['id'];

            // Komment hozzáadása az adatbázishoz
            $insert_query = "INSERT INTO comments (user_id, topic_id, content, created_at) VALUES ('$userId', '$topicId', '$comment', NOW())";
            if (mysqli_query($conn, $insert_query)) {
                // Sikeres komment hozzáadás
                $comment_id = mysqli_insert_id($conn); // Utolsó beszúrt komment ID-je
                $created_at = date('Y-m-d H:i:s');
                echo "<div class='userComment' style='box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.3);'><p><span>Sender: </span><strong>$username</strong> <span style='float: right;'>$created_at</span><br><span>Message: </span>$comment <button style='float:right' class='bg-red-600 text-white px-2 rounded-md hover:bg-white hover:text-red-600' onclick='deleteComment(" . $comment_id . ")'>Delete comment</button></p></div>";
            } else {
                // Sikertelen komment hozzáadás
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        } else {
            // Felhasználó nem található
            echo "Error: User not found";
        }
    } else {
        // Hiányzó paraméterek esetén hibaüzenet
        echo "Error: Missing parameters";
    }
} else {
    // Felhasználó nincs bejelentkezve
    echo "Error: User is not logged in";
}

mysqli_close($conn);
?>