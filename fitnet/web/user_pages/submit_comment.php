<?php
include("db.php");

if (isset($_POST['topic_id']) && isset($_POST['username']) && isset($_POST['comment']) 
    && !empty($_POST['topic_id']) && !empty($_POST['username']) && !empty($_POST['comment'])) {
    $topic_id = $_POST['topic_id'];
    $username = $_POST['username'];
    $comment = $_POST['comment'];

    $check_query = "SELECT * FROM topics WHERE id = $topic_id";
    $check_result = mysqli_query($conn, $check_query);
    if(mysqli_num_rows($check_result) > 0) {
        $insert_query = "INSERT INTO comments (topic_id, username, comment) VALUES ($topic_id, '$username', '$comment')";
        mysqli_query($conn, $insert_query);
    }
}

mysqli_close($conn);
?>
