<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Lats</title>
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
        Lats exercises</h1>
    <div
        class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:px-32">

        <!-- Card Item -->
        <div
            class="rounded-lg my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
            <!-- Clickable Area -->
            <a class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/lats/lats.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Single arm twisting seated cable row
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">
                        The Single Arm Twisting Seated Cable Row works your upper back and arms. Sit on the rowing machine, grab the handle with one hand, and pull it towards your torso while twisting your body. It's great for building strength and muscle definition.
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
                    <img src="../images/exercises_image/lats/lats2.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Seated cable row
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The seated cable row is a popular cable exercise that targets the upper back and lats. This exercise involves pulling a cable attachment towards your body while seated, using a cable machine. Whether you’re a beginner or an experienced lifter, this exercise can be a valuable addition to your training program.
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
                    <img src="../images/exercises_image/lats/lats3.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Half lneeling lat pulldown
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The half kneeling lat pulldown is one of the exercises that benefits to strengthen and enlarge your back. Half kneeling lat pulldown is a unilateral exercise. This means you can focus on each area of your education. If one side of your body is stronger or larger than the other, you can use this exercise to correct these muscle imbalances that develop over time.
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
                    <img src="../images/exercises_image/lats/lats4.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Cable rear pulldown / behind the neck pulldown

                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">This exercise primarily targets the muscles in the upper back, especially the latissimus dorsi (lats), which are responsible for the broad and V-shaped appearance of the back.
                        While not recommended for everyone, some individuals with specific body structures, good flexibility, and proper form may be able to perform the exercise without experiencing issues. The primary concern is the potential for injury to the neck and shoulders due to the forced forward head tilt and extreme range of motion. This risk is particularly elevated under heavy loads.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>








    </div>
</body>

</html>