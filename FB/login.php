<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = mysqli_connect('127.0.0.1', 'root', '', 'facebook');

    if ($conn) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['dob'] = $user['dob'];
                $_SESSION['address'] = $user['address'];
                $_SESSION['phone'] = $user['phone'];
                $_SESSION['pincode'] = $user['pincode'];
                $_SESSION['password'] = $user['password'];
                header("Location: welcome.php");
                exit();
            } else {
                echo "Invalid username or password.";
            }
            mysqli_close($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-blue-200 min-h-screen flex items-center">
        <div class="w-full">
            <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Fill out our form</h2>
            <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
                <form method="post">
                    <div class="mb-5">
                        <label for="username" class="block mb-2 font-bold text-gray-600">Username</label>
                        <input type="text" id="username" name="username" placeholder="Username" required class="border border-gray-300 shadow p-3 w-full rounded mb-">
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block mb-2 font-bold text-gray-600">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" required class="border border-gray-300 shadow p-3 w-full rounded mb-">
                    </div>

                    <button class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg">Submit</button>
                </form>
                <a class="text-center text-blue-500" href="register.php">New here? Register Yourself</a>
            </div>
        </div>
    </div>
</body>

</html>