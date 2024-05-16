<?php
// Adatbázis kapcsolódás
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "mesterremek";

        $conn = new mysqli($servername, $username, $password, $database);

        // Kapcsolat ellenőrzése
        if ($conn->connect_error) {
            die("Kapcsolódási hiba: " . $conn->connect_error);
        }

?>