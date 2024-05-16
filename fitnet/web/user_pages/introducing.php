<?php
session_start();
include ("db.php");
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Felhasználó be van jelentkezve, lekérjük a first_register értékét az adatbázisból
    $username = $_SESSION['username']; // A felhasználónév
    $sql = "SELECT first_register FROM user WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Van eredmény, lekérjük az értéket
        $row = $result->fetch_assoc();
        $firstRegister = $row['first_register'];

        // Ellenőrizzük, hogy a first_register értéke nem 0
        if ($firstRegister != 0) {
            // Az oldal tartalma megjeleníthető
            ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>FitNet - Introducing</title>
                <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
                <link rel="stylesheet" href="../css/style.css">
            </head>

            <body>
                <div
                    class="max-w-md flex flex-col items-center bg-white shadow-2xl rounded-2xl p-6 absolute z-40 mt-40 left-0 right-0 mx-auto">
                    <div id="page1" class="form-page">
                        <h2 class="text-xl font-semibold mb-4">Welcome to the introduction section!</h2>
                        <p>For the best experience, we require you to upload your information about yourself.</p><br><br>
                        <button type="button" onclick="nextPage('page1', 'page2')"
                            class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 transition duration-200">Next</button>
                    </div>
                    <!-- Form pages -->
                    <div id="page2" class="form-page hidden">
                        <!-- Page 1 -->
                        <h2 class="text-xl font-semibold mb-4">Page 1</h2>

                        <label for="surname">Surname</label><br>
                        <input type="text" name="surname" id="surname" value=""
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm md:text-base border-gray-300 rounded-md">
                        <br><br>

                        <label for="firstname">First name</label><br>
                        <input type="text" name="firstname" id="firstname" value=""
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm md:text-base border-gray-300 rounded-md"><br><br>

                        <label for="weight">Weight</label><br>
                        <input type="range" value="" min="30" max="300" name="weight" id="weight" oninput="showBodyData()"
                            onchange="updateTextInput(this.value, 'weight-data');">
                        <input type="number" name="weight-data" min="30" max="300" id="weight-data"><span>kg</span><br><br>

                        <label for="height">Height</label><br>
                        <input type="range" min="70" value="" max="250" name="height" id="height" oninput="showBodyData()"
                            onchange="updateTextInput(this.value, 'height-data');">
                        <input type="number" name="height-data" min="70" max="250" id="height-data"><span>cm</span><br><br>
                        <button type="button" onclick="prevPage('page2', 'page1')"
                            class=" w-full bg-white border border-red-600 text-red-600 py-2 px-4 rounded-md mr-2 hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-100">Previous</button>
                        <button type="button" onclick="nextPage('page2', 'page3')"
                            class="w-full mt-2 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 transition duration-200">Next</button>

                    </div>

                    <div id="page3" class="form-page hidden w-64">
                        <!-- Page 2 -->
                        <h2 class="text-xl font-semibold mb-4">Page 2</h2>

                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" id="address" name="address" value=""
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm md:text-base border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text" id="phone" name="phone" value="+36"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm md:text-base border-gray-300 rounded-md">
                        </div>
                        <p>Set your birthday:</p>
                        <input type="date" name="birthday" id="birthday" value=""><br><br>
                        <button type="button" onclick="prevPage('page3', 'page2')"
                            class=" w-full bg-white border border-red-600 text-red-600 py-2 px-4 rounded-md mr-2 hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-100">Previous</button>
                        <button type="button" onclick="nextPage('page3', 'page4')"
                            class="w-full mt-2 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 transition duration-200">Next</button>

                    </div>

                    <div id="page4" class="form-page hidden w-64">
                        <!-- Page 3 -->
                        <h2 class="text-xl font-semibold mb-4">Page 3</h2>

                        <p>Choose your gender:</p>
                        <input type="radio" id="man" name="gender" value="Man">
                        <label for="man">Man</label><br>
                        <input type="radio" id="women" name="gender" value="Women">
                        <label for="women">Women</label><br>
                        <input type="radio" id="etc" name="gender" value="Etc">
                        <label for="etc">Etc.</label><br><br>
                        <p>Set your intention:</p>
                        <select name="intention" id="intention">
                            <option value="bulking">Bulking</option>
                            <option value="cutting">Cutting</option>
                            <option value="weight maintenance">Weight Maintenance</option>
                        </select><br><br>
                        <button type="button" onclick="prevPage('page4', 'page3')"
                            class=" w-full bg-white border border-red-600 text-red-600 py-2 px-4 rounded-md mr-2
                hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-100">Previous</button>
                        <button type="button" onclick="nextPage('page4', 'page5')"
                            class="w-full mt-2 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 transition duration-200">Next</button>
                    </div>

                    <div id="page5" class="form-page hidden w-64">
                        <!-- Page 4 -->
                        <h2 class="text-xl font-semibold mb-4">Page 4</h2>

                        <p>For how much week would you like to generate the workout plan?</p>
                        <input type="number" name="workouttime" id="workouttime" min="1" max="4" value="1"><br><br>

                        <button type="button" onclick="prevPage('page5', 'page4')"
                            class=" w-full bg-white border border-red-600 text-red-600 py-2 px-4 rounded-md mr-2
                hover:bg-red-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-100">Previous</button>
                        <button type="button" onclick="submitButton()"
                            class="w-full mt-2 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 transition duration-200">Submit</button>
                    </div>
                </div>
                <script>
                    function nextPage(currentPageId, nextPageId) {
                        document.getElementById(currentPageId).classList.add('hidden');
                        document.getElementById(nextPageId).classList.remove('hidden');
                    }

                    function prevPage(currentPageId, prevPageId) {
                        document.getElementById(currentPageId).classList.add('hidden');
                        document.getElementById(prevPageId).classList.remove('hidden');
                    }


                    function updateTextInput(val, id) {
                        document.getElementById(id).value = val;
                    }

                    function submitButton() {
                        submitForm();
                        generateWorkouts();
                    }

                    function submitForm() {
                        // Adatok begyűjtése az űrlapokból
                        var surname = document.getElementById('surname').value;
                        var firstname = document.getElementById('firstname').value;
                        var weight = document.getElementById('weight-data').value;
                        var height = document.getElementById('height-data').value;
                        var address = document.getElementById('address').value;
                        var phone = document.getElementById('phone').value;
                        var birthday = document.getElementById('birthday').value;
                        var gender = document.querySelector('input[name="gender"]:checked').value;
                        var intention = document.getElementById('intention').value;
                        var workouttime = document.getElementById('workouttime').value;

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                console.log("Success!");
                                window.location.href = "../user_pages/menu.php"; // Átirányítás a menü oldalra
                            }
                        }
                        xhr.open("POST", "submit.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        var params = 'surname=' + surname + '&firstname=' + firstname + '&weight=' + weight + '&height=' + height + '&address=' + address + '&phone=' + phone + '&birthday=' + birthday + '&gender=' + gender + '&intention=' + intention + '&workouttime=' + workouttime;
                        xhr.send(params);
                    }

                </script>
            </body>

            </html>

            <?php
        } else {
            // Ha first_register értéke 0, akkor átirányítjuk a felhasználót a dashboard.php-ra
            header("Location: menu.php?p=dashboard.php");
            exit;
        }
    } else {
        echo "No user found!";
    }
} else {
    // Ha a felhasználó nincs bejelentkezve, átirányítjuk a bejelentkezési oldalra
    header("Location: landing.php");
    exit;
}

// Adatbázis kapcsolat bezárása
$conn->close();
?>