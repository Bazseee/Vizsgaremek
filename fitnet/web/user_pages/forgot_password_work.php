<?php
session_start();

// Database connection
include ("db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Initialize PHPMailer
$mail = new PHPMailer(true);

if (isset($_POST['submit'])) {
    $email_or_username = $_POST['email_or_username'];

    // Check if the provided email address or username exists in the database
    $query = "SELECT * FROM user WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Identify the user
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
        $user_email = $user['email'];

        // Generate a new password
        $new_password = generateRandomPassword();

        // Update the password in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE user SET password_hash = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("si", $hashed_password, $user_id);
        $update_stmt->execute();

        // Send an email with the new password
        try {
            // Email settings
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '26bc16ab4f996e';
            $mail->Password = '593e8f762062f9';
            $mail->SMTPSecure = 'tls';
            $mail->CharSet = 'utf-8';

            $mail->setFrom('noreply@fitnet.net', 'FitNet Robot');
            $mail->addAddress($user_email, $user['username']);

            $mail->isHTML(true);
            $mail->Subject = 'FitNet - Forgot password';
            $mail->Body = 'Dear ' . $user['username'] . ',<br><br>Your password has been successfully updated. Your new password is: <strong>' . $new_password . '</strong><br><br>If you did not request a new password, please contact us!';

            $mail->send();
            echo "<script>alert('The new password has been sent to your email address.'); window.location.href='../user_pages/landing.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('An error occurred while sending the email: {$mail->ErrorInfo}'); window.location.href='../user_pages/forgot_password.php';</script>";
        }
    } else {
        echo "<script>alert('There is no registered user with the provided email address or username.'); window.location.href='../user_pages/forgot_password.php';</script>";
    }
}

function generateRandomPassword($length = 12)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}
?>