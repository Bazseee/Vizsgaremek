<!DOCTYPE html>
<html lang="en">

<?php
session_start();

if (isset($_SESSION['username'])) {

    include("db.php");

    // Lekérdezés az avatár elérési útjához
    $username = $_SESSION['username'];
    $sql = "SELECT avatar FROM user WHERE username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['avatar'] == "") {
        $default = "fitnet.png";
        $avatarPath = '../uploads/defaults/' . $default;
    } else if ($result->num_rows > 0) {
        $avatarPath = '../uploads/' . $row['avatar']; // Kép elérési útának beállítása
    }

    $firstRegisterCheck = "SELECT first_register FROM user WHERE username = '$username'";
    $firstRegisterResult = $conn->query($firstRegisterCheck);
    if ($firstRegisterResult->num_rows > 0) {
        $row = $firstRegisterResult->fetch_assoc();
        $firstRegisterValue = $row['first_register'];
        if ($firstRegisterValue == 1) {
            // Ha first_register értéke 1, akkor átirányítás introducing.php-re
            header("Location: ../user_pages/introducing.php");
            exit; // Kilépés a további kód végrehajtásából
        }
    }
} else {
    header("Location: menu.php");
}
?>



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
    <title>FitNet - Admin</title>
</head>

<body>


    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Ha bejelentkezett, akkor megjelenítjük a felhasználónevet és a "Log Out" gombot
        echo '<div class="mt-2 flex items-center gap-4 float-right user-loggedin border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700"><div class="avatar"><img src="' . $avatarPath . '" alt="Profilkép"></div>
    <div class="text-l text-black">' . $_SESSION['username'] . '</div>';
        echo '<button  class="me-5 px-4 bg-red-500 text-white rounded-md text-xl hover:bg-white hover:text-red-600"><a href="logout.php">Log Out</a></button></div>';
    } else {
        // Ha nincs bejelentkezve, akkor a "Log In" gomb jelenik meg
        echo '<button  class="me-5 px-4 bg-red-500 text-white rounded-md text-xl hover:bg-white hover:text-red-600"><a href="landing.php">Log In</a></button>';
    } //Mindkettő button elejéről kivettem a data-aos="fade-left"-et és így megjelnik a button
    ?>
    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar"
        type="button" onclick="hamburger()"
        class="hamburger-menu inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        id="hamburger-button">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 float-left"
        aria-label="Sidebar">
        <div class="bg-red-600 h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 relative">
            <div class="label" style="margin-bottom: 15px; max-width: 125px;">

                <a href="">
                    <div class="text-4xl"
                        style='border: 1px solid red; padding: 10px; border-radius: 15px; background-color: red;'><span
                            style='color: white;'>FitNet</span></div>
                </a>

                <img src="../images/xmark-solid.svg" class="absolute w-10 h-10 top-2 right-2 sm:hidden cursor-pointer"
                    alt="x" srcset="" onclick="hamburger()" id="hamburger-close">
            </div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="admin.php?page=statistics.php"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ml-3">Statistics</span>
                    </a>
                </li>
                <li>
                    <a href="admin.php?page=users"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
                <li>
                    <a href="admin.php?page=announcements"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 48 48">
                            <path
                                d="M40 4h-32c-2.21 0-3.98 1.79-3.98 4l-.02 36 8-8h28c2.21 0 4-1.79 4-4v-24c0-2.21-1.79-4-4-4zm-14 18h-4v-12h4v12zm0 8h-4v-4h4v4z" />
                            <path d="M0 0h48v48h-48z" fill="none" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Announcements</span>
                    </a>
                </li>
                <hr>
                <h1 class="text-xl text-white">Page settings</h1>
                <li>
                    <a href="admin.php?page=exercise_upload"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 486 486">
                            <path d="M452.5,285c15,0,27,12,27,27v147c0,15-12,27-27,27h-418c-15,0-28-12-28-27V312c0-15,13-27,28-27
                            s27,12,27,27v119h364V312C425.5,297,437.5,285,452.5,285z" />
                            <path
                                d="M152.5,156c-11,11-27,11-38,0s-11-27,0-38l110-110c5-5,12-8,19-8s14,3,19,8l110,110
                            c11,11,11,27,0,38c-5,5-12,8-19,8s-15-3-20-8l-63-63v234c0,15-12,27-27,27s-27-12-27-27V93L152.5,156z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Upload exercises</span>
                    </a>
                </li>
                <li>
                    <a href="admin.php?page=exercise_edit"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 512 512">
                            <path d="M492.505,19.51C479.922,6.928,463.194,0,445.401,0c-17.794,0-34.522,6.929-47.103,19.511l-29.291,29.291l94.207,94.207
                            l29.291-29.291C518.478,87.745,518.478,45.484,492.505,19.51z" />
                            <rect x="352.877" y="68.076"
                                transform="matrix(0.7071 -0.7071 0.7071 0.7071 15.2717 306.2504)" width="48.871"
                                height="133.228" />
                            <polygon points="291.435,126.374 55.837,361.972 53.441,364.366 37.454,408.546 103.469,474.561 147.649,458.573 385.642,220.58 
                            " />
                            <polygon points="26.023,440.132 0.015,512 71.883,485.991 		" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Edit exercises</span>
                    </a>
                </li>
                <li>
                    <a href="admin.php?page=exercise_delete"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 64.125 64.125">
                            <path
                                d="M56.228,9.125h-13.04V4.836C43.188,2.17,41.019,0,38.353,0h-12.58c-2.666,0-4.835,2.17-4.835,4.836v4.289H7.897
                            c-2.666,0-4.835,2.17-4.835,4.836v6.289c0,1.105,0.896,2,2,2h5.25v37.041c0,2.666,2.169,4.834,4.835,4.834h34.58
                            c2.666,0,4.835-2.168,4.835-4.834V22.25h4.5c1.104,0,2-0.895,2-2v-6.289C61.062,11.295,58.894,9.125,56.228,9.125z M24.938,4.836
                            C24.938,4.375,25.312,4,25.772,4h12.58c0.46,0,0.835,0.375,0.835,0.836v4.289h-14.25V4.836z M50.562,59.291
                            c0,0.461-0.375,0.834-0.835,0.834h-34.58c-0.46,0-0.835-0.373-0.835-0.834V22.25h36.25V59.291z M57.062,18.25h-4.5h-40.25h-5.25
                            v-4.289c0-0.461,0.375-0.836,0.835-0.836h15.04h18.25h15.04c0.46,0,0.835,0.375,0.835,0.836V18.25z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Delete exercise</span>
                    </a>
                </li>
                <hr>
                <h1 class="text-xl text-white">Forum settings</h1>
                <li>
                    <a href="admin.php?page=topics_and_comments"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 1792 1792">
                            <path
                                d="M1408 768q0 139-94 257t-256.5 186.5-353.5 68.5q-86 0-176-16-124 88-278 128-36 9-86 16h-3q-11 0-20.5-8t-11.5-21q-1-3-1-6.5t.5-6.5 2-6l2.5-5 3.5-5.5 4-5 4.5-5 4-4.5q5-6 23-25t26-29.5 22.5-29 25-38.5 20.5-44q-124-72-195-177t-71-224q0-139 94-257t256.5-186.5 353.5-68.5 353.5 68.5 256.5 186.5 94 257zm384 256q0 120-71 224.5t-195 176.5q10 24 20.5 44t25 38.5 22.5 29 26 29.5 23 25q1 1 4 4.5t4.5 5 4 5 3.5 5.5l2.5 5 2 6 .5 6.5-1 6.5q-3 14-13 22t-22 7q-50-7-86-16-154-40-278-128-90 16-176 16-271 0-472-132 58 4 88 4 161 0 309-45t264-129q125-92 192-212t67-254q0-77-23-152 129 71 204 178t75 230z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Topics and comments</span>
                    </a>
                </li>
                <hr>
                <li>
                    <a href="../user_pages/menu.php?page=dashboard"
                        class="flex items-center p-2 text-white hover:text-black rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-white transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 198.194 198.194">
                            <path d="M132.447,46.884h-88.02l7.267-7.267c4.531-4.531,4.531-11.873,0-16.41
                            c-4.531-4.531-11.873-4.531-16.41,0l-27.07,27.07c-0.005,0.005-0.011,0.005-0.011,0.005L0,58.491l8.202,8.197
                            c0,0,0.005,0.005,0.011,0.016L37.214,95.7c2.268,2.268,5.238,3.399,8.202,3.399c2.975,0,5.939-1.131,8.208-3.399
                            c4.531-4.531,4.531-11.873,0-16.41l-9.197-9.197h88.02c23.459,0,42.544,19.091,42.544,42.544s-19.091,42.544-42.544,42.544H16.421
                            c-6.413,0-11.607,5.194-11.607,11.602c0,6.407,5.194,11.602,11.607,11.602h116.026c36.257,0,65.747-29.496,65.747-65.747
                            S168.703,46.884,132.447,46.884z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Return to user page</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="">
                <?php
                // Alapértelmezett oldal, ha nincs kiválasztva
                $page = isset($_GET['page']) ? $_GET['page'] : 'statistics';

                // Az oldal tartalmának betöltése
                switch ($page) {
                    case 'statistics':
                        include ('statistics.php');
                        break;
                    case 'page_setting':
                        include ('page_setting.php');
                        break;
                    case 'exercise_upload':
                        include ('exercise_upload.php');
                        break;
                    case 'users':
                        include ('users.php');
                        break;
                    case 'announcements':
                        include ('announcements.php');
                        break;
                    case 'exercise_delete':
                        include ('delete_exercise.php');
                        break;
                    case 'exercise_edit':
                        include ('edit_exercise.php');
                        break;
                    case 'topics_and_comments':
                        include ('topics_and_comments.php');
                        break;
                    case 'moderation':
                        include ('moderation.php');
                        break;
                    default:
                        include ('statistics.php');
                }
                ?>
            </div>
        </div>
    </div>
</body>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById("default-sidebar");
        sidebar.classList.toggle("-translate-x-full");
    }

    function hamburger() {
        toggleSidebar();
    }
</script>

</html>