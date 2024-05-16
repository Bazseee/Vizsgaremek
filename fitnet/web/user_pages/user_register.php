<?php
// Database connection
include ("db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Initialize PHPMailer
$mail = new PHPMailer(true);

// Data from the form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_again = $_POST['passwordagain'];

// Check if username or email already exist in the database
$check_sql = "SELECT * FROM user WHERE username = ? OR email = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ss", $username, $email);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

// Check if the email address or username is already registered
$username_check_sql = "SELECT * FROM user WHERE username = ?";
$username_check_stmt = $conn->prepare($username_check_sql);
$username_check_stmt->bind_param("s", $username);
$username_check_stmt->execute();
$username_check_result = $username_check_stmt->get_result();

// Check if the email address is already registered
$email_check_sql = "SELECT * FROM user WHERE email = ?";
$email_check_stmt = $conn->prepare($email_check_sql);
$email_check_stmt->bind_param("s", $email);
$email_check_stmt->execute();
$email_check_result = $email_check_stmt->get_result();

// Settings for PHPMailer
$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = '26bc16ab4f996e';
$mail->Password = '593e8f762062f9';
$mail->SMTPSecure = 'tls';
$mail->CharSet = 'utf-8';

$mail->setFrom('noreply@fitnet.net', 'FitNet Robot'); // Sender email address and name
$mail->addAddress($email, $username); // Email address and username provided during registration

$mail->isHTML(true); // Email will be in HTML format

// Email subject and content
$mail->Subject = 'FitNet - Successful Registration';
$mail->Body = 'Dear <i><b>' . $username . '</b></i>, you have successfully registered on our website. Thank you for registering! If you have filled out the introduction page, the site will open up for full use.<br><br>Please do not reply to this message as it was sent by a bot!';

// Check for empty fields
if (strlen($password) < 8) {
    echo "<script>alert('Password is too short. Please use a longer password!'); window.location.href='../user_pages/landing.php';</script>";
} else {
    if ($password == "" || $username == "" || $email == "") {
        echo "<script>alert('All fields must be filled out.'); window.location.href='../user_pages/landing.php';</script>";
    } else {
        if ($password === $password_again) {
            if ($check_result->num_rows > 0) {
                // Username or email already exists
                echo "<script>alert('The provided username or email address is already registered.'); window.location.href='../user_pages/landing.php';</script>";
                exit();
            } else {
                if ($username_check_result->num_rows > 0) {
                    // Username already exists
                    echo "<script>alert('The provided username is already registered.'); window.location.href='../user_pages/landing.php';</script>";
                    exit();
                } elseif ($email_check_result->num_rows > 0) {
                    // Email address already exists
                    echo "<script>alert('The provided email address is already registered.'); window.location.href='../user_pages/landing.php';</script>";
                    exit();
                } else {
                    if ($mail->send()) {
                        // Hash the password
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        
                        // SQL query to insert the user into the database
                        $insert_sql = "INSERT INTO user (username, email, password_hash) VALUES (?, ?, ?)";
                        $insert_stmt = $conn->prepare($insert_sql);
                        $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

                        if ($insert_stmt->execute()) {
                            // Send email
                            session_start(); // Start or resume session
                            $_SESSION['loggedin'] = true;
                            $_SESSION['username'] = $username;
                            header("Location: ../user_pages/introducing.php");
                            exit();
                        } else {
                            echo "<script>alert('An error occurred during registration: " . $insert_stmt->error . "'); window.location.href='../user_pages/landing.php';</script>";
                        }

                        $insert_stmt->close();
                    } else {
                        echo "<script>alert('An error occurred while sending the email: " . $mail->ErrorInfo . "'); window.location.href='../user_pages/landing.php';</script>";
                    }
                }
            }
        } else {
            echo "<script src='../js/popup.js'></script>";
            echo "<script>alert('The two entered passwords do not match!'); window.location.href='../user_pages/landing.php'; openModal(modal);</script>";
        }
    }
}
$check_stmt->close();
$email_check_stmt->close();
$username_check_stmt->close();
$conn->close();
?>
