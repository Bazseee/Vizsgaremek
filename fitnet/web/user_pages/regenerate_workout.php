<?php
session_start();

include ("db.php");
include ("functions.php");

if (isset($_POST['regenerate'])) {

    $workouttime = $_POST['workouttime'];
    $username = $_SESSION['username'];

    $user_id_query = $conn->prepare("SELECT id FROM user WHERE username = ?");
    $user_id_query->bind_param("s", $username);
    $user_id_query->execute();
    $user_id_result = $user_id_query->get_result();

    if ($user_id_result->num_rows == 1) {
        $row = $user_id_result->fetch_assoc();
        $user_id = $row['id'];

        $update_query = $conn->prepare("UPDATE user_data SET desired_time = ? WHERE user_id = ?");
        $update_query->bind_param("ii", $workouttime, $user_id);
        $update_query->execute();

        $intention_query = $conn->prepare("SELECT intention FROM user_data WHERE user_id = ?");
        $intention_query->bind_param("i", $user_id);
        $intention_query->execute();
        $intention_result = $intention_query->get_result();

        if ($intention_result->num_rows == 1) {
            $row = $intention_result->fetch_assoc();
            $intention = $row['intention'];

            
            generateWorkouts($username, $intention, $workouttime);

            $delete_query = $conn->prepare("DELETE FROM workout_completed WHERE user_id = ?");
            $delete_query->bind_param("i", $user_id);
            $delete_query->execute();

            header("Location: ../user_pages/menu.php?page=dashboard");
            exit();
        }
    }
}

?>