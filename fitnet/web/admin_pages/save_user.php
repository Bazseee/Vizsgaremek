<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $editedUsername = $_POST["username"];
    $editedEmail = $_POST["email"];
    $editedPermission = $_POST['permission'];

    include('db.php');

    $user_id = $_SESSION["user_id"];
    // Update the user table with the new username and email
    $sql_update_user = "UPDATE user SET username = '$editedUsername', email = '$editedEmail', permission = '$editedPermission' WHERE id = '$user_id'";
    
    if ($conn->query($sql_update_user) === true) {
        $_SESSION['username'] = $editedUsername;
        $_SESSION['email'] = $editedEmail;
        $_SESSION['permission'] = $editedPermission;
        echo "User data saved successfully!";
    } else {
        echo "Error updating user data: " . $conn->error;
    }

    $conn->close();
} else {
    // Handle invalid request method
    http_response_code(405);
    echo "Invalid request method";
}
?>