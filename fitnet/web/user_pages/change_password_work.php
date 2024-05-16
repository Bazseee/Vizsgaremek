<?php
session_start();

// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION['username'])) {
    // Ha nincs bejelentkezve, átirányítjuk a bejelentkezési oldalra vagy megjeleníthetünk egy hibaüzenetet
    header("Location: landing.php"); // Adjuk meg a bejelentkezési oldal elérési útját
    exit; // Kilépünk a scriptből, hogy ne fusson tovább, ha nem vagyunk bejelentkezve
}

// Adatbázis kapcsolat létrehozása
include ("db.php");

// Ellenőrizzük, hogy a form elküldésével került-e sor a jelszóváltoztatásra
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['get-new-password'])) {
    $current_password = $_POST['current-password']; // Aktuális jelszó
    $new_password = $_POST['new-password']; // Új jelszó
    $username = $_SESSION['username']; // Bejelentkezett felhasználóneve

    // Ellenőrizzük az aktuális jelszót az adatbázisban tárolttal
    $sql = "SELECT password_hash FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ha találunk felhasználót az adatbázisban
        $row = $result->fetch_assoc();
        $hashed_password = $row['password_hash'];

        // Ellenőrizzük az aktuális jelszó helyességét
        if (password_verify($current_password, $hashed_password)) {
            // Ha az aktuális jelszó helyes
            // Új jelszó hashelése
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Frissítjük az adatbázisban a jelszót
            $update_sql = "UPDATE user SET password_hash = '$new_hashed_password' WHERE username = '$username'";
            if ($conn->query($update_sql) === TRUE) {
                echo "
                <script>
                    window.onload = function() {
                        window.location.href = 'menu.php?page=settings.php';
                        alert('Password updated successfully.');
                    };
                </script>";
            } else {
                echo "
                <script>
                    window.onload = function() {
                        window.location.href = 'menu.php?page=settings.php';
                        alert('Error updating password: ' . $conn->error);
                    };
                </script>";
            }
        } else {
            // Ha az aktuális jelszó helytelen
            echo "
                <script>
                    window.onload = function() {
                        window.location.href = 'menu.php?page=settings.php';
                        alert('Current password is incorrect.');
                    };
                </script>";
        }
    } else {
        // Ha nem találunk felhasználót az adatbázisban
        echo "User not found!";
    }
}

// Adatbázis kapcsolat bezárása
$conn->close();
?>