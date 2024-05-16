<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Hamstrings</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://cdn-tailwindcss.vercel.app/"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"></script>



</head>

<body>
    <nav class="h-12 w-100 mt-6 place-content-center transition duration-300">
        <div class="logo" data-aos="fade-down"><img src="images/unnamed.png" alt=""
                class="ms-4 w-10 rounded-full hover:rotate-[360deg] duration-300"></div>
        <ul data-aos="fade-down" class="flex gap-10 justify-center items-center ms-10 text-xl ">
            <li class="hover:scale-150 duration-300"><a href="landing.php">Home</a></li>
            <li class="hover:scale-150  duration-300"><a href="landing.php#aboutus">About us</a></li>
            <li class="hover:scale-150  duration-300"><a href="musclegroup.php">Exercises</a></li>
        </ul>
    </nav>

    <h1
        class="text-center mb-4 text-xl font-extrabold leading-none tracking-tight text-red-600 md:text-xl lg:text-2xl dark:text-white">
        Hamstrings exercises</h1>
    <div
        class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 md:px-32">

        <!-- Card Item -->
        <div
            class="rounded-lg my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
            <!-- Clickable Area -->
            <a class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/hamstrings/hamstrings.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Leg curl
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The leg curl is an isolation exercise that targets the muscles of the back of the thigh, specifically the hamstrings. It is an effective exercise for developing strength, size, and muscular endurance in the hamstrings. It is commonly performed using a leg curl machine found in gyms or fitness centers.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>
        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <!-- Clickable Area -->
            <a class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/hamstrings/hamstrings2.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">The Lever Kneeling Leg Curl / Standing Single Leg Curls
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The Lever Kneeling Leg Curl (or Standing Single Leg Curls) is a gym exercise focusing on the hamstrings. Using a lever machine, either kneeling or standing, hook your feet under the padded lever or use ankle straps. Bend your knee, pulling the lever towards your buttocks, then slowly return to the starting position. This exercise effectively targets the hamstrings, aiding in leg strength and stability.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>
        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <!-- Clickable Area -->
            <a class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/hamstrings/hamstrings3.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Lever single curl
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">
                        The Lever Curl is a gym exercise targeting the biceps. Sit on the machine bench with your arms extended, gripping the lever handles. Curl the lever towards your shoulders while keeping your upper arms stationary. Squeeze your biceps at the top of the movement before slowly lowering the lever back down. This exercise effectively isolates and strengthens the biceps muscles.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>
    </div>
</body>

</html>