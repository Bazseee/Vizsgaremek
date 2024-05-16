<?php
// Adatbázis kapcsolat létrehozása és beállítása (az $conn változó beállítása az adatbázis kapcsolatot jelenti)
include("db.php");

// Ellenőrizzük, hogy a topic_id értéke be lett-e állítva a GET kérésben
if (isset($_GET['topic_id'])) {
    // A topic_id értékének meghatározása és biztonságosan kezelése
    $topicId = mysqli_real_escape_string($conn, $_GET['topic_id']);

    // Kommentek törlése a megadott témához
    $deleteCommentsQuery = "DELETE FROM comments WHERE topic_id = $topicId";
    $deleteCommentsResult = mysqli_query($conn, $deleteCommentsQuery);

    // Téma törlése
    $deleteTopicQuery = "DELETE FROM topics WHERE id = $topicId";
    $deleteTopicResult = mysqli_query($conn, $deleteTopicQuery);

    // Ellenőrizzük, hogy a törlés sikeres volt-e
    if ($deleteCommentsResult && $deleteTopicResult) {
        // Sikeres törlés esetén visszaküldünk egy megerősítést
        echo "Topic and associated comments deleted successfully.";
    } else {
        // Ha valami hiba történt, akkor hibát küldünk vissza
        echo "Error: Unable to delete topic and associated comments.";
    }
} else {
    // Ha nem lett megadva topic_id, akkor hibát küldünk vissza
    echo "Error: No topic ID provided.";
}

// Adatbázis kapcsolat lezárása
mysqli_close($conn);
?>
