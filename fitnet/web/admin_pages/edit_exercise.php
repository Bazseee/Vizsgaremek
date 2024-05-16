<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .addButton,
        .deleteButton {
            color: red;
            font-size: 2rem;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    include ("db.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Edit'])) {
        // Az űrlapot elküldték, de még nem frissítették az adatokat
        $exercise_id = $_POST['id'];

        $sql = "SELECT * FROM workout_exercises WHERE id = $exercise_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Szerkesztő űrlap megjelenítése
            echo "<h1 class='text-xl mb-3'>Edit Exercise</h1>";
            echo "<form action='' method='POST' enctype='multipart/form-data'>"; // enctype hozzáadása a fájl feltöltéshez
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";

            // Új form mezők megjelenítése
            echo "<label for='nameOfExercise'>Name of exercise: </label>";
            echo "<input type='text' name='nameOfExercise' id='nameOfExercise' value='" . $row['nameOfExercise'] . "' required style='border: 1px solid black; border-radius: 5px; padding: 2px; width: 400px;'><br><br>";

            echo "<label for='descriptionOfExercise'>Description of exercise: </label>";
            echo "<input type='text' name='descriptionOfExercise' id='descriptionOfExercise' value='" . $row['descriptionOfExercise'] . "' required style='border: 1px solid black; border-radius: 5px; padding: 2px; width: 400px;'><br><br>";

            echo "<label for='shortdescriptionOfExercise'>Short description of exercise: </label>";
            echo "<input type='text' name='shortdescriptionOfExercise' id='shortdescriptionOfExercise' value='" . $row['shortdescriptionOfExercise'] . "' required style='border: 1px solid black; border-radius: 5px; padding: 2px; width: 400px;'><br><br>";

            // Category selection
            echo "<div class='category-container'>";
            echo "<label for='workout_category'>Category of the workout:</label>";
            $sql_category = "SELECT id, categories FROM workout_categories";
            $result_category = $conn->query($sql_category);
            echo "<select name='category[]' class='category' id='category'>";
            if ($result_category->num_rows > 0) {
                while ($row_category = $result_category->fetch_assoc()) {
                    echo "<option value='" . $row_category['id'] . "'>" . $row_category['categories'] . "</option>";
                }
            } else {
                echo "<option value='0'>No categories available</option>";
            }
            echo "</select>";
            echo "<button type='button' class='addButton' onclick='addSelect(\"category\")'>+</button>";
            echo "</div><br>";

            // Body part selection
            echo "<div class='body_part'>";
            echo "<label for='workout_body_part'>Body part of the workout:</label>";
            $sql_body_part = "SELECT id, body_parts FROM workout_body_parts";
            $result_body_part = $conn->query($sql_body_part);
            echo "<select name='body_parts[]' class='body_parts' id='body_parts'>";
            if ($result_body_part->num_rows > 0) {
                while ($row_body_part = $result_body_part->fetch_assoc()) {
                    echo "<option value='" . $row_body_part['id'] . "'>" . $row_body_part['body_parts'] . "</option>";
                }
            } else {
                echo "<option value='0'>No body parts available</option>";
            }
            echo "</select>";
            echo "</div><br>";

            echo "<label for='exercisePicture'>Picture of exercise: </label>";
            echo "<input type='file' name='exercisePicture' id='exercisePicture' accept='image/*'><br>"; // required eltávolítva, mivel opcionális lehet a kép módosítása
    
            echo "<input class='button' type='submit' value='Update' name='Update'>";
            echo "</form>";
        } else {
            echo "<p>Exercise not found.</p>";
        }
    } else {
        // If no exercise is selected for editing, display selection menu
        $sql = "SELECT id, nameOfExercise, imageOfExercise FROM workout_exercises";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h1 class='text-xl mb-3'>Edit Exercise</h1>";
            echo "<form action='' method='POST'>";
            echo "<label for='exercise_id'>Select Exercise to Edit:</label>";
            echo "<select id='exercise_id' name='id' required onchange='updateImage()' style='border-bottom: 1px solid #ccc;'>";

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "' data-image='" . $row['imageOfExercise'] . "'>" . $row['nameOfExercise'] . "</option>";
            }

            echo "</select>";
            echo "<div id='exerciseImageContainer' style='margin-top: 20px;'></div>";

            // JavaScript function to update image when exercise is selected
            echo "<script>
            function updateImage() {
                var select = document.getElementById('exercise_id');
                var selectedOption = select.options[select.selectedIndex];
                var imageContainer = document.getElementById('exerciseImageContainer');

                var imageElement = document.createElement('img');
                imageElement.src = '../uploads/exercises/' + selectedOption.getAttribute('data-image');
                imageElement.alt = 'Exercise Image';
                imageElement.style.verticalAlign = 'middle';
                imageElement.style.marginLeft = '10px';

                imageContainer.innerHTML = '';
                imageContainer.appendChild(imageElement);
            }
        </script>";
            echo "<script>updateImage();</script>";
            echo "<input class='button' type='submit' value='Edit' name='Edit'>";
            echo "</form>";
        } else {
            echo "<h1 class='text-xl mb-3'>Edit Exercise</h1>";
            echo "<p>There is no exercise that could be edited.</p>";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Update'])) {
        // Szükséges adatok lekérdezése a POST változókból
        $exercise_id = $_POST['id'];
        $nameOfExercise = $_POST['nameOfExercise'];
        $descriptionOfExercise = $_POST['descriptionOfExercise'];
        $shortdescriptionOfExercise = $_POST['shortdescriptionOfExercise'];
        $categories = $_POST['category'];
        $bodyPartId = $_POST['body_parts'][0]; // Csak az első body part-ot vesszük figyelembe
    
        // SQL lekérdezés az adatok frissítéséhez
        $update_sql = "UPDATE workout_exercises SET 
                    nameOfExercise = '$nameOfExercise',
                    descriptionOfExercise = '$descriptionOfExercise', 
                    shortdescriptionOfExercise = '$shortdescriptionOfExercise',
                    body_part_id = '$bodyPartId' 
                    WHERE id = $exercise_id";

        if ($conn->query($update_sql) === TRUE) {
            // Fájl feltöltése csak akkor, ha új képet választottak ki
            if ($_FILES['exercisePicture']['error'] == UPLOAD_ERR_OK) {
                $img_name = $_FILES['exercisePicture']['name'];
                $img_size = $_FILES['exercisePicture']['size'];
                $tmp_name = $_FILES['exercisePicture']['tmp_name'];
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png", "gif");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    // Kép útvonalának meghatározása
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../uploads/exercises/' . $new_img_name;

                    // Új kép feltöltése
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // SQL frissítés a kép nevével
                    $update_img_sql = "UPDATE workout_exercises SET imageOfExercise = '$new_img_name' WHERE id = $exercise_id";
                    $conn->query($update_img_sql);
                } else {
                    $em = "You can't upload files of this type";
                    echo "
                        <script>
                            window.onload = function() {
                                window.location.href = 'admin.php?page=exercise_edit&id=$exercise_id&error=$em';
                                alert('You can't upload files of this type.');
                            };
                        </script>";
                    exit();
                }
            }


            echo "
                <script>
                    window.onload = function() {
                        window.location.href = 'admin.php?page=exercise_edit&id=$exercise_id';
                        alert('Exercise updated successfully.');
                    };
                </script>";
        } else {
            $em = "Failed updating exercise: " . $conn->error;
            echo "
                <script>
                    window.onload = function() {
                        window.location.href = 'admin.php?page=exercise_edit&id=$exercise_id&error=$em';
                        alert('Error updating exercise: $em');
                    };
                </script>";
        }
    }

    $conn->close();
    ?>
</body>
<script>
    // Tárolja a már kiválasztott lehetőségeket
    var selectedOptions = [];

    // JavaScript függvények a további select elemek hozzáadásához
    function addSelect(className) {
        var selectNodeList = document.querySelectorAll('.' + className);
        var lastSelect = selectNodeList[selectNodeList.length - 1];

        // AJAX hívás a kategóriák számának lekérésére
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var responseData = JSON.parse(xhr.responseText);
                var categoryCount = responseData.categoryCount;

                // Ellenőrizzük, hogy még van-e elérhető kategória
                if (selectNodeList.length < categoryCount) {
                    // Klonozzuk a select elemet
                    var selectClone = lastSelect.cloneNode(true);

                    // Kiválasztott lehetőségek eltárolása
                    selectedOptions.push(lastSelect.value);

                    // Frissítjük a kiválasztható lehetőségeket
                    updateOptions(selectClone);

                    // Az új select elemhez hozzáadjuk a törlési gombot csak egyszer
                    if (selectNodeList.length === 1) {
                        var deleteButton = createDeleteButton(selectClone);
                        lastSelect.parentNode.appendChild(deleteButton);
                    }

                    // Hozzáadjuk az új klónt a DOM-hoz
                    lastSelect.parentNode.insertBefore(selectClone, lastSelect.nextSibling);

                    // Mozgatjuk a + gombot az új menü mögé
                    lastSelect.parentNode.appendChild(document.querySelector('.addButton'));

                    // Frissítjük a törlési gomb láthatóságát
                    updateDeleteButton();
                } else {
                    alert('You have selected the maximum amount of categories or you have selected every category!');
                }
            }
        };
        xhr.open('GET', 'get_categories_count.php', true);
        xhr.send();
    }

    // A már kiválasztott lehetőségek eltárolása és eltávolítása az új menüből
    function updateOptions(newSelect) {
        for (var i = 0; i < selectedOptions.length; i++) {
            var optionToRemove = newSelect.querySelector('option[value="' + selectedOptions[i] + '"]');
            if (optionToRemove) {
                optionToRemove.remove();
            }
        }
    }

    // Dinamikusan létrehozott törlési gomb
    function createDeleteButton(selectElem) {
        var deleteButton = document.createElement('button');
        deleteButton.className = 'deleteButton';
        deleteButton.textContent = '-';
        deleteButton.onclick = function () {
            var parentDiv = selectElem.parentNode;
            parentDiv.removeChild(selectElem);
            parentDiv.removeChild(deleteButton);
            updateDeleteButton();
            // Töröljük az eltávolított értéket a selectedOptions tömbből
            var selectedIndex = selectedOptions.indexOf(selectElem.value);
            if (selectedIndex !== -1) {
                selectedOptions.splice(selectedIndex, 1);
            }
        };
        return deleteButton;
    }

    // Frissíti a törlési gombot az alapértelmezettnek megfelelően
    function updateDeleteButton() {
        var selectNodeList = document.querySelectorAll('.category');
        var deleteButton = document.querySelector('.deleteButton');

        if (selectNodeList.length > 1 && !deleteButton) {
            deleteButton = createDeleteButton(selectNodeList[selectNodeList.length - 1]);
            deleteButton.style.display = 'inline-block';
            selectNodeList[selectNodeList.length - 1].parentNode.appendChild(deleteButton);
        } else if (selectNodeList.length <= 1 && deleteButton) {
            deleteButton.parentNode.removeChild(deleteButton);
        }
    }
</script>

</html>