<?php
include("db.php");

$whereClause = "";

// Check if the search form is submitted
if (isset($_GET['exercisename']) && !empty($_GET['exercisename'])) {
    $exercisename = $_GET['exercisename'];
    $whereClause = " WHERE exercisename LIKE '%$exercisename%'";
}

$sql_select_exercises = "SELECT id, nameOfExercise, descriptionOfExercise, shortdescriptionOfExercise, imageOfExercise, body_part_id FROM workout_exercises" . $whereClause;
$result_exercises = $conn->query($sql_select_exercises);

if ($result_exercises->num_rows > 0) {
    while ($exercise = $result_exercises->fetch_assoc()) {
        echo "<div style='text-align: center;' class='user-card' data-username='" . $user['username'] . "'>
                <img src='" . $avatarPath . "' alt='Avatar'>
                <h3 class='text-xl mt-2'>" . $user['username'] . "</h3>
                <p class='mt-2'>" . "Email: " . $user['email'] . "</p>
                <p class='mt-2'>" . "Registration: " . $user['reg_time'] . "</p>
                <button class='button' onclick='editUser(\"" . $user['username'] . "\", \"" . $user['email'] . "\")'>Edit user data</button>
                <button class='button bg-red' onclick='toggleBan(\"" . $user['username'] . "\", \"" . $user['is_banned'] . "\")'>" . ($user['is_banned'] == 1 ? 'Unban' : 'Ban') . "</button>
                <br>
                <br>
                <div id='editForm-" . $user['username'] . "' style='display:none;'>
                    <form id='editUserForm-" . $user['username'] . "' onsubmit='saveUser(\"" . $user['username'] . "\", event)'>
                        <label for='editUsername'>Username:</label>
                        <input type='text' id='editUsername-" . $user['username'] . "' value='" . $user['username'] . "' required style='border-bottom: 1px solid #ccc;'>
                        <label for='editEmail'>Email:</label>
                        <input type='email' id='editEmail-" . $user['username'] . "' value='" . $user['email'] . "' required style='border-bottom: 1px solid #ccc;'>
                        <label for='editPermission'>Permission:</label>
                        <input type='number' id='editPermission-" . $user['username'] . "' value='" . $user['permission'] . "' required style='border-bottom: 1px solid #ccc;' min='0' max='2'>
                        <br>
                        <br>
                        <button type='submit' class='button bg-blue'>Save</button>
                        <button type='button' class='button bg-blue' onclick=\"resetUser('{$user['username']}')\">Back</button>
                    </form>
                </div>
              </div>";
    }
} else {
    echo "No users found.";
}

$conn->close();
?>

