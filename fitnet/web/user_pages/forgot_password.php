<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitNet - Forgot password</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div
        class="max-w-md flex flex-col items-center bg-white shadow-2xl rounded-2xl p-6 absolute z-40 mt-40 left-0 right-0 mx-auto">
        <div id="page1" class="form-page">
            <h2 class="text-xl font-semibold mb-4">Forgot password</h2>
            <form action="forgot_password_work.php" method="POST">
                <label for="email_or_username">Username or E-mail address:</label><br>
                <input type="text" name="email_or_username" id="email_or_username" value=""
                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm md:text-base border-gray-300 rounded-md input-box">
                <br><br>
                <input type="submit" name="submit" action
                    class="w-full mt-2 bg-red-600 text-white py-2 px-4 rounded-md hover:bg-white hover:text-red-600 transition duration-200">
            </form>
        </div>
    </div>
</body>

</html>