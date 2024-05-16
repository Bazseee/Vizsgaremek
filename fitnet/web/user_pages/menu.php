<!DOCTYPE html>
<html lang="en">

<?php
// Adatbáziskapcsolat
include("db.php");

// Felhasználó bejelentkezésének ellenőrzése
include("../user_pages/check_access.php");

// Ellenőrizze, hogy a felhasználó be van-e jelentkezve
if (isset($_SESSION['username'])) {
    $user = $_SESSION['username'];

    // Lekérdezés az avatár elérési útjához
    $avatarPath = ''; // Alapértelmezett üres elérési út
    $sqlAvatar = "SELECT avatar FROM user WHERE username = '$user'";
    $resultAvatar = $conn->query($sqlAvatar);
    $rowAvatar = $resultAvatar->fetch_assoc();
    if ($rowAvatar === null) {
        $default = "fitnet.png";
        $avatarPath = '../uploads/defaults/' . $default;
    } else {
        if ($rowAvatar['avatar'] == "") {
            $default = "fitnet.png";
            $avatarPath = '../uploads/defaults/' . $default;
        } else {
            $avatarPath = '../uploads/' . $rowAvatar['avatar'];
        }
    }

    // Lekérdezés az olvasatlan üzenetek számához
    $unread_notification_query = "SELECT COUNT(*) as unread_count FROM notifications WHERE user_id = (SELECT id FROM user WHERE username = '$user') AND status = 'unread'";
    $unread_notification_result = mysqli_query($conn, $unread_notification_query);
    $unread_count = 0;
    if ($unread_notification_result) {
        $unread_row = mysqli_fetch_assoc($unread_notification_result);
        $unread_count = $unread_row['unread_count'];
    }
    $unread_count_display = ($unread_count > 0) ? " ($unread_count)" : "";

    // Üzenetek státuszának frissítése 'read'-re, ha a felhasználó megnyitja az "Inbox" oldalt
    $update_notification_query = "UPDATE notifications SET status = 'read' WHERE user_id = (SELECT id FROM user WHERE username = '$user') AND status = 'unread'";
    mysqli_query($conn, $update_notification_query);

    $firstRegisterCheck = "SELECT first_register FROM user WHERE username = '$user'";
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
    // Ha a felhasználó nincs bejelentkezve, átirányítjuk a bejelentkezési oldalra
    header("Location: ../user_pages/menu.php");
    exit; // Kilépés a további kód végrehajtásából
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
    <title>FitNet - Menu</title>
</head>

<body>


    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        // Ha bejelentkezett, akkor megjelenítjük a felhasználónevet és a "Log Out" gombot
        echo '<div id="logout" class="mt-2 flex items-center gap-4 float-right user-loggedin border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700"><div class="avatar"><img src="' . $avatarPath . '" alt="Profilkép"></div>
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
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800 relative">
            <div class="label" style="margin-bottom: 15px"><a href="menu.php?page=dashboard">
                    <div class="text-4xl"
                        style='border: 1px solid red; padding: 10px; border-radius: 15px; background-color: red; max-width: 125px;'>
                        <span style='color: white;'>FitNet</span>
                    </div>
                </a><img src="../images/xmark-solid.svg"
                    class="absolute w-10 h-10 top-2 right-2 sm:hidden cursor-pointer" alt="x" srcset=""
                    onclick="hamburger()" id="hamburger-close"></div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="menu.php?page=dashboard"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="menu.php?page=settings"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="menu.php?page=inbox"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Inbox <?php echo $unread_count_display; ?></span>
                    </a>
                </li>
                <li>
                    <a href="menu.php?page=forum"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 40 40">
                            <path
                                d="M2,40a2,2,0,0,1-2-2.35L2.17,25.51a2,2,0,0,1,.56-1.07L26.29,0.88A3,3,0,0,1,28.42,0h0a3,3,0,0,1,2.13.88l8.57,8.57a3,3,0,0,1,0,4.26L15.55,37.27a2,2,0,0,1-1.07.56L2.35,40A2,2,0,0,1,2,40Zm12.14-4.14h0ZM6,26.83L4.47,35.53,13.17,34l0.27-.27L35.59,11.58,28.42,4.41Z" />
                            <path
                                d="M30.93,21.07a2,2,0,0,1-1.41-.59l-10-10a2,2,0,0,1,2.83-2.83l10,10A2,2,0,0,1,30.93,21.07Z" />
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Forum</span>
                    </a>
                </li>

                <?php
                if (isset($_SESSION['username'])) {
                    include ("db.php");
                    $username = $_SESSION['username'];

                    $sql = "SELECT permission FROM user WHERE username = '$username'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $permission = $row["permission"];
                        }
                        if ($permission == "1") {
                            echo "<hr><a href='../admin_pages/admin.php' class='flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group'><svg class='flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white'>
                            <svg class='flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white'
                            aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='currentColor'
                            viewBox='0 0 45.973 45.973'>
                            <path
                                d='M43.454,18.443h-2.437c-0.453-1.766-1.16-3.42-2.082-4.933l1.752-1.756c0.473-0.473,0.733-1.104,0.733-1.774
                                c0-0.669-0.262-1.301-0.733-1.773l-2.92-2.917c-0.947-0.948-2.602-0.947-3.545-0.001l-1.826,1.815
                                C30.9,6.232,29.296,5.56,27.529,5.128V2.52c0-1.383-1.105-2.52-2.488-2.52h-4.128c-1.383,0-2.471,1.137-2.471,2.52v2.607
                                c-1.766,0.431-3.38,1.104-4.878,1.977l-1.825-1.815c-0.946-0.948-2.602-0.947-3.551-0.001L5.27,8.205
                                C4.802,8.672,4.535,9.318,4.535,9.978c0,0.669,0.259,1.299,0.733,1.772l1.752,1.76c-0.921,1.513-1.629,3.167-2.081,4.933H2.501
                                C1.117,18.443,0,19.555,0,20.935v4.125c0,1.384,1.117,2.471,2.501,2.471h2.438c0.452,1.766,1.159,3.43,2.079,4.943l-1.752,1.763
                                c-0.474,0.473-0.734,1.106-0.734,1.776s0.261,1.303,0.734,1.776l2.92,2.919c0.474,0.473,1.103,0.733,1.772,0.733
                                s1.299-0.261,1.773-0.733l1.833-1.816c1.498,0.873,3.112,1.545,4.878,1.978v2.604c0,1.383,1.088,2.498,2.471,2.498h4.128
                                c1.383,0,2.488-1.115,2.488-2.498v-2.605c1.767-0.432,3.371-1.104,4.869-1.977l1.817,1.812c0.474,0.475,1.104,0.735,1.775,0.735
                                c0.67,0,1.301-0.261,1.774-0.733l2.92-2.917c0.473-0.472,0.732-1.103,0.734-1.772c0-0.67-0.262-1.299-0.734-1.773l-1.75-1.77
                                c0.92-1.514,1.627-3.179,2.08-4.943h2.438c1.383,0,2.52-1.087,2.52-2.471v-4.125C45.973,19.555,44.837,18.443,43.454,18.443z
                                 M22.976,30.85c-4.378,0-7.928-3.517-7.928-7.852c0-4.338,3.55-7.85,7.928-7.85c4.379,0,7.931,3.512,7.931,7.85
                                C30.906,27.334,27.355,30.85,22.976,30.85z' />
                        </svg>
                        <span class='flex-1 ml-3 whitespace-nowrap'>Admin panel</span></a>";
                        }
                    }
                    $conn->close();
                }
                ?>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
            <div class="">
                <?php
                // Alapértelmezett oldal, ha nincs kiválasztva
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

                // Az oldal tartalmának betöltése
                switch ($page) {
                    case 'dashboard':
                        include ('dashboard.php');
                        break;
                    case 'exercises':
                        include ('exercises.php');
                        break;
                    case 'inbox':
                        include ('inbox.php');
                        break;
                    case 'users':
                        include ('users.php');
                        break;
                    case 'upgrade':
                        include ('upgrade.php');
                        break;
                    case 'settings':
                        include ('settings.php');
                        break;
                    case 'contact':
                        include ('contact.php');
                        break;
                    case 'forum':
                        include ('forum.php');
                        break;
                    default:
                        include ('dashboard.php');
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