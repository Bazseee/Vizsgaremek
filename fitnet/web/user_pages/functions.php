<?php
function generateWorkouts($username, $intention, $workouttime)
{
    global $conn;

    // Feladatsorok tárolása hetek és napok szerint
    $workouts = array();

    // Feladatsorok létrehozása a megadott időtartamra
    $restDayCounter = 0; // Pihenőnapok számlálója
    for ($j = 0; $j < $workouttime; $j++) {
        // Aktuális hét kezdő dátuma
        $weekStart = strtotime("+$j week");

        // Feladatsorok tárolása a héten belül
        $weekWorkouts = array();

        for ($i = 0; $i < 7; $i++) { // 7 napos időszakra generálunk feladatsorokat
            // Ellenőrizzük, hogy az első hétben az első nap ne legyen pihenő
            if ($j == 0 && $i == 0) {
                continue;
            }

            // Ellenőrizzük, hogy 3 naponta pihenőnapot kell-e beiktatni
            if ($i != 0 && $i % 3 == 0) {
                $restDayCounter++;
                $date = date('Y-m-d', strtotime("+$i day", $weekStart));
                // Pihenőnap hozzáadása
                $weekWorkouts[$date] = "Rest day";
                continue;
            }

            // Dátum kiszámítása
            $date = date('Y-m-d', strtotime("+$i day", $weekStart));

            // SQL lekérdezés az upper body gyakorlatokhoz

            // SQL lekérdezés az upper body gyakorlatokhoz a felhasználó intention-je alapján
            $upperBodyQuery = "SELECT we.id FROM workout_exercises AS we
                            INNER JOIN exercise_category AS ec ON we.id = ec.workout_id
                            WHERE ec.category_id-1 = '$intention'
                            ORDER BY RAND() LIMIT 7"; // Véletlenszerűen választunk 7 gyakorlatot

            $upperBodyResult = $conn->query($upperBodyQuery);

            // SQL lekérdezés a lower body gyakorlatokhoz a felhasználó intention-je alapján
            $lowerBodyQuery = "SELECT we.id FROM workout_exercises AS we
                            INNER JOIN exercise_category AS ec ON we.id = ec.workout_id
                            WHERE ec.category_id-1 = '$intention'
                            ORDER BY RAND() LIMIT 5"; // Véletlenszerűen választunk 5 gyakorlatot

            $lowerBodyResult = $conn->query($lowerBodyQuery);


            // Ellenőrizzük, hogy a lekérdezések eredményt adtak-e
            if ($upperBodyResult && $lowerBodyResult) {
                $newUpperBodyExercises = array();
                while ($upperRow = $upperBodyResult->fetch_assoc()) {
                    $newUpperBodyExercises[] = $upperRow["id"];
                }

                $newLowerBodyExercises = array();
                while ($lowerRow = $lowerBodyResult->fetch_assoc()) {
                    $newLowerBodyExercises[] = $lowerRow["id"];
                }

                // A generált feladatsor összeállítása
                $dayWorkout = array(
                    'upper_body' => $newUpperBodyExercises,
                    'lower_body' => $newLowerBodyExercises
                );

                // A generált feladatsort hozzáadjuk a heti feladatsorokhoz
                $weekWorkouts[$date] = $dayWorkout;
            }
        }

        // A heti feladatsorokat hozzáadjuk a teljes feladatsorokhoz
        $workouts["Week " . ($j + 1)] = $weekWorkouts;
    }

    // A generált feladatsorokat eltároljuk az adatbázisban
    $generatedWorkout = json_encode($workouts);

    $updateQuery = "UPDATE `user` SET `generated_workout` = ? WHERE `username` = ?";
    $update_stmt = $conn->prepare($updateQuery);
    $update_stmt->bind_param("ss", $generatedWorkout, $username);
    $update_stmt->execute();
}
?>