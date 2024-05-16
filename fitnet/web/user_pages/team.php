<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">
    <title>FitNet - Team</title>
</head>

<body class="overflow-x-hidden">
    <!-- NAVBAR-->
    <nav class="h-12 w-100 mt-6 flex flex-col items-center justify-center transition duration-300">
        <div class="logo" data-aos="fade-down">
            <a href="landing.php">
                <img src="images/unnamed.png" alt="" class="ms-4 w-10 rounded-full hover:rotate-[360deg] duration-300">
            </a>
        </div>
        <ul data-aos="fade-down" class="flex gap-10 justify-center items-center text-xl ">
            <li class="hover:scale-150 duration-300 text-center"><a href="landing.php">Home</a></li>
            <li class="hover:scale-150 duration-300 text-center"><a href="landing.php#aboutus">About us</a></li>
            <li class="hover:scale-150 duration-300 text-center"><a href="musclegroup.php">Exercises</a></li>
        </ul>
        <button></button>

    </nav>

    <!-- NAVBAR VÉGE-->


    <section class="mb-32 text-center lg:text-left" id="aboutus">
        <style>
            @media (min-width: 992px) {
                .rotate-lg-6 {
                    transform: rotate(1deg);
                }
            }

            /* These are the KEY styles - you can add them directly to any object you want in your project */
            .fancy-border-radius {
                /* border-radius: 53% 47% 52% 48% / 36% 41% 59% 64%;*/
            }

            @media only screen and (max-width: 800px) {
                .balazs {
                    margin-left: 0 !important;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="container mx-auto text-center lg:text-left xl:px-32 mt-8">
            <div class="grid items-center lg:grid-cols-2">
                <div class="mb-12 lg:mb-0">
                    <div id="jumbotron"
                        class="relative z-[1] block rounded-lg bg-[hsla(0,0%,100%,0.55)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-[hsla(0,0%,5%,0.55)] dark:shadow-black/20 md:px-12 lg:-mr-14 backdrop-blur-[30px]">
                        <h2 class="mb-6 text-4xl font-bold">Fajta Jordán</h2>
                        <p class="mb-12 text-neutral-500 dark:text-neutral-300">

                            Hello, my name is Jordan Fajta, a frontend developer focused on crafting captivating user
                            experiences and polished interfaces. With expertise in user interface design,
                            HTML/CSS/JavaScript development, responsiveness, interactivity, testing, and design
                            implementation, I bring designs to life with clean, efficient code. I thrive on effective
                            team collaboration and actively curate content to enrich projects. My goal is to exceed
                            expectations and create memorable digital experiences.
                        </p>

                        <div class="grid gap-x-6 md:grid-cols-3">
                            <div class="mb-12 md:mb-0">
                                <h2 class="text-center text-dark mb-4 text-3xl font-bold">Frontend</h2>
                                <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    Tailwind css
                                </h5>
                                <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    Html
                                </h5>
                                <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    JavaScript
                                </h5>
                                <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    Scss
                                </h5>
                            </div>
                            <div class="mb-12 md:mb-0">
                                <h2 class="text-dark mb-4 text-3xl font-bold"></h2>

                            </div>
                            <div class="mb-12 md:mb-0">
                                <h2 class="text-center text-dark mb-4 text-3xl font-bold">Contact</h2>
                                <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    +36202422224
                                </h5>
                                <h5 class="text-center mb-0 text-sm font-medium text-neutral-500 dark:text-neutral-300">
                                    jordanfajta@gmail.com
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="jordan">
                    <img src="../images/jordan-modified.png"
                        class="fancy-border-radius rotate-lg-6 w-full  dark:shadow-black/20 " alt="" />
                </div>
            </div>
        </div>


        <!-- Jumbotron -->
    </section>

    <div class="container mx-auto text-center lg:text-left xl:px-32 mb-32">
        <div class="grid items-center lg:grid-cols-2">
            <div id="bigFitnetLogo">
                <img src="../images/balazs-modified.png"
                    class="balazs fancy-border-radius rotate-lg-6 w-full  dark:shadow-black/20 ml-10" alt="" />
            </div>
            <div class="mb-12 lg:mb-0">
                <div id="jumbotron"
                    class="relative z-[1] block rounded-lg bg-[hsla(0,0%,100%,0.55)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-[hsla(0,0%,5%,0.55)] dark:shadow-black/20 md:px-12 lg:-mr-14 backdrop-blur-[30px]">
                    <h2 class="mb-6 text-4xl font-bold">Mártai Balázs</h2>
                    <p class="mb-12 text-neutral-500 dark:text-neutral-300">
                        Greetings! My name is Balázs Mártai, a backend developer dedicated to building robust
                        applications and
                        optimizing performance. My expertise lies in translating complex requirements into efficient
                        application logic, managing databases, implementing secure user authentication, and optimizing
                        performance. With a focus on reliability and collaboration, I strive to deliver backend
                        solutions that elevate digital experiences.
                    </p>
                    <div class="grid gap-x-6 md:grid-cols-3">
                        <div class="mb-12 md:mb-0">
                            <h2 class="text-center text-dark mb-4 text-3xl font-bold">Backend</h2>
                            <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                Php
                            </h5>
                            <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                JavaScript
                            </h5>
                        </div>
                        <div class="">
                            <h2 class="text-center text-dark mb-4 text-3xl font-bold">Database</h2>
                            <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                MySql
                            </h5>
                        </div>
                        <div class="mb-12 md:mb-0">
                            <h2 class="text-center text-dark mb-4 text-3xl font-bold">Contact</h2>
                            <h5 class="text-center mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                +36301234567
                            </h5>
                            <h5 class="text-center mb-0 text-sm font-medium text-neutral-500 dark:text-neutral-300">
                                bmartai05@gmail.com
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jumbotron -->
    </section>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");
        .footer {
            position: relative;
            width: 100%;
            background: #C51720;
            min-height: 100px;
            padding: 20px 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .social-icon,
        .menu {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .social-icon__item,
        .menu__item {
            list-style: none;
        }

        .social-icon__link {
            font-size: 2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
        }

        .social-icon__link:hover {
            transform: translateY(-10px);
        }

        .menu__link {
            font-size: 1.2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
            text-decoration: none;
            opacity: 0.75;
            font-weight: 300;
        }

        .menu__link:hover {
            opacity: 1;
        }

        .footer p {
            color: #fff;
            margin: 15px 0 10px 0;
            font-size: 1rem;
            font-weight: 300;
        }

        .wave {
            position: absolute;
            top: -100px;
            left: 0;
            width: 100%;
            height: 100px;
            background-image: url("../images/wave.png");
            background-size: 1000px 100px;
        }

        .wave#wave1 {
            z-index: 1000;
            opacity: 1;
            bottom: 0;
            animation: animateWaves 4s linear infinite;
        }

        .wave#wave2 {
            z-index: 999;
            opacity: 0.5;
            bottom: 10px;
            animation: animate 4s linear infinite !important;
        }

        .wave#wave3 {
            z-index: 1000;
            opacity: 0.2;
            bottom: 15px;
            animation: animateWaves 3s linear infinite;
        }

        .wave#wave4 {
            z-index: 999;
            opacity: 0.7;
            bottom: 20px;
            animation: animate 3s linear infinite;
        }

        @keyframes animateWaves {
            0% {
                background-position-x: 1000px;
            }

            100% {
                background-positon-x: 0px;
            }
        }

        @keyframes animate {
            0% {
                background-position-x: -1000px;
            }

            100% {
                background-positon-x: 0px;
            }
        }

        @media (max-width: 1023px) {
            #jordan {
                order: -1;
                /* Jordan div előbb jelenik meg */
            }
        }
    </style>
    <footer class="footer">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="#aboutus">About</a></li>
            <li class="menu__item"><a class="menu__link" href="team.php">Team</a></li>
        </ul>
        <p>&copy;2024 FitNet | All Rights Reserved</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        AOS.init();
        var typed = new Typed('#element', {
            strings: ['Fitness is a journey, not a destination.'],
            typeSpeed: 70,
            loop: true,
        });
    </script>

</body>

</html>