<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['upload'])) {
    // Adatbázis kapcsolat
    include("db.php");

    // Feltöltött fájl kezelése
    $img_name = $_FILES['exercisePicture']['name'];
    $img_size = $_FILES['exercisePicture']['size'];
    $tmp_name = $_FILES['exercisePicture']['tmp_name'];
    $error = $_FILES['exercisePicture']['error'];

    if ($error === 0) {
        if ($img_size > 5000000) {
            $em = "Sorry, your file is too large.";
            header("Location: admin.php?error=$em");
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png", "gif");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = '../uploads/exercises/' . $new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Szükséges adatok lekérdezése a POST változókból
                $nameOfExercise = $_POST['nameOfExercise'];
                $descriptionOfExercise = $_POST['descriptionOfExercise'];
                $shortdescriptionOfExercise = $_POST['shortdescriptionOfExercise'];
                $categories = implode(", ", $_POST['category']);
                $bodyPartId = $_POST['body_parts'][0]; // Csak az első body part-ot vesszük figyelembe

                // SQL lekérdezés az adatok beszúrásához
                $sql = "INSERT INTO workout_exercises (nameOfExercise, descriptionOfExercise, shortdescriptionOfExercise, imageOfExercise, body_part_id) 
                VALUES ('$nameOfExercise', '$descriptionOfExercise', '$shortdescriptionOfExercise', '$new_img_name', '$bodyPartId')";

                if ($conn->query($sql) === TRUE) {
                    // Lekérdezzük az utolsó beszúrt id-t (workout_id)
                    $lastInsertedId = $conn->insert_id;

                    // Szúrd be az adatokat az exercise_category táblába
                    $categoryIds = $_POST['category'];

                    foreach ($categoryIds as $categoryId) {
                        $categoryInsertQuery = "INSERT INTO exercise_category (workout_id, category_id) VALUES ('$lastInsertedId', '$categoryId')";
                        $conn->query($categoryInsertQuery);
                    }

                    $_SESSION['exercisePicture'] = $new_img_name;
                    echo "
                        <script>
                            window.onload = function() {
                                window.location.href = 'admin.php?page=exercise_upload';
                                alert('Exercise uploaded successfully.');
                            };
                        </script>";
                } else {
                    $em = "Failed saving into database: " . $conn->error;
                    echo "
                        <script>
                            window.onload = function() {
                                window.location.href = 'admin.php?page=exercise_upload?error=$em';
                                alert('Exercise upload error.');
                            };
                        </script>";
                }
            } else {
                $em = "You can't upload files of this type";
                echo "
                    <script>
                        window.onload = function() {
                            window.location.href = 'admin.php?page=exercise_upload?error=$em';
                            alert('You can't upload files of this type.');
                        };
                    </script>";
            }
        }
    } else {
        $em = "Unknown error happened!";
        echo "
            <script>
                window.onload = function() {
                    window.location.href = 'admin.php?page=exercise_upload?error=$em';
                    alert('Unknown error happened.');
                };
            </script>";
    }

    $conn->close();
} else {
    header("Location: admin.php");
}
?>