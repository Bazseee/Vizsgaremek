<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Dashboard</title>
    <style>
        /* Add your styling for the card here */
        .card-container {
            display: flex;
            flex-wrap: wrap;
        }

        .exercise-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .exercise-card:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
        }

        /* Add styling for the week card */
        .week-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: auto;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .week-card:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
        }

        .day-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: auto;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .day-card:hover {
            background-color: #f8f9fa;
            transform: scale(1.05);
        }

        .rest-day {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        .rest-day:hover {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            /* A legfelső rétegben jelenik meg */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;

        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 800px;
            max-height: 650px;
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            overflow-y: auto;
            border-radius: 15px;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        /* Modal Header */
        .modal-header {
            padding: 10px 20px;
        }

        .modal-header .close {
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Modal Body */
        .modal-body {
            padding: 20px;
        }

        /* Modal Footer */
        .modal-footer {
            padding: 10px 20px;
            background-color: #f5f5f5;
            border-top: 1px solid #ddd;
            text-align: center;
            border-radius: 0px 0px 15px 15px;
        }

        .modal-btn {
            padding: 10px 20px;
            margin: 0 5px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<script>
    let exerciseIndex = 0;
    let exercises = [];

    function fetchWeeksAndDays() {
        // JSON adatok letöltése és feldolgozása
        fetch('fetch_week_data.php')
            .then(response => response.json())
            .then(data => {
                const weeksContainer = document.getElementById('weeks');
                const daysContainer = document.getElementById('days');
                let currentWeek = null;

                Object.keys(data).forEach(week => {
                    const weekButton = document.createElement('button');
                    weekButton.textContent = week;
                    weekButton.classList.add('week-card');
                    weekButton.addEventListener('click', () => {
                        if (currentWeek !== week) {
                            currentWeek = week;
                            displayDays(data[week]);
                        } else {
                            daysContainer.innerHTML = '';
                            currentWeek = null;
                        }
                    });
                    weeksContainer.appendChild(weekButton);
                });

            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });

        function displayDays(days) {
            const daysContainer = document.getElementById('days');
            daysContainer.innerHTML = ''; // Clear previous days

            // AJAX kéréssel lekérjük az adatbázisból, hogy melyik dátum befejezett
            fetch('get_completed_dates.php')
                .then(response => response.json())
                .then(completedDates => {
                    Object.keys(days).forEach(date => {
                        const dayButton = document.createElement('button');
                        dayButton.setAttribute("id", "id" + date);
                        dayButton.textContent = days[date] === "Rest day" ? `${date} (Rest day)` : date;
                        dayButton.classList.add('day-card');

                        // Ellenőrizzük, hogy a dátum befejezett-e, és ha igen, akkor zöldre színezzük a gombot
                        if (completedDates.includes(date)) {
                            dayButton.style.backgroundColor = '#28a745';
                            dayButton.style.color = 'white';
                        }

                        if (days[date] === "Rest day") {
                            dayButton.classList.add('rest-day');
                            dayButton.disabled = true;
                        } else {
                            dayButton.addEventListener('click', () => {
                                currentDisplayedDate = date;
                                fetchExercises({ date: date }); // Módosítás: A dátumot objektumként adjuk át
                                exerciseIndex = 0;
                            });
                        }
                        daysContainer.appendChild(dayButton);
                    });
                })
                .catch(error => {
                    console.error('Error fetching completed dates:', error);
                });
        }
    }

    function fetchExercises(data) {
        const date = data.date;
        fetch('get_exercises.php?date=' + date)
            .then(response => response.json())
            .then(data => {
                exercises = [];
                const upperBodyIds = data.upper_body ? Object.values(data.upper_body) : [];
                const lowerBodyIds = data.lower_body ? Object.values(data.lower_body) : [];

                // Lekérjük az upper_body és lower_body gyakorlatokat az azonosítók alapján az adatbázisból
                Promise.all([
                    fetchExercisesByIds(upperBodyIds),
                    fetchExercisesByIds(lowerBodyIds)
                ]).then(([upperBodyExercises, lowerBodyExercises]) => {
                    // Szűrjük ki a null és undefined értékeket, amelyek azok a gyakorlatok, amelyek már törölve lettek vagy nem érhetők el
                    upperBodyExercises = upperBodyExercises.filter(exercise => exercise !== null && exercise !== undefined);
                    lowerBodyExercises = lowerBodyExercises.filter(exercise => exercise !== null && exercise !== undefined);

                    exercises = exercises.concat(upperBodyExercises, lowerBodyExercises);
                    showExercise(exerciseIndex);
                    document.getElementById('myModal').style.display = "block";
                }).catch(error => {
                    console.error('Error fetching exercises data:', error);
                });
            })
            .catch(error => {
                console.error('Error fetching exercises data:', error);
            });
    }

    // Segédfüggvény az adatbázisból gyakorlatok lekéréséhez az azonosítók alapján
    function fetchExercisesByIds(exerciseIds) {
        return Promise.all(
            exerciseIds.map(id => fetch(`get_exercise_details.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    // Ellenőrizzük, hogy a visszakapott adat érvényes-e
                    if (data && Object.keys(data).length !== 0) {
                        return data;
                    } else {
                        // Ha a feladat nem elérhető, visszaadjuk az üres értéket
                        return null;
                    }
                })
                .catch(error => {
                    console.error('Error fetching exercise details:', error);
                    // Ha hiba történik, visszaadjuk az üres értéket
                    return null;
                })
            )
        );
    }


    function showExercise(index) {
        const exerciseDetails = document.getElementById("exerciseDetails");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        if (exercises.length === 0 || index < 0 || index >= exercises.length) {
            exerciseDetails.textContent = "No exercises available!";
            prevBtn.disabled = true; // Previous gomb letiltása
            nextBtn.disabled = true; // Next gomb letiltása
            prevBtn.style.backgroundColor = "#ccc"; // Previous gomb háttérszíne szürke
            nextBtn.style.backgroundColor = "#ccc"; // Next gomb háttérszíne szürke
        } else {
            const exercise = exercises[index];
            let contentHTML = '<div>';

            // Cím megjelenítése, ha nem undefined
            if (exercise.nameOfExercise !== undefined) {
                contentHTML += `<h3 style="text-align: center; font-size: 2rem;">${exercise.nameOfExercise}</h3>`;
            }

            // Leírás megjelenítése, ha nem undefined
            if (exercise.shortdescriptionOfExercise !== undefined) {
                contentHTML += `<p style="text-align: center; font-size: 1.5rem;">${exercise.shortdescriptionOfExercise}</p>`;
            }

            // Kép megjelenítése, ha nem undefined
            if (exercise.imageOfExercise !== undefined) {
                contentHTML += `<img src="../uploads/exercises/${exercise.imageOfExercise}" alt="${exercise.nameOfExercise}" style="margin: auto;">`;
            }

            contentHTML += '</div>';
            exerciseDetails.innerHTML = contentHTML;

            prevBtn.disabled = false; // Previous gomb engedélyezése
            nextBtn.disabled = false; // Next gomb engedélyezése
            prevBtn.style.backgroundColor = "#007bff"; // Previous gomb alapértelmezett háttérszíne
            nextBtn.style.backgroundColor = "#007bff"; // Next gomb alapértelmezett háttérszíne
        }
    }



    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            alert("Are you sure you want to finish the exercise? Your progress won't be saved!")
            closeModal();
        } else if (event.key === 'ArrowLeft') {
            prevExercise();
        } else if (event.key === 'ArrowRight') {
            nextExercise();
        }
    });

    function closeModal() {
        document.getElementById('myModal').style.display = "none";
        const nextBtn = document.getElementById("nextBtn");
        nextBtn.textContent = "Next"; // End gomb visszaváltása Next-re
        nextBtn.style.backgroundColor = "#007bff"; // Háttérszín visszaváltása eredetire
    }

    function prevExercise() {
        if (exerciseIndex > 0) {
            exerciseIndex--;
            showExercise(exerciseIndex);
        }
    }

    function saveCompletedWorkout() {
        // Az adatok mentése az adatbázisba
        const currentDate = currentDisplayedDate;

        // AJAX kéréssel küldjük el az adatokat a szerverre
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_completed_workout.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Sikeres mentés esetén változtasd meg a dátum gomb színét zöldre
                const dayButton = document.getElementById('id' + currentDate);
                if (dayButton) {
                    dayButton.style.backgroundColor = '#28a745';
                    dayButton.style.color = 'white';
                }
            } else {
                console.error('Error saving workout:', xhr.responseText);
            }
        };
        xhr.onerror = function () {
            console.error('Error saving workout: Network error');
        };
        xhr.send(`date=${currentDate}`);
    }

    function nextExercise() {
        if (exerciseIndex < exercises.length - 1) {
            exerciseIndex++;
            showExercise(exerciseIndex);
            if (exerciseIndex === exercises.length - 1) {
                const nextBtn = document.getElementById("nextBtn");
                nextBtn.textContent = "End workout";
                nextBtn.style.backgroundColor = "#28a745";
                saveCompletedWorkout(); // Mentés az adatbázisba
            }
        } else {
            closeModal();
            alert("Congratulations! You've completed the exercise routine.");
        }
    }

    function acceptConsent() {
        // AJAX kéréssel küldjük el a módosítást a szerverre
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_workout_consent.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Sikeres módosítás esetén frissítjük az oldalt vagy végrehajtjuk a szükséges tevékenységeket
                location.reload(); // Például oldal frissítése
            } else {
                console.error('Error updating workout consent:', xhr.responseText);
            }
        };
        xhr.onerror = function () {
            console.error('Error updating workout consent: Network error');
        };
        xhr.send(); // Itt a megfelelő adatokat is küldheted, például a felhasználó azonosítóját
    }
</script>

<body>

    <h1 class="text-xl mb-3">Exercise Dashboard</h1>
    <h2 class="text-l mb-3">Welcome!
        On this page, you can see the task sequences that have been individually compiled for you, broken down into
        weeks and days.</h2>
    <?php
    include ("db.php");
    $username = $_SESSION['username'];

    $sql_user_id = "SELECT id FROM user WHERE username = '$username'";
    $result_user_id = $conn->query($sql_user_id);

    if ($result_user_id->num_rows > 0) {
        // Adatok kiolvasása
        $row_user_id = $result_user_id->fetch_assoc();
        $user_id = $row_user_id["id"];

        // Felhasználóhoz tartozó workout_consent oszlop értékének lekérdezése az adatbázisból
        $sql_workout_consent = "SELECT workout_consent FROM user WHERE id = $user_id";
        $result_workout_consent = $conn->query($sql_workout_consent);

        if ($result_workout_consent->num_rows > 0) {
            // Adatok kiolvasása
            $row_workout_consent = $result_workout_consent->fetch_assoc();
            $workout_consent = $row_workout_consent["workout_consent"];

            // Ha a workout_consent értéke 0, akkor megjelenítjük az "Attention" feliratot és a consent gombot
            if ($workout_consent == 0) {
                echo '<div style="margin: auto; width: 400px; height: 300px; background-color: #f9f4f4; padding: 15px; border-radius: 10px; margin-top: 10px; text-align: center;">';
                echo '<h1 class="text-3xl mb-5" style="color: red">!Attention!</h1>';
                echo '<h2 class="text-xl">The tasks must be performed with such a weight that the user can train with and reach their limits. We are not responsible for incorrect execution of the training.</h2>';
                echo '<button onclick="acceptConsent();" class="mt-5 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600">I consent!</button>';
                echo '</div>';
            } else {
                echo "<script>fetchWeeksAndDays();</script>";
            }
        }
    }
    ?>
    <div id="weeks"></div>
    <div id="days"></div>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close"
                    onclick="alert('Are you sure you want to end the workout? Your progress will not be saved.'); closeModal()">&times;</span>
            </div>
            <div class="modal-body" id="exerciseDetails"></div>
            <div class="modal-footer">
                <button id="prevBtn" class="modal-btn" onclick="prevExercise()">Previous</button>
                <button id="nextBtn" class="modal-btn" onclick="nextExercise()">Next</button>
            </div>
        </div>

    </div>

</body>

</html>