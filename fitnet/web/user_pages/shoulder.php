<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Shoulder</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://cdn-tailwindcss.vercel.app/"></script>
    <link rel="stylesheet" href="../css/style.css">
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
        Shoulder exercises</h1>
    <div
        class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:px-32">

        <!-- Card Item -->
        <div
            class="rounded-lg my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
            <!-- Clickable Area -->
            <a href="" class="cursor-pointer">
                <figure>
                    <img src="../images/exercises_image/shoulder/shoulder.gif" alt="">
                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">One arm
                            lateral raises
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The advantage of this exercise is that
                            it barely strains the lower back (which sometimes produces quite unpleasant side effects
                            with other exercises), furthermore, it allows for fixing a specific body position, thus
                            eliminating any chance of cheating. Due to the inclined body position, it engages the
                            muscles from a slightly different angle compared to traditional lateral raises. It can be
                            performed instead of traditional lateral raises, and the exercise can be substituted with
                            cable lateral raises, which provide a more continuous load. Avoid this exercise if your
                            shoulder clicks or hurts during the movement, as the problem may worsen due to the
                            exercise's effect.
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>
        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <a href="" class="cursor-pointer">
                <figure>
                    <img src="../images/exercises_image/shoulder/shoulder2.gif" alt="">

                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Seated
                            lateral raises
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Seated lateral raises target the
                            lateral head of the shoulder muscle in exactly the same way as standing lateral raises do;
                            however, with this exercise, we can isolate the lateral fibers of the deltoid muscles much
                            more effectively.
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>
        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <a href="" class="cursor-pointer">
                <figure>
                    <img src="../images/exercises_image/shoulder/shoulder3.gif" alt="">
                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Forward raise
                            with dumbbell or barbell
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">This exercise primarily develops the
                            upper fibers of the chest muscles and the front deltoids, but it also provides secondary
                            stimulation to the lateral fibers of the shoulder.
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>
        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <a href="" class="cursor-pointer">
                <figure>
                    <img src="../images/exercises_image/shoulder/shoulder4.gif" alt="">

                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Dumbbell
                            presses
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The exercise primarily develops the
                            front and lateral deltoid muscles.
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <!-- Clickable Area -->
            <a href="" class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/shoulder/shoulder5.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Cable lateral
                            raises
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Cable lateral raises primarily
                            stimulate the lateral deltoid muscle. An advantage over other variations of lateral raises
                            is that the cable resistance provides a more continuous load throughout both the positive
                            and negative phases of the range of motion.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <!-- Clickable Area -->
            <a href="" class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/shoulder/shoulder6.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Lying one-arm
                            lateral raise
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The Lying one-arm lateral raise
                            primarily targets the lateral deltoids, but the rear deltoid also contributes to the
                            movement. With proper execution, the role of the front deltoid is minimal.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <!-- Clickable Area -->
            <a href="" class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/shoulder/shoulder7.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Lateral
                            raises machine
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The lateral raise machine primarily
                            works the lateral deltoid muscles. It allows us to unload other muscle groups and isolate
                            the lateral fibers of the deltoid muscles more effectively than with other variations of
                            lateral raises.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <!-- Clickable Area -->
            <a href="" class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/shoulder/shoulder8.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Seated
                            lateral raises
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Seated lateral raises target the
                            lateral head of the shoulder muscle in exactly the same way as standing lateral raises do;
                            however, with this exercise, we can isolate the lateral fibers of the deltoid muscles much
                            more effectively.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

    </div>
</body>

</html>