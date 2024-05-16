<?php
// Adatbázis kapcsolat létrehozása
include("db.php");

// Ellenőrizzük, hogy a comment_id érték át lett-e adva a GET kérésben
if (isset($_GET['comment_id'])) {
    // Törlési művelet végrehajtása a kommentek táblában
    $comment_id = $_GET['comment_id'];
    $delete_query = "DELETE FROM comments WHERE id = $comment_id";
    $result = mysqli_query($conn, $delete_query);

    // Ellenőrizzük, hogy a törlés sikeres volt-e
    if ($result) {
        // Sikeres törlés esetén visszatérünk egy üzenettel
        echo "
            <script>
                window.onload = function() {
                    window.location.href = 'admin.php?page=topics_and_comments';
                    alert('Comment deleted successfully.');
                };
            </script>";
    } else {
        // Sikertelen törlés esetén visszatérünk egy hibaüzenettel
        echo "<script>alert('Error deleting comment:')</script> " . mysqli_error($conn);
    }
} else {
    // Ha nincs comment_id a GET kérésben, akkor visszatérünk egy hibaüzenettel
    echo "Comment ID not provided.";
}

// Adatbázis kapcsolat bezárása
mysqli_close($conn);
?>
