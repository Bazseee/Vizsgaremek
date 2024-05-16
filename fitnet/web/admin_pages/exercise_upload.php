<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise upload</title>
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
    <h1 class="text-xl mb-3">Exercise upload</h1>

    <form action="exercise_upload_work.php" method="post" enctype="multipart/form-data">

        <label for="nameOfExercise">Name of exercise:</label>
        <input type="text" name="nameOfExercise" id="nameOfExercise" required
            style="border: 1px solid black; border-radius: 5px; padding: 2px; width: 400px;"><br>
        <br>

        <label for="descriptionOfExercise">Description of exercise:</label>
        <input type="text" name="descriptionOfExercise" id="descriptionOfExercise" rows="4" required
            style="border: 1px solid black; border-radius: 5px; padding: 2px; width: 400px;"></textarea><br>
        <br>

        <label for="shortdescriptionOfExercise">Short description of exercise:</label>
        <input type="text" name="shortdescriptionOfExercise" id="shortdescriptionOfExercise" rows="4" required
            style="border: 1px solid black; border-radius: 5px; padding: 2px; width: 400px;"></textarea><br>
        <br>

        <div class="category-container">
            <label for="workout_category">Category of the workout:</label>
            <?php
            include("db.php");
            // Adatok lekérdezése a workout_category táblából
            $sql = "SELECT id, categories FROM workout_categories";
            $result = $conn->query($sql);

            // Első select elem létrehozása
            echo '<select name="category[]" class="category" id="category">';

            // Adatok feldolgozása és beillesztése az első select elembe
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $categoryName = $row['categories'];
                    echo '<option value="' . $id . '">' . $categoryName . '</option>';
                }
            } else {
                echo '<option value="0">Nincs elérhető kategória</option>';
            }

            echo '</select>';

            // Maximum kategóriák számának beállítása
            echo '<input type="hidden" id="maxCategories" value="' . ($result->num_rows - 1) . '">';

            // Gomb a további kategóriák hozzáadásához
            echo '<button type="button" class="addButton" onclick="addSelect(\'category\')">+</button>';

            // Adatbázis kapcsolat lezárása
            $conn->close();
            ?>
        </div>

        <div class="body_part">
            <label for="workout_body_part">Body part of the workout:</label>
            <?php
            include("db.php");
            // Adatok lekérdezése a workout_category táblából
            $sql = "SELECT id, body_parts FROM workout_body_parts";
            $result = $conn->query($sql);

            // Első select elem létrehozása
            echo '<select name="body_parts[]" class="body_parts" id="body_parts">';

            // Adatok feldolgozása és beillesztése az első select elembe
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $bodypartName = $row['body_parts'];
                    echo '<option value="' . $id . '">' . $bodypartName . '</option>';
                }
            } else {
                echo '<option value="0">Nincs elérhető kategória</option>';
            }

            echo '</select>';
            // Adatbázis kapcsolat lezárása
            $conn->close();
            ?>
        </div>
        <br>

        <label for="exercisePicture">Picture of exercise:</label>
        <input type="file" name="exercisePicture" id="exercisePicture" accept="image/*" required><br>

        <input class="button" type="submit" value="Upload" name="upload">
    </form>

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

</body>

</html>