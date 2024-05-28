<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("connection.php");
include("navbar.php");

$currentURL = $_SERVER['REQUEST_URI'];
$parts = parse_url($currentURL);
parse_str($parts['query'], $query);

$friend = $query['username'];
$user = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$friend'";
$result = $conn->query($sql);

$user_data = null;
if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Profile</title>
</head>

<body>
    <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
        <div class="card p-4">
            <div class="image d-flex flex-column justify-content-center align-items-center">
                <button class="btn btn-secondary">
                    <img src="https://i.imgur.com/wvxPV9S.png" height="100" width="100" />
                </button>

                <?php if ($user_data) : ?>
                    <span><?php echo htmlspecialchars($user_data["name"]); ?></span>
                    <span>@<?php echo htmlspecialchars($friend); ?></span>
                    <span><?php echo htmlspecialchars($user_data["dob"]); ?></span>
                    <span><?php echo htmlspecialchars($user_data["address"]); ?></span>
                    <span><?php echo htmlspecialchars($user_data["phone"]); ?></span>
                    <span><?php echo htmlspecialchars($user_data["pincode"]); ?></span>
                    <div class="d-flex flex-row justify-content-center align-items-center mt-3">
                        <span class="number">1069 <span class="follow">Followers</span></span>
                    </div>
                    <div class="d-flex mt-2">


                        <form action="add.php" method="post">
                            <input type="text" name="user" value="<?php echo htmlspecialchars($user); ?>">
                            <input type="text" name="friend" value="<?php echo htmlspecialchars($friend); ?>">
                            <button class="btn1 btn-dark" type="submit">Follow</button>
                        </form>


                    </div>

                    <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center">
                        <span><i class="fa fa-twitter"></i></span>
                        <span><i class="fa fa-facebook-f"></i></span>
                        <span><i class="fa fa-instagram"></i></span>
                        <span><i class="fa fa-linkedin"></i></span>
                    </div>
                <?php else : ?>
                    <span class="text-danger">User not found.</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>