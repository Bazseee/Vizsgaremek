<title>FitNet - Settings</title>
<?php
// Először csatlakozzunk az adatbázishoz
include ("db.php");

// Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
if (!isset($_SESSION['username'])) {
    // Ha nincs bejelentkezve, átirányítjuk a bejelentkezési oldalra vagy hibaüzenetet jelenítünk meg
    header("Location: login.php");
    exit();
}

// Lekérdezzük a felhasználó ID-ját a session alapján
$username = $_SESSION['username'];
$user_id_query = $conn->prepare("SELECT id FROM user WHERE username = ?");
$user_id_query->bind_param("s", $username);
$user_id_query->execute();
$user_id_result = $user_id_query->get_result();

if ($user_id_result->num_rows == 1) {
    $row = $user_id_result->fetch_assoc();
    $user_id = $row['id'];

    // Lekérdezzük a felhasználó adatait az adatbázisból a user_data táblából
    $user_data_query = $conn->prepare("SELECT * FROM user_data WHERE user_id = ?");
    $user_data_query->bind_param("i", $user_id);
    $user_data_query->execute();
    $user_data_result = $user_data_query->get_result();

    // Ellenőrizzük, hogy van-e adat a felhasználóhoz
    if ($user_data_result->num_rows == 1) {
        $user_data = $user_data_result->fetch_assoc();

        // Adatok kimentése változókba
        $surname = $user_data['surname'];
        $firstname = $user_data['firstname'];
        $weight = $user_data['weight'];
        $height = $user_data['height'];
        $gender = $user_data['gender'];
        $phone = $user_data['phone'];
        $birthday = $user_data['birthday'];
        $intention = $user_data['intention'];

        // Értelmezzük a gender értékét és állítsuk be a megfelelő alapértelmezett értéket
        $checked_man = ($gender == 0) ? 'checked' : '';
        $checked_woman = ($gender == 1) ? 'checked' : '';
        $checked_etc = ($gender == 2) ? 'checked' : '';

        // Értelmezzük az intention értékét és állítsuk be a megfelelő alapértelmezett értéket
        $selected_bulking = ($intention == 0) ? 'selected' : '';
        $selected_cutting = ($intention == 1) ? 'selected' : '';
        $selected_weight_maintenance = ($intention == 2) ? 'selected' : '';
    }
}

// Adatok frissítése az adatbázisban, ha az update gombra kattintottak
if (isset($_POST['update'])) {
    // Ellenőrizzük, hogy az adatokat megadták-e a formban
    // Majd frissítjük azokat az adatbázisban
    if (isset($_POST['surname'])) {
        $surname = $_POST['surname'];
        $update_query = $conn->prepare("UPDATE user_data SET surname = ? WHERE user_id = ?");
        $update_query->bind_param("si", $surname, $user_id);
        $update_query->execute();
    }

    if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
        $update_query = $conn->prepare("UPDATE user_data SET firstname = ? WHERE user_id = ?");
        $update_query->bind_param("si", $firstname, $user_id);
        $update_query->execute();
    }

    if (isset($_POST['weight'])) {
        $weight = $_POST['weight'];
        $update_query = $conn->prepare("UPDATE user_data SET weight = ? WHERE user_id = ?");
        $update_query->bind_param("ii", $weight, $user_id);
        $update_query->execute();
    }

    if (isset($_POST['height'])) {
        $height = $_POST['height'];
        $update_query = $conn->prepare("UPDATE user_data SET height = ? WHERE user_id = ?");
        $update_query->bind_param("ii", $height, $user_id);
        $update_query->execute();
    }

    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
        $update_query = $conn->prepare("UPDATE user_data SET gender = ? WHERE user_id = ?");
        $update_query->bind_param("si", $gender, $user_id);
        $update_query->execute();
    }

    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
        $update_query = $conn->prepare("UPDATE user_data SET phone = ? WHERE user_id = ?");
        $update_query->bind_param("si", $phone, $user_id);
        $update_query->execute();
    }

    if (isset($_POST['birthday'])) {
        $birthday = $_POST['birthday'];
        $update_query = $conn->prepare("UPDATE user_data SET birthday = ? WHERE user_id = ?");
        $update_query->bind_param("si", $birthday, $user_id);
        $update_query->execute();
    }

    if (isset($_POST['intention'])) {
        $intention = $_POST['intention'];
        $update_query = $conn->prepare("UPDATE user_data SET intention = ? WHERE user_id = ?");
        $update_query->bind_param("si", $intention, $user_id);
        $update_query->execute();
    }

    // Frissített adatok lekérése az adatbázisból
    $updated_data_query = $conn->prepare("SELECT * FROM user_data WHERE user_id = ?");
    $updated_data_query->bind_param("i", $user_id);
    $updated_data_query->execute();
    $updated_data_result = $updated_data_query->get_result();

    if ($updated_data_result->num_rows == 1) {
        $updated_data = $updated_data_result->fetch_assoc();
        // Beállítjuk az űrlapban a frissített adatokat
        $surname = $updated_data['surname'];
        $firstname = $updated_data['firstname'];
        $weight = $updated_data['weight'];
        $height = $updated_data['height'];
        $gender = $updated_data['gender'];
        $phone = $updated_data['phone'];
        $birthday = $updated_data['birthday'];
        $intention = $updated_data['intention'];

        // Értelmezzük a gender értékét és állítsuk be a megfelelő alapértelmezett értéket
        $checked_man = ($gender == 0) ? 'checked' : '';
        $checked_woman = ($gender == 1) ? 'checked' : '';
        $checked_etc = ($gender == 2) ? 'checked' : '';

        // Értelmezzük az intention értékét és állítsuk be a megfelelő alapértelmezett értéket
        $selected_bulking = ($intention == 0) ? 'selected' : '';
        $selected_cutting = ($intention == 1) ? 'selected' : '';
        $selected_weight_maintenance = ($intention == 2) ? 'selected' : '';
    }
}
?>

<!-- Most jön a HTML rész, ahol megjelenítjük az űrlapot és az adatokat -->

<h1 class="text-xl mb-3">User settings</h1>
<h2 class="text-l mb-3">On this page, you can change any information you entered incorrectly during your introduction.
</h2>

<div class="site gap-36 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-3">
    <div class="settings-form">
        <form class="personal-data-form" action="" method="post">
            <label for="surname">Surname:</label><br>
            <input type="text" class="input-box" name="surname" id="surname" value="<?php echo $surname; ?>"><br><br>

            <label for="firstname">First name:</label><br>
            <input type="text" class="input-box" name="firstname" id="firstname"
                value="<?php echo $firstname; ?>"><br><br>

            <label for="weight-data">Weight:</label><br>
            <input type="range" min="30" max="300" name="weight" id="weight" oninput="showBodyData()"
                onchange="updateTextInput(this.value, 'weight-data');" value="<?php echo $weight; ?>">
            <input type="number" class="input-box" name="weight-data" min="30" max="300" id="weight-data"
                value="<?php echo $weight; ?>"><span>kg</span><br><br>

            <label for="height-data">Height:</label><br>
            <input type="range" min="70" max="250" name="height" id="height" oninput="showBodyData()"
                onchange="updateTextInput(this.value, 'height-data');" value="<?php echo $height; ?>">
            <input type="number" class="input-box" name="height-data" min="70" max="250" id="height-data"
                value="<?php echo $height; ?>"><span>cm</span><br><br>

            <p>Choose your gender:</p>
            <input type="radio" id="man" name="gender" value="0" <?php echo $checked_man; ?>>
            <label for="man">Man</label><br>
            <input type="radio" id="women" name="gender" value="1" <?php echo $checked_woman; ?>>
            <label for="women">Woman</label><br>
            <input type="radio" id="dolphin" name="gender" value="2" <?php echo $checked_etc; ?>>
            <label for="dolphin">Etc.</label><br><br>

            <p>Change your phone number:</p>
            <span>+ </span><input type="text" class="input-box" name="phone" id="phone" pattern="^\+?[0-9 ]+$"
                value="<?php echo $phone; ?>"><br><br>


            <p>Change your birthday:</p>
            <input type="date" name="birthday" id="birthday" value="<?php echo $birthday; ?>"><br><br>

            <p>Set your intention:</p>
            <select name="intention" id="intention">
                <option value="0" <?php echo $selected_bulking; ?>>bulking</option>
                <option value="1" <?php echo $selected_cutting; ?>>cutting</option>
                <option value="2" <?php echo $selected_weight_maintenance; ?>>weight maintenance</option>
            </select><br><br>

            <input class="button" type="submit" value="Update" name="update">

        </form>
    </div>

    <div class="mt-8">
        <form class="upload-avatar-data upload-avatar" action="avatar_upload.php" method="post"
            enctype="multipart/form-data">
            <label for="avatar">Upload your avatar: </label><span style="font-size: 12px">(Only JPG, JPEG,
                PNG)</span><br>
            <input type="file" name="avatar" id="avatar"><br><br>
            <input class="button" type="submit" value="Upload" name="upload">
        </form>

        <form class="upload-avatar-data regenerate-workout upload-avatar" action="regenerate_workout.php" method="post">
            <p class="underline ">Regenerate workout:</p>
            <label for="workouttime">For how much week would you like to generate?</label>
            <input type="number" class="input-box" name="workouttime" id="workouttime" min="1" max="4" required><br><br>
            <input type="checkbox" id="regenerate-workout" name="regenerate-workout" required>
            <label for="regenerate-workout">Regenerate workout</label><br><br>
            <button class="button" type="submit" name="regenerate">Regenerate</button>
        </form>

        <div class="newpassword">
            <form class="upload-avatar-data regenerate-workout upload-avatar" action="change_password_work.php"
                method="post">
                <p class="text-xl">Get new password:</p><br>
                <input type="password" class="input-box" placeholder="Your current password" id="current-password"
                    name="current-password" required><br><br>
                <input type="password" class="input-box" placeholder="Your new password" id="new-password"
                    name="new-password" required><br><br>
                <input type="checkbox" name="get-new-password-checkbox" id="get-new-password-checkbox"> I need a new
                password <br><br>
                <button class="button" type="submit" name="get-new-password">Get new password</button>
            </form>
        </div>
    </div>
</div>

<script src="../js/settings.js"></script>