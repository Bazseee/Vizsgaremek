<?php
session_start();

if (isset($_FILES['avatar']) && isset($_POST['upload'])) {
    include("db.php");

    $img_name = $_FILES['avatar']['name'];
    $img_size = $_FILES['avatar']['size'];
    $tmp_name = $_FILES['avatar']['tmp_name'];
    $error = $_FILES['avatar']['error'];

    $user = $_SESSION['username'];

    if ($error === 0) {
        if ($img_size > 400000) {
            $em = "Sorry, your file is too large.";
            header("Location: menu.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../uploads/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Módosított rész: az adatbázisba történő beszúrás
                $sql = "UPDATE user SET avatar = '$new_img_name' WHERE username = '$user'";
                if (mysqli_query($conn, $sql)) {
                    // Sikeres feltöltés esetén azonnal megjelenítjük a felhasználó saját profilképét
                    $_SESSION['avatar'] = $new_img_name;
                    header("Location: menu.php");
                } else {
                    $em = "Hiba az adatbázisba való mentés során: " . mysqli_error($conn);
                    header("Location: menu.php?error=$em");
                }
            } else {
                $em = "You can't upload files of this type";
                header("Location: menu.php?error=$em");
            }
        }
    } else {
        $em = "Ismeretlen hiba történt!";
        header("Location: menu.php?error=$em");
    }
} else {
    header("Location: menu.php");
}
?>