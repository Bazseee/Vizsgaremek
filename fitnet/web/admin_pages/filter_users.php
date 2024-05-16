<?php
include("db.php");

$whereClause = "";

// Check if the search form is submitted
if (isset($_GET['username']) && !empty($_GET['username'])) {
    $username = $_GET['username'];
    $whereClause = " WHERE username LIKE '%$username%'";
}

$sql_select_users = "SELECT id, username, avatar, email, is_banned, permission, reg_time FROM user" . $whereClause;
$result_users = $conn->query($sql_select_users);

if ($result_users->num_rows > 0) {
    while ($user = $result_users->fetch_assoc()) {
        if ($user['avatar'] == "") {
            $default = "fitnet.png";
            $avatarPath = '../uploads/defaults/' . $default;
        } else {
            $avatarPath = '../uploads/' . $user['avatar']; // Kép elérési útának beállítása
        }

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