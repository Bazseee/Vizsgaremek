<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"></script>
    <script type="module" src="../js/tw-elements.umd.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>

    <style>
        /* Add your styling for the card here */
        .card-container {
            display: flex;
            flex-wrap: wrap;
        }

        .user-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            max-width: auto;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .user-card img {
            max-width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid #ccc;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .pagination a {
            margin-left: 10px;
        }

        .pagination a.active {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h1 class="text-xl mb-3">User settings</h1>
    <form id="filterForm"
        style='padding: 10px; border: 1px solid #ccc; border-radius: 15px; max-width: 400px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);'>
        <div class="form-group">
            <label for="username">Search by Username:</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter username"
                style='border-bottom: 1px solid black;'>
        </div>
        <button type="button" class="button bg-green" onclick="filterUsers()">Search</button>
    </form>

    <div id="cardContainer" class="card-container">
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mesterremek";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $whereClause = "";
        $itemsPerPage = 20;
        $currentPage = isset($_GET['p']) ? (int) $_GET['p'] : 1; // Change 'page=users' to 'p'
        $offset = ($currentPage - 1) * $itemsPerPage;

        if (isset($_GET['username']) && !empty($_GET['username'])) {
            $username = $_GET['username'];
            $whereClause = " WHERE username LIKE '%$username%'";
        }

        $sql_select_users = "SELECT id, username, avatar, email, is_banned, permission, reg_time FROM user" . $whereClause . " LIMIT $offset, $itemsPerPage";
        $result_users = $conn->query($sql_select_users);

        if ($result_users->num_rows > 0) {
            while ($user = $result_users->fetch_assoc()) {
                // Módosított PHP kód kezdet
                echo "<script>
                        var userData = userData || {};
                        userData['" . $user['username'] . "'] = {
                            originalUsername: '" . $user['username'] . "',
                            originalEmail: '" . $user['email'] . "',
                            originalPermission: '" . $user['permission'] . "'
                        };
                    </script>";
                // Módosított PHP kód vége
        
                if ($user['avatar'] == "") {
                    $default = "fitnet.png";
                    $avatarPath = '../uploads/defaults/' . $default;
                } else {
                    $avatarPath = '../uploads/' . $user['avatar'];
                }

                echo "<div style='text-align: center;' class='user-card' data-username='" . $user['username'] . "'>
                        <img src='" . $avatarPath . "' alt='Avatar'>
                        <h3 class='text-xl mt-2'>" . $user['username'] . "</h3>
                        <p class='mt-2'>" . "Email: " . $user['email'] . "</p>
                        <p class='mt-2'>" . "Registration: " . $user['reg_time'] . "</p>
                        <button class='button' onclick='editUser(\"" . $user['username'] . "\", \"" . $user['email'] . "\")'>Edit user data</button>
                        <button class='button bg-red' onclick='toggleBan(\"" . $user['username'] . "\", \"" . $user['is_banned'] . "\")'>" . ($user['is_banned'] == 1 ? 'Unban' : 'Ban') . "</button>
                        <br>
                        <br>
                        <div id='editForm-" . $user['username'] . "' style='display:none;'>
                            <form id='editUserForm-" . $user['username'] . "' onsubmit='saveUser(\"" . $user['username'] . "\", event)'>
                                <label for='editUsername'>Username:</label>
                                <input type='text' id='editUsername-" . $user['username'] . "' value='" . $user['username'] . "' required style='border-bottom: 1px solid #ccc;'>
                                <label for='editEmail'>Email:</label>
                                <input type='email' id='editEmail-" . $user['username'] . "' value='" . $user['email'] . "' required style='border-bottom: 1px solid #ccc;'>
                                <label for='editEmail'>Permission:</label>
                                <input type='number' id='editPermission-" . $user['username'] . "' value='" . $user['permission'] . "' required style='border-bottom: 1px solid #ccc;' min='0' max='2''>
                                <br>
                                <br>
                                <div  style= 'display: block;'>
                                    <button type='submit' class='button bg-blue'>Save
                                        <svg style='margin: 0 auto;' class='flex-shrink-0 w-5 h-5 text-red transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white'
                                        aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='currentColor'
                                        viewBox='0 0 438.533 438.533'>
                                        <path d='M432.823,121.049c-3.806-9.132-8.377-16.367-13.709-21.695l-79.941-79.942c-5.325-5.325-12.56-9.895-21.696-13.704
                                        C308.346,1.903,299.969,0,292.357,0H27.409C19.798,0,13.325,2.663,7.995,7.993c-5.33,5.327-7.992,11.799-7.992,19.414v383.719
                                        c0,7.617,2.662,14.089,7.992,19.417c5.33,5.325,11.803,7.991,19.414,7.991h383.718c7.618,0,14.089-2.666,19.417-7.991
                                        c5.325-5.328,7.987-11.8,7.987-19.417V146.178C438.531,138.562,436.629,130.188,432.823,121.049z M182.725,45.677
                                        c0-2.474,0.905-4.611,2.714-6.423c1.807-1.804,3.949-2.708,6.423-2.708h54.819c2.468,0,4.609,0.902,6.417,2.708
                                        c1.813,1.812,2.717,3.949,2.717,6.423v91.362c0,2.478-0.91,4.618-2.717,6.427c-1.808,1.803-3.949,2.708-6.417,2.708h-54.819
                                        c-2.474,0-4.617-0.902-6.423-2.708c-1.809-1.812-2.714-3.949-2.714-6.427V45.677z M328.906,401.991H109.633V292.355h219.273
                                        V401.991z M402,401.991h-36.552h-0.007V283.218c0-7.617-2.663-14.085-7.991-19.417c-5.328-5.328-11.8-7.994-19.41-7.994H100.498
                                        c-7.614,0-14.087,2.666-19.417,7.994c-5.327,5.328-7.992,11.8-7.992,19.417v118.773H36.544V36.542h36.544v118.771
                                        c0,7.615,2.662,14.084,7.992,19.414c5.33,5.327,11.803,7.993,19.417,7.993h164.456c7.61,0,14.089-2.666,19.41-7.993
                                        c5.325-5.327,7.994-11.799,7.994-19.414V36.542c2.854,0,6.563,0.95,11.136,2.853c4.572,1.902,7.806,3.805,9.709,5.708l80.232,80.23
                                        c1.902,1.903,3.806,5.19,5.708,9.851c1.909,4.665,2.857,8.33,2.857,10.994V401.991z'/>
                                        </svg>
                                    </button>
                                    <button type='button' class='button bg-blue' onclick=\"resetUser('{$user['username']}')\">Back
                                        <svg style='margin: 0 auto;' class='flex-shrink-0 w-5 h-5 text-red transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white'
                                        aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='currentColor'
                                        viewBox='0 0 198.194 198.194'>
                                        <path  d='M132.447,46.884h-88.02l7.267-7.267c4.531-4.531,4.531-11.873,0-16.41
                                        c-4.531-4.531-11.873-4.531-16.41,0l-27.07,27.07c-0.005,0.005-0.011,0.005-0.011,0.005L0,58.491l8.202,8.197
                                        c0,0,0.005,0.005,0.011,0.016L37.214,95.7c2.268,2.268,5.238,3.399,8.202,3.399c2.975,0,5.939-1.131,8.208-3.399
                                        c4.531-4.531,4.531-11.873,0-16.41l-9.197-9.197h88.02c23.459,0,42.544,19.091,42.544,42.544s-19.091,42.544-42.544,42.544H16.421
                                        c-6.413,0-11.607,5.194-11.607,11.602c0,6.407,5.194,11.602,11.607,11.602h116.026c36.257,0,65.747-29.496,65.747-65.747
                                        S168.703,46.884,132.447,46.884z' />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                      </div>";
            }
        } else {
            echo "No users found.";
        }
        ?>
    </div>

    <div class="pagination" style="margin-top: 20px; display: flex; align-items: center; justify-content: center;">
        <?php
        $sql_total_users = "SELECT COUNT(*) as total FROM user" . $whereClause;
        $result_total_users = $conn->query($sql_total_users);
        $row_total_users = $result_total_users->fetch_assoc();
        $totalPages = ceil($row_total_users['total'] / $itemsPerPage);

        // Preserving the existing filter parameters
        $filterParams = isset($_GET['username']) ? "&username=" . $_GET['username'] : "";

        // Previous page arrow
        if ($currentPage > 1) {
            echo "<a href='?page=users&p=" . ($currentPage - 1) . $filterParams . "'><i class='fas fa-chevron-left'></i></a>";
        }

        // Page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='?page=users&p=$i$filterParams'" . ($i === $currentPage ? " class='active'" : "") . ">" . $i . "</a>";
        }

        // Next page arrow
        if ($currentPage < $totalPages) {
            echo "<a href='?page=users&p=" . ($currentPage + 1) . $filterParams . "'><i class='fas fa-chevron-right'></i></a>";
        }
        ?>
    </div>

    <script>
        var userData = userData || {};
        function toggleBan(username, isBanned) {
            var confirmation = confirm("Are you sure you want to " + (isBanned == 1 ? "unban" : "ban") + " the user?");
            if (confirmation) {
                // Perform AJAX request to toggle the ban status
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // Handle the response, e.g., display a success message
                        console.log(this.responseText);
                        // Reload the user cards after the ban status is toggled
                        filterUsers();
                    }
                };
                xhttp.open("POST", "toggle_ban.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("username=" + username + "&isBanned=" + isBanned);
            }
        }

        function resetUser(username) {
            var editForm = document.getElementById('editForm-' + username);
            var editUsernameInput = document.getElementById('editUsername-' + username);
            var editEmailInput = document.getElementById('editEmail-' + username);
            var editPermissionInput = document.getElementById('editPermission-' + username);

            // Visszaállítjuk az editForm div stílusát
            editForm.style.display = 'none';

            // Visszaállítjuk az input mezők értékeit az eredeti értékeikre
            editUsernameInput.value = userData[username].originalUsername;
            editEmailInput.value = userData[username].originalEmail;
            editPermissionInput.value = userData[username].originalPermission;
        }

    </script>

    <script>
        function filterUsers() {
            var username = document.getElementById('username').value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("cardContainer").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "filter_users.php?username=" + username, true);
            xhttp.send();
        }
    </script>

    <script>
        function editUser(username, email) {
            var editForm = document.getElementById('editForm-' + username);
            editForm.style.display = 'block';

            var editUsernameInput = document.getElementById('editUsername-' + username);
            var editEmailInput = document.getElementById('editEmail-' + username);
            var editPermissionInput = document.getElementById('editPermission-' + username);

            editUsernameInput.value = username;
            editEmailInput.value = email;
            editPermissionInput.value = userData[username].originalPermission;
        }

        function saveUser(username, event) {
            event.preventDefault();

            var editUsernameInput = document.getElementById('editUsername-' + username);
            var editEmailInput = document.getElementById('editEmail-' + username);
            var editPermissionInput = document.getElementById('editPermission-' + username);

            // Perform AJAX request to save the edited user data
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Handle the response, e.g., display a success message
                    console.log(this.responseText);
                }
            };
            xhttp.open("POST", "save_user.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("username=" + editUsernameInput.value + "&email=" + editEmailInput.value + "&permission=" + editPermissionInput.value);
            alert("Save successful!");
            filterUsers(); // Instead of location.reload(), call filterUsers() to update the user list
        }

    </script>

</body>

</html>