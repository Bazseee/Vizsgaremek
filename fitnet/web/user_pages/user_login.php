<?php
session_start();

// Ellenőrizzük, hogy a felhasználó már be van-e jelentkezve
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Ha be van jelentkezve, ellenőrizzük a first_register értékét
    if ($_SESSION['first_register'] == 1) {
        // Ha a first_register értéke 1, azaz még nem töltötte ki az introducing.php-t
        header("Location: ../user_pages/introducing.php");
        exit;
    } else {
        // Ha a first_register értéke 0, azaz már kitöltötte az introducing.php-t
        header("Location: ../user_pages/menu.php");
        exit;
    }
}

// Ellenőrizzük, hogy a bejelentkezési űrlap elküldése megtörtént-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Az ellenőrzéshez használt adatbázis kapcsolódás
    include ("db.php");

    // Űrlapból érkező adatok
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ellenőrzés az adatbázisban
    $sql = "SELECT id, username, email, password_hash, is_banned, first_register FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if ($row['is_banned'] == 1) {
                // A felhasználó kitiltva van, így ne engedjük bejelentkezni
                echo "<script>window.location.href='../user_pages/banned.php';</script>";
                exit;
            }

            // Sikeres bejelentkezés
            if (password_verify($password, $row['password_hash'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['first_register'] = $row['first_register']; // first_register értékét elmentjük a session-be
                // Ellenőrizzük, hogy az új felhasználó
                if ($_SESSION['first_register'] == 1) {
                    // Ha az új felhasználó, akkor az introducing.php-ra irányítjuk
                    header("Location: ../user_pages/introducing.php");
                    exit;
                } else {
                    // Ha nem új felhasználó, akkor a menu.php-ra irányítjuk
                    header("Location: ../user_pages/menu.php");
                    exit;
                }
            } else {
                echo "<script>alert('Password is incorrect.'); window.location.href='../user_pages/landing.php';</script>";
            }
        } else {
            echo "<script>alert('This user does not exist.'); window.location.href='../user_pages/landing.php';</script>";
        }
    } else {
        echo "There was an error logging in: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>