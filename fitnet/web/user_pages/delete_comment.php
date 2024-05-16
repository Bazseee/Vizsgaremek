<?php
session_start();
include("db.php");

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    if (isset($_GET['comment_id'])) {
        $comment_id = $_GET['comment_id'];

        // Ellenőrizzük, hogy a komment létezik és a felhasználóé-e
        $check_query = "SELECT * FROM comments WHERE id = $comment_id AND user_id = (SELECT id FROM user WHERE username = '$username')";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            // A kommentet töröljük az adatbázisból
            $delete_query = "DELETE FROM comments WHERE id = $comment_id";
            if (mysqli_query($conn, $delete_query)) {
                echo "Comment deleted successfully";
            } else {
                echo "Error deleting comment: " . mysqli_error($conn);
            }
        } else {
            echo "Error: Comment not found or you don't have permission to delete it";
        }
    } else {
        echo "Error: Missing comment_id parameter";
    }
} else {
    echo "Error: User is not logged in";
}

mysqli_close($conn);
?>
