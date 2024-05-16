<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Statistics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Add your CSS styling here */
    </style>
</head>

<body>
    <?php
    include ("db.php");

    // New Users kártya lekérdezése
    $newUsersQuery = "SELECT COUNT(id) AS new_users_count FROM user WHERE reg_time >= NOW() - INTERVAL 1 DAY";
    $newUsersResult = $conn->query($newUsersQuery);
    $newUsersData = $newUsersResult->fetch_assoc();
    $newUsersCount = $newUsersData['new_users_count'];

    // Total Users kártya lekérdezése
    $totalUsersQuery = "SELECT COUNT(id) AS total_users_count FROM user";
    $totalUsersResult = $conn->query($totalUsersQuery);
    $totalUsersData = $totalUsersResult->fetch_assoc();
    $totalUsersCount = $totalUsersData['total_users_count'];

    $serverStartTimeFile = '../server-start-time.txt';

    // Ellenőrizzük, hogy a fájl létezik-e
    if (!file_exists($serverStartTimeFile)) {
        // Ha nem létezik, akkor létrehozzuk és beleírjuk a jelenlegi időt
        file_put_contents($serverStartTimeFile, time());
    }

    // Szerver start time lekérdezése
    $serverStartTime = (int) file_get_contents($serverStartTimeFile);

    // Az uptime kiszámolása
    $uptimeInSeconds = time() - $serverStartTime;

    // Az uptime különböző formátumokban megjelenítése
    $uptimeDays = floor($uptimeInSeconds / (60 * 60 * 24));
    $uptimeHours = floor(($uptimeInSeconds % (60 * 60 * 24)) / (60 * 60));
    $uptimeMinutes = floor(($uptimeInSeconds % (60 * 60)) / 60);
    ?>

    <section>
        <div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-white pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-red-600 to-white-800 p-4 shadow text-2xl text-white">
                    <h1 class="font-bold pl-2">Analytics</h1>
                </div>
            </div>

            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div
                        class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold uppercase text-gray-600">New users</h2>
                                <p class="font-bold text-3xl">
                                    <?php echo $newUsersCount; ?> <span class="text-green-500"><i
                                            class="fas fa-caret-up"></i></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <!--Metric Card-->
                    <div
                        class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold uppercase text-gray-600">Total Users</h2>
                                <p class="font-bold text-3xl">
                                    <?php echo $totalUsersCount; ?> <span class="text-green-500"><i
                                            class="fas fa-caret-up"></i></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--/Metric Card-->
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div
                        class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i>
                                </div>
                            </div>
                            <div class="flex-1 text-right md:text-center">
                                <h2 class="font-bold uppercase text-gray-600">Server Uptime</h2>
                                <p class="font-bold text-2xl">
                                    <?php echo "$uptimeDays days, $uptimeHours hours, $uptimeMinutes minutes"; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>