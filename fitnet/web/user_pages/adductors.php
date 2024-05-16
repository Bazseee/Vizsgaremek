<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Adductors</title>
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
        Adductors exercises</h1>
    <div
        class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:px-32">

        <!-- Card Item -->
        <div
            class="rounded-lg my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
            <!-- Clickable Area -->
            <a class="cursor-pointer">
                <figure>
                    <!-- Image -->
                    <img src="../images/exercises_image/aductors/aductors.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Standing leg
                            circles
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Standing leg circles are a simple yet
                            effective lower body exercise that helps improve leg strength, hip mobility, flexibility,
                            and balance. It involves standing on one leg while making circular motions with the other
                            leg.
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
                    <img src="../images/exercises_image/aductors/aductors2.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Lever side
                            hip abduction
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">
                            The Lever Side Hip Abduction exercise targets the outer thighs and hip muscles. Using a
                            lever machine, you position yourself sideways and lift the leg away from your body against
                            resistance. This movement strengthens the hip abductors, aiding in hip stability and
                            improving lateral movement strength.
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
                    <img src="../images/exercises_image/aductors/aductors3.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Cable hip
                            adduction
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The cable hip adduction is an
                            effective isolation exercise for the inner hips which builds strength and muscle in the
                            adductors responsible for rotation of the hip joint.
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
                    <img src="../images/exercises_image/aductors/aductors4.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Cable goblet
                            squat
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The Cable Goblet Squat is a compound
                            lower body exercise that targets the quadriceps, hamstrings, glutes, and core muscles.
                            Holding a cable attachment at chest height, you perform a squat while keeping the elbows
                            close to the body. This exercise challenges balance and stability while providing resistance
                            throughout the movement, helping to build strength and muscle mass in the lower body.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>








    </div>
</body>

</html>