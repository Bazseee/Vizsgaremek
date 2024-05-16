<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Biceps</title>
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
        Biceps exercises</h1>
    <div
        class="grid grid-flow-row gap-8 text-neutral-600 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 md:px-32">

        <div
            class="rounded-lg my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1">
            <a class="cursor-pointer">
                <figure>
                    <img src="../images/exercises_image/biceps/biceps.gif" alt="">

                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Hammer curls
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The hammer bicep curl exercise targets
                            the brachialis muscle running beneath the bicep and the muscles of the forearm. Developing
                            the brachialis muscle can improve the peak of your bicep
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>
        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <a class="cursor-pointer">
                <figure>
                    <img src="../images/exercises_image/biceps/biceps2.gif" alt="">

                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Barbell curl
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">A barbell curl is a weightlifting
                            exercise that primarily targets the biceps muscles in the upper arms. It involves lifting a
                            barbell with an underhand grip and curling it towards the chest while keeping the elbows
                            stationary.This exercise is typically performed while standing with feet shoulder-width
                            apart and the barbell held at arm’s length in front of the body. Barbell curls can be
                            performed using various weights and grip positions, allowing for variations in the exercise
                            and the ability to target different muscles. They are a popular exercise for those looking
                            to increase the size and definition of their biceps.
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
                    <img src="../images/exercises_image/biceps/biceps3.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Concentration
                            curl
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">Concentration curls are a type of
                            strength training exercise that primarily targets the brachialis and biceps muscles of the
                            arms. When performing a concentration curl unilaterally, you are able to focus more
                            specifically on each arm, allowing for greater muscle activation and development. This can
                            help to address muscle imbalances between the left and right sides of the body, which can be
                            common due to dominant hand use or previous injuries.
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
                    <img src="../images/exercises_image/biceps/biceps4.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Seated
                            dumbbell curl
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The bicep workout with dumbbells is an
                            excellent bicep exercise that also engages the muscles responsible for flexing the forearm.
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
                    <img src="../images/exercises_image/biceps/biceps5.gif" alt="">

                    <figcaption class="p-4">
                        <!-- Title -->
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300"> Incline curl
                            with dumbbells
                            <!-- Post Title -->
                        </p>

                        <!-- Description -->
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The incline curl with dumbbells
                            primarily works the two-headed (biceps brachii) muscles, but the muscles of the forearm also
                            receive secondary stress.
                            <!-- Post Description -->
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">

            <a class="cursor-pointer">
                <figure>

                    <img src="../images/exercises_image/biceps/biceps6.gif" alt="">

                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Bicep on the
                            Scott bench
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The bicep on the Scott bench,
                            according to belief, is not capable of 'stretching' the bicep, i.e., bringing the lower part
                            closer to the elbow. Although it is a fact that it primarily stimulates the lower part,
                            unfortunately, it cannot alter muscle insertions, so it would be a vain hope to think that
                            with this exercise, we could change the shapes imposed on us by genetics.
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

        <!--<div
                class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
                x-for="(post, index) in posts">
                <a  class="cursor-pointer">
                    <figure>
                        <img src="../images/exercises_image/biceps/biceps7.gif" alt="">
                        <figcaption class="p-4">
                            <p
                                class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300"
                                >xd
                            </p>
                            <small
                                class="leading-5 text-gray-500 dark:text-gray-400"
                                >Lorem ipsum dolor sit amet consectetur, adipisicing elit. Adipisci nihil tempore dolor fugiat consectetur assumenda minus, iure aut ipsa recusandae excepturi doloribus minima tenetur animi nobis iusto, exercitationem deleniti magni.
                            </small>
                        </figcaption>
                    </figure>
                </a>
            </div>-->

        <div class="my-8 rounded shadow-lg shadow-gray-400 dark:shadow-gray-900 bg-white dark:bg-gray-800 duration-300 hover:-translate-y-1"
            x-for="(post, index) in posts">
            <a class="cursor-pointer">
                <figure>
                    <img src="../images/exercises_image/biceps/biceps8.gif" alt="">

                    <figcaption class="p-4">
                        <p class="text-lg mb-4 font-bold leading-relaxed text-gray-800 dark:text-gray-300">Cable rope
                            hammer curls
                        </p>
                        <small class="leading-5 text-gray-500 dark:text-gray-400">The cable bicep curl with a rope
                            targets the brachialis muscle running beneath the bicep and the muscles of the forearm.
                            Developing the brachialis muscle can improve the peak of your bicep.
                        </small>
                    </figcaption>
                </figure>
            </a>
        </div>

    </div>
</body>

</html>