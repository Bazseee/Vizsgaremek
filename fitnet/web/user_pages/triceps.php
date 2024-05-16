<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Triceps</title>
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
        Triceps exercises</h1>
    <div
        class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:px-32">

        <!-- Card Item -->
        <div
            class="rounded-lg my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
            <!-- Clickable Area -->
            <a class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/triceps/triceps.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Lever triceps extension
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Lever triceps extension is a strength training exercise that targets the triceps muscles. It involves extending the arms while holding a lever or barbell overhead, then bending at the elbows to lower the weight behind the head before straightening the arms to return to the starting position. This movement isolates and strengthens the triceps, promoting upper arm strength and definition. Lever triceps extension can be performed with various equipment, including a cable machine or free weights, making it a versatile option for building triceps strength and muscle mass.
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
                    <img src="../images/exercises_image/triceps/triceps2.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Triceps dips
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Triceps dips are a bodyweight exercise that targets the triceps, shoulders, and chest. Using parallel bars or a sturdy elevated surface, you lower your body by bending your elbows until your upper arms are parallel to the ground, then push yourself back up to the starting position. This movement effectively isolates and strengthens the triceps muscles, promoting upper body strength and stability. Triceps dips are a versatile exercise suitable for various fitness levels and can be performed virtually anywhere with the right equipment, making them a popular choice for building arm strength and muscle definition.
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
                    <img src="../images/exercises_image/triceps/triceps3.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Dumbbell kickback
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The dumbbell kickback is a popular strength training exercise that targets the triceps muscles in the back of your upper arms. It helps strengthen and tone the triceps, contributing to overall arm strength and aesthetics.
                        Among the exercises that work the arm muscles, kickback and its variations are very effective. You can easily apply these exercises with dumbbells, cables or resistance bands.
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
                    <img src="../images/exercises_image/triceps/triceps4.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Lying barbell triceps extension
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The lying barbell triceps extension, also known as the lying triceps extension or skull crusher, is an effective strength training exercise that targets the triceps muscles. It’s performed by lying on a flat bench with a barbell and extending your arms overhead to work the triceps through a full range of motion.
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
                    <img src="../images/exercises_image/triceps/triceps5.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Bench dips on floor
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">
                        "Bench Dips on Floor" is a triceps-focused exercise where you sit on the floor, hands behind you, and lift your body using arm strength. It's great for upper body strength and can be done anywhere.
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
                    <img src="../images/exercises_image/triceps/triceps6.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Triceps dips on floor
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Triceps dips on the floor are a bodyweight exercise that target the triceps, chest, and shoulders. This exercise can be done almost anywhere without any equipment and is a great way to work your upper body and build strength in your triceps, chest, and shoulders.
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
                    <img src="../images/exercises_image/triceps/triceps7.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">High pulley overhead triceps extension
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">"High Pulley Overhead Tricep Extension" is a gym exercise targeting the triceps. Using a cable machine with a high pulley, stand facing away, grasp the handle, and extend your arms overhead. Keep your elbows close to your head and lower the handle behind you by bending your elbows. Then, extend your arms to return to the starting position. This exercise effectively strengthens and tones the triceps muscles.
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
                    <img src="../images/exercises_image/triceps/triceps8.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">One arm triceps pushdown
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The One arm triceps pushdown is an isolation, single-joint move, which isolates the triceps without the assistance of other muscle groups or joints. Triceps pushdown can be used as an arm toning exercise or as a muscle building exercise.
                        With cables you can isolate each arm and focus more on the triceps muscle. The cables offer a different effect from dumbbells and free weights, because the cables will add a constant tension throughout the range of motion. Also, when you use a single-sided cable, it is impossible to cheat with your strong arm when your weaker arm gets fatigued.
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
                    <img src="../images/exercises_image/triceps/triceps9.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">One arm lying triceps extension
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">
                        "One-Arm Lying Triceps Extension" is a gym exercise targeting the triceps. Lying on a bench or the floor, hold a dumbbell with one hand directly above your chest. Keep your upper arm perpendicular to the floor while bending your elbow to lower the weight towards your forehead. Extend your arm to return to the starting position. This exercise strengthens and tones the triceps effectively.
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

    </div>
</body>

</html>