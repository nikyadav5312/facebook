<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli('127.0.0.1', 'root', '', 'facebook');

    $name = $_POST['name'];
    $username = $_POST['username'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $pincode = $_POST['pincode'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);


    $sql = "INSERT INTO users (name, username, dob, address, phone, pincode, password) VALUES
     ( '$name', '$username',  '$dob',  '$address', '$phone', '$pincode','$password')";

    if (mysqli_query($conn, $sql)) {
        // echo "Registration successful!";
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Registration Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-blue-200 py-12 flex items-center">
        <div class="w-full">
            <h2 class="text-center text-blue-400 font-bold text-2xl uppercase mb-10">Fill out our form</h2>
            <div class="bg-white p-10 rounded-lg shadow md:w-3/4 mx-auto lg:w-1/2">
                <form action="register.php" method="post" enctype="multipart/form-data">
                    <div class="flex justify-between">
                        <div>
                            <label class="block mb-2 font-bold text-gray-600" for="name">Name:</label>
                            <input  class="border border-gray-300 shadow p-3 w-full rounded mb-"  type="text" id="name" name="name"   pattern="[A-Za-z]+"  title="Please enter letters only.">

                        </div>
                        <div>
                            <label class="block mb-2 font-bold text-gray-600" for="username">Username:</label>
                            <input class="border border-gray-300 shadow p-3 w-full rounded mb-" type="text" id="username" name="username" required>
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <div>
                            <label class="block mb-2 font-bold text-gray-600" for="dob">Date of Birth:</label>
                            <input class="border border-gray-300 shadow p-3 !w-full rounded mb-" type="date" id="dob" name="dob" required>
                        </div>
                        <div>
                            <label class="block mb-2 font-bold text-gray-600" for="address">Address:</label>
                            <input class="border border-gray-300 shadow p-3 w-full rounded mb-" id="address" name="address" required />
                        </div>
                    </div>


                    <label class="block mb-2 font-bold text-gray-600" for="phone">Phone.no:</label>
                    <input class="border border-gray-300 shadow p-3 w-full rounded mb-" maxlength="10" type="tel" id="phone" name="phone" required>

                    <label class="block mb-2 font-bold text-gray-600" for="education">Pincode:</label>
                    <input class="border border-gray-300 shadow p-3 w-full rounded mb-" maxlength="6" type="pincode" id="pincode" name="pincode" required>

                    <!-- <label class="block mb-2 font-bold text-gray-600" for="image">Profile Image:</label>
        <input class="border border-gray-300 shadow p-3 w-full rounded mb-" type="file" id="image" name="image" required> -->

                    <label class="block mb-2 font-bold text-gray-600" for="password">Password:</label>
                    <input class="border border-gray-300 shadow p-3 w-full rounded mb-" type="password" id="password" name="password" required>

                    <input class="block w-full bg-blue-500 text-white font-bold p-4 rounded-lg" type="submit" value="Register">
                </form>
                <a class="text-center text-blue-500" href="login.php">Alredy user register</a>
            </div>
        </div>
    </div>
</body>

</html>