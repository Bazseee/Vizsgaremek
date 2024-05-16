<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Exercises</title>
</head>

<body>

    <h1 class="text-xl mb-3">Delete Exercise</h1>

    <?php
    include("db.php");

    $sql = "SELECT id, nameOfExercise, imageOfExercise FROM workout_exercises";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form action='delete_exercise_work.php' method='GET'>";
        echo "<label for='exercise_id'>Select Exercise to Delete:</label>";
        echo "<select id='exercise_id' name='id' style='border-bottom: 1px solid #ccc;' onchange='updateImage()'>";

        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['id'] . "' data-image='" . $row['imageOfExercise'] . "'>" . $row['nameOfExercise'] . "</option>";
        }
        echo "</select>";
        echo "<div id='exerciseImageContainer' style='margin-top: 20px;'></div>";
        echo "<script>
        function updateImage() {
            var select = document.getElementById('exercise_id');
            var selectedOption = select.options[select.selectedIndex];
            var imageContainer = document.getElementById('exerciseImageContainer');
    
            // Létrehozzuk az img elemet és hozzáadjuk a képet
            var imageElement = document.createElement('img');
            imageElement.src = '../uploads/exercises/' + selectedOption.getAttribute('data-image');
            imageElement.alt = 'Exercise Image';
            imageElement.style.verticalAlign = 'middle';
            imageElement.style.marginLeft = '10px';
    
            // Kitöröljük a div tartalmát, majd hozzáadjuk az új képet
            imageContainer.innerHTML = '';
            imageContainer.appendChild(imageElement);
        }
    </script>";
        echo "<script>updateImage();</script>";
        echo "<input class='button' type='submit' value='Delete' name='Delete'>";
        echo "</form>";

    } else {
        echo "<p>There is no exercise that could be deleted.</p>";
    }

    $conn->close();
    ?>

</body>

</html>