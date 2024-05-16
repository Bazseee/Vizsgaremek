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
    <title>FitNet - Landing</title>
</head>

<body class="overflow-x-hidden">
    <!-- NAVBAR-->
    <nav class="h-12 w-full flex flex-col md:flex-row mt-2 justify-between transition duration-300">
        <div class="logo" data-aos="fade-down">
            <img src="images/unnamed.png" alt="" class="ms-4 w-10 rounded-full hover:rotate-[360deg] duration-300">
        </div>
        <ul data-aos="fade-down" class="flex gap-10 justify-center items-center md:items-stretch md:flex-row text-xl ">
            <li class="hover:scale-150 duration-300 text-center">Home</li>
            <li class="hover:scale-150 duration-300 text-center"><a href="#aboutus">About us</a></li>
            <li class="hover:scale-150 duration-300 text-center"><a href="musclegroup.php">Exercises</a></li>
        </ul>
        <?php
        session_start();
        $serverStartTimeFile = '../server-start-time.txt';

        // Check if the file exists
        if (!file_exists($serverStartTimeFile)) {
            // If the file does not exist, create it and write the current time
            file_put_contents($serverStartTimeFile, time());
        }
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // If logged in, display the username and "Log Out" button
            header("location: menu.php?page=dashboard");
            exit();
        } else {
            // If not logged in, display the "Log In" button
            echo '<button data-aos="fade-left" class="md:me-5 md:ml-2 md:mr-1 px-4 bg-red-500 text-white rounded-md text-xl hover:bg-white hover:text-red-600"><a data-modal-target="#modal">Log In</a></button>
        <div class="modal" id="modal">
        <div class="  form-structor"><!--<button data-close-button class="close-button">&times;</button>-->
          <div class="signup">       
              <h2 class="form-title" id="signup">Sign up</h2>
              <form method="POST" action="user_register.php">
                  <div class="form-holder">
                      <input type="text" class="input" name="username" placeholder="Username" />
                      <input type="email" class="input" name="email" placeholder="Email" />
                      <input type="password" class="input" name="password" placeholder="Password" />
                      <input type="password" class="input" name="passwordagain" placeholder="Password again" />
                  </div>
                  <button type="submit" class="submit-btn">Sign up</button>
              </form>
          </div>
          <div class="login slide-up">
            <div class="center">
                <h2 class="form-title" id="login">Log in</h2>
                <form method="POST" action="user_login.php">
                    <div class="form-holder">
                        <input type="email" class="input" name="email" placeholder="Email" required>
                        <input type="password" class="input" name="password" placeholder="Password" required>
                    </div>
                    <input type="submit" class="submit-btn" value="Log in">
                    <div class="forgot-password"><a href="forgot_password.php">Forgot password?</a></div>
                </form>
            </div>
        </div>
      </div>
      <script src="../js/login_page.js"></script>
      </div>
      <div id="overlay"></div>';
        }
        ?>
        <script src="../js/popup.js"></script>
        <script src="../js/login_page.js"></script>
    </nav>

    <!-- NAVBAR END-->

    <!--PIROS BLOB-->
    <div id="blob" data-aos="fade-left"
        class="hidden md:flex absolute block w-1/2 bg-red-600 h-2/3 rounded-l-full overflow-hidden -right-16 top-36 flex items-center justify-center">
        <img src="../images/manrunnin.svg" alt="" class="w-2/3">
    </div>
    <!---->

    <div class="container w-100 mx-auto flex">
        <div class="text mt-64">
            <h1 class="text-7xl">Fit<span class="text-red-600">Net</span></h1>
            <p class="text-3xl text-gray-700 ms-1 mt-1"><span id="element"></span></p>
            <p class="text-xl text-gray-700 ms-1">Start working out with us right away!</p>
            <button class="px-4 bg-red-500 text-white rounded-md text-xl hover:bg-white hover:text-red-600"><a
                    href="#aboutus">Learn
                    more</a></button>
        </div>
    </div>

    <div class="container w-100 mx-auto flex mt-56 mb-32">
        <div class="flex justify-center -space-x-3 font-mono text-white text-sm font-bold leading-6">
            <div
                class="w-24 h-24 rounded-full hover:translate-y-4 flex items-center justify-center bg-red-600 shadow-lg object-center overflow-hidden  duration-300 hover:translate-y-4">
                <img src="../images/sport (4).svg" alt="" class="h-24 w-24 duration-300">
            </div>
            <div
                class="w-24 h-24 rounded-full hover:translate-y-4 flex items-center justify-center bg-red-600 shadow-lg object-center overflow-hidden  duration-300 hover:translate-y-4">
                <img src="../images/sport (1).svg" alt="" class="h-24 w-24">
            </div>
            <div
                class="w-24 h-24 rounded-full hover:translate-y-4 flex items-center justify-center bg-red-600 shadow-lg object-center overflow-hidden  duration-300 hover:translate-y-4">
                <img src="../images/sport (2).svg" alt="" class="h-24 w-24">
            </div>
            <div
                class="w-24 h-24 rounded-full hover:translate-y-4 flex items-center justify-center bg-red-600 shadow-lg object-center overflow-hidden  duration-300 hover:translate-y-4">
                <img src="../images/sport (3).svg" alt="" class="h-24 w-24">
            </div>
        </div>
    </div>
    <section class="mb-32 text-center lg:text-left" id="aboutus">
        <style>
            @media (min-width: 992px) {
                .rotate-lg-6 {
                    transform: rotate(6deg);
                }
            }

            /* These are the KEY styles - you can add them directly to any object you want in your project */
            .fancy-border-radius {
                border-radius: 53% 47% 52% 48% / 36% 41% 59% 64%;
            }
        </style>

        <!-- Jumbotron -->
        <div class="container mx-auto text-center lg:text-left xl:px-32">
            <div class="grid items-center lg:grid-cols-2">
                <div class="mb-12 lg:mb-0">
                    <div id="jumbotron"
                        class="relative z-[1] block rounded-lg bg-[hsla(0,0%,100%,0.55)] px-6 py-12 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] dark:bg-[hsla(0,0%,5%,0.55)] dark:shadow-black/20 md:px-12 lg:-mr-14 backdrop-blur-[30px]">
                        <h2 class="mb-6 text-4xl font-bold">Why is it so great?</h2>
                        <p class="mb-12 text-neutral-500 dark:text-neutral-300">

                            Welcome to our FitNet website! Here, you'll find everything you need to kickstart your
                            fitness journey and achieve your health goals. From personalized workout plans to expert
                            nutrition advice, we've got you covered. Browse through a variety of exercise routines
                            tailored to your fitness level and preferences, whether you're into cardio, strength
                            training. Our platform also offers insightful articles, tips, and tutorials to help you stay
                            motivated and informed every step of the way. Join our vibrant community of fitness
                            enthusiasts, track your progress, and start transforming your lifestyle today with FitNet!
                        </p>

                        <div class="grid gap-x-6 md:grid-cols-3">
                            <div class="mb-12 md:mb-0">
                                <h2 class="text-dark mb-4 text-3xl font-bold">100%</h2>
                                <h5 class="mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    User friendly
                                </h5>
                            </div>
                            <?php
                            include ("db.php");
                            $totalUsersQuery = "SELECT COUNT(id) AS total_users_count FROM user";
                            $totalUsersResult = $conn->query($totalUsersQuery);
                            $totalUsersData = $totalUsersResult->fetch_assoc();
                            $totalUsersCount = $totalUsersData['total_users_count'];
                            ?>
                            <div class="mb-12 md:mb-0">
                                <h2 class="text-dark mb-4 text-3xl font-bold">
                                    <?php echo $totalUsersCount; ?>
                                </h2>
                                <h5 class="mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    users
                                </h5>
                            </div>

                            <div class="">
                                <h2 class="text-dark mb-4 text-3xl font-bold">Over 100</h2>
                                <h5 class="mb-0 text-lg font-medium text-neutral-500 dark:text-neutral-300">
                                    exercises to choose from
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="bigFitnetLogo">
                    <img src="../images/unnamed.png"
                        class="fancy-border-radius rotate-lg-6 w-full shadow-lg dark:shadow-black/20" alt="" />
                </div>
            </div>
        </div>


        <!-- Jumbotron -->
    </section>
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
            <li class="menu__item"><a class="menu__link" href="team.php">Our Team</a></li>
            <li class="menu__item"><a class="menu__link" href="../files/fitnet-privacypolicy.pdf" download>Privacy
                    Policy</a></li>
        </ul>
        <p>© 2024 FitNet. All rights reserved.</p>
    </footer>
    <script src="../js/login_page.js"></script>
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